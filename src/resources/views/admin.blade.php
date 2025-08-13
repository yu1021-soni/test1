<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Libertinus+Serif:ital,wght@0,400;0,600;0,700;1,400;1,600;1,700&display=swap" rel="stylesheet">
  
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}" />
</head>
<body>
    <header class="header">
        <div class="header__inner">
            <a href="" class="header__logo">FashionablyLate</a>

            @auth
            {{-- ↓ ログアウト（POST） --}}
            <a href="{{ route('logout') }}" class="header__login"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
            @csrf
            </form>
            @endauth
        </div>
    </header>

    <main>
        <form action="{{ route('admin') }}" class="search-form" method="get">
        <div class="search___group">
            <div class="search__input--text">
                <input type="text" class="search-form__item-input" name="keyword" placeholder="名前やメールアドレスを入力してください">
            </div>
            <div class="search__input--select">
                <select class="search-form__item-select" name="gender">
                <option value="" selected disabled>性別</option>
                <option value="1">男性</option>
                <option value="2">女性</option>
                <option value="3">その他</option>
                <option value="">全て</option>
            </select>
            </div>
            <div class="search__input--select">
                <select class="search-form__item-select" name="content">
                <option value="" selected disabled>お問い合わせの種類</option>
                <option value="商品のお届けについて">商品のお届けについて</option>
                <option value="商品の交換について">商品の交換について</option>
                <option value="商品トラブル">商品トラブル</option>
                <option value="ショップへのお問い合わせ">ショップへのお問い合わせ</option>
                <option value="その他">その他</option>
            </select>
            </div>
            <div class="search__input--text">
                <input type="date" name="date" placeholder="年/月/日">
            </div>
            <div class="search__input--button">
                <button class="search__input--button-search">検索</button>
                <a href="{{ route('admin') }}" class="btn-reset">リセット</a>
            </div>
        </div>
        </form>

        <div class="contact__group">

            <table class="contact__group-table">
                <tr class="contact__group-header">
                    <div class="contact__group-header-title">
                        <th>お名前</th>
                        <th>性別</th>
                        <th>メールアドレス</th>
                        <th>お問い合わせの種類</th>
                    </div>
                </tr>
                @foreach ($contacts as $contact)
                <tr class="contact__group-contents">
                    <td class="contact__group-content-name">
                        {{ $contact->last_name }} {{ $contact->first_name }}
                    </td>
                    <td class="contact__group-content-gender">
                        @if ($contact->gender == 1)
                            男性
                        @elseif ($contact->gender == 2)
                            女性
                        @elseif ($contact->gender == 3)
                            その他
                        @endif
                    </td>
                    <td class="contact__group-content-email">
                        {{ $contact->email }}
                    </td>
                    <td class="contact__group-content-select">
                        {{ $contact->category->content }}
                    </td>
                </tr>
                @endforeach
            </table>
            {{ $contacts->links() }}

        </div>

    </main>

</body>
</html>