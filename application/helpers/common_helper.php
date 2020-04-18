<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

	function makeID($fields="", $table="", $inisial=""){
		$CI =& get_instance();
		$query = $CI->db->query("SELECT MAX($fields) as max from ".$table);
		$result = current($query->result());

		//set tanggal
	   	$datenow = date("dmy");
			
	    $number = 0;
	    $imax = 6;	
	    $tmp = "";
	    
	    if ($result->max !='') {
	        $tgl = substr($result->max,3); // HAPUS INISIAL
	        $tgl = substr($tgl,0,-4); // COUNT ANKA SETELAH TANGGAL

	        if($tgl != $datenow){
	            $number = 0;
	        }
	        else{
	            $number = substr($result->max, -3);
	        }
	    }

	    $number++;
	    $number = strval($number);
	    for ($i=0; $i <=($imax-strlen($inisial)-strlen($number)) ; $i++) { 
	        $tmp = $tmp."0";
	    }
		return $inisial.$datenow.$tmp.$number;
	}

	function makeID_api($t, $fields="", $table="", $inisial=""){
		$CI =& get_instance();
		$query = $CI->db->query("SELECT MAX($fields) as max from ".$table);
		$result = current($query->result());

		//set tanggal
		$t = date_create($t);
	   	$datenow = date_format($t, "dmy");
			
	    $number = 0;
	    $imax = 6;	
	    $tmp = "";
	    
	    if ($result->max !='') {
	        $tgl = substr($result->max,3); // HAPUS INISIAL
	        $tgl = substr($tgl,0,-4); // COUNT ANKA SETELAH TANGGAL

	        if($tgl != $datenow){
	            $number = 0;
	        }
	        else{
	            $number = substr($result->max, -3);
	        }
	    }

	    $number++;
	    $number = strval($number);
	    for ($i=0; $i <=($imax-strlen($inisial)-strlen($number)) ; $i++) { 
	        $tmp = $tmp."0";
	    }
		return $inisial.$datenow.$tmp.$number;
	}

	function randomName() {
	    $firstname = array( 'Johnathon', 'Anthony', 'Erasmo', 'Raleigh', 'Nancie', 'Tama', 'Camellia', 'Augustine', 'Christeen', 'Luz', 'Diego', 'Lyndia', 'Thomas', 'Georgianna', 'Leigha', 'Alejandro', 'Marquis', 'Joan', 'Stephania', 'Elroy', 'Zonia', 'Buffy', 'Sharie', 'Blythe', 'Gaylene', 'Elida', 'Randy', 'Margarete', 'Margarett', 'Dion', 'Tomi', 'Arden', 'Clora', 'Laine', 'Becki', 'Margherita', 'Bong', 'Jeanice', 'Qiana', 'Lawanda', 'Rebecka', 'Maribel', 'Tami', 'Yuri', 'Michele', 'Rubi', 'Larisa', 'Lloyd', 'Tyisha', 'Samatha',
	    );

	    $lastname = array( 'Mischke', 'Serna', 'Pingree', 'Mcnaught', 'Pepper', 'Schildgen', 'Mongold', 'Wrona', 'Geddes', 'Lanz', 'Fetzer', 'Schroeder', 'Block', 'Mayoral', 'Fleishman', 'Roberie', 'Latson', 'Lupo', 'Motsinger', 'Drews', 'Coby', 'Redner', 'Culton', 'Howe', 'Stoval', 'Michaud', 'Mote', 'Menjivar', 'Wiers', 'Paris', 'Grisby', 'Noren', 'Damron', 'Kazmierczak', 'Haslett', 'Guillemette', 'Buresh', 'Center', 'Kucera', 'Catt', 'Badon', 'Grumbles', 'Antes', 'Byron', 'Volkman', 'Klemp', 'Pekar', 'Pecora', 'Schewe', 'Ramage',
	    );

	    $name = $firstname[rand ( 0 , count($firstname) -1)];
	    $name .= ' ';
	    $name .= $lastname[rand ( 0 , count($lastname) -1)];

	    return $name;
	}

	function randomNumber($value){
		for ($randomNumber = mt_rand(1, 9), $i = 1; $i < $value; $i++) {
		    $randomNumber .= mt_rand(0, 9);
		}
		return $randomNumber;
	}

	function countDayOfMonth(){
		$list=array();
	    $month = date("m");
	    $year = date("Y");

	    for($d=1; $d<=31; $d++){
	        $time = mktime(12, 0, 0, $month, $d, $year);          
	        if (date('m', $time) == $month)       
	            $list[] = $d;
	        // date('Y-m-d-D', $time);
	    }

	    return $list;
	}

	function amountinWords($num){
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

	function pdfGen($html, $filename, $paper = 'A4', $orientation = 'portrait'){
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

	function pdfGenMail($html, $filename, $paper = 'A4', $orientation = 'portrait'){
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

	function prep_pdf($orientation = 'portrait'){
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
?>