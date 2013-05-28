<table class="items table table-striped table-bordered table-condensed">
<thead>
    <tr>
        <th>Date</th>
        <th>Match</th>
        <th>Board</th>
        <th id="yw0_c1">Players</th>
        <th id="yw0_c3">
            <a class="sort-link" href="/admin/match/index/Match_sort/legs_won">Won</a>
        </th>
        <th id="yw0_c4">
            <a class="sort-link" href="/admin/match/index/Match_sort/legs_lost">Lost</a>
        </th>
        <th id="yw0_c5">
            <a class="sort-link" href="/admin/match/index/Match_sort/leg_differential">Differential</a>
        </th>
        <th id="yw0_c6">
            <a class="sort-link" href="/admin/match/index/Match_sort/ton_eighties">180</a>
        </th>
        <th id="yw0_c6">
            <a class="sort-link" href="/admin/match/index/Match_sort/ton_eighties">Q's</a>
        </th>
        <th id="yw0_c7">
            <a class="sort-link" href="/admin/match/index/Match_sort/darts_thrown">Darts Thrown</a>
        </th>
        <th class="button-column" id="yw0_c8">&nbsp;</th>
    </tr>
</thead>
<tbody>
    <?php foreach($schedule as $int => $s): ?>
    <tr class="odd">
        <td rowspan="2"><?php echo Yii::app()->dateFormatter->format("MM/dd/yyyy",strtotime($s->date)); ?></td>
        <td rowspan="2"><?php echo $s->match; ?></td>
        <td rowspan="2"><?php echo $s->board; ?></td>
        <td>
            <?php echo CHtml::link($s->h_player->getFullName(), $this->createAbsoluteUrl("//admin/player/view", array("id" => $s->h_player->id))); ?>
        </td>
        <td><?php echo $s->getHomeMatch()->legs_won ?></td>
        <td><?php echo $s->getHomeMatch()->legs_lost ?></td>
        <td><?php echo $s->getHomeMatch()->leg_differential ?></td>
        <td><?php echo $s->getHomeMatch()->ton_eighties ?></td>
        <td><?php echo $s->getHomeMatch()->quality_points ?></td>
        <td><?php echo $s->getHomeMatch()->darts_thrown ?></td>
        <td style="width: 50px; text-align: center;vertical-align: middle" rowspan="2">
            <a class="view" title="View" rel="tooltip" href="/admin/match/view/id/<?php echo $s->id; ?>" ><i class="icon-eye-open"></i></a>
            <a class="update" title="Update" rel="tooltip" href="/admin/match/update/id/<?php echo $s->id; ?>"><i class="icon-pencil"></i></a>
        </td>
    </tr>
    <tr class="even">
        <td>
            <?php echo CHtml::link($s->a_player->getFullName(), $this->createAbsoluteUrl("//admin/player/view", array("id" => $s->a_player->id))); ?>
        </td>
        <td><?php echo $s->getAwayMatch()->legs_won ?></td>
        <td><?php echo $s->getAwayMatch()->legs_lost ?></td>
        <td><?php echo $s->getAwayMatch()->leg_differential ?></td>
        <td><?php echo $s->getAwayMatch()->ton_eighties ?></td>
        <td><?php echo $s->getAwayMatch()->quality_points ?></td>
        <td><?php echo $s->getAwayMatch()->darts_thrown ?></td>
    </tr>
    <?php endforeach; ?>
</tbody>
</table>
