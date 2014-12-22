<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php confirm_logged_in(); ?>
<?php selected_item();?>
<?php $layout_context = "admin" ?>
<?php include("../includes/layouts/header.php"); ?>

		<div id="main">	
						
			<div id="navigation">				
				<?php echo navigation($current_subject,$current_page)?>				
			</div>
			
			<div id="page">
					
				<?php echo message();?>		
				<?php $errors = errors();?>
				<?php echo form_errors($errors) ?>		
				<h2>সাবজেক্ট তৈরি করুন</h2>
				<form action="create_subject.php" method="post">
					<p>মেন্যু নাম:
						<input type="text" name="menu_name" value="" />
					</p>
					
					<p>পজিশন:
						<select name="position">
							<?php 
								$subject_set = find_all_subjects(false);
								$subject_count = mysqli_num_rows($subject_set);
								for ($count=1; $count <= $subject_count+1 ; $count++) { 
									echo "<option value=\"$count\">$count</option>";		
								}
							?>
							
						</select>						
					</p>
					
					<p>ভিজিবিলিটি:
						<input type="radio" name="visible" value="0"/>না
						&nbsp;
						<input type="radio" name="visible" value="1" />হ্যাঁ
					</p>
					
					<input name="submit" type="submit" value="সাবজেক্ট তৈরী করুন" />
				</form>	
				<br />
				<a href="manage_content.php">পরিহার করুন</a>			
			</div>
			
		</div>
		<?php include("../includes/layouts/footer.php"); ?>