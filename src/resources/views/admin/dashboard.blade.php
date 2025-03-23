@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
@endsection

@section('header')
<header class="header">
    <div class="header__inner">
      <a class="header__logo" href="/">
        FashionablyLate
      </a>
        <nav>
          <ul class="header-nav">
            <li class="header-nav__item">
              <form class="form" action="/logout" method="post">
              @csrf
                <button class="header-nav__button">logout</button>
              </form>
            </li>
          </ul>
        </nav>
    </div>
  </header>
@endsection

@section('content')
<div class="dashboard__content">
    <div class="dashboard__heading">
        <h2>Admin</h2>
    </div>

    <!-- 検索フォーム -->
    <form class="search-form" action="{{ route('admin.search') }}" method="GET">
    @csrf
        <div class="search-form__content">

        <!-- キーワードでの検索  -->
            <div class="form__group">
                <div class="form__group-content">
                    <div class="form__input--keyword">
                        <input class="search-form__item-input" type="text" name="keyword" placeholder="名前やメールアドレスを入力してください" value="{{ old('keyword') }}">
                    </div>
                </div>
            </div>

        <!-- 性別での検索 -->
            <div class="form__group">
                <div class="form__group-content">
                    <div class="form__input--gender">
                        <select class="search-form__item-select" name="gender">
                            <option selected disabled>性別</option>
                            <option value="">全て</option>
                            <option value="1">男性</option>
                            <option value="2">女性</option>
                            <option value="3">その他</option>
                        </select>
                    </div>
                </div>
            </div>

        <!-- お問い合わせの種類での検索 -->
            <div class="form__group">
                <div class="form__group-content">
                    <div class="form__input--categories">
                        <select class="search-form__item-select" name="category_id">
                            <option value="">お問い合わせの種類</option>
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->content }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

        <!-- 日付での検索 -->
            <div class="form__group">
                <div class="form__group-content">
                    <div class="form__input--date">
                        <input class="search-form__date" type="date" name="date" value="{{ old('date') }}">
                    </div>
                </div>
            </div>

        <!-- 検索ボタン -->
            <div class="search-form__button">
                <button class="search-form__button-submit" type="submit">検索</button>
                <button class="search-form__button-reset" type="button" onclick="location.href='{{ route('admin.dashboard') }}'">リセット</button>
            </div>

        </div>
    </form>

        <!-- エクスポート -->
    <form class="export-form" action="" method="">
        <div class="export__button">
            <button class="export__button-submit" type="submit">エクスポート</button>
        </div>
    </form>

        <!-- ページネーション -->
        <div class="d-flex justify-content-center mt-4">
        {{ $contacts->links('pagination::bootstrap-4') }}
        </div>

        <!-- 検索結果の表示 -->
        <div class="contacts-table">
            <table class="contacts-table__inner">
                    <tr class="contacts-table__row">
                            <th class="contacts-table__header">お名前</th>
                            <th class="contacts-table__header">性別</th>
                            <th class="contacts-table__header">メールアドレス</>
                            <th class="contacts-table__header">お問い合わせの種類</th>
                            <th class="contacts-table__header"></th>
                    </tr>

                    @foreach ($contacts as $contact)
                    <tr class="contacts-table__row">
                        <td>{{ $contact->last_name }} {{ $contact->first_name }}</td>
                        <td>
                            @if ($contact->gender == 1)
                                男性
                            @elseif ($contact->gender == 2)
                                女性
                            @else
                                その他
                            @endif
                        </td>
                        <td>{{ $contact->email }}</td>
                        <td>{{ $contact->category->content ?? '未分類' }}</td>
                        <td>
                            <a href="{{ route('admin.dashboard', ['contact_id' => $contact->id]) }}" class="btn btn-primary">
                            詳細
                            </a>
                        </td>
                    </tr>
                    @endforeach
            </table>
        </div>

        <!-- モーダルウィンドウ -->
@if (request('contact_id'))
    @php
        $contact = $contacts->firstWhere('id', request('contact_id'));
    @endphp

    @if ($contact)
        <div class="modal show d-block" id="modal{{ $contact->id }}" tabindex="-1" aria-labelledby="modalLabel{{ $contact->id }}">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <a href="{{ route('admin.dashboard') }}" class="btn-close"></a>
                    </div>
                    <div class="modal-body">
                        <p><strong>お名前:</strong> {{ $contact->last_name }} {{ $contact->first_name }}</p>
                        <p><strong>性別:</strong> {{ $contact->gender == 1 ? '男性' : ($contact->gender == 2 ? '女性' : 'その他') }}</p>
                        <p><strong>メール:</strong> {{ $contact->email }}</p>
                        <p><strong>電話:</strong> {{ $contact->tel }}</p>
                        <p><strong>住所:</strong> {{ $contact->address }}</p>
                        <p><strong>建物:</strong> {{ $contact->building ?? 'なし' }}</p>
                        <p><strong>お問い合わせの種類:</strong> {{ $contact->category->content ?? '未分類' }}</p>
                        <p><strong>内容:</strong> {{ $contact->detail }}</p>
                    </div>
                    <div class="modal-footer">
                        <form action="{{ route('admin.destroy', ['contact' => $contact->id]) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('本当に削除しますか？');">削除</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endif
@endsection
