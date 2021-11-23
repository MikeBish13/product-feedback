<?php
include './includes/header.php';
?>
<section class="roadmap">
    <header class="header-roadmap">
        <div>
            <a class="btn-back" href="index.php"><img src="./assets/shared/icon-arrow-left.svg" alt="left arrow">Go Back</a>
            <h1>Roadmap</h1>
        </div>
        <a href="addPost.php" class="btn-one"><img src="./assets/shared/icon-plus.svg" alt="plus icon">Add Feedback</a>
        <nav class="roadmap__nav" role="tablist">
            <button class="roadmap__tab roadmap__tab--planned" tabindex="0" aria-controls="planned-tab" role="tab" aria-selected="true">Planned (<?php getStatusTotal('planned') ?>)</button>
            <button class="roadmap__tab roadmap__tab--progress" tabindex="-1" aria-controls="progress-tab" role="tab" aria-selected="false">In-Progress (<?php getStatusTotal('in-progress') ?>)</button>
            <button class="roadmap__tab roadmap__tab--live" tabindex="-1" aria-controls="live-tab" role="tab" aria-selected="false">Live (<?php getStatusTotal('live') ?>)</button>
        </nav>
    </header>

    <main class="roadmap__container">
        <div class="roadmap__list roadmap__list--planned active" id="planned-tab">
            <div class="roadmap__list-header">
                <h3>Planned (<?php getStatusTotal('planned') ?>)</h3>
                <p>Ideas prioritized for research</p>
            </div>
            <ul>
                <?php getRoadmapStatusItems('planned'); ?>
            </ul>
        </div>
        
        
        <div class="roadmap__list roadmap__list--progress" id="progress-tab">
            <div class="roadmap__list-header">
                <h3>In-Progress (<?php getStatusTotal('in-progress') ?>)</h3>
                <p>Currently being developed</p>
            </div>      
            <ul>
                <?php getRoadmapStatusItems('in-progress'); ?>
            </ul>
        </div>
        
        
        <div class="roadmap__list roadmap__list--live" id="live-tab">
            <div class="roadmap__list-header">
                <h3>Live (<?php getStatusTotal('live') ?>)</h3>
                <p>Released features</p>
            </div>    
            <ul>
                <?php getRoadmapStatusItems('live'); ?>
            </ul>
        </div>
    </main>
</section>  


<?php
include './includes/footer.php';
?>