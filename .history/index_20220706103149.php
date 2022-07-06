<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TheLibrary</title>
    <!-- bootstrap link -->

    <!-- css link -->
    
</head>
<body>
    <?php
        
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
    ?>
</body>
</html>