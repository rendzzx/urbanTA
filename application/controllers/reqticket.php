<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Reqticket extends Core_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->auth_check();
        $this->load->model('m_wsbangun');
        $this->load->model('m_sms');
    }
    
    public function index($year=null, $month=null)
    {
        if(is_array($year)) {
            $data = $year;
            $year = null;
            $month = null;
        } else {
            $data = null;
        }
        // $link_cal = display_cal($this, base_url('req_ticket/index/'),'abr',$year,$month);
        $entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        $kriteria = array('entity_cd'=>$entity,
            'project_no'=>$project);
        $table = 'sv_spec';
        $dtSpec = $this->m_wsbangun->getData_by_criteria($table, $kriteria);
        $complain_no = empty($dtSpec)? 0 : $dtSpec[0]->complain_seq_no;

        $table = 'cf_business';
        $dtBuss = $this->m_wsbangun->getData($table);
        if(!empty($dtBuss)) {
            $comboBus[] = '<option></option>';
            foreach ($dtBuss as $customer) {
                $comboBus[] = '<option value="'.$customer->business_id.'">'.$customer->business_id.' - '.$customer->name.'</option>';
            }
            $comboBus = implode("", $comboBus);
        }
        $table = 'sv_category';
        $comboCat = $this->m_wsbangun->get_combo($table);

        // $angka=0;
        // $buss_id = $this->session->userdata('business_no');
        // if(empty($_SESSION["tenant_df"])) {
        //   $_SESSION["tenant_df"]=$this->session->userdata('tenant_df');
        // }
        // $tenant_no = $_SESSION["tenant_df"];
        // $crit = array(
        //     'business_no'=>$buss_id,
        //     'tenant_no'=>$tenant_no
        // );
        // $data_tenancy = $this->m_tenancy->get_by_criteria($crit);
        // // var_dump($data_tenancy);
        // // var_dump($cnt_tenancy);
        // $combo_tenant='';
        // if($data_tenancy){
        //     $combo_tenant = $this->m_tenancy->get_combo($buss_id, $data_tenancy[0]->id);
        // }
        // $category = 'sv_category';
        // $complain_spec = 'sv_spec';
        // $crit_spec = array('entity_cd'=>$data_tenancy[0]->entity_cd,
        //     'project_no'=>$data_tenancy[0]->project_no);
        // $dataspec = $this->m_wsbangun->getData($complain_spec);
        // $dataspec = $this->m_wsbangun->getData_by_criteria($complain_spec, $crit_spec);
        // $complain_no = $dataspec[0]->complain_seq_no;
        $content = array
        (
            // 'combo_tenant' => $combo_tenant,
            // 'link_cal' => $link_cal,
            // // 'combo_category' => $this->m_wsbangun->get_combo($category),
            // // 'number'=>$this->generate_doc_num('ticket'),
            'combo_category' => $comboCat,
            'combo_customer' => $comboBus,
            'number' => $complain_no,
            'entity' => $entity,
            'project' => $project,
            'error' => $data
        );
        
        $this->load_content('reqticket/index', $content);
    }

    public function edit($selected_id="", $data=null)
    {
        if($selected_id!="" && $selected_id) {
            $tickets = $this->m_complain->get_by_id($selected_id);
            if($tickets) {
                if($tickets->status=='R') {
                    $category = 'sv_category';
                    $buss_id = $this->session->userdata('business_no');
                    $tenancy = $this->m_tenancy->get_by_id($tickets->id_tenancy);
                    $tenant_no = $tenancy->tenant_no;
                    $combo_tenant = $this->m_tenancy->get_combo($buss_id, $tickets->id_tenancy);
                    $combo_category = $this->m_wsbangun->get_combo($category, $tickets->category_cd);
                    $ticket_type = array("R"=>"Request","C"=>"Complain");
                    foreach ($ticket_type as $key => $valuetype) {
                        if($key==$tickets->complain_type) {
                            $select = ' Selected="1"';
                        } else {
                            $select = '';
                        }
                        $combo_type[] = '<option value="'.$key.'" '.$select.'>'.$valuetype.'</option>';
                    }
                    $combo_type = implode("",$combo_type);
                    $combo_type ;
                    $crit1 = array(
                        'entity_cd'=>$tenancy->entity_cd,
                        'project_no'=>$tenancy->project_no,
                        'tenant_no'=>$tenant_no
                    );
                    $table = 'tenant_lot';
                    $tenant_lot = $this->m_wsbangun->getData_by_criteria($table,$crit1);
                    if(!empty($tenant_lot)) {
                        foreach ($tenant_lot as $datalot) {
                            if($datalot->lot_no === $tickets->lot_no) {
                                $pilih = ' selected="1" ';
                            } else {
                                $pilih = '';
                            }
                            $combo_lot[]='<option '.$pilih.' data-level="'.$datalot->level_no.'" value="'.$datalot->lot_no.'" >'.$datalot->descs.'</option>';
                        }
                        $combo_lot = implode("",$combo_lot);
                    }
                    $content = array(
                        'dataticket'=>$tickets,
                        'combo_tenant'=>$combo_tenant,
                        'combo_lot'=>$combo_lot,
                        'combo_type'=>$combo_type,
                        'combo_category'=>$combo_category,
                        'error'=>$data,
                        'entity'=>$tenancy->entity_cd,
                        'project'=>$tenancy->project_no,
                    );
                    $this->load_content('req_ticket/edit',$content);
                }
                // var_dump('TRUE');
            } else {
                var_dump('FALSE');
            }
        }
    }

    public function getNewTenant()
    {
        // session_start();

        if($_POST)
        {
            $tenant_no = $this->input->post('newtenant', TRUE);
            if(!empty($tenant_no)) {
                $this->session->unset_userdata('tenant_df');
                $this->session->set_userdata('tenant_df', $tenant_no);
                $_SESSION["tenant_df"] = $tenant_no;
            }
            // var_dump($_SESSION["tenant_df"]);
        }
    }

    public function getCat()
    {
        // var_dump($_POST);
        if($_POST)
        {
            $ticket_type = $this->input->post('ticket_type', TRUE);
            // $ticket_type = 'C';
            if(is_null($ticket_type)||!isset($ticket_type)) {
                echo('<option></option>');
            } else {
                $table = "sv_category";
                $crit_cat = array('complain_type'=>$ticket_type);
                $data_cat = $this->m_wsbangun->get_combo_criteria($table, $crit_cat);
                if(!empty($data_cat)) {
                    echo($data_cat);
                } else {
                    var_dump("empty category");
                }
            }
        }
    }

    public function getLotNo()
    {
        if($_POST)
        {
            $idBuss = $this->input->post('idBuss', TRUE);
            $entity = $this->input->post('ent', TRUE);
            $project = $this->input->post('prj', TRUE);
            if(empty($idBuss)) {
                echo('<option></option>');
            } else {
                $table = 'rl_sales';
                $kriteria = array('business_id'=>$idBuss,
                    'entity_cd'=>$entity,
                    'project_no'=>$project,
                    'status'=>'B');
                $dtLot = $this->m_wsbangun->getData_by_criteria($table,$kriteria);
                $listLot = '';
                if(!empty($dtLot)) {
                    $listLot = '<option></option>';
                    foreach ($dtLot as $sales) {
                        $kriteria = array('entity_cd'=>$entity,
                            'project_no'=>$project,
                            'lot_no'=>$sales->lot_no);
                        $table = 'pm_lot';
                        $dtLot = $this->m_wsbangun->getData_by_criteria($table,$kriteria);

                        $listLot.='<option data-level="'.$dtLot[0]->level_no.'" value="'.$sales->lot_no.'">'.$dtLot[0]->descs.'</option>';
                    }
                }
                echo($listLot);
            }
            // $id_tenancy = $this->input->post('id_tenancy', TRUE);
            // if(is_null($id_tenancy)||!isset($id_tenancy)) {
            //     echo('<option data-level=""></option>');
            // } else {
            //     $data_tenancy = $this->m_tenancy->get_by_id($id_tenancy);

            //     // $data_tenancy = $this->m_tenancy->get_by_id($id);
            //     // var_dump($data_tenancy);
            //     $entity = $data_tenancy->entity_cd;
            //     $project = $data_tenancy->project_no;
            //     $tenant_no = $data_tenancy->tenant_no;
            //     $crit1 = array(
            //         'entity_cd'=>$entity,
            //         'project_no'=>$project,
            //         'tenant_no'=>$tenant_no
            //     );
            //     $table = 'tenant_lot';
            //     $tenant_lot = $this->m_wsbangun->getData_by_criteria($table,$crit1);
            //     if(!empty($tenant_lot)) {
            //         $list_lot = '<option data-level="">-- Choose --</option>';
            //         foreach ($tenant_lot as $datalot) {
            //             $list_lot.='<option data-level="'.$datalot->level_no.'" value="'.$datalot->lot_no.'" >'.$datalot->descs.'</option>';
            //         }
            //         echo($list_lot);
            //     } else {
            //         var_dump('lotno empty');
            //     }
            // }
        }
        
    }

    public function tes1()
    {
        // $table = 'sv_test';
        // $data_test = $this->m_wsbangun->getData($table);
        // // var_dump($data_test);
        // header('Content-type: image/jpeg');
        // echo ($data_test->pic_attached);
        $cmplid=37;
        $gambar = file_get_contents(base_url().'uploads/tenanthelpdesk/kranbaru2.jpg');
        // var_dump($gambar);
        $escape = bin2hex($gambar);
        // echo($escape);
        
        // var_dump($escape);
        // $data = array('pic_attached'=>decode('{$escape}','hex'));
        // $crit = array('id'=>$cmplid);
        // $this->m_complain->update($data, $crit);
        var_dump("12");

        
        // $data_test = $this->m_complain->get_by_id($cmplid);
        // var_dump($data_test);
        
        // $pic = pg_unescape_bytea($data_test->pic_attached);
        // $content = array('picture'=>$pic);
        $content = array('picture'=>$gambar);
        $this->load->view('req_ticket/tes',$content);
    }

    public function save()
    {
        if ($_POST) 
        {
            $id = $this->input->post('id',TRUE);
            $entity = $this->input->post('entity', TRUE);
            $project = $this->input->post('project', TRUE);
            $number = $this->input->post('angka', TRUE);
            $description = $this->input->post('description',TRUE);
            $category = $this->input->post('category',TRUE);
            $ticket_type = $this->input->post('reqtype', TRUE);
            $business_id = $this->input->post('customer', TRUE);
            $lot_no = $this->input->post('unit',TRUE);
            $floor = $this->input->post('floor',TRUE);
            $location = $this->input->post('location', TRUE);
            $req_by = $this->input->post('req_by',TRUE);
            $contact_no = $this->input->post('contact_no',TRUE);
            $picture = $_FILES["picture"];
            $picture = array_filter($picture);
            $tenant_no = '';
            $kriteria = array('entity_cd'=>$entity,
                'project_no'=>$project,
                'business_id'=>$business_id);
            $table = 'ar_debtor';
            $dtTenant = $this->m_wsbangun->getData_by_criteria($table, $kriteria);
            if(!empty($dtTenant)) {
                $tenant_no = $dtTenant[0]->debtor_acct;
            }
            if(!empty($_FILES)) {
                $picture = $_FILES["picture"];
            }            

            // --
            if (!empty($picture["name"])) {
                // $config['upload_path'] = $this->config->item('energy_url').'lainnya/uploads/';
                $config['upload_path'] = './uploads/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size'] = '1024';
                $config['max_width'] = '1024';

                $data['upload_data'] = '';
                $s = $this->load->library('upload', $config);
                
                if(!$this->upload->do_upload('picture')) { 
                    $data['error'] = $this->upload->display_errors();
                    // var_dump($config);
                    if(empty($id)) {
                        $this->index($data);
                    } else {
                        $this->edit($id,$data);
                    }                    
                    return;
                } else {
                    $data = $this->upload->data();
                }
                
            } else {
                $picname = $this->input->post('picname',TRUE);
                $picDataStr = null; 
                $hex_image = null;   
                $picPath = null;            
            }
            // var_dump($id);
            // --
            // $this->form_validation->set_rules('subject', 'Subject ticket', 'required');
            $this->form_validation->set_rules('reqtype', 'Ticket type', 'required');
            $this->form_validation->set_rules('category', 'Category ticket', 'required');
            $this->form_validation->set_rules('description', 'Complain description', 'required');
            $this->form_validation->set_message('required', '** Please entry this %s ');
            // $this->form_validation->set_message('is_unique', '** %s telah terdaftar..');
            // $this->form_validation->set_message('max_length', '** %s maksimal hanya 12 karakter..');
            $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

            if ($this->form_validation->run() == FALSE) 
            {
                if(empty($id)) {
                    $data['error'] = validation_errors();
                    $this->index($data);
                } else {
                    $data['error'] = validation_errors();
                    $this->edit($id,$data);
                }
                return;
            } else{
                if(!empty($picture["name"])) {
                    $picname = $data['file_name'];
                    // $picBlob = array(

                    // );
                    $picPath = $data['full_path'];
                    $picDataStr = file_get_contents($data['full_path']);
                    $hex_image = bin2hex($picDataStr);
                    // $hex_image = decode('{$hex_image}' , 'hex');
                }
                
                $webuser=$this->session->userdata('Tuser_id'); //'TWP';
                $today = date('d M Y H:i:s');
                // var_dump("BEGIN SAVE");                
                // $data_tenant = $this->m_tenancy->get_by_id($tenant_no); 
                // $data = array(
                //     'complain_no'=>$number,
                //     'id_tenant'=>$this->session->userdata('Tuser_id'),
                //     'reported_by'=>$webuser, //$this->session->userdata('Tuname'),
                //     'reported_date'=>date('Y-m-d'),
                //     'serv_req_by'=>$req_by,
                //     'location'=>$location,
                //     'floor'=>$floor,
                //     'contact_no'=>$contact_no,
                //     'billing_type'=>'T',
                //     'complain_type'=>$ticket_type,
                //     'complain_source'=>'01',
                //     'category_cd'=>$category,
                //     'lot_no'=>$lot_no,
                //     'status'=>'R',
                //     'work_requested'=>$description,
                //     'id_tenancy'=>$tenant_no,
                //     'tenant_no'=>$data_tenant->tenant_no,
                //     'picture'=>$picname,
                //     'pic_attached'=>'0x'.$hex_image,
                //     'entity_cd'=>$entity,
                //     'project_no'=>$project
                //     );
                // $critedit = array('id'=>$id);
                // $crit = array('complain_no'=>$number,);
                // $cnt_complain = $this->m_complain->count_by_criteria($crit);
                // if($cnt_complain<1) {
                //     $this->m_complain->insert($data);
                //     var_dump("INS_COMPLAIN");
                // } else {
                //     $this->m_complain->update($data,$critedit);
                //     var_dump("UPD_COMPLAIN");
                // }             

                // $data_tenant = $this->m_tenancy->get_by_id($tenant_no);
                $dataServ1 = array(
                    'entity_cd'=>$entity,
                    'project_no'=>$project,
                    'debtor_acct'=>$tenant_no,
                    'complain_no'=>$number,
                    'reported_by'=>$webuser,
                    'reported_date'=>$today,
                    'serv_req_by'=>$req_by,
                    'location'=>$location,
                    'floor'=>$floor,
                    'contact_no'=>$contact_no,
                    'billing_type'=>'T',
                    'status'=>'R',
                    'complain_source'=>'01',
                    'lot_no'=>$lot_no,
                    'complain_type'=>$ticket_type,
                    'category_cd'=>$category,
                    'post_status'=>'N',
                    'audit_user'=>$webuser, //'MGR',
                    'audit_date'=>$today
                );
                $table = 'sv_entry_multi';
                $critedit2 = array(
                    'entity_cd'=>$entity,
                    'project_no'=>$project,
                    'complain_no'=>$number
                );
                if(!$id) {
                    $this->m_wsbangun->insertData($table,$dataServ1);
                } else {
                    $this->m_wsbangun->updateData($table,$dataServ1,$critedit2);
                }

                $dataServ2 = array(
                    'entity_cd'=>$entity,
                    'project_no'=>$project,
                    'debtor_acct'=>$tenant_no,
                    'complain_no'=>$number,
                    'seq_no'=>1,
                    'reported_by'=>$webuser,
                    'reported_date'=>$today,
                    'work_requested'=>$description,
                    'serv_req_by'=>$req_by,
                    'location'=>$location,
                    'floor'=>$floor,
                    'contact_no'=>$contact_no,
                    'billing_type'=>'T',
                    'status'=>'R',
                    'complain_source'=>'01',
                    'audit_user'=>$webuser ,//'MGR',
                    'audit_date'=>$today,
                    'picture'=>$picname
                    // 'pic_attached'=>"0x".$hex_image
                );
                $table = 'sv_entry_multi_dt';
                if(!$id) {
                    $this->m_wsbangun->insertData($table,$dataServ2);
                    var_dump('Ins_dt');
                } else {
                    $this->m_wsbangun->updateData($table,$dataServ2,$critedit2);
                    var_dump('Upt_dt');
                }
                if(!$id) {
                    $autonum = $number + 1;
                    $dataCompl = array('complain_seq_no'=>strval($autonum));
                    $crit = array(
                        'entity_cd'=>$entity,
                        'project_no'=>$project
                    );
                    $table = 'sv_spec';
                    $this->m_wsbangun->updateData($table,$dataCompl,$crit);
                }
                // var_dump('sv_test');
                // $dataImg = array(
                    // 'picname'=>$picname,
                    // 'pic_attached'=>$hex_image);
                // $table = 'sv_test';
                // $this->m_wsbangun->insertData($table,$dataImg);
                // var_dump("IMG SAVED");
                // $data_test = $this->m_wsbangun->getData($table);
                // var_dump($data_test);
                // header('Content-type: image/jpeg');
                // echo($data_test->pic_attached);
                /* email tenant */
        		// $message = '';
        		// $message.= 'Dear Manager,'."\n\n";
        		// $message.= 'Complain / Request and dengan ticket number '.$number."\n";
        		// $message.= 'sudah kami terima dan akan ditindaklanjuti segera'."\n\n\n\n";
        		// $message.= 'Best Regards, '."\n\n";
        		// $message.= 'Building Management';
        		// $judul = 'Ticket number '.$number.' opened';
        		// $this->_sendmail('renoputra100@gmail.com',$judul,$message);
                 // sms tenant 
                // $ph=$this->m_tenant->get_by_id($this->session->userdata('Tuser_id'));

                $tablemail = 'cf_business';
                $kriteriamail = array( 'business_id' => $business_id );
                $lotData = $this->m_wsbangun->getData_by_criteria($tablemail,$kriteriamail);
                $mailData = $lotData[0]->email_addr;
                // $mailData = $lotData[0]->email_addr; 
                // var_dump($mailData);
                if ($lotData) 
                {
                $message = '';
                $message.= 'Dear Manager,'."\n\n";
                $message.= 'Complain / Request and dengan ticket number '.$number."\n";
                $message.= 'sudah kami terima dan akan ditindaklanjuti segera'."\n\n\n\n";
                $message.= 'Best Regards, '."\n\n";
                $message.= 'Building Management';
                $judul = 'Ticket number '.$number.' opened';
                $this->_sendmail($mailData,$judul,$message);
                // var_dump($mailData);
                }else{
                   echo "failed";
                }

                $hptenant = $contact_no;
                $tenantRe = $tenant_no;
                $desc = $description;
                $req = $req_by;
                $isiSms = array(
                    "DestinationNumber"=>$hptenant,
                    "TextDecoded"=>'Tenant '.$tenantRe.', Tiket nomor : ' .$number. ', Complain :'.$req.' Deskripsi :'.$desc.' sudah di buat dan segera diproses ke Departement yang bersangkutan. Demikian dan terima kasih',
                    "CreatorID"=>'TWP'
                    );
                $this->m_sms->sendSms($isiSms);
                // 
                // $table = 'sv_category';
                // $criteria = array('category_cd'=>$category);
                // $data_category = $this->m_wsbangun->getData_by_criteria($table, $criteria);
                // if(!empty($data_category)) {
                //     $spv = $data_category[0]->user_spv;
                //     $table = 'security_users';
                //     $criteria = array('name'=>$spv);
                //     $data_spv = $this->m_wsbangun->getData_by_criteria($table, $criteria);
                //     if(!empty($data_spv)) {
                //         /* email spv */
                //         $msg ="";
                //         $msg.='Dear '. $data_spv[0]->description.','."\n\n";
                //         $msg.='System menerima keluhan dari tenant : '.$this->session->userdata('TCompany'). "\n";
                //         $msg.='dengan contact person : ' .$this->session->userdata('Tuname'). ' dan Ticket Number : '.$number. "\n";
                //         $msg.='Harap segera diproses'."\n\n";
                //         $msg.= 'Building Management';
                //         $jdl ='Ticket number '.$number.' opened';
                //         $this->_sendmail($data_spv[0]->email_add,$jdl,$msg,$picture_loc);

                //         /* sms spv 
                //         $hp_spv = $data_spv[0]->phone_cellular;
                //         $isiSms = array(
                //             "DestinationNumber"=>$hp_spv,
                //             "TextDecoded"=>'Ticket number ' .$number. ' dicreate oleh Tenant ' .$this->session->userdata('TCompany'). ' ( ' .$this->session->userdata('TCompany'). ' ) ',
                //             "CreatorID"=>'TWP'
                //             );
                //         $this->m_sms->sendSms($isiSms);
                //         */
                //     }
                // }
                /* */
                redirect("dash/index");
            }
        } //end if $_POST
    } 
}
