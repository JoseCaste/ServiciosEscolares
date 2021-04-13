<?php
    session_start();
    unset($_SESSION["username"]);
    unset($_SESSION["password"]);
    unset($_SESSION["invalid"]);
    session_destroy();

    header("Location: http://localhost:".$_SERVER['SERVER_PORT']."/ServiciosEscolares/index.php");
