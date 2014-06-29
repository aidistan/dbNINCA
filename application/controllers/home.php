<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

  public $options_species;
  public $options_tissue;

  public function __construct()
  {
    parent::__construct();
    
    $this->load->database();
    $this->load->helper('url');

    // Species
    $this->options_species = array();
    foreach ($this->db->select('species')->from('nincas')->group_by('species')->get()->result() as $row)
    {
        $this->options_species[count($this->options_species)+1] = $row->species;
    }
    // Tissue
    $this->options_tissue = array();
    foreach ($this->db->select('tissue')->from('nincas')->group_by('tissue')->get()->result() as $row)
    {
        $this->options_tissue[count($this->options_tissue)+1] = $row->tissue;
    }

    // Others
    $this->config->load('customs');
  }

  public function index()
  {
    $this->load->view('includes/header');
    $this->load->view('includes/sider');

    $data = array();
    $data['options_tissue'] = $this->options_tissue;
    $this->load->view('home', $data);

    $data = array();
    $data['selected'] = 0;
    $this->load->view('includes/footer', $data);
  }

  public function browser()
  {
    $this->load->view('includes/header');
    $this->load->view('includes/sider');

    $data = array();
    // Content
    $data['options_species'] = $this->options_species;
    $data['options_tissue'] = $this->options_tissue;
    $data['options_type'] = $this->config->item('options_type');
    $data['options_enriched_by'] = $this->config->item('options_enriched_by');
    // Inputs
    $ninca = $this->input->get('ninca', TRUE);
    $species = $this->input->get('species', TRUE);
    $tissue = $this->input->get('tissue', TRUE);
    $type = $this->input->get('type', TRUE);
    $enriched_by = $this->input->get('enriched_by', TRUE);
    $term = $this->input->get('term', TRUE);
    $data['ninca'] = $ninca;
    $data['species'] = $species;
    $data['tissue'] = $tissue;
    $data['type'] = $type;
    $data['enriched_by'] = $enriched_by;
    $data['term'] = $term;
    // Others
    $searching = TRUE; // Whether keep searching
    $initial = FALSE;
    $segments = array('c'=>'home', 'm'=>'browser');

    if (!($ninca||$species||$tissue||$type||$enriched_by||$term)) {
      $searching = FALSE;
      $initial = TRUE;
    } elseif (!$ninca&&$species&&$tissue)  {
      $result = $this->db->select('ninca_id')->where(array(
        "species" => $this->options_species[$species],
        "tissue" => $this->options_tissue[$tissue]
      ))->limit(1)->from('nincas')->get()->result();
      $ninca = $result[0]->ninca_id;
    }

    if ($searching&&$ninca) {
      $segments['ninca'] = $ninca;

      $result = $this->db->select('name')->from('nincas')->where('ninca_id', $ninca)->get()->result();
      $ninca_title = $result[0]->name;

      if($type){
        $segments['type'] = $type;

        if($type==1){ // Gene
          $tabName = 'genes_in_ninca';
          $order_by = 'c_score_rank';
          $order = 'asc';
          $likeStr = $tabName.'.symbol';
          $enriched_by_str = FALSE;
        }
        else{
          if($type==2){ // GO
            $tabName = 'gos_in_ninca';
            $order_by = 'adj_p_value';
            $order = 'asc';
            $likeStr = $tabName.'.go_id';
          }
          else{ // Pathway
            $tabName = 'pathways_in_ninca';
            $order_by = 'adj_p_value';
            $order = 'asc';
            $likeStr = $tabName.'.pathway_id';
          }

          $enriched_by_str = ($enriched_by == 1) ? 'bn' : ( $enriched_by == 2 ? 'bp' : '' );
          if($enriched_by_str) {
            $segments['enriched_by'] = $enriched_by;
          } else { $searching = FALSE; }
        }
      }

      if($searching){
        if($term) $segments['term'] = $term;

        // 1st search
        $this->db->from($tabName)->where('ninca_id', $ninca);
        if($enriched_by_str) $this->db->where('rank_by', $enriched_by_str);
        if($term) $this->db->like($likeStr, $term);
        if($type == 1) $this->db->where('c_score_rank !=', 0); // !!! To eliminate
        
        $start = intval($this->input->get('start', TRUE));
        $start = $start ? $start : 0;
        $total_rows = $this->db->count_all_results();

        if($total_rows){
          $per_page = 20;

          $this->load->library('pagination');
          $config['base_url'] = site_url($segments);
          $config['total_rows'] = $total_rows;
          $config['per_page'] = $per_page;
          $config['first_link'] = '< First';
          $config['last_link'] = 'Last >';
          $config['num_links'] = 5;
          $config['page_query_string'] = TRUE;
          $config['query_string_segment'] = 'start';
          $this->pagination->initialize($config);
          $pagestr = $this->pagination->create_links();

          // 2nd search
          $this->db->from($tabName)->where('ninca_id', $ninca);
          if($enriched_by_str) $this->db->where('rank_by', $enriched_by_str);
          if($term) $this->db->like($likeStr, $term);
          if($type == 1) $this->db->where('c_score_rank !=', 0); // !!! To eliminate
          $this->db->order_by($order_by, $order); 
          $this->db->limit($per_page, $start);
          $list = $this->db->get()->result_array();
        } else { $searching = FALSE; }
      } else { $searching = FALSE; }
    } else { $searching = FALSE; }

    // Post-process
    if($searching){
      if($type==2){
        for($i=0;$i<count($list);$i++){
          $result = $this->db->get_where('gos', array('go_id'=>$list[$i]['go_id']))->result();
          $list[$i]['title'] = $result[0]->title;
        }
      }
      elseif($type==3){
        for($i=0;$i<count($list);$i++){
          $result = $this->db->get_where('pathways', array('pathway_id'=>$list[$i]['pathway_id']))->result();
          $list[$i]['title'] = $result[0]->title;
        }
      }
    }
    
    $data['initial'] = $initial;
    $data['list'] = isset($list) ? $list : FALSE;
    $data['pagestr'] = isset($pagestr) ? $pagestr : '';

    $data['ninca'] = $ninca;
    $data['ninca_title'] = isset($ninca_title) ? $ninca_title : '';

    $this->load->view('browser', $data);

    // Footer
    $data = array();
    $data['selected'] = 1;
    $this->load->view('includes/footer', $data);
  }

  public function gene()
  {
    $this->load->view('includes/header');

    // Get input
    $symbol = $this->uri->rsegment(3);
    $ninca = $this->input->get('ninca', TRUE);
    $nincas = $this->db->from('nincas')->where('ninca_id', $ninca)->get()->row_array();
    if(!($symbol&&$ninca&&$nincas)){
      redirect(site_url());
      return;
    }
    
    $data = array();
    $data['ninca'] = $ninca;
    $data['nincas'] = $nincas;

    // Fetch gene
    $data['gene'] = array();
    $this->db->where('symbol' ,$symbol);
    $this->db->from('genes');
    $this->db->limit(1);
    $gene = $this->db->get()->row_array();

    if($gene){
      $this->db->where('ninca_id' ,$ninca);
      $this->db->where('symbol' ,$symbol);
      $this->db->from('genes_in_ninca');
      $this->db->limit(1);
      $gene_in_ninca = $this->db->get()->row_array();

      if($gene_in_ninca){
        $data['gene'] = array_merge($gene_in_ninca, $gene);
        // Gene finished

        // Fetch expression
        $data['expressions'] = array();
        $this->db->where('ninca_id', $ninca)->where('symbol' ,$symbol);
        $this->db->order_by('phase_id', 'asc');
        $this->db->from('expressions_in_ninca');
        foreach($this->db->get()->result() as $exp){
          $data['expressions'][$exp->phase_id] = $exp->mean;
        }
        if($data['expressions']){
          $data['phases'] = array();
          $this->db->where('ninca_id', $ninca);
          $this->db->order_by('phase_id', 'asc');
          $this->db->from('phases_in_ninca');
          foreach($this->db->get()->result() as $ph){
            $data['phases'][$ph->phase_id] = $ph->name;
          }
        }

        // Fetch GOs
        $data['gos'] = array();
        $options_enriched_by = $this->config->item('options_enriched_by');
        $this->db->where('ninca_id' ,$ninca);
        $this->db->where('symbol' ,$symbol);
        $this->db->from('genes_in_go');
        $gene_in_go = $this->db->get()->result();
        foreach($gene_in_go as $go){
          $enriched_by = '';

          $this->db->where('ninca_id' ,$ninca);
          $this->db->where('go_id', $go->go_id);
          $this->db->where('rank_by', 'bn');
          $this->db->from('gos_in_ninca');
          if($this->db->get()->row_array()) $enriched_by = $options_enriched_by[1];

          $this->db->where('ninca_id' ,$ninca);
          $this->db->where('go_id', $go->go_id);
          $this->db->where('rank_by', 'bp');
          $this->db->from('gos_in_ninca');
          if($this->db->get()->row_array())
            if($enriched_by)
              $enriched_by = 'both';
            else
              $enriched_by = $options_enriched_by[2];

          if($enriched_by){
            $result = $this->db->where('go_id', $go->go_id)->from('gos')->limit(1)->get()->row_array();
            $data['gos'][count($data['gos'])+1] = array(
              'go_id' => $go->go_id,
              'title' => $result['title'],
              'enriched_by' => $enriched_by
            );
          }
        }
        // GOs finished

        // Fetch Pathways
        $data['pathways'] = array();
        $options_enriched_by = $this->config->item('options_enriched_by');
        $this->db->where('ninca_id' ,$ninca);
        $this->db->where('symbol' ,$symbol);
        $this->db->from('genes_in_pathway');
        $gene_in_pathway = $this->db->get()->result();
        foreach($gene_in_pathway as $pathway){
          $enriched_by = '';

          $this->db->where('ninca_id' ,$ninca);
          $this->db->where('pathway_id', $pathway->pathway_id);
          $this->db->where('rank_by', 'bn');
          $this->db->from('pathways_in_ninca');
          if($this->db->get()->row_array()) $enriched_by = $options_enriched_by[1];

          $this->db->where('ninca_id' ,$ninca);
          $this->db->where('pathway_id', $pathway->pathway_id);
          $this->db->where('rank_by', 'bp');
          $this->db->from('pathways_in_ninca');
          if($this->db->get()->row_array())
            if($enriched_by)
              $enriched_by = 'both';
            else
              $enriched_by = $options_enriched_by[2];

          if($enriched_by){
            $result = $this->db->where('pathway_id', $pathway->pathway_id)->from('pathways')->limit(1)->get()->row_array();
            $data['pathways'][count($data['pathways'])+1] = array(
              'pathway_id' => $pathway->pathway_id,
              'title' => $result['title'],
              'enriched_by' => $enriched_by
            );
          }
        }
        // Pathways finished

        // Fetch articles
        $data['articles'] = array();
        $this->db->where('ninca_id' ,$ninca);
        $this->db->where('symbol' ,$symbol);
        $this->db->where('type' ,'ic');
        $this->db->from('genes_in_article');
        foreach($this->db->get()->result() as $article){
          $result = $this->db->where('pmid', $article->pmid)->from('articles')->limit(1)->get()->row_array();
          $data['articles'][count($data['articles'])+1] = array(
            'pmid' => $article->pmid,
            'title' => $result['title']
          );
        }
        // articles finished
      }
    }

    $this->load->view('gene', $data);
    $this->load->view('includes/footer');
  }

  public function go(){
    $this->load->view('includes/header');

    // Get input
    $id = $this->uri->rsegment(3, 0);
    $ninca = $this->input->get('ninca', TRUE);
    $ninca_title = $this->db->select('name')->from('nincas')->where('ninca_id', $ninca)->get()->result();
    if(count($ninca_title)) $ninca_title = $ninca_title[0]->name;
    if(!($id&&$ninca&&$ninca_title)){
      redirect(site_url());
      return;
    }
    
    $data = array();
    $data['ninca'] = $ninca;
    $data['ninca_title'] = $ninca_title;

    $data['go'] = array();
    $this->db->where('go_id' ,$id);
    $this->db->from('gos');
    $this->db->limit(1);
    $go = $this->db->get()->row_array();

    if($go){
      $go['enriched_by'] = array();
      $this->db->where('ninca_id', $ninca);
      $this->db->where('go_id', $id);
      $this->db->from('gos_in_ninca');
      foreach($this->db->get()->result() as $record){
        switch($record->rank_by){
          case 'bn':
            $go['enriched_by']['1'] = $record;
            break;
          case 'bp':
            $go['enriched_by']['2'] = $record;
            break;
          default:
            $go['enriched_by']['3'] = $record;
        }
      }
    }

    // Find one gene belongs to the GO
    if($go['enriched_by']){
      $data['go'] = $go;

      $this->db->where('go_id' ,$id);
      $this->db->where('ninca_id' ,$ninca);
      $this->db->from('genes_in_go');
      $this->db->limit(1);
      $data['gene_in_go'] = $this->db->get()->row_array();
    }

    $this->load->view('go', $data);
    $this->load->view('includes/footer');
  }

  public function pathway()
  {
    $this->load->view('includes/header');

    // Get input
    $id = $this->uri->rsegment(3, 0);
    $ninca = $this->input->get('ninca', TRUE);
    $ninca_title = $this->db->select('name')->from('nincas')->where('ninca_id', $ninca)->get()->result();
    if(count($ninca_title)) $ninca_title = $ninca_title[0]->name;
    if(!($id&&$ninca&&$ninca_title)){
      redirect(site_url());
      return;
    }

    $data = array();
    $data['ninca'] = $ninca;
    $data['ninca_title'] = $ninca_title;

    $data['pathway'] = array();
    $this->db->where('pathway_id' ,$id);
    $this->db->from('pathways');
    $this->db->limit(1);
    $pathway = $this->db->get()->row_array();

    if($pathway){
      $pathway['enriched_by'] = array();
      $this->db->where('ninca_id', $ninca);
      $this->db->where('pathway_id', $id);
      $this->db->from('pathways_in_ninca');
      foreach($this->db->get()->result() as $record){
        switch($record->rank_by){
          case 'bn':
            $pathway['enriched_by']['1'] = $record;
            break;
          case 'bp':
            $pathway['enriched_by']['2'] = $record;
            break;
          default:
            $pathway['enriched_by']['3'] = $record;
        }
      }
    }

    // Find one gene belongs to the GO
    if($pathway['enriched_by']){
      $data['pathway'] = $pathway;

      $this->db->where('pathway_id' ,$id);
      $this->db->where('ninca_id' ,$ninca);
      $this->db->from('genes_in_pathway');
      $this->db->limit(1);
      $data['gene_in_pathway'] = $this->db->get()->row_array();
    }

    $this->load->view('pathway', $data);
    $this->load->view('includes/footer');
  }

  public function ajax(){
    $symbol = $this->uri->rsegment(3, 0);
    $limit = $this->uri->rsegment(4, 20);
    $d3 = $baseline = $base = $line = $nodes = $baslinks = $links = array();
    $maxnum = 0;
    $pagenum = $limit;
    if($symbol){
      $this->db->where('source' , $symbol);
      $this->db->from('ppi');
      $this->db->limit($limit);
      $this->db->order_by('string_score','desc');
      $baseList = $this->db->get()->result_array();
      //echo $this->db->last_query();      
      if($baseList){
        $maxnum = count($baseList);
        $line[] = $symbol;
        foreach($baseList as $bl=>$bv){
          $line[] = $bv['target'];
        }
        $this->db->where_in('symbol' , $line);
        $this->db->from('genes_in_ninca');
        //$this->db->limit(21);
        $this->db->group_by("symbol");
        $baseline = $this->db->get()->result_array();
        //echo $this->db->last_query();
        if($baseline){
          $i = 0;
          $bscore = 0.0;
          $group = 2;
          $opacity = 0.9;
          $line = array();
          foreach($baseline as $bl2=>$bv2){
            $line[] = $bv2['symbol'];
            $bscore = floatval($bv2['b_score']);
            $opacity = $bscore > 0 ? (5+intval(abs($bscore)*10)/2)/10 : (intval(abs($bscore)*10)/2)/10;
            $opacity = $opacity < 0.3 ? 0.3 : $opacity;
            $group = abs($bscore)*10;
            $group = $bscore > 0 ? 10 + $group : 10 - $group;
            $nodes[$i]['name'] = $bv2['symbol'];
            $nodes[$i]['index'] = $i;
            $nodes[$i]['group'] = intval($group);
            $nodes[$i]['opacity'] = $opacity;
            $nodes[$i]['b_score'] = $bscore;
            if($bv2['symbol'] == $symbol){ $nodes[$i]['core'] = 1 ; }
            $i++;
          }
          $base = array_flip($line);
        }
      }
      if($nodes){
        $this->db->select('p1.*');
        $this->db->where('p0.source' , $symbol);
        $this->db->from('ppi as p0');
        $this->db->join('ppi as p1', 'p0.target=p1.source', 'left');
        $baslinks = $this->db->get()->result_array();
        //echo $this->db->last_query();
        if($baslinks){
          $j = 0;
          foreach($baslinks as $bl3=>$bv3){
            if(isset($base[$bv3['source']]) && isset($base[$bv3['target']])){
              $links[$j]['source'] = $base[$bv3['source']];
              $links[$j]['target'] = $base[$bv3['target']];
              $links[$j]['string_score'] = $bv3['string_score'];
              $links[$j]['value'] = 1;
              $j++;
            }
          }
        }
      }
      $d3['nodes'] = $nodes;
      $d3['links'] = $links;
      $d3['maxnum'] = $maxnum;
      $d3['pagenum'] = $pagenum;
    }
    echo json_encode($d3);
    exit;
  }

  public function statistics()
  {
    $this->load->view('includes/header');
    $this->load->view('includes/sider');
    $this->load->view('statistics');

    $data = array();
    $data['selected'] = 2;
    $this->load->view('includes/footer', $data);  
  }

  public function download()
  {
    $this->load->view('includes/header');
    $this->load->view('includes/sider');
    $this->load->view('download');

    $data = array();
    $data['selected'] = 3;
    $this->load->view('includes/footer', $data);  
  }

  public function help()
  {
    $this->load->view('includes/header');
    // $this->load->view('includes/sider');
    $this->load->view('help');

    $data = array();
    $data['selected'] = 4;
    $this->load->view('includes/footer', $data);  
  }
}

/* End of file home.php */
/* Location: ./application/controllers/home.php */