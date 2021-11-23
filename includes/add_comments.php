<?php 
include 'db.php';
include 'functions.php';
session_start();
?>

<?php
    if(isset($_POST['submit_reply'])) {
        $post_id = mysqli_real_escape_string($connection, $_POST['post_id']);
        $comment_parent = mysqli_real_escape_string($connection, $_POST['parent']);
        $comment_post_id = mysqli_real_escape_string($connection, $_POST['comment_post_id']);
        $comment_user_id = mysqli_real_escape_string($connection,$_SESSION['user_id']);
        $comment_content = mysqli_real_escape_string($connection, $_POST['reply_text']);
        $replied_to = mysqli_real_escape_string($connection, $_POST['replied_to']);
        $query = "INSERT INTO comments (comment_post_id, comment_content, comment_user_id, comment_parent) VALUES ($comment_post_id, '$comment_content', $comment_user_id, $comment_parent)";
        $result = mysqli_query($connection, $query);
        if($result) {
            updateCommentCount($post_id);
            header("Location: ../post.php?id=$comment_post_id");
        } else {
            echo "error: " . mysqli_error($connection);
        } 
    }
?>

<?php 
    if(isset($_POST['submit_comment'])) {
        $comment_parent = 0;
        $comment_user_id = mysqli_real_escape_string($connection, $_SESSION['user_id']);
        $comment_content = mysqli_real_escape_string($connection, $_POST['comment_text']);
        $post_id = mysqli_real_escape_string($connection, $_POST['post_id']);
        $query = "INSERT INTO comments (comment_post_id, comment_content, comment_user_id, comment_parent) VALUES ($post_id, '$comment_content', $comment_user_id, $comment_parent)";
        $result = mysqli_query($connection, $query);
        if($result) {
            updateCommentCount($post_id);
            header("Location: ../post.php?id=$post_id");
        } else {
            echo "error: " . mysqli_error($connection);
        }
    }
?>