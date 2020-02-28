<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class C_overtime_history extends Core_Controller
{
	public function __construct()
    {
        parent::__construct();
        $this->auth_check();
        $this->load->model('m_wsbangun');

    }
    public function index(){
        $entity = $this->session->userdata('Tsentity');
        $projectName = $this->session->userdata('Tsprojectname');
        $project = $this->session->userdata('Tsproject');
        $email = $this->session->userdata('Tsemail');
        $business_id = $this->session->userdata('Tsbusinessid');

        $group = $this->session->userdata('Tsusergroup');
        $where ='';
        if($group!='ADMINWEB')
        {
            // var_dump('b');
            $where="AND business_id='".$business_id."' ";
        }    
        $sqlLot = "select distinct lot_no from mgr.v_ot_trx where entity_cd ='$entity' and project_no ='$project' ".$where;
        $dtLotOT = $this->m_wsbangun->getData_by_query_cons('ifca3',$sqlLot);  

        $month = date("m");
        $year = date("Y");

        $param="";
        
 
        $content = array(//'debtor_acct'=>$name,
            // 'project_no'=>$project,
            // 'project'=>$DataMenu,
            // 'datacategory'=>$this->zoom_category(),
            'datalot'=>$dtLotOT,
            'ProjectDescs'=>$projectName);
        
        $this->load_content_top_menu('customer_ticket/index_ot',$content);
    } 


    public function zoom_category()
    {
        $entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        $name = $this->session->userdata('Tsname');
        $cons = $this->session->userdata('Tscons');
         

        $proDescs = $this->m_wsbangun->getData_cons($cons,'sv_category(nolock)');
        $comboProject[] = '<option></option>';
     
            if(!empty($proDescs)) {
                
                foreach ($proDescs as $dtProject) {
                  
                    $comboProject[] = '<option  value="'.$dtProject->category_cd.'">'.$dtProject->descs.'</option>';
                }
                $comboProject = implode("", $comboProject);
            }
            return $comboProject;
    }
    
    public function getTable()
    {
        
        $project = $this->session->userdata('Tsproject');  
        $entity = $this->session->userdata('Tsentity');
        $group = $this->session->userdata('Tsusergroup');
        // $category = $this->input->post('category', true); 
        // if(empty($category)){
        //     $category='';
        // }  
        $lotno = $this->input->post("lot_no",true);
        if(empty($lotno)){
            $lotno='';
        }
        $cons = $this->session->userdata('Tscons');
        $sSearch = $this->input->post("sSearch",true);
        if(empty($sSearch)){
            $sSearch='';
        }
        $date_end = $this->input->post("date_end",true);
        if(empty($date_end)){
            $date_end=date('Y-m-d');
            
        }

        $date_start = $this->input->post("date_start",true);
        if(empty($date_start)){
            $date_start=date('Y-m-01', strtotime("-6 months"));
            
        }
        $entity = $this->session->userdata('Tsentity');
        $this->load->library('Datatables');
        $DB2 = $this->load->database('ifca3', TRUE);

        //untuk PK diharap diletakan di awal array
        // $aField = array('nup_id','entity_name', 'project_descs', 'start_date', 'end_date', 'phase_descs');
        $aColumns  = array('row_number','entity_cd', 'project_no');
        // $aColumns = array('entity_cd', 'entity_name');
        $sTable = "mgr.fn_v_ot_trx('".$date_start."','".$date_end."')";
        
        $iDisplayStart = (int)$this->input->get_post('start', true);
        $iDisplayLength = (int)$this->input->get_post('length', true);
        $order = (int)$this->input->get_post('order', true);
        $draw = (int)$this->input->get_post('draw', true);
        $Column = $this->input->get_post('columns', true);
        // $iSortCol_0 = $this->input->get_post('iSortCol_0', true);
        // $iSortingCols = $this->input->get_post('iSortingCols', true);
        // $sSearch = $this->input->get_post('search', true);
        // $sEcho = $this->input->get_post('sEcho', true);
    
        $Search = $sSearch;
        $addsort = 'ot_id';
        $SortdOrder = $order[0]['dir'];
        $sortIdColumn = (int)$order[0]['column'];
        // var_dump($Column[$sordIdColumn]['name']);
        $SordField = ($sortIdColumn==0? 'ot_id' :$Column[$sortIdColumn]['name']);

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
       
        $where = '';
      
        // var_dump($debtor_acct);exit();
        if($group!='ADMINWEB')
        {
            // var_dump('b');
            $where="AND business_id='".$business_id."' ".$where;
        }
        if($lotno!='' || !empty($lotno))
        {
            // var_dump('b');
            $where="AND lot_no='".$lotno."' ".$where;
        }
        // if($category!='' || !empty($category))
        // {
        //     // var_dump('b');
        //     $where="AND category_cd='".$category."' ".$where;
        // }
        
        // var_dump($filter_search);
        // $param = $filter_search;
        // // var_dump($param);
        // $rResult = $this->m_wsbangun->getlisttable($sTable,(int)($iDisplayStart),(int)($iDisplayLength),$SordField,$SortdOrder,$param);    
        $param =" Where entity_cd='".$entity."' AND project_no= '".$project."'  ".$where." ".$filter_search;
        $rResult = $this->m_wsbangun->getlisttablesoa_cons('ifca3',$sTable,(int)($iDisplayStart),(int)($iDisplayLength),$SordField,$SortdOrder,$param,$addsort);    

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
   

   
}