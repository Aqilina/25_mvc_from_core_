<?php require APPROOT . '/views/inc/header.php'; ?>

    <div class="row">
        <div class="col-lg-6 mx-auto">
            <div class="card card-body bg-light mt-5">
                <?php flash('register_fail') ?>
                <h2>Create an account</h2>
                <p>Please fill in the form to register with us</p>
                <form action="" method="post">
                    <div class="form-group">
                        <label for="name">Name:<sup>*</sup></label>
                        <input type="text" name="name" id="name" class="<?php echo (!empty($data['errors']['nameErr'])) ? 'is-invalid' : ''; ?> form-control form-control-lg" value="<?php echo $data['name'] ?>">
                        <span class='invalid-feedback'><?php echo $data['errors']['nameErr'] ?></span>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:<sup>*</sup></label>
                        <input type="email" name="email" id="email" class="<?php echo (!empty($data['errors']['emailErr'])) ? 'is-invalid' : ''; ?> form-control form-control-lg" value="<?php echo $data['email'] ?>">
                        <span class='invalid-feedback'><?php echo $data['errors']['emailErr'] ?></span>
                    </div>
                    <div class="form-group">
                        <label for="password">Password:<sup>*</sup></label>
                        <input type="password" name="password" id="password" class="<?php echo (!empty($data['errors']['passwordErr'])) ? 'is-invalid' : ''; ?> form-control form-control-lg" value="<?php echo $data['password'] ?>">
                        <span class='invalid-feedback'><?php echo $data['errors']['passwordErr'] ?></span>
                    </div>
                    <div class="form-group">
                        <label for="confirmPassword">Confirm Password:<sup>*</sup></label>
                        <input type="password" name="confirmPassword" id="confirmPassword" class="<?php echo (!empty($data['errors']['confirmPasswordErr'])) ? 'is-invalid' : ''; ?> form-control form-control-lg" value="<?php echo $data['confirmPassword'] ?>">
                        <span class='invalid-feedback'><?php echo $data['errors']['confirmPasswordErr'] ?></span>
                    </div>

                    <div class="row">
                        <div class="col">
                            <input type="submit" class="btn btn-primary btn-block">
                        </div>
                        <div class="col">
                            <a href="<?php echo URLROOT ?>/users/login" class='btn btn-light btn-block '>Have an account? Login</a>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>


    <script>
    console.log('its alive');
    </script>

<?php require APPROOT . '/views/inc/footer.php'; ?>