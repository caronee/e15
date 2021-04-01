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
                <li><a href='/books'>All Books</a></li>
                <li><a href='/list'>Your List</a></li>
                <li><a href='/support'>Support</a></li>
            </ul>
        </nav>

    </header>

    <section id='main'>
        @yield('content')
    </section>

    <footer>
        &copy; Bookmark, Inc.
    </footer>

</body>
</html>
