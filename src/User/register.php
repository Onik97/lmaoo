<!DOCTYPE html>
<title>Register Page</title>

<head>
  <p id="navBarActive" hidden>registerPage</p>
  <link rel="stylesheet" href="../Css/LoginRegister.css">
  <?php include("../../includes/head.php"); ?>
</head>

<body>
  <?php include("../../includes/navBar.php"); ?>

  <main class="d-flex align-items-center min-vh-100 py-3 py-md-0">
    <div class="container">
      <div class="card">
        <div class="row no-gutters">
          <div class="col-md-6">
            <img id="otal_logo" src="../Images/otal_light.png">
          </div>
          <div class="col-md-6 text-center">
            <div class="card-body">
              <h2 class="register-header">Sign up</h2>
              <!-- onSubmit="return registerValidation()" onkeyup="validateUsername()" -->
              <form id="registerForm" name="registerForm" action="target.php"  method='POST'>
                <div class="form-group">
                  <input type="text" class="form-control" name="forename" placeholder="First name" id="forenameRegister" required>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" name="surname" placeholder="Last name" id="surnameRegister" required>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" name="username" placeholder="Username" id="usernameRegister" required>
                  <small id="usernameMessage"></small>
                </div>
                <div class="form-group">
                  <input type="password" class="form-control" name="password1" placeholder="Password" id="password1Register" required>
                </div>
                <div class="form-group">
                  <input type="password" class="form-control" name="password2" placeholder="Confirm password" id="password2Register" required>
                </div>
                <input type="hidden" name="function" value="register">
                <button id="registerBtn" type="submit" value="Submit" class="btn btn-success btn-block">Register</button>
                <small id="validateMessage" hidden></small>
                <div class="form-group mt-3">
                  <a class="register" href="../User/index.php">Already Registered? Login here!</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

      <?php include("../../includes/scripts.php"); ?>
      <script type="module" src="../Script/src/register.js"></script>
      <script src="../Script/register.js"></script>
</body>

</html>