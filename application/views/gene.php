<link rel="stylesheet" href="<?php echo base_url('style/genes.css')?>" media="screen" />
<!-- begin content -->
<div id="content" style="width: 880px;">
<?php if($gene):?>
  <style type="text/css">
    table.icons, table.icons tr, table.icons td { border: 0; }
    table.icons td { padding:8px; border-radius:12px; cursor:pointer; }
    table.icons td:hover { background:#3B3B3B; }

    table.full { width:880px; }
    table.full thead { cursor:pointer; }
    table.full span { float:right; padding:0 10px; font-size:120%; }
    table.full td { text-align:center; }

    table#tab_basic tr > td { font-weight:bold;  }
    table#tab_basic tr > td:last-child { font-weight:normal; width:70%;}

    .bar {
      fill: steelblue;
    }

    .bar:hover {
      fill: brown;
    }

    .axis {
      font: 10px sans-serif;
    }

    .axis path,
    .axis line {
      fill: none;
      stroke: #000;
      shape-rendering: crispEdges;
    }

    .x.axis path {
      display: none;
    }
  </style>

  <h4 style="font-size:200%"><?php echo $gene['symbol'];?></h4>
  <h5 style="font-size:140%">In the process <?php echo strtolower($nincas['name']);?></h5>

  <table class="icons">
    <tr style="height:64px;">
      <td><img src="<?php echo base_url('/images/g1.png');?>" width="48px"></td>
      <td style="width:3px;padding:0;background:none;"></td>
  <?php if($articles):?>
      <td><a href="#tab_articles" onclick="unfold_table($('#tab_articles'));"><img src="<?php echo base_url('/images/g2.png');?>" width="48px"></a></td>
      <td style="width:3px;padding:0;background:none;"></td>
  <?php endif;?>
      <td><a href="#tab_network"><img src="<?php echo base_url('/images/g3.png');?>" width="48px"></a></td>
    </tr>
  </table>

  <div class="blank20"></div>

  <table id="tab_basic" class="full">
    <thead>
      <tr>
        <th colspan="3">Basic information<span></span></th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td colspan="2">Approved name</td>
        <td><?php echo $gene['approved_name'];?></td>
      </tr>
      <tr>
        <td colspan="2">HGNC ID</td>
        <td><a target="_blank" href="http://www.genenames.org/cgi-bin/gene_symbol_report?hgnc_id=<?php echo $gene['hgnc_id'];?>">HGNC:<?php echo $gene['hgnc_id'];?></a></td>
      </tr>
      <tr>
        <td colspan="2">Conversion score</td>
        <td>
          <svg width="200px" height="12px" style="display:inline;margin-right:10px;">
            <g>
              <rect width="100%" height="100%" y="0" x="0" style="fill:#decaed"></rect>
              <rect width="<?php echo 100*($nincas['cr_gene_num']-$gene['c_score_rank']+1)/$nincas['cr_gene_num'] ?>%" height="100%" y="0" x="0" style="fill:#9962c1"></rect>
            </g>
          </svg>
          <?php echo sprintf("%.4f", $gene['c_score']);?>
        </td>
      </tr>
      <tr>
        <td colspan="2">Balance score</td>
        <td>
          <svg width="200px" height="12px" style="display:inline;margin-right:10px;">
            <g>
              <rect width="100%" height="100%" y="0" x="0" style="fill:#decaed"></rect>
  <?php if($gene['b_score']<0):?>
              <rect width="<?php echo -50 * $gene['b_score'];?>%" height="100%" y="0" x="<?php echo 100*(1+$gene['b_score']);?>" style="fill:#00aeef"></rect>
  <?php else:?>
              <rect width="<?php echo 50 * $gene['b_score'];?>%" height="100%" y="0" x="100" style="fill:#f42145"></rect>
  <?php endif;?>
            </g>
          </svg>
          <?php echo sprintf("%.4f", $gene['b_score']);?>
        </td>
      </tr>
      <tr>
        <td><a href="http://omim.org/entry/<?php echo $nincas['in_omim_id'];?>">Inflammation</a></td>
        <td rowspan="2">gene in OMIM</td>
        <td><?php echo $gene['omim_in_gene'] ? 'Yes' : 'No';?></td>
      </tr>
      <tr>
        <td><a href="http://omim.org/entry/<?php echo $nincas['ca_omim_id'];?>">Cancer</a></td>
        <td><?php echo $gene['omim_ca_gene'] ? 'Yes' : 'No';?></td>
      </tr>
      <tr>
        <td rowspan="2">CIPHER rank in</td>
        <td>inflammation</td>
        <td><?php echo $gene['cipher_in_rank'] ? $gene['cipher_in_rank'] : 'not available';?></td>
      </tr>
      <tr>
        <td>cancer</td>
        <td><?php echo $gene['cipher_ca_rank'] ? $gene['cipher_ca_rank'] : 'not available';?></td>
      </tr>
    </tbody>
  </table>

  <?php if($expressions):?>
  <table id="tab_exp" class="full">
     <thead>
      <tr>
        <th colspan="3">Expressions<span></span></th>
      </tr>
    </thead>
    <tbody>
      <tr><td id="ge_holder">

      </td></tr>
    </tbody>
  </table>
  <?php endif;?>

  <?php if($gos):?>
  <table id="tab_gos" class="full">
    <thead>
      <tr>
        <th colspan="3">GOs<span></span></th>
      </tr>
    </thead>
    <tbody>
      <tr style="font-weight:bold;">
        <td>GO id</td>
        <td>Title</td>
        <td>Enriched by</td>
      </tr>
      <?php foreach($gos as $go):?>
      <tr>
        <td><a target="_blank" href="<?php echo base_url('/go/'.$go['go_id'].'?ninca='.$ninca);?>">GO:<?php echo $go['go_id'];?></a></td>
        <td><?php echo $go['title'];?></td>
        <td><?php echo $go['enriched_by'];?></td>
      </tr>
      <?php endforeach;?>
    </tbody>
  </table>
  <?php endif;?>

  <?php if($pathways):?>
  <table id="tab_pathways" class="full">
    <thead>
      <tr>
        <th colspan="3">Pathways<span></span></th>
      </tr>
    </thead>
    <tbody>
      <tr style="font-weight:bold;">
        <td>Pathway id</td>
        <td>Title</td>
        <td>Enriched by</td>
      </tr>
      <?php foreach($pathways as $pathway):?>
      <tr>
        <td><a target="_blank" href="<?php echo base_url('/pathway/'.$pathway['pathway_id'].'?ninca='.$ninca);?>">hsa:<?php echo $pathway['pathway_id'];?></a></td>
        <td><?php echo $pathway['title'];?></td>
        <td><?php echo $pathway['enriched_by'];?></td>
      </tr>
      <?php endforeach;?>
    </tbody>
  </table>
  <?php endif;?>

  <?php if($articles):?>
  <table id="tab_articles" class="full">
    <thead>
      <tr>
        <th colspan="2">Literatures<span></span></th>
      </tr>
    </thead>
    <tbody>
      <tr style="font-weight:bold;">
        <td>PubMed id</td>
        <td>Title</td>
      </tr>
      <?php foreach($articles as $article):?>
      <tr>
        <td width="20%"><a target="_blank" href="http://www.ncbi.nlm.nih.gov/pubmed/<?php echo $article['pmid'];?>">PMID:<?php echo $article['pmid'];?></a></td>
        <td width="60%"><?php echo $article['title'];?></td>
      </tr>
      <?php endforeach;?>
    </tbody>
  </table>
  <?php endif;?>

  <table id="tab_network" class="full">
    <tr>
      <th colspan="3">Network balance module</th>
    </tr>
  </table>

  <script type="text/javascript">
  <!--
    $(document).ready(function(){
      Genes('<?php echo $gene['symbol'];?>');
      $("#more").click(function(){
        currentMaxPoint += 20;
        currentMaxPoint = (currentMaxPoint>120)? 120 : currentMaxPoint;
        Genes('<?php echo $gene['symbol'];?>',currentMaxPoint);
      });
      $("#less").click(function(){
        currentMaxPoint -= 20;
        currentMaxPoint = (currentMaxPoint<20)? 20 : currentMaxPoint;
        Genes('<?php echo $gene['symbol'];?>',currentMaxPoint);
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

  <div id="numbar" style="font-weight:bold;">
    <span style="margin-left: 20px;">Inflammation genes</span>
    <span style="margin-left: 70px;">-1</span>
    <span style="margin-left: 198px;">0</span>
    <span style="margin-left: 198px;">+1</span>
    <span style="margin-left: 105px;">Cancer genes</span>
  </div>
  <br/>
  <br/>
<?php else:?>
  <h1>Not found</h1>
<?php endif;?>
</div>
<!-- end content -->

<script src="<?php echo base_url('script/d3.min.js')?>"></script>
<script type="text/javascript">
<!--
$(document).ready(function() {
  /* Table fold/unfold function */

  function fold_table(tab) {
    tab.children('tbody').css('display', 'none');
    tab.children('thead').children('tr').children('th').children('span').text('Unfold >');
  };
   function unfold_table(tab) {
    tab.children('tbody').css('display', 'table-row-group');
    tab.children('thead').children('tr').children('th').children('span').text('Fold <');
  }

  $("thead").click(function(){
    var span = $(this).children('tr').children('th').children('span');
    if(span.text() == 'Unfold >'){
      unfold_table($(this).parent());
    } else {
      fold_table($(this).parent());
    }
  });

  unfold_table($('#tab_basic'));
  fold_table($('#tab_exp'));
  fold_table($('#tab_gos'));
  fold_table($('#tab_pathways'));
  fold_table($('#tab_articles'));

  /* Show more function */

  var trs = $('#tab_gos>tbody>tr');
  if(trs.length > 16){
    for(var i=16; i<trs.length; ++i){ $(trs[i]).css('display', 'none'); };
    $('<tr><td class="more" colspan="3"><strong>Show more &gt;</strong></td></tr>').insertAfter('#tab_gos>tbody>tr:nth-child(16)');
  }
  trs = $('#tab_pathways>tbody>tr');
  if(trs.length > 16){
    for(var i=16; i<trs.length; ++i){ $(trs[i]).css('display', 'none'); };
    $('<tr><td class="more" colspan="3"><strong>Show more &gt;</strong></td></tr>').insertAfter('#tab_pathways>tbody>tr:nth-child(16)');
  }
  trs = $('#tab_articles>tbody>tr');
  if(trs.length > 16){
    for(var i=16; i<trs.length; ++i){ $(trs[i]).css('display', 'none'); };
    $('<tr><td class="more" colspan="2"><strong>Show more &gt;</strong></td></tr>').insertAfter('#tab_articles>tbody>tr:nth-child(16)');
  }

  $('td.more').css('cursor', 'pointer').click(function() {
    $(this).parent('tr').parent('tbody').children('tr').css('display', 'table-row');
    $(this).remove();
  });
});

// Gene expression
var ge_margin = {top: 20, right: 20, bottom: 30, left: 50},
    ge_width = 872 - ge_margin.left - ge_margin.right,
    ge_height = 200 - ge_margin.top - ge_margin.bottom;

var ge_x = d3.scale.ordinal()
    .rangeBands([0, ge_width]);

var ge_y = d3.scale.linear()
    .range([ge_height, 0]);

var ge_xAxis = d3.svg.axis()
    .scale(ge_x)
    .orient("bottom");

var ge_yAxis = d3.svg.axis()
    .scale(ge_y)
    .orient("left")
    .ticks(5);

var ge_svg = d3.select("#ge_holder").insert("svg")
    .attr("width", ge_width + ge_margin.left + ge_margin.right)
    .attr("height", ge_height + ge_margin.top + ge_margin.bottom)
  .append("g")
    .attr("transform", "translate(" + ge_margin.left + "," + ge_margin.top + ")");

var ge_data = [
<?php
  $ge_data = array();
  for($i=0;$i<count($phases);++$i){
    array_push($ge_data, '{ph:"'.$phases[$i].'", ex:'.$expressions[$i].'}');
  }
  echo(join(', ', $ge_data));
?>
];

ge_x.domain([<?php echo('"'.join('", "', $phases).'"'); ?>]);
ge_y.domain([d3.min(ge_data, function(d) { return d.ex; }), 
             d3.max(ge_data, function(d) { return d.ex; })]);

ge_svg.append("g")
    .attr("class", "x axis")
    .attr("transform", "translate(0," + ge_height + ")")
    .call(ge_xAxis);

ge_svg.append("g")
    .attr("class", "y axis")
    .call(ge_yAxis)
  .append("text")
    .attr("transform", "rotate(-90)")
    .attr("y", 6)
    .attr("dy", ".71em")
    .style("text-anchor", "end")
    .text("log scale");

ge_svg.selectAll(".bar")
    .data(ge_data)
  .enter().append("rect")
    .attr("class", "bar")
    .attr("x", function(d) { return ge_x(d.ph)+ge_x.rangeBand()*3/8; })
    .attr("width", ge_x.rangeBand()/4)
    .attr("y", function(d) { return ge_y(d.ex); })
    .attr("height", function(d) { return ge_height - ge_y(d.ex); });

// For network model
var urlOfGene = '<?php echo base_url('/gene/');?>';
var urlSeg = '?ninca=<?php echo $ninca?>';
var urlOfAjax = '<?php echo base_url('/ajax/');?>';
//-->
</script>
<script src="<?php echo base_url('script/genes.js')?>"></script>