<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>momspeak</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
        
    </head>

    <body>
        
        @if(Auth::check())
            <nav class="navbar navbar-expand-sm">
                {{-- トップページへのリンク --}}
                <a class="navbar-brand" href="/">momspeak</a>
                <div class="navbar-collapse text-right" id="nav-bar">
                    <ul class="navbar-nav mr-auto"></ul>
                        <ul class="navbar-nav">
                            {{-- ログアウトへのリンク --}}
                            <li class="logout">{!! link_to_route('logout.get', 'ログアウト') !!}</li>
                        </ul>
                    </ul>
                </div>
            </nav>
        @endif


        <div class="container">
            {{-- エラーメッセージ --}}
            @include('commons.error_messages')

            @yield('content')
        </div>

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
        <script defer src="https://use.fontawesome.com/releases/v5.7.2/js/all.js"></script>
        <!--myjquery追加-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="js/myjquery.js"></script>
    </body>
</html>