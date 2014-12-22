<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/functions.php"); ?>

<?php confirm_logged_in(); ?>
<?php $layout_context = "admin" ?>
<?php include("../includes/layouts/header.php"); ?>
		<div id="main">
			<div id="navigation">
				&nbsp;
			</div>
			<div id="page">
				<h2>এডমিন</h2>
				<p>এডমিন সুবিধায় স্বাগতম, <?php echo htmlentities($_SESSION["username"]); ?></p>
				<ul>
					<li><a href="manage_content.php">ম্যানেজ সাইট কন্টেন্ট</a></li>
					<li><a href="manage_admins.php">ম্যানেজ এডমিন ইউজারস</a></li>
					<li><a href="logout.php">লগআউট</a></li>
				</ul>
				
			</div>
		</div>
		<?php include("../includes/layouts/footer.php"); ?>