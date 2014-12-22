<?php 
if(!isset($layout_context)){
	$layout_context = "public";
}
?>
<html>
	<head>
		<meta charset="UTF-8"/>
		<title>..::JoomPress::.. <?php if($layout_context =="admin") echo "[ADMIN]"; ?></title>
		<link href="stylesheets/public.css" rel="stylesheet" type="text/css" media="all"/>

		
	</head>
	<body>
		<div id="header">
			<h1>..::জুমপ্রেস::.. <?php if($layout_context =="admin") echo "[ADMIN]"; ?></h1>			
		</div>