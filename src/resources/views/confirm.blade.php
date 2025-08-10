<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Contact Form</title>
  <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/confirm.css') }}" />
</head>

<body>
  <header class="header">
    <div class="header__inner">
      FashionablyLate
    </div>
  </header>

  <main>
    <div class="confirm__content">
      <div class="confirm__heading">
        <h2>confirm</h2>
      </div>

      <form action="" class="form">
        <div class="confirm-table">
            <table class="confirm-table__inner">

              <tr class="confirm-table__row">
                <th class="confirm-table__header">お名前</th>
                <td class="confirm-table__text">
                  <input type="text" name="last_name" value="{{ $contact['last_name'] }}" readonly />
                  <input type="text" name="first_name" value="{{ $contact['first_name'] }}" readonly />
                </td>
              </tr>
              
            </table>
        </div>
      </form>
    </div>

    <div class="form__button">
          <button class="form__button-submit" type="submit">送信</button>
    </div>


  </main>

</body>

</html>