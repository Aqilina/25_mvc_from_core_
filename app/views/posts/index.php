<?php
require APPROOT . '/views/inc/header.php';
?>

<div class="row m">
    <div class="col">
        <h1>Posts</h1>
    </div>
    <div class="col">
        <a href="<?php echo URLROOT; ?>/posts/add" class="btn btn-primary pull-right mt-2">
            <i class="fa fa-pencil"></i>
            Add post
        </a>
    </div>
</div>

<div class="row">
    <?php foreach ($data['posts'] as $post): ?>
    <div class="col-md-6">
        <div class="card mb-2">
            <div class="card-body">
            <h4 class="card-title"><?php echo $post->title?></h4>
            <p class="bg-light p-2 mb-3">Written by <?php echo $post->name?></p>
            <p class="card-text"><?php echo $post->body?></p>
                <a href="<?php echo URLROOT . '/posts/show/' . $post->postId; ?>" class="card-link">Read more</a>
            </div>
            <p class="card-footer">Created at: at<?php echo $post->postCreated?></p>
        </div>
    </div>
    <?php endforeach; ?>
</div>

<?php //var_dump($data['posts']);?>

<?php require APPROOT . '/views/inc/footer.php';

