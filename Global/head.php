<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- Bootstrap -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.css" rel="stylesheet">
<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.js"></script>

<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script type="text/javascript" src="../Script/server.js"></script>

<link rel="stylesheet" href="../Css/notifications.css">
<script src="../Script/notifications.js"></script>

<script>
function overHang(type, message)
{
  const myNotification = window.createNotification(
  {
    theme: type,
    showDuration: 3500,
    displayCloseButton: true,
    closeOnClick: true
  });
  
  myNotification(
  {
    message: message
  });
}

<?php 
if(isset($_SESSION['userLoggedIn']))
{
  $userLoggedIn = $_SESSION['userLoggedIn'];
  include_once("../User/user.php");
  ?>
const userId = "<?php echo $userLoggedIn->getId(); ?>"; 
const userForename = "<?php echo $userLoggedIn->getForename(); ?>";
const userSurname = "<?php echo $userLoggedIn->getSurname(); ?>";
const userUsername = "<?php echo $userLoggedIn->getUsername(); ?>";
const userLevel = "<?php echo $userLoggedIn->getLevel(); ?>";
<?php } ?>
</script>
<?php include("modal.php");