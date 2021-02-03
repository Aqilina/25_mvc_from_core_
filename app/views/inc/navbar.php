<nav class="navbar navbar-expand-sm navbar-dark bg-dark">
    <div class="container">
    <a class="navbar-brand" href="<?php echo URLROOT ?>"><?php echo SITENAME ?></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav mr-auto">
            <a class="nav-link <?php echo (isset($data['currentPage']) && $data['currentPage'] === 'home') ? 'active' : '' ; ?>" href="<?php echo URLROOT ?>">Home </a>
            <a class="nav-link <?php echo (isset($data['currentPage']) && $data['currentPage'] === 'about') ? 'active' : '' ; ?>" href="<?php echo URLROOT ?>/pages/about">About</a>
        </div>

        <div class="navbar-nav ml-auto">
<!--            show when not logged in-->
            <?php if (!isLoggedIn()) : ?>
            <a class="nav-link <?php echo (isset($data['currentPage']) && $data['currentPage'] === 'register') ? 'active' : '' ; ?>" href="<?php echo URLROOT ?>/users/register">Register</a>
            <a class="nav-link <?php echo (isset($data['currentPage']) && $data['currentPage'] === 'login') ? 'active' : '' ; ?>" href="<?php echo URLROOT ?>/users/login">Login</a>
            <?php else : ?>
<!--            show when logged in-->
            <a disabled class="nav-link active" href="#" >Welcome, <?php print $_SESSION['user_name']?>!</a>
            <a class="nav-link" href="<?php echo URLROOT ?>/users/logout">Logout</a>
            <?php endif; ?>

        </div>
    </div>
    </div>
</nav>