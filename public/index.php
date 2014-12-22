<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php include("../includes/layouts/header.php"); ?>

<?php selected_item(true);?>

		<div id="main">	

			<div id="navigation">	
				
				<?php echo public_navigation($current_subject,$current_page)?>		
				
			</div>
			
			
			<div id="page">	
				<?php echo message();?>				
				
				
				<?php

					if($current_page){
						

						echo "<h2>"."মেন্যু নাম: ".htmlentities($current_page["menu_name"])."<br/>"."</h2>";
						// echo nl2br(htmlentities($current_page["content"]));
						echo nl2br(($current_page["content"]));
						// echo "</div>";
						?>
					
						<br />
						<br />					
						
					<?php

					}else{
						echo "<p>"."Welcome!!!!!"."</p>";
					}
					echo "<br />";					
				?>		

			</div>
			
		</div>

		<?php include("../includes/layouts/footer.php"); ?>