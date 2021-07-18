@extends('layouts.main_app')

@section('content')
    <div class="row d-flex">
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
                    @include('user_follow.follow_btn')
                </div>
            </div>
        <div class="col">
            @include('users.navtabs')
            @include('users.users')
        </div>
        </aside>
        <div class="col-6">
            @if (Auth::id() == $user->id)
                {{-- 投稿フォーム --}}
                @include('posts.form')
            @endif
            {{-- 投稿一覧 --}}
            @include('posts.posts')
        </div>
    </div>
@endsection