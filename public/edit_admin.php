<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation_function.php"); ?>
<?php confirm_logged_in(); ?>
<?php //selected_item();?>
<?php $layout_context = "admin" ?>
<?php include("../includes/layouts/header.php"); ?>

<?php 
$admin = find_admin_by_id($_GET["id"]);
if (!$admin) {
	redirect_to("manage_admins.php");
} else {

?>	
<?php 
if (isset($_POST["submit"])) {
			
	$required_fields = array("username","password");
	validate_presences($required_fields);
	
	$fields_with_max_lengths = array("username"=>50);
	validate_max_lengths($fields_with_max_lengths);
	
	
	if(!empty($errors)){		
		//["errors"] = $errors;
		//redirect_to("new_subject.php");
	}else{
		
		$id = $admin["id"];
		$username = mysqli_real_escape_string($connection,$_POST["username"]);
		$hashed_password = password_encrypt($_POST["password"]);
				
			
					
		$query = "UPDATE admins SET ";
		$query .="username='{$username}', ";
		$query .="hashed_password='{$hashed_password}' ";
		$query .="WHERE id={$id} ";
		$query .="LIMIT 1";
		
		$result = mysqli_query($connection, $query);
		
		if ($result && mysqli_affected_rows($connection) == 1) {		
			$_SESSION["message"] = "Admin Updated";			
			redirect_to("manage_admins.php");
		}else{
			$_SESSION[$message] = "Subject Editing Failed.";
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
				
				<h2>Edit Admin:<?php echo " ".htmlentities($admin["username"]); ?></h2>
				
	<form action="edit_admin.php?id=<?php echo urlencode($admin["id"]); ?>" method="post">
					
					<p>Username:
						<input type="text" name="username" value="<?php echo htmlentities($admin["username"]) ?>" />
					</p>
					
					<p>Password
						<input type="password" name="password" value="" />				
					</p>				
					
					<input  type="submit" name="submit" value="Edit Admin" />
				</form>	
				<br />
				<a href="manage_content.php">Cancel</a>			
				&nbsp;
				&nbsp;
				<a href="delete_page.php?page=<?php echo urlencode($current_page["id"]);?>"
				 onclick = "return confirm('Are you sure?');" >Delete</a>
			</div>
			
		</div>
		<?php include("../includes/layouts/footer.php"); ?>

<?php
}


?>

