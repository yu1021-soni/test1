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
  <link rel="stylesheet" href="{{ asset('css/index.css') }}" />
</head>

<body>
  <header class="header">
    <div class="header__inner">
      <a href="" class="header__logo">FashionablyLate</a>
    </div>
  </header>

  <main>
    <div class="contact-form__content">
      <div class="contact-form__heading">
        <h2>Contact</h2>
      </div>

    <form action="/contacts/confirm" class="form" method="post">
        @csrf
        <div class="form__group">
          <div class="form__group-title">
            <span class="form__label--item">お名前</span>
            <span class="form__label--required">※</span>
          </div>
          <div class="form__group-content">
            <div class="form__input--text">
              <input type="text" name="last_name" placeholder="例:山田" value="{{ old('last_name') }}"/>
              <input type="text" name="first_name" placeholder="例:太郎" value="{{ old('first_name') }}"/>
            </div>
            <div class="form__error">
              @error('last_name')
               {{ $message }}
              @enderror
              @error('first_name')
               {{ $message }}
              @enderror
            </div>
          </div>
        </div>
        <div class="form__group">
          <div class="form__group-title">
            <span class="form__label--item">性別</span>
            <span class="form__label--required">※</span>
          </div>
          <div class="form__group-content">
            <div class="form__input--radio">
              <label>
               <input type="radio" name="gender" value="1" {{ old('gender', 1) == 1 ? 'checked' : '' }} >男性
              </label>
              <label>
               <input type="radio" name="gender" value="2" {{ old('gender') == 2 ? 'checked' : '' }} >女性
              </label>
              <label>
               <input type="radio" name="gender" value="3" {{ old('gender') == 3 ? 'checked' : '' }} >その他
              </label>
            </div>
            <div class="form__error">
              @error('gender')
               {{ $message }}
              @enderror
            </div>
          </div>
        </div>
        <div class="form__group">
          <div class="form__group-title">
            <span class="form__label--item">メールアドレス</span>
            <span class="form__label--required">※</span>
          </div>
          <div class="form__group-content">
            <div class="form__input--text">
              <input type="text" name="email" placeholder="例:test@example.com" value="{{ old('email') }}"/>
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
            <span class="form__label--item">電話番号</span>
            <span class="form__label--required">※</span>
          </div>
          <div class="form__group-content">
            <div class="form__input--text">
              <input type="text" name="tel" placeholder="例:08012345678" value="{{ old('tel') }}"/>
            </div>
            <div class="form__error">
              @error('tel')
               {{ $message }}
              @enderror
            </div>
          </div>
        </div>
        <div class="form__group">
          <div class="form__group-title">
            <span class="form__label--item">住所</span>
            <span class="form__label--required">※</span>
          </div>
          <div class="form__group-content">
            <div class="form__input--text">
              <input type="text" name="address" placeholder="例:東京都渋谷区千駄ヶ谷１−２−３" value="{{ old('address') }}"/>
            </div>
            <div class="form__error">
              @error('address')
               {{ $message }}
              @enderror
            </div>
          </div>
        </div>
        <div class="form__group">
          <div class="form__group-title">
            <span class="form__label--item">建物名</span>
          </div>
          <div class="form__group-content">
            <div class="form__input--text">
              <input type="text" name="building" placeholder="例:千駄ヶ谷マンション101" value="{{ old('building') }}"/>
            </div>
            <div class="form__error">
              @error('building')
               {{ $message }}
              @enderror
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
              <select name="select">
                <option value="" selected disabled {{ old('select') === null ? 'selected' : '' }}>選択してください</option>
                <option value="1.商品のお届けについて" {{ old('select') === '1.商品のお届けについて' ? 'selected' : '' }}>1.商品のお届けについて</option>
                <option value="2.商品の交換について" {{ old('select') === '2.商品の交換について' ? 'selected' : '' }}>2.商品の交換について</option>
                <option value="3.商品トラブル" {{ old('select') === '3.商品トラブル' ? 'selected' : '' }}>3.商品トラブル</option>
                <option value="4.ショップへのお問い合わせ" {{ old('select') === '4.ショップへのお問い合わせ' ? 'selected' : '' }}>4.ショップへのお問い合わせ</option>
                <option value="5.その他" {{ old('select') === '5.その他' ? 'selected' : '' }}>5.その他</option>
              </select>
            </div>
            <div class="form__error">
              @error('select')
               {{ $message }}
              @enderror
            </div>
          </div>
        </div>
        <div class="form__group">
          <div class="form__group-title">
            <span class="form__label--item">お問い合わせ内容</span>
            <span class="form__label--required">※</span>
          </div>
          <div class="form__group-content">
            <div class="form__input--textarea">
              <textarea name="detail" placeholder="お問い合わせ内容をご記載ください">{{ old('detail') }}</textarea>
            </div>
            <div class="form__error">
              @error('detail')
               {{ $message }}
              @enderror
            </div>
          </div>
        </div>

        <div class="form__button">
          <button class="form__button-submit" type="submit">確認画面</button>
        </div>
    </form>
  </main>
</body>

</html>