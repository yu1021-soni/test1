<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Libertinus+Serif:ital,wght@0,400;0,600;0,700;1,400;1,600;1,700&display=swap" rel="stylesheet">
  
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/login.css') }}" />
</head>
<body>
    <header class="header">
        <div class="header__inner">
            <a href="" class="header__logo">FashionablyLate</a>
            <a href="/register" class="header__register">register</a>
        </div>
    </header>

    <main>
        <div class="login-form__content">

            <div class="login-form__heading">
                <h2>Login</h2>
            </div>

            <form action="{{ route('login') }}" class="form" method="post">
            @csrf
                <div class="login__group">
                    <div class="login__group-title">
                        <span class="login__label--item">メールアドレス</span>
                    </div>
                    <div class="login__group-content">
                        <div class="login__input--text">
                            <input type="text" name="email" value="{{ old('email') }}"/>
                        </div>
                        <div class="login__error">
                            @error('email')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="login__group">
                    <div class="login__group-title">
                        <span class="login__label--item">パスワード</span>
                    </div>
                    <div class="login__group-content">
                        <div class="login__input--text">
                            <input type="password" name="password" value="{{ old('password') }}"/>
                        </div>
                        <div class="login__error">
                            @error('password')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="login__button">
                    <button class="login__button-submit" type="submit">ログイン</button>
                </div>
            </form>
        </div>

    </main>
</body>
</html>