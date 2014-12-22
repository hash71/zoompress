<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation_function.php"); ?>

<?php $layout_context = "admin" ?>
<?php include("../includes/layouts/header.php"); ?>

<?php 
$username = "";
if (isset($_POST["submit"])) {		
	
	if(!empty($errors)){		
		
	}else{
		
		$required_fields = array("username","password");
		validate_presences($required_fields);
		
		
		
		$username = $_POST["username"];
		$password = $_POST["password"];
		
		
		$found_admin = attempt_login($username, $password);
		
		
		
		if($found_admin){
			$_SESSION["admin_id"] = $found_admin["id"];
			$_SESSION["username"] = $found_admin["username"];
			redirect_to("admin.php");
		}
		else{
			 $_SESSION["message"] = "username / password mismatch";
			 $message = "failed";
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
				
				<h2>Login</h2>
				
				<form action="login.php" method="post">
					
					<p>Username:
						<input type="text" name="username" value="<?php echo htmlentities($username) ?>" />
					</p>
					
					<p>Password
						<input type="password" name="password" value="" />				
					</p>				
					
					<input  type="submit" name="submit" value="Submit" />
				</form>	
				
				<!-- <br />
				
				<a href="manage_admins.php">Cancel</a>	 -->		
			
			</div>
			
		</div>
		<?php include("../includes/layouts/footer.php"); ?>