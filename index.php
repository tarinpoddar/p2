<?php
error_reporting(0);
ini_set('display_errors', 0);
?>

<!DOCTYPE html>

<html>
<head>
	<title>Tarin P2</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php require 'logic.php'; ?>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link rel='stylesheet' href='styles.css' type='text/css'>
	
</head>
<body>
	<div id="banner">
		<img src="images/banner.jpg">
	</div>
	
	<div class="container">
		<form action="index.php" method="POST">

			<div class="allign">
				<span class="lead"> Number of Words: </span>
				<input id="textbox" maxlength=1 type="text" placeholder="#" name="number_of_words">
			</div>

			<div class="allign">
				<label>
					<input class="cbox" type="checkbox" name="insert_number">
					<span class="lead"> Do you want to insert a number? </span>
				</label>

			</div class="allign">
			<div>
				<label>	
					<input class="cbox" type="checkbox" name="insert_symbol"> 
					<span class="lead"> Do you want to insert a symbol? </span>
				</label>
			</div>

			<div class="allign">
				<div id="position" class="lead"> Upper Case letters? </div>
				<label class="checkbox-inline">
					<input class="radiosize" type="radio" name="upper_case" value="all">
					<span class="lead"> All </span>
				</label>
				

			
				<label class="checkbox-inline">
					<input class="radiosize" type="radio" name="upper_case" value="none">
					<span class="lead"> None </span>
				</label>
		
				<label class="checkbox-inline">
					<input class="radiosize" type="radio" name="upper_case" value="camel_case">
					<span class="lead"> CamelCase </span>
				</label>
			</div>

			<div class="allign">
				<span class="lead"> How do you want the words to be separated? </span> <br>
				<select class = "form-control" id="dropdown" name="separator">	
					<option value="hyphens"> Hyphens </option> 	
					<option value="not_separated"> Not Separated </option>
					<option value="spaces"> Spaces </option> <br>
				</select>
			</div>
		
			<div class="allign">
      			<button type="submit" class="btn btn-primary" > Generate Another! </button>
      		</div>
		</form>	
		<div>
			<p> <span id="answer-text"> <?php echo $password ?> </span> <br> </p>
		</div>
		<div>
			<img class="comic" src="images/explainer.jpg"><br>
				<div class="bottom">
					<p class="texxt">Tarin Poddar <br> tarinpoddar27@gmail.com</p>
				</div>
		</div>
	</div>

</body>
</html>



