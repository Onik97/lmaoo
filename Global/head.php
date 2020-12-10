<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.css" rel="stylesheet">
<link rel="stylesheet" href="../Css/notifications.css">

<script>
<?php 
if(isset($_SESSION['userLoggedIn'])) 
{
  $userLoggedIn = $_SESSION['userLoggedIn'];
  include_once("../User/user.php"); ?>
  
  const userId = "<?php echo $userLoggedIn->getId(); ?>"; 
  const userForename = "<?php echo $userLoggedIn->getForename(); ?>";
  const userSurname = "<?php echo $userLoggedIn->getSurname(); ?>";
  const userUsername = "<?php echo $userLoggedIn->getUsername(); ?>";
  const userLevel = "<?php echo $userLoggedIn->getLevel(); ?>"; <?php 
} ?>

</script>