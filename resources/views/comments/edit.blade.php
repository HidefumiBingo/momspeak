@extends('layouts.app')

@section('content')

            <h1> {{ $user->name }} ：へのコメント編集ページ</h1>
        
            <div class="row">
                <div class="col-6">
                    {!! Form::open( ['route' => ['comments.update', $comment->id], 'method' => 'put']) !!}
        
                        <div class="form-group">
                            {!! Form::label('content', 'メッセージ:') !!}
                            {!! Form::text('content', $comment->content, ['class' => 'form-control']) !!}
                        </div>
        
                        {!! Form::submit('更新', ['class' => 'btn btn-primary']) !!}
        
                    {!! Form::close() !!}
                </div>
            </div>
    
@endsection