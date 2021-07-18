@extends('layouts.main_app')
@if(!Auth::check())
        <header>
            <nav class="navbar navbar-expand-sm navbar-dark">
                {{-- トップページへのリンク --}}
                <a class="navbar-brand" href="/">momspeak</a>
        
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#nav-bar">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="nav-bar">
                    <ul class="navbar-nav mr-auto"></ul>
                    <ul class="navbar-nav">
                            <li class="nav-item"><a href="#top">トップ</a></li>
                            <li class="nav-item"><a href="#use">使い方</a></li>
                            <li class="nav-item"><a href="#contact">お問い合わせ</a></li>
                    </ul>
                </div>
            </nav>
        </header>
        
        <section class="top text-light" id="top">
            <div class="container">
                <div class="row">
                    <div class="col-7 top-left">
                        <h1>momspeak</h1>
                        <p class="top-text">
                            momspeakは、子育てするママやパパ達が直接会うことなく、ネット上だけで繋がるサービスです。<br>
                            子供や自らの近況を投稿したり、悩みや心配事を共有したり、自らの経験を生かして困っている方にアドバイスを送るなど使い方は自由です。<br>
                            
                        </p>
                        <div class="top-btn">
                            {{-- ユーザ登録ページへのリンク --}}
                            {!! link_to_route('signup.get', '会員登録', [], ['class' => 'btn btn-lg']) !!}
                            {{-- ログインページへのリンク --}}
                            {!! link_to_route('login', 'ログイン', [], ['class' => 'btn btn-lg']) !!}
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <section class="use" id="use">
            <div class="container">
            <h2 class="sec-tit text-center">使い方</h2>
                <div class="row-cols-2">
                    <div class="use-items d-flex flex-wrap">
                        <div class="use-item m-5 col">
                            <div class="card" style="width: 18rem;">
                                <img src="..." class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">投稿する</h5>
                                    <p class="card-text">近況や悩み、アドバイスといった子供に関することを投稿してみましょう！</p>
                                </div>
                            </div>
                        </div>
                        <div class="use-item m-5 col">
                            <div class="card" style="width: 18rem;">
                                <img src="..." class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">お気に入り</h5>
                                    <p class="card-text">気に入った投稿をお気に入りに登録してみましょう！</p>
                                </div>
                            </div>
                        </div>
                        <div class="use-item m-5 col">
                            <div class="card" style="width: 18rem;">
                                <img src="..." class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">フォロー</h5>
                                    <p class="card-text">気に入ったユーザーをフォローしてみましょう！</p>
                                </div>
                            </div>
                        </div>
                        <div class="use-item m-5 col">
                            <div class="card" style="width: 18rem;">
                                <img src="..." class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">マッチング</h5>
                                    <p class="card-text">相互にフォローすることで２人だけのチャットルームでの会話ができるようになります！</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <section class="contact" id="contact">
            <div class="container">
                <h2 class="sec-tit text-center">お問い合わせ</h2>
            </div>
        </section>

@endif

@section('content')
    @if (Auth::check())
        <div class="container mt-5">
            <div class="row d-flex">
                <div class="col-4 left-contents">
                    <div class="sticky">
                        <div class="intro-area">
                            <div class="intro-img">
                                <img src="imgs/enoki.jpg">
                                <p class="intro-name">{!! link_to_route('users.userslist', Auth::user()->name, [Auth::id()], ['class' => 'nav-link']) !!}</p>
                            </div>
                        </div>
                        <div class='link-area mb-2'>
                            <ul class="list-group">
                              <li class="list-group-item">{!! link_to_route('users.userslist', 'ユーザー', [Auth::id()], ['class' => 'nav-link']) !!}</li>
                              <li class="list-group-item">{!! link_to_route('users.followings', 'フォロー', [Auth::id()], ['class' => 'nav-link']) !!}</li>
                              <li class="list-group-item">{!! link_to_route('users.followers', 'フォロワー', [Auth::id()], ['class' => 'nav-link']) !!}</li>
                              <!--<li class="list-group-item">{!! link_to_route('users.followers', 'マッチング', [Auth::id()], ['class' => 'nav-link']) !!}</li>-->
                            </ul>
                        </div>
                    @include('posts.form')
                    </div>
                </div>
                <div class="col-4 center-contents">
                  @include('posts.posts')
                </div>
                <div class="col-4 right-contents">

                </div>
            </div>
        </div>
    
    
        <!--    {{-- ナビゲーションバー --}}-->
        <!--@include('commons.navbar')-->

    @endif
@endsection