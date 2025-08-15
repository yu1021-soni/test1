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
        <div class="search__group">
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
                    <td>
                    {{-- 現在の検索クエリを維持しつつ modal=ID を付与 --}}
                        <a class="btn-detail" href="{{ route('admin', array_merge(request()->query(), ['modal' => $contact->id])) }}">詳細</a>
                    </td>
                </tr>
                @endforeach
            </table>
            {{ $contacts->links() }}

        </div>

    </main>


    @if ($openContact)
    <div class="modal-overlay"></div>
    <div class="modal" role="dialog" aria-modal="true" aria-labelledby="modalTitle">
        <div class="modal__content">
            <div class="modal__header">
                <a class="modal__close" href="{{ route('admin', request()->except('modal')) }}" aria-label="閉じる">×</a>
            </div>

            <dl class="modal__dl">
                <dt>お名前</dt>
                <dd>
                    {{ $openContact->last_name }} {{ $openContact->first_name }}
                </dd>
                <dt>性別</dt>
                <dd>
                    @if ($openContact->gender == 1) 男性
                    @elseif ($openContact->gender == 2) 女性
                    @else その他
                    @endif
                </dd>
                <dt>メールアドレス</dt>
                <dd>{{ $openContact->email }}</dd>
                <dt>電話番号</dt>
                <dd>{{ $openContact->tel }}</dd>
                <dt>住所</dt>
                <dd>{{ $openContact->address }}</dd>
                <dt>建物名</dt>
                <dd>{{ $openContact->building }}</dd>
                <dt>お問い合わせの種類</dt><dd>{{ $openContact->category->content ?? '' }}</dd>
                <dt>お問い合わせ内容</dt>
                <dd class="pre-wrap">{{ $openContact->detail }}</dd>
            </dl>

            <div class="modal__footer">
                <form action="{{ route('contacts.destroy', $openContact->id) }}" method="POST" onsubmit="return confirm('本当に削除しますか？');">
                @csrf
                @method('DELETE')
                    <button type="submit" class="button__delete">削除</button>
                </form>
                <a class="btn" href="{{ route('admin', request()->except('modal')) }}">閉じる</a>
            </div>
        </div>
    </div>
@endif


</body>
</html>