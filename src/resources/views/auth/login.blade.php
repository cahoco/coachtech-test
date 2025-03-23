@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

<!-- 登録画面に飛ぶボタン -->
    <div class="register__button">
        <form action="{{ route('register') }}" method="GET">
            <button type="submit" class="register__button-submit">Register</button>
        </form>
    </div>

@section('content')
<div class="login-form__content">
  <div class="login-form__heading">
    <h2>Login</h2>
  </div>
  <form class=form action="{{ route('login') }}" method="POST">
  @csrf
    <div class="form__group">
      <div class="form__group-title">
        <span class="form__label--item">メールアドレス</span>
      </div>
      <div class="form__group-content">
        <div class="form__input--text">
          <input type="email" name="email" placeholder="例:test@example.com" value="{{ old('email') }}" required/>
        </div>
        <div class="form__error">
          @error('email')
          {{ $message }}
          @enderror
        </div>
      </div>
    </div>
    <div class="form__group">
      <div class="form__group-title">
        <span class="form__label--item">パスワード</span>
      </div>
      <div class="form__group-content">
        <div class="form__input--text">
          <input type="password" name="password" placeholder="例:coachtech1106" required/>
        </div>
        <div class="form__error">
          @error('password')
          {{ $message }}
          @enderror
        </div>
      </div>
    </div>
    <div class="form__button">
      <button class="form__button-submit" type="submit">ログイン</button>
    </div>
  </form>
</div>
@endsection