{!! Form::open(['route' => ['comments.comment',$post->id]]) !!}
    <div class="form-group">
        {!! Form::textarea('content', null, ['class' => 'form-control', 'rows' => '2']) !!}
        {!! Form::submit('コメントする', ['class' => 'btn btn-primary btn-block']) !!}
    </div>
{!! Form::close() !!}
