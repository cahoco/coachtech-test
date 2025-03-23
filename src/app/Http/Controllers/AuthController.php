<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Category;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;

class AuthController extends Controller
{
    public function dashboard()
    {
        $contacts = Contact::with('category')->paginate(7);
        $categories = Category::all();
        return view('admin.dashboard', compact('contacts', 'categories'));
    }
    public function destroy($id)
    {
        Contact::findOrFail($id)->delete();
        return redirect()->route('admin.dashboard')->with('success', 'お問い合わせを削除しました。');
    }
}
