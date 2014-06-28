<link rel="stylesheet" href="<?php echo base_url('style/genes.css')?>" media="screen" />
<!-- begin content -->
<div id="content" style="width: 880px;">
<?php if($go):?>
  <h4 style="font-size:200%;display:inline;"><?php echo $go['title'];?></h4>
  <span style="padding:0 0 0 20px"><a target="_blank" href="http://amigo1.geneontology.org/cgi-bin/amigo/term_details?term=GO:<?php echo $go['go_id'];?>">GO:<?php echo $go['go_id'];?></a></span>
  <h5 style="font-size:140%;">in the process <?php echo $ninca_title;?></h5>

  <style type="text/css">
    table.full { width:880px; }
  </style>

  <table class="full">
    <tr>
      <th>Enriched by</th>
      <th>Count</th>
      <th>%</th>
      <th>Adjusted p-value</th>
    </tr>
    <tr>
      <td>Conversion-related genes</td>
      <?php if(isset($go['enriched_by'][3])):?>
        <td><?php echo $go['enriched_by'][3]->count ?></td>
        <td><?php echo $go['enriched_by'][3]->percents ?></td>
        <td><?php echo $go['enriched_by'][3]->adj_p_value ?></td>
      <?php else:?>
        <td>NA</td>
        <td>NA</td>
        <td>NA</td>
      <?php endif;?>
    </tr>
    <tr>
      <td>Inflammation-inclined genes</td>
      <?php if(isset($go['enriched_by'][1])):?>
        <td><?php echo $go['enriched_by'][1]->count ?></td>
        <td><?php echo $go['enriched_by'][1]->percents ?></td>
        <td><?php echo $go['enriched_by'][1]->adj_p_value ?></td>
      <?php else:?>
        <td>NA</td>
        <td>NA</td>
        <td>NA</td>
      <?php endif;?>
    </tr>
    <tr>
      <td>Cancer-inclined genes</td>
      <?php if(isset($go['enriched_by'][2])):?>
        <td><?php echo $go['enriched_by'][2]->count ?></td>
        <td><?php echo $go['enriched_by'][2]->percents ?></td>
        <td><?php echo $go['enriched_by'][2]->adj_p_value ?></td>
      <?php else:?>
        <td>NA</td>
        <td>NA</td>
        <td>NA</td>
      <?php endif;?>
    </tr>
    <tr>
      <th colspan="4">Network balance module</th>
    </tr>
  </table>

  <?php if($gene_in_go):?>
  <script type="text/javascript">
  <!--
    $(document).ready(function(){
      Genes('<?php echo $gene_in_go['symbol'];?>');
      $("#more").click(function(){
        currentMaxPoint += 20;
        Genes('<?php echo $gene_in_go['symbol'];?>',currentMaxPoint);
      });
      $("#less").click(function(){
        currentMaxPoint -= 20;
        currentMaxPoint = (currentMaxPoint<20)?20:currentMaxPoint;
        Genes('<?php echo $gene_in_go['symbol'];?>',currentMaxPoint);
      });
    });
  //-->
  </script>
  
  <div id="svgdiv-content">
    <div id="svgdiv" class="svgdiv"></div>
    <div id="togglebut" style="cursor:pointer;">
      <img id="more" src="<?php echo base_url('images/more.png')?>">
      <img id="nomore" style="display:none;" src="<?php echo base_url('images/nomore.png')?>">
      <img id="less" src="<?php echo base_url('images/less.png')?>">
      <img id="noless" style="display:none;" src="<?php echo base_url('images/noless.png')?>">
    </div>
  </div>

  <div id="numbar">
    <span style="margin-left: 20px;">Inflammation genes</span>
    <span style="margin-left: 70px;">-1</span>
    <span style="margin-left: 198px;">0</span>
    <span style="margin-left: 198px;">+1</span>
    <span style="margin-left: 105px;">Cancer genes</span>
  </div>
  <?php endif;?>
<?php else:?>
  <h2>not found</h2>
<?php endif;?>
</div>
<!-- end content -->

<script src="<?php echo base_url('script/d3.min.js')?>"></script>
<script src="<?php echo base_url('script/genes.js')?>"></script>