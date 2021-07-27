                                @if (Auth::id() == $favorite->user_id)
                                    {{-- 投稿編集ボタンのフォーム --}}
                                    {!! Form::open(['route' => ['posts.edit', $favorite->id], 'method' => 'get']) !!}
                                        {!! Form::submit('編集', ['class' => 'btn btn-destroy btn-danger btn-sm']) !!}
                                    {!! Form::close() !!}
                                @endif
