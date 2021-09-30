<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./logo_unam_.jpg">
    <title>Entradas y salidas</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <!------ Include the above in your HEAD tag ---------->
    <link rel="shortcut icon" href="./logo_unam_.png">
    <!-- <link href="../../css/styles.css" rel="stylesheet" type="text/css" /> -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Orbitron'>
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Aldrich'>
    <style>
        .container {
            width: 600px;
            margin: 0px auto
        }

        .new-account {
            display: block;
            margin-top: 10px;
        }

        .form-signin {
            max-width: 100%;
            padding: 15px;
            margin: 0px auto;
        }

        .login-title {
            color: #555;
            font-size: 18px;
            font-weight: 400;
            display: block;
        }

        .account-wall {
            margin-top: 20px;
            padding: 40px 0px 20px 0px;
            background-color: #f7f7f7;
            -moz-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
            -webkit-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
            box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
            align-items: center;
        }

        .profile-img {
            width: 96px;
            height: 96px;
            margin: 0 auto 10px;
            display: block;
            -moz-border-radius: 50%;
            -webkit-border-radius: 50%;
            border-radius: 50%;
        }

        .clock {
            position: absolute;
            left: 50%;
            transform: translateX(-50%) translateY(00%);
            color: #3582da;
            font-size: 25px;
            font-family: Orbitron;
            font-weight: bold;
            letter-spacing: 7px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1 class="text-center login-title"><strong>Verificador </strong></h1>
        <div class="account-wall">
            <div style="align-items: center;">
                <img class="profile-img" src="./logo_unam_.png" alt="">
            </div>
            <div style="align-items: center;">
                <div id="MyClockDisplay" class="clock" onload="showTime()"></div>
            </div>
            </br>
            </br>


            <form class="form-signin" id="formRegister" style="width: 100%;">
                <div class="form-group">
                    <input id="tarjet_number" style="width: 100%;" type="text" class="form-control" placeholder="Número de tarjeta" required autofocus>
                </div>

                <div style="" id="qr-reader" style="width:650px"></div>
                <div id="qr-reader-results"></div>


                <!-- Trigger the modal with a button -->
                <br>
                <br>
                <button id="register" class="btn btn-lg btn-primary btn-block" type="submit">Registrar</button>


                <div class="form-group">

                    <span class='text-center new-account' id="message"></span>
                </div>
                <div class="form-group">

                    <span class='text-center new-account' id="messageSalary"></span>
                </div>
            </form>
            <!-- <div class="row">
            <div class="col-sm-6 col-md-4 col-md-offset-4">
                <h1 class="text-center login-title"><strong>Verificador </strong></h1>
                <div class="account-wall">
                    <div style="align-items: center;">
                        <img class="profile-img" src="./logo_unam_.png" alt="">
                    </div>
                    <div style="align-items: center;">
                    <div id="MyClockDisplay" class="clock" onload="showTime()"></div>
                    </div>
                    </br>
                    </br>
                    

                    <form class="form-signin" id="formRegister">
                        <div class="form-group">
                            <input id="tarjet_number" name="tarjet_number" type="text" class="form-control" placeholder="Número de tarjeta" required autofocus>
                        </div>
                        <div class="form-group">
                            
                            <button id="register" class="btn btn-lg btn-primary btn-block" type="submit">Registrar</button>
                        </div>
                        <div class="form-group">
                            
                            <span class='text-center new-account' id="message"></span>
                        </div>
                        <div class="form-group">
                            
                            <span class='text-center new-account' id="messageSalary"></span>
                        </div>

                        
                    </form> 
                </div>
            </div>
        </div> -->
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
        <script src="../../assets/qr/html5-qrcode.min.js"></script>
        <script>
            $(document).ready(function() {


                $("#formRegister").submit(function(e) {
                    e.preventDefault();
                    register();
                })
            });
        </script>
        <script>
            var resultContainer = document.getElementById('qr-reader-results');
            var lastResult, countResults = 0;

            function onScanSuccess(decodedText, decodedResult) {
                if (decodedText !== lastResult) {
                    ++countResults;
                    lastResult = decodedText;
                    // Handle on success condition with the decoded message.
                    console.log(`Scan result ${decodedText}`, decodedResult);
                    document.querySelector("#tarjet_number").value=decodedText;
                    register();
                }
            }

            var html5QrcodeScanner = new Html5QrcodeScanner(
                "qr-reader", {
                    fps: 10,
                    qrbox: 250
                });
            html5QrcodeScanner.render(onScanSuccess);
        </script>
        <script>
             function register() {
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
                            if (response.salaryDecrement != null) {
                                $("#messageSalary").css("color", "red");
                                $("#messageSalary").text(response.salaryDecrement);
                            } else {
                                $("#messageSalary").text("");
                            }
                        },
                        error: function(error) {
                            if(error.status == 404){
                                $("#messageSalary").css("color", "red");
                                $("#messageSalary").text(error.responseJSON.message);
                            }else{
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
                                        $("#messageSalary").text(error.responseJSON.message);
                                    }
                                });
                            }
                            }
                        }
                    });

                }

            function showTime() {
                var date = new Date();
                var h = date.getHours(); // 0 - 23
                var m = (date.getMinutes()<9)? "0"+date.getMinutes():date.getMinutes(); // 0 - 59
                var s = (date.getSeconds()<9)? "0"+date.getSeconds():date.getSeconds(); // 0 - 59
                var time = h + ":" + m + ":" + s;
                document.getElementById("MyClockDisplay").innerText = time;
                document.getElementById("MyClockDisplay").textContent = time;
                setTimeout(showTime, 1000);
            }
            showTime();
        </script>
</body>

</html>