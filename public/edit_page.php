<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation_function.php"); ?>
<?php confirm_logged_in(); ?>
<?php selected_item();?>
<?php $layout_context = "admin" ?>
<?php include("../includes/layouts/header.php"); ?>


<script type="text/javascript" src="javascripts/ckeditor/ckeditor.js"></script>
<!-- <textarea class="ckeditor" name="editor" rows = "50" cols="80"></textarea>
 --><!-- <script src="//cdnjs.cloudflare.com/ajax/libs/tinymce/4.0.28/jquery.tinymce.min.js"></script> -->
<!-- <script src="javascripts/tinymce/js/tinymce/tinymce.min.js"></script>
<script >
tinymce.init({
    selector: "textarea",
    plugins: [
        "advlist autolink lists link image charmap print preview anchor",
        "searchreplace visualblocks code fullscreen",
        "insertdatetime media table contextmenu paste moxiemanager"
    ],
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
});
</script>
 -->



<?php 

if (!$current_page) {
	redirect_to("manage_content.php");
} else {

?>	
<?php 
if (isset($_POST["submit"])) {	
	
	$required_fields = array("menu_name","position","visible","content");
	validate_presences($required_fields);
	
	$fields_with_max_lengths = array("menu_name"=>50);
	validate_max_lengths($fields_with_max_lengths);
	
	$id = $current_page["id"];
	$menu_name = $_POST["menu_name"];
	$position = (int)$_POST["position"];
	$visible = (int)$_POST["visible"];
	$content = mysqli_real_escape_string($connection,$_POST["content"]);
	if(!empty($errors)){		
		//["errors"] = $errors;
		//redirect_to("new_subject.php");
	}else{			
		$query = "UPDATE pages SET ";
		$query .="menu_name='{$menu_name}', ";
		$query .="position={$position}, ";
		$query .="visible={$visible}, ";
		$query .="content='{$content}' ";
		$query .="WHERE id = {$id} ";
		$query .="LIMIT 1";
		
		$result = mysqli_query($connection, $query);
		
		if ($result && mysqli_affected_rows($connection) >= 0) {		
			$_SESSION["message"] = "Subject Edited.";			
			redirect_to("manage_content.php");
		}else{
			$message = "Subject Editing Failed.";
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
				<h2>Edit Subject:<?php echo " ".$current_page["menu_name"]; ?></h2>
				
	<form action="edit_page.php?page=<?php echo urlencode($current_page["id"]); ?>" method="post">
					<p>Menu Name:
						<input type="text" name="menu_name" 
						value="<?php echo htmlentities($current_page["menu_name"]); ?>" 
						/>
					</p>
					
					<p>Position:
						<select name="position">
							<?php 
								$page_set = find_pages_for_subject($current_page["subject_id"],FALSE);
								$page_count = mysqli_num_rows($page_set);
								for ($count=1; $count <= $page_count ; $count++) { 
									echo "<option value=\"$count\" ";
									if($current_page["position"] == $count){
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
						 if($current_page["visible"] == 0){
						 	echo " checked";
						 }
						 ?>
						 />No
						&nbsp;
						<input type="radio" name="visible" value="1" 
						<?php 
						 if($current_page["visible"] == 1){
						 	echo " checked";
						 }
						 ?>
						/>Yes
					</p>
					
					<p>Content <br />
						 <!-- <textarea name="content" style="width:100%rows="10" cols="80""></textarea> -->
					<textarea class="ckeditor" name="content" rows="10" cols="80"><?php echo htmlentities(trim($current_page["content"]));?></textarea>
					</p>
					
					<input name="submit" type="submit" value="Edit Page" />
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

