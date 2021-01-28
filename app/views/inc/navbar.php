<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?php echo URLROOT ?>"> <?php echo SITENAME ?></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav ">
                <a class="nav-link"  href="<?php echo URLROOT ?>">Home</a>
                <a class="nav-link" href="<?php echo URLROOT ?>/pages/about">About</a>
            </div>

            <div class="navbar-nav ml-auto">
                <a class="nav-link" href="<?php echo URLROOT ?>/users/register">Register</a>
                <a class="nav-link" href="<?php echo URLROOT?> /users/login">Login</a>
            </div>
        </div>
    </div>
</nav>