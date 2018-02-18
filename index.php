<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
	<title>Carros</title>
	<style>
	.painelcarro {	
		border: 1px solid red;
	    padding: 5px;
	}
	.erro{
		display:none;
		color:red;
	}
	
	</style>
</head>
<body>
<div class="container">

<?php require_once("painel.carro.php") ?>

<?php require_once("lista.carro.php") ?>

</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>	
<script src="js/main.js"></script>
</body>
</html>
