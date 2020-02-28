<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Attachment extends Core_Controller
{
	public function __construct()
    {
        parent::__construct();
        $this->auth_check();
		$this->load->model('m_wsbangun');
    }

    public function addNew($prj='')
    {
        if(!empty($prj))
        {
            $content = array('project'=>$prj);
            $this->load->view('attachment/addnew',$content);
        } else {
            show_404();
            return;
        }
    }
    
    public function remove()
    {
        $id = $this->input->post("id",true);
        if(empty($id)){
            $msg = "Data is not successfully deleted";
        } else {
            $where = array('rowID'=>$id);
            $data = $this->m_wsbangun->deletedata('rl_project_file', $where);
            $msg = "Data has been deleted successfully";
        }
        $output = array("Pesan"=>$msg);
        echo json_encode($output);
    }

    public function getTable()
    {
        $project = $this->input->post('project', true);
        $entity = $this->session->userdata('Tsentity');
        $DB2 = $this->load->database('ifca', true);
        $this->load->library('Datatables');

        $aField = array('file_name');
        $aColumns  = array('row_number', 'file_name');

        $iDisplayStart = (int)$this->input->get_post('start', true);
        $iDisplayLength = (int)$this->input->get_post('length', true);
        $order = (int)$this->input->get_post('order', true);
        $draw = (int)$this->input->get_post('draw', true);
        $sSearch = $this->input->get_post('search', true);
        // paging
        if(isset($iDisplayStart) && $iDisplayLength != '-1')
        {
            $DB2->limit($DB2->escape_str($iDisplayLength), $DB2->escape_str($iDisplayStart));
        }
        // Ordering
        if(isset($iSortCol_0))
        {
            for($i=0; $i<intval($iSortingCols); $i++)
            {
                $iSortCol = $this->input->get_post('iSortCol_'.$i, true);
                $bSortable = $this->input->get_post('bSortable_'.intval($iSortCol), true);
                $sSortDir = $this->input->get_post('sSortDir_'.$i, true);
    
                if($bSortable == 'true')
                {
                    $DB2->order_by($aColumns[intval($DB2->escape_str($iSortCol))], $DB2->escape_str($sSortDir));
                }
            }
        }
        // filter
        if(isset($sSearch) && !empty($sSearch))
        {
            for($i=0; $i<count($aColumns); $i++)
            {
                $bSearchable = $this->input->get_post('bSearchable_'.$i, true);
                
                // Individual column filtering
                if(isset($bSearchable) && $bSearchable == 'true')
                {
                    $DB2->or_like($aColumns[$i], $DB2->escape_like_str($sSearch));
                }
            }
        }

        $startRow = (int)($iDisplayStart+1);
        $endRow   = (int)($iDisplayStart+$iDisplayLength);
        $sql_data ='WITH result_set AS ( ';
        $sql_data.=' SELECT ';
        $sql_data.=' ROW_NUMBER() OVER (ORDER BY '.$aColumns[1].') AS [row_number], ';        
        $sql_data.=' * FROM mgr.rl_project_file with(nolock) ';
        $sql_data.=" Where entity_cd='".$entity."' AND project_no= '".$project."'" ;
        $sql_data.= ')';           
        $sql_data.=' SELECT * FROM result_set Where [row_number] BETWEEN '.$startRow.' AND '.$endRow ;

        // select data
        $rResult = $DB2->query($sql_data);

        // Total data set length
        $where = array('entity_cd'=>$entity,
            'project_no'=>$project);
        $cnt = $this->m_wsbangun->getCount_by_criteria("rl_project_file(nolock)", $where);
        $iTotal = $cnt;

        // output
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

    public function prj($project = '')
    {
        if(empty($project))
        {
            show_404();
            return;
        }
        $name = $this->session->userdata('Tsuname');
        $admin = $this->session->userdata('Tsysadmin');
        $entity = $this->session->userdata('Tsentity');
        // $project = 'GK01';
        // var_dump($entity);
        // var_dump($project);
        $table = 'pl_project(nolock)';
        $crit = array('entity_cd'=>$entity,
            'project_no'=>$project);
        $dtPrj = $this->m_wsbangun->getData_by_criteria($table, $crit);
        if(!empty($dtPrj))
        {
            $prjdesc = $dtPrj[0]->descs;
            $logo = $dtPrj[0]->picture_path;
            $nupMenu = $dtPrj[0]->nup_menu;
            $bookingMenu = $dtPrj[0]->booking_menu;

            $content = array('leftdyn'=>$name,
                'sys'=>$admin,
                'approver'=>0,
                'prj'=>$prjdesc,
                'logo'=>$logo,
                'project'=>$project,
                'nup_menu'=>$nupMenu,
                'booking_menu'=>$bookingMenu
                );
            
            $this->load_content('attachment/entry', $content);
            // $this->load->view('attachment/entry',$content);            
        } 
        // redirect('attachment/entry');

        // else {
        //     show_404();
        //     return;
        // }
        
    }

    private function setUploadOptions()
    {
        $config = array('upload_path'=>'./img/PlProject',
            'allowed_types'=>'jpg|png|pdf',
            'max_size'=>'10000',
            // 'max_width'=>'400',
            'overwrite'=>FALSE
            );
        return $config;
    }    

    public function saveBrochure()
    {
        if($_POST)
        {
            $webuser = $this->session->userdata('Tsuname');
            $entity = $this->session->userdata('Tsentity');
            $project = $this->input->post('project', TRUE);
            $today = date('d M Y H:i:s');

            $sql = "SELECT max(file_no) as cn FROM mgr.rl_project_file WHERE entity_cd='$entity' AND project_no='$project'";
            $dtMax = $this->m_wsbangun->getData_by_query($sql);
            $maxFileNo = (int) $dtMax[0]->cn + 1;

            $this->load->library('upload');
            $files = $_FILES;
            $cnt = count($_FILES['userfile']['name']);
            for ($i=0; $i < $cnt; $i++) 
            { 
                $picname = str_replace(' ', '_', $files['userfile']['name'][$i]);
                $_FILES['userfile']['name'] = $picname;
                $_FILES['userfile']['type']= $files['userfile']['type'][$i];
                $_FILES['userfile']['tmp_name']= $files['userfile']['tmp_name'][$i];
                $_FILES['userfile']['error']= $files['userfile']['error'][$i];
                $_FILES['userfile']['size']= $files['userfile']['size'][$i];

                $this->upload->initialize($this->setUploadOptions());
                // $this->upload->do_upload();
                if(!$this->upload->do_upload()) 
                { 
                    $data['error'] = $this->upload->display_errors();
                    // var_dump("ERROR");
                    // var_dump($data);
                    return $data;
                } else {
                    // $data = $this->upload->data();
                    // var_dump("SAVE");                    
                    $fileNo = $maxFileNo + $i;
                    $table = 'rl_project_file';

                    $dtEntry = array('entity_cd'=>$entity,
                        'project_no'=>$project,
                        'file_no'=>$fileNo,
                        'file_name'=>$picname,
                        'audit_user'=>$webuser,
                        'audit_date'=>$today
                    );
                    $this->m_wsbangun->insertData($table, $dtEntry);

                }
            }

        } else {
            show_404();
            return;
        }
        redirect('attachment/prj/'.$project);
    }

    public function saveLogo()
    {
        if($_POST)
        {
            // if(!empty($_FILES)) {
            //     $picture = $_FILES["picture"];
            // }
            $entity = $this->session->userdata('Tsentity');
            $project = $this->input->post('project', TRUE);
            $nup = $this->input->post('nup', TRUE);
            $booking = $this->input->post('booking', TRUE);

            if (!isset($nup)) $nup = 0;
            if (!isset($booking)) $booking = 0;


            $table1 = 'pl_project';
            $crit1 = array('entity_cd'=>$entity,
                    'project_no'=>$project);
            $savedata1 = array('nup_menu'=>$nup,
                    'booking_menu'=>$booking);
            $this->m_wsbangun->updateData($table1, $savedata1, $crit1);

            $picture = !empty($_FILES) ? $picture = $_FILES["picture"] : '';
            if(!empty($picture["name"]))
            {
                $picname = str_replace(' ', '_', $picture["name"]);
                $picture = $_FILES["picture"];
                $psn='';
                
                // var_dump(strlen($picture));
                // var_dump($picture["name"]);
                $picture = array_filter($picture);

                $target_dir = "./img/PlProject/";
                $target_file = $target_dir . basename($_FILES["picture"]["name"]);
                $uploadOk = 1;
                $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
                // Check if image file is a actual image or fake image
                if(isset($_POST["submit"])) {
                    $check = getimagesize($_FILES["picture"]["tmp_name"]);
                    if($check !== false) {
                        $msg = "File is an image - " . $check["mime"] . ".";
                        $uploadOk = 1;
                    } else {
                        $msg = "File is not an image.";
                        $uploadOk = 0;
                    }
                }
                // Check if file already exists
                if (file_exists($target_file)) {
                    $msg = "Sorry, file already exists.";
                    $uploadOk = 0;
                    $psn='failed';
                        // return;
                        $msg=array("pesan"=>$msg,"status"=>$psn);                           

                        echo json_encode($msg);
                        exit();
                }
                // Check file size
                if ($_FILES["picture"]["size"] > 500000) {
                    $msg = "Sorry, your file is too large.";
                    $uploadOk = 0;
                }
                // Allow certain file formats
                if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif" ) {
                    $msg = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                    $uploadOk = 0;
                }
                // Check if $uploadOk is set to 0 by an error
                if ($uploadOk == 0) {
                    $msg = "Sorry, your file was not uploaded.";
                // if everything is ok, try to upload file
                } else {
                    if (move_uploaded_file($_FILES["picture"]["tmp_name"], $target_file)) {
                        $msg = "The file ". basename( $_FILES["picture"]["name"]). " has been uploaded.";
                    } else {
                        $msg = "Sorry, there was an error uploading your file.";
                    }
                }
                // var_dump('INSERT');
                // $config['upload_path'] = './img/PlProject/';
                // $config['allowed_types'] = 'gif|jpg|png|jpeg';
                // $config['max_size'] = '1024';
                // $config['max_width'] = '1024';
                
                // // $picname = 'img/PlProject/'.$picture["name"];
                // $data['upload_data'] = '';
                // $this->load->library('upload', $config);

                // if(!$this->upload->do_upload("picture")) 
                // { 
                //     // $data['error'] = $this->upload->display_errors();
                //     // var_dump("ERROR");
                //     // var_dump($data);
                //     // return;
                //     $msg = $this->upload->display_errors();
                // } else {
                //     $data = $this->upload->data();
                //     // var_dump("SAVE");
                // }
                
                $savedata = array('picture_path'=>$picname,
                    'nup_menu'=>$nup,
                    'booking_menu'=>$booking);

            } else {
                // var_dump("EMPTY");
                // $msg = "File not uploaded";
                $savedata = array(
                    'nup_menu'=>$nup,
                    'booking_menu'=>$booking);
            }

            $table = 'pl_project';
            $crit = array('entity_cd'=>$entity,
                'project_no'=>$project);
            $this->m_wsbangun->updateData($table, $savedata, $crit);
            $msg = "file has been saved successfully";
            // redirect('attachment/prj/'.$project);
            $res = array('pesan'=>$msg);
            echo json_encode($res);
        }
    }
}