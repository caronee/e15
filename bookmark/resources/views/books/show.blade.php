<!doctype html>
<html lang='en'>
<head>
    <title>{{ $title }}</title>
    <meta charset='utf-8'>
    <link href='/css/bookmark.css' type='text/css' rel='stylesheet'>
</head>
<body>

    <header>
        <a href='/'><img src='/images/bookmark-logo@2x.png' id='logo' alt='Bookmark Logo'></a>
    </header>

    <section>
        <h1>{{ $title }}</h1>
        @if($bookFound)
        <p>
            Details about this book will go here... <?php echo $title; ?>
            Another title <?= $title;?>
        </p>
        @else
        <p>
            Book not found
        </p>
        @endif



    </section>

    <footer>
        &copy; Bookmark, Inc.
    </footer>

</body>
</html>
