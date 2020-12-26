<?php session_start(); if (isset($_SESSION['userLoggedIn'])) { header("Location: ../Ticket/index.php"); } ?>

<!DOCTYPE html>
<title>Register Page</title>

<head>
  <p id="navBarActive" hidden>registerPage</p>
  <link rel="stylesheet" href="../Css/LoginRegister.css">
  <?php include("../Global/head.php"); ?>
</head>

<body>
  <?php include("../Global/navBar.php"); ?>

  <main class="d-flex align-items-center min-vh-100 py-3 py-md-0">
    <div class="container">
      <div class="card">
        <div class="row no-gutters">
          <div class="col-md-6">
            <img id="otal_logo" src="../Images/otal_logo.png">
          </div>
          <div class="col-md-6 text-center">
            <div class="card-body">
              <h2 class="register-header">Sign up</h2>
              <form action="userController.php" onSubmit="return checkPassword(this)" method='POST'>
                <div class="form-group">
                  <input type="text" class="form-control" name="forename" placeholder="First name" id="forenameRegister" required>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" name="surname" placeholder="Last name" id="surnameRegister" required>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" name="username" placeholder="Username" id="usernameRegister" required>
                </div>
                <div class="form-group">
                  <input type="password" class="form-control" name="password1" placeholder="Password" id="password1Register" required>
                </div>
                <div class="form-group">
                  <input type="password" class="form-control" name="password2" placeholder="Confirm password" id="password2Register" required>
                </div>
                <input type="hidden" name="function" value="register">
                <button type="submit" value="Submit" class="btn btn-success btn-block">Register</button>

                <div class="form-group mt-3">
                  <a class="register" href="../User/index.php">Already Registered? Login here!</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

      <?php include("../Global/scripts.php"); ?>
      <script src="../Script/User/passwordchecker.js"></script>
</body>

</html>