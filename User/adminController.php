<?php require('userController.php'); 
//error_reporting(0);	

if(isset($_GET['edit']))
{
	$userChosen = getUserById($_GET['edit']);
	?>
	<form>
		ID 	<?php echo $_GET['edit'] ?>
		Name: <p><?php echo $userChosen->forename; ?></p>
	</form>
<?php }
else
{
	// Nothing
}

if(isset($_GET['delete']))
{
	echo "Got your ID delete " . $_GET['delete'];
}
else
{
	// Nothing
}
?>