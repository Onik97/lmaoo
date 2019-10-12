<<<<<<< HEAD
<?php require("../User/user.php");
session_start(); 
?>
<!DOCTYPE html>
<html>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="UserPage.css">
<title>Login</title>
<head>

<nav class="navbar navbar-default navbar-fixed-top">

<!-- Navbar Container -->
<div class="container">
	<!-- Navbar Header [contains both toggle button and navbar brand] -->
	<div class="navbar-header">
        <!-- Toggle Button [handles opening navbar components on mobile screens]-->
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#exampleNavComponents" aria-expanded"false">
			<i class="glyphicon glyphicon-align-center"></i>
        </button>
		<p class="navbar-text text-right"></p>
        </div>

    <!-- Navbar Collapse [contains navbar components such as navbar menu and forms ] -->
        <div class="collapse navbar-collapse" id="exampleNavComponents">

    <!-- Navbar Menu -->
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="../index.php">Home</a>
                </li>
                <li>
                    <a href="../About/index.php">About</a>
                </li>
				<li>
					<a href="../Ticket/index.php">Ticket</a>
                <!-- Navbar link with a dropdown menu -->
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Account
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="register.php">Register</a></li>
                        <li class="active"><a href="#">Login</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
	</head>
<body>
         <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
         <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<div class="top-buffer">
	<div class="container">
		<form action="userController.php" method='POST'>
			Username:<br>
		<input type="text" name="loginUsername">
		<br>
			Password:<br>
		<input type="password" name="loginPassword">
		<input class="one" type="submit" value="Submit"> <br><br>
		<a href="/lmaoo/User/register.php">Not Registered? Click here!</a>
            <p> <?php if (isset($_SESSION['errorMessage'])) { echo $_SESSION['errorMessage']; session_unset(); } ?> </p>
		</form>
	</div>
</div>

</body>

=======
    <?php require("../User/user.php");
session_start(); 
?>
<!DOCTYPE html>
<html>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="UserPage.css">
<title>Login</title>
<head>

<nav class="navbar navbar-default navbar-fixed-top">

<!-- Navbar Container -->
<div class="container">
	<!-- Navbar Header [contains both toggle button and navbar brand] -->
	<div class="navbar-header">
        <!-- Toggle Button [handles opening navbar components on mobile screens]-->
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#exampleNavComponents" aria-expanded="false">
			<i class="glyphicon glyphicon-align-center"></i>
        </button>
		<p class="navbar-text text-right"></p>
        </div>

    <!-- Navbar Collapse [contains navbar components such as navbar menu and forms ] -->
        <div class="collapse navbar-collapse" id="exampleNavComponents">

    <!-- Navbar Menu -->
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="../index.php">Home</a>
                </li>
                <li>
                    <a href="../About/index.php">About</a>
                </li>
				<li>
					<a href="../Ticket/index.php">Ticket</a>
                <!-- Navbar link with a dropdown menu -->
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Account
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="register.php">Register</a></li>
                        <li class="active"><a href="#">Login</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
	</head>
<body>
         <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
         <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<div class="top-buffer">
	<div class="container">
		<form action="userController.php" method='POST'>
			Username:<br>
		<input type="text" name="loginUsername">
		<br>
			Password:<br>
		<input type="password" name="loginPassword">
		<input class="one" type="submit" value="Submit"> <br><br>
		<a href="/lmaoo/User/register.php">Not Registered? Click here!</a>
            <p><?php if(isset($_SESSION['message'])){echo$_SESSION['message'];session_unset();}?></p>
		</form>
	</div>
</div>

</body>

>>>>>>> 33f64ffd8dcfb4211b9cff3484e2b4c54d185db2
</html>