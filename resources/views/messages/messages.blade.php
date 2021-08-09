@extends('layouts.main_app')

@section('content')
    <div class="row d-flex">
        <aside class="col-12 col-sm-6">
            <div class="d-flex">
                @include('users.card')
            </div>
        <div class="col d-none d-sm-block">
            {!! Form::open(['route' => ['messages.store',$user->id]]) !!}
                <div class="form-group">
                    {!! Form::textarea('content', null, ['class' => 'form-control', 'rows' => '3']) !!}
                    {!! Form::submit('送信する', ['class' => 'btn btn-primary btn-block']) !!}
                </div>
            {!! Form::close() !!}
        </div>
        <div>
            <div class="room-btn">
                <a>{!! link_to_route('users.userslist','退出する',[$send_user->id],['class' => ['btn btn-sm ']]) !!}</a>
            </div>
        </div>
        </aside>
        <div class="col-12 col-sm-6">
            @if(count($messages) > 0)
                    <div class="container m-sm-3">
                      <div class="chat bg-light p-4">
                @foreach($messages as $message)
                        @if($message->send_user_id == $send_user->id)
                            <div class="message d-flex flex-row-reverse align-items-start mb-4">
                              <div class="message-icon text-white fs-3">
                                <img class="rounded img-fluid rounded-circle" src="{{ Gravatar::get($send_user->email, ['size' => 500]) }}" alt="">
                              </div><!-- .message-icon -->
                              <p class="message-text p-2 me-2 mb-0 bg-info">
                                {{ $message->content }}
                              </p><!-- .message-text -->
                            </div><!-- .message -->
                        @else
                            <div class="message d-flex flex-row align-items-start mb-4">
                              <div class="message-icon text-white fs-3">
                                <img class="rounded img-fluid rounded-circle" src="{{ Gravatar::get($user->email, ['size' => 500]) }}" alt="">
                              </div><!-- .message-icon -->
                              <p class="message-text p-2 ms-2 mb-0 bg-warning">
                                {{ $message->content }}
                              </p><!-- .message-text -->
                            </div><!-- .message -->
                        @endif
                @endforeach
                      </div><!-- .chat -->
                    </div><!-- .container -->
            @endif
            
            <div class="col d-sm-none d-block">
                {!! Form::open(['route' => ['messages.store',$user->id]]) !!}
                    <div class="form-group">
                        {!! Form::textarea('content', null, ['class' => 'form-control', 'rows' => '3']) !!}
                        {!! Form::submit('送信する', ['class' => 'btn btn-primary btn-block']) !!}
                    </div>
                {!! Form::close() !!}
            </div>

        </div>
    </div>
@endsection
