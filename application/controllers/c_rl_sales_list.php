<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_rl_sales_list extends Core_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->auth_check();
		$this->load->model('m_rl_sales_list');
		$this->load->model('m_wsbangun');
		$this->load->model('m_sms');
	}

	public function index()
	{
		$entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        $projectName = $this->session->userdata('Tsprojectname');
		// $dtotal = $this->m_rl_sales_list->getdata_row();

		// foreach ($dtotal as $value) {
		// 	$total++;
		// }
		// index.php/c_rl_sales/index/10
		// $config['base_url'] = base_url("index.php/c_rl_sales_list/index");
		// $config['base_url'] = base_url("c_rl_sales_list/index");
		// $config['total_rows'] = $total;
		// $config['per_page'] = 10;

		// $this->pagination->initialize($config); 

		// $paging = $this->pagination->create_links();
		// var_dump($offset);

		// $AllData = $this->m_rl_sales_list->DataPaging();
		// $AllData = $this->m_rl_sales->GetAllData();
        $ContentAllData = array(//'kondisi'=>$x,
    			'project_no'=>$project,
				'ProjectDescs'=>$projectName);

    	// $this->load_content_top_menu('nup/NupIndex',$ContentAllData);
		$this->load_content_top_menu('booking/v_rl_sales_list',$ContentAllData);
	}
	public function getTable()
    {
    	$sSearch = $this->input->post("sSearch",true);
        if(empty($sSearch)){
            $sSearch='';
        }
        
       $entity = $this->session->userdata('Tsentity');
		// var_dump($entity);
        $project = $this->session->userdata('Tsproject');
        $name = $this->session->userdata('Tsuname');
        
        $DB2 = $this->load->database('ifca', TRUE);

        //untuk PK diharap diletakan di awal array
        $aField = array('id', 'subject', 'content','status');
        $aColumns  = array('row_number','rowID', 'SP_No', 'sales_date','status_desc','status','sell_price','lot_no');
        // $aColumns = array('entity_cd', 'entity_name');
        $sTable = 'mgr.v_rl_sales_list';

        $iDisplayStart = (int)$this->input->get_post('start', true);
        $iDisplayLength = (int)$this->input->get_post('length', true);
        $order = $this->input->get_post('order', true);
        $draw = (int)$this->input->get_post('draw', true);
        $Column = $this->input->get_post('columns', true);
        // $iSortCol_0 = $this->input->get_post('iSortCol_0', true);
        // $iSortingCols = $this->input->get_post('iSortingCols', true);
        // $sSearch = $this->input->get_post('search', true);
        // $Search = $sSearch['value'];
        $Search = $sSearch;
        // $Search_regex = $sSearch['regex'];
        $SortdOrder = $order[0]['dir'];
        $sortIdColumn = (int)$order[0]['column'];
        // var_dump($Column[$sordIdColumn]['name']);
        $SordField = ($sortIdColumn==0? $Column[6]['name'] :$Column[$sortIdColumn]['name']);

     
// var_dump($Search);
        // filter
        $filter_search='';
        if(isset($Search) && !empty($Search)){            
            for($i=0;$i<count($Column); $i++){
                if(isset($Column[$i]['searchable']) && $Column[$i]['searchable']=='true'){
                    $filter_search .=  $Column[$i]['name'] ." LIKE '%".$Search."%' OR ";
                }
                
            }
            $a = strrpos($filter_search, 'OR');        
            $filter_search = (!empty($filter_search)? "AND (".substr($filter_search, 0,$a).")":$filter_search);     

        }
        // var_dump($filter_search);
        // Select Data

        // $DB2->select('ROW_NUMBER() OVER (ORDER BY id ) AS [row_number], '.str_replace(' , ', ' ', implode(', ', $aColumns)), false);
        // // $DB2->select('SQL_CALC_FOUND_ROWS '.str_replace(' , ', ' ', implode(', ', $aColumns)), false);
        // $rResult = $DB2->get($sTable);
        // $rResult = $DB2->query($sql_data);
        $param =" Where userid = '".$name."' and entity_cd='".$entity."' AND project_no= '".$project."' ".$filter_search;
        $rResult = $this->m_wsbangun->getlisttable($sTable,(int)($iDisplayStart),(int)($iDisplayLength),$SordField,$SortdOrder,$param);
      
        // Total data set length
        
        $sql="select count(*) as cnt from ".$sTable." ".$param;
        $ts = $DB2->query($sql);
        $a = $ts->result()[0]->cnt;

        $iTotal = $a;//$DB2->count_all($sTable);
    
        // Output
        $output = array(
            'draw' => intval($draw),
            'recordsTotal' => $iTotal,
            'recordsFiltered' => $iTotal,
            'data' => array()
        );
        
        foreach($rResult->result_array() as $aRow)
        {
            $row = array();
            
            foreach($aColumns as $col)
            {
                $row[] = $aRow[$col];
                
            }
    
            $output['data'][] = $aRow;
        }

   
        echo json_encode($output);

    }

	public function hasilcari()
	{
		$perpage = 10;			
		$total = 0;
		$offset = $this->uri->segment(3);

		if($offset===false){
			$offset = 0;
		}

		$perpage = $perpage + $offset;

		$dtotal = $this->m_rl_sales_list->getdata_row();
		//var_dump($dtotal);

		foreach ($dtotal as $value) {
			$total++;
		}

		$config['base_url'] = base_url("index.php/c_rl_sales_list/hasilcari");
		$config['total_rows'] = $total;
		$config['per_page'] = 10; 

		$this->pagination->initialize($config); 

		$paging = $this->pagination->create_links();

		$AllData = $this->m_rl_sales_list->DataPaging($offset, $perpage);

		if($_POST){
			$paging = null;
			$cari = $this->input->post('search',TRUE);
			$data = $this->m_rl_sales_list->cari($cari);
			$ListAllData = '';
			$i = 1;
			if(!empty($data)){
				foreach ($data as $value) {
					$ListAllData .='<tr>';
					$ListAllData .='<th>'.$i.'</th>';
					$ListAllData .='<th>'.$value->business_id.'</th>';
					$ListAllData .='<th>'.$value->NAME.'</th>';
					$ListAllData .='<th>'.$value->lot_no.'</th>';
					$ListAllData .='<th>'.$value->descs.'</th>';
					$ListAllData .='<th>'.$value->sales_date.'</th>';
					$ListAllData .='<th class="text-right">'.number_format($value->sell_price,2).'</th>';
					$ListAllData .='<th><a href = "'.base_url('index.php/c_pm_bill_sch/index/'.$value->lot_no).'"><input type = "button" name="billing" value="Billing"></a></th>';
					$ListAllData .='</tr>';
					$i++;
				}
				// date_format($date,"Y/m/d H:i:s");
				$content = array(
					'RlSalesList' => $ListAllData,
					'paging' => $paging);
				
				// $this->load->view('v_currency',$content);

				$this->load->view('template/v_header');
				$this->load->view('template/v_menu');
				$this->load->view('v_rl_sales_list', $content);
				$this->load->view('template/v_footer');
			}else{
				$this->index();
			}
			
		}

	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */