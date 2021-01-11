<?php require("../User/user.php"); session_start(); if (isset($_SESSION['userLoggedIn'])) { header("Location: ../Ticket/index.php"); } ?>

<!DOCTYPE html>
<html>
<title>Login</title>

<head>
	<p id="navBarActive" hidden>loginPage</p>
	<link rel="stylesheet" href="../Css/LoginRegister.css">
	<?php include("../Global/head.php"); ?>
</head>

<body>
	<?php include("../Global/navBar.php");
	if (isset($_SESSION['message'])) {
		echo "<div class='alert alert-warning'>" . $_SESSION['message'] . "</div>";
		session_unset();
	} ?>

	<main class="d-flex align-items-center min-vh-100 py-3 py-md-0">
		<div class="container">
			<div class="card">
				<div class="row no-gutters">
					<div class="col-md-6">
						<img id="otal_logo" src="../Images/otal_logo.png">
					</div>
					<div class="col-md-6 text-center">
						<div class="card-body">
							<h2 class="header">Member login</h2>
							<form action="userController.php" method='POST'>
								<div class="form-group">
									<input type="text" class="form-control" name="username" placeholder="Username" id="usernameLogin" required>
								</div>
								<div class="form-group mb-4">
									<input type="password" class="form-control" name="password" placeholder="Password" id="passwordLogin" required>
								</div>
								<input type="hidden" name="function" value="login">
								<button type="submit" value="Submit" class="btn btn-success btn-block">Login</button>
								<div class="form-group mt-3">
									<a class="register" href="../User/register.php">Not Registered? Click here!</a>
								</div>
							</form>
							<a href="../Github/authorize.php?function=login" class="github"><i class="fab fa-github"></i> Sign in with Github</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</main>
<?php include("../Global/scripts.php"); ?>
</body>

</html>