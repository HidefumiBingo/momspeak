    @if (Auth::user()->is_favorite($post->id))
        {{-- いいねを外すボタンのフォーム --}}
        {!! Form::open(['route' => ['favorites.unfavorite', $post->id], 'method' => 'delete']) !!}
            {!! Form::submit('はずす', ['class' => "btn btn-danger btn-sm btn-good good"]) !!}
        {!! Form::close() !!}
    @else
        {{-- いいねボタンのフォーム --}}
        {!! Form::open(['route' => ['favorites.favorite', $post->id]]) !!}
            {!! Form::submit('いいね', ['class' => "btn btn-primary btn-sm btn-good"]) !!}
        {!! Form::close() !!}
    @endif
    