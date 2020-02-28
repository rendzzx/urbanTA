<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class testing2 extends Core_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->auth_check();
        // $this->load->model('m_newsfeed');
        $this->load->model('m_wsbangun');
        $this->load->library('ciqrcode');
        $this->load->library('zend');
        $this->zend->load('Zend/Barcode');

    }

    public function index()
    {

        $this->load_content_top_menu('testing2/index');
    }


    // -------- meterreading --------
    public function gettablemeterreading()
    {
        $project = $this->session->userdata('Tsproject');
        $cons = $this->session->userdata('Tscons');
        $sSearch = $this->input->post("sSearch",true);
        if(empty($sSearch)){
            $sSearch='';
        }

        $entity = $this->session->userdata('Tsentity');
        $this->load->library('Datatables');
        $DB2 = $this->load->database('ifca3', TRUE);
        $aColumns  = array('level_no');
        $sTable = 'mgr.pm_meter_hdr';
        $order = (int)$this->input->get_post('order', true);

        $Search = $sSearch;
        $sortIdColumn = (int)$order[0]['column'];

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
        $param = " where rowID > 0 ".$filter_search;
        
        $rResult = $this->m_wsbangun->get_all_reading();
        
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

    public function getdetailreading($id, $id2)
    {
        $cons   = $this->session->userdata('Tscons');
        $table  = 'pm_meter_dtl';

        $where=array(
            'level_no'=>$id,
            'meter_type'=> $id2);

        $data = $this->m_wsbangun->getData_by_criteria_cons($cons,$table,$where);

        echo json_encode($data);
    }

    public function getByIDmeterreading($id)
    {
        $cons   = $this->session->userdata('Tscons');
        $entity     = $this->session->userdata('Tsentity');
        $project     = $this->session->userdata('Tsproject');

        $table  = 'pm_level';

        $where=array(
            'entity_cd' => $entity,
            'project_no' => $project,
            'level_no' => $id
        );
        
        $data = $this->m_wsbangun->getData_by_criteria_cons($cons,$table,$where);

        echo json_encode($data);
    }

    public function getByIDmeterreading_metertype($id)
    {
        $cons   = $this->session->userdata('Tscons');
        $entity     = $this->session->userdata('Tsentity');
        $project     = $this->session->userdata('Tsproject');

        $table  = 'pm_meter';

        $where=array(
            'entity_cd' => $entity,
            'project_no' => $project,
            // 'level_no' => $id
        );
        
        $data = $this->m_wsbangun->getData_by_criteria_cons($cons,$table,$where);

        echo json_encode($data);
    }

    public function addmeterreading()
    {
        $cons   = $this->session->userdata('Tscons');
        $entity     = $this->session->userdata('Tsentity');
        $project     = $this->session->userdata('Tsproject');

        $table  = 'pm_level';
        $table2  = 'pm_meter';

        $where=array(
            'entity_cd' => $entity,
            'project_no' => $project
        );

        $where2=array(
            'entity_cd' => $entity
        );        

        $level = $this->m_wsbangun->getData_by_criteria_cons($cons,$table,$where);
        $meter = $this->m_wsbangun->getData_by_criteria_cons($cons,$table2,$where2);

        $content = array(
            'level_no' => $level,
            'meter_type' => $meter
        );

        $this->load->view('testing2/addmeterreading',$content);
    }

    public function save_meterreading()
    {
        $callback = array(
            'Data'   => null,
            'Error'  => false,
            'Pesan'  => '',
            'Status' => 200
        );

        $entity     = $this->session->userdata('Tsentity');
        $project    = $this->session->userdata('Tsproject');
        // $project    = '1502';
        $cons       = $this->session->userdata('Tscons');

        $level_no       = $this->input->post('level_no',TRUE);
        $descs          = $this->input->post('level_descs',TRUE);
        $meter_type     = $this->input->post('meter_type',TRUE);
        $doc_date       = date("d M Y H:i:s",strtotime($this->input->post('doc_date')));
        $read_date      = date("d M Y H:i:s",strtotime($this->input->post('doc_date')));
        $audit_date     = date('d M Y H:i:s');
        $audit_user     = $this->session->userdata('Tsuname');

        $table = 'pm_meter_hdr';
        $table2 = 'pm_meter';
        $table3 = 'pm_lot_meter';
        $table4 = 'pm_meter_category';
        $table5 =  'pm_meter_dtl';

        $criteria = array('entity_cd' => $entity);

        if($_POST)
        {
            $checked = $this->input->post('generatemeter');
            if(isset($checked) == 1)
            {
                $data=array(
                    'level_no'      => $level_no,
                    'descs'         => $descs,
                    'meter_type'    => $meter_type,
                    'doc_date'      => $audit_date, //ganti dengan inputan
                    'read_date'     => $audit_date, //ganti dengan inputan
                    'trx_date'      => $audit_date, //ganti dengan inputan
                    'due_date'      => $audit_date, //ganti dengan inputan
                    'status'        => 'N',
                    'currency_cd'   => 'IDR',
                    'currency_rate' => '1.0000',
                    'audit_user'    => $audit_user,
                    'audit_date'    => $audit_date,
                    'entity_cd'     => $entity,
                    'project_no'    => $project
                );
                $insert = $this->m_wsbangun->insertData_cons($cons,$table,$data);
                if($insert == 'OK'){
                    $where2 = array(
                        'meter_type' => $meter_type
                    );
                    $select_pmmeter = $this->m_wsbangun->getData_by_criteria_cons($cons, $table2, $where2);
                    $where3 = array (
                        'meter_cd' => $select_pmmeter[0]->meter_cd
                    );
                    $where4 = array(
                        'entity_cd'     => $entity,
                        'project_no'    => $select_pmmeter[0]->project_no,
                        'category_cd'   => $select_pmmeter[0]->category_cd
                    );
                    $select_pmlotmeter = $this->m_wsbangun->getData_by_criteria_cons($cons, $table3, $where3);
                    $select_pmmetercategory = $this->m_wsbangun->getData_by_criteria_cons($cons, $table4, $where4);
                    // var_dump($select_pmmetercategory);exit();
                    foreach ($select_pmlotmeter as $key){
                        $data2=array(
                            'entity_cd'         => $entity,
                            'project_no'        => $project,
                            'meter_cd'          => $key->meter_cd,
                            'meter_id'          => $key->meter_id,
                            'debtor_acct'       => $key->debtor_acct,
                            'lot_no'            => $key->lot_no,
                            'trx_type'          => $select_pmmeter[0]->trx_type,
                            'doc_no'            => ' ',
                            'read_date'         => $read_date,
                            'doc_date'          => $doc_date,
                            'currency_cd'       => 'IDR',
                            'currency_rate'     => '1.00000',
                            'category_cd'       => $select_pmmeter[0]->category_cd,
                            'tax_cd'            => $select_pmmeter[0]->tax_cd,
                            'last_read'         => $key->curr_read,
                            'curr_read'         => '0.000',
                            'last_read_high'    => $key->curr_read_high,
                            'curr_read_high'    => '0.000',
                            'usage'             => '0.000',
                            'usage_high'        => '0.000',
                            'multiplier'        => $select_pmmeter[0]->multiplier,
                            'calculation_method'=> $select_pmmetercategory[0]->calculation_method,
                            'capacity_given_flag'=> $select_pmmetercategory[0]->capacity_given_flag,
                            'limit_usage_flag'  => $select_pmmetercategory[0]->limit_usage_flag,
                            'capacity'          => $key->capacity,
                            'capacity_limit'    => $key->capacity_limit,
                            'capacity_rate'     => $select_pmmetercategory[0]->capacity_rate,
                            'usage_11'           => '0.00',
                            'usage_21'           => '0.00',
                            'usage_31'           => '0.00',
                            'usage_12'           => '0.00',
                            'usage_22'           => '0.00',
                            'usage_32'           => '0.00',
                            'usage_range1'      => '0.00',
                            'usage_range2'      => '0.00',
                            'usage_range3'      => '0.00',
                            'usage_rate1'       => '0.00',
                            'usage_rate2'       => '0.00',
                            'usage_rate3'       => '0.00',
                            'gen_rate'          => '0.00',
                            'dem_rate'          => '0.00',
                            'base_amt1'         => '0.00',
                            'gen_amt1'          => '0.00',
                            'dem_amt1'          => '0.00',
                            'stamp_amt1'        => '0.00',
                            'base_amt2'         => '0.00',
                            'gen_amt2'          => '0.00',
                            'dem_amt2'          => '0.00',
                            'stamp_amt2'        => '0.00',
                            'trx_amt'           => '0.00',
                            'tax_amt'           => '0.00',
                            'status'            => 'N',
                            'audit_user'        => $audit_user,
                            'audit_date'        => $audit_date,
                            'opr_rate1'         => '0.00000',
                            'opr_rate2'         => '0.00000',
                            'disc_rate1'        => '0.00000',
                            'disc_rate2'        => '0.00000',
                            'level_no'          => $level_no,
                            'meter_type'        => $meter_type,
                            'opr_tax_amt1'      => '0',
                            'opr_tax_amt2'      => '0',
                            'usage_high_rate1'  => '0.00',
                            'usage_high_rate2'  => '0.00',
                            'usage_high_rate3'  => '0.00'
                        );
                        $insert2 = $this->m_wsbangun->insertData_cons($cons,$table5,$data2);
                        if($insert2 == 'OK'){
                            $callback['Pesan'] = 'Data has been insert successfully';
                        } else {
                            $callback['Error'] = true;
                            $callback['Pesan'] = $insert2;
                        }
                    }
                } else {
                    $callback['Error'] = true;
                    $callback['Pesan'] = $insert; 
                }
            } 
            else 
            { // not checked
                $data=array(
                    'level_no'      => $level_no,
                    'descs'         => $descs,
                    'meter_type'    => $meter_type,
                    'doc_date'      => $audit_date, //ganti dengan inputan
                    'read_date'     => $audit_date, //ganti dengan inputan
                    'trx_date'      => $audit_date, //ganti dengan inputan
                    'due_date'      => $audit_date, //ganti dengan inputan
                    'status'        => 'N',
                    'currency_cd'   => 'IDR',
                    'currency_rate' => '1.0000',
                    'audit_user'    => $audit_user,
                    'audit_date'    => $audit_date,
                    'entity_cd'     => $entity,
                    'project_no'    => $project
                );
                $insert = $this->m_wsbangun->insertData_cons($cons,$table,$data);
                if($insert == 'OK')
                {
                    $callback['Pesan'] = "Data has been insert successfully";
                } else {
                    $callback['Error'] = true;
                    $callback['Pesan'] = $insert;
                }
            }
        }
        else
        {
            $callback['Error'] = true;
            $callback['Pesan'] = 'Data validation is not valid';
        }

        echo json_encode($callback);

    }

    // -------- DELETE --------
}