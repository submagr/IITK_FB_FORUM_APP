<?php session_start(); ?>
 <html>

<?php
 	unset($_SESSION) ;
 	session_destroy() ;
    header("Location:signinform.php") ;
?>