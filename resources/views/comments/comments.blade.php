    <h2>コメント一覧</h2>
    
    @if (count($comments) > 0)
        <ul class="list-unstyled">
            @foreach ($comments as $comment)
                <li class="media mb-3">
                    {{-- 投稿の所有者のメールアドレスをもとにGravatarを取得して表示 --}}
                    <img class="mr-2 rounded" src="{{ Gravatar::get($comment->email, ['size' => 50]) }}" alt="">
                    <div class="media-body">
                        <div>
                            {{-- 投稿の所有者のユーザ詳細ページへのリンク --}}
                            {!! link_to_route('users.show','⇨ '. $comment->name, ['user' => $comment->id]) !!}
                            <span class="text-muted fs-6 d-block">{{ $comment->pivot->created_at }}</span>
                        </div>
                        <div>
                            {{-- 投稿内容 --}}
                            <p class="mb-0 p-1">{!! nl2br(e($comment->pivot->content)) !!}</p>
                        </div>
                        <div class="post-btn d-flex justify-content-end">
                            <div>
                                @include('comments.edit_btn')
                            </div>
                            <div>
                                @include('comments.delete_btn')
                            </div>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
        {{-- ページネーションのリンク --}}
        {{ $comments->links() }}
    @endif
