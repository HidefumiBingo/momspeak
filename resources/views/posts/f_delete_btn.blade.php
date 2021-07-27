                                    @if (Auth::id() == $favorite->user_id)
                                        {{-- 投稿削除ボタンのフォーム --}}
                                        {!! Form::open(['route' => ['posts.destroy', $favorite->id], 'method' => 'delete']) !!}
                                            {!! Form::submit('Delete', ['class' => 'btn btn-destroy btn-danger btn-sm']) !!}
                                        {!! Form::close() !!}
                                    @endif
