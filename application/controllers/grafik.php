<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Grafik extends Core_Controller 
{
	
	public function __construct(){ 
		parent::__construct();
		$this->auth_check();
		// $this->load->model('m_rl_sales_list');
		$this->load->model('m_wsbangun');
		$this->load->model('m_sms');
		$this->load->model('m_business');
	}

    public function getG1()
    {
        $sql = "SELECT product_cd,count(1) AS unit FROM mgr.v_reserve_nup(nolock) WHERE status_nup='A' GROUP BY product_cd";
        $dt1 = $this->m_wsbangun->getData_by_query($sql);
        $data = array();
        foreach ($dt1 as $rows) {
            $data[] = $rows;
        }
        // $g1 = empty($dt1) ? '' : json_encode($dt1);
        echo json_encode($data);
    }
	
	public function index()
    {
        // $where=array('1'=>'1');
        $userid = $this->session->userdata('Tsname');
        
    	$entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        $cons = $this->session->userdata('Tscons');
        $group = $this->session->userdata('Tsusergroup');
        $name = $this->session->userdata('Tsuname');
		$project_descs = $this->session->userdata('Tsprojectname');

        $sql = "SELECT distinct entity_cd,project_no,project_descs,db_profile from mgr.v_cfs_login_user with (nolock) where userid='$userid'";
        $proDescs = $this->m_wsbangun->getData_by_query_cons('ifca3',$sql);
        
            if(!empty($proDescs)) {
                $comboProject[] = '<option></option>';
                foreach ($proDescs as $dtProject) {
                  if($project === $dtProject->project_no) {
                    $pilih = ' selected = "1"';
                    $entity = $dtProject->entity_cd;
                    $project = $dtProject->project_no;
                    $project_descs = $dtProject->project_descs;
                    $cons = $dtProject->db_profile;
                  } else {
                    $pilih = '';
                  }
                    $comboProject[] = '<option '.$pilih.' value="'.$dtProject->project_no.'" data-cons="'.$dtProject->db_profile.'" >'.$dtProject->project_descs.'</option>';
                }
                $comboProject = implode("", $comboProject);
            }
      
        $ContentAllData = array(
             
            'nama_project'=>$project_descs,
            'project_no'=>$project,
            'comboProject'=>$comboProject   
               
        );
          
        $this->load_content_top_menu('grafik/index2',$ContentAllData);
      
    }

    function goto_table(){
            
            $project_no = $this->input->post('project_no',TRUE);
          
            $data = array('Listdata'=>$this->ListAll($project_no),
                           'Listdata2'=> $this->ListAll2($project_no),
                           'nama_project'=>$this->get_nama($project_no));

            $this->load->view('grafik/indexdata',$data);
            // var_dump($data);
        }


        public function get_nama($project_no=''){
                $ProjectDescs = '';
                if(!empty($project_no)){
                    $where=array('project_no'=>$project_no);
                    $data = $this->m_wsbangun->getData_by_criteria_cons('ifca3',"pl_project (nolock)",$where);
                    $ProjectDescs = $data[0]->descs;
                } else {
                    $ProjectDescs='';
                }
                return $ProjectDescs;
            }


            
        public function ListAll($project_no='')
        {
            $sql = "SELECT entity_cd = max(entity_cd),cons = max(db_profile) from mgr.pl_project where project_no='".$project_no."'";
            $data = $this->m_wsbangun->getData_by_query_cons('ifca3',$sql);
            $entity = $data[0]->entity_cd;
            $cons = $data[0]->cons;

            
            $sql2 = "SELECT * from mgr.v_nup_summary_apt where project_no='".$project_no."' and entity_cd='".$entity."' ORDER BY nupDate ASC";
            
            $Dam = $this->m_wsbangun->getData_by_query_cons($cons,$sql2);
            $sumary = $this->m_wsbangun->getData_by_query_cons($cons,$sql2);

            if(!empty($sumary))
            {
                    foreach ($sumary as $key) {
                        $nup_distinc[]=$key->nup_date;
                    }

                    $nup_date = array_unique($nup_distinc);
                    // var_dump("expression");
                    // var_dump($nup_date);
                    // var_dump($Dam);
                foreach ($nup_date as $key) 
                {
                    $bb = $key;
                    // var_dump($sumary);
                    $Dataparam = array_filter($sumary,function($a) use($bb){
                        return $a->nup_date === $bb;
                    });
                    // var_dump($Dataparam);
                    if(!empty($Dataparam))
                    {

                        $stat = array('A','U','C');
                        // $nup_date = $this->m_wsbangun->getData_by_query($sql);

                        $i=1;
                        foreach ($nup_date as $k =>$row) {

                        
                            $sam[$k]['nup_date'] = $row;


                            foreach ($sumary as $key => $value) {
                                // if($row->nup_date == $value->nup_date)
                                if($row == $value->nup_date)
                                {
                                    // var_dump("expression");
                                    if(trim($value->nup_type)=='GA') {
                                    // var_dump("GA");
                                        foreach ($stat as $i => $j) {
                                            if($j==$value->status_nup){
                                                $sam[$k]['G'.$value->status_nup] = $value->unit;
                                            }
                                        }
                                    } else {
                                        foreach ($stat as $i => $j) {
                                            if($j==$value->status_nup){
                                                $sam[$k]['P'.$value->status_nup] = $value->unit;
                                            }
                                        }
                                    }
                                    if(empty($sam[$k]['GA'])) {
                                        $sam[$k]['GA'] = 0;
                                    }
                                    if(empty($sam[$k]['GU'])) {
                                        $sam[$k]['GU'] = 0;
                                    }
                                    if(empty($sam[$k]['GC'])) {
                                        $sam[$k]['GC'] = 0;
                                    }
                                    if(empty($sam[$k]['PA'])) {
                                        $sam[$k]['PA'] = 0;
                                    }
                                    if(empty($sam[$k]['PU'])) {
                                        $sam[$k]['PU'] = 0;
                                    }
                                    if(empty($sam[$k]['PC'])) {
                                        $sam[$k]['PC'] = 0;
                                    }
                                }
                            }
                            // var_dump($sam);
                        }
                    }


                    $tGA = 0; $tGC = 0; $tGU = 0; $tPA = 0; $tPU = 0; $tPC = 0; $tgt = 0; $tpt = 0; $ttt = 0;
                    $ListAllData = '';

                    $ListAllData.='<thead align="center" class="colheader">';
                    $ListAllData.='<tr align="center">';
                    $ListAllData.='<td rowspan="2">NUP Date</td>';
                    $ListAllData.='<td colspan="4">Golden</td>';
                    $ListAllData.='<td colspan="4">Platinum</td>';
                    $ListAllData.='<td rowspan="2">Total All</td>';
                    $ListAllData.='</tr>';

                    $ListAllData.='<tr>';
                    $ListAllData.='<td>Approved</td>';
                    $ListAllData.='<td>UnApproved</td>';
                    $ListAllData.='<td>Cancel</td>';
                    $ListAllData.='<td>Total</td>';

                    $ListAllData.='<td>Approved</td>';
                    $ListAllData.='<td>UnApproved</td>';
                    $ListAllData.='<td>Cancel</td>';
                    $ListAllData.='<td>Total</td>';
                    $ListAllData.='</tr>';
                    $ListAllData.='</thead>';
                        // var_dump($sam);
                    foreach ($sam as $key => $value) 
                    {
                        // var_dump($value['nup_date']);
                        $gt = $value['GA']+$value['GU']+$value['GC'];
                        $pt = $value['PA']+$value['PU']+$value['PC'];
                        $tt = $gt + $pt;
                        $tGA += $value['GA'];
                        $tGU += $value['GU'];
                        $tGC += $value['GC'];
                        $tPA += $value['PA'];
                        $tPU += $value['PU'];
                        $tPC += $value['PC'];
                        $tgt += $gt;
                        $tpt += $pt;
                        $ttt += $tt;
                        $ListAllData.='<tr><td>'.$value['nup_date'].'</td>';
                        $ListAllData.='<td>'.$value['GA'].'</td>';
                        $ListAllData.='<td>'.$value['GU'].'</td>';
                        $ListAllData.='<td>'.$value['GC'].'</td>';
                        $ListAllData.='<td>'.$gt.'</td>';
                        $ListAllData.='<td>'.$value['PA'].'</td>';
                        $ListAllData.='<td>'.$value['PU'].'</td>';
                        $ListAllData.='<td>'.$value['PC'].'</td>';
                        $ListAllData.='<td>'.$pt.'</td>';
                        $ListAllData.='<td>'.$tt.'</td></tr>';
                    }
                    $ListAllData.="<tr><td><b>Total</b></td><td><b>$tGA</b></td><td><b>$tGU</b></td><td><b>$tGC</b></td><td><b>$tgt</b></td><td><b>$tPA</b></td><td><b>$tPU</b></td><td><b>$tPC</b></td><td><b>$tpt</b></td><td><b>$ttt</b></td></tr>";

                }

            }else{
                $ListAllData='';
            }
        
            return $ListAllData;
        }

        public function ListAll2($project_no='')
        {

            $sql = "SELECT entity_cd = max(entity_cd),cons = max(db_profile) from mgr.pl_project where project_no='".$project_no."'";
            $data = $this->m_wsbangun->getData_by_query_cons('ifca3',$sql);
            $entity = $data[0]->entity_cd;
            $cons = $data[0]->cons;


            $sql2 = "SELECT * from mgr.v_nup_summary_lnd where project_no='".$project_no."' and entity_cd='".$entity."' ORDER BY nupDate ASC";
            
            $Dam2 = $this->m_wsbangun->getData_by_query_cons($cons,$sql2);
            $sumary2 = $this->m_wsbangun->getData_by_query_cons($cons,$sql2);

            if(!empty($sumary2))
            {
                    foreach ($sumary2 as $key) {
                        $nup_distinc[]=$key->nup_date;
                    }

                    $nup_date = array_unique($nup_distinc);

                foreach ($nup_date as $key) 
                {
                    $bb = $key;

                    $Dataparam2 = array_filter($sumary2,function($a) use($bb){
                        return $a->nup_date === $bb;
                    });

                // exit();

                        if(!empty($Dataparam2))
                        {

                           
                            $stat2 = array('A','U','C');

                            $i=1; 
                            foreach ($nup_date as $k2 =>$row) {
                        // $ListAllData .='<tr>';
                                $sam2[$k2]['nup_date'] = $row;

                                foreach ($sumary2 as $key => $value) {
                                    if($row == $value->nup_date)
                                    {
                                        if(trim($value->nup_type)=='GL') {
                                    // var_dump("GA");
                                            foreach ($stat2 as $i => $j) {
                                                if($j==$value->status_nup){
                                                    $sam2[$k2]['G'.$value->status_nup] = $value->unit;
                                                }
                                            }
                                        } else {
                                            foreach ($stat2 as $i => $j) {
                                                if($j==$value->status_nup){
                                                    $sam2[$k2]['P'.$value->status_nup] = $value->unit;
                                                }
                                            }
                                        }
                                        if(empty($sam2[$k2]['GA'])) {
                                            $sam2[$k2]['GA'] = 0;
                                        }
                                        if(empty($sam2[$k2]['GU'])) {
                                            $sam2[$k2]['GU'] = 0;
                                        }
                                        if(empty($sam2[$k2]['GC'])) {
                                            $sam2[$k2]['GC'] = 0;
                                        }
                                        if(empty($sam2[$k2]['PA'])) {
                                            $sam2[$k2]['PA'] = 0;
                                        }
                                        if(empty($sam2[$k2]['PU'])) {
                                            $sam2[$k2]['PU'] = 0;
                                        }
                                        if(empty($sam2[$k2]['PC'])) {
                                            $sam2[$k2]['PC'] = 0;
                                        }
                                    }
                                }
                            }
                        }


                        $tGA2 = 0; $tGC2 = 0; $tGU2 = 0; $tPA2 = 0; $tPU2 = 0; $tPC2 = 0; $tgt2 = 0; $tpt2 = 0; $ttt2 = 0;
                        $ListAllData2 = '';
                // var_dump($sam2);
                           

                        // $ListAllData2.='Product Code : LND - LANDED HOUSE<br>';
                        // $ListAllData2.='Product Type : 01 - Phase 1';
                        $ListAllData2.='<thead align="center" class="colheader">';
                        $ListAllData2.='<tr align="center" >';
                        $ListAllData2.='<td rowspan="2">NUP Date</td>';
                        $ListAllData2.='<td colspan="4">Golden</td>';
                        $ListAllData2.='<td colspan="4">Platinum</td>';
                        $ListAllData2.='<td rowspan="2">Total All</td>';
                        $ListAllData2.='</tr>';

                        $ListAllData2.='<tr>';
                        $ListAllData2.='<td>Approved</td>';
                        $ListAllData2.='<td>UnApproved</td>';
                        $ListAllData2.='<td>Cancel</td>';
                        $ListAllData2.='<td>Total</td>';

                        $ListAllData2.='<td>Approved</td>';
                        $ListAllData2.='<td>UnApproved</td>';
                        $ListAllData2.='<td>Cancel</td>';
                        $ListAllData2.='<td>Total</td>';
                        $ListAllData2.='</tr>';
                        $ListAllData2.='</thead>';


                        foreach ($sam2 as $key => $value) {
                    // var_dump($value['nup_date']);
                            $gt2 = $value['GA']+$value['GU']+$value['GC'];
                            $pt2 = $value['PA']+$value['PU']+$value['PC'];
                            $tt2 = $gt2 + $pt2;
                            $tGA2 += $value['GA'];
                            $tGU2 += $value['GU'];
                            $tGC2 += $value['GC'];
                            $tPA2 += $value['PA'];
                            $tPU2 += $value['PU'];
                            $tPC2 += $value['PC'];
                            $tgt2 += $gt2;
                            $tpt2 += $pt2;
                            $ttt2 += $tt2;
                            
                            $ListAllData2.='<tr><td>'.$value['nup_date'].'</td>';
                            $ListAllData2.='<td>'.$value['GA'].'</td>';
                            $ListAllData2.='<td>'.$value['GU'].'</td>';
                            $ListAllData2.='<td>'.$value['GC'].'</td>';
                            $ListAllData2.='<td>'.$gt2.'</td>';
                            $ListAllData2.='<td>'.$value['PA'].'</td>';
                            $ListAllData2.='<td>'.$value['PU'].'</td>';
                            $ListAllData2.='<td>'.$value['PC'].'</td>';
                            $ListAllData2.='<td>'.$pt2.'</td>';
                            $ListAllData2.='<td>'.$tt2.'</td></tr>';
                        }
                        $ListAllData2.="<tr><td><b>Total</b></td><td><b>$tGA2</b></td><td><b>$tGU2</b></td><td><b>$tGC2</b></td><td><b>$tgt2</b></td><td><b>$tPA2</b></td><td><b>$tPU2</b></td><td><b>$tPC2</b></td><td><b>$tpt2</b></td><td><b>$ttt2</b></td></tr>";
                 }

            }else{
                $ListAllData2='';
            }
                return $ListAllData2;
        }

        public function download($filename = null)
        {
            $this->load->helper('download');
            $data = file_get_contents(base_url('/pdf/Report/'.$filename));
            force_download($filename,$data);
        }



        public function createpdf(){
            
            $project_no = $this->input->post('project_no',TRUE);
            $msg = "fail";
            if(!empty($project_no)){
               
             if(!empty($this->ListAll($project_no))||!empty($this->ListAll2($project_no))){
               $data = array('Listdata'=>$this->ListAll($project_no),
                           'Listdata2'=> $this->ListAll2($project_no),
                           'nama_project'=>$this->get_nama($project_no));
     

                $pdf = 'NUPSumary_'.$project_no;
                $filename = 'pdf/Report/'.$pdf.'.pdf';

                $html = $this->load->view('grafik/tes', $data, true);
                // var_dump($html);exit();
                $a = pdfGenMail($html, $pdf, "A4", "landscape");

                // var_dump($html);
                file_put_contents($filename, $a);   
                $msg ='OK';  
            }else{
                $msg = 'fail';
            }
                
            }
            echo $msg;
        }

 


}
  