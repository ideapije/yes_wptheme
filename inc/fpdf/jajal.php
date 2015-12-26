<?php 
//include 'fpdf.php';
class Wew extends PDF_HTML
	{
		
		function detail($idd){
			
			$this->SetXY(45,20);
			$this->SetLeftMargin(45);
			$this->SetFont('Arial','',10);
			$postt = get_post($id); 
			$title = $postt->post_title;
			$hrg=get_post_meta($idd, "hrg", true);
			$hrgp=get_post_meta($idd, "hrgp", true);
			$jml=get_post_meta($idd, "jml_stock", true);
			$brt=get_post_meta($idd, "brt", true);
			$stock=get_post_meta($idd, "stock", true);
			$this->Cell(100,5,$title,'LBTR',0,'L');$this->Ln();
			$this->Cell(100,5,$hrg,'LBTR',0,'L');$this->Ln();
			$this->Cell(100,5,$hrgp,'LBTR',0,'L');$this->Ln();
			$this->Cell(100,5,$jml,'LBTR',0,'L');$this->Ln();
			$this->Cell(100,5,$brt,'LBTR',0,'L');$this->Ln();
			$this->Cell(100,5,$stock,'LBTR',0,'L');$this->Ln();
			
		}
		function content($idcont){

			$this->SetXY(50,70);
			$this->SetLeftMargin(5);
			$this->SetFont('Arial','',10);
			$postc = get_post($idcont);
			$isi=$postc->post_content;
			$this->WriteHTML($isi);
		}
		function garis($grs){
			$this->SetFont('Arial','B',14);
			$this->SetXY(5,62);
			$this->SetLeftMargin(0);
			$permlink=get_permalink($grs);
			$postct = get_post($grs);
			$this->Line(6, 68, 210-6, 68);
			$this->WriteHTML("Detail Produk <a href='".$permlink."'>".$postct->post_title."</a>");			
		}
		function gambar($img){
			$this->SetXY(5,20);
			$url = wp_get_attachment_url( get_post_thumbnail_id($img) );
			$this->Cell( 40, 40, $this->Image($url, $this->GetX(),$this->GetY(),'PNG', 33.78),'LBTR', 0, 'C', false );
			$this->Ln();
		}


	}
		$toko="JVM STORE";
		$judul="Katalog ".$toko;
		$pdf= new Wew();
		$pdf->SetAutoPageBreak(false);
		$pdf->AddPage('P','A4');
		$pdf->SetFont('Arial','',24);
		$pdf->SetLeftMargin(5);
		$pdf->Cell(0,20,$judul,'0',1,'C');
		$loop = new WP_Query(array('post_type' => 'produks', 'orderby'=> 'ASC')); 
		 while ( $loop->have_posts() ) : $loop->the_post();
		 	$pdf->AddPage('P','A4');
		 	$pdf->gambar($post->ID);
			$pdf->detail($post->ID);
			$pdf->garis($post->ID);
			$pdf->content($post->ID);
		  endwhile; 
		$pdf->Output();
		?>