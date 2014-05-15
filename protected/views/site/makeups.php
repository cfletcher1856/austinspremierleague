<?php
    /* @var $this SiteController */

    $this->pageTitle='APL - Make Up Games';
    $this->page_header = 'Make Up Games';
    $ctr = 1;
?>

<table class="table">
<thead>
    <tr>
        <th>&nbsp;</th>
        <th>Matchup</th>
        <th>Date</th>
        <th>Week</th>
        <th>Board</th>
    </tr>
</thead>
<tbody>
    <?php foreach($matches as $match): ?>
    <tr>
        <td><?php echo $ctr; ?></td>
        <td><?php echo $match->getMatchup(); ?></td>
        <td>
            <?php
                $date = new DateTime($match['date']);
                echo $date->format('m/d/Y');
            ?>
        </td>
        <td><?php echo $match['week']; ?></td>
        <td><?php echo $match['board']; ?></td>
    </tr>
    <?php $ctr++; endforeach; ?>
</tbody>
</table>
