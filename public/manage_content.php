<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php $layout_context = "admin" ?>
<?php include("../includes/layouts/header.php"); ?>

<?php confirm_logged_in(); ?>

<?php selected_item();?>

		<div id="main">	
						
			<div id="navigation">	
				<br />
				<a href="admin.php">&laquo; প্রধান মেন্যু</a>			
				<?php echo navigation($current_subject,$current_page)?>		
				<br />
				<a href="new_subject.php">+ নতুন সাবজেক্ট যোগ করুন</a>		
			</div>
			
			
			
			<div id="page">	
				<?php echo message();?>				
				<?php 
					if($current_subject){
						echo "<h2>ম্যানেজ সাবজেক্ট:</h2>";
						echo "মেন্যু নাম: ".htmlentities($current_subject["menu_name"])."<br/>";
						echo "পজিশন: ".$current_subject["position"]."<br/>";
						echo "ভিজিবিলিটি: ";
						echo $current_subject["visible"]==1 ? "yes" : "no"; 
						echo "<br />";
						echo "<a href=\"edit_subject.php?subject=".urlencode($current_subject["id"])."\">Edit Subject</a>";	
						?>
						<div style="margin-top: 2em;border-top: 1px solid #000000;">
							<h3>সংশ্লিষ্ট পেজগুলি</h3>
							<ul>
								<?php 
								$subject_pages = find_pages_for_subject($current_subject["id"],FALSE);
								while ($page = mysqli_fetch_assoc($subject_pages)) {
									echo "<li>";
									$safe_page_id = urlencode($page["id"]);
									echo "<a href = \"manage_content.php?page={$safe_page_id}\">";
									echo htmlentities($page["menu_name"]);
									echo "</a>";
									echo "</li>";
								}
								?>								
							</ul>
							<br />
							+ <a href="new_page.php?subject=<?php echo urlencode($current_subject["id"]);?>">
							নতুন পেজ যোগ করুন
							</a>
						</div>		
					<?php
					}else if($current_page){
						echo "<h2>ম্যানেজ পেজ:</h2>";
						echo "মেন্যু নাম: ".htmlentities($current_page["menu_name"])."<br/>";
						echo "পজিশন: ".$current_page["position"]."<br/>";
						echo "ভিজিবিলিটি: ";
						echo $current_page["visible"]==1 ? "yes" : "no"; 
						echo "<br />";
						echo "<div class=\"view_content\">";
						echo nl2br(htmlentities($current_page["content"]));
						echo "</div>";
						?>
					
						<br />
						<br />
						<a href="edit_page.php?page=<?php echo urlencode($current_page["id"]);?>">
							এডিট পেজ
						</a>
						
						
					<?php
					}else{
						echo "দয়া করে সাবজেক্ট অথবা পেজ সিলেক্ট করুন ";
					}
					echo "<br />";					
				?>				
			</div>
			
		</div>
		<?php include("../includes/layouts/footer.php"); ?>