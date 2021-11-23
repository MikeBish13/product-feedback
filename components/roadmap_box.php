<div class="roadmap-box">
    <div class="roadmap-box__top">
        <h3 class="roadmap-box__title">Roadmap</h3>
        <a href="./roadmap.php" class="roadmap-box__link">View</a>
    </div>
    <ul class="roadmap-box__items">
        <li class="roadmap-box__item roadmap-box__item--planned">Planned<span><?php getStatusTotal('planned') ?></span></li>
        <li class="roadmap-box__item roadmap-box__item--progress">In-Progress<span><?php getStatusTotal('in-progress')  ?></span></li>
        <li class="roadmap-box__item roadmap-box__item--live">Live<span><?php getStatusTotal('live')  ?></span></li>
    </ul>
</div>