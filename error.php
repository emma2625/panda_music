<?php include_once 'assets/includes/sessions.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
</head>
<body>
    <section>
        <div class="container mt-5">
            <div class="text-center">
                <h1>404 Error <br>Page Not Found</h1>
                <?php 
                    if(!isset($_SESSION['id'])){
                        echo "<a href=\"index\" class=\"btn btn-primary\">Go back</a>";
                    }else{
                        echo "<a href=\"player/dashboard\" class=\"btn btn-primary\">Go back</a>"; 
                    }
                ?>
            </div>
        </div>
    </section>
</body>
</html>