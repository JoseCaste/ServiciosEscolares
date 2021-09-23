<?php
include "../../QR/qrlib.php";
QRcode::png($_GET['tarjet_numer'],false, QR_ECLEVEL_H, 9, 2, true );