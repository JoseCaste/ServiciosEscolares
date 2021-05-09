<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UNAM</title>
    <link rel="shortcut icon" href="./logo_unam_.jpg">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <!------ Include the above in your HEAD tag ---------->
    <link href="../../css/styles.css" rel="stylesheet" type="text/css"/>

</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-md-4 col-md-offset-4">
                <h1 class="text-center login-title"><strong>Servicios escolares - UNAM </strong></h1>
                <div class="account-wall">
                    <div style="align-items: center;">                   
                        <img class="profile-img" src="./logo_unam_.png" alt="">
                    </div>

                    <form class="form-signin" method="POST" action="../../ServiciosEscolares/controller/index_controller.php">
                    <div class="form-group">
                    <input id="username" name="username" type="text" class="form-control" placeholder="Usuario" required autofocus>
                    </div>
                    <div class="form-group">
                    <input id="password" name="password" type="password" class="form-control" placeholder="Contraseña" value="12345" required>
                    </div>
                        <div class="form-group">
                        <button class="btn btn-lg btn-primary btn-block" type="submit">
                            Iniciar sesión</button>
                        </div>
                    
                        
                        <label class="checkbox pull-left">
                            <input type="checkbox" value="remember-me">
                            Recordarme
                        </label>
                       
                    </form>
                </div>
                <a href="#" class="text-center new-account">Crear una cuenta</a>
                        <?php
                        if (isset($_SESSION['invalid'])) {
                            $invalid = $_SESSION['invalid'];
                            echo "<span href='#' class='text-center new-account' style='color:red'>$invalid</span>";
                        }

                        ?>
            </div>
        </div>
    </div>
</body>

</html>