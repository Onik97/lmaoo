<?php ob_start(); require_once("../Project/projectController.php"); require_once("../Ticket/ticketController.php"); require_once("../User/userController.php");
$projectController = new projectController();
$ticketController = new ticketController();
$userController = new userController();
?>
<link rel="stylesheet" href="../Css/navbar.css">
<nav class="navbar navbar-expand-lg navbar-light bg-light navbar-fixed-top">

    <?php $userController->loadDarkModeToggle($_COOKIE["lmaooDarkMode"], $userLoggedIn); ?>

    <div class="container">

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation" id="exampleNavComponents">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse w-100 order-3 dual-collapse2" id="navbarNav">
            <?php $ticketController->loadSearchBar($userLoggedIn) ?>

            <ul class="nav navbar-nav ml-auto mr-5">

                <li class="nav-item"> <a class="nav-link" id="homeNav" href="../Home/index.php">Home</a> </li>
                <?php $projectController->loadProjectsInNavBar($userLoggedIn) ?>

                <li class="nav-item dropdown">
                    <a id="accountNav" href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Account<span class="caret"></span></a>

                    <div class="dropdown-menu">
                        <?php $userController->loadDropdownItems($userLoggedIn); ?>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>