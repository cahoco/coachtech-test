@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/confirm.css') }}">
@endsection

@section('content')
@php
    dd(session('form_data'));
@endphp
    <div class="confirm__content">
      <div class="confirm__heading">
        <h2>Confirm</h2>
      </div>
      <form class="form" action="{{ route('contact.store') }}" method="post">
      @csrf
        <div class="confirm-table">
          <table class="confirm-table__inner">
            @if(session('form_data'))
                @php $data = session('form_data'); @endphp
            <tr class="confirm-table__row">
              <th class="confirm-table__header">お名前</th>
              <td class="confirm-table__text">
                <input type="text" name="full_name" value="{{ $data['last_name'] . '　' . $data['first_name'] }}" readonly />
              </td>
            </tr>
                <input type="hidden" name="last_name" value="{{ $data['last_name'] }}">
                <input type="hidden" name="first_name" value="{{ $data['first_name'] }}">
            <tr class="confirm-table__row">
              <th class="confirm-table__header">性別</th>
              <td class="confirm-table__text">
                <input type="text" name="gender" value="{{ $data['gender'] }}" readonly />
              </td>
            </tr>
            <tr class="confirm-table__row">
              <th class="confirm-table__header">メールアドレス</th>
              <td class="confirm-table__text">
                <input type="email" name="email" value="{{ ['男性', '女性', 'その他'][$data['gender']] }}" readonly />
              </td>
            </tr>
            <tr class="confirm-table__row">
              <th class="confirm-table__header">電話番号</th>
              <td class="confirm-table__text">
                <input type="tel" name="tel" value="{{ $data['tel1'] }}-{{ $data['tel2'] }}-{{ $data['tel3'] }}" readonly />
              </td>
            </tr>
            <tr class="confirm-table__row">
              <th class="confirm-table__header">住所</th>
              <td class="confirm-table__text">
                <input type="text" name="address" value="{{ $data['address'] }}" readonly />
              </td>
            </tr>
            <tr class="confirm-table__row">
              <th class="confirm-table__header">建物</th>
              <td class="confirm-table__text">
                <input type="text" name="building" value="{{ $data['building'] }}" readonly />
              </td>
            </tr>
            <tr class="confirm-table__row">
              <th class="confirm-table__header">お問い合わせの種類</th>
              <td class="confirm-table__text">
                <input type="text" name="category" value="{{ \App\Models\Category::find($data['category_id'])->content }}" readonly />
                <input type="hidden" name="category_id" value="{{ $data['category_id'] }}">
              </td>
            </tr>
            <tr class="confirm-table__row">
              <th class="confirm-table__header">お問い合わせ内容</th>
              <td class="confirm-table__text">
                <textarea name="detail" readonly>{{ $data['detail'] }}</textarea>
              </td>
            </tr>
          </table>
        </div>
        <div class="form__button">
          <button class="form__button-submit" type="submit">送信</button>
          <a href="{{ route('contact.index', $data) }}" class="form__button-link">修正</a>
        </div>
        <!-- <form action="{{ route('contact.index') }}" method="GET">
          <button type="submit">修正する</button>
        </form> -->
      </form>
    </div>
  </main>
</body>

</html>
@endsection