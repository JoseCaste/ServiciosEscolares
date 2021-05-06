<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Entradas y salidas</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <!------ Include the above in your HEAD tag ---------->
    <link href="../../css/styles.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-md-4 col-md-offset-4">
                <h1 class="text-center login-title"><strong>Verificador </strong></h1>
                <div class="account-wall">
                    <div style="align-items: center;">
                        <img class="profile-img" src="./clock-icon.png" alt="">
                    </div>

                    <form class="form-signin" id="formRegister">
                        <div class="form-group">
                            <input id="tarjet_number" name="tarjet_number" type="text" class="form-control" placeholder="Número de tarjeta" required autofocus>
                        </div>
                        <div class="form-group">
                            <!-- Trigger the modal with a button -->
                            <button id="register" class="btn btn-lg btn-primary btn-block" type="submit">Registrar</button>
                        </div>
                        <div class="form-group">
                            <!-- Trigger the modal with a button -->
                            <span class='text-center new-account' id="message"></span>
                        </div>
                        <div class="form-group">
                            <!-- Trigger the modal with a button -->
                            <span class='text-center new-account' id="messageSalary"></span>
                        </div>

                        <!-- Modal -->
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <script src="../../assets/vendor/slimscroll/jquery.slimscroll.js"></script>
    <!-- main js -->
    <script src="../../assets/libs/js/main-js.js"></script>
    <script src="../../assets/vendor/charts/chartist-bundle/chartist.min.js"></script>
    <!-- sparkline js -->
    <script src="../../assets/vendor/charts/sparkline/jquery.sparkline.js"></script>
    <!-- morris js -->
    <script src="../../assets/vendor/charts/morris-bundle/raphael.min.js"></script>
    <script src="../../assets/vendor/charts/morris-bundle/morris.js"></script>
    <script src="../../assets/vendor/charts/c3charts/c3.min.js"></script>
    <script src="../../assets/vendor/charts/c3charts/d3-5.4.0.min.js"></script>
    <script src="../../assets/vendor/charts/c3charts/C3chartjs.js"></script>
    <script src="../../assets/libs/js/dashboard-ecommerce.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {


            $("#formRegister").submit(function(e) {
                e.preventDefault();
                $("#message").text("");
                const tarjet_numer = $("#tarjet_number").val();
                const json = {
                    "tarjet_number": tarjet_numer,
                    "status": "ok"
                }
                $.ajax({
                    contentType: "application/json",
                    dataType: "json",
                    type: "POST",
                    url: "../controller/employee_checkController.php",
                    data: JSON.stringify(json),
                    success: function(response) {
                        console.log(response);
                        $("#message").css("color", "blue");
                        $("#message").text(response.message);
                        if(response.salaryDecrement !=null){
                            $("#messageSalary").css("color", "red");
                            $("#messageSalary").text(response.salaryDecrement);
                        }else{
                            $("#messageSalary").text("");
                        }
                    },
                    error: function(error) {
                        console.log(error.responseJSON);
                        if (confirm(error.responseJSON.message)) {
                            $.ajax({
                                contentType: "application/json",
                                dataType: "json",
                                type: "POST",
                                url: "../controller/insertOutJob.php",
                                data: JSON.stringify(json),
                                success: function(response) {
                                    $("#message").css("color", "blue");
                                    $("#message").text(response.message);
                                    $("#messageSalary").text("");
                                },
                                error: function(error) {
                                    if (confirm(error.responseJSON.message)) {

                                    }
                                }
                            });
                        }
                    }
                });

            })
        });
    </script>

</body>

</html>