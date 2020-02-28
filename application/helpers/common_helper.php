<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

function get_current_date($num = 0) 
{
    $date_str = date('d/m/Y', $num);
    $date_arr = explode("/", $date_str);
    $the_date = mktime(23, 59, 59, (int)$date_arr[1], (int)$date_arr[0], (int)$date_arr[2]);
    return $the_date;
}

function get_status_overtime($num = 0) {
    $status = "";
    if ($num==1) {
    	$status="Waiting";
    }
    elseif ($num==2) {
    	$status="Approve";
    }elseif ($num==3) {
    	$status="Reject";
    }
    
    return $status;
}

function get_status_label($num = 0) 
{
    $status = "";
    if($num==0)
    {
    	$status="Ticket Closed";
    }elseif ($num==1) {
    	$status="Confirm";
    }
    elseif ($num==2) {
    	$status="Work In Progress";
    }elseif ($num==3) {
    	$status="Ticket Open";
    }elseif ($num==4) {
    	$status="Survey";
    }elseif ($num==5) {
    	$status="Assign";
    }
    
    return $status;
}

function get_statusOT($statusid="")
{
	$label = null;
	$status = null;
	switch ($statusid) {
		case 'N':
			$label = "warning";
			$status ="Waiting Approval";
			break;
		case 'Y':
			$label = "success";
			$status ="request Approved";
			break;
		case 'P':
			$label = "info";
			$status ="Process";
			break;		
		case 'X':
			$label = "danger";
			$status ="Canceled";
			break;
		case 'Z':
			$label = "survey";
			$status ="Closed";
			break;
	}
	
	if(!is_null($label)) {
		$rst = array(
			'label'=>$label,
			'status'=>$status
		);
		return $rst;
	} else {
		return null;
	}
}

function get_statusIFCA($statusid="")
{
	$label = null;
	$status = null;
	switch ($statusid) {
		case 'R':
			$status = "Open";
			$label = "info";
			break;
		case 'A':
			$status = "Assign";
			$label = "warning";
			break;
		case 'S';
			$status = "Survey";
			$label = "warning";
			break;
		case 'P':
			$status = "Process";
			$label = "danger";
			break;
		case 'F':
			$status = "Confirm";
			$label = "primary";			
			break;
		case 'Y':
			$status = "Approve";
			$label = "primary";			
			break;
		case 'C':
		case 'Z':
			$status = "Close";
			$label = "success";
			break;
		case 'X':
			$status = "Cancel";
			$label = "default";			
			break;
		case 'M':
			$status = "Modify";
			$label = "primary";			
			break;
	}

	if(!is_null($label)) {
		$rst = array(
			'label'=>$label,
			'status'=>$status
		);
		return $rst;
	} else {
		return null;
	}
}

function get_status($int=null)
{
	$label="";
	if($int!=null)
	{
		if($int == 0)
		{
			$label="success";
		}elseif ($int ==1) 
		{
			$label="warning";
		}elseif ($int==2) {
			$label="danger";
		}elseif ($int==3) {
			$label="info";
    	}elseif ($int==4) {
    		$label="survey";
    	}elseif ($int==5) {
    		$label="assign";
		}

	}
	return $label;
}

function curr_format($config = null, $num = 0) {
	if ($num != 0) {
        $num = (int)$num;
		$str_num = (string) $num;
		$str_num_rev = strrev($str_num);
		$str_num_rev_arr = str_split($str_num_rev, 3);
		$str_num_rev_arr_imp = implode(".", $str_num_rev_arr);
		$str_curr = strrev($str_num_rev_arr_imp);
		// return $config->config['currency'] . $str_curr;
		return $str_curr;
	} else {
		// return $config->config['currency'] . $num;
		return $num;
	}
}

function create_paging($controller = null, $config = null, $uri_segment = 0, $current_page = 0, $base_url = "", $total_rows = 0) 
{
	$pg_cfg['base_url'] = $base_url;
	$pg_cfg['total_rows'] = $total_rows;
	if(is_int($config)) {
		$pg_cfg['per_page'] = $config;
	} else {
		$pg_cfg['per_page'] = $config->config['per_page'];
	}
	$pg_cfg['uri_segment'] = $uri_segment;
	$pg_cfg['page'] = $current_page;

	$pg_cfg['last_tag_open']='<li class="paginate_button last " id="example1_last">';
	$pg_cfg['last_tag_close']='</li>';

	$pg_cfg['prev_tag_open']='<li class="paginate_button previous " id="example1_previous">';
    $pg_cfg['prev_tag_close']='</li>';
	$pg_cfg['first_tag_open'] = '<div>';

	$pg_cfg['first_link'] = 'First';
	$pg_cfg['last_link'] = 'Last';
	$pg_cfg['prev_link'] = 'Previous';
	$pg_cfg['next_link'] = 'Next';

	$pg_cfg['first_tag_open'] = '<li class="paginate_button next" id="example1_next">';
	$pg_cfg['first_tag_close'] = '</li>';

    $pg_cfg['next_tag_open'] = '<li class="paginate_button next" id="example1_next">';
	$pg_cfg['next_tag_close'] = '</li>';

	$pg_cfg['full_tag_open'] = '<div class="dataTables_paginate paging_simple_numbers" id="example1_paginate"><ul class="pagination">';
	$pg_cfg['full_tag_close'] = '</ul></div>';

	$pg_cfg['cur_tag_open'] = '<li class="paginate_button active"><a href="#" aria-controls="example1" data-dt-idx="1" tabindex="0">';
	$pg_cfg['cur_tag_close'] = '</a></li>';
	$pg_cfg['num_tag_open'] = '<li class="paginate_button">';
	$pg_cfg['num_tag_close'] = '</li>';

	$controller->pagination->initialize($pg_cfg);

	return $controller->pagination->create_links();
}

