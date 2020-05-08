<?php
include "../../mainconfig.php";
session_start();
if (!isset($_SESSION['account111111233d'])){
header ("location:../../404.php");
}
?>