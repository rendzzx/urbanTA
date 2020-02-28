<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_nup_listing extends Core_Controller {
	
	public function __construct(){ 
		parent::__construct();
		$this->auth_check();
		// $this->load->model('m_rl_sales_list');
		$this->load->model('m_wsbangun');
		$this->load->model('m_sms');
		$this->load->model('m_business');
	}
	public function index() {
		$entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        $name = $this->session->userdata('Tsuname');
        $group = $this->session->userdata('Tsusergroup');
		$projectName = $this->session->userdata('Tsprojectname');

		$userid = $this->session->userdata('Tsname');
        $sql = "SELECT distinct entity_cd,project_no,project_descs,db_profile from mgr.v_cfs_login_user with (nolock) where userid='$userid'";
        $proDescs = $this->m_wsbangun->getData_by_query_cons('ifca3',$sql);
        
            if(!empty($proDescs)) {
                $comboProject[] = '<option></option>';
                foreach ($proDescs as $dtProject) {
                  if($project === $dtProject->project_no) {
                    $pilih = ' selected = "1"';
                    $entity = $dtProject->entity_cd;
                    $project = $dtProject->project_no;
                    $cons = $dtProject->db_profile;
                  } else {
                    $pilih = '';
                  }
                    $comboProject[] = '<option '.$pilih.' value="'.$dtProject->project_no.'" data-cons="'.$dtProject->db_profile.'" >'.$dtProject->project_descs.'</option>';
                }
                $comboProject = implode("", $comboProject);
            }

		$ContentAllData = array(
				'isi_table'=>$this->datatable(null),
				'nama_project'=>$this->get_nama(null),
    			'project_no'=>$project,
				'ProjectDescs'=>$projectName,
				'comboProject'=>$comboProject				
             );
		
		
		
        $this->load_content_top_menu('nup_listing/reportlisting2',$ContentAllData);
           
	}
	public function indexnew() {
		$userid = $this->session->userdata('Tsname');
        $sql = "SELECT distinct project_no,descs from mgr.v_cfs_login_user (nolock) where userid= '$userid'";
        $data_project = $this->m_wsbangun->getData_by_query_cons('ifca3',$sql);
		$projectName = $this->session->userdata('Tsprojectname');
		$entity = $this->session->userdata('Tsentity');
		// var_dump($entity);exit;	
		// $project_no = $this->input->post('project_no',TRUE);
		// var_dump($aa);
		
  	 		$aa = NULL;
  	 		$bb = NULL;
			// $listunitgroup3 = $this->datatable($aa);
			$content =array('isi_table'=>$this->datatable($aa),
							 'nama_project'=>$this->get_nama($bb), 
							'ProjectDescs'=>$projectName,
							'project'=>$data_project);
	        $this->load_content_top_menu('nup_listing/reportlisting2',$content);
	        	        
    }
    function create_pdf(){
    	$projectName = $this->session->userdata('Tsprojectname');
		$entity = $this->session->userdata('Tsentity');	
		// $project_no = $this->input->post('project_no',TRUE);
		// var_dump($aa);
		$project_no = $this->session->userdata('Tsproject');
		// var_dump($project_no);
		$sql = "select * from mgr.v_listing_nup where entity_cd ='".$entity."' and project_no='".$project_no."' order by lead_cd,group_cd,nup_type";
        $nup_listing = $this->m_wsbangun->getData_by_query($sql);
        // $lead_cd[]=null;
        $msg ='Fail';
        if(!empty($nup_listing)){
        	foreach ($nup_listing as $key ) {        		
        		$lead_distinct[]=$key->lead_cd;
        		$group_distinct[]=$key->group_cd;
        		$nup_distinct[]=$key->nup_type;   
        	}
      
        	
        	$lead_cd = array_unique($lead_distinct);
        	$group_cd = array_unique($group_distinct);
			$nup_type = array_unique($nup_distinct);
        	
        	$listlead ='';
        	$listunitgroup3 = '';
        	foreach ($lead_cd as $key ) {//looping Lead_cd (grouping report 1)
        		$bb = $key;
        		
        		$DataFilLead = array_filter($nup_listing,function($a) use($bb) {
                        
                        return $a->lead_cd === $bb;
                    });
        		$listunitgroup3 .= '<tr><td colspan="9" class="space"></td></tr>';
        		if(!empty($DataFilLead))
        		{
        			$sql = "select distinct lead_name from mgr.v_listing_nup where lead_cd = '".$key."' and entity_cd='".$entity."' and project_no='".$project_no."'";
        			
        			$lead_name = $this->m_wsbangun->getData_by_query($sql);

        			$lead_name = $lead_name[0]->lead_name;
	        		$listunitgroup3 .= '<tr>';
	        		$listunitgroup3 .= '<td class="tblbordered">Lead</td>';
	        		$listunitgroup3 .= '<td colspan="8" class="tblbordered"> : '.$key.' - '.$lead_name.'</td>';
	        		$listunitgroup3 .= '</tr>';

        			foreach ($group_cd as $key2) {//looping group_cd (grouping report 2)
        				
	        			$DataFilLeadGroup = array_filter($DataFilLead,function($a) use($key2) {
	                        
	                        return $a->group_cd === $key2;
	                    });

	                    if(!empty($DataFilLeadGroup)){
	                    	$sql = "select distinct group_name from mgr.v_listing_nup where group_cd = '".$key2."' and entity_cd='".$entity."' and project_no='".$project_no."'";        			
		        			$group_name = $this->m_wsbangun->getData_by_query($sql);
		        			$group_name = $group_name[0]->group_name;


	                    	$listunitgroup3 .= '<tr>';
			        		$listunitgroup3 .= '<td class="tblbordered">Principal</td>';
			        		$listunitgroup3 .= '<td colspan="8" class="tblbordered"> : '.$key2.' - '.$group_name.'</td>';
			        		$listunitgroup3 .= '</tr>';
	                    	foreach ($nup_type as $key3) {//nup_type group_cd (grouping report 3)
	                    		
				                   	$DataFilLeadGroupNup = array_filter($DataFilLeadGroup,function($a) use($key3) {
				                        
				                        return $a->nup_type === $key3;
				                    });

				                    if(!empty($DataFilLeadGroupNup)){
				                    	$sql = "select distinct nup_desc from mgr.v_listing_nup where nup_type ='".$key3."' and group_cd = '".$key2."' and entity_cd='".$entity."' and project_no='".$project_no."'";        			
					        			$nup_desc = $this->m_wsbangun->getData_by_query($sql);
					        			$nup_desc = $nup_desc[0]->nup_desc;

				                    	$listunitgroup3 .= '<tr>';
						        		$listunitgroup3 .= '<td class="tblbordered">Nup Type</td>';
						        		$listunitgroup3 .= '<td colspan="8" class="tblbordered"> : '.$key3.' - '.$nup_desc.'</td>';
						        		$listunitgroup3 .= '</tr>';
						        		$listunitgroup3 .= '<tr><td colspan="9" class="space"></td></tr>';
				                    	// $listunitgroup3 .= '<br>';
				                    	// $listunitgroup3 .= '<thread>';
				                    	$listunitgroup3 .= '<tr>';
						        		$listunitgroup3 .= '<td class="colheader">No</td>';
						        		$listunitgroup3 .= '<td class="colheader">Agent Name</td>';
						        		$listunitgroup3 .= '<td class="colheader">Group Name</td>';
						        		$listunitgroup3 .= '<td class="colheader">Nup Description</td>';
						        		$listunitgroup3 .= '<td class="colheader">Nup Date</td>';
						        		$listunitgroup3 .= '<td class="colheader">Customer Name</td>';
						        		$listunitgroup3 .= '<td class="colheader">NUP No</td>';
						        		$listunitgroup3 .= '<td class="colheader">NUP Amt</td>';
						        		$listunitgroup3 .= '<td class="colheader">Status</td>';
						        		$listunitgroup3 .= '</tr>';
						        		// $listunitgroup3 .= '</thread>';
				                    	$i=1;
				                    	foreach ($DataFilLeadGroupNup as $data ) {
				                    		//detail list nup
				                    		// $listunitgroup3 .= '<tbody>';
				                    		$listunitgroup3 .= '<tr>';
				                    		$listunitgroup3 .= '<td class="tblbordered">'.$i.'</td>';
				                    		$listunitgroup3 .= '<td class="tblbordered">'.$data->agent_name.'</td>';
				                    		$listunitgroup3 .= '<td class="tblbordered">'.$data->group_name.'</td>';
				                    		$listunitgroup3 .= '<td class="tblbordered">'.$data->nup_desc.'</td>';
				                    		$listunitgroup3 .= '<td class="tblbordered">'.$data->reserve_date.'</td>';
				                    		$listunitgroup3 .= '<td class="tblbordered">'.$data->name.'</td>';
				                    		$listunitgroup3 .= '<td class="tblbordered">'.$data->nup_no.'</td>';
				                    		$listunitgroup3 .= '<td class="tblbordered">'.number_format($data->nup_amt,2).'</td>';
				                    		$listunitgroup3 .= '<td class="tblbordered">'.$data->status_desc.'</td>';
				                    		$listunitgroup3 .= '</tr>';
				                    		// $listunitgroup3 .= '</tbody>';
				                    		$i++;
				                    		$totalamt[] = $data->nup_amt;
				                    		$amt[] = $data->nup_amt;

				                    	}
				                    	// $listunitgroup3 .= '<tfoot>';
				                    	$listunitgroup3 .= '<tr>';
				                    	$listunitgroup3 .= '<td colspan="7" class="tblbordered">Total Per Nup Type : '.$key3.' - '.$nup_desc.'</td>';
				                    	$listunitgroup3 .= '<td colspan="2" class="tblbordered">'.number_format(array_sum($amt),2).'</td>';
				                    	// reset($amt);
				                    	$amt_group[] = array_sum($amt);
				                    	$amt =array();
				                    	$listunitgroup3 .= '</tr>';
				                    	// $listunitgroup3 .= '</tfoot>';
				                    	
				                    }
			                }//End nup_type group_cd (grouping report 3)
			                   $listunitgroup3 .= '<tr>';
				               $listunitgroup3 .= '<td colspan="7" class="tblbordered">Total Per Group cd : '.$key2.' - '.$group_name.'</td>';
				               $listunitgroup3 .= '<td colspan="2" class="tblbordered">'.number_format(array_sum($amt_group),2).'</td>';
				               $amt_lead[] = array_sum($amt_group);
				               $amt_group =array();
				               $listunitgroup3 .= '</tr>';
				               // $listunitgroup3 .= '<tr><td colspan="9"></td></tr>';
				               //      	$listunitgroup3 .= '<tr><td colspan="9"></td></tr>';
	                    }
        			}// End looping group_cd (grouping report 2)
        				$listunitgroup3 .= '<tr>';
				    	$listunitgroup3 .= '<td colspan="7" class="tblbordered">Total Per Lead cd : '.$key.' - '.$lead_name.'</td>';
				        $listunitgroup3 .= '<td colspan="2" class="tblbordered">'.number_format(array_sum($amt_lead),2).'</td>';
				        $amt_lead =array();
				        $listunitgroup3 .= '</tr>';
				        // $listunitgroup3 .= '<tr><td colspan="9"></td></tr>';
				        // $listunitgroup3 .= '<tr><td colspan="9"></td></tr>';
        		}
        	} //End looping Lead_cd (grouping report 1)
        	 $listunitgroup3 .= '<tr>';
				    	$listunitgroup3 .= '<td colspan="7" class="tblbordered">Grand total </td>';
				        $listunitgroup3 .= '<td colspan="2" class="tblbordered">'.number_format(array_sum($totalamt),2).'</td>';
				        // $amt_lead =array();
				        $listunitgroup3 .= '</tr>';
				        $listunitgroup3 .= '<tr><td colspan="9"></td></tr>';
				        $listunitgroup3 .= '<tr><td colspan="9"></td></tr>';

			$content =array('isi_table'=>$listunitgroup3, 'projectName'=>$projectName);
	        // $this->load->view('nup_listing/reportlisting',$content);
	        // $html = $this->load->view('nup_listing/reportlisting',$content,true);
	        $pdf = 'NUPListing_'.$project_no;
	        $filename = 'pdf/Reports/'.$pdf.'.pdf';
	   
	        // unlink($filename);
			$html = $this->load->view('nup_listing/reportlisting',$content,true);
			$a = pdfGenMail($html, $pdf, "A4", "landscape");
			// pdfGen($html, $pdf, "A4", "landscape");
	            // var_dump($a);exit();
	            
	            // $pdfName = $nupno.'.pdf';
            file_put_contents($filename, $a);	
            $msg ='sukses';        
        }
        
        
		echo $msg;
	}
	

	function goto_table(){
        $project_no = $this->input->post('project_no',TRUE);
     
        
        $data = array('isi_table'=> $this->datatable($project_no),
        	'nama_project'=>$this->get_nama($project_no));
        $this->load->view('nup_listing/reportlisting_load',$data);
    }
    public function get_nama($project_no=''){
    	$ProjectDescs = '';
    	if(!empty($project_no)){
    		$where=array('project_no'=>$project_no);
        	$data = $this->m_wsbangun->getData_by_criteria_cons('ifca3',"pl_project",$where);
        	$ProjectDescs = $data[0]->descs;
        } else {
        	$ProjectDescs='';
        }
        return $ProjectDescs;
    }
    public function zoom_lead(){
        if($_POST)
        {
   			$project_no=$this->input->post('projectNo',true);
        	$sql = "select entity_cd from mgr.pl_project where project_no='".$project_no."'";
			$data = $this->m_wsbangun->getData_by_query($sql);
			$entity = $data[0]->entity_cd;
            
            if(empty($entity)) {
                echo('<option></option>');
            } else {
                $sql2="select distinct lead_cd,lead_name from mgr.v_listing_nup where entity_cd ='".$entity."' and project_no='".$project_no."'";
                $ProjectData = $this->m_wsbangun->getData_by_query($sql2);
                $listProject = '';
                if(!empty($ProjectData)) {
                    $listProject = '<option value="all"></option>';
                    $listProject .= '<option value="all"> All </option>';
                    foreach ($ProjectData as $project) {
                                   
                        $listProject.='<option value="'.$project->lead_cd.'">'.$project->lead_name.'</option>';
                    }
                }
                echo($listProject);
            }
        }
    }
    public function zoom_principal(){
        if($_POST)
        {
   			$project_no=$this->input->post('projectNo',true);
        	$sql = "select entity_cd from mgr.pl_project where project_no='".$project_no."'";
			$data = $this->m_wsbangun->getData_by_query($sql);
			$entity = $data[0]->entity_cd;
            
            if(empty($entity)) {
                echo('<option></option>');
            } else {
                $sql2="select distinct group_cd,group_name from mgr.v_listing_nup where entity_cd ='".$entity."' and project_no='".$project_no."'";
                $ProjectData = $this->m_wsbangun->getData_by_query($sql2);
                $listProject = '';
                if(!empty($ProjectData)) {
                    $listProject = '<option value="all"></option>';
                    $listProject .= '<option value="all"> All </option>';
                    foreach ($ProjectData as $project) {
                                   
                        $listProject.='<option value="'.$project->group_cd.'">'.$project->group_name.'</option>';
                    }
                }
                echo($listProject);
            }
        }
    }
    public function zoom_nuptype(){
        if($_POST)
        {
   			$project_no=$this->input->post('projectNo',true);
        	$sql = "select entity_cd from mgr.pl_project where project_no='".$project_no."'";
			$data = $this->m_wsbangun->getData_by_query($sql);
			$entity = $data[0]->entity_cd;
            
            if(empty($entity)) {
                echo('<option></option>');
            } else {
                $sql2="select distinct nup_type,nup_desc from mgr.v_listing_nup where entity_cd ='".$entity."' and project_no='".$project_no."'";
                $ProjectData = $this->m_wsbangun->getData_by_query($sql2);
                $listProject = '';
                if(!empty($ProjectData)) {
                    $listProject = '<option value="all"></option>';
                    $listProject .= '<option value="all"> All </option>';
                    foreach ($ProjectData as $project) {
                                   
                        $listProject.='<option value="'.$project->nup_type.'">'.$project->nup_type.' - '.$project->nup_desc.'</option>';
                    }
                }
                echo($listProject);
            }
        }
    }
	public function datatable($project_no=''){
		if(!empty($project_no)){
			$sql = "SELECT entity_cd = max(entity_cd),cons = max(db_profile) from mgr.pl_project where project_no='".$project_no."'";
			$data = $this->m_wsbangun->getData_by_query_cons('ifca3',$sql);
			$entity = $data[0]->entity_cd;
			$cons = $data[0]->cons;

			$sql = "SELECT * from mgr.v_listing_nup where entity_cd ='".$entity."' and project_no='".$project_no."' order by lead_cd,group_cd,nup_type";
			
			// var_dump($sql.' --- '.$aa);
			$nup_listing = $this->m_wsbangun->getData_by_query_cons($cons,$sql);
			// $lead_cd[]=null;
			$msg ='Fail';$listlead ='';
				$listunitgroup3 = '';
			if(!empty($nup_listing)){
				foreach ($nup_listing as $key ) {        		
					$lead_distinct[]=$key->lead_cd;  
					$group_distinct[]=$key->group_cd; 
					$nup_distinct[]=$key->nup_type;     		        	
					// $lead_distinct[]['lead_name']=$key->lead_name;   
					// var_dump($lead_cd);
				}
			
				$lead_cd = array_unique($lead_distinct);
				$group_cd = array_unique($group_distinct);
				$nup_type = array_unique($nup_distinct);
				
				
				foreach ($lead_cd as $key ) {//looping Lead_cd (grouping report 1)
					$bb = $key;
					
					$DataFilLead = array_filter($nup_listing,function($a) use($bb) {
							
							return $a->lead_cd === $bb;
						});
					
					$listunitgroup3 .= '<tr><td colspan="9" class="space"></td></tr>';
	        		if(!empty($DataFilLead))
	        		{
	        			$sql = "SELECT distinct lead_name from mgr.v_listing_nup where lead_cd = '".$key."' and entity_cd='".$entity."' and project_no='".$project_no."'";
	        			
	        			$lead_name = $this->m_wsbangun->getData_by_query_cons($cons,$sql);

	        			$lead_name = $lead_name[0]->lead_name;
		        		$listunitgroup3 .= '<tr style="color:black; font-weight:bold;">';
		        		$listunitgroup3 .= '<td class="tblbordered">Lead</td>';
		        		$listunitgroup3 .= '<td colspan="8" class="tblbordered"> : '.$key.' - '.$lead_name.'</td>';
		        		$listunitgroup3 .= '</tr>';

	        			foreach ($group_cd as $key2) {//looping group_cd (grouping report 2)
	        				
		        			$DataFilLeadGroup = array_filter($DataFilLead,function($a) use($key2) {
		                        
		                        return $a->group_cd === $key2;
		                    });

		                    if(!empty($DataFilLeadGroup)){
		                    	$sql = "SELECT distinct group_name from mgr.v_listing_nup where group_cd = '".$key2."' and entity_cd='".$entity."' and project_no='".$project_no."'";        			
			        			$group_name = $this->m_wsbangun->getData_by_query_cons($cons,$sql);
			        			$group_name = $group_name[0]->group_name;

			        			$listunitgroup3 .= '<tr><td colspan="9" class="space"></td></tr>';
		                    	$listunitgroup3 .= '<tr style="color:#0d2a59;font-weight:bold;">';
				        		$listunitgroup3 .= '<td class="tblbordered">Principal</td>';
				        		$listunitgroup3 .= '<td colspan="8" class="tblbordered"> : '.$key2.' - '.$group_name.'</td>';
				        		$listunitgroup3 .= '</tr>';
		                    	foreach ($nup_type as $key3) {//nup_type group_cd (grouping report 3)
		                    		
					                   	$DataFilLeadGroupNup = array_filter($DataFilLeadGroup,function($a) use($key3) {
					                        
					                        return $a->nup_type === $key3;
					                    });

					                    if(!empty($DataFilLeadGroupNup)){
					                    	$sql = "SELECT distinct nup_desc from mgr.v_listing_nup where nup_type ='".$key3."' and group_cd = '".$key2."' and entity_cd='".$entity."' and project_no='".$project_no."'";        			
						        			$nup_desc = $this->m_wsbangun->getData_by_query_cons($cons,$sql);
						        			$nup_desc = $nup_desc[0]->nup_desc;

						        			$listunitgroup3 .= '<tr><td colspan="9" class="space"></td></tr>';
					                    	$listunitgroup3 .= '<tr>';
							        		$listunitgroup3 .= '<td class="tblbordered">Nup Type</td>';
							        		$listunitgroup3 .= '<td colspan="8" class="tblbordered"> : '.$key3.' - '.$nup_desc.'</td>';
							        		$listunitgroup3 .= '</tr>';
							        		$listunitgroup3 .= '<tr><td colspan="9" class="space"></td></tr>';
					                    	// $listunitgroup3 .= '<br>';
					                    	$listunitgroup3 .= '<tr>';
							        		$listunitgroup3 .= '<td class="colheader">No</td>';
							        		$listunitgroup3 .= '<td class="colheader">Agent Name</td>';
							        		$listunitgroup3 .= '<td class="colheader">Group Name</td>';
							        		$listunitgroup3 .= '<td class="colheader">Nup Description</td>';
							        		$listunitgroup3 .= '<td class="colheader">Nup Date</td>';
							        		$listunitgroup3 .= '<td class="colheader">Customer Name</td>';
							        		$listunitgroup3 .= '<td class="colheader">NUP No</td>';
							        		$listunitgroup3 .= '<td class="colheader">NUP Amt</td>';
							        		$listunitgroup3 .= '<td class="colheader">Status</td>';
							        		$listunitgroup3 .= '</tr>';
					                    	$i=1;
					                    	foreach ($DataFilLeadGroupNup as $data ) {
					                    		//detail list nup
					                    		$listunitgroup3 .= '<tr>';
					                    		$listunitgroup3 .= '<td class="tblbordered">'.$i.'</td>';
					                    		$listunitgroup3 .= '<td class="tblbordered">'.$data->agent_name.'</td>';
					                    		$listunitgroup3 .= '<td class="tblbordered">'.$data->group_name.'</td>';
					                    		$listunitgroup3 .= '<td class="tblbordered">'.$data->nup_desc.'</td>';
					                    		$listunitgroup3 .= '<td class="tblbordered">'.$data->reserve_date.'</td>';
					                    		$listunitgroup3 .= '<td class="tblbordered">'.$data->name.'</td>';
					                    		$listunitgroup3 .= '<td class="tblbordered">'.$data->nup_no.'</td>';
					                    		$listunitgroup3 .= '<td class="tblbordered">'.number_format($data->nup_amt,2).'</td>';
					                    		$listunitgroup3 .= '<td class="tblbordered">'.$data->status_desc.'</td>';
					                    		$listunitgroup3 .= '</tr>';
					                    		$i++;
					                    		$totalamt[] = $data->nup_amt;
					                    		$amt[] = $data->nup_amt;

					                    	}
					                    	$listunitgroup3 .= '<tr>';
					                    	$listunitgroup3 .= '<td colspan="7" class="tblbordered">Total Per Nup Type : '.$key3.' - '.$nup_desc.'</td>';
					                    	$listunitgroup3 .= '<td colspan="2" class="tblbordered">'.number_format(array_sum($amt),2).'</td>';
					                    	// reset($amt);
					                    	$amt_group[] = array_sum($amt);
					                    	$amt =array();
					                    	$listunitgroup3 .= '</tr>';
					                    	
					                    }
				                   }//End nup_type group_cd (grouping report 3)
				                   $listunitgroup3 .= '<tr style="color:#0d2a59;font-weight:bold;">';
					               $listunitgroup3 .= '<td colspan="7" class="tblbordered">Total Per Group cd : '.$key2.' - '.$group_name.'</td>';
					               $listunitgroup3 .= '<td colspan="2" class="tblbordered">'.number_format(array_sum($amt_group),2).'</td>';
					               $amt_lead[] = array_sum($amt_group);
					               $amt_group =array();
					               $listunitgroup3 .= '</tr>';
					              
		                    }
	        			}// End looping group_cd (grouping report 2)
	        				$listunitgroup3 .= '<tr style="color:black; font-weight:bold;">';
					    	$listunitgroup3 .= '<td colspan="7" class="tblbordered">Total Per Lead cd : '.$key.' - '.$lead_name.'</td>';
					        $listunitgroup3 .= '<td colspan="2" class="tblbordered">'.number_format(array_sum($amt_lead),2).'</td>';
					        $amt_lead =array();
					        $listunitgroup3 .= '</tr>';
	        		}
	        	 } //End looping Lead_cd (grouping report 1)
			        	 $listunitgroup3 .= '<tr>';
							    	$listunitgroup3 .= '<td colspan="7" class="tblbordered">Grand total </td>';
							        $listunitgroup3 .= '<td colspan="2" class="tblbordered">'.number_format(array_sum($totalamt),2).'</td>';
					        // $amt_lead =array();
					        $listunitgroup3 .= '</tr>';
					        $listunitgroup3 .= '<tr><td colspan="9"></td></tr>';
					        $listunitgroup3 .= '<tr><td colspan="9"></td></tr>';

						
						$msg ='sukses';        
			}
		}else{
			$listunitgroup3 = '';
		}
		return $listunitgroup3;
		
	}
	function createpdf(){
	
			$project_no = $this->input->post('project_no',TRUE);
			// var_dump($lead_cd."--".$group_cd."--".$nup_type."--".$project_no);
			$msg = "fail";
			if(!empty($project_no)){
				// var_dump( $this->datatable($project_no));exit();
				if(!empty($this->datatable($project_no))){
					$data = array('isi_table'=> $this->datatable($project_no),'nama_project'=>$this->get_nama($project_no));
				
		            $pdf = 'NUPListing_'.$project_no;
			        $filename = 'pdf/Reports/'.$pdf.'.pdf';

			   		
					$html = $this->load->view('nup_listing/pdf_report',$data,true);
					var_dump($html);
					$a = pdfGenMail($html, $pdf, "A4", "landscape");
					// pdfGen($html, $pdf, "A4", "landscape");
			            // var_dump($a);exit();
			            
			            // $pdfName = $nupno.'.pdf';
		            file_put_contents($filename, $a);
		            $msg ='OK'; 	
				}else{
					$msg = 'fail';
				}
	        	
	            
			}
			// $data = array('isi_table'=> $this->datatable(210101),'nama_project'=>$this->get_nama(210101));
			// $this->load->view('nup_listing/pdf_report',$data);
			echo $msg;
			

	}
	public function download($filename = NULL) 
    {	

    	
    	$this->load->helper('download');
        // read file contents
        $data = file_get_contents(base_url('/pdf/Reports/'.$filename));
        // var_dump($data);
        force_download($filename, $data);
    	
        // load download helder
        
    }
	

	
}
?>