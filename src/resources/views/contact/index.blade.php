@extends('layouts.app')
<!-- viewファイルの指定はresource/views以下の該当ファイルまでのパスを.で繋いで記述 -->

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
    <div class="contact-form__content">
      <div class="contact-form__heading">
        <h2>Contact</h2>
      </div>
      <form class="form" action="{{ route('contact.confirm') }}" method="POST">
      @csrf
        <div class="form__group">
          <div class="form__group-title">
            <span class="form__label--item">お名前</span>
            <span class="form__label--required">※</span>
          </div>
          <div class="form__group-content">
            <div class="form__input--text">
              <input type="text" name="last_name" placeholder="例:山田" value="{{ old('last_name', request('last_name')) }}">
              <input type="text" name="first_name" placeholder="例:太郎" value="{{ old('first_name', request('first_name')) }}">
            </div>
            @error('last_name') <div class="form__error">{{ $message }}</div> @enderror
            @error('first_name') <div class="form__error">{{ $message }}</div> @enderror
          </div>
        </div>
        <div class="form__group">
          <div class="form__group-title">
            <span class="form__label--item">性別</span>
            <span class="form__label--required">※</span>
          </div>
          <div class="form__group-content">
            <div class="form__input--radio">
                <input type="radio" name="gender" value="1" {{ old('gender', request('gender', 1)) == 1 ? 'checked' : '' }}> 男性
                <input type="radio" name="gender" value="2" {{ old('gender', request('gender')) == 2 ? 'checked' : '' }}> 女性
                <input type="radio" name="gender" value="3" {{ old('gender', request('gender')) == 3 ? 'checked' : '' }}> その他
            </div>
            @error('gender') <div class="form__error">{{ $message }}</div> @enderror
          </div>
        </div>
        <div class="form__group">
          <div class="form__group-title">
            <span class="form__label--item">メールアドレス</span>
            <span class="form__label--required">※</span>
          </div>
          <div class="form__group-content">
            <div class="form__input--text">
              <input type="email" name="email" placeholder="test@example.com" value="{{ old('email', request('email')) }}"/>
            </div>
            @error('email') <div class="form__error">{{ $message }}</div> @enderror
          </div>
        </div>
        <div class="form__group">
          <div class="form__group-title">
            <span class="form__label--item">電話番号</span>
            <span class="form__label--required">※</span>
          </div>
          <div class="form__group-content">
            <div class="form__input--text">
              <input type="text" name="tel1" value="{{ old('tel1', request('tel1')) }}" maxlength="5" placeholder="080"/> -
              <input type="text" name="tel2" value="{{ old('tel2', request('tel2')) }}" maxlength="5" placeholder="1234"> -
              <input type="text" name="tel3" value="{{ old('tel3', request('tel3')) }}" maxlength="5" placeholder="5678">
            </div>
            @error('tel1') <div class="form__error">{{ $message }}</div> @enderror
            @error('tel2') <div class="form__error">{{ $message }}</div> @enderror
            @error('tel3') <div class="form__error">{{ $message }}</div> @enderror
          </div>
        </div>
        <div class="form__group">
          <div class="form__group-title">
            <span class="form__label--item">住所</span>
            <span class="form__label--required">※</span>
          </div>
          <div class="form__group-content">
            <div class="form__input--text">
              <input type="text" name="address" placeholder="例:東京都渋谷区千駄ヶ谷1-2-3" value="{{ old('address', request('address')) }}"/>
            </div>
            @error('address') <div class="error">{{ $message }}</div> @enderror
          </div>
        </div>
        <div class="form__group">
          <div class="form__group-title">
            <span class="form__label--item">建物</span>
            <span class="form__label--required">※</span>
          </div>
          <div class="form__group-content">
            <div class="form__input--text">
              <input type="text" name="building" placeholder="例:千駄ヶ谷マンション101" value="{{ old('building', request('building')) }}"/>
            </div>
          </div>
        </div>
        <div class="form__group">
          <div class="form__group-title">
            <span class="form__label--item">お問い合わせの種類</span>
            <span class="form__label--required">※</span>
          </div>
          <div class="form__group-content">
            <div class="form__input--select">
                <select name="category_id">
                    <option value="" selected disabled>選択してください</option>
                    @foreach ($categories as $category)
                      <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                          {{ $category->content }}
                      </option>
                    @endforeach
                </select>
            </div>
            @error('category_id') <div class="form__error">{{ $message }}</div> @enderror
          </div>
        </div>
        <div class="form__group">
          <div class="form__group-title">
            <span class="form__label--item">お問い合わせ内容</span>
            <span class="form__label--required">※</span>
          </div>
          <div class="form__group-content">
            <div class="form__input--textarea">
              <textarea name="detail" placeholder="お問い合わせ内容をご記載ください" >{{ old('detail', request('last_name')) }}</textarea>
            </div>
            @error('detail') <div class="error">{{ $message }}</div> @enderror
          </div>
        </div>
        <div class="form__button">
          <button class="form__button-submit" type="submit">確認画面</button>
        </div>
      </form>
    </div>
  </main>
</body>

</html>
@endsection