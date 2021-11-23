<?php
include 'includes/header.php';
?>
<?php
$errors = [];
$fields= ['feedback_title', 'feedback_detail'];
$values =[];
if($_SERVER["REQUEST_METHOD"] == "POST") { 
    foreach($fields as $field) {
        if(empty($_POST[$field])) {
            $errors[] = $field;
        } else {
            $values[$field] = $_POST[$field];
        }
    }
    if(empty($errors)) {
        $post_title = mysqli_real_escape_string($connection, $_POST['feedback_title']);
        $post_description = mysqli_real_escape_string($connection, $_POST['feedback_detail']);
        $post_category_id = mysqli_real_escape_string($connection, getCategoryId($_POST['category']));
        $post_upvotes = 0;
        $post_status = 'suggestion';
        $post_comment_count = 0;
        $query = "INSERT INTO posts (post_title, post_category_id, post_upvotes, post_status, post_description, post_comment_count) ";
        $query .= "VALUES ('$post_title', '$post_category_id', '$post_upvotes', '$post_status', '$post_description', '$post_comment_count')";
        $result = mysqli_query($connection, $query);
        if(!$result) {
            echo "error: " . mysqli_error($connection);
        } else {
            header("Location: ./index.php");
        }   
    }
}
?>

<section class="post-control post-control--add">
    <header>
        <a href="./index.php" class="btn-back"><img src="./assets/shared/icon-arrow-left.svg">Go Back</a>
    </header>   
    <main class="post-control__container">
        <img class="post-control__icon" src="./assets/shared/icon-new-feedback.svg" alt="add icon">
        <h1>Create New Feedback</h1>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <div class="post-control__input">
                <label for="feedback-title">Feedback Title</br><span>Add a short, descriptive headline</span></label>
                <input class="<?php echo in_array('feedback_title', $errors) ? 'error' : '';?>" type="text" id="feedback-title" name="feedback_title" value="<?php echo isset(($values['feedback_title'])) ? $values['feedback_title'] : ''; ?>">
                <?php if(in_array('feedback_title', $errors)): ?>
                <span class="error-span">Can't be empty</span>
                <?php endif; ?>
            </div>


                <div class="post-control__input post-control__input-select">
                    <label for="category">Category</br><span>Choose a category for your feedback</span></label>
                    <input type="text" id="category" name="category" readonly value="Feature">
                    <ul class="custom-select">
                        <?php
                            $query = "SELECT * FROM categories";
                            $result = mysqli_query($connection, $query);
                            while($row = mysqli_fetch_array($result)) { ?>
                            <li class="<?php echo $row['category_title'] === "Feature" ? "custom-select__option--category selected" : "custom-select__option-category"?> value="<?php echo $row['category_id']; ?>"><?php echo $row['category_title']; ?></li> 
                        <?php }
                        ?>
                    </ul>
                </div>    


            <div class="post-control__input">
                <label for="feedback-detail">Feedback Detail</br><span>Add any specific feedback on what should be improved, added, etc.</span></label>
                <textarea class="<?php echo in_array('feedback_detail', $errors) ? 'error' : '';?>" id="feedback-detail" name="feedback_detail"><?php echo isset(($values['feedback_detail'])) ? $values['feedback_detail'] : ''; ?></textarea>
                <?php if(in_array('feedback_detail', $errors)): ?>
                <span class="error-span">Can't be empty</span>
                <?php endif; ?>
            </div>
            <div class="post-control__buttons">
                <input type="submit" class="btn-one" name="add_feedback" value="Add Feedback">
                <a class="btn-three" href="./index.php">Cancel</a>
            </div>
        </form>
    </main>
</section>

<?php
include 'includes/footer.php'
?>