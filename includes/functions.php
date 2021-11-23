

<?php

function getCategoryTitle($id) {
    global $connection;
    $id = mysqli_real_escape_string($connection, $id);
    $query = "SELECT * FROM categories WHERE category_id=$id";
    $result = mysqli_query($connection, $query);
    if(!$result) {
        echo 'error' + mysqli_error($connection);
    }
    while($row = mysqli_fetch_array($result)){
        return $row['category_title'];
    }
}

function getCategoryId($title) {
    global $connection;
    $title = mysqli_real_escape_string($connection, $title);
    $query = "SELECT * FROM categories WHERE category_title='$title'";
    $result = mysqli_query($connection, $query);
    if(!$result) {
        echo 'error' + mysqli_error($connection);
    }
    while($row = mysqli_fetch_array($result)){
        return $row['category_id'];
    }
}

function getUserUsername($user_id) {
    global $connection;
    $user_id = mysqli_real_escape_string($connection, $user_id);
    $query = "SELECT * FROM users WHERE user_id=$user_id";
    $result = mysqli_query($connection, $query);
    while($row = mysqli_fetch_array($result)){
        return $row['user_username'];   
    }
}

function getCommentReplyUsername($comment_id) {
    global $connection;
    $comment_id = mysqli_real_escape_string($connection, $comment_id);
    $query = "SELECT * FROM comments WHERE comment_id=$comment_id";
    $result = mysqli_query($connection, $query);
    while($row = mysqli_fetch_array($result)) {
        $user_id = $row['comment_user_id'];
        $user_query = "SELECT * FROM users WHERE user_id=$user_id";
        $result = mysqli_query($connection, $user_query);
        while($row = mysqli_fetch_array($result)) {
            return $row['user_username'];
        }
    }    
}

function getUserName($user_id) {
    global $connection;
    $user_id = mysqli_real_escape_string($connection, $user_id);
    $query = "SELECT * FROM users WHERE user_id=$user_id";
    $result = mysqli_query($connection, $query);
    while($row = mysqli_fetch_array($result)){
        return $row['user_name'];   
    }
}

function getUserImage($user_id) {
    global $connection;
    $user_id = mysqli_real_escape_string($connection, $user_id);
    $query = "SELECT * FROM users WHERE user_id=$user_id";
    $result = mysqli_query($connection, $query);
    while($row = mysqli_fetch_array($result)){
        return $row['user_image'];   
    }
}

function getStatusTotal($status) {
    global $connection;
    $status = mysqli_real_escape_string($connection, $status);
    $query = "SELECT * FROM posts WHERE post_status='{$status}'";
    $result = mysqli_query($connection, $query);
    $total = mysqli_num_rows($result);
    echo $total;
}

function getRoadmapStatusItems($status) {
    global $connection;
    $status = mysqli_real_escape_string($connection, $status);
    $query = "SELECT * FROM posts WHERE post_status='{$status}'";
    $result = mysqli_query($connection, $query);
    while($row = mysqli_fetch_array($result)) {
        $cat_title = getCategoryTitle($row['post_category_id']);
        $cat_status = ucfirst($status);
        echo "
        <li class='roadmap-card roadmap-card-{$status}'>
            <p class='roadmap-card__status'>{$cat_status}</p>
            <a class='roadmap-card__title' href='./post.php?id={$row['post_id']}'>{$row['post_title']}</a>
            <p class='roadmap-card__description'>{$row['post_description']}</p>
            <p class='roadmap-card__cat-title btn-category'>{$cat_title}</p>
            <div>
                <button class='roadmap-card__upvote btn-upvote' value={$row['post_id']}>
                <svg width='10' height='7' xmlns='http://www.w3.org/2000/svg'><path d='M1 6l4-4 4 4' stroke='#4661E6' stroke-width='2' fill='none' fill-rule='evenodd'/></svg>
                    <span>{$row['post_upvotes']}</span>
                </button>
                <div class='roadmap-card__comment-count'>
                    <img src='./assets/shared/icon-comments.svg' alt='comment icon'>
                    <p>{$row['post_comment_count']}</p>
                </div>
            </div>    
        </li>
        ";
    };
}

function getCategories() {
    global $connection;
    $query = "SELECT * FROM categories";
    $result = mysqli_query($connection, $query);
    while($row = mysqli_fetch_array($result)) {
        echo "<option value='" . $row['category_id'] . "'>" . $row['category_title'] . "</option>"; 
    }
}

function updateCommentCount($post_id) {
    global $connection;
    $post_id = mysqli_real_escape_string($connection, $post_id);
    $query = "UPDATE posts SET post_comment_count=post_comment_count + 1 WHERE post_id=$post_id";
    $result = mysqli_query($connection, $query);
    if(!$result) {
        echo 'error' + mysqli_error($connection);
    }
}


?>