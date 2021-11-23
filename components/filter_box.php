<main>
<div class="filter-menu">
        <div class="filter-menu__suggestions">
            <img src="./assets/suggestions/icon-suggestions.svg">
            <h3 class="total-suggestions"></h3>
        </div>
        <div class="filter-menu__select">
            <?php 
                if(isset($_GET['filter'])) {
                    $filter = mysqli_real_escape_string($connection, $_GET['filter']);
                    $order = mysqli_real_escape_string($connection, $_GET['order']);
                    if($filter === 'post_upvotes' && $order === 'DESC') {
                        $filterName = 'Most Upvotes';
                    };
                    if($filter === 'post_upvotes' && $order === 'ASC') {
                        $filterName = 'Least Upvotes';
                    };
                    if($filter === 'post_comment_count' && $order === 'DESC') {
                        $filterName = 'Most Comments';
                    };
                    if($filter === 'post_comment_count' && $order === 'ASC') {
                        $filterName = 'Least Comments';
                    };
                }
            ?>
            <h4 class="filter-menu__current-selection-box">Sort by: 
                <span class="filter-menu__current-selection"><?php echo isset($filter) ? $filterName : 'Most Upvotes'?></span>
                <svg class="filter-menu__icon filter-menu__icon-down" width="10" height="7" xmlns="http://www.w3.org/2000/svg"><path d="M1 1l4 4 4-4" stroke="#F2F4FF83" stroke-width="2" fill="none" fill-rule="evenodd"/></svg>
                <svg class="filter-menu__icon filter-menu__icon-up" width="10" height="7" xmlns="http://www.w3.org/2000/svg"><path d="M1 6l4-4 4 4" stroke="#F2F4FF83" stroke-width="2" fill="none" fill-rule="evenodd"/></svg>
            </h4>
                <ul class="filter-menu__selections">
                    <li class="filter-menu__selection" id="most_upvotes" data-filter="post_upvotes" data-order="DESC">Most Upvotes</li>
                    <li class="filter-menu__selection" id="least_upvotes" data-filter="post_upvotes" data-order="ASC">Least Upvotes</li>
                    <li class="filter-menu__selection" id="most_comments" data-filter="post_comment_count" data-order="DESC">Most Comments</li>
                    <li class="filter-menu__selection" id="least_comments" data-filter="post_comment_count" data-order="ASC">Least Comments</li>
                </ul>
        </div>
        <a class="btn-one" href="./addPost.php"><img src="./assets/shared/icon-plus.svg">Add Feedback</a>
</div>  