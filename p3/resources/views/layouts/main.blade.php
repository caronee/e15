<!doctype html>
<html lang='en'>
<head>
    <title>@yield('title', 'Minerals and Rocks')</title>
    <meta charset='utf-8'>

    <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css' integrity='sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z' crossorigin='anonymous'>


    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">

    <link href="https://fonts.googleapis.com/css2?family=Indie+Flower&family=Sriracha&display=swap" rel="stylesheet">



    <link href='/css/bookmark.css' rel='stylesheet'>


    @yield('head')
</head>
<body>


    <header>
        <a href='/'><img src='/images/ELBAITE_North America_USA_Maine_Oxford Co._Newry_Dunton Mine_131679.jpg' id='logo' alt='bookmark Logo'></a>


        <nav>
            <ul>
                <li><a href='/'>Home</a></li>
                <li><a href='/minerals'>All Minerals</a></li>
                <li><a href='/help'>Help</a></li>



            </ul>
        </nav>

    </header>

    <section id='main'>
        @yield('content')
    </section>

    <footer>

        <a href="mailto: {{ config('mail.supportEmail')}}">Contact Us</a>




    </footer>

</body>
</html>
