<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class ClaimCs extends Core_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->auth_check();
        $this->load->model('m_wsbangun');
    }

    public function index()
    {
        $entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        
        $sql = "select distinct mgr.rl_sales.lot_no, 
                                mgr.cf_business.name, 
                                mgr.rl_sales.sales_date, 
                                mgr.cf_agent_dt.agent_name 
                        from mgr.rl_sales,
                            mgr.cf_business,
                            mgr.cf_agent_dt 
                        where mgr.rl_sales.business_id = mgr.cf_business.business_id 
                        AND mgr.cf_agent_dt.agent_cd = mgr.rl_sales.staff_in_charge";
        $dtSubmit = $this->m_wsbangun->getData_by_query($sql);

        if (!empty($dtSubmit)) 
        {   
            $ClaimList = '';
            foreach ($dtSubmit as $value) 
            {
                $ClaimList .='<tr>';
                $ClaimList .='<td>'.$value->lot_no.'</td>';
                $ClaimList .= '<td>'.$value->name.'</td>';
                $ClaimList .='<td>'.date('Y-m-d', strtotime($value->sales_date)).'</td>';
                $ClaimList .= '<td>'.$value->agent_name.'</td>'; 
                $ClaimList .='<td><a href="'.base_url('ClaimCs/claimInput/'.$value->lot_no).'" class="btn btn-primary"><i></i> Warranty Claim </a></td>';  
                $ClaimList .='</tr>';
            }
            $allList = array('ClaimList'=>$ClaimList);
        }else{
            $allList = array('ClaimList'=>'');
        }
        $this->load_content('booking/v_claimCs',$allList);
    }

