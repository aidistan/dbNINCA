<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tool extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->database();
    $this->load->helper('url');
  }

  public function index() {
    $data = array();
    $term = $this->input->get('term', TRUE);
    $data['term'] = $term;
    $data['result'] = array();

    $start = intval($this->input->get('start', TRUE));
    $start = $start ? $start : 0;

    if($term){
      $this->db->from('gene_synonyms')->like('symbol', $term);
      $total_rows = $this->db->count_all_results();

      if($total_rows){
        $per_page = 6;

        $this->load->library('pagination');
        $config['base_url'] = site_url(array('c'=>'tool', 'term'=>$term));
        $config['total_rows'] = $total_rows;
        $config['per_page'] = $per_page;
        $config['first_link'] = '< First';
        $config['last_link'] = 'Last >';
        $config['num_links'] = 3;
        $config['page_query_string'] = TRUE;
        $config['query_string_segment'] = 'start';
        $this->pagination->initialize($config);
        $pagestr = $this->pagination->create_links();

        // 2nd search
        $this->db->from('gene_synonyms')->like('symbol', $term);
        $data['result'] = $this->db->limit($per_page, $start)->get()->result();
      }
    }

    $data['pagestr'] = isset($pagestr) ? $pagestr : '';
    $this->load->view('tool', $data);
  }

}