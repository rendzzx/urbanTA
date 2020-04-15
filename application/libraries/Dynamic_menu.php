<?php
class Dynamic_menu {

    private $ci; // for CodeIgniter Super Global Reference.
    private $id_menu        = 'id="menu"';    
    private $class_menu     = 'class="nav-label"';
    private $class_parent   = 'class="nav-label"';
    private $class_last     = 'class="last"';
    private $li_class       = 'class="dropdown"';
    private $ul_class       = 'class="dropdown-menu"';

    function __construct(){
        $this->ci =& get_instance();    // get a reference to CodeIgniter.
    }

    function build_menu($active = null, $usergroup = null){      
        $table = "select ROW_NUMBER() OVER (ORDER BY parent_seq, child_seq, v_sysMenuGroup.MenuID ASC) AS [row_number], ";
        $table .= " * from v_sysMenuGroup";
        $table .= " where GroupCd ='$usergroup' ";
        $table .= " order by parent_seq, child_seq";

        $menu = array();
        $query = $this->ci->db->query($table);
        if ($query->num_rows() > 0){
            foreach ($query->result() as $row){
                $menu[$row->row_number]['MenuID']       = $row->MenuID;
                $menu[$row->row_number]['Title']        = $row->Title;
                $menu[$row->row_number]['URL']          = $row->URL;
                $menu[$row->row_number]['ParentMenuID'] = $row->ParentMenuID;
                $menu[$row->row_number]['IconClass']    = $row->IconClass;
                $menu[$row->row_number]['Is_parent']    = $row->Is_parent;
                $menu[$row->row_number]['PARENT_SEQ']    = $row->PARENT_SEQ;
            }
        }
        $query->free_result(); // The $query result object will no longer be available

        $flag = false;
        $parentId = 0;
        $parentId2 = 0;
        $parentId3 = 0;

        for($j=1; $j<=count($menu);$j++){
            if($menu[$j]['URL']==$active){
                $parentId = $menu[$j]['ParentMenuID'];
            }
        }
        
        if($parentId != 0){
            for($j=1; $j<=count($menu);$j++){
                if($parentId==$menu[$j]['MenuID']){
                    $parentId2 = $menu[$j]['ParentMenuID'];
                }
            }

            if($parentId2 !=0){
                for($j=1; $j<=count($menu);$j++){
                    if($parentId2==$menu[$j]['MenuID']){
                        $parentId3 = $menu[$j]['ParentMenuID'];
                    }
                }
            }   

        }
        $html_out  = '';                        
        // loop through the $menu array() and build the parent menus.
        for ($i = 1; $i <= count($menu); $i++){
            if (is_array($menu[$i])){ // must be by construction but let's keep the errors home
                if ($menu[$i]['ParentMenuID'] == 0){ // are we allowed to see this menu?
                    if ($menu[$i]['Is_parent'] == TRUE){
                        if ($menu[$i]['MenuID'] == $parentId || $menu[$i]['MenuID'] == $parentId2 || $menu[$i]['MenuID'] == $parentId3){
                            $html_out .= "\t\t\t".'<li class="active dropdown nav-item"><a href="#" class="dropdown-toggle nav-link"><i class="'.$menu[$i]['IconClass'].'"></i><span>'.$menu[$i]['Title'].'</span></a>';
                        }
                        else{
                            $html_out .= "\t\t\t".'<li class="dropdown nav-item"><a href="#" class="dropdown-toggle nav-link"><i class="'.$menu[$i]['IconClass'].'"></i><span>'.$menu[$i]['Title'].'</span></a>';
                        }
                    }
                    else{
                        if($menu[$i]['URL'] == $active || $menu[$i]['MenuID'] == $parentId2){
                            $html_out .= "\t\t\t\t".'<li class="nav-item active"><a href="'.base_url().$menu[$i]['URL'].'" class="nav-link"><i class="'.$menu[$i]['IconClass'].'"></i><span>'.$menu[$i]['Title'].'</span></a>';
                        }
                        else{
                            $html_out .= "\t\t\t\t".'<li class="nav-item"><a href="'.base_url().$menu[$i]['URL'].'" class="nav-link"><i class="'.$menu[$i]['IconClass'].'"></i><span>'.$menu[$i]['Title'].'</span></a>';
                        }
                    }
                    // loop through and build all the child submenus.
                    $MenuID = $menu[$i]['MenuID'];
                    $html_out .= $this->get_childs($menu, $MenuID, $active);
                    $html_out .= '</li>'."\n";
                }
            }
            else{
                exit (sprintf('menu nr %s must be an array', $i));
            }
        }
        return $html_out;
    }
    
