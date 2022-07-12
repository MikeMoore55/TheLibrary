<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TheLibrary</title>
    <link rel="icon" href="./src/public/images/book.png">
    <!-- bootstrap link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>    <!-- css link -->
    <link rel="stylesheet" href="./src/public/css/primary-stylesheet.css">
</head>
<body>
    
    <?php

        /* -- header -- */
        include "/MAMP/htdocs/TheLibrary/src/includes/header.inc.php";

        
        /* -- main -- */

        // routing
        $request = $_SERVER['REQUEST_URI'];
            
        $basepath = "TheLibrary/";
        $request = str_replace($basepath, "", $request);

        switch ($request) { 
            case '/':
                require __DIR__ . '/src/public/pages/sign-in.page.php';
                break;
    
            case '':
                require __DIR__ . '/src/public/pages/sign-in.page.php';
                break;
              
            case '/signIn':
                require __DIR__ . '/src/public/pages/sign-in.page.php';
                break;

            case '/signUp':
                require __DIR__ . '/src/public/pages/sign-up.page.php';
                break;
            
            case '/member':
                require __DIR__ . '/src/public/pages/member.page.php';
                break;

            case '/librarian':
                require __DIR__ . '/src/public/pages/librarian.page.php';
                break;
            case '/add':
                require __DIR__ . '/src/public/pages/add-book.page.php';
                break;
            case '/update':
                require __DIR__ . '/src/public/pages/update-book.page.php';
                break;
            case '/del':
                require __DIR__ . '/src/public/pages/delete-book.page.php';
                break;
            case '/restPassword':
                require __DIR__ . '/src/public/pages/reset-password.page.php';
                break;
            case '/search-librarian':
                require __DIR__ . '/src/public/pages/librarian-search.page.php';
                break;
                
            default:
                http_response_code(404);
                echo "page not found";
                break;
        };

        /* -- footer -- */
        include "/MAMP/htdocs/TheLibrary/src/includes/footer.inc.php";

    ?>
</body>
</html>