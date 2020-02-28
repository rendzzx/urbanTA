<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class C_trial_balance extends Core_Controller
{
	
	public function __construct()
	{
		parent::__construct();
        $this->auth_check();
        // $this->load->model('m_rl_sales_list');
        $this->load->model('m_wsbangun');
        $this->load->model('m_sms');
        $this->load->model('m_business');
	}
	public function index(){
		$entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        $name = $this->session->userdata('Tsuname');
        $projectName = $this->session->userdata('Tsprojectname');
        // var_dump($entity);
        // if($entity == ''){
        //     $entity = '2101';
        //     $project = '210101';
	       // }

        // $table = 'SELECT DISTINCT entity_cd, entity_name FROM mgr.cf_entity (nolock)';
        // $proDescs = $this->m_wsbangun->getData_by_query($table);
        $userid = $this->session->userdata("Tsname");
        $sql = "SELECT distinct entity_cd,entity_name from mgr.v_cfs_user_project(nolock) where userid='$userid'";
        $proDescs = $this->m_wsbangun->getData_by_query($sql);
        // var_dump($entityName);
            if(!empty($proDescs)) {
                $comboEntity[] = '<option></option>';
                foreach ($proDescs as $dtEntity) {
                  if($entity === $dtEntity->entity_cd) {
                    $pilih = ' selected = "1"';
                  } else {
                    $pilih = '';
                  }
                    $comboEntity[] = '<option '.$pilih.' value="'.$dtEntity->entity_cd.'">'.$dtEntity->entity_name.'</option>';
                }
                $comboEntity = implode("", $comboEntity);
            }

        $maxPeriod = "SELECT TOP 1 period FROM mgr.v_period where entity_cd = '$entity' ORDER BY fyear DESC, aperiod DESC";
        $dataMaxPedriod = $this->m_wsbangun->getData_by_query($maxPeriod);
        // var_dump($dataMaxPedriod);

        $period = "SELECT DISTINCT period = CASE WHEN LEN(aperiod) = 1 THEN '0' ELSE '' END + CONVERT(VARCHAR, aperiod) + '/' + CONVERT(VARCHAR, fyear), fyear, aperiod ";
        $period.= " FROM   mgr.gl_acct_bal (NOLOCK) ";
        $period.= " WHERE  (fyear * 100) + aperiod <= (DATEPART(YEAR, GETDATE())) * 100 + DATEPART(MONTH, GETDATE()) ";
        $period.= " ORDER BY fyear DESC, aperiod DESC ";
        $dataPeriod = $this->m_wsbangun->getData_by_query($period);
        if(!empty($dataPeriod)) {
                $comboPeriod[] = '<option></option>';
                foreach ($dataPeriod as $dtPeriod) {
                  if($dataMaxPedriod[0]->period === $dtPeriod->period) {
                    $pilih = ' selected = "1"';
                  } else {
                    $pilih = '';
                  }
                    $comboPeriod[] = '<option '.$pilih.' value="'.$dtPeriod->period.'">'.$dtPeriod->period.'</option>';
                }
                $comboPeriod = implode("", $comboPeriod);
            } 

    $ContentAllData = array('project_no'=>$project,
        'ProjectDescs'=>$projectName,
        'cbEntity'=>$comboEntity,
        'cbPeriod'=>$comboPeriod);
    $group = $this->session->userdata('Tsusergroup');
    if ($group=='MGM'){
            $this->load_content_mgm('trial_balance/indexdetail',$ContentAllData);
        }else{
            $this->load_content_top_menu('trial_balance/indexdetail',$ContentAllData);
        }
    }

    public function zoom_period(){
        
        // var_dump($dataMaxPedriod);

        // $period = "SELECT DISTINCT period = CASE WHEN LEN(aperiod) = 1 THEN '0' ELSE '' END + CONVERT(VARCHAR, aperiod) + '/' + CONVERT(VARCHAR, fyear), fyear, aperiod ";
        // $period.= " FROM   mgr.gl_acct_bal (NOLOCK) ";
        // $period.= " WHERE  (fyear * 100) + aperiod <= (DATEPART(YEAR, GETDATE())) * 100 + DATEPART(MONTH, GETDATE()) ";
        // $period.= " ORDER BY fyear DESC, aperiod DESC ";
        // $dataPeriod = $this->m_wsbangun->getData_by_query($period);
        // if(!empty($dataPeriod)) {
        //         $comboPeriod[] = '<option></option>';
        //         foreach ($dataPeriod as $dtPeriod) {
        //           if($dataMaxPedriod[0]->period === $dtPeriod->period) {
        //             $pilih = ' selected = "1"';
        //           } else {
        //             $pilih = '';
        //           }
        //             $comboPeriod[] = '<option '.$pilih.' value="'.$dtPeriod->period.'">'.$dtPeriod->period.'</option>';
        //         }
        //         $comboPeriod = implode("", $comboPeriod);
        //     }

        
        if($_POST)
        {
            $entity = $this->input->post('ent', TRUE);

            $maxPeriod = "SELECT TOP 1 period FROM mgr.v_period where entity_cd = '$entity' ORDER BY fyear DESC, aperiod DESC";
            $dataMaxPedriod = $this->m_wsbangun->getData_by_query($maxPeriod);
            
            if(empty($entity)) {
                echo('<option></option>');
            } else {
                $period = "SELECT DISTINCT period = CASE WHEN LEN(aperiod) = 1 THEN '0' ELSE '' END + CONVERT(VARCHAR, aperiod) + '/' + CONVERT(VARCHAR, fyear), fyear, aperiod ";
                $period.= " FROM   mgr.gl_acct_bal (NOLOCK) ";
                $period.= " WHERE  (fyear * 100) + aperiod <= (DATEPART(YEAR, GETDATE())) * 100 + DATEPART(MONTH, GETDATE()) ";
                $period.= " ORDER BY fyear DESC, aperiod DESC ";
                $dataPeriod = $this->m_wsbangun->getData_by_query($period);

                if(!empty($dataPeriod)) {
                    $comboPeriod[] = '<option></option>';
                    foreach ($dataPeriod as $dtPeriod) {
                      if($dataMaxPedriod[0]->period === $dtPeriod->period) {
                        $pilih = ' selected = "1"';
                      } else {
                        $pilih = '';
                      }
                        $comboPeriod[] = '<option '.$pilih.' value="'.$dtPeriod->period.'">'.$dtPeriod->period.'</option>';
                    }
                    $comboPeriod = implode("", $comboPeriod);
                }
                echo($comboPeriod);
            }
        }
    }


    public function getTable(){


        $userid = $this->session->userdata("Tsuname");
        $userid2 = $this->session->userdata("Tsname");
        // var_dump($userid2);exit();

        $ent = $this->input->post("entity",true);
        $period= $this->input->post("period",true);
        // $lotno=$this->input->post("unit",true);
        // if(empty($lotno)){
        //     $lotno='all';
        // }

        $sSearch=$this->input->post("sSearch",true);
        if(empty($sSearch)){
            $sSearch='';
        }
        if(empty($ent)||$ent==''){
            $project = $this->session->userdata('Tsproject');
            $entity = $this->session->userdata('Tsentity');
        } else {
            $project = $ent;//onchange
            $sql = "SELECT entity_cd = max(entity_cd) from mgr.cfs_user_entity(nolock) where entity_cd='$ent' and userid='$userid2'";
            $datas = $this->m_wsbangun->getData_by_query($sql);
            $entity = $datas[0]->entity_cd;
            // var_dump($entity);
        }
        // var_dump($entity);
        $project = $this->session->userdata('Tsproject');
        $name = $this->session->userdata('Tsuname');

        $DB2 = $this->load->database('ifca', TRUE);

        $aField = array('id','subject','content','status');
        $aColumns = array('row_number','aperiod','acct_type','acct_cd','descs','aperiod');

        $sTable = "mgr.v_trial_balance";

        $iDisplayStart = (int)$this->input->get_post('start', true);
        $iDisplayLength = (int)$this->input->get_post('length', true);

        $order = $this->input->get_post('order', true);

        $draw = (int)$this->input->get_post('draw', true);
        $Column = $this->input->get_post('columns', true);

        $Search = $sSearch;
        // $addsort = 'product_cd,property_cd,lead_cd,group_cd ';
        $addsort = '';
        $SortdOrder =$order[0]['dir'];
        // $SortdOrder =" acct_cd ";
        $sortIdColumn = (int)$order[0]['column'];

        $SordField = ($sortIdColumn==0? $Column[1]['name'] :$Column[$sortIdColumn]['name']);

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


        $where=' ';
        if($period!='all')
        {
            
            $where="AND period='".$period."' ".$where;
        }
             
    
        $param =" Where entity_cd='".$entity."' ".$where." ".$filter_search;
        $rResult = $this->m_wsbangun->getlisttablenup($sTable,(int)($iDisplayStart),(int)($iDisplayLength),$SordField,$SortdOrder,$param);

        $output = array(
            'draw' => intval($draw),
            
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
?>