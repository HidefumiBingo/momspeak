@extends('layouts.main_app')

@section('content')
    <div class="row d-flex">
        <aside class="col-12 col-sm-6">
            <div class="d-flex">
                @include('users.card')
            </div>
        <div class="col">
                <ul class="list-unstyled">
                        <li class="media mb-3">
                            {{-- 投稿の所有者のメールアドレスをもとにGravatarを取得して表示 --}}
                            <img class="mr-2 rounded" src="{{ Gravatar::get($user->email, ['size' => 50]) }}" alt="">
                            <div class="media-body">
                                <div>
                                    {{-- 投稿の所有者のユーザ詳細ページへのリンク --}}
                                    {!! link_to_route('users.show', $user->name, ['user' => $user->id]) !!}
                                    <span class="text-muted fs-6 d-block">{{ $post->created_at }}</span>
                                </div>
                                <div>
                                    {{-- 投稿内容 --}}
                                    <p class="mb-0 p-1">{!! nl2br(e($post->content)) !!}</p>
                                </div>
                                <div class="post-btn d-flex justify-content-end">
                                    <div>
                                        @include('posts.favorite_btn')
                                    </div>
                                    <div>
                                        @include('posts.edit_btn')
                                    </div>
                                    <div>
                                        @include('posts.delete_btn')
                                    </div>
                                </div>
                            </div>
                        </li>
                </ul>
        </div>
        </aside>
        <div class="col-12 col-sm-6">
            @include('comments.form')
            @include('comments.comments')
        </div>
    </div>
@endsection