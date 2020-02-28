<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_cf_Business extends Core_Controller {

	public function __construct()
        {
            parent::__construct();
            $this->auth_check();
            $this->load->helper('form');
            $this->load->model('m_business');
            $this->load->model('m_wsbangun');

        }

	public function index($error=null)
	{ 
		$data['error'] =$error;
		// $data['group'] =  $this->m_business->zomm_class(); 
    $Id='';
		$data['religion'] =  $this->zomm_religion($Id); 
		// $number=$this->m_business->get_autonumber();
		// $data['business_id']=$number[0]; 
		$data['nationality'] =  $this->zomm_nationality($Id); 
		 
		// $this->load->view('v_cf_business', $data); 

		// $this->load->view('template/v_header');
		// $this->load->view('template/v_menu');
		// $this->load->view('v_cf_business', $data); 
		// $this->load->view('template/v_footer');

		 $this->load->view('booking/v_cf_business_modal', $data);

	}
   public function zomm_nationality($Id)
  {
    // $Id = $this->input->post('Id',TRUE);
    $table = 'cf_nationality';
        $dtBuss = $this->m_wsbangun->getData($table);
        if(!empty($dtBuss)) {
            $comboBus[] = '<option></option>';
            foreach ($dtBuss as $customer) {
              if($Id === $customer->nationality_cd) {
                $pilih = ' selected = "1"';
              } else {
                $pilih = '';
              }
                $comboBus[] = '<option '.$pilih.' value="'.$customer->nationality_cd.'">'.$customer->descs.'</option>';
            }
            $comboBus = implode("", $comboBus);
        }
        return $comboBus;
  }
  public function zomm_nationality_from()
  {
    $Id = $this->input->post('Id',TRUE);
    $table = 'cf_nationality';
        $dtBuss = $this->m_wsbangun->getData($table);
        if(!empty($dtBuss)) {
            $comboBus[] = '<option></option>';
            foreach ($dtBuss as $customer) {
              if($Id === $customer->nationality_cd) {
                $pilih = ' selected = "1"';
              } else {
                $pilih = '';
              }
                $comboBus[] = '<option '.$pilih.' value="'.$customer->nationality_cd.'">'.$customer->descs.'</option>';
            }
            $comboBus = implode("", $comboBus);
        }
        echo $comboBus;
  }
  public function zomm_religion($Id)
  {
    // $Id = $this->input->post('Id',TRUE);
    $table = 'cf_religion';
        $dtBuss = $this->m_wsbangun->getData($table);
        if(!empty($dtBuss)) {
            $comboBus[] = '<option></option>';
            foreach ($dtBuss as $customer) {
              if($Id === $customer->religion_cd) {
                $pilih = ' selected = "1"';
              } else {
                $pilih = '';
              }
                $comboBus[] = '<option '.$pilih.' value="'.$customer->religion_cd.'">'.$customer->descs.'</option>';
            }
            $comboBus = implode("", $comboBus);
        }
        return $comboBus;
  }
  public function zomm_religion_from()
  {
    $Id = $this->input->post('Id',TRUE);
    $table = 'cf_religion';
        $dtBuss = $this->m_wsbangun->getData($table);
        if(!empty($dtBuss)) {
            $comboBus[] = '<option></option>';
            foreach ($dtBuss as $customer) {
              if($Id === $customer->religion_cd) {
                $pilih = ' selected = "1"';
              } else {
                $pilih = '';
              }
                $comboBus[] = '<option '.$pilih.' value="'.$customer->religion_cd.'">'.$customer->descs.'</option>';
            }
            $comboBus = implode("", $comboBus);
        }
        echo $comboBus;
  }

/*public function Insertcustomer()
	{
		 $AutoNumber = $this->m_business->get_autonumber();
     $class =  $this->m_business->zomm_class(); 
		 $Number = $AutoNumber[0];
		 $class_cd = $class[0];

		if(!empty($_POST)){ 
			$webuser = $this->session->userdata('Tsuname');
			// $class_cd = $this->input->POST('class_cd');
			$category = $this->input->POST('category'); 
			$ic_no = $this->input->POST('ic_no'); 
			$name = $this->input->POST('Name'); 
			$Address1 = $this->input->POST('Address1'); 
			$Address2 = $this->input->POST('Address2'); 
			$Address3 = $this->input->POST('Address3'); 
			$post_cd = $this->input->POST('post_cd'); 
			$contact_person = $this->input->POST('contact_person'); 
			$designation = $this->input->POST('designation'); 
			$tel_no = $this->input->POST('tel_no'); 
			$fax_no = $this->input->POST('fax_no'); 
			$hand_phone = $this->input->POST('hand_phone'); 
			$email_addr = $this->input->POST('email_addr'); 			
			$mail_post_cd = $this->input->POST('mail_post_cd'); 
			$income_tax = $this->input->POST('income_tax'); 

			$sex = $this->input->POST('sex'); 
			$birth_date = $this->input->POST('birth_date'); 
			$religion_cd = $this->input->POST('religion_cd'); 
			$nationality = $this->input->POST('nationality');  
			$marital_status = $this->input->POST('marital_status'); 
      $id =  $this->input->POST('bussines_id'); 



			$data=array(
			   "business_id"=>$Number,
			   "class_cd" => $class_cd,
			   "category"=>$category,
			   "name"=>$name,
			   "salutation"=>"",
	           "address1"=>$Address1,
	           "address2"=>$Address2,
	           "address3"=>$Address3,
	           "post_cd"=>$post_cd,
	           "tel_no"=>$tel_no,
	           "hand_phone"=>$hand_phone,
	           "fax_no"=>$fax_no,
	           "sex"=>$sex,
	           "birth_date"=>date('d M Y H:i:s', strtotime($birth_date)), //$birth_date);
	           "nationality"=>$nationality,
	           "marital_status"=>$marital_status, 
	           "income_tax"=>$income_tax,
	           "mail_type"=>"O",
	           "mail_addr1"=>$Address1,
	           "mail_addr2"=>$Address2,
	           "mail_addr3"=>$Address3,
	           "mail_post_cd"=>$post_cd,
	           "co_name"=>$name,
	           "co_addr1"=>$Address1,
	           "co_addr2"=>$Address2,
	           "co_addr3"=>$Address3,
	           "co_post_cd"=>$post_cd,
	           "co_tel_no"=>$tel_no,
	           "co_fax_no"=>$fax_no,
	           "designation"=>$designation,
	           "contact_person"=>$contact_person,
	           "statement_type"=>$category,
	           "interest"=>"N",
	           "reminder"=>"N",
	           "credit_terms"=>"NA",
	           "remark"=>"",
	           "audit_user"=>$webuser,
	           "audit_date"=>date("d M Y h:i:s"),
	           "religion_cd"=>$religion_cd,
	           "email_addr"=>$email_addr,
	           "homepage"=>"",
	           "tel_no2"=>"",
	           "vip"=>"",
	           "status_cd"=>"",
	           "staff_in_charge"=>"",
	           "tax_trx_cd"=>"",
	           "ic_no"=>$ic_no,
	           "anal1"=>"",
	           "anal2"=>"",
	           "anal3"=>"",
	           "qq"=>"",
	           "masa_berlaku_ktp"=>"",
	           "akta_pendirian"=>"",
	           "akta_terakhir"=>"",
	           "SIUP"=>"",
	           "KDP"=>"",
	           "TDP"=>"",
	           "SKDP"=>"",
	           "pob"=>"",
	           "occupation_cd"=>""
	           // ,
	           // "agent_group_cd"=>""
			);

      if($id==0){//insert
        $this->m_business->insert($data);
        $this->update();
        $this->session->set_userdata('TmpBuss', $Number);
      }else{//update

      }
		
		// redirect(base_url().'C_rl_sales/');

		}
	}
*/
	 function updatecounter($number=0)
  {
    	 
            $data=array(
                        "COUNTER"=>$number + 1 
                        );
       $where=array("name" => "business_id");
       $this->m_business->update($data, $where);              
  }

//reno 
  	// public function editCustomer($id = null)
  	// {
  	// 	if (!is_null($id)) 
  	// 	{
  	// 		$tablecs = 'cf_business';
  	// 		$kategorycs = array( 'business_id' => $id );
  	// 		$lotdata = $this->m_wsbangun->getData_by_criteria($tablecs,$kategorycs);
  	// 		$religion = $lotdata[0]->religion_cd;
  	// 		$national = $lotdata[0]->nationality;
  	// 		$gender = $lotdata[0]->sex;
  	// 		$datamar = $lotdata[0]->marital_status;
   //      $category = $lotdata[0]->category;

   //      $categorydsc = array( 'C' => 'Company', 'I' => 'Individu');

   //      if (!empty($lotdata)) 
   //      {
   //        foreach ($lotdata as $value) 
   //        {
   //          if($category===$value->category)
   //          {
   //            $check = 'checked';
   //          }else{
   //            $check = '';
   //          }
   //          $checked[] = '<input id="C" name="category" type="radio" value="C" '.$check.'> Company </input>';
   //          $checked[] = '<input id="I" name="category" type="radio" value="I" '.$check.'> Individu </input>';
   //        }
   //        $checked = implode("", $checked);
   //      }

  	// 		$gendertamp = array('M' => 'Male', 'F'=>'Female', '' =>'');
  	// 		$statusmar = array('Y'=>'Married', 'N'=>'Single', '' =>'');
  	// 		// var_dump($name);

  	// 		$tablerlg = 'cf_religion';
  	// 		$kategoryrlg = array('religion_cd'=> $religion);
  	// 		$lotdatarlg = $this->m_wsbangun->getData_by_criteria($tablerlg,$kategoryrlg);
  	// 		$descrlg = $lotdatarlg[0]->descs;
  	// 		$lotdatarlg2 = $this->m_wsbangun->getData($tablerlg);

  	// 		if (!empty($lotdatarlg2)) 
  	// 		{
  	// 			$dropcom1[] = '<option></option>';
  	// 			foreach ($lotdatarlg2 as $value) 
  	// 			{
  	// 				if ($religion===$value->religion_cd) 
  	// 				{
  	// 					$pilih = 'selected = "selected"';
  	// 				}else{
  	// 					$pilih='';
  	// 				}
  	// 				$dropcom1[]='<option '.$pilih.' value="'.$value->religion_cd.'">'.$value->descs.'</option>';
  	// 			}
  	// 			$dropcom1 = implode("", $dropcom1);
  	// 		}

  	// 		$tablenat = 'cf_nationality';
  	// 		$kategoryrnat = array('nationality_cd'=>$national);
  	// 		$lotdatanat = $this->m_wsbangun->getData_by_criteria($tablenat,$kategoryrnat);
  	// 		$descnat = $lotdatanat[0]->descs;
  	// 		$lotdatanat2 = $this->m_wsbangun->getData($tablenat);

  	// 		if (!empty($lotdatanat)) 
  	// 		{
  	// 			$dropcom[] = '<option></option>';
  	// 			foreach ($lotdatanat2 as $valuelot) 
  	// 			{
  	// 				if ($national===$valuelot->nationality_cd) 
  	// 				{
  	// 					$pilih = 'selected = "selected"';
  	// 				}else{
  	// 					$pilih='';
  	// 				}
  	// 				$dropcom[]='<option '.$pilih.' value="'.$valuelot->nationality_cd.'">'.$valuelot->descs.'</option>';
  	// 			}
  	// 			$dropcom = implode("", $dropcom);
  	// 		}
  	// 	}

  	// 	$data = array('business_id' => $lotdata,
  	// 					'descs' => $descrlg, 
  	// 					'descsnat' => $descnat,
  	// 					'gender' => /*$gendertamp["*/$gender/*"]*/,
  	// 					'marital' => /*$statusmar["*/$datamar/*"]*/,
  	// 					'dropcom' => $dropcom,
  	// 					'droprelig' => $dropcom1,
   //            'checked' => $checked);
  	// 	$this->load_content('floorPlan/customerEdit',$data);

  	// }
    public function getByID($id=''){
        // if(empty($id)){
        //     $id=''
        // }
        $where=array('business_id'=>$id);
        $data = $this->m_wsbangun->getData_by_criteria('cf_business',$where);

        echo json_encode($data);

    }
  	public function saveEdit()
  	{
  		if ($_POST) 
  		{
        $audit_user = $this->session->userdata('Tsuname');
        $AutoNumber = $this->m_business->get_autonumber();
        $class =  $this->m_business->zomm_class(); 
        $Number = (int)$AutoNumber[0]->COUNTER;
        $class_cd = $class[0]->class_cd;

  			$id = (string)$this->input->POST('id');
        
        
        if($id=='0'){
          $bi=(string)$Number;  
          
        }else{
          $bi=$id;
        }
        // var_dump($business_id);
  			// $class_cd = $this->input->POST('class_cd');
  			$ic_no = $this->input->POST('ic_no',TRUE);
  			$category = $this->input->POST('category',TRUE);
  			$name = $this->input->POST('Name',TRUE);
  			$address1 = $this->input->POST('address1',TRUE);
  			$address2 = $this->input->POST('address2',TRUE);
  			$address3 = $this->input->POST('address3',TRUE);
  			$post_cd = $this->input->POST('post_cd',TRUE);
  			$contact_person = $this->input->POST('contact_person',TRUE);
  			$designation = $this->input->POST('designation',TRUE);
  			$tel_no = $this->input->POST('tel_no',TRUE);
  			$fax_no = $this->input->POST('fax_no',TRUE);
  			$hand_phone = $this->input->POST('hand_phone',TRUE);
  			$email_addr = $this->input->POST('email_addr',TRUE);
  			$income_tax = $this->input->POST('income_tax',TRUE);
  			
  			
  			
        
  			$table = 'cf_business';
        if($category=='I'){
          $sex = $this->input->POST('sex',TRUE);
          $religion_cd = $this->input->POST('religion_cd',TRUE);
          $nationality = (string)$this->input->POST('nationality',TRUE); 
          $marital = $this->input->POST('marital_status',TRUE);
          $birth_date  =$this->input->post('birth_date',TRUE);
          $birth_date = date($birth_date);
          $birth_date = DateTime::createFromFormat('d/m/Y H:i:s', $birth_date.' 00:00:00');
          $birth_date = $birth_date->format('Y-d-m H:i:s');
        }else{
          $sex= null;
          $religion_cd=null;
          $nationality=null;
          $marital=null;
          $birth_date=null;
        }

  			$editdata = array(
                'business_id'=>$bi,
                'ic_no'=>$ic_no,
                'class_cd'=>$class_cd,
  							'category'=>$category,
  							'name'=>$name,
  							'address1'=>$address1,
  							'address2'=>$address2,
  							'address3'=>$address3,
  							'post_cd'=>$post_cd,
  							'contact_person'=>$contact_person,
  							'designation'=>$designation,
  							'tel_no'=>$tel_no,
  							'fax_no'=>$fax_no,
  							'hand_phone'=>$hand_phone,
  							'email_addr'=>$email_addr,
  							'income_tax'=>$income_tax,
  							'religion_cd'=>$religion_cd,
  							'nationality'=>$nationality,
  							'marital_status'=>$marital,
                'sex'=>$sex,
                'birth_date'=>$birth_date,
                "audit_user"=>$audit_user,
                "audit_date"=>date("d M Y h:i:s"),
                "statement_type"=>$category,
                "interest"=>"Y",
                "reminder"=>"Y",
                "credit_terms"=>14
  				);
        // var_dump($editdata);
        $table = 'cf_business';
        
  			if ($id=='0')
  			{
  				$this->m_wsbangun->insertData($table,$editdata);
          $this->updatecounter($Number);
          $msg="Data has been saved successfully";
  			} else
  			{
  				$where = array('business_id'=>$bi);
  				$this->m_wsbangun->updateData($table,$editdata,$where);
          $msg="Data has been updated successfully";
  			}
  		}else{
        $msg="Data validation is not valid";
      }
  		// redirect('C_rl_sales_list');
       $msg1=array("Pesan"=>$msg,
                  "id"=>$bi);
            // var $result = new{
            //     Response = $msg;
            // };

        echo json_encode($msg1);
  	} 
//2 Method step booking start  	
public function SaveFromStep()
    {
      if ($_POST) 
      {
        $entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        $audit_user = $this->session->userdata('Tsuname');
        $AutoNumber = $this->m_business->get_autonumber();
        $class =  $this->m_business->zomm_class(); 
        $Number = (int)$AutoNumber[0]->COUNTER;
        $class_cd = $class[0]->class_cd;

        $id = (string)$this->input->POST('id');
        
        
        if($id=='0'){
          $bi=(string)$Number;  
          
        }else{
          $bi=$id;
        }
        $unit_book = $this->input->POST('unit_book',TRUE);
        $ic_no = $this->input->POST('ic_no',TRUE);
        $category = $this->input->POST('category',TRUE);
        $name = $this->input->POST('Name',TRUE);
        $address1 = $this->input->POST('address1',TRUE);
        $address2 = $this->input->POST('address2',TRUE);
        $address3 = $this->input->POST('address3',TRUE);
        $post_cd = $this->input->POST('post_cd',TRUE);
        $contact_person = $this->input->POST('contact_person',TRUE);
        $designation = $this->input->POST('designation',TRUE);
        $tel_no = $this->input->POST('tel_no',TRUE);
        $fax_no = $this->input->POST('fax_no',TRUE);
        $hand_phone = $this->input->POST('hand_phone',TRUE);
        $email_addr = $this->input->POST('email_addr',TRUE);
        $income_tax = $this->input->POST('income_tax',TRUE);
        
        
        
        
        
        if($category=='I'){
          $sex = $this->input->POST('sex',TRUE);
          $religion_cd = $this->input->POST('religion_cd',TRUE);
          $nationality = (string)$this->input->POST('nationality',TRUE); 
          $marital = $this->input->POST('marital_status',TRUE);
          $birth_date  =$this->input->post('birth_date',TRUE);
          $birth_date = date_create($birth_date);
          $birth_date = date_format($birth_date,"Y-d-m H:i:s");
          // $birth_date = date($birth_date);
          // var_dump($birth_date);
          // $birth_date = DateTime::createFromFormat('d/m/Y H:i:s', $birth_date.' 00:00:00');
          // var_dump($birth_date);
          // $birth_date = $birth_date->format('Y-d-m H:i:s');

          // var_dump($birth_date);
          // exit();
        }else{
          $sex= null;
          $religion_cd=null;
          $nationality=null;
          $marital=null;
          $birth_date=null;
        }

        $editdata = array(
                'business_id'=>$bi,
                'ic_no'=>$ic_no,
                'class_cd'=>$class_cd,
                'category'=>$category,
                'name'=>$name,
                'address1'=>$address1,
                'address2'=>$address2,
                'address3'=>$address3,
                'post_cd'=>$post_cd,
                'contact_person'=>$contact_person,
                'designation'=>$designation,
                'tel_no'=>$tel_no,
                'fax_no'=>$fax_no,
                'hand_phone'=>$hand_phone,
                'email_addr'=>$email_addr,
                'income_tax'=>$income_tax,
                'religion_cd'=>$religion_cd,
                'nationality'=>$nationality,
                'marital_status'=>$marital,
                'sex'=>$sex,
                'birth_date'=>$birth_date,
                "audit_user"=>$audit_user,
                "audit_date"=>date("d M Y h:i:s"),
                "statement_type"=>$category,
                "interest"=>"Y",
                "reminder"=>"Y",
                "credit_terms"=>14
          );
        
        

        $table = 'cf_business';
        
        if ($id=='0')
        {
          //looping unit save to rl_sales
        $arr_unit[]='';
            if(!empty($unit_book)){
                $arr_unit=explode(',', $unit_book);
            
                if(!empty($arr_unit)){
                    foreach ($arr_unit as $lot_no) {
                      $result_ = $this->SaveRlSales($lot_no,$bi,$category);
                      if($result_!='OK'){
                        $where = array('entity_cd'=>$entity,
                                        'business_id'=>$bi);
                        $dd = $this->m_wsbangun->deletedata('rl_sales',$where);
                        $msg = 'Fail insert to rl_sales unit :'.$lot_no.' error_sql :'.$result_;
                        $msg1=array("Pesan"=>$msg,
                            "id"=>$bi);
                        echo json_encode($msg1);
                        return; 

                      }

                    }
                }   
            }else{
              $msg1=array("Pesan"=>'Please Back and choose Unit',
                  "id"=>$bi);
              echo json_encode($msg1);
              return;        
            } 
        //end looping
            
          $this->m_wsbangun->insertData($table,$editdata);
          $this->updatecounter($Number);
          $msg="Data has been saved successfully";
        }else{
          $where = array('business_id'=>$bi);
          $this->m_wsbangun->updateData($table,$editdata,$where);
          $msg="Data has been updated successfully";
        } 

      }else{
        $msg="Data validation is not valid";
      }
      // redirect('C_rl_sales_list');
       $msg1=array("Pesan"=>$msg,
                  "id"=>$bi);
         

        echo json_encode($msg1);
    } 
	public function SaveRlSales($unit_book,$business_id,$category){
    $entity = $this->session->userdata('Tsentity');
    $project = $this->session->userdata('Tsproject');
    $webuser = $this->session->userdata('Tsuname');

    $debtor_no='';    
      $table = 'rl_sales';
      $crit = array(
        'lot_no'=>$unit_book,
        'status'=>'T');
      $cnt = $this->m_wsbangun->getCount_by_criteria($table, $crit);
      $debtor_no = ($cnt>0 ? $unit_book.'-'.$cnt : $unit_book);

      $media = $this->m_wsbangun->getData('rl_spec');
      if(!empty($media)){
        $media = $media[0]->media_cd;  
      }else{
        $media = '';
      }

      $table = 'cf_agent_dt';
      $crit = array('userid'=>$webuser,
        'entity_cd'=>$entity);
      $dtAgent = $this->m_wsbangun->getData_by_criteria($table, $crit);
      if(!empty($dtAgent)) {
        $agent_cd = $dtAgent[0]->agent_cd;
      } else {
        $agent_cd = null;
        $error = 'Agent not registered';        
      }

      $data= array(
          "entity_cd"=>$entity,
          "project_no"=>$project,
          "lot_no"=>$unit_book,
          "debtor_acct"=>$debtor_no,
          "business_id"=>$business_id,
          "category"=>$category,
          "media_cd"=>$media,
          "contract_no"=>'-',
          "staff_in_charge"=>$agent_cd,
          "sales_date"=>date("d M Y"),
          "audit_user"=>$webuser,
          "audit_date"=>date("d M Y h:i:s"),
          "lot_rowid"=>0
          );
      $table = 'rl_sales';
      $return = $this->m_wsbangun->insertData($table,$data);

      return $return;
  }

	//end event step booking
}