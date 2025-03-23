<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
  {
    return view('index');
  }
  public function confirm(Request $request)
  {
    $contact = $request->only(['content']);
    return view('confirm', ['contact' => $contact]);
  }
    public function store()
  {
    $contact = $request->only(['content']);
    Category::create($contact);
    return view('thanks');
  }
}

// カテゴリーコントローラーとコンタクトコントローラーが多分どっかおかしい。