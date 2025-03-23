<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use App\Models\Category;

class ContactController extends Controller
{
    public function index()
  {
    $categories = Category::all();
    return view('contact.index', compact('categories'));
  }

    public function confirm(ContactRequest $request)
  {
    $data = $request->validated();
    $data['tel'] = $data['tel1'] . $data['tel2'] . $data['tel3'];
    session()->flash('form_data', $data);
    return view('contact.confirm', compact('data'));
  }
    public function store(Request $request)
    {
      dd($request->all());
        Contact::create($request->all());
        return view('contact.thanks');
    }

    // 「2.コントローラーの編集」ここをなんか変えないといけない　電話番号3つのフォームに分けてtel1とかにしちゃったから

    public function search(Request $request)
{
    $query = Contact::query();

    // 名前・メールアドレス検索（部分一致・完全一致）
    if ($request->filled('keyword')) {
        $keyword = $request->input('keyword');
        $query->where(function ($q) use ($keyword) {
            $q->where('last_name', 'like', "%{$keyword}%")
              ->orWhere('first_name', 'like', "%{$keyword}%")
              ->orWhere('email', 'like', "%{$keyword}%");
        });
    }

    // 性別での検索
    if ($request->filled('gender')) {
        $query->where('gender', $request->input('gender'));
    }

    // お問い合わせ種類での検索
    if ($request->filled('category_id')) {
        $query->where('category_id', $request->input('category_id'));
    }

    // 日付での検索
    if ($request->filled('date')) {
        $query->whereDate('created_at', $request->input('date'));
    }

    // 7件ごとにページネーション
    $contacts = $query->paginate(7);
    $categories = Category::all();

    return view('admin.dashboard', compact('contacts', 'categories'));
}

    public function destroy(Contact $contact)
{
    $contact->delete();
    return redirect()->route('admin.dashboard')->with('success', 'データを削除しました。');
}
}
