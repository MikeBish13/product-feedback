<div class="comments">
    <h3 class="comments__total"><?php echo $comment_count ?> Comments</h3>
    <?php 
    function getComments($parent) {
        global $connection;
        $post_id = mysqli_real_escape_string($connection, $_GET['id']);
        $query = "SELECT * FROM comments WHERE comment_post_id=$post_id AND comment_parent=$parent";
        $result = mysqli_query($connection, $query);

        if(mysqli_num_rows($result)) {
            echo "<ul class='main-comment-list'>\n";
            while (($row = mysqli_fetch_array($result))) { ?>
                <li>
                    <div class="comment">
                        <img class="comment__user-img" src="<?php echo getUserImage($row['comment_user_id']); ?>">
                        <div class="comment__names">
                            <p class="comment__name"><?php echo getUserName($row["comment_user_id"]); ?></p>
                            <p class="comment__username">@<?php echo getUserUsername($row["comment_user_id"]); ?></p>
                        </div>
                        <p class="comment__text"><span class="comment__reply-to"><?php echo $row['comment_parent'] != 0 ? '@' . getCommentReplyUsername($row['comment_parent']) . ' ' : ''; ?></span><?php echo $row["comment_content"]; ?></p>
                        <button class="comment__reply btn-reply">Reply</button>
                        <form class="comment__form" action="includes/add_comments.php" method="POST">
                            <textarea class="comment__reply-text" maxlength="255" name="reply_text"></textarea>
                            <input class="comment__submit btn-one" type="submit" name="submit_reply" value="Post Reply">
                            <input type="hidden" name="parent" value="<?php echo $row['comment_id'] ?>">
                            <input type="hidden" name="comment_post_id" value="<?php echo $row['comment_post_id'] ?>">
                            <input type="hidden" name="replied_to" value="<?php echo getUserUsername($row['comment_user_id']) ?>">
                            <input type="hidden" name="post_id" value="<?php echo $post_id ?>">
                        </form> 
                    </div>
                    <?php getComments($row["comment_id"]) ?>
                </li>
            <?php }
            echo "</ul>\n";
        } else {
            echo '';
        }    
    }

    getComments(0);
    ?>
</div>
