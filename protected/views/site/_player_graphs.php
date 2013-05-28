<?php
  $player_name = $player->f_name . "_" . $player->l_name;
  $dates_array = $season->getSeasonDatesAsArray(true);
  $player_stats = $player->getStatsByMatch();
  $qps = array();
  $ton_eighties = array();
  $today = new DateTime();

  foreach($player_stats as $date => $stats)
  {
    if($date < $today->format('Y-m-d')){
      $qps[] = $stats['quality_points'];
      $ton_eighties[] = $stats['ton_eighties'];
      $three_dart_avg[] = $stats['three_dart_avg'];
    }
  }
?>

<div id="<?php echo $player_name; ?>"></div>


<script>
  $(function() {
    var options = {
      chart: {
        renderTo: '<?php echo $player_name; ?>'
      },

      title: {
        text: ''
      },

      xAxis: {
        categories: [<?php echo implode(', ', $dates_array); ?>]
      },

       yAxis: [
        {
          min: 0,
          title: {
            style: {
              color: '#2F7ED8'
            },
            text: 'Quality Points'
          },
        },
        {
          min: 0,
          opposite: true,
          title: {
            style: {
              color: '#8BBC21'
            },
            text: 'Three Dart Average'
          },
        }
       ],

      series: [
      {
        data: [<?php echo implode(', ', $qps); ?>],
        name: 'Quality Points',
        type: 'line',
        color: '#2F7ED8'
      },
      {
        data: [<?php echo implode(', ', $ton_eighties); ?>],
        name: 'Ton Eighties',
        type: 'column',
        color: '#0D233A'
      },
      {
        data: [<?php echo implode(', ', $three_dart_avg); ?>],
        name: 'Three Dart Average',
        type: 'line',
        yAxis: 1,
        color: '#8BBC21'
      }
      ],
    };

    var chart = new Highcharts.Chart(options);

  });
</script>
