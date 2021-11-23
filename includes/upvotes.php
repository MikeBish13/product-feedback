
<?php
include 'db.php';
        global $connection;
        if(isset($_GET['liked'])) {
			$postid = mysqli_real_escape_string($connection, $_GET['postid']);
			$query = "SELECT * FROM posts WHERE post_id=$postid";
			$result = mysqli_query($connection, $query);
			$row = mysqli_fetch_array($result);
			$n = $row['post_upvotes'];
			$query = "UPDATE posts SET post_upvotes=$n+1 WHERE post_id=$postid";
			mysqli_query($connection, $query);
			echo $n + 1;
			exit();
	    }

?>