<?php
include './includes/header.php';
include 'components/navigation.php';
?>
<ul class="post-items">
<?php 
if(!isset($_GET['category']) && !isset($_GET['filter'])) {
    $query = "SELECT * FROM posts WHERE post_status='suggestion' ORDER BY post_upvotes DESC";
} else if (!isset($_GET['category']) && isset($_GET['filter'])) {
    $filter = mysqli_real_escape_string($connection, $_GET['filter']);
    $order = mysqli_real_escape_string($connection, $_GET['order']);
    $query = "SELECT * FROM posts WHERE post_status='suggestion' ORDER BY $filter $order";
} else if (isset($_GET['category']) && !isset($_GET['filter'])) {
    $category = mysqli_real_escape_string($connection, $_GET['category']);
    $query = "SELECT * FROM posts WHERE post_status='suggestion' AND post_category_id=$category ORDER BY post_upvotes DESC";
} else if (isset($_GET['category']) && isset($_GET['filter'])) {
    $filter = mysqli_real_escape_string($connection, $_GET['filter']);
    $order = mysqli_real_escape_string($connection, $_GET['order']);
    $category = mysqli_real_escape_string($connection, $_GET['category']);
    $query = "SELECT * FROM posts WHERE post_status='suggestion' AND post_category_id=$category ORDER BY $filter $order";
}

$result = mysqli_query($connection, $query);
if(!mysqli_num_rows($result)) {
    include './includes/error.php';
} 

while($row = mysqli_fetch_array($result)) {
    $id = $row['post_id'];
    $title = $row['post_title'];
    $upvotes = $row['post_upvotes'];
    $category_id = $row['post_category_id'];
    $description = $row['post_description'];
    $comment_count = $row['post_comment_count'];
?>

<li class="post-item">
    <a href='post.php?id=<?php echo $id ?>'>
        <h3 class="post-item__title"><?php echo $title ?></h3>
        <p class="post-item__category btn-category"><?php echo getCategoryTitle($category_id) ?></p>
        <p class="post-item__desc body-one"><?php echo $description ?></p>
        <div class="post-item__comments">
            <img src="./assets/shared/icon-comments.svg">
            <p class="body-one"><?php echo $comment_count ?></p>
        </div>
    </a>
    <button class="post-item__upvote btn-upvote" value=<?php echo $id ?>>
        <svg width="10" height="7" xmlns="http://www.w3.org/2000/svg"><path d="M1 6l4-4 4 4" stroke="#4661E6" stroke-width="2" fill="none" fill-rule="evenodd"/></svg>
        <span><?php echo $upvotes ?></span>
    </button>
</li>

<?php }
?>
</ul>
</main>
</div>


<?php
include './includes/footer.php';
?>
