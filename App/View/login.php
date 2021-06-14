<p id="navBarActive" hidden>loginPage</p>

<main class="d-flex align-items-center min-vh-100 py-3 py-md-0">
	<div class="container">
		<div class="card">
			<div class="row no-gutters">
				<div class="col-md-6">
					<img id="otal_logo" src="../Images/otal_light.png">
				</div>
				<div class="col-md-6 text-center">
					<div class="card-body">
						<h2 class="header">Member login</h2>
						<form action="/login" method='POST'>
							<div class="form-group">
								<input type="text" class="form-control" name="username" placeholder="Username" id="usernameLogin" required>
							</div>
							<div class="form-group mb-4">
								<input type="password" class="form-control" name="password" placeholder="Password" id="passwordLogin" required>
							</div>
							<input type="hidden" name="function" value="login">
							<button type="submit" value="Submit" class="btn btn-success btn-block">Login</button>
							<div class="form-group mt-3">
								<a class="register" href="/register">Not Registered? Click here!</a>
							</div>
						</form>
						<a href="/github/authorize/login" class="github"><i class="fab fa-github"></i> Sign in with Github</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>
