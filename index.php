<?php

/*
Name: Rut Patel
Date: 17-September-2020
WEBD-3201-02
*/

include "./includes/header.php";

// $message = isset($_SESSION['messagee'])?$_SESSION['message']:"";

// setMessage("You have successfully logged in");;
// $message = flashMessage();

if(empty($_SESSION['id']) || $_SESSION['id'] == ''){
    $message = "";
}
else{
                $message = "You have successfully logged in.";    
            }
            


?>
<h2><?php echo $message; ?></h2>
<h1 class="cover-heading">Cover your page.</h1>

<p class="lead">Cover is a one-page template for building simple and beautiful home pages. Download, edit the text, and add your own fullscreen background photo to make it your own.</p>
<p class="lead">
    <a href="#" class="btn btn-lg btn-secondary">Learn more</a>
</p>
<?php
include "./includes/footer.php";
?>    