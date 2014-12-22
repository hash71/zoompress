<?php 
session_start();

function message(){
	if (isset($_SESSION["message"])) {
		$output =  "<div class=\"message\">";
		$output .= htmlentities($_SESSION["message"]);				
		$output .= "</div>";
		$_SESSION["message"] = NULL;
		return $output;	 	
	}	
} 

function errors(){
	if(isset($_SESSION["errors"])){
		$errors = $_SESSION["errors"];
		$_SESSION["errors"] = NULL;
		return $errors; 
	}
}
?>