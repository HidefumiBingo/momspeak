                                    {{-- 投稿編集ボタンのフォーム --}}
                                    {!! Form::open(['route' => ['posts.show', $post->id], 'method' => 'get']) !!}
                                        {!! Form::submit('詳細', ['class' => 'btn btn-destroy btn-danger btn-sm']) !!}
                                    {!! Form::close() !!}
