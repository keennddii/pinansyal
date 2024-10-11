<?php
session_start();

if(isset($_SESSION['user_id']))
{
    unset($_SESSION['user_id']);
}

header("Location:login.php");
die;


//<div class="d-flex justify-content-center py-4">
               // <a href="3" class="logo d-flex align-items-center w-auto">
               // <img src="assets/img/jvd.jpg" alt="Logo">
               // <br>
                  
                  
                //  <span class="d-none d-lg-block">Financial Login</span>
               // </a>
             // </div><!-- End Logo -->