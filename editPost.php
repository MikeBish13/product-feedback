<?php 
include 'includes/header.php';
?>

<?php 
$errors = [];
$fields= ['feedback_title', 'feedback_detail'];
$values =[];
if(isset($_POST['edit_feedback'])) {
    foreach($fields as $field) {
        if(empty($_POST[$field])) {
            $errors[] = $field;
        } else {
            $values[$field] = $_POST[$field];
        }
    }
    if(empty($errors)) {
        $post_id = mysqli_real_escape_string($connection, $_GET['id']);
        $post_title = mysqli_real_escape_string($connection, $_POST['feedback_title']);
        $post_category_id = mysqli_real_escape_string($connection, getCategoryId($_POST['category']));
        $post_status = mysqli_real_escape_string($connection, lcfirst($_POST['status']));
        $post_description = mysqli_real_escape_string($connection, $_POST['feedback_detail']);
        $query = "UPDATE posts SET post_title='$post_title', post_category_id='$post_category_id', post_status='$post_status', post_description='$post_description' ";
        $query .= "WHERE post_id = $post_id";
        $result = mysqli_query($connection, $query);
        if(!$result) {
            echo "error: " . mysqli_error($connection);
        } else {
            header("Location: ./post.php?id=$post_id");
        }  
    }
}
?>

<section class="post-control post-control--edit"> 
    <?php 
    if(isset($_GET['id'])) {
        $post_id = mysqli_real_escape_string($connection, $_GET['id']);
        $query = "SELECT * FROM posts WHERE post_id=$post_id";
        $result = mysqli_query($connection, $query);
        while($row = mysqli_fetch_array($result)) { 
            $post_title = $row['post_title'];
            $post_category_id = $row['post_category_id'];
            $post_status = $row['post_status'];
            $post_description = $row['post_description'];  
            ?>
            <header>
                <a href="./post.php?id=<?php echo $post_id ?>" class="btn-back"><img src="./assets/shared/icon-arrow-left.svg">Go Back</a>
            </header> 
            <main class="post-control__container">
                <img class="post-control__icon" src="./assets/shared/icon-edit-feedback.svg" alt="edit-icon">
                <h1>Editing '<?php echo $post_title ?>'</h1>
                <form method="POST" action="">
                    <div class="post-control__input">
                        <label for="feedback-title">Feedback Title</br><span>Add a short, descriptive headline</span></label>
                        <input class="<?php echo in_array('feedback_title', $errors) ? 'error' : '';?>" type="text" id="feedback-title" name="feedback_title" value="<?php echo isset($values["feedback_title"]) ? $values['feedback_title'] : $post_title ?>">
                        <?php if(in_array('feedback_title', $errors)): ?>
                        <span class="error-span">Can't be empty</span>
                        <?php endif; ?>
                    </div>
                    
                    <div class="post-control__input post-control__input-select">
                        <label for="category">Category</br><span>Choose a category for your feedback</span></label>
                        <input type="text" id="category" name="category" readonly value="<?php echo getCategoryTitle($post_category_id) ?>">
                        <ul class="custom-select">
                            <?php
                                $query = "SELECT * FROM categories";
                                $result = mysqli_query($connection, $query);
                                while($row = mysqli_fetch_array($result)) { ?>
                                <li class="<?php echo $row['category_title'] === getCategoryTitle($post_category_id) ? "custom-select__option--category selected" : "custom-select__option--category"?> value="<?php echo $row['category_id']; ?>"><?php echo $row['category_title']; ?></li> 
                            <?php }
                            ?>
                        </ul>
                    </div> 

                    <div class="post-control__input post-control__input-select">
                        <label for="status">Update Status</br><span>Change feedback state</span></label>
                        <input type="text" id="status" name="status" readonly value="<?php echo ucfirst($post_status) ?>">
                        <ul class="custom-select">
                            <li class="<?php echo $post_status === "suggestion" ? "custom-select__option--status selected" : "custom-select__option--status"?>" value="suggestion">Suggestion</li>
                            <li class="<?php echo $post_status === "planned" ? "custom-select__option--status selected" : "custom-select__option--status"?>"  value="planned">Planned</li>
                            <li class="<?php echo $post_status === "in-progress" ? "custom-select__option--status selected" : "custom-select__option--status"?>"  value="in-progress">In-progress</li>
                            <li class="<?php echo $post_status === "live" ? "custom-select__option--status selected" : "custom-select__option--status"?>"  value="live">Live</li>
                        </ul>
                    </div>


                    <div class="post-control__input">
                        <label for="feedback-detail">Feedback Detail</br><span>Add any specific feedback on what should be improved, added, etc</span></label>
                        <textarea class="<?php echo in_array('feedback_detail', $errors) ? 'error' : '';?>" id="feedback-detail" name="feedback_detail"><?php echo isset($values['feedback_detail']) ? $values['feedback_detail'] : $post_description ?></textarea>
                        <?php if(in_array('feedback_detail', $errors)): ?>
                        <span class="error-span">Can't be empty</span>
                        <?php endif; ?>
                    </div>
                    <div class="post-control__buttons">
                        <input  class="btn-one" type="submit" name="edit_feedback" value="Save Changes">
                        <a class="btn-three" href="./index.php">Cancel</a>
                        <input class="btn-four" type="submit" name="delete_feedback" value="Delete">
                    </div>
                </form>
        <?php }
        }
        ?>
            </main>
</section>

<?php 
    if(isset($_POST['delete_feedback'])) {
        $query = "DELETE FROM posts WHERE post_id=$post_id";
        $result = mysqli_query($connection, $query);
        if(!$result) {
            echo "error: " . mysqli_error($connection);
        } else {
            header("Location: ./index.php");
        }  
    } 
?>


<?php 
include 'includes/footer.php';
?>