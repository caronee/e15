<!doctype html>
<html lang='en'>
<head>
    <title>@yield('title', 'Catalogue Minerals and Rocks')</title>
    <meta charset='utf-8'>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


    <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css' integrity='sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z' crossorigin='anonymous'>


    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">

    <link href="https://fonts.googleapis.com/css2?family=Indie+Flower&family=Sriracha&display=swap" rel="stylesheet">



    <link href='/css/ctms.css' rel='stylesheet'>


    @yield('head')
</head>
<body>


    <header>

        <nav>
            <ul>

                <h2 class="navbar-text">CATALOGUE OF TYPE MINERAL SPECIMENS (CTMS) </h2>


                <li><a href='/'>Home</a></li>

                @if(Auth::user())
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Minerals
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="/minerals">List of Minerals</a>
                        <a class="dropdown-item" href="/minerals/create">Create Minerals</a>


                    </div>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Repositories
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="/repositories">List of Repositories</a>
                        <a class="dropdown-item" href="/repositories/create">Create Repository</a>

                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Specimen
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="/specimens">List of Specimens</a>
                        <a class="dropdown-item" href="/specimens/create">Create specimens</a>

                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="/pages/search/">Search specimens</a>

                    </div>
                </li>

                @else
                <li><a href='/register' dusk='register-link'>Register</a></li>

                @endif
                <li><a href='/help'>Help</a></li>

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

        @if(!Auth::user())
        <a href='/login'><img class="img-fluid" dusk='register-photo' src='/images/2.jpg'></a>


        @else
        <a href=' /'><img src='/images/1.jpg' id='logo' alt='elbaite'></a>

        @endif
        </h2>
    </header>

    <section id='main'>
        @yield('content')
    </section>

    <footer>

        <a href="mailto: {{ config('mail.supportEmail')}}">Contact Us</a>




    </footer>

</body>
</html>
