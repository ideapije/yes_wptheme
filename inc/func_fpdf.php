<?php	
/**
	* 
	*/
	class wew extends FPDF
	{
		
		function detail(){
			$pdf->SetXY(40,5);
			$pdf->SetFont('Arial','',8);
			$args = array(
				'post_type'=> 'produks',
				'order'    => 'ASC',
				'post_status'=>'publish'
			);
			$myposts = get_posts( $args );
			foreach( $myposts as $post ) : setup_postdata( $post );
				$pdf->Cell(100,5,$post->post_title,'LBTR',0,'L');
				$stock=get_post_meta($post->ID, "stock", true);
				$pdf->Cell(50,5,$stock,'LBTR',0,'C');
				$pdf->Ln();
			endforeach; 
			wp_reset_postdata(); 
			$pdf->Output();
		}
	}

?>