<?php
session_start();
require_once("../controller/controlPanelController.php");
$controller = new ControlPanelController();

if ($_SESSION['username'] == null && $_SESSION['password'] == null) {
    header("Location: http://localhost:" . $_SERVER['SERVER_PORT'] . "/ServiciosEscolares/ServiciosEscolares/view/index.php");
}
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link href="../../assets/vendor/fonts/circular-std/style.css" rel="stylesheet">
    <link rel="stylesheet" href="../../assets/libs/css/style.css">
    <link rel="stylesheet" href="../../assets/vendor/fonts/fontawesome/css/fontawesome-all.css">
    <link rel="stylesheet" href="../../assets/vendor/charts/chartist-bundle/chartist.css">
    <link rel="stylesheet" href="../../assets/vendor/charts/morris-bundle/morris.css">
    <link rel="stylesheet" href="../../assets/vendor/fonts/material-design-iconic-font/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../../assets/vendor/charts/c3charts/c3.css">
    <link rel="stylesheet" href="../../assets/vendor/fonts/flag-icon-css/flag-icon.min.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.css" rel="stylesheet" />

    <link href="../../css/styles.css" rel="stylesheet" type="text/css" />
    <link rel="shortcut icon" href="./logo_unam_.jpg">
    <title>Panel de administración</title>

</head>

<body>



    <!-- ============================================================== -->
    <!-- main wrapper -->
    <!-- ============================================================== -->
    <div class="dashboard-main-wrapper">
        <!-- ============================================================== -->
        <!-- navbar -->
        <!-- ============================================================== -->
        <div class="dashboard-header">
            <nav class="navbar navbar-expand-lg bg-white fixed-top">
                <a class="navbar-brand" href="index.html">Panel principal</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse " id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto navbar-right-top">
                        <li class="nav-item dropdown nav-user">
                            <a class="nav-link nav-user-img" href="#" id="navbarDropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="../../assets/images/avatar-1.jpg" alt="" class="user-avatar-md rounded-circle"></a>
                            <div class="dropdown-menu dropdown-menu-right nav-user-dropdown" aria-labelledby="navbarDropdownMenuLink2">
                                <div class="nav-user-info">
                                    <h5 class="mb-0 text-white nav-user-name"><?php
                                                                                if (isset($_SESSION['name'])) {
                                                                                    echo $name = $_SESSION['name'];
                                                                                }



                                                                                ?>

                                    </h5>
                                    <span class="status"></span><span class="ml-2">Available</span>
                                </div>
                                <a class="dropdown-item" href="#"><i class="fas fa-user mr-2"></i>Cuenta</a>
                                <a class="dropdown-item" href="#"><i class="fas fa-cog mr-2"></i>Configuración</a>
                                <a class="dropdown-item" href="../controller/destoy_session.php"><i class="fas fa-power-off mr-2"></i>Cerrar sesión</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <!-- ============================================================== -->
        <!-- end navbar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- left sidebar -->
        <!-- ============================================================== -->
        <div class="nav-left-sidebar sidebar-dark">
            <div class="menu-list">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <a class="d-xl-none d-lg-none" href="#">Empleados</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav flex-column">
                            <li class="nav-divider">
                                Menu
                            </li>
                            <li class="nav-item ">

                                <a class="nav-link active" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-1" aria-controls="submenu-1"><i class="fa fa-fw fa-user-circle"></i>Empleados <span class="badge badge-success">6</span></a>
                            </li>
                            <div id="submenu-1" class="collapse submenu">
                                <ul class="nav flex-column">
                                    <li class="nav-item">
                                        <a id="employee" class="nav-link" href="#">Empleados</a>
                                    </li>
                                    <li class="nav-item">
                                        <a id="history" class="nav-link" href="#">Historial</a>
                                    </li>
                                    <li class="nav-item">
                                        <a id="restrictions" class="nav-link" href="#">Restricciones de comida</a>
                                    </li>
                                    <li class="nav-item">
                                        <a id="incidents" class="nav-link" href="#">Registro de incidencias</a>
                                    </li>
                                </ul>
                            </div>
                            </li>
                        </ul>
                    </div>


                    </ul>
            </div>
            </nav>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- end left sidebar -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- wrapper  -->
    <!-- ============================================================== -->
    <div class="dashboard-wrapper">
        <div class="dashboard-ecommerce">
            <div class="container-fluid dashboard-content ">
                <!-- ============================================================== -->
                <!-- pageheader  -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="page-header">
                            <h2 class="pageheader-title">Servicios escolares</h2>


                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Empleados</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Listado</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- end pageheader  -->
                <!-- ============================================================== -->
                <div class="ecommerce-widget">
                    <div id="allEmployees" class="row">
                        <!-- ============================================================== -->

                        <!-- ============================================================== -->

                        <!-- recent orders  -->
                        <!-- ============================================================== -->
                        <div class="col-xl-9 col-lg-12 col-md-6 col-sm-12 col-12" style="width: 100%;">
                            <div class="card">
                                <h5 class="card-header">Lista de empleados</h5>
                                <div class="card-body p-0">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead class="bg-light">
                                                <tr class="border-0">
                                                    <th class="border-0">Id del empleado</th>
                                                    <th class="border-0">Nombre</th>
                                                    <th class="border-0">Apellido</th>
                                                    <th class="border-0">Correo electrónico</th>
                                                    <th class="border-0">Número de tarjeta</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                for ($i = 0; $i < count($controller->employee_array); $i++) {
                                                    echo "<tr>"
                                                        .
                                                        "
                                                                <td>" . $controller->employee_array[$i]->getId() . "</td>"
                                                        .
                                                        "
                                                                <td>" . $controller->employee_array[$i]->getName() . "</td>"
                                                        .
                                                        "
                                                                <td>" . $controller->employee_array[$i]->getLastName() . "</td>"
                                                        .
                                                        "
                                                                <td>" . $controller->employee_array[$i]->getMail() . "</td>"
                                                        .
                                                        "
                                                                <td>" . $controller->employee_array[$i]->getTarjetNumber() . "</td>"
                                                        .
                                                        "</tr>";
                                                }
                                                ?>
                                                <tr>
                                                    <td colspan="9">
                                                        <!--
                                     Modal window
