<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error de servidor</title>
    <link href="../../css/error_display.css" rel="stylesheet" type="text/css"/>
</head>

<body>
    <div class="wrapper">
        <div class="box">
            <h1>500</h1>
            <p style="color: red;">Hubo un error en el servidor.</p>
            <p><?php
            session_start();

             if(isset($_SESSION['server_error']))
             echo $_SESSION['server_error']; ?>
             </p>
            <p><a href="/ServiciosEscolares/ServiciosEscolares/view">Volver</a></p>
        </div>
    </div>
</body>

</html>