@extends('layouts.main_app')

@section('content')
    <div class="row d-flex">
        <aside class="col-12 col-sm-6">
            <div class="d-flex">
                @include('users.card')
            </div>
        <div class="col">
            @include('users.navtabs')
            @include('users.users')
        </div>
        </aside>
        <div class="col-12 col-sm-6">
            @if (Auth::id() == $user->id)
                {{-- 投稿フォーム --}}
                @include('posts.form')
            @endif
            {{-- 投稿一覧 --}}
            @include('posts.posts')
        </div>
    </div>
@endsection