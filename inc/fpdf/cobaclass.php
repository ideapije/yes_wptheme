<?php
/**
* 
*/
class PDF_coba extends FPDF
{
	function addjvm(){
		$x1  = 30;
		$y1  = 20;
		$this->SetXY($x1,$y1);
		$this->Image(get_template_directory().'/inc/fpdf/jvm.jpg',38,4,160,14);
	}
}
?>