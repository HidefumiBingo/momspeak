@extends('layouts.main_app')

@section('content')

    <h1>id: {{ $post->id }} のメッセージ編集ページ</h1>

    <div class="row">
        <div class="col-12 offset-sm-3 col-sm-6">
            {!! Form::model($post, ['route' => ['posts.update', $post->id], 'method' => 'put']) !!}

                <div class="form-group">
                    {!! Form::label('content', 'メッセージ:') !!}
                    {!! Form::text('content', null, ['class' => 'form-control']) !!}
                </div>

                {!! Form::submit('更新', ['class' => 'btn btn-primary']) !!}

            {!! Form::close() !!}
        </div>
    </div>

@endsection