<?php
include './includes/header.php';
?>

<?php
if(isset($_GET['id'])) {
    $id = mysqli_real_escape_string($connection, $_GET['id']);
    $query = "SELECT * FROM posts WHERE post_id=$id";
    $result = mysqli_query($connection, $query);
    while($row = mysqli_fetch_array($result)) { 
        $id = $row['post_id'];
        $title = $row['post_title'];
        $upvotes = $row['post_upvotes'];
        $description = $row['post_description'];
        $comment_count = $row['post_comment_count'];
        $category_title = getCategoryTitle($row['post_category_id']);
    }
}
?>

<div class="post post-container">
    <div class="post__header">
        <a class="btn-back" href="./index.php"><img src="./assets/shared/icon-arrow-left.svg">Go Back</a>
        <a class="btn-two" href="./editPost.php?id=<?php echo $id ?>">Edit Feedback</a>
    </div>

    <div class="post-item post__item">
        <a href="">
            <button class="post-item__upvote btn-upvote" value="<?php echo $id ?>">
                <svg width="10" height="7" xmlns="http://www.w3.org/2000/svg"><path d="M1 6l4-4 4 4" stroke="#4661E6" stroke-width="2" fill="none" fill-rule="evenodd"/></svg>
                <span><?php echo $upvotes ?></span>
            </button>
            <h3 class="post-item__title"><?php echo $title ?></h3>
            <p class="post-item__desc body-one"><?php echo $description ?></p>
            <p class="post-item__category btn-category"><?php echo $category_title ?></p>
            <div class="post-item__comments">
                <img src="./assets/shared/icon-comments.svg">
                <p class="body-one"><?php echo $comment_count ?></p>
            </div>
        </a>
    </div>

    <?php 
    include './includes/post_comments.php'
    ?>

    <div class="post__add-comment">
        <h3>Add Comment</h3>
        <form action="includes/add_comments.php" method="POST">
            <textarea class="post__add-comment-text" maxlength="250" name="comment_text" placeholder="Type your comment here"></textarea>
            <div class="post__add-comment-submit">
                <p class="post__characters"><span class="post__character-count">250</span> Characters left</p>
                <input  class="btn-one" type="submit" name="submit_comment" value="Post Comment">
                <input type="hidden" name="post_id" value="<?php echo $id ?>"> 
            </div>
        </form> 
    </div>

</div>

<?php
include './includes/footer.php';
?>