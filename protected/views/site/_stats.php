<table class="items table table-striped table-bordered table-condensed">
<thead>
    <tr>
        <th>Date</th>
        <th>Match</th>
        <th>Board</th>
        <th >Players</th>
        <th >Won</th>
        <th >Lost</th>
        <th >Differential</th>
        <th >180</th>
        <th >Q's</th>
        <th >Three Dart Average</th>
    </tr>
</thead>
<tbody>
    <?php foreach($schedule as $int => $s): ?>
    <tr class="odd">
        <td rowspan="2"><?php echo Yii::app()->dateFormatter->format("MM/dd/yyyy",strtotime($s->date)); ?></td>
        <td rowspan="2"><?php echo $s->match; ?></td>
        <td rowspan="2"><?php echo $s->board; ?></td>
        <td><?php echo $s->h_player->getFullName(); ?></td>
        <td><?php echo $s->getHomeMatch()->legs_won ?></td>
        <td><?php echo $s->getHomeMatch()->legs_lost ?></td>
        <td><?php echo $s->getHomeMatch()->leg_differential ?></td>
        <td><?php echo $s->getHomeMatch()->ton_eighties ?></td>
        <td><?php echo $s->getHomeMatch()->quality_points ?></td>
        <td>
            <?php
                if($s->getHomeMatch() instanceof Match){
                    echo $s->getHomeMatch()->getDartAverage($s->h_player->id);
                }
            ?>
        </td>
    </tr>
    <tr class="even">
        <td><?php echo $s->a_player->getFullName(); ?> </td>
        <td><?php echo $s->getAwayMatch()->legs_won ?></td>
        <td><?php echo $s->getAwayMatch()->legs_lost ?></td>
        <td><?php echo $s->getAwayMatch()->leg_differential ?></td>
        <td><?php echo $s->getAwayMatch()->ton_eighties ?></td>
        <td><?php echo $s->getAwayMatch()->quality_points ?></td>
        <td>
            <?php
                if($s->getAwayMatch() instanceof Match){
                    echo $s->getAwayMatch()->getDartAverage($s->a_player->id);
                }
            ?>
        </td>
    </tr>
    <?php endforeach; ?>
</tbody>
</table>
