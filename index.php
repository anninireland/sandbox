<html>
 <head>
  <title>SandBox</title>
 </head>
 <body>
 <?php echo '<p>Hello World</p>'; 
 $free = "hi";
 ?> 

<form action="" method="get">
	<input class="doneButton" type="submit" value="btn" />
	<input class="doneButton" type="submit" name="select" value="select" />
	<input class="doneButton" type="submit" name="insert" value="insert" />
</form>

<div>
	<?php echo $free ?>
	<p><?php echo $free ?></p>
</div>

<?php
 if(isset($_GET['insert'])){

	echo "are you there?";
 }
 elseif(isset($_GET['select'])){
 	echo "The select function is called.";
 }

?>


 <html>
  <form action="process.php" method="post">
  <input type="text" name="firstname">
  <input type="text" name="email" >
  <input type="submit" name="submit" value="login">
  </form>
</html>

 </body>
</html>