    function get_childs($menu, $ParentMenuID, $active){
        $has_subcats = FALSE;
        $html_out  = '';
        $html_out .= "\t\t\t\t\t".'<ul class="dropdown-menu">'."\n".'<div class="arrow_box">'."\n";
        $parentId = 0;
        $parentId2 = 0;
        $parentId3 = 0;

        for($j=1; $j<=count($menu);$j++){
            if($menu[$j]['URL']==$active){
                $parentId = $menu[$j]['ParentMenuID'];
            }
        }

        if($parentId != 0){
            for($j=1; $j<=count($menu);$j++){
                if($parentId==$menu[$j]['MenuID']){
                    $parentId2 = $menu[$j]['ParentMenuID'];
                }
            }   
            if($parentId2 !=0){
                for($j=1; $j<=count($menu);$j++){
                    if($parentId2==$menu[$j]['MenuID']){
                        $parentId3 = $menu[$j]['ParentMenuID'];
                    }
                }                
            }
        }

        for ($i = 1; $i <= count($menu); $i++){
            $uri = $menu[$i]['URL'];
            $site_url = is_array($uri) ? site_url($uri) : (preg_match('#^(\w+:)?//#i', $uri) ? $uri : site_url($uri));
            if ($menu[$i]['ParentMenuID'] == $ParentMenuID){ // are we allowed to see this menu?
                $has_subcats = TRUE;
                if ($menu[$i]['Is_parent'] == TRUE){ 
                    if($menu[$i]['URL'] == $active || ($menu[$i]['Is_parent'] == TRUE && $menu[$i]['PARENT_SEQ'] == 1000 && 
                        $menu[$i]['MenuID'] == $parentId ) || ($menu[$i]['Is_parent'] == TRUE && $menu[$i]['PARENT_SEQ'] == 1000 && 
                        $menu[$i]['MenuID']==$parentId) ){
                        $html_out .= "\t\t\t\t\t\t".'<li class="active dropdown dropdown-submenu"><a href="'.base_url().'#"  class="dropdown-item dropdown-toggle" data-toggle="dropdown"><span>'.$menu[$i]['Title'].'</span></a>';
                    }
                    else{
                       $html_out .= "\t\t\t\t\t\t".'<li class="dropdown dropdown-submenu"><a href="'.base_url().'#"  class="dropdown-item dropdown-toggle" data-toggle="dropdown"><span>'.$menu[$i]['Title'].' </span></a>'; 
                    }
                }
                else{
                    if($menu[$i]['URL'] == $active){
                        $subparentid = $menu[$i]['ParentMenuID'];
                        $html_out .= "\t\t\t\t\t\t".'<li class="active" data-menu=""><a href="'.$site_url.'" class="dropdown-item"><span>'.$menu[$i]['Title'].'</span></a>';
                    }
                    else{
                        $html_out .= "\t\t\t\t\t\t".'<li data-menu=""><a href="'.$site_url.'" class="dropdown-item"><span>'.$menu[$i]['Title'].' </span></a>';
                    }
                }
                // Recurse call to get more child submenus.
                $html_out .= $this->get_childs($menu, $menu[$i]['MenuID'], $active);
                $html_out .= '</li>' . "\n";
            }
        }
        $html_out .= "\t\t\t\t\t".'</div></ul>' . "\n";
        return ($has_subcats) ? $html_out : FALSE;
    }
}