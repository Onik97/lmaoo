<nav class="navbar navbar-default navbar-fixed-top">
<!-- Navbar Container -->
<div class="container">
	<!-- Navbar Header [contains both toggle button and navbar brand] -->
	<div class="navbar-header">
        <!-- Toggle Button [handles opening navbar components on mobile screens]-->
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#exampleNavComponents" aria-expanded="false">
			<i class="glyphicon glyphicon-align-center"></i>
        </button>
		<p class="navbar-text text-right">
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
        </div>
    <!-- Navbar Collapse [contains navbar components such as navbar menu and forms ] -->
        <div class="collapse navbar-collapse" id="exampleNavComponents">

    <!-- Navbar Menu -->
            <ul class="nav navbar-nav navbar-right">
                <li> <a href="../Home/index.php">Home</a> </li>
                <li> <a href="../About/index.php">About</a> </li>
                <li> <a href="../Project/index.php">Project</a> </li>
				<li> <a href="../Ticket/index.php">Ticket</a>
                <!-- Navbar link with a dropdown menu -->
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Account
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <?php if (!isset($userLoggedIn)) 
                                { ?>
                            <li><a id="registerNav" href="../User/register.php">Register</a></li>
                            <li><a id="loginNav" href="../User/index.php">Login</a></li>
                        <?php   } 
                              else if ($userLoggedIn->getLevel() == "1")
                                { ?>
                                    <li><a id="editAccountNav" data-toggle="modal" data-target="#view-modal" role="button">Edit Account</a></li> 
                                    <li><a id="logoutNav" href="../User/logout.php">Logout</a></li>
                        <?php   } else 
                                { ?>
                                    <li><a id="editAccountNav" data-toggle="modal" data-target="#view-modal" role="button">Edit Account</a></li>   
                                    <li><a id="logoutNav" href="../User/logout.php">Logout</a></li>
                                    <li><a id="adminNav" href="../User/admin.php">Admin</a></li>
                        <?php   } ?>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>