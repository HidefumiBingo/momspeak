

@if(!Request::routeIs('posts.index'))
    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
      <li class="nav-item">
        <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">投稿一覧</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">いいね一覧</a>
      </li>
    </ul>    
@endif
    
<div class="tab-content" id="pills-tabContent">
  <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
    @if (count($posts) > 0)
        <ul class="list-unstyled">
            @foreach ($posts as $post)
                <li class="media mb-3">
                    {{-- 投稿の所有者のメールアドレスをもとにGravatarを取得して表示 --}}
                    <img class="mr-2 rounded" src="{{ Gravatar::get($post->user->email, ['size' => 50]) }}" alt="">
                    <div class="media-body">
                        <div>
                            {{-- 投稿の所有者のユーザ詳細ページへのリンク --}}
                            {!! link_to_route('users.show', $post->user->name, ['user' => $post->user->id]) !!}
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
                                @include('posts.show_btn')
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
            @endforeach
        </ul>
        {{-- ページネーションのリンク --}}
        {{ $posts->links() }}
    @endif
　</div>
　
  <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
    @if(!Request::routeIs('posts.index'))
        @if (count($favorites) > 0)
            <ul class="list-unstyled">
                @foreach ($favorites as $favorite)
                    <li class="media mb-3">
                        {{-- 投稿の所有者のメールアドレスをもとにGravatarを取得して表示 --}}
                        <img class="mr-2 rounded" src="{{ Gravatar::get($favorite->user->email, ['size' => 50]) }}" alt="">
                        <div class="media-body">
                            <div>
                                {{-- 投稿の所有者のユーザ詳細ページへのリンク --}}
                                {!! link_to_route('users.show', $favorite->user->name, ['user' => $favorite->user->id]) !!}
                                <span class="text-muted fs-6 d-block">{{ $favorite->created_at }}</span>
                            </div>
                            <div>
                                {{-- 投稿内容 --}}
                                <p class="mb-0 p-1">{!! nl2br(e($favorite->content)) !!}</p>
                            </div>
                            <div class="favorite-btn d-flex justify-content-end">
                                <div>
                                    @include('posts.f_favorite_btn')
                                </div>
                                <div>
                                    @include('posts.f_edit_btn')
                                </div>
                                <div>
                                    @include('posts.f_delete_btn')
                                </div>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
            {{-- ページネーションのリンク --}}
            {{ $favorites->links() }}
        @endif
    @endif
 </div>
</div>
    
