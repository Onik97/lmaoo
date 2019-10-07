<?php?>

<!DOCTYPE html>
<html>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="RegisterPage.css">
<title>Register Page</title>
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
                </li>
                <!-- Navbar link with a dropdown menu -->
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Account
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="active"><a href="#">Register</a></li>
                        <li><a href="../User/index.php">Login</a></li>
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
  Forename:<br> <input type="text" name="forename"> <br>
  Surname:<br> <input type="text" name="surname"> <br>
  Username:<br> <input type="text" name="username"> <br>
  Password:<br> <input type="password" name="password"> <br>
  Confirm Password:<br> <input type="password" name="password2"> <br>
  <input class="one" type="submit" value="Submit"> <br><br>
  <a href="/lmaoo/User/index.php">Register? Login here!</a>
</form>
    </div>
    </div>
</body>
</html>