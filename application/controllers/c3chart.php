<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class C3chart extends Core_Controller
{

    function __construct()
    {
        parent::__construct();
        // $this->load->model('m_login');
        $this->load->model('m_wsbangun');
    }    

	public function Index(){
	    $entity = $this->session->userdata('Tsentity');
        $project_sess = $this->session->userdata('Tsproject');
        $name = $this->session->userdata('Tsuname');
        $entityname = $this->session->userdata('Tsentityname');
        $usergroup = $this->session->userdata('Tsusergroup');
        $sys = $this->session->userdata('Tsysadmin');
        $jsp = 'sss';
        

        

        if(!empty($project)){
            if($project !='null'){
            $param = " where project_no='".$project."' AND entity_cd='".$entity."'";
            }
        }else{
                $project=$project_sess;
            }

        $param = " where project_no='".$project."' AND entity_cd='".$entity."'";

        // $sql = "SELECT * from mgr.v_sales_summary_group_by_product_list  $param  ORDER BY product_cd"; 
        // $dt1 = $this->m_wsbangun->getData_by_query($sql);
        // $bb = 'APT';
        // $apt = array_filter($dt1,function($a) use($bb) {
                        
        //                 return $a->product_cd === $bb;

        //             });
        // $Lnd = array_filter($dt1,function($a)  {
                        
        //                 return $a->product_cd === 'LND';

        //             });
        // $jdata1= '';
        // $jcolor= '';
        // $jjum1= '';
        // foreach ($apt as $key => $row) {
        //     $p1 = '["'.$row->status_descs.'",'.$row->amount.']';
        //     //set colour
        //     $cl='';
        //     if($row->STATUS=='A'){
        //         $cl ='"#80d82d"';
        //     }else if($row->STATUS=='B'){
        //         $cl ='"#e82020"';
        //     }else if($row->STATUS=='H'){
        //         $cl ='"#2fb4ed"';
        //     }else if($row->STATUS=='R'){
        //         $cl ='"#ff6b0f"';
        //     }
        //     $c1 = $row->status_descs.' : '.$cl;
        //     $jdata1.= $p1.',';
        //     $jcolor.= $c1.',';
        // }
        // $jdata1=substr($jdata1,0,-1);
        // $jcolor=substr($jcolor,0,-1);

        // $pie1 = '';
        // $pie1.='var chart1 = c3.generate({bindto: "#charts",data: {';
        // $pie1.='         columns: [ '.$jdata1.'], ';
        // $pie1.='         type : "pie",        ';
        // $pie1.='         colors :{'.$jcolor.'}         ';
        // $pie1.='     }, ';
        // $pie1.='     tooltip: { ';
        // $pie1.='         format: { ';
        // // $pie1.='             // title: function (d) { return 'Data ' + d; }, ';
        // $pie1.='             value: function (value, ratio, id) { ';
        // $pie1.='                 return formatNumber(value); ';
        // $pie1.='             } ';
        // $pie1.='         } ';
        // $pie1.='     } ';
        // $pie1.=' });';

        // var_dump($pie1);
        $selectSql = ' ';
        $selectSql  .= ' select entity_cd,     fyear,      aperiod,        month_name = mgr.fn_month_name(aperiod),';
        $selectSql .= ' inc_amt = sum(income_amt),      inc_bgt = sum(income_budget),       exp_amt = sum(expense_amt),';
        $selectSql .= ' exp_bgt = sum(expense_budget) from mgr.v_gl_profit_loss_dtl ';
        $selectSql .= " WHERE entity_cd='".$entity."' AND fyear = '2015'  AND div_cd = '1000' AND dept_cd ='1000' ";
        $selectSql .= ' group by entity_cd,     fyear,      aperiod';
        // var_dump($selectSql);
        // $selectSql = 'select * from mgr.v_gl_profit_loss_dtl ';
        $dt1 = $this->m_wsbangun->getData_by_query($selectSql);
        // $dt1 = $this->m_wsbangun->getData_by_query($selectSql);
        // var_dump($dt1);
        $InVSEx ='';
        if(!empty($dt1)){
            $income_amt ='';//"['Income Amount',";
            $income_budget ='';//"['Income Budget,'";
            $expense_amt ='';// "['Expance Amount',";
            $expense_budget ='';//"['Expance Budget',";
            $label = '';
            foreach ($dt1 as $key => $row) {
                $income_amt .= $income_amt.' '.$row->inc_amt.',';
                $income_budget .= $income_budget.' '.$row->inc_bgt.',';

                $expense_amt .= $expense_amt.' '.$row->exp_amt.',';
                $expense_budget .= $expense_budget.' '.$row->exp_bgt.',';

                $label .= "'".$row->month_name."',";
            }
            $income_amt=substr($income_amt,0,-1);
            $income_budget=substr($income_budget,0,-1);

            $expense_amt=substr($expense_amt,0,-1);
            $expense_budget=substr($expense_budget,0,-1);

            $label=substr($label,0,-1);
            
          $InVSEx .='  var BarInVeX = c3.generate({ ';
          $InVSEx .=" bindto: '#puppa',";
          $InVSEx .=" data: { type: 'bar', x: 'x',";
          $InVSEx .=" columns:[ ['x',".$label."],['Income Amount',".$income_amt."],";
          $InVSEx .=" ['Income Budget', ".$income_budget."],";
          $InVSEx .=" ['Expanse Amount', ".$expense_amt."],";
          $InVSEx .=" ['Expanse Budget', ".$expense_budget."]],";
          $InVSEx .=" groups: [['Income Amount', 'Income Budget'],";
          $InVSEx .="         ['Expanse Amount', 'Expanse Budget']]},";
          $InVSEx .="    axis: {x: {    ";
          $InVSEx .="           type: 'category',   ";
          $InVSEx .="           tick: { ";
          $InVSEx .="               ";
          $InVSEx .="               multiline: false    ";
          $InVSEx .="               }, ";
          $InVSEx .="           height: 130 ";
          $InVSEx .="           }, ";
          $InVSEx .="           y :{tick:{format : d3.format(',')}}}, ";
          $InVSEx .="           tooltip: {  ";
          $InVSEx .="           format: {  ";
          $InVSEx .="           title: function (d) { ";
          $InVSEx .="                return 'Data ' + d;  ";
          $InVSEx .="            }  ";
          $InVSEx .="           , value: function (value, ratio, id) { ";
          $InVSEx .="                var format=d3.format(','); ";
          $InVSEx .="                return format(value); ";
          $InVSEx .="           } ";
                                            // value: d3.format(',') // apply this format to both y and y2
          $InVSEx .="        } ";
          $InVSEx .="      } ";
          $InVSEx .="    }); ";
        }
// var_dump($InVSEx);
         $ContentAllData = array('IncomeVSExpanse'=>$InVSEx,                            
                                'data_project'=>$this->project_list($project)
                                );
         $this->load_content_mgm('dash/tes',$ContentAllData);
        // $this->load_content_top_menu('dash/tes',$ContentAllData);
	}
    public function teslogin(){
        $this->load_content_top_menu('dash/tes');
    }
    
     public function project_list($project=''){
         $table = "SELECT * from mgr.pl_project (nolock) ";
        // var_dump($table);
        $proDescs = $this->m_wsbangun->getData_by_query($table);
        // var_dump($project);
        $comboProject[]='';
            if(!empty($proDescs)) {
                $comboProject[] = '<option></option>';
                 // $comboProject[] = '<option value="1"></option>';
                foreach ($proDescs as $dtProject) {

                  if($project === $dtProject->project_no) {
                    // var_dump($project.' -- '.$dtProject->project_no);
                    $pilih = ' selected = "1"';
                  } else {
                    $pilih = '';
                  }
                    $comboProject[] = '<option '.$pilih.' value="'.$dtProject->project_no.'">'.$dtProject->descs.'</option>';
                }
                $comboProject = implode("", $comboProject);
            }
            return $comboProject;
    }
   
}
