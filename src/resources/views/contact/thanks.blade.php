<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title></title>
  <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/thanks.css') }}" />
</head>

  <main>
    <div class="thanks__content">
      <div class="thanks__heading">
        <h2>お問い合わせありがとうございました</h2>
        <a href="{{ route('contact.index') }}">HOME</a>
        <!-- <div class="home__button">
            <form action="{{ route('contact.index') }}" method="GET">
              <button type="submit" class="home__button-submit">HOME</button>
            </form>
        </div> -->
      </div>
    </div>
  </main>
</body>

</html>
