<div class="categories-box">
    <ul class="categories-box__list">
        <li class="categories-box__list-item btn-category btn-category-link"><a href="index.php">All</a></li>
        <?php
        $query = "SELECT * FROM categories";
        $result = mysqli_query($connection, $query);
        while($row = mysqli_fetch_array($result)) {
            $category_id = $row['category_id'];
            $category = $row['category_title'];
        ?>
        <li class="categories-box__list-item btn-category btn-category-link"><a href="index.php?category=<?php echo $category_id; ?>"><?php echo $category; ?></a></li>    
        <?php
        }
        ?>
    </ul>
</div>