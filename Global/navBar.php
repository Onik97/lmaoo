<nav class="navbar navbar-expand-lg navbar-light bg-light navbar-fixed-top">
    
<!-- Navbar Container -->
    <div class="container">
	    <!-- Navbar Header [contains both toggle button and navbar brand] -->
		        <p id="welcomeMessage" class="navbar-brand mt-3 ml-3 mr-auto">
                        <?php
                        if(isset($_SESSION['userLoggedIn']))
                        {
                            $userLoggedIn = $_SESSION['userLoggedIn'];
                            echo "Welcome " . $userLoggedIn->getForename() . " " . $userLoggedIn->getSurname();
                        }
                        else
                        {
                            echo "Welcome to Lmaoo! Please login for full access!";
                        }
                        ?>
                </p>

        <!-- Navbar Collapse [contains navbar components such as navbar menu and forms ] -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation" id="exampleNavComponents">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse w-100 order-3 dual-collapse2" id="navbarNav">
            <!-- Navbar Menu -->
            <ul class="nav navbar-nav ml-auto mr-5">
                <li class="nav-item">
                    <a class="nav-link" id="homeNav" href="../Home/index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="aboutNav" href="../About/index.php">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="projectNav" href="../Project/index.php">Project</a>
                </li>

                <!-- Navbar link with a dropdown menu -->
                <li class="nav-item dropdown">
                    <a id="accountNav" href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Account
                        <span class="caret"></span>
                    </a>
    
                    <div class="dropdown-menu">
                        <?php if (!isset($userLoggedIn)) 
                                { ?>
                            <a class="dropdown-item" id="registerNav" href="../User/register.php">Register</a>
                            <a class="dropdown-item" id="loginNav" href="../User/index.php">Login</a>
                        <?php   } 
                              else if ($userLoggedIn->getLevel() <= 2)
                                { ?>
                                    <a class="dropdown-item" id="editAccountNav" data-toggle="modal" data-target="#view-modal" role="button">Edit Account</a> 
                                    <a class="dropdown-item" id="logoutNav" href="../User/logout.php">Logout</a>
                        <?php   } else 
                                { ?>
                                    <a class="dropdown-item" id="editAccountNav" data-toggle="modal" data-target="#view-modal" role="button">Edit Account</a>   
                                    <a class="dropdown-item" id="logoutNav" href="../User/logout.php">Logout</a>
                                    <a class="dropdown-item" id="adminNav" href="../User/admin.php">Admin</a>
                        <?php   } ?>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>