//new input  button in list hand over
    public function claimInput($id=null)
    {
        if(!empty($id))
        {
            // var_dump("expression");
            $entity = $this->session->userdata('Tsentity');
            $project = $this->session->userdata('Tsproject');
            $webuser = $this->session->userdata('Tsuname'); 
            // --
            $table0 = 'rl_sales';
            $kriteria0 = array(
                    'entity_cd'=>$entity,
                    'project_no'=>$project,
                    'debtor_acct'=>$id
                );
            // var_dump($kriteria);
            $claimData = $this->m_wsbangun->getData_by_criteria($table0,$kriteria0);
            $unit = $claimData[0]->lot_no;
            // var_dump($unit);
            $agent = $claimData[0]->staff_in_charge;
            $business = $claimData[0]->business_id;
            $salDate = $claimData[0]->sales_date;

            $table1 = 'cf_business';
            $kriteria1 = array(
                        'business_id'=>$business
                        );
            $descName = $this->m_wsbangun->getData_by_criteria($table1,$kriteria1);
            $name = $descName[0]->name;
            $location = $descName[0]->address3;
            $contact_no = $descName[0]->hand_phone;

            $table2 = 'cf_agent_dt';
            $kriteria2 = array('agent_cd'=>$agent);
            $descAgent = $this->m_wsbangun->getData_by_criteria($table2,$kriteria2);
            $agentDesc = $descAgent[0]->agent_name;

            $table3 = 'pm_lot';       
            $kriteria3 = array(
                'entity_cd'=>$entity,
                'project_no'=>$project,
                'lot_no'=>$unit,
                );
            $Level = $this->m_wsbangun->getData_by_criteria($table3,$kriteria3);
            $floor = $Level[0]->level_no;

            $kriteria4 = array('entity_cd'=>$entity,'project_no'=>$project);
            $table4 = 'sv_spec';
            $dtSpec = $this->m_wsbangun->getData_by_criteria($table4, $kriteria4);
            $complain_no = empty($dtSpec)? 0 : $dtSpec[0]->complain_seq_no;
            // --
            $today = date('d M Y H:i:s');
            $tableMulty = 'sv_entry_multi';
            $kriteria = array(
                'entity_cd'=>$entity,
                'project_no'=>$project,
                'debtor_acct'=>$id
                    );
            $dtEntry = $this->m_wsbangun->getData_by_criteria($tableMulty, $kriteria);
            // var_dump($dtEntry);
            if(!empty($dtEntry))
            {   
                $complain = $dtEntry[0]->complain_no;
                $debtor = $dtEntry[0]->debtor_acct;
                $table = 'sv_entry_multi_dt';
                $kriteria = array(
                            'entity_cd'=>$entity,
                            'project_no'=>$project,
                            'debtor_acct'=>$debtor,
                            'complain_no'=>$complain
                            );
                $dtEntryDetail = $this->m_wsbangun->getData_by_criteria($table, $kriteria);

                // generate header

                $tlocation = 'sv_location';
                $DetLocation = $this->m_wsbangun->getData($tlocation);
                $list ='';
                // var_dump($dtEntryDetail);
                if(!empty($dtEntryDetail))
                {
                    //output data
                    foreach ($dtEntryDetail as $key=>$value) {
                        $list .= '</tr>';

                        if (!empty($DetLocation)) {
                            $Opsi = '<option></option>';
                            foreach ($DetLocation as $location) {
                                $lokasinya = $value->location;
                                if ($lokasinya===$location->location_cd) {
                                    $int = 'selected="selected"'; 
                                }else{
                                    $int = '';
                                }
                                $Opsi .= '<option '.$int.' value="'.$location->location_cd.'">'.$location->descs.'</option>';
                            }
                        }
                        $list .= '<td><select name="location['.$key.']" class="form-control" value="'.$value->location.'">'.$Opsi.'</select></td>';
                        $list .='<td><input name="descriptions['.$key.']"  class="form-control" placeholder="descriptions" value="'.$value->work_requested.'"></td>';
                        $list .='<td><input name="Ket['.$key.']" type="date" class="form-control" placeholder="Ket" value="'.date('Y-m-d', strtotime($value->est_completion_date)).'"></td>';
                        $list .='<td></td>';
                        $list .='</tr>';
                    }
                } 
                else
                {
                    //output no data
                    $list .='<tr>';
                    $tlocation = 'sv_location';
                    $DetLocation = $this->m_wsbangun->getData($tlocation);
                    if (!empty($DetLocation)) {
                        $Opsi2 = '<option></option>';
                        foreach ($DetLocation as $select) {
                            $Opsi2 .= '<option value="'.$select->location_cd.'">'.$select->descs.'</option>';
                        }
                    }
                    $list .= '<td><select name="location[0] class="form-control">'.$Opsi2.'</select></td>';
                    $list .='<td><input name="descriptions[0]"  class="form-control" placeholder="descriptions"></td>';
                    $list .='<td><input name="Ket[0]" type="date" class="form-control" placeholder="Ket"></td>';
                    $list .='<td></td>';
                    $list .='</tr>';
                }

            } else {

                $kriteriaSave = array(
                                'entity_cd'=> $entity,
                                'project_no'=> $project,
                                'debtor_acct'=> $id,
                                'complain_no'=> $complain_no,
                                'reported_by'=> $agentDesc,
                                'reported_date'=> $today,
                                'serv_req_by'=> $name,
                                'location'=> $location,
                                'floor'=> $floor,
                                'contact_no'=> $contact_no,
                                'billing_type'=> 'T',
                                'status'=> 'R',
                                'complain_source'=> '01',
                                'lot_no'=> $unit,
                                'complain_type'=> 'C',
                                'category_cd'=> 'N',
                                'post_status'=> '',
                                'audit_user'=> $webuser,
                                'audit_date'=> $today
                                );
                var_dump($kriteriaSave);
                $this->m_wsbangun->insertData($tableMulty, $kriteriaSave);
                $autonum = $complain_no + 1;
                $dataCompl = array('complain_seq_no'=>strval($autonum));
                $crit = array(
                    'entity_cd'=>$entity,
                    'project_no'=>$project
                    );
                $table = 'sv_spec';
                $this->m_wsbangun->updateData($table,$dataCompl,$crit);
                $this->session->set_userdata('Comp', $complain_no);
                // var_dump($kriteria);
            }
        }
        // var_dump("dua");
        $data = array(
                    'unit'=>$unit,
                    'name'=>$name,
                    'date'=>$salDate,
                    'agent'=>$agentDesc,
                    'desclist'=>$list,
                    'complain_no'=>$complain_no,
                    'time'=>$today,
                    'contact_no'=>$contact_no
                    );
        // var_dump($data);
        // var_dump($data);
        $this->load_content('booking/v_claimInput', $data);
    }

    public function claimInput_OLD($id = null)
    {
        if (!empty($id)) 
        {
            $entity = $this->session->userdata('Tsentity');
            $project = $this->session->userdata('Tsproject');
            $webuser = $this->session->userdata('Tuser_id'); 
            $today = date('d M Y H:i:s');

            $table = 'rl_sales';
            $kriteria = array(
                'entity_cd'=>$entity,
                'project_no'=>$project,
                'debtor_acct'=>$id
                    );
            $claimData = $this->m_wsbangun->getData_by_criteria($table,$kriteria);

            $unit = $claimData[0]->lot_no;
            $business = $claimData[0]->business_id;
            $salDate = $claimData[0]->sales_date;
            $agent = $claimData[0]->staff_in_charge;
            $debtor = $claimData[0]->debtor_acct;

            if (!empty($claimData)) {
                $table = 'pm_lot';
                $kriteria = array(
                    'entity_cd'=>$entity,
                    'project_no'=>$project,
                    'lot_no'=>$unit,
                    );
                $Level = $this->m_wsbangun->getData_by_criteria($table,$kriteria);
                $floor = $Level[0]->level_no;
                // var_dump($floor);
            }

            if ($claimData) {
                $table1 = 'cf_business';
                $kriteria1 = array(
                            'business_id'=>$business
                            );
                $descName = $this->m_wsbangun->getData_by_criteria($table1,$kriteria1);
                $name = $descName[0]->name;
                $location = $descName[0]->address3;
                $contact_no = $descName[0]->hand_phone;
            }
            if ($descName) {
                $table2 = 'cf_agent_dt';
                $kriteria2 = array('agent_cd'=>$agent);
                $descAgent = $this->m_wsbangun->getData_by_criteria($table2,$kriteria2);
                $agentDesc = $descAgent[0]->agent_name;
            }
            if ($descAgent) {
                $mulTable = 'sv_entry_multi';
                $mulkrite = array(
                            'entity_cd'=>$entity,
                            'project_no'=>$project,
                            'debtor_acct'=>$debtor
                            // 'complain_no'=>
                            );
                $setMul = $this->m_wsbangun->getData_by_criteria($mulTable, $mulkrite);
                // $comNO = $setMul[0]->complain_no;
                if (!empty($setMul)) {
                    $comNO = $setMul[0]->complain_no;
                }else{
                    $comNO = null;
                }
                // var_dump($comNo);
                $list = '';
                if (!empty($setMul)) {
                    $DTTable = 'sv_entry_multi_dt';
                    $DTkrite = array(
                            'entity_cd'=>$entity,
                            'project_no'=>$project,
                            'debtor_acct'=>$debtor,
                            'complain_no'=>$comNO
                            );
                    $setDT = $this->m_wsbangun->getData_by_criteria($DTTable, $DTkrite);

                    if (!empty($setDT)) {
                        foreach ($setDT as $value) {
                            $list .='<tr>';

                            $tlocation = 'sv_location';
                            $setLocation = $this->m_wsbangun->getData($tlocation);
                            if(!empty($setLocation)){
                                $cbLoc = '<option></option>';
                                foreach ($setLocation as $lokasi) {
                                    $lokasinya = $value->location;
                                    if($lokasinya ===$lokasi->location_cd) {
                                        $pilih = 'selected = "selected"';
                                    } else {
                                        $pilih = '';
                                    }
                                    $cbLoc.= '<option '.$pilih. ' value="'.$lokasi->location_cd.'">'.$lokasi->descs.'</option>';
                                }
                            }

                            $list .='<td><select name="location[0]"  class="form-control" placeholder="location" value="'.$value->location.'">'.$cbLoc.'</select></td>';

                            $list .='<td><input name="descriptions[0]"  class="form-control" placeholder="descriptions" value="'.$value->work_requested.'"></td>';
                            $list .='<td><input name="Ket[0]" type="date" class="form-control" placeholder="Ket" value="'.date('Y-m-d', strtotime($value->est_completion_date)).'"></td>';
                            $list .='<td></td>';
                            $list .='</tr>';
                        }
                    }else{
                        
                        
                        $list .='<tr>';
                        $tlocation = 'sv_location';
                        $setLocation = $this->m_wsbangun->getData($tlocation);
                        
                        if (!empty($setLocation)) {
                            $locNew = '<option></option>';
                            foreach ($setLocation as $New) {
                                $Forvalue = $New->location_cd;
                                $locNew.='<option value="'.$New->location_cd.'">'.$New->descs.'</option>';
                            }
                        }

                        $list .='<td><select name="location[0]"  class="form-control" placeholder="location">'.$locNew.'</select></td>';

                        $list .='<td><input name="descriptions[0]"  class="form-control" placeholder="descriptions"></td>';
                        $list .='<td><input name="Ket[0]" type="date" class="form-control" placeholder="Ket"></td>';
                        $list .='<td></td>';
                        $list .='</tr>';
                        
                    }
                }
            }

            $kriteria = array('entity_cd'=>$entity,
            'project_no'=>$project);
            $table = 'sv_spec';
            $dtSpec = $this->m_wsbangun->getData_by_criteria($table, $kriteria);
            $complain_no = empty($dtSpec)? 0 : $dtSpec[0]->complain_seq_no;

            $datatable = 'sv_entry_multi';
            $Check = array(
                    'debtor_acct'=>$debtor,
                    'lot_no'=>$unit
                    );
            $checkDB2 = $this->m_wsbangun->getData_by_criteria($datatable, $Check);

            if ($checkDB2) {
                $dataSave = array(
                    'entity_cd'=>$entity,
                    'project_no'=>$project,
                    'debtor_acct'=>$debtor,
                    'complain_no'=>$complain_no,
                    'reported_by'=>'0',
                    'reported_date'=>$today,
                    'serv_req_by'=>$name,
                    'location'=>$location,
                    'floor'=>$floor,
                    'contact_no'=>$contact_no,
                    'billing_type'=>'T',
                    'status'=>'R',
                    'complain_source'=>'01',
                    'lot_no'=>$unit,
                    'complain_type'=>'C',
                    'category_cd'=>'A2',
                    'post_status'=>'N',
                    'audit_user'=>'0',
                    'audit_date'=>$today,
                    );
            }else{
                    $dataSave = array(
                    'entity_cd'=>$entity,
                    'project_no'=>$project,
                    'debtor_acct'=>$debtor,
                    'complain_no'=>$complain_no,
                    'reported_by'=>'0',
                    'reported_date'=>$today,
                    'serv_req_by'=>$name,
                    'location'=>$location,
                    'floor'=>$floor,
                    'contact_no'=>$contact_no,
                    'billing_type'=>'T',
                    'status'=>'R',
                    'complain_source'=>'01',
                    'lot_no'=>$unit,
                    'complain_type'=>'C',
                    'category_cd'=>'A2',
                    'post_status'=>'N',
                    'audit_user'=>'0',
                    'audit_date'=>$today,
                    );
                $this->m_wsbangun->insertData($datatable, $dataSave);
                $autonum = $complain_no + 1;
                $dataCompl = array('complain_seq_no'=>strval($autonum));
                $crit = array(
                    'entity_cd'=>$entity,
                    'project_no'=>$project
                    );
                $table = 'sv_spec';
                $this->m_wsbangun->updateData($table,$dataCompl,$crit);
                $this->session->set_userdata('Comp', $complain_no);
            }
        }
        //end NEW

        $data = array(
                    'unit'=>$unit,
                    'name'=>$name,
                    'date'=>$salDate,
                    'agent'=>$agentDesc,
                    'desclist'=>$list,
                    'complain_no'=>$complain_no,
                    'time'=>$today,
                    'contact_no'=>$contact_no
                    );
        // var_dump($data);
        $this->load_content('booking/v_claimInput', $data);
    }

    public function saveHand()
    {
        // var_dump($_POST);
        $entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        $webuser = $this->session->userdata('Tsuname');
        //table post
        $location = $this->input->POST('location');
        $description = $this->input->POST('descriptions');
        $Ket = $this->input->POST('Ket');
        $lot_no = $this->input->POST('unit_no');
        $request = $this->input->POST('request');
        $today = date('d M Y H:i:s');

        $tableme = 'sv_entry_multi';
        $kriteriame = array(
                    'entity_cd'=>$entity,
                    'project_no'=>$project,
                    'debtor_acct'=>$lot_no
                    );
        $DataComme = $this->m_wsbangun->getData_by_criteria($tableme, $kriteriame);
        $comp = $DataComme[0]->complain_no;
        $tableServ2 = 'sv_entry_multi_dt';
        $credit = array(
                    'entity_cd'=>$entity,
                    'project_no'=>$project,
                    'debtor_acct'=>$lot_no,
                    'complain_no'=>$comp
                );
        $this->m_wsbangun->deleteData($tableServ2,$credit);

        $max = sizeof($location);
        for ($i=0; $i < $max ; $i++) 
        { 
            $locations = $location[$i];
            $descriptions = $description[$i];
            $kets = $Ket[$i];

            $table = 'pm_lot';
            $kriteria = array(
                        'entity_cd'=>$entity,
                        'project_no'=>$project,
                        'lot_no'=>$lot_no,
                        );
            $Level = $this->m_wsbangun->getData_by_criteria($table,$kriteria);
            $floor = $Level[0]->level_no;
            
            $tabelRl = 'rl_sales';
            $kriteriaRl = array(
                        'entity_cd'=>$entity,
                        'project_no'=>$project,
                        'lot_no'=>$lot_no
                        );
            $dataRl = $this->m_wsbangun->getData_by_criteria($tabelRl, $kriteriaRl);
            $business = $dataRl[0]->business_id;

            $tableBus = 'cf_business';
            $kriteriaBus = array(
                        'business_id'=>$business
                                );
            $descName = $this->m_wsbangun->getData_by_criteria($tableBus, $kriteriaBus);
            $contact_no = $descName[0]->hand_phone;
            $locats = $descName[0]->address2;

            $dataServ2 = array(
                        'entity_cd'=>$entity,
                        'project_no'=>$project,
                        'debtor_acct'=>$lot_no,
                        'complain_no'=>$comp,
                        'seq_no'=>$i,
                        'reported_by'=>$webuser,
                        'reported_date'=>$today,
                        'work_requested'=>$descriptions,
                        'serv_req_by'=>$request,
                        'location'=>$locations,
                        'floor'=>$floor,
                        'contact_no'=>$contact_no,
                        'billing_type'=>'T',
                        'status'=>'R',
                        'complain_source'=>'01',
                        'est_completion_date'=>date('d M Y H:i:s', strtotime($kets)),
                        'audit_user'=>$webuser ,
                        'audit_date'=>$today
                    );
            $this->m_wsbangun->insertData($tableServ2,$dataServ2);
            // var_dump($dataServ2);
        }
        // redirect('ClaimCs/reportClaim');
        echo "success";
    }

    public function saveHandold()
    {
        $entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        $webuser = $this->session->userdata('Tsuname');
        //table post
        $location = $this->input->POST('location');
        $description = $this->input->POST('descriptions'); 
        $Ket = $this->input->POST('Ket');
        //form POst
        $lot_no = $this->input->POST('unit_no');
        // $comp = $this->input->POST('comp');
        $request = $this->input->POST('request');
        $today = date('d M Y H:i:s');

        $max = sizeof($location);
        for ($i=0; $i < $max ; $i++) { 
            $locations = $location[$i];
            $descriptions = $description[$i];
            $kets = $Ket[$i];
            // var_dump($locations);

        $table = 'pm_lot';
        $kriteria = array(
                    'entity_cd'=>$entity,
                    'project_no'=>$project,
                    'lot_no'=>$lot_no,
                    );
        $Level = $this->m_wsbangun->getData_by_criteria($table,$kriteria);
        $floor = $Level[0]->level_no;
        
        $tabelRl = 'rl_sales';
        $kriteriaRl = array(
                    'entity_cd'=>$entity,
                    'project_no'=>$project,
                    'lot_no'=>$lot_no
                    );
        $dataRl = $this->m_wsbangun->getData_by_criteria($tabelRl, $kriteriaRl);
        $business = $dataRl[0]->business_id;

        $tableme = 'sv_entry_multi';
        $kriteriame = array(
                    'entity_cd'=>$entity,
                    'project_no'=>$project,
                    'debtor_acct'=>$lot_no
                    );
        $DataComme = $this->m_wsbangun->getData_by_criteria($tableme, $kriteriame);
        $comp = $DataComme[0]->complain_no;

        $tableBus = 'cf_business';
        $kriteriaBus = array(
                    'business_id'=>$business
                            );
        $descName = $this->m_wsbangun->getData_by_criteria($tableBus, $kriteriaBus);
        $contact_no = $descName[0]->hand_phone;
        $locats = $descName[0]->address2;

        $tableServ2 = 'sv_entry_multi_dt';
        $dataServ2 = array(
                    'entity_cd'=>$entity,
                    'project_no'=>$project,
                    'debtor_acct'=>$lot_no,
                    'complain_no'=>$comp,
                    'seq_no'=>$i,
                    'reported_by'=>$webuser,
                    'reported_date'=>$today,
                    'work_requested'=>$descriptions,
                    'serv_req_by'=>$request,
                    'location'=>$locations,
                    'floor'=>$floor,
                    'contact_no'=>$contact_no,
                    'billing_type'=>'T',
                    'status'=>'R',
                    'complain_source'=>'01',
                    'est_completion_date'=>date('d M Y H:i:s', strtotime($kets)),
                    'audit_user'=>$webuser ,
                    'audit_date'=>$today
                );
        $credit = array(
                'entity_cd'=>$entity,
                'project_no'=>$project,
                'debtor_acct'=>$lot_no,
                'complain_no'=>$comp
            );
        if ($dataServ2) {
           // $this->m_wsbangun->deleteData($tableServ2,$credit);
           $this->m_wsbangun->insertData($tableServ2,$dataServ2);
        }else{
            // $this->m_wsbangun->insertData($tableServ2,$dataServ2);
        }
        // if($dataServ2) {
        //             $autonum = $comp + 1;
        //             $dataCompl = array('complain_seq_no'=>strval($autonum));
        //             $crit = array(
        //                 'entity_cd'=>$entity,
        //                 'project_no'=>$project
        //             );
        //             $table = 'sv_spec';
        //             $this->m_wsbangun->updateData($table,$dataCompl,$crit);
        //             $this->session->set_userdata('Comp', $comp);
        //         }
        } //end $i
        redirect('ClaimCs/reportClaim');
    }

    public function reportClaim()
    {   
        $entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        $webuser = $this->session->userdata('Tuser_id');
        $comNo = $this->session->userdata('Comp');

        $table = 'sv_entry_multi';
        $kriteria = array(
                'entity_cd'=>$entity,
                'project_no'=>$project,
                'complain_no'=>$comNo
                    );
        $subject = $this->m_wsbangun->getData_by_criteria($table, $kriteria);
        $unit = $subject[0]->lot_no;
        $debtor = $subject[0]->debtor_acct;
        $name = $subject[0]->serv_req_by;
        $no_com = $subject[0]->complain_no;
        $date = $subject[0]->reported_date;

        if ($subject) {
            $tableDt = 'sv_entry_multi_dt';
            $kriteriaDt = array(
                        'entity_cd'=>$entity,
                        'project_no'=>$project,
                        'complain_no'=>$comNo,
                        'debtor_acct'=>$debtor
                            );
            $subjectDt = $this->m_wsbangun->getData_by_criteria($tableDt, $kriteriaDt);
            if (!empty($subjectDt)) {
                $Detail = '';
                $i=0;
                foreach ($subjectDt as $value) {
                   $Detail .='<tr>';
                    $Detail .='<td><center>'.$i.'</center></td>';
                    $Detail .='<td>'.$value->location.'</td>';
                    $Detail .='<td>'.$value->work_requested.'</td>';
                    $Detail .='<td>'.date('Y-m-d', strtotime($value->est_completion_date)).'</td>';
                    $Detail .='</tr>';
                    $i++;
                }
            }
        }

        $setData = array(
                    'unit'=>$unit,
                    'debtor'=>$debtor,
                    'name'=>$name,
                    'no_com'=>$no_com,
                    'date'=>$date,
                    'ClaimList'=>$Detail
                    );

        $this->load_content('booking/v_reportClaim', $setData);
    }
}