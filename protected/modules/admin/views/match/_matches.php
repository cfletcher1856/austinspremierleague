<table class="items table table-striped table-bordered table-condensed">
<thead>
    <tr>
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
            <a class="sort-link" href="/admin/match/index/Match_sort/leg_differential">Diff</a>
        </th>
        <th id="yw0_c6">
            <a class="sort-link" href="/admin/match/index/Match_sort/ton_eighties">180</a>
        </th>
        <th id="yw0_c6">
            <a class="sort-link" href="/admin/match/index/Match_sort/ton_eighties">Q's</a>
        </th>
        <th id="yw0_c8">3 Dart Avg</th>
        <th class="button-column" id="yw0_c8">&nbsp;</th>
    </tr>
</thead>
<tbody>
    <?php foreach($model as $schedule): ?>

    <tr class="odd">
        <td rowspan="2"><?php echo $schedule->match; ?></td>
        <td rowspan="2"><?php echo $schedule->board; ?></td>
        <td>
            <?php echo CHtml::link($schedule->h_player->getFullName(), $this->createAbsoluteUrl("//admin/player/view", array("id" => $schedule->h_player->id))); ?>
        </td>
        <td><?php echo $schedule->getHomeMatch()->legs_won ?></td>
        <td><?php echo $schedule->getHomeMatch()->legs_lost ?></td>
        <td><?php echo $schedule->getHomeMatch()->leg_differential ?></td>
        <td><?php echo $schedule->getHomeMatch()->ton_eighties ?></td>
        <td><?php echo $schedule->getHomeMatch()->quality_points ?></td>
        <td>
            <?php
                if($schedule->getHomeMatch() instanceof Match){
                    echo $schedule->getHomeMatch()->getDartAverage($schedule->h_player->id);
                }
            ?>
        </td>
        <td style="width: 50px; text-align: center;vertical-align: middle" rowspan="2">
            <a class="view" title="View" rel="tooltip" href="/admin/match/view/id/<?php echo $schedule->id; ?>" ><i class="icon-eye-open"></i></a>
            <a class="update" title="Update" rel="tooltip" href="/admin/match/update/id/<?php echo $schedule->id; ?>"><i class="icon-pencil"></i></a>
            <a class="Details" title="Details" rel="tooltip" href="/admin/match/details/id/<?php echo $schedule->id; ?>"><i class="icon-book"></i></a>
        </td>
    </tr>
    <tr class="even">
        <td>
            <?php echo CHtml::link($schedule->a_player->getFullName(), $this->createAbsoluteUrl("//admin/player/view", array("id" => $schedule->a_player->id))); ?>
        </td>
        <td><?php echo $schedule->getAwayMatch()->legs_won ?></td>
        <td><?php echo $schedule->getAwayMatch()->legs_lost ?></td>
        <td><?php echo $schedule->getAwayMatch()->leg_differential ?></td>
        <td><?php echo $schedule->getAwayMatch()->ton_eighties ?></td>
        <td><?php echo $schedule->getAwayMatch()->quality_points ?></td>
        <td>
            <?php
                if($schedule->getAwayMatch() instanceof Match){
                    echo $schedule->getAwayMatch()->getDartAverage($schedule->a_player->id);
                }
            ?>
        </td>
    </tr>
    <?php endforeach; ?>
</tbody>
</table>
