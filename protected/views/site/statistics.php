<?php
    /* @var $this SiteController */

    $this->pageTitle='APL - Statistics';
    $this->page_header = 'Season Statistics';
?>

<?php foreach($divisions as $division): ?>
<div id="stats_division_<?php echo $division->id; ?>"></div>
<?php endforeach; ?>

<script>
  $(function() {
    <?php foreach($divisions as $division): ?>
    <?php
        if($division->id == 2){
            $seasons = substr(strstr($seasons, ','),1);
        }
    ?>
        var options = {
          chart: {
            renderTo: "stats_division_<?php echo $division->id; ?>",
            type: 'column'
          },

          title: {
            text: "<?php echo $division->division; ?>"
          },

          xAxis: {
            categories: [<?php echo $seasons; ?>]
          },

          yAxis: [{
            labels: {
                style: {
                    color: '#dd4814'
                }
            },
            title: {
                text: 'Quality Points',
                style: {
                    color: '#dd4814'
                }
            },
            gridLineWidth: 0,
          }, {
            title: {
                text: 'Ton Eighties',
                style: {
                    color: '#38b44a'
                }
            },
            labels: {
                style: {
                    color: '#38b44a'
                }
            },
            opposite: true
          }, {
            gridLineWidth: 0,
            title: {
                text: 'Avg Darts Per Game',
                style: {
                    color: '#772953'
                }
            },
            labels: {
                style: {
                    color: '#772953'
                }
            },
            opposite: true
          }, {
            gridLineWidth: 0,
            title: {
                text: 'Three Dart Avg',
                style: {
                    color: '#efb73e'
                }
            },
            labels: {
                style: {
                    color: '#efb73e'
                }
            },
            opposite: true
          }],
          tooltip: {
              shared: true
          },


          series: [
          {
            data: [<?php echo implode(', ', $quality_points[$division->id]); ?>],
            name: 'Quality Points',
            type: 'column',
            color: '#dd4814'
          },
          {
            data: [<?php echo implode(', ', $ton_eighties[$division->id]); ?>],
            name: 'Ton Eighties',
            type: 'spline',
            dashStyle: 'shortdot',
            yAxis: 1,
            color: '#38b44a'
          },
          {
            data: [<?php echo implode(', ', $avg_darts[$division->id]); ?>],
            name: 'Avg Darts Per Game',
            type: 'spline',
            dashStyle: 'shortdot',
            yAxis: 1,
            color: '#772953'
          },
          {
            data: [<?php echo implode(', ', $three_dart_avg[$division->id]); ?>],
            name: 'Three Dart Avg',
            type: 'spline',
            dashStyle: 'shortdot',
            yAxis: 1,
            color: '#efb73e'
          }
          ],
        };

        new Highcharts.Chart(options);
    <?php endforeach; ?>
  });
</script>
