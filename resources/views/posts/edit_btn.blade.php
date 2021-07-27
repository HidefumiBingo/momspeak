                                @if (Auth::id() == $post->user_id)
                                    {{-- 投稿編集ボタンのフォーム --}}
                                    {!! Form::open(['route' => ['posts.edit', $post->id], 'method' => 'get']) !!}
                                        {!! Form::submit('編集', ['class' => 'btn btn-destroy btn-danger btn-sm']) !!}
                                    {!! Form::close() !!}
                                @endif
