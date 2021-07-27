@if (Auth::id() == $comment->id)
    {{-- 投稿編集ボタンのフォーム --}}
    {!! Form::open(['route' => ['comments.edit', $comment->pivot->id], 'method' => 'get']) !!}
        {!! Form::submit('編集', ['class' => 'btn btn-destroy btn-danger btn-sm']) !!}
    {!! Form::close() !!}
@endif