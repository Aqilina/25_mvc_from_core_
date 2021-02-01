<?php
require APPROOT . '/views/inc/header.php';
?>

<div class="row m">
    <div class="col">
        <h1>Posts</h1>
    </div>
    <div class="col">
        <a href="<?php echo URLROOT; ?>/posts/add" class="btn btn-primary pull-right">
            <i class="fa fa-pencil"></i>
            Add post
        </a>
    </div>
</div>



<?php require APPROOT . '/views/inc/footer.php';

