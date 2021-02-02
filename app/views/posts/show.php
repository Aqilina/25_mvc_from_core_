<?php
require APPROOT . '/views/inc/header.php';
?>

<h1>This is single page template for the post <?php echo $data['post']->id?></h1>

<?php var_dump($data['post']);?>
<?php
require APPROOT . '/views/inc/footer.php';
?>
