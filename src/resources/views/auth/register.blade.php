<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Libertinus+Serif:ital,wght@0,400;0,600;0,700;1,400;1,600;1,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/register.css') }}" />
</head>
<body>
    <header class="header">
        <div class="header__inner">
            <a href="" class="header__logo">FashionablyLate</a>
            <a href="/login" class="header__login">login</a>
        </div>
    </header>

    <main>
        <div class="register-form__content">

            <div class="register-form__heading">
                <h2>Register</h2>
            </div>

            {{-- ★ フラッシュメッセージ表示 --}}
            @if (session('status'))
                <div class="flash flash--success">{{ session('status') }}</div>
            @endif

            <form action="/register" class="form" method="post">
                @csrf
                <div class="register__group">
                    <div class="register__group-title">
                        <span class="register__label--item">お名前</span>
                    </div>
                    <div class="register__group-content">
                        <div class="register__input--text">
                            <input type="text" name="name" placeholder="例:山田 太郎" value="{{ old('name') }}"/>
                        </div>
                        <div class="register__error">
                            @error('name')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="register__group">
                    <div class="register__group-title">
                        <span class="register__label--item">メールアドレス</span>
                    </div>
                    <div class="register__group-content">
                        <div class="register__input--text">
                            <input type="text" name="email" placeholder="例:test@example.com" value="{{ old('email') }}"/>
                        </div>
                        <div class="register__error">
                            @error('email')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="register__group">
                    <div class="register__group-title">
                        <span class="register__label--item">パスワード</span>
                    </div>
                    <div class="register__group-content">
                        <div class="register__input--text">
                            <input type="password" name="password" placeholder="例:coachtech1106" value="{{ old('password') }}"/>
                        </div>
                        <div class="register__error">
                            @error('password')
                                {{ $message }}
                            @enderror
                        </div>
                        <input type="password" name="password_confirmation" placeholder="もう一度入力">
                    </div>
                </div>

                <div class="register__button">
                    <button class="register__button-submit" type="submit">登録</button>
                </div>
            </form>

        </div>
    </main>
</body>
</html>