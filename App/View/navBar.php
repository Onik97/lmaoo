<?php use Lmaoo\Core\Render; ?>

<link rel="stylesheet" href="/Style/navbar.css">
<nav class="navbar navbar-expand-lg">

    <?php if(!isset($_COOKIE["lmaooDarkMode"])) $_COOKIE["lmaooDarkMode"] = 0; ?>
    <?php Render::loadDarkModeToggle($_COOKIE["lmaooDarkMode"], $_SESSION['userLoggedIn'] ?? null); ?>

    <div class="container">

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation" id="exampleNavComponents">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse w-100 order-3 dual-collapse2" id="navbarNav">
            <?php Render::SearchBar($_SESSION['userLoggedIn'] ?? null); ?>

            <ul class="nav navbar-nav ml-auto mr-5">

                <li class="nav-item"> <a class="nav-link" id="homeNav" href="/">Home</a> </li>
                <?php Render::ProjectsInNavBar($_SESSION['userLoggedIn'] ?? null); ?>

                <li class="nav-item dropdown">
                    <a id="accountNav" href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Account<span class="caret"></span></a>

                    <div class="dropdown-menu">
                        <?php Render::DropdownItems($_SESSION['userLoggedIn'] ?? null); ?>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>

