<!doctype html>
<html lang='en'>
<head>
    <title>@yield('title', 'Bookmark')</title>
    <meta charset='utf-8'>

    <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css' integrity='sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z' crossorigin='anonymous'>
    <link href='/css/bookmark.css' rel='stylesheet'>

    @yield('head')
</head>
<body>

    <header>
        <a href='/'><img src='/images/bookmark-logo@2x.png' id='logo' alt='bookmark Logo'></a>

        <nav>
            <ul>
                <li><a href='/'>Home</a></li>

                @if(Auth::user())
                <li><a href='/books'>All Books</a></li>
                <li><a href='/books/create'>Add a Book</a></li>
                <li><a href='/list'>Your list</a></li>
                @endif

                <li><a href='/support'>Support</a></li>

                <li>
                    @if(!Auth::user())
                    <a href='/login'>Login</a>
                    @else
                    <form method='POST' id='logout' action='/logout'>
                        {{ csrf_field() }}
                        <a href='#' onClick='document.getElementById("logout").submit();'>Logout</a>
                    </form>
                    @endif
                </li>
            </ul>
        </nav>


    </header>

    <section id='main'>
        @yield('content')
    </section>

    <footer>
        &copy; Bookmark, Inc.
        {{config('mail.supportEmail')}}
    </footer>

</body>
</html>
