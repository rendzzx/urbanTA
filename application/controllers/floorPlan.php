<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class FloorPlan extends Core_Controller 
{
               
        public function __construct()
        {
           
            parent::__construct();
            $this->auth_check();/*
            $this->load->helper('form');*/
            $this->load->model('m_floorplan');
            date_default_timezone_set('Asia/Jakarta');
        }

        public function index()
        {       
            $AllData = $this->m_floorplan->GetAllData();
            if(!empty($AllData))
            {
                $ListAllData = '';          
                foreach ($AllData as $value) 
                {
                    $ListAllData .='<tr>';
                    $ListAllData .='<td>'.$value->lot_no.'</td>';/*
                    $ListAllData .='<td>'.$value->level.'</td>';
                    $ListAllData .='<td>'.$value->keterangan.'</td>';*/                
                    $ListAllData .='</tr>';
                }
                
                $ContentAllData = array('florplanlist' => $ListAllData);
            } else
            {           

                $ContentAllData = array('florplanlist' => '');         
            }
            
            $this->load_content('florPlan/floor', $contentALLData);

        }
        public function loadFLoor()
        {
            $data['mgr.pm_lot'] =  $this->m_floorplan->drop(); 
            $this->load_content('florPlan/Floor',$data);
            
        }

        public function editForm($id = null)
        {
            
            /*if(!is_null($id))
            {
                $dataTipe = $this->m_userlevel->get_by_id($id);

                $contentData = array(
                    'dataLevel'=>$dataTipe
                );
                $contentData['tipeusers'] =  $this->m_userlevel->drop();
                $this->load_content('userLevel/userLevelEdit',$contentData);
            } else 
            {
                show_404();
                return;
            }
            */
        }

        public function saveForm()
        {
            /*if($_POST)
            {
                $id=$this->input->post('id');
                $IdTipeUser=$this->input->post('IdTipeUser');
                $level=$this->input->post('level');
                $keterangan=$this->input->post('keterangan');

                $dataTipe = array(
                    "level" => $level,
                    "IdTipeUser" => $IdTipeUser,
                    "keterangan" => $keterangan
                );

                if(!$id)
                {
                    // Insert
                    $this->m_userlevel->insert($dataTipe);
                } else 
                {
                    // edit
                    $where = array('id' => $id);
                    $this->m_userlevel->update($dataTipe, $where);
                }

            }
            redirect('userLevel/index');*/
        }

        public function delete($id)
        {
           /* $where = array("id" => $id);
            $this->m_userlevel->delete($where);
            redirect('userlevel/index');*/
        }
}