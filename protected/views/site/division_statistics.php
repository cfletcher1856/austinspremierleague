<?php
    /* @var $this SiteController */

    $this->pageTitle='APL - Division Statistics';
    $this->page_header = "Division Statistics - {$season->name}";
?>

<?php foreach($divisions as $division): ?>
  <?php
    $ton_eighties = $stats[$division->id]['ton_eighties'];
    $qps = $stats[$division->id]['qps'];
    $qps_avg = $stats[$division->id]['qps_avg'];
    $high_out = $stats[$division->id]['high_out'];
    $ton_plus = $stats[$division->id]['ton_plus'];

    arsort($ton_eighties);
    arsort($qps);
    arsort($qps_avg);
    arsort($ton_plus);
    arsort($high_out);
  ?>
  <div class="division_section">
    <h3>Division <?php echo $division->id; ?></h3>
    <div class="row">
      <div class="span2">
        <strong>Highest Out</strong><br />
        <?php
          foreach($high_out as $player => $qty){
            echo "$player ($qty)<br />";
          }
        ?>
      </div>
      <div class="span2">
        <strong>Most 93+ Scores</strong><br />
        <?php
          foreach($qps as $player => $qty){
            echo "$player ($qty)<br />";
          }
        ?>
      </div>
      <div class="span2">
        <strong>Avg 93+ Score per leg</strong><br />
        <?php
          foreach($qps_avg as $player => $avg){
            echo "$player ($avg)<br />";
          }
        ?>
      </div>
      <div class="span2">
        <strong>Most 100+ Checkouts</strong><br />
        <?php
          foreach($ton_plus as $player => $qty){
            echo "$player ($qty)<br />";
          }
        ?>
      </div>
      <div class="span2">
        <strong>Most 180's</strong><br />
        <?php
          foreach($ton_eighties as $player => $qty){
            if($qty > 0){
              echo "$player ($qty)<br />";
            }
          }
        ?>
      </div>
    </div>
  </div>
<?php endforeach; ?>

