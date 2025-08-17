<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Contact Form</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Libertinus+Serif:ital,wght@0,400;0,600;0,700;1,400;1,600;1,700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/confirm.css') }}" />
</head>

<body>
  <header class="header">
    <div class="header__inner">
      <a href="" class="header__logo">FashionablyLate</a>
    </div>
  </header>

  <main>
    <div class="confirm__content">
      <div class="confirm__heading">
        <h2>confirm</h2>
      </div>

      <form action="{{ url('/contacts/thanks') }}" method="post" class="form">
      @csrf

        <div class="confirm-table">
          <table class="confirm-table__inner">
            <tr>
              <th>お名前</th>
              <td>
                <div class="name-inline">
                  <input type="text" value="{{ $contact['last_name'] }}" readonly>
                  <input type="text" value="{{ $contact['first_name'] }}" readonly>
                </div>
                <input type="hidden" name="last_name"  value="{{ $contact['last_name'] }}">
                <input type="hidden" name="first_name" value="{{ $contact['first_name'] }}">
              </td>
            </tr>
            <tr>
              <th>性別</th>
              <td>
                @php
                $genderText = [1=>'男性',2=>'女性',3=>'その他'][$contact['gender']] ?? '';
                @endphp
                <input type="text" value="{{ $genderText }}" readonly>
                <input type="hidden" name="gender" value="{{ $contact['gender'] }}">
              </td>
            </tr>
            <tr>
              <th>メールアドレス</th>
              <td>
              <input type="text" value="{{ $contact['email'] }}" readonly>
              <input type="hidden" name="email" value="{{ $contact['email'] }}">
              </td>
            </tr>
            <tr>
              <th>電話番号</th>
              <td>
              <input type="text" value="{{ $contact['tel'] }}" readonly>
              <input type="hidden" name="tel" value="{{ $contact['tel'] }}">
              </td>
            </tr>
            <tr>
              <th>住所</th>
              <td>
                <input type="text" value="{{ $contact['address'] }}" readonly>
                <input type="hidden" name="address" value="{{ $contact['address'] }}">
              </td>
            </tr>
            <tr>
              <th>建物名</th>
              <td>
              <input type="text" value="{{ $contact['building'] }}" readonly>
              <input type="hidden" name="building" value="{{ $contact['building'] }}">
              </td>
            </tr>
            <tr>
              <th>お問い合わせの種類</th>
              <td>
                <input type="text" value="{{ $contact['category_label'] }}" readonly>
                <input type="hidden" name="category_id" value="{{ $contact['category_id'] }}">
                <input type="hidden" name="select" value="{{ $contact['select'] }}">
              </td>
            </tr>
            <tr>
              <th>お問い合わせ内容</th>
              <td>
                <input type="text" value="{{ $contact['detail'] }}" readonly>
                <input type="hidden" name="detail" value="{{ $contact['detail'] }}">
              </td>
            </tr>
          </table>
        </div>

        <div class="button-group">
          <button class="form__button-submit" type="submit">送信</button>
        </div>
      </form>
      <form action="{{ route('contacts.back') }}" method="post" class="inline-form">
        @csrf
        @foreach($contact as $k => $v)
        <input type="hidden" name="{{ $k }}" value="{{ $v }}">
        @endforeach
        <button type="submit" class="correction">修正</button>
      </form>
    </main>
</body>

</html>