function amountinWords($num)
{
	$angka = array('', 'Satu', 'Dua', 'Tiga', 'Empat', 'Lima', 'Enam', 'Tujuh', 'Delapan', 'Sembilan', 'Sepuluh', 'Sebelas');
	$num = (float)$num;
	if($num < 12) {
		return $angka[$num];
	} else if($num < 20) {
		return amountinWords($num - 10). " Belas";
	} else if($num < 100) {
		return amountinWords($num / 10). " Puluh".amountinWords($num % 10);
	} else if($num < 200) {
		return " Seratus ". amountinWords($num - 100);
	} else if($num < 1000) {
		return amountinWords($num / 100). " Ratus". amountinWords($num % 100);
	} else if($num < 2000) {
		return " Seribu ". amountinWords($num - 1000);
	} else if($num < 1000000) {
		return amountinWords($num / 1000). " Ribu". amountinWords($num % 1000);
	} else if($num < 1000000000) {
		return amountinWords($num / 1000000). " Juta". amountinWords($num % 1000000);
	} else if($num < 1000000000000) {
		return amountinWords($num / 1000000000). " Miliar". amountinWords($num % 1000000000);
	} else {
		return amountinWords($num / 1000000000000). " Trilyun". amountinWords($num % 1000000000000);
	}
}

function pdfGen($html, $filename, $paper = 'A4', $orientation = 'portrait')
{
	if(!empty($html)&& !empty($filename))
	{
		require_once(APPPATH . 'third_party/dompdf/dompdf_config.inc.php');
		// use Dompdf\Dompdf;
		$dompdf = new Dompdf();
		$dompdf->load_html($html);
		$dompdf->set_paper($paper, $orientation);
		$dompdf->render();
		$dompdf->stream($filename.'.pdf', array("Attachment"=>0));
	}
	
}

function pdfGenMail($html, $filename, $paper = 'A4', $orientation = 'portrait')
{
	if(!empty($html)&& !empty($filename))
	{
		require_once(APPPATH . 'third_party/dompdf/dompdf_config.inc.php');
		// use Dompdf\Dompdf;
		$dompdf = new Dompdf();
		$dompdf->load_html($html);
		$dompdf->set_paper($paper, $orientation);
		$dompdf->render();
		// $dompdf->stream($filename.'.pdf', array("Attachment"=>0));
		$output = $dompdf->output();
		// $output = $dompdf->stream($filename.'.pdf');
		return $output;
	}
	
}

function prep_pdf($orientation = 'portrait')
{
    $CI =& get_instance();

    $CI->cezpdf->selectFont(base_url() . '/fonts');

    $all = $CI->cezpdf->openObject();
    $CI->cezpdf->saveState();
    $CI->cezpdf->setStrokeColor(0,0,0,1);
    if($orientation == 'portrait') {
        $CI->cezpdf->ezSetMargins(50,70,50,50);
        $CI->cezpdf->ezStartPageNumbers(500,28,8,'','{PAGENUM}',1);
        $CI->cezpdf->line(20,40,578,40);
        $CI->cezpdf->addText(50,32,8,'Printed on ' . date('m/d/Y h:i:s a'));
    }
    else {
        $CI->cezpdf->ezStartPageNumbers(750,28,8,'','{PAGENUM}',1);
        $CI->cezpdf->line(20,40,800,40);
        $CI->cezpdf->addText(50,32,8,'Printed on '.date('m/d/Y h:i:s a'));
    }
    $CI->cezpdf->restoreState();
    $CI->cezpdf->closeObject();
    $CI->cezpdf->addObject($all,'all');
}

function add_user_log($desc="", $user="", $activities="")
{
    $time = time();
    $record = array(
		'act_id' => $activities->act_id,
		'ref_id' => $user->user_id,
		'log_stamp' => $time,
		'user_log_desc' => $activities->act_desc. ' ' .$desc,
	    );
	    return $record;
}

function yes_no($num = -1) {
    if ($num == 1) {
        return 'Ya';
    } else if ($num == 0) {
        return 'Tidak';
    } else if ($num == -1) {
        return 'Menunggu';
    }
}

function limitWord($str="", $wordLimit = 1) {
	$words = explode(" ", $str);
	return implode(" ", array_slice($words, 0, $wordLimit));
}