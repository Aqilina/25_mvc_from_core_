<?php
require APPROOT . '/views/inc/header.php';
?>

<?php //var_dump($data['post']);?>
<?php //var_dump($data['user']);?>
<!--<h1>This is single page template for the post --><?php //echo $data['post']->id?><!--</h1>-->

<a href="<?php echo URLROOT?>/posts" class="btn btn-light my-3"><i class="fa fa-chevron-left"></i> Back</a>

<h1 class="display-3"><?php echo $data['post']->title?></h1>
<div class="bg-secondary text-white p-2 mb-3">
    Written by <strong><?php echo $data['user']->name ?></strong>
    On : <?php echo $data['post']->created_at?>
</div>
<p class="lead"><?php echo $data['post']->body?></p>


<!-------------------------------------------------------------------------------------------------------->
<!--SHOW THIS ONLY IF THIS POST BELONGS TO THIS!!! USER-->
<?php //var_dump($data['post']->user_id);?>
<?php //var_dump($data['post']);?>
<?php //var_dump($data['user']);?>
<?php //var_dump($_SESSION);?>
<hr>


<?php if ($data['post']->user_id === $_SESSION['user_id']) : ?>
<!--PARODO PARAM ID-->
<a href="<?php echo URLROOT . '/posts/edit/' . $data['post']->id?>" class="btn btn-info"><i class="fa fa-pencil"></i> Edit</a>

<!--forma apdorjama posts/delete-->
<form action="<?php echo URLROOT?>/posts/delete" method="post" class="pull-right">
    <button type="submit" class="btn btn-danger"><i class="fa fa-close"></i> Delete</button>
</form>
<?php
endif;
?>

<?php
require APPROOT . '/views/inc/footer.php';
?>
