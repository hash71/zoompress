<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/functions.php"); ?>

<?php 

$_SESSION["admin_id"] = NULL;
$_SESSION["username"] = NULL;

redirect_to("login.php");


?>