<?php
require APPROOT . '/views/inc/header.php'; ?>

<div class="row">
    <div class="col-md-6 mx-auto">
        <div class="card card-body bg-light mt-5">
            <?php flash('register_success');?>
            <h2>Login</h2>
            <form action="" method="post">

                <div class="form-group">
                    <label for="email">Email: <sup>*</sup></label>
                    <input
                        type="text"
                        name="email"
                        id="email"
                        class="<?php echo (!empty($data['email'])) ? 'is-invalid' : '' ?>form-control form-control-lg"
                        value="<?php echo $data['email'] ?>"
                    >
                    <span class="invalid-feedback"><?php echo $data['emailErr'] ?></span>
                </div>

                <div class="form-group">
                    <label for="password">Password: <sup>*</sup></label>
                    <input
                        type="text"
                        name="password"
                        id="password"
                        class="<?php echo (!empty($data['passwordErr'])) ? 'is-invalid' : '' ?>form-control form-control-lg"
                        value="<?php echo $data['passwordErr'] ?>"
                    >
                    <span class="invalid-feedback"><?php echo $data['passwordErr'] ?></span>
                </div>

                <div class="row">
                    <div class="col">
                        <input type="submit" value="Login" class="btn btn-primary btn-block">
                    </div>
                    <div class="col">
                        <a href="<?php echo URLROOT?>/users/register" class="btn btn-light btn-block float-right">Don't have an account? Register</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>

