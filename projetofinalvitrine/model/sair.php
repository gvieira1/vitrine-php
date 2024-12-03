<?php
    session_start();
    session_destroy();
    //header('Location:login.php');
    echo"<script> window.location.href = '../view/login.php';</script>";
?>