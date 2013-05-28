<?php
    /* @var $this SiteController */
    //echo phpinfo();
    $this->pageTitle='APL - Players';
    $this->page_header = 'Players';
?>


<?php foreach($players as $player): ?>
    <h3>
        <?php echo CHtml::link($player->getFullName(), array('//site/player', 'player' => $player->getFullName())); ?>
    </h3>
    <?php
      $this->renderPartial('player_graphs', array(
        'player' => $player,
        'season' => $season,
      ));
      ?>
<?php endforeach; ?>
