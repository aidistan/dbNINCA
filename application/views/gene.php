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
  </style>

  <h4 style="font-size:200%"><?php echo $gene['symbol'];?></h4>
  <h5 style="font-size:140%">in the process <?php echo $nincas['name'];?></h5>

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
        <td><?php echo $gene['c_score'];?></td>
      </tr>
      <tr>
        <td colspan="2">Balance score</td>
        <td><?php echo $gene['b_score'];?></td>
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
var urlOfGene = '<?php echo base_url('/gene/');?>';
var urlSeg = '?ninca=<?php echo $ninca?>';
var urlOfAjax = '<?php echo base_url('/ajax/');?>';

  function fold_table(tab) {
    tab.children('tbody').css('display', 'none');
    tab.children('thead').children('tr').children('th').children('span').text('Unfold >');
  };
   function unfold_table(tab) {
    tab.children('tbody').css('display', 'table-row-group');
    tab.children('thead').children('tr').children('th').children('span').text('Fold <');
  }

$(document).ready(function() {

  $("thead").click(function(){
    var span = $(this).children('tr').children('th').children('span');
    if(span.text() == 'Unfold >'){
      unfold_table($(this).parent());
    } else {
      fold_table($(this).parent());
    }
  });

  unfold_table($('#tab_basic'));
  fold_table($('#tab_gos'));
  fold_table($('#tab_pathways'));
  fold_table($('#tab_articles'));
});
//-->
</script>
<script src="<?php echo base_url('script/genes.js')?>"></script>