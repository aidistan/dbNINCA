<!-- begin content -->
<div id="content">
  <h2>Data resource</h2>

  <h3>Microarray data</h3>
  <table>
    <tr>
      <th></th>
      <th>GEO accession</th>
      <th>Sample type</th>
      <th>Total of used samples</th>
    </tr>

    <tr>
      <td rowspan="3">From IBD to CRC</td>
      <td rowspan="3"><a href="http://www.ncbi.nlm.nih.gov/geo/query/acc.cgi?acc=gse4183">GSE4183</a></td>
      <td>Normal</td>
      <td>8</td>
    </tr>
    <tr>
      <td>Inflammatory bowel diseases (IBD)</td>
      <td>15</td>
    </tr>
    <tr>
      <td>Colorectal carcinomas(CRC)</td>
      <td>15</td>
    </tr>

    <tr>
      <td rowspan="3">From Hepatitis to HCC</td>
      <td rowspan="3"><a href="http://www.ncbi.nlm.nih.gov/geo/query/acc.cgi?acc=GSE25097">GSE25097</a></td>
      <td>Normal</td>
      <td>6</td>
    </tr>
    <tr>
      <td>Cirrhosis</td>
      <td>40</td>
    </tr>
    <tr>
      <td>Hepatocellular carcinoma (HCC)</td>
      <td>268</td>
    </tr>

    <tr>
      <td rowspan="4">From Gastritis to GC</td>
      <td rowspan="4"><a href="http://www.ncbi.nlm.nih.gov/geo/query/acc.cgi?acc=GSE2669">GSE2669</a></td>
      <td>Normal</td>
      <td>10</td>
    </tr>
    </tr>
    <tr>
      <td>Chronic gastritis</td>
      <td>26</td>
    </tr>
    <tr>
      <td>Intestinal metaplasia</td>
      <td>22</td>
    </tr>
    <tr>
      <td>Gastric cancer (GC), intestinal</td>
      <td>22</td>
    </tr>
  </table>

  <h3>Inflammation/caner genes from OMIM and inference</h3>
  <h4>Method for disease gene inference: CIPHER</h4>
  <h6>Reference: Wu, X., Jiang, R., Zhang, M. Q., and Li, S., Network-based global inference of human disease genes. Mol Syst Biol 4 (1), 189 (2008).</h6>
  <table>
    <tr>
      <th></th>
      <th>OMIM entry</th>
      <th>Entity</th>
      <th>Genes selected</th>
    </tr>

    <tr>
      <td rowspan="2">From IBD to CRC</td>
      <td><a href="http://omim.org/entry/266600">266600</a></td>
      <td>inflammatory bowel disease 1; IBD1</td>
      <td>Top 100</td>
    </tr>
    <tr>
      <td><a href="http://omim.org/entry/114500">114500</a></td>
      <td>colorectal cancer; CRC</td>
      <td>Top 100</td>
    </tr>

    <tr>
      <td rowspan="2">From Hepatitis to HCC</td>
      <td><a href="http://omim.org/entry/610224">610224</a></td>
      <td>hepatitis B virus, susceptibility to</td>
      <td>Top 100</td>
    </tr>
    <tr>
      <td><a href="http://omim.org/entry/114550">114550</a></td> 
      <td>hepatocellular carcinoma</td>
      <td>Top 100</td>
    </tr>

    <tr>  
      <td rowspan="2">From Gastritis to GC</td>
      <td><a href="http://omim.org/entry/600263">600263</a></td>
      <td>helicobacter pylori infection, susceptibility to</td>
      <td>Top 100</td>
    </tr>
    <tr>
      <td><a href="http://omim.org/entry/613659">613659</a></td>
      <td>gastric cancer, intestinal, included</td>
      <td>Top 100</td>
    </tr>
  </table>

  <h3>PubMed literature</h3>
  <table>
    <tr>
      <th></th>
      <th>Theme<br/><small>(hover to show terms we used)</small></th>
      <th>Total of related literatures</th>
      <th>Total of related genes</th>
    </tr>
    <tr>
      <td>From IBD to CRC</td>
      <td><a title="((IBD OR colitis OR Crohn's disease) OR ((Inflammation OR Inflammatory) AND (colon OR bowel OR colorectal))) AND ((cancer OR carcinoma OR neoplasia OR carcinogenesis OR tumor OR tumour OR tumorigenesis) AND (colon OR bowel OR colorectal)) AND (associated OR induced)">from inflammation to cancer, in colon</a></td>
      <td>10908</td>
      <td>2153</td>
    </tr>
    <tr>
      <td>From Hepatitis to HCC</td>
      <td><a title="(hepatitis OR ((Inflammation OR Inflammatory) AND (liver OR hepatocellular))) AND ((cancer OR carcinoma OR neoplasia OR carcinogenesis OR tumor OR tumour OR tumorigenesis) AND (liver OR hepatocellular)) AND (associated OR induced)">from inflammation to cancer, in liver</a></td>
      <td>16879</td>
      <td>2758</td>
    </tr>
    <tr>  
      <td>From Gastritis to GC</td>
      <td><a title="((gastritis OR intestinal metaplasia) OR ((Inflammation OR Inflammatory) AND (gastric OR stomach))) AND ((cancer OR carcinoma OR neoplasia OR carcinogenesis OR tumor OR tumour OR tumorigenesis) AND (gastric OR stomach)) AND (associated OR induced)">from inflammation to cancer, in stomach</a></td>
      <td>5864</td>
      <td>1309</td>
    </tr>
  </table>
  
  <h2>Result summary</h2>

  <h3>From IBD to CRC</h3>

  <table>
    <tr>
      <th>Category</th>
      <th>Number of genes</th>
      <th>Top 10 enriched gene ontologys</th>
      <th>Top 10 enriched signaling pathways</th>
    </tr>
    <tr>
      <td rowspan=10>Conversion-related genes</td>
      <td rowspan=10>513</td>
      <td>intracellular signaling cascade</td>
      <td>Jak-STAT signaling pathway</td>
    </tr>
    <tr>
      <td>cell surface receptor linked signal transduction</td>
      <td>Chemokine signaling pathway</td>
    </tr>
    <tr>
      <td>regulation of cell proliferation</td>
      <td>T cell receptor signaling pathway</td>
    </tr>
    <tr>
      <td>positive regulation of cell proliferation</td>
      <td>Fc epsilon RI signaling pathway</td>
    </tr>
    <tr>
      <td>response to organic substance</td>
      <td>ErbB signaling pathway</td>
    </tr>
    <tr>
      <td>positive regulation of molecular function</td>
      <td>B cell receptor signaling pathway</td>
    </tr>
    <tr>
      <td>response to hormone stimulus</td>
      <td>Phosphatidylinositol signaling system</td>
    </tr>
    <tr>
      <td>response to endogenous stimulus</td>
      <td>Neurotrophin signaling pathway</td>
    </tr>
    <tr>
      <td>regulation of phosphorylation</td>
      <td>Inositol phosphate metabolism</td>
    </tr>
    <tr>
      <td>positive regulation of catalytic activity</td>
      <td>Fc gamma R-mediated phagocytosis</td>
    </tr>
    <tr>
      <td rowspan=10>Inflammtion-inclined genes</td>
      <td rowspan=10>208</td>
      <td>intracellular signaling cascade</td>
      <td>Jak-STAT signaling pathway</td>
    </tr>
    <tr>
      <td>transmembrane receptor protein tyrosine kinase signaling pathway</td>
      <td>T cell receptor signaling pathway</td>
    </tr>
    <tr>
      <td>protein kinase cascade</td>
      <td>Fc epsilon RI signaling pathway</td>
    </tr>
    <tr>
      <td>positive regulation of cell proliferation</td>
      <td>B cell receptor signaling pathway</td>
    </tr>
    <tr>
      <td>regulation of cell proliferation</td>
      <td>Chemokine signaling pathway</td>
    </tr>
    <tr>
      <td>enzyme linked receptor protein signaling pathway</td>
      <td>Natural killer cell mediated cytotoxicity</td>
    </tr>
    <tr>
      <td>cell surface receptor linked signal transduction</td>
      <td>ErbB signaling pathway</td>
    </tr>
    <tr>
      <td>protein amino acid phosphorylation</td>
      <td>Cytokine-cytokine receptor interaction</td>
    </tr>
    <tr>
      <td>regulation of phosphorylation</td>
      <td>Neurotrophin signaling pathway</td>
    </tr>
    <tr>
      <td>phosphate metabolic process</td>
      <td>Focal adhesion</td>
    </tr>
    <tr>
      <td rowspan=10>Cancer-inclined genes</td>
      <td rowspan=10>305</td>
      <td>cell surface receptor linked signal transduction</td>
      <td>Neuroactive ligand-receptor interaction</td>
    </tr>
    <tr>
      <td>intracellular signaling cascade</td>
      <td>Calcium signaling pathway</td>
    </tr>
    <tr>
      <td>G-protein coupled receptor protein signaling pathway</td>
      <td>Inositol phosphate metabolism</td>
    </tr>
    <tr>
      <td>phosphoinositide-mediated signaling</td>
      <td>Phosphatidylinositol signaling system</td>
    </tr>
    <tr>
      <td>regulation of cell proliferation</td>
      <td>Cell cycle</td>
    </tr>
    <tr>
      <td>positive regulation of catalytic activity</td>
      <td>Chemokine signaling pathway</td>
    </tr>
    <tr>
      <td>positive regulation of phospholipase activity</td>
      <td>Wnt signaling pathway</td>
    </tr>
    <tr>
      <td>positive regulation of molecular function</td>
      <td>ErbB signaling pathway</td>
    </tr>
    <tr>
      <td>regulation of phospholipase activity</td>
      <td>Adherens junction</td>
    </tr>
    <tr>
      <td>activation of phospholipase C activity</td>
      <td>Regulation of actin cytoskeleton</td>
    </tr>
  </table>

  <h3>From Hepatitis to HCC</h3>

  <table>
    <tr>
      <th>Category</th>
      <th>Number of genes</th>
      <th>Top 10 enriched gene ontologys</th>
      <th>Top 10 enriched signaling pathways</th>
    </tr>
    <tr>
      <td rowspan=10>Conversion-related genes</td>
      <td rowspan=10>306</td>
      <td>cell cycle</td>
      <td>Cell cycle</td>
    </tr>
    <tr>
      <td>mitotic cell cycle</td>
      <td>Proteasome</td>
    </tr>
    <tr>
      <td>cell cycle process</td>
      <td>Oocyte meiosis</td>
    </tr>
    <tr>
      <td>regulation of ubiquitin-protein ligase activity</td>
      <td>Progesterone-mediated oocyte maturation</td>
    </tr>
    <tr>
      <td>regulation of ubiquitin-protein ligase activity during mitotic cell cycle</td>
      <td>p53 signaling pathway</td>
    </tr>
    <tr>
      <td>positive regulation of ubiquitin-protein ligase activity</td>
      <td>MAPK signaling pathway</td>
    </tr>
    <tr>
      <td>regulation of ligase activity</td>
      <td>Neurotrophin signaling pathway</td>
    </tr>
    <tr>
      <td>positive regulation of ubiquitin-protein ligase activity during mitotic cell cycle</td>
      <td>Toll-like receptor signaling pathway</td>
    </tr>
    <tr>
      <td>positive regulation of ligase activity</td>
      <td>Focal adhesion</td>
    </tr>
    <tr>
      <td>positive regulation of protein ubiquitination</td>
      <td>TGF-beta signaling pathway</td>
    </tr>
    <tr>
      <td rowspan=10>Inflammtion-inclined genes</td>
      <td rowspan=10>76</td>
      <td>regulation of apoptosis</td>
      <td>Toll-like receptor signaling pathway</td>
    </tr>
    <tr>
      <td>regulation of programmed cell death</td>
      <td>RIG-I-like receptor signaling pathway</td>
    </tr>
    <tr>
      <td>regulation of cell death</td>
      <td>T cell receptor signaling pathway</td>
    </tr>
    <tr>
      <td>response to organic substance</td>
      <td>NOD-like receptor signaling pathway</td>
    </tr>
    <tr>
      <td>response to hormone stimulus</td>
      <td>Apoptosis</td>
    </tr>
    <tr>
      <td>protein kinase cascade</td>
      <td>Neurotrophin signaling pathway</td>
    </tr>
    <tr>
      <td>apoptosis</td>
      <td>Fc epsilon RI signaling pathway</td>
    </tr>
    <tr>
      <td>programmed cell death</td>
      <td>Epithelial cell signaling in Helicobacter pylori infection</td>
    </tr>
    <tr>
      <td>intracellular signaling cascade</td>
      <td>MAPK signaling pathway</td>
    </tr>
    <tr>
      <td>response to endogenous stimulus</td>
      <td>Natural killer cell mediated cytotoxicity</td>
    </tr>
    <tr>
      <td rowspan=10>Cancer-inclined genes</td>
      <td rowspan=10>230</td>
      <td>cell cycle</td>
      <td>Cell cycle</td>
    </tr>
    <tr>
      <td>mitotic cell cycle</td>
      <td>Proteasome</td>
    </tr>
    <tr>
      <td>cell cycle process</td>
      <td>Oocyte meiosis</td>
    </tr>
    <tr>
      <td>positive regulation of ubiquitin-protein ligase activity</td>
      <td>Progesterone-mediated oocyte maturation</td>
    </tr>
    <tr>
      <td>positive regulation of ubiquitin-protein ligase activity during mitotic cell cycle</td>
      <td>p53 signaling pathway</td>
    </tr>
    <tr>
      <td>positive regulation of ligase activity</td>
      <td>TGF-beta signaling pathway</td>
    </tr>
    <tr>
      <td>regulation of ubiquitin-protein ligase activity</td>
      <td>Ubiquitin mediated proteolysis</td>
    </tr>
    <tr>
      <td>regulation of ubiquitin-protein ligase activity during mitotic cell cycle</td>
      <td>Wnt signaling pathway</td>
    </tr>
    <tr>
      <td>positive regulation of protein ubiquitination</td>
      <td>Endocytosis</td>
    </tr>
    <tr>
      <td>regulation of ligase activity</td>
      <td>Focal adhesion</td>
    </tr>
  </table>

  <h3>From Gastritis to GC</h3>

  <table>
    <tr>
      <th>Category</th>
      <th>Number of genes</th>
      <th>Top 10 enriched gene ontologys</th>
      <th>Top 10 enriched signaling pathways</th>
    </tr>
    <tr>
      <td rowspan=10>Conversion-related genes</td>
      <td rowspan=10>552</td>
      <td>cell cycle</td>
      <td>Cell cycle</td>
    </tr>
    <tr>
      <td>cell cycle process</td>
      <td>Oocyte meiosis</td>
    </tr>
    <tr>
      <td>cell cycle phase</td>
      <td>MAPK signaling pathway</td>
    </tr>
    <tr>
      <td>mitotic cell cycle</td>
      <td>Neurotrophin signaling pathway</td>
    </tr>
    <tr>
      <td>DNA metabolic process</td>
      <td>Progesterone-mediated oocyte maturation</td>
    </tr>
    <tr>
      <td>M phase</td>
      <td>Nucleotide excision repair</td>
    </tr>
    <tr>
      <td>response to DNA damage stimulus</td>
      <td>Ubiquitin mediated proteolysis</td>
    </tr>
    <tr>
      <td>regulation of cell cycle</td>
      <td>DNA replication</td>
    </tr>
    <tr>
      <td>cellular response to stress</td>
      <td>ErbB signaling pathway</td>
    </tr>
    <tr>
      <td>DNA repair</td>
      <td>p53 signaling pathway</td>
    </tr>
    <tr>
      <td rowspan=10>Inflammtion-inclined genes</td>
      <td rowspan=10>174</td>
      <td>regulation of programmed cell death</td>
      <td>MAPK signaling pathway</td>
    </tr>
    <tr>
      <td>regulation of cell death</td>
      <td>Neurotrophin signaling pathway</td>
    </tr>
    <tr>
      <td>regulation of apoptosis</td>
      <td>ErbB signaling pathway</td>
    </tr>
    <tr>
      <td>intracellular signaling cascade</td>
      <td>VEGF signaling pathway</td>
    </tr>
    <tr>
      <td>regulation of cell proliferation</td>
      <td>B cell receptor signaling pathway</td>
    </tr>
    <tr>
      <td>protein kinase cascade</td>
      <td>Focal adhesion</td>
    </tr>
    <tr>
      <td>response to organic substance</td>
      <td>T cell receptor signaling pathway</td>
    </tr>
    <tr>
      <td>regulation of phosphorylation</td>
      <td>Fc epsilon RI signaling pathway</td>
    </tr>
    <tr>
      <td>negative regulation of apoptosis</td>
      <td>Natural killer cell mediated cytotoxicity</td>
    </tr>
    <tr>
      <td>negative regulation of programmed cell death</td>
      <td>Toll-like receptor signaling pathway</td>
    </tr>
    <tr>
      <td rowspan=10>Cancer-inclined genes</td>
      <td rowspan=10>378</td>
      <td>cell cycle</td>
      <td>Cell cycle</td>
    </tr>
    <tr>
      <td>cell cycle process</td>
      <td>Oocyte meiosis</td>
    </tr>
    <tr>
      <td>cell cycle phase</td>
      <td>Progesterone-mediated oocyte maturation</td>
    </tr>
    <tr>
      <td>mitotic cell cycle</td>
      <td>Ubiquitin mediated proteolysis</td>
    </tr>
    <tr>
      <td>M phase</td>
      <td>DNA replication</td>
    </tr>
    <tr>
      <td>DNA metabolic process</td>
      <td>p53 signaling pathway</td>
    </tr>
    <tr>
      <td>cell division</td>
      <td>Nucleotide excision repair</td>
    </tr>
    <tr>
      <td>mitosis</td>
      <td>Homologous recombination</td>
    </tr>
    <tr>
      <td>nuclear division</td>
      <td>Mismatch repair</td>
    </tr>
    <tr>
      <td>M phase of mitotic cell cycle</td>
      <td>TGF-beta signaling pathway</td>
    </tr>
  </table>

  <div class="blank20"></div>
</div>
<!-- end content -->