<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation_function.php"); ?>
<?php confirm_logged_in(); ?>
<?php 
if (isset($_POST["submit"])) {
	
	$menu_name = $_POST["menu_name"];
	$position = (int)$_POST["position"];
	$visible = (int)$_POST["visible"];
	
	$required_fields = array("menu_name","position","visible");
	validate_presences($required_fields);
	
	$fields_with_max_lengths = array("menu_name"=>50);
	validate_max_lengths($fields_with_max_lengths);
	
	if(!empty($errors)){		
		$_SESSION["errors"] = $errors;
		redirect_to("new_subject.php");
	}else{			
		$menu_name = mysqli_real_escape_string($connection,$menu_name);		
		$query = "INSERT INTO subjects(";
		$query .= "menu_name,position,visible";
		$query .=") VALUES(";
		$query .="'{$menu_name}',{$position},{$visible}";
		$query .=")";
		
		$result = mysqli_query($connection, $query);
		
		if ($result) {		
			$_SESSION["message"] = "Subject Created.";
			redirect_to("manage_content.php");
			//echo $message;
		}else{
			$_SESSION["message"] = "Subject Creation Failed.";
			redirect_to("new_subject.php");		
		}
	}

} else {
	redirect_to("logout.php");
}
?>

<?php if (isset($connection)) {mysqli_close($connection);}?>	