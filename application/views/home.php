<!-- begin content -->
<div id="content">
  <!-- begin search_box -->
  <div id="search_box">
    <div class="titl">Search</div>
    <div class="titl_br"></div>
    <div class="titl_con">
      <form id="browser_form" class="form_settings" action="<?php echo base_url("/browser"); ?>" method="GET" onsubmit="if($('#term').val()==''){ alert('Please enter a gene symbol');return false;}else if($('#tissue').val()==''){ alert('Please select a tissue');return false; };">
        <input type="hidden" name="species" value="1" />
        <input type="hidden" name="type" value="1" />

        <div style="position:relative;top:6px;left:0px;width:100%">
          Enter an approved gene symbol: 
          <span style="float:right;"><a style="cursor:pointer;" onclick="window.open('<?php echo base_url('tool')?>', '', 'height=400, width=400, top=100, left=100')">(Tool to query approved symbols)</a></span>
          <br/>
          <input name="term" id="term" style="width:100%;height:1.5em;padding-left: 5px;" type="text">
        </div>

        <div style="padding-top:20px;">
          Inflammation to cancer in
          <select id="tissue" name="tissue" style="height: 22px;width: 120px;"> 
            <option value="">Select...</option>
            <?php foreach($options_tissue as $k1=>$v1):?>
              <option value="<?php echo $k1;?>"><?php echo $v1;?></option>
            <?php endforeach;?>
          </select>
        </div>

        <div style="padding-top:20px;">
          Examples:
          <ul style="padding-left:20px;">
            <li><a style="cursor:pointer;" onclick="$('#term').val('STAT3');$('#tissue').val(1);">STAT3 in Colon (from inflammatory bowel disease to colorectal cancer)</a><br/></li>
            <li><a style="cursor:pointer;" onclick="$('#term').val('NFKB1');$('#tissue').val(2);">NFKB1 in Liver (from hepatitis to liver cancer)</a></li>
            <li><a style="cursor:pointer;" onclick="$('#term').val('TNF');$('#tissue').val(3);">TNF in Stomach (from gastritis to gastric cancer)</a></li>
          </ul>
        </div>

        <div style="padding-top:20px;"><input type="submit" class="submit" value="Go"></div>
      </form>
    </div>
  </div>
  <!-- end search_box -->
  <div class="blank20"></div>
  <!-- begin description -->
  <div style="width: 620px;">
    <div class="titl">What is dbNINCA?</div>
    <div class="titl_br"></div>
    <div class="titl_con">
      <p>The dbNINCA is the first database to construct molecular networks underlying the process from inflammation to cancer.</p>
      <p>Inflammation-to-cancer is a highly complex and dynamic process, and lacks of clinical data. By proposing a novel model of network balance, this database is able to capture molecular links from inflammation to cancer. To measure the role each gene plays in the process from inflammation to cancer, the database established an effectively computational framework, which integrated microarray data analysis, network analysis, disease gene inference, and literature mining.</p>
      <p>By now, the database can be searched by not only gene, but also GO or pathway. Three typical types of inflammation-induced cancer in the digestive system are included: from gastritis to gastric cancer, from hepatitis to liver cancer, and from inflammatory bowel disease to colorectal cancer.</p>
      <img src="images/model.png" style="width:100%;">
      <div class="blank20"></div>
      <p>By the network balance model and computational analysis, two types of score are used to describe the role of gene in the process from inflammation to cancer: <strong>Conversion score</strong> and <strong>Balance score</strong>. The Conversion score is calculated by considering the closeness of a gene to the seed genes of inflammation and cancer in the protein-protein interaction network, and the different expression of a gene in the inflammation and cancer. The genes involving in the process from inflammation to cancer with certain Conversion score are collected. Then, each gene is calculated by a Balance score to discribe the double-face role of a gene in the process from inflammation to cancer, which results in two types of genes.</p>
      <p><strong>Inflammation-inclined genes</strong>: genes defined by balance score greater than 0, are close to inflammation genes but far from cancer genes in the network, thus may have lower risks of promoting tumors.</p>
      <p><strong>Cancer-inclined genes</strong>: genes defined by balance score less than 0, are close to cancer genes but far from inflammation genes in the network, thus may have higher risks of promoting tumors.</p>
    </div>
  </div>
  <!-- end description -->
  <div class="blank20"></div>
</div>
<!-- end content -->

<script>
function resetTabs() {
  $("#tabs_content > div").hide(); // Hide all content
  $("#tabs a").attr("id", ""); // Reset id's
}

function setupTabs(){
  resetTabs(); // Initially hide all content
  
  $("#tabs li:first a").attr("id", "current"); // Activate first tab
  $("#tabs_content > div:first").fadeIn(); // Show first tab content

  $("#tabs a").on("click", function(e) {
    e.preventDefault();
    if ($(this).attr("id") == "current") { // detection for current tab
      return
    } else {
      resetTabs();
      $(this).attr("id", "current"); // Activate this
      $($(this).attr('name')).fadeIn(); // Show content for current tab
    }
  });
}

$(document).ready(function() { setupTabs(); });
</script>