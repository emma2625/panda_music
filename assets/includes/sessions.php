
<?php 
    session_start();
   

   function errorMessage(){
        if (isset($_SESSION['errormessage'])) {
            $output = "<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">
            <strong>";

            $output .= htmlentities($_SESSION['errormessage']);

            $output .="</strong>
            
        </div>";

            $_SESSION['errormessage'] = null;
           return $output;
        }
   }

   function successMessage(){
    if (isset($_SESSION['successmessage'])) {
        $output = "<div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">
        <strong>";

        $output .= htmlentities($_SESSION['successmessage']);

        $output .="</strong>
        </div>";

        $_SESSION['successmessage'] = null;
       return $output;
    }
}


function auth(){
    if (!isset($_SESSION['id'])) {
        header('Location: ../auth');
    }
}