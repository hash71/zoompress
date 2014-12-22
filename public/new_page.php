<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation_function.php"); ?>
<?php confirm_logged_in(); ?>
<?php selected_item();?>
<?php $layout_context = "admin" ?>
<?php include("../includes/layouts/header.php"); ?>

<script type="text/javascript" src="javascripts/ckeditor/ckeditor.js"></script>

<?php 

if (!$current_subject) {
	redirect_to("manage_content.php");
} else {

?>	
<?php 
if (isset($_POST["submit"])) {	
	
	$required_fields = array("menu_name","position","visible","content");
	validate_presences($required_fields);
	
	$fields_with_max_lengths = array("menu_name"=>50);
	validate_max_lengths($fields_with_max_lengths);
	
	$subject_id = $current_subject["id"];
	$menu_name = $_POST["menu_name"];
	$position = (int)$_POST["position"];
	$visible = (int)$_POST["visible"];
	$content = mysqli_real_escape_string($connection,$_POST["content"]);
	
	if(!empty($errors)){		
		//["errors"] = $errors;
		//redirect_to("new_subject.php");
	}else{			
		$query = "INSERT INTO pages(";
		$query .= "subject_id,menu_name,position,visible,content";
		$query .=") VALUES(";
		$query .="{$subject_id},'{$menu_name}',{$position},{$visible},'{$content}'";
		$query .=")";
		
		$result = mysqli_query($connection, $query);
		
		if ($result && mysqli_affected_rows($connection) >= 0) {		
			$_SESSION["message"] = "Page Created.";			
			redirect_to("manage_content.php?subject=".urlencode($current_subject["id"]));
		}else{
			$message = "Page Creation Failed.";
		}
	}
} else {
	//redirect_to("logout.php");
}
?>
		<div id="main">	
						
			<div id="navigation">				
				<?php echo navigation($current_subject,$current_page)?>				
			</div>
			
			<div id="page">
					
				<?php 
					if(!empty($message)){
						echo "<div class=\"message\">".htmlentities($message)."</div>";						
					}
				?>		
				<?php //$errors = errors();?>
				<?php echo form_errors($errors) ?>		
				<h2>Edit Page:<?php echo " ".$current_subject["menu_name"]; ?></h2>
				
	<form action="new_page.php?subject=<?php echo urlencode($current_subject["id"]); ?>" method="post">
					<p>Menu Name:
						<input type="text" name="menu_name" 
						value="<?php echo htmlentities($current_subject["menu_name"]); ?>" 
						/>
					</p>
					
					<p>Position:
						<select name="position">
							<?php 
								$subject_set = find_pages_for_subject($current_subject["id"],false);
								$subject_count = mysqli_num_rows($subject_set);
								for ($count=1; $count <= $subject_count+1 ; $count++) { 
									echo "<option value=\"$count\" ";
									if($current_subject["position"] == $count){
										echo "selected";
									}
									echo ">{$count}</option>";		
								}
							?>
							
						</select>						
					</p>
					
					<p>Visible:
						<input type="radio" name="visible" value="0"
						 <?php 
						 if($current_subject["visible"] == 0){
						 	echo " checked";
						 }
						 ?>
						 />No
						&nbsp;
						<input type="radio" name="visible" value="1" 
						<?php 
						 if($current_subject["visible"] == 1){
						 	echo " checked";
						 }
						 ?>
						/>Yes
					</p>
					
					<p>Content <br />
					<textarea class="ckeditor" name="content" rows="10" cols="80"></textarea>
					</p>
					
					<input name="submit" type="submit" value="Edit Page" />
				</form>	
				<br />
				<a href="manage_content.php">Cancel</a>			
				&nbsp;
				&nbsp;
				<a href="delete_subject.php?subject=<?php echo urlencode($current_subject["id"]);?>"
				 onclick = "return confirm('Are you sure?');" >Delete</a>
			</div>
			
		</div>
		<?php include("../includes/layouts/footer.php"); ?>

<?php
}


?>

