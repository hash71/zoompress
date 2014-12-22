<div id="footer">
			Copyright <?php echo date("Y")?>&copy Nazmul Hasan
		</div>
	</body>
</html>

<?php 
if (isset($connection)) {
	mysqli_close($connection);	
}
?>	