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

      <form action="/contacts/thanks" class="form" method="post">
        @csrf
        <div class="confirm-table">
          <table class="confirm-table__inner">

            <tr class="confirm-table__row">
              <th class="confirm-table__header">お名前</th>
                <td class="confirm-table__text">
                  <div class="name-inline">
                    <input type="text" name="last_name" value="{{ $contact['last_name'] }}" readonly />
                    <input type="text" name="first_name" value="{{ $contact['first_name'] }}" readonly />
                  </div>
                </td>
            </tr>
            <tr class="confirm-table__row">
              <th class="confirm-table__header">性別</th>
                <td class="confirm-table__text">
                  @php
                    $genderText = [
                      1 => '男性',
                      2 => '女性',
                      3 => 'その他'
                    ][$contact['gender']] ?? '';
                  @endphp
                  <input type="text" value="{{ $genderText }}" readonly>
                  <input type="hidden" name="gender" value="{{ $contact['gender'] }}">
                </td>
            </tr>
            <tr class="confirm-table__row">
              <th class="confirm-table__header">メールアドレス</th>
                <td class="confirm-table__text">
                  <input type="text" name="email" value="{{ $contact['email'] }}" readonly />
                </td>
            </tr>
            <tr class="confirm-table__row">
              <th class="confirm-table__header">電話番号</th>
                <td class="confirm-table__text">
                  <input type="text" name="tel" value="{{ $contact['tel'] }}" readonly />
                </td>
            </tr>
            <tr class="confirm-table__row">
              <th class="confirm-table__header">住所</th>
                <td class="confirm-table__text">
                  <input type="text" name="address" value="{{ $contact['address'] }}" readonly />
                </td>
            </tr>
            <tr class="confirm-table__row">
              <th class="confirm-table__header">建物名</th>
                <td class="confirm-table__text">
                  <input type="text" name="building" value="{{ $contact['building'] }}" readonly />
                </td>
            </tr>
            <tr class="confirm-table__row">
              <th class="confirm-table__header">お問い合わせの種類</th>
                <td class="confirm-table__text">
                  <input type="text" name="select" value="{{ $contact['select'] }}" readonly />
                </td>
            </tr>
            <tr class="confirm-table__row">
              <th class="confirm-table__header">お問い合わせ内容</th>
                <td class="confirm-table__text">
                  <input type="text" name="detail" value="{{ $contact['detail'] }}" readonly />
                </td>
            </tr>

          </table>
        </div>
        <div class="button-group">
          <form action="/contacts/thanks" class="inline-form" method="post">
            @csrf
            <button class="form__button-submit" type="submit">送信</button>
          </form>
          <form action="{{ route('contacts.back') }}" method="post" class="inline-form">
            @csrf
            @foreach($contact as $key => $value)
              <input type="hidden" name="{{ $key }}" value="{{ $value }}">
            @endforeach
            <button type="submit" class="correction">修正</button>
          </form>
        </div>
    </main>
</body>

</html>