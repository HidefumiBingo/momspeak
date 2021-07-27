                <div class="card rounded-3">
                    <div class="card-body">
                        {{-- ユーザのメールアドレスをもとにGravatarを取得して表示 --}}
                        <img class="rounded img-fluid" src="{{ Gravatar::get($user->email, ['size' => 500]) }}" alt="">
                    </div>
                        <h3 class="intro-name">{{ $user->name }}</h3>
                        <p class="intro-birth"><?php echo $age; ?>の
                            @if($user->type == '1')
                            パパ
                            @else
                            ママ
                            @endif
                        </p>
                </div>

                <div class="intro">
                    <p class="intro-text">
                        {{ $user->content }}
                    </p>
                    {{-- メッセージ編集ページへのリンク --}}
                    @if(Auth::id() == $user->id)
                        {!! link_to_route('users.edit', '自己紹介文を編集', [$user->id], ['class' => 'btn btn-light']) !!}
                        @include('user_follow.follow_btn')
                    @endif
                </div>
