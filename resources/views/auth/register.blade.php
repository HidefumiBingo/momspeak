@extends('layouts.app')

@section('content')
    <div class="text-center">
        <h1>会員登録</h1>
    </div>

    <div class="row">
        <div class="col-sm-6 offset-sm-3">

            {!! Form::open(['route' => 'signup.post']) !!}
                <div class="form-group">
                    {!! Form::label('name', 'お名前') !!}
                    {!! Form::text('name', null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('email', 'メールアドレス') !!}
                    {!! Form::email('email', null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('password', 'パスワード') !!}
                    {!! Form::password('password', ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('password_confirmation', 'パスワード確認') !!}
                    {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
                </div>

                <div class="form-group d-flex flex-row">
                    <div class="form-type d-flex">
                        {!! Form::radio('type', '1', true,['class' => 'form-control','id' => 'type-papa']) !!}
                        {!! Form::label('type-papa', 'パパ') !!}
                    </div>
                    <div class="form-type d-flex">
                        {!! Form::radio('type', '2', false,['class' => 'form-control','id' => 'type-mama']) !!}
                        {!! Form::label('type-mama', 'ママ') !!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('birthday', 'お子様のお誕生日') !!}
                        <div class="form-sel d-flex">
                            {!! Form::selectRange('birthday_year', 2015,2025, '',['class' => 'form-control']) !!}
                            <p>年</p>
                        </div>
                        <div class="form-sel d-flex">
                            {!! Form::selectRange('birthday_month', 1,12, '',['class' => 'form-control']) !!}
                            <p>月</p>
                        </div>
                </div>

                <div class="form-group">
                    {!! Form::label('content', '自己紹介文') !!}
                    {!! Form::textarea('content',null, ['class' => 'form-control']) !!}
                </div>
                
                {!! Form::submit('会員登録する', ['class' => 'btn btn-block']) !!}
            {!! Form::close() !!}
            
        </div>
    </div>
@endsection