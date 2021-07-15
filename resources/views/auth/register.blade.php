@extends('layouts.app')

@section('content')
    <div class="text-center">
        <h1>Sign up</h1>
    </div>

    <div class="row">
        <div class="col-sm-6 offset-sm-3">

            {!! Form::open(['route' => 'signup.post']) !!}
                <div class="form-group">
                    {!! Form::label('name', 'Name') !!}
                    {!! Form::text('name', null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('email', 'Email') !!}
                    {!! Form::email('email', null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('password', 'Password') !!}
                    {!! Form::password('password', ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('password_confirmation', 'Confirmation') !!}
                    {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
                </div>

                <div class="form-group d-flex">
                    {!! Form::label('type-papa', 'パパ') !!}
                    {!! Form::radio('type', 'パパ', false,['class' => 'form-control','id' => 'type-papa']) !!}
                    {!! Form::label('type-mama', 'ママ') !!}
                    {!! Form::radio('type', 'ママ', false,['class' => 'form-control','id' => 'type-mama']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('birthday', 'Birthday') !!}
                    {!! Form::selectRange('birthday_year', 2015,2025, '',['class' => 'form-control']) !!}
                    {!! Form::selectRange('birthday_month', 1,12, '',['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('content', 'Content') !!}
                    {!! Form::textarea('content',null, ['class' => 'form-control']) !!}
                </div>

                {!! Form::submit('Sign up', ['class' => 'btn btn-primary btn-block']) !!}
            {!! Form::close() !!}
        </div>
    </div>
@endsection