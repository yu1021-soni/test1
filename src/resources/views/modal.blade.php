@extends('layouts.admin')
@section('modal')

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
                    <div class="modal__action">
                        <button type="submit" class="button__delete">削除</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endif

@endsection