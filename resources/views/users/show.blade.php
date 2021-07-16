@extends('layouts.app')

@section('content')
    <div class="row">
        <aside class="col-6">
            <div class="d-flex">
                <div class="card rounded-3">
                    <div class="card-body">
                        {{-- ユーザのメールアドレスをもとにGravatarを取得して表示 --}}
                        <img class="rounded img-fluid" src="{{ Gravatar::get($user->email, ['size' => 500]) }}" alt="">
                    </div>
                        <p class="intro-name">{{ $user->name }}</h3>
                </div>
                <div class="intro">
                    <p class="intro-text">
                        introductionこの文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。この文章はダミーです。文字の大きさ、量、字間、行間等を
                    </p>
                </div>
            </div>
        <div class="col">
            <ul class="nav nav-tabs nav-justified mb-3">
                {{-- ユーザ詳細タブ --}}
                <li class="nav-item"><a href="#" class="nav-link">ユーザー</a></li>
                {{-- ユーザ詳細タブ --}}
                <li class="nav-item"><a href="#" class="nav-link">マッチング</a></li>
                {{-- フォロー一覧タブ --}}
                <li class="nav-item"><a href="#" class="nav-link">フォロー</a></li>
                {{-- フォロワー一覧タブ --}}
                <li class="nav-item"><a href="#" class="nav-link">フォロワー</a></li>
            </ul>
        </div>
        </aside>
    </div>
@endsection