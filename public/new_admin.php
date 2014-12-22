<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation_function.php"); ?>
<?php confirm_logged_in(); ?>
<?php $layout_context = "admin" ?>
<?php include("../includes/layouts/header.php"); ?>

<?php 
if (isset($_POST["submit"])) {	
	
	$required_fields = array("username","password");
	validate_presences($required_fields);
	
	$fields_with_max_lengths = array("username"=>50);
	validate_max_lengths($fields_with_max_lengths);
	
	
	//echo $username." ".$hashed_password;	
	
	
	if(!empty($errors)){		
		
	}else{
		
		$username = mysqli_real_escape_string($connection,$_POST["username"]);
		$hashed_password = password_encrypt($_POST["password"]);
				
		$query = "INSERT INTO admins(";
		$query .= "username,hashed_password";
		$query .=") VALUES(";
		$query .="'{$username}','{$hashed_password}'";
		$query .=")";
		
		$result = mysqli_query($connection, $query);
		
		if ($result && mysqli_affected_rows($connection) >= 0) {		
			$_SESSION["message"] = "Admin Created.";			
			redirect_to("manage_admins.php");
		}else{
			$_SESSION[$message] = "Admin Creation Failed.";
		}
	}
} else {
	//redirect_to("logout.php");
}
?>
		<div id="main">							
			
			<div id="navigation">				
				<?php //echo navigation($current_subject,$current_page)?>				
			</div>
			
			<div id="page">					
				<?php echo message();?>		
				<?php $errors = errors();?>
				<?php echo form_errors($errors) ?>		
				
				<h2>Create Admin</h2>
				
				<form action="new_admin.php" method="post">
					<p>Username:
						<input type="text" name="username" value="" />
					</p>
					
					<p>Password
						<input type="password" name="password" value="" />				
					</p>				
					
					<input  type="submit" name="submit" value="Create Admin" />
				</form>	
				
				<br />
				
				<a href="manage_admins.php">Cancel</a>			
			
			</div>
			
		</div>
		<?php include("../includes/layouts/footer.php"); ?>