-->
                                                        <!-- Trigger the modal with a button -->
                                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Agregar</button>

                                                        <!-- Modal -->
                                                        <div class="modal fade" id="myModal" role="dialog">
                                                            <div class="modal-dialog">

                                                                <!-- Modal content-->
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>

                                                                    </div>
                                                                    <div class="modal-body">

                                                                        <form method="POST" id="userForm">
                                                                            <div class="form-group">
                                                                                <label for="txtname">Nombre</label>
                                                                                <input type="text" class="form-control" id="txtName" name="txtName" onchange="checkField(this)">

                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="txtLastName">Apellido</label>
                                                                                <input type="text" class="form-control" id="txtLastName" name="txtLastName" onchange="checkField(this)">

                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="txtEmail">Email</label>
                                                                                <input type="email" class="form-control" id="txtEmail" name="txtEmail" onchange="checkField(this)">

                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="txtNumTarjet">Número de tarjeta</label>
                                                                                <input type="text" class="form-control" id="txtNumTarjet" name="txtNumTarjet" onchange="checkField(this)">
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <span href='#' id="error_message" class='text-center new-account' style='color:red'></span>

                                                                            </div>


                                                                            <button type="submit" class="btn btn-primary">Guardar</button>
                                                                        </form>

                                                                    </div>

                                                                </div>

                                                            </div>
                                                        </div>



                                                        <!--End modal window -->
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- ============================================================== -->
                        <!-- end recent orders  -->
                    </div>
                    <div id="historyTable" class="row">
                        <!-- ============================================================== -->

                        <!-- ============================================================== -->

                        <!-- recent orders  -->
                        <!-- ============================================================== -->
                        <div class="col-xl-12 col-lg-12 col-md-6 col-sm-12 col-12" style="width: 100%;">
                            <div class="card">
                                <h5 class="card-header">Historial de empleado</h5>
                                <div class="card-header row no-gutters align-items-center">
                                    <div class="col-auto pr-sm-3">
                                        <i class="fas fa-search h4 text-body "></i>
                                    </div>
                                    <!--end of col-->
                                    <div class="col pr-sm-3">
                                        <input class="form-control form-control-lg form-control-borderless" id="filter_tarjetNumber" placeholder="Número de tarjeta" type="text" />
                                    </div>
                                    <div class="col pr-sm-3">
                                        <input placeholder="yyyy-mm-dd" class="form-control form-control-lg form-control-borderless" type="date" id="date">
                                    </div>
                                    <div class="col pr-sm-3">
                                        <input placeholder="yyyy-mm-dd" class="form-control form-control-lg form-control-borderless" type="date" id="dateEnd" onblur="checkDates(this)">
                                    </div>
                                    <!--end of col-->
                                    <div class="col-auto">
                                        <button id="generateReport" class="btn btn-success" type="button" onclick="generateReport()">Buscar</button>
                                    </div>
                                    <!--end of col-->
                                </div>
                                <span class="mx-auto" id="msgDate" style="color: red"></span>

                                <div class="card-body p-0">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead class="bg-light">
                                                <tr class="border-0">
                                                    <th class="border-0">Tarjeta</th>
                                                    <th class="border-0">Nombre</th>
                                                    <th class="border-0">Correo</th>
                                                    <th class="border-0">Entrada</th>
                                                    <th class="border-0">Comida</th>
                                                    <th class="border-0">Regreso</th>
                                                    <th class="border-0">Salida</th>
                                                    <th class="border-0">Fecha</th>
                                                    <th class="border-0">Comentarios</th>
                                                </tr>
                                            </thead>
                                            <tbody id="historyTable-tbody">

                                            </tbody>

                                            <td colspan="9">
                                                <div class="container bg-light">
                                                    <div class="col-md-12 text-center">
                                                        <label>
                                                            <input id="chbkExcel" class="pr-sm-3" type="checkbox" name="check" onclick="onlyOne(this)" checked>Excel
                                                        </label>
                                                        <label>
                                                            <input id="chbkPDF" type="checkbox" name="check" onclick="onlyOne(this)">PDF
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="container bg-light">
                                                    <div class="col-md-12 text-center">
                                                        <!--a id="linkReport" class="pr-sm-3 btn btn-primary" onclick="downloadReport(this)" href="#">Descargar Excel</a-->
                                                        <a id="linkReportPDF" class="btn btn-primary" onclick="downloadReport(this)" href="#">Descargar</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </table>
                                        <div class="form-group">
                                            <span href='#' id="error_messageReport" class='text-center new-account' style='color:red'></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- ============================================================== -->
                        <!-- end recent orders  -->
                    </div>

                    <div id="restrictionTable" class="row">
                        <!-- ============================================================== -->

                        <!-- ============================================================== -->

                        <!-- recent orders  -->
                        <!-- ============================================================== -->
                        <div class="col-xl-9 col-lg-12 col-md-6 col-sm-12 col-12" style="width: 100%;">
                            <div class="card">
                                <h5 class="card-header">Restricciones</h5>
                                <div class="card-header row no-gutters align-items-center">
                                    <div class="col-auto pr-sm-3">
                                        <i class="fas fa-search h4 text-body "></i>
                                    </div>
                                    <!--end of col-->
                                    <div class="col pr-sm-3">
                                        <input id="fieldTarjetNumber" class="form-control form-control-lg form-control-borderless" type="search" placeholder="Buscar número de tarjeta">
                                    </div>
                                    <!--end of col-->
                                    <div class="col-auto">
                                        <button class="btn btn-success" type="button" onclick="searchEmployee(this)">Buscar</button>
                                    </div>
                                    <!--end of col-->
                                </div>
                                <div class="card-body p-0">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead class="bg-light">
                                                <tr class="border-0">
                                                    <th class="border-0 text-center">Tarjeta</th>
                                                    <th class="border-0 text-center">Nombre completo</th>
                                                    <th class="border-0 text-center">fecha</th>
                                                    <th class="border-0 text-center">Restringido</th>
                                                </tr>
                                            </thead>
                                            <tbody id="restrictionTable-tbody">

                                            </tbody>
                                            <td colspan="9">
                                                <span href='#' id="error_restriction" class='text-center new-account' style='color:red'></span>
                                            </td>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- ============================================================== -->
                        <!-- end recent orders  -->
                    </div>
                    <div id="incidentsTable" class="row">
                        <!-- ============================================================== -->

                        <!-- ============================================================== -->

                        <!-- recent orders  -->
                        <!-- ============================================================== -->
                        <div class="col-xl-9 col-lg-12 col-md-6 col-sm-12 col-12" style="width: 100%;">
                            <div class="card">
                                <h5 class="card-header">Incidencias</h5>
                                <div class="card-header row no-gutters align-items-center">
                                    <div class="col-auto pr-sm-3">
                                        <i class="fas fa-search h4 text-body "></i>
                                    </div>
                                    <!--end of col-->
                                    <div class="col pr-sm-3">
                                        <input id="tarjetNumberIncidents" class="form-control form-control-lg form-control-borderless" type="search" placeholder="Buscar número de tarjeta">
                                    </div>
                                    <!--end of col-->
                                    <div class="col-auto">
                                        <button class="btn btn-success" type="button" onclick="getIncidents()">Buscar</button>
                                    </div>
                                    <!--end of col-->
                                </div>
                                <div class="card-body p-0">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead class="bg-light">
                                                <tr class="border-0">
                                                    <th class="border-0 text-center">Tarjeta</th>
                                                    <th class="border-0 text-center">Nombre completo</th>
                                                    <th class="border-0 text-center">fecha</th>
                                                    <th class="border-0 text-center">Motivo</th>
                                                </tr>
                                            </thead>
                                            <tbody id="incidentsTable-tbody">

                                            </tbody>
                                            <td colspan="9">
                                                <span href='#' id="error_incidents" class='text-center new-account' style='color:red'></span>
                                                <span href='#' id="success_incidents" class='text-center new-account' style='color:green'></span>
                                            </td>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- ============================================================== -->
                        <!-- end recent orders  -->
                    </div>
                </div>
            </div>
        </div>

        <!-- ============================================================== -->
        <!-- footer -->
        <!-- ============================================================== -->
        <div class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                        Copyright © 2021. Todos los derechos reservados <a href="https://Proyecto.com">Proyecto.com</a>.
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="text-md-right footer-links d-none d-sm-block">
                            <a href="javascript: void(0);">Acerca de</a>
                            <a href="javascript: void(0);">Contactanos</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- end footer -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- end wrapper  -->
    <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- end main wrapper  -->
    <!-- ============================================================== -->
    <!-- Optional JavaScript -->
    <!-- jquery 3.3.1 -->

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <!-- slimscroll js -->
    <script src="../../assets/vendor/slimscroll/jquery.slimscroll.js"></script>
    <!-- main js -->
    <script src="../../assets/libs/js/main-js.js"></script>
    <!-- chart chartist js -->
    <script src="../../assets/vendor/charts/chartist-bundle/chartist.min.js"></script>
    <!-- sparkline js -->
    <script src="../../assets/vendor/charts/sparkline/jquery.sparkline.js"></script>
    <!-- morris js -->
    <script src="../../assets/vendor/charts/morris-bundle/raphael.min.js"></script>
    <script src="../../assets/vendor/charts/morris-bundle/morris.js"></script>
    <!-- chart c3 js -->
    <script src="../../assets/vendor/charts/c3charts/c3.min.js"></script>
    <script src="../../assets/vendor/charts/c3charts/d3-5.4.0.min.js"></script>
    <script src="../../assets/vendor/charts/c3charts/C3chartjs.js"></script>
    <script src="../../assets/libs/js/dashboard-ecommerce.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.js"></script>
    <script>
        function checkField(params) {
            const json = {
                field: params.name,
                value: params.value
            }
            $.ajax({
                contentType: "application/json",
                dataType: "json",
                type: "POST",
                url: "../controller/validateFieldEmployee.php",
                data: JSON.stringify(json),
                success: function(response) {
                    console.log(response)

                    if ($("#error_message").text() != null) {
                        $("#error_message").text("");
                    }
                },
                error: function(error) {
                    $("#error_message").text(error.responseJSON.message);

                }
            });
        }

        function checkDates(e) {
            if (e.value == $("#date").val() && e.value != "" && $("#date").val() != null) {
                document.querySelector("#generateReport").disabled = true;
                $("#msgDate").text("Las fechas no deben coincidir");
            } else {
                $("#msgDate").text("");
                document.querySelector("#generateReport").disabled = false;
            }
        }

        function setRestrinction() {

            var restrictionTarjetNumber = $("#restrictionTarjetNumber").text();
            var restrictionName = $("#restrictionName").text();
            var restrictionDate = $("#restrictionDate").text();
            var restrictionCheckBox = $("#restrictionCheckBox").text();
            restrictionCheckBox = $('#restrictionCheckBox').is(":checked");
            const json = {
                tarjetNumber: restrictionTarjetNumber,
                name: restrictionName,
                date: restrictionDate,
                restriction: restrictionCheckBox
            }
            $.ajax({
                contentType: "application/json",
                dataType: "json",
                type: "POST",
                url: "../controller/addRestrinctionFoodEmployee.php",
                data: JSON.stringify(json),
                success: function(response) {
                    console.log(response);
                },
                error: function(error) {
                    console.log(error)
                    $("#error_restriction").text(error.responseJSON.message);
                }
            });
        }

        function searchEmployee(e) {
            var employeeId = $("#fieldTarjetNumber").val();
            const json = {
                employeeId: employeeId
            }
            $.ajax({
                contentType: "application/json",
                dataType: "json",
                type: "POST",
                url: "../controller/getRestrinctionEmployee.php",
                data: JSON.stringify(json),
                success: function(response) {
                    console.log(response);
                    var restrictionTable_tbody = document.querySelector("#restrictionTable-tbody");
                    restrictionTable_tbody.innerHTML = "";
                    var checkBox;
                    if (response.restriction == "0") {
                        checkBox = `<input id="restrictionCheckBox" class="text-center" type="checkbox" onclick="setRestrinction()">`;
                    } else {
                        checkBox = `<input id="restrictionCheckBox" class="text-center" type="checkbox" checked onclick="setRestrinction()">`;
                    }

                    restrictionTable_tbody.innerHTML += `
                            <tr>
                            <td id="restrictionTarjetNumber" class="text-center">${response.tarjet_number}</td>
                            <td id="restrictionName" class="text-center">${response.name} ${response.lastName}</td>
                            <td id="restrictionDate" class="text-center">${response.date}</td>
                            <td class="text-center">${checkBox}</td>
                            </tr>`

                },
                error: function(error) {
                    console.log(error);
                }

            });
        }

        function generateReport() {
            const filter_tarjetNumber = document.querySelector('#filter_tarjetNumber').value;
            const dateInit = document.querySelector('#date').value;
            const dateEnd = document.querySelector('#dateEnd').value;
            const json = {
                tarjetNumber: filter_tarjetNumber,
                init: dateInit,
                end: dateEnd
            };
            $.ajax({
                contentType: "application/json",
                dataType: "json",
                type: "POST",
                url: "../controller/generateReport.php",
                data: JSON.stringify(json),
                success: function(response) {
                    console.log(response)
                    $("#error_messageReport").text("");
                    addDataHistoryTable(response.message);
                },
                error: function(error) {
                    document.querySelector("#historyTable-tbody").innerHTML = "";
                    $("#error_messageReport").text(error.responseJSON.message);
                }
            });

        }

        function downloadReport(e) {
            if (document.querySelector("#chbkExcel").checked) {
                const filter_tarjetNumber = document.querySelector('#filter_tarjetNumber').value;
                const dateInit = document.querySelector('#date').value;
                const dateEnd = document.querySelector('#dateEnd').value;
                window.location.href = `../controller/downloadReport.php?tarjet_number=${filter_tarjetNumber}&date=${dateInit}&dateEnd=${dateEnd}`;
            } else if (document.querySelector("#chbkPDF").checked) {
                downloadReportPDF();
            }
        }

        function downloadReportPDF(e) {
            const filter_tarjetNumber = document.querySelector('#filter_tarjetNumber').value;
            const dateInit = document.querySelector('#date').value;
            const dateEnd = document.querySelector('#dateEnd').value;
            window.location.href = `../controller/downloadReportPDF.php?tarjet_number=${filter_tarjetNumber}&date=${dateInit}&dateEnd=${dateEnd}`;
        }

        function addDataHistoryTable(json) {
            var tbody = document.querySelector("#historyTable-tbody");
            tbody.innerHTML = "";
            for (let aux of json) {
                tbody.innerHTML += `
                            <tr><td>${aux.tarjet_number}</td>
                            <td>
                                ${aux.name} ${aux.lastName}
                            </td>
                           <td>
                                ${aux.mail}
                            </td>
                            <td>
                                ${aux.InJob}
                            </td>
                            <td>
                                ${aux.OutEat}
                            </td>
                            <td>
                                ${aux.BackEat}
                            </td>
                            <td>
                                ${aux.OutJob}
                            </td>
                            <td>
                                ${aux.Date}
                            </td>
                            <td>
                                ${aux.comments}
                            </td
                            </tr>
                        `;
            }
        }

        function getIncidents() {
            const json = {
                tarjet_number: document.querySelector("#tarjetNumberIncidents").value
                //  date: document.querySelector("#tarjetNumberIncidents").value,
            }
            $.ajax({
                contentType: "application/json",
                dataType: "json",
                type: "POST",
                url: "../controller/incidents.php",
                data: JSON.stringify(json),
                success: function(response) {
                    console.log(response);
                    let table = document.querySelector("#incidentsTable-tbody");
                    table.innerHTML = `<tr>
                                                <td id="tarjetIncident" class="text-center"></td>
                                                <td id="nameIncident" class="text-center"></td>
                                                <td class="text-center"><input id="dateIncident" type="date"></td>
                                                <td class="text-center"><input id="explainIncident" type="text" placeholder="Explique el motivo"></td>
                                                <td class="text-center"> <button class="btn btn-success" type="button" onclick="registerIncident()">Registrar</button></td>
                                      </tr>`
                    document.querySelector("#error_incidents").innerHTML = "";
                    document.querySelector("#tarjetIncident").innerHTML = response.tarjet_number;
                    document.querySelector("#nameIncident").innerHTML = response.name
                    document.querySelector("#success_incidents").innerHTML = "";

                },
                error: function(error) {
                    console.log("error", error);
                    $("#error_incidents").text(error.responseJSON.message);
                    document.querySelector("#success_incidents").innerHTML = "";
                }
            });
        }

        function registerIncident() {
            const _tarjet_number = document.querySelector("#tarjetIncident").innerHTML;
            const _date = document.querySelector("#dateIncident").value;
            const _explainIncidents= document.querySelector("#explainIncident").value;
            if(_explainIncidents!=""){
                const json = {
                tarjet_number: _tarjet_number,
                explainIncidents:_explainIncidents,
                date: _date
            };
            console.log(json);
            $.ajax({
                contentType: "application/json",
                dataType: "json",
                type: "POST",
                url: "../controller/registerIncident.php",
                data: JSON.stringify(json),
                success: function(response) {
                    console.log(response);
                    document.querySelector("#error_incidents").innerHTML = "";
                    document.querySelector("#success_incidents").innerHTML = response.message;
                    document.querySelector("#incidentsTable-tbody").innerHTML = "";

                },
                error: function(error) {
                    console.log("error", error);
                    document.querySelector("#success_incidents").innerHTML = "";
                    $("#error_incidents").text(error.responseJSON.message);
                }
            });
            }else{
                document.querySelector("#success_incidents").innerHTML = "";
                document.querySelector("#error_incidents").innerHTML = "Debe proporcionar un motivo";
            }
            
        }

        function onlyOne(checkbox) {
            var checkboxes = document.getElementsByName('check')
            checkboxes.forEach((item) => {
                if (item !== checkbox) item.checked = false
            })
        }
        $(document).ready(function() {
            $("#historyTable").hide();
            $("#restrictionTable").hide();
            $("#incidentsTable").hide();
            $('#userForm').submit(function(e) {
                e.preventDefault();
                const form = new FormData(e.target);
                const txtName = form.get("txtName");
                const txtLastName = form.get("txtLastName");
                const txtEmail = form.get("txtEmail");
                const txtNumTarjet = form.get("txtNumTarjet");


                const json = {
                    'txtName': txtName,
                    'txtLastName': txtLastName,
                    'txtEmail': txtEmail,
                    'txtNumTarjet': txtNumTarjet
                };
                const _json = JSON.stringify(json);
                $.ajax({
                    contentType: "application/json",
                    dataType: "json",
                    type: "POST",
                    url: "../controller/createUserController.php",
                    data: _json,
                    success: function(response) {
                        window.location.reload();
                    },
                    error: function(error) {
                        $("#error_message").text(error.responseJSON.message);
                    }
                });
            });
            $("#employee").click(function(e) {
                $("#allEmployees").show();
                $("#historyTable").hide();
                $("#restrictionTable").hide();

            });
            $("#restrictions").click(function() {
                $("#restrictionTable").show();
                $("#historyTable").hide();
                $("#incidentsTable").hide();
                $("#allEmployees").hide();
            });
            $("#history").click(function(e) {
                $("#restrictionTable").hide();
                $("#allEmployees").hide();
                $("#incidentsTable").hide();
                $("#historyTable").show();

                $.get("../controller/employeesHistory.php", function(data) {

                    const json = JSON.parse(data);
                    addDataHistoryTable(json);
                });
            });
            $("#incidents").click(function(e) {
                $("#restrictionTable").hide();
                $("#allEmployees").hide();
                $("#historyTable").hide();
                $("#incidentsTable").show();

                $.get("../controller/employeesHistory.php", function(data) {

                    const json = JSON.parse(data);
                    addDataHistoryTable(json);
                });
            });
        });
    </script>
</body>

</html>