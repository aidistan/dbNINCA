<!-- begin content -->
<div id="content"style="width: 880px;">
  <h1>1. How to search?</h1>
  <p>Input your gene of interest, and select a tissue type.</p>
  <ol>
    <li>Select "stomach" : from gastritis to gastric cancer</li>
    <li>Select "liver": from hepatitis to liver cancer</li>
    <li>Select "colon": from inflammatory bowel disease to colorectal cancer</li>
  </ol>

  <h1>2. How to read searching result?</h1>
  <p>An example result is like this:</p>
  <div style="margin:5px;border:2px solid black;"><img src="<?php echo base_url('/images/help_1.png');?>" style="width:100%;"></div>

  <h2>Conversion score</h2>
  <p>A gene with conversion score greater than 0 means that this gene is involved in the process from inflammation to cancer. Conversion score is calculated by considering the closeness of a gene to the seed genes of inflammation and cancer in the protein-protein interaction network, and the different expression of a gene in the inflammation and cancer.</p>
  <h2>Balanced score</h2>
  <p>Balanced score is calculated based on Conversion score. The genes with certain Conversion score are collected. Then, each gene is calculated by Balance score to describe the double-face role of a gene in the process from inflammation to cancer, which results in two types of genes.</p>

  <h1>3. How to browse?</h1>
  <p>We support three ways to browse : gene, GO and pathway. </p>
  <p>The way to browse GO and pathway is similar. Take browsing GO as example:

  <center>
    <div style="margin:15px 0;border:2px solid black;width:600px;"><img src="<?php echo base_url('/images/help_2.png');?>" style="width:100%;"></div>
  </center>

  <p><strong>"Enriched by…"</strong> has two options: (1) Inflammation-inclined gene; (2) Cancer-included gene. We did enrichment analysis in two gene sets above, separately. So enrichment results are also shown separately.</p>

  <div class="blank20"></div>
</div>
<!-- end content -->