<?php
require APPROOT . '/views/inc/header.php';
?>

<?php //var_dump($data['post']);?>
<?php //var_dump($data['user']);?>


<!--SINGLE POST VIEW /posts/show/ID-->
<a href="<?php echo URLROOT ?>/posts" class="btn btn-light my-3"><i class="fa fa-chevron-left"></i> Back</a>

<h1 class="display-3"><?php echo $data['post']->title ?></h1>
<div class="bg-secondary text-white p-2 mb-3">
    Written by <strong><?php echo $data['user']->name ?></strong>
    On : <?php echo $data['post']->created_at ?>
</div>
<p class="lead"><?php echo $data['post']->body ?></p>


<!-------------------------------------------------------------------------------------------------------->
<!--SHOW THIS ONLY IF THIS POST BELONGS TO THIS!!! USER-->
<?php //var_dump($data['post']->user_id);?>
<?php //var_dump($data['post']);?>
<?php //var_dump($data['user']);?>
<?php //var_dump($_SESSION);?>

<!--MYGTUKAI 'EDIT' IR 'DELETE'-->
<hr>
<?php if ($data['post']->user_id === $_SESSION['user_id']) : ?>
    <!--PARODO PARAM ID-->
    <a href="<?php echo URLROOT . '/posts/edit/' . $data['post']->id ?>" class="btn btn-info"><i
                class="fa fa-pencil"></i> Edit</a>

    <!--forma apdorojama posts/delete-->
    <form action="<?php echo URLROOT . '/posts/delete/' . $data['post']->id ?>" method="post" class="pull-right">
        <button type="submit" class="btn btn-danger"><i class="fa fa-close"></i> Delete</button>
    </form>
<?php
endif;
?>

<!--------------------------------------------------------------------------------------------------------------------->
<!--//RODOMI KOMENTARAI -->
<?php if (isset($data['commentsOn'])) : ?>

    <hr class="mt-5 mb-4">
    <div class="row mb-5">
<!--        ----------------------------------------------------------------------------------------------------------------->
<!--        FORMA KOMENTARAMS RASYTI-->
        <div class="col-12">
            <h2>WRITE COMMENT</h2>
            <form action="" method="post" id="add-comment-form">
                <div class="form-group">
<!--                    //required padaro, kad jei tuscias, mestu zinute "please fill in this form"-->
                    <input required type="text" name="username" class="form-control" value="<?php echo $_SESSION['user_name']?>">
                </div>
                <div class="form-group">
                    <textarea required class="form-control" type="text" name="commentBody" id="" placeholder="Write your comment" ></textarea>
                </div>
                <button type="submit" class="btn btn-success">Comment</button>
            </form>

        </div>
<!--        -------------------------------------------------------------------------------------------------------->
            <div class="col-12">
            <h2 class="my-4">Comments</h2>
            <div id="comments" class="comment-container">
                <h2 class="display-3">Loading</h2>
            </div>
        </div>
    </div>

    <script>
        const commentsOutputEl = document.getElementById('comments')
        const addCommentFormEl = document.getElementById('add-comment-form')

        addCommentFormEl.addEventListener('submit', addCommentAsync) //submit veiks paspaudus ENTER

        fetchComments();

        function fetchComments() {
            fetch('<?php echo URLROOT . '/api/comments/' . $data['post']->id ?>')
                .then(resp => resp.json())
                .then(data => {
                    console.log(data)
                    generateHTMLComments(data.comments)
                });
        }

        function generateHTMLComments(commentsArr) {
            commentsOutputEl.innerHTML = ''
            commentsArr.forEach(function (commentObj) {
                commentsOutputEl.innerHTML += generateOneComment(commentObj)
            })
        }

        function generateOneComment(oneComment) {
            return `
                <div class="card">
                <div class="card-header">${oneComment.author}
                <span>${oneComment.created_at}</span></div>
            <div class="card-body">
                ${oneComment.comment_body}
            </div>
            </div>`
        }

        // prideda komentara
        function addCommentAsync(event) {
            event.preventDefault();  // NELEIDZIA FORMOS ISSIUSTI SU PHP

            const addCommentFormData = new FormData(addCommentFormEl)


            fetch('<?php echo URLROOT . '/api/addComment/' . $data['post']->id ?>', {
                method: 'post',
                body: addCommentFormData
            }).then(response => response.text())
            .then(data => {
                console.log(data)
            }). catch(error => console.error(error))
        }
    </script>


<?php endif; ?>

<?php
require APPROOT . '/views/inc/footer.php';
?>
