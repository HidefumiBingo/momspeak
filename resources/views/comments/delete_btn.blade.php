@if (Auth::id() == $comment->id)
    {{-- 投稿削除ボタンのフォーム --}}
    {!! Form::open(['route' => ['comments.destroy', $comment->pivot->id], 'method' => 'delete']) !!}
        {!! Form::submit('削除', ['class' => 'btn btn-destroy btn-danger btn-sm']) !!}
    {!! Form::close() !!}
@endif