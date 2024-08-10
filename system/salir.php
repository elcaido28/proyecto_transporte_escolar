<?php
session_start();
session_unset();
unset($_SESSION['ID_usu']);
unset($_SESSION['NU']);
session_destroy();

echo '<script> window.location = "../index.php"; </script>';
 ?>
