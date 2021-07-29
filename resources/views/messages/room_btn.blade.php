            @if(\Auth::user()->matching($user->id) == true)
                    <div class="room-btn">
                        {{-- roomページへのリンク --}}
                        <p>{!! link_to_route('messages.show','Room',[$user->id],['class' => ['btn btn-sm ']]) !!}</p>
                    </div>
            @endif
