<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>

<?php confirm_logged_in(); ?>

<?php $admin_set = find_all_admins();?>


<?php $layout_context = "admin" ?>
<?php include("../includes/layouts/header.php"); ?>

<div id="main">	
						
			<div id="navigation">	
				<a href="admin.php">&laquo; প্রধান মেন্যু</a>		
				<!-- <br />
				<a href="admin.php">&laquo; Main Menu</a>			
				<?php echo navigation($current_subject,$current_page)?>		
				<br />
				<a href="new_subject.php">+ Add a Subject</a>	 -->	
			</div>
			
			
			
			<div id="page">	
				<?php echo message();?>				
				<?php 
					//if($current_subject){
						echo "<h2>ম্যানেজ এডমিন:</h2>";
						// echo "Menu Name: ".htmlentities($current_subject["menu_name"])."<br/>";
						// echo "Position: ".$current_subject["position"]."<br/>";
						// echo "Visible: ";
						// echo $current_subject["visible"]==1 ? "yes" : "no"; 
						// echo "<br />";
						// echo "<a href=\"edit_subject.php?subject=".urlencode($current_subject["id"])."\">Edit Subject</a>";	
						?>
						<!-- <div style="margin-top: 2em;border-top: 1px solid #000000;">
							<h3>Pages in this Subject</h3>
							<ul> -->
								
								<table border="0px">
									<tr>
										<th style="text-align: left; width: 200px;">ইউজার</th>
										<th style="text-align: left;" colspan="2">একশন</th>
									</tr>
								
								<?php 
								// $subject_pages = find_pages_for_subject($current_subject["id"],FALSE);
								while ($admin = mysqli_fetch_assoc($admin_set)) {
									?>
									<tr>
										<td><?php echo htmlentities($admin["username"]) ?></td>
										<td>
											<a href="edit_admin.php?id=<?php echo urlencode($admin["id"]);?>">এডিট</a>											
										</td>
										<td>
											<a href="delete_admin.php?id=<?php echo urlencode($admin["id"]);?>" onclick ="return confirm('Are you sure?');" >
											ডিলিট
											</a>
										</td>
									</tr>
									
									<?php
									// echo "<li>";
									// $safe_page_id = urlencode($page["id"]);
									// echo "<a href = \"manage_content.php?page={$safe_page_id}\">";
									// echo htmlentities($page["menu_name"]);
									// echo "</a>";
									// echo "</li>";
								}
								?>
								</table>								
							</ul>
							<br />
							+ <a href="new_admin.php?">	নতুন এডমিন যোগ করুন</a>
						</div>		
					<?php
					// }else if($current_page){
						// echo "<h2>Manage Page:</h2>";
						// echo "Menu Name: ".htmlentities($current_page["menu_name"])."<br/>";
						// echo "Position: ".$current_page["position"]."<br/>";
						// echo "Visible: ";
						// echo $current_page["visible"]==1 ? "yes" : "no"; 
						// echo "<br />";
						// echo "<div class=\"view_content\">";
						// echo htmlentities($current_page["content"]);
						// echo "</div>";
						?>
					
						<!-- <br />
						<br />
						<a href="edit_page.php?page=<?php echo urlencode($current_page["id"]);?>">
							Edit Page
						</a> -->
						
					<?php
					// }else{
						// echo "Please Select a Subject or Page";
					// }
					// echo "<br />";					
				?>				
			</div>
			
		</div>
		<?php include("../includes/layouts/footer.php"); ?>