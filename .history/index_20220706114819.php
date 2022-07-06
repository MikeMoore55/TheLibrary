<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TheLibrary</title>
    <!-- bootstrap link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- css link -->
    <link rel="stylesheet" href="./src/public/css/main.css">
</head>
<body>
    
    <?php

        /* -- header -- */
        include "/MAMP/htdocs/TheLibrary/src/includes/header.inc.php";

        
        /* -- main -- */
        $request = $_SERVER['REQUEST_URI'];
            
        $basepath = "TheLibrary/";
        $request = str_replace($basepath, "", $request);

        switch ($request) { 
            case '/':
                require __DIR__ . '/src/public/pages/sign-in.page.php';
                break;

            case '/signUp':
                require __DIR__ . '/src/public/pages/sign-up.page.php';
                break;
            
            case '/home':
                require __DIR__ . '/src/public/pages/login-pages/home.page.php';
                break;

            default:
                http_response_code(404);
                echo "page not found";
                break;
        };

        /* -- footer -- */
        include "/MAMP/htdocs/TheLibrary/src/includes/header.inc.php";

    ?>
</body>
</html>