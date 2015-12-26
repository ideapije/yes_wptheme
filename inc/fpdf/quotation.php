<?php


// Ayunidha Ashriaherty 2004
// Version 1.00

  //////////////////////////////////////
 //      Index Public functions      //
//////////////////////////////////////

// function RoundedRect
// function _Arc
// function Rotate
// function _endpage
// function sizeOfText

class PDF_Quotation extends FPDF
{
// private variables
var $colonnes;
var $format;
var $angle=0;

// private functions
function RoundedRect($x, $y, $w, $h, $r, $style = '')
{
	$k = $this->k;
	$hp = $this->h;
	if($style=='F')
		$op='f';
	elseif($style=='FD' || $style=='DF')
		$op='B';
	else
		$op='S';
	$MyArc = 4/3 * (sqrt(2) - 1);
	$this->_out(sprintf('%.2F %.2F m',($x+$r)*$k,($hp-$y)*$k ));
	$xc = $x+$w-$r ;
	$yc = $y+$r;
	$this->_out(sprintf('%.2F %.2F l', $xc*$k,($hp-$y)*$k ));

	$this->_Arc($xc + $r*$MyArc, $yc - $r, $xc + $r, $yc - $r*$MyArc, $xc + $r, $yc);
	$xc = $x+$w-$r ;
	$yc = $y+$h-$r;
	$this->_out(sprintf('%.2F %.2F l',($x+$w)*$k,($hp-$yc)*$k));
	$this->_Arc($xc + $r, $yc + $r*$MyArc, $xc + $r*$MyArc, $yc + $r, $xc, $yc + $r);
	$xc = $x+$r ;
	$yc = $y+$h-$r;
	$this->_out(sprintf('%.2F %.2F l',$xc*$k,($hp-($y+$h))*$k));
	$this->_Arc($xc - $r*$MyArc, $yc + $r, $xc - $r, $yc + $r*$MyArc, $xc - $r, $yc);
	$xc = $x+$r ;
	$yc = $y+$r;
	$this->_out(sprintf('%.2F %.2F l',($x)*$k,($hp-$yc)*$k ));
	$this->_Arc($xc - $r, $yc - $r*$MyArc, $xc - $r*$MyArc, $yc - $r, $xc, $yc - $r);
	$this->_out($op);
}

function _Arc($x1, $y1, $x2, $y2, $x3, $y3)
{
	$h = $this->h;
	$this->_out(sprintf('%.2F %.2F %.2F %.2F %.2F %.2F c ', $x1*$this->k, ($h-$y1)*$this->k,
						$x2*$this->k, ($h-$y2)*$this->k, $x3*$this->k, ($h-$y3)*$this->k));
}

function Rotate($angle, $x=-1, $y=-1)
{
	if($x==-1)
		$x=$this->x;
	if($y==-1)
		$y=$this->y;
	if($this->angle!=0)
		$this->_out('Q');
	$this->angle=$angle;
	if($angle!=0)
	{
		$angle*=M_PI/180;
		$c=cos($angle);
		$s=sin($angle);
		$cx=$x*$this->k;
		$cy=($this->h-$y)*$this->k;
		$this->_out(sprintf('q %.5F %.5F %.5F %.5F %.2F %.2F cm 1 0 0 1 %.2F %.2F cm',$c,$s,-$s,$c,$cx,$cy,-$cx,-$cy));
	}
}

function _endpage()
{
	if($this->angle!=0)
	{
		$this->angle=0;
		$this->_out('Q');
	}
	parent::_endpage();
}

// public functions
function sizeOfText( $texte, $largeur )
{
	$index    = 0;
	$nb_lines = 0;
	$loop     = TRUE;
	while ( $loop )
	{
		$pos = strpos($texte, "\n");
		if (!$pos)
		{
			$loop  = FALSE;
			$ligne = $texte;
		}
		else
		{
			$ligne  = substr( $texte, $index, $pos);
			$texte = substr( $texte, $pos+1 );
		}
		$length = floor( $this->GetStringWidth( $ligne ) );
		$res = 1 + floor( $length / $largeur) ;
		$nb_lines += $res;
	}
	return $nb_lines;
}


// tulisan invoice pojok kanan atas
function fact_dev( $libelle, $num )
{
    $r1  = $this->w - 201;
    $r2  = $r1 + 80;
    $y1  = 55;
    $y2  = $y1 + 2;
    $mid = ($r1 + $r2 ) / 2;
    
    $texte  = $libelle;    
    $szfont = 20;
    $loop   = 0;
    
    while ( $loop == 0 )
    {
       $this->SetFont( "Arial", "B", $szfont );
       $sz = $this->GetStringWidth( $texte );
       if ( ($r1+$sz) > $r2 )
          $szfont --;
       else
          $loop ++;
    }

   
   
    $this->SetXY( $r1+1, $y1+2);
    $this->SetTextColor(0,0, 0);
    $this->Cell($r2-$r1 -1,5, $texte, 0, 0, "L" );
    $this->Line(10,38,200,38);
	$this->Line(10,38.2,200,38.2);
	$this->Line(10,38.3,200,38.3);
	$this->Line(10,38.4,200,38.4);
	$this->Line(10,39.5,200,39.5);
}


//logo
function addlogo( $stat )
{
	$x1  = 10;
	$y1  = 20;
	$this->SetXY($x1,$y1);
	$this->Image(get_template_directory().'/inc/fpdf/ajav.jpg',11,8,25.5,25.5);

}
function addjvm()
{
	$x1  = 30;
	$y1  = 20;
	$this->SetXY($x1,$y1);
	$this->Image(get_template_directory().'/inc/fpdf/jvm.jpg',38,4,160,14);

}
function descr()
{
    global $title;

    // Arial bold 15
    $this->SetFont('Arial','B',8.5);
    // Calculate width of title and position
    $w = $this->GetStringWidth($title)+90;
    $this->SetXY((170-$w)/2,20);
    // Colors of frame, background and text
    $this->SetFillColor(255,102,0);
    $this->SetTextColor(0,0,0);
    // Thickness of frame (1 mm)
    $this->SetLineWidth(0.5);
    // Title
    $this->Cell(160,5,"General Suplier, Distributor & Representive of Laboratory Environmetal, Medical and Industrial Equipment",1,1,'C',true);
    // Line break
    $this->Ln(10);
}

function addHeadAlamat( $ha )
{
	$r1  = $this->w - 150;
	$r2  = $r1 + 80;
	$y1  = 23;
	$y2  = $y1 ;
	$mid = $y1 + ($y2 / 2);
	$this->SetXY( $r1 + ($r2-$r1)/2 - 55, $y1+3 );
	$this->SetFont( "Arial", "", 10);
	$this->Cell(10,5, "Alamat", 0, 0, "C");
	$this->SetXY( $r1 + ($r2-$r1)/2 +20.5, $y1+3 );
	$this->SetFont( "Arial", "", 10);
	$this->Cell(10,5,$ha, 0,0, "C");
}
function addHeadTelp( $ht )
{
	$r1  = $this->w - 150;
	$r2  = $r1 + 82;
	$y1  = 28;
	$y2  = $y1 ;
	$mid = $y1 + ($y2 / 2);
	$this->SetXY( $r1 + ($r2-$r1)/2 - 55, $y1+3 );
	$this->SetFont( "Arial", "", 10);
	$this->Cell(10,5, "Telp / Faks", 0, 0, "C");
	$this->SetXY( $r1 + ($r2-$r1)/2 +20.5, $y1+3 );
	$this->SetFont( "Arial", "", 10);
	$this->Cell(10,5,$ht, 0,0, "C");
}

function addTabelDate( $date )
{
	$r1  = $this->w - 150;
	$r2  = $r1 + 15;
	$y1  = 65;
	$y2  = $y1 ;
	$mid = $y1 + ($y2 / 2);
	$this->SetXY( $r1 + ($r2-$r1)/2 - 55, $y1+3 );
	$this->SetFont( "Arial", "", 8);
	$this->Cell(35,5, "   DATE", 1, 1, "L");
	$this->SetXY( $r1 + ($r2-$r1)/2-20, $y1+3 );
	$this->SetFont( "Arial", "",8);
	$this->Cell(65,5,$date, 1,1, "L");
}
function addTabelAttn( $attn )
{
	$r1  = $this->w - 75;
	$r2  = $r1 + 15;
	$y1  = 65;
	$y2  = $y1 ;
	$mid = $y1 + ($y2 / 2);
	$this->SetXY( $r1 + ($r2-$r1)/2 - 30, $y1+3 );
	$this->SetFont( "Arial", "", 8);
	$this->Cell(25,5, "   Attn", 1, 1, "L");
	$this->SetXY( $r1 + ($r2-$r1)/2-5, $y1+3 );
	$this->SetFont( "Arial", "B",8 );
	$this->Cell(60,5,$attn, 1,1, "L");
}
function addTabelQuNo( $quno )
{
	$r1  = $this->w - 150;
	$r2  = $r1 + 15;
	$y1  = 70;
	$y2  = $y1 ;
	$mid = $y1 + ($y2 / 2);
	$this->SetXY( $r1 + ($r2-$r1)/2 - 55, $y1+3 );
	$this->SetFont( "Arial", "", 8);
	$this->Cell(35,5, "   Quotation No", 1, 1, "L");
	$this->SetXY( $r1 + ($r2-$r1)/2-20, $y1+3 );
	$this->SetFont( "Arial", "",8);
	$this->Cell(65,5,$quno, 1,1, "L");
}
function addTabelCc( $cc )
{
	$r1  = $this->w - 80;
	$r2  = $r1 + 15;
	$y1  = 75;
	$y2  = $y1 ;
	$mid = $y1 + ($y2 / 2);
	$this->SetXY( $r1 + ($r2-$r1)/2 - 25, $y1-2 );
	$this->SetFont( "Arial", "", 8);
	$this->Cell(25,5, "   Cc", 1, 1, "L");
	$this->SetXY( $r1 + ($r2-$r1)/2, $y1-2 );
	$this->SetFont( "Arial", "B",8 );
	$this->Cell(60,5,$cc, 1,1, "L");
}
function addTabelTo( $to )
{
	$r1  = $this->w - 150;
	$r2  = $r1 + 15;
	$y1  = 75;
	$y2  = $y1 ;
	$mid = $y1 + ($y2 / 2);
	$this->SetXY( $r1 + ($r2-$r1)/2 - 55, $y1+3 );
	$this->SetFont( "Arial", "", 8);
	$this->Cell(35,5, "   To", 1, 1, "L");
	$this->SetXY( $r1 + ($r2-$r1)/2-20, $y1+3 );
	$this->SetFont( "Arial", "",8);
	$this->Cell(65,5,$to, 1,1, "L");
}
function addTabelTelp( $bb )
{
	$r1  = $this->w - 80;
	$r2  = $r1 + 15;
	$y1  = 80;
	$y2  = $y1 ;
	$mid = $y1 + ($y2 / 2);
	$this->SetXY( $r1 + ($r2-$r1)/2 - 25, $y1-2 );
	$this->SetFont( "Arial", "", 8);
	$this->Cell(25,5, "   Telp / BB", 1, 1, "L");
	$this->SetXY( $r1 + ($r2-$r1)/2, $y1-2 );
	$this->SetFont( "Arial", "B",8 );
	$this->Cell(60,5,$bb, 1,1, "L");
}
function addTabelAddress( $add )
{
	$r1  = $this->w - 150;
	$r2  = $r1 + 15;
	$y1  = 80;
	$y2  = $y1 ;
	$mid = $y1 + ($y2 / 2);
	$this->SetXY( $r1 + ($r2-$r1)/2 - 55, $y1+3 );
	$this->SetFont( "Arial", "", 8);
	$this->Cell(35,12, "   Address", 1, 1, "L");
	$this->SetXY( $r1 + ($r2-$r1)/2-20, $y1+3 );
	$this->SetFont( "Arial", "",8);
	$this->MultiCell(65,4,$add,1,"L");
}
function addTabelFaks( $faks )
{
	$r1  = $this->w - 80;
	$r2  = $r1 + 15;
	$y1  = 85;
	$y2  = $y1 ;
	$mid = $y1 + ($y2 / 2);
	$this->SetXY( $r1 + ($r2-$r1)/2 - 25, $y1-2 );
	$this->SetFont( "Arial", "", 8);
	$this->Cell(25,5, "   Fax No", 1, 1, "L");
	$this->SetXY( $r1 + ($r2-$r1)/2, $y1-2 );
	$this->SetFont( "Arial", "B",8 );
	$this->Cell(60,5,$faks, 1,1, "L");
}
function addEmail( $email )
{
	$r1  = $this->w - 80;
	$r2  = $r1 + 15;
	$y1  = 90;
	$y2  = $y1 ;
	$mid = $y1 + ($y2 / 2);
	$this->SetXY( $r1 + ($r2-$r1)/2 - 25, $y1-2 );
	$this->SetFont( "Arial", "", 8);
	$this->Cell(25,7, "   Email", 1, 1, "L");
	$this->SetXY( $r1 + ($r2-$r1)/2, $y1-2 );
	$this->SetTextColor(0, 153, 255);
	$this->SetFont( "Arial", "U",8 );
	$this->Cell(60,7,$email, 1,1, "L");
}
function addWeAre()
{
	$x1  = 38;
	$y1  = 100;
	$this->SetXY( $x1, $y1 );
	$this->SetFont('Arial','B',9);
	$this->SetTextColor(0, 0, 0);
	$this->Cell(10,5, "We Are Please To Quote You As Follows", 0, 0, "C");
}

function addQuote()
{
	$this->SetXY(13,110);
	$this->Cell(10,5,'No',1,1,'C');
	$this->SetXY(23,110);
	$this->Cell(25,5,'Model',1,1,'C');
	$this->SetXY(48,110);
	$this->Cell(64,5,'Description of Goods',1,1,'C');
	$this->SetXY(112,110);
	$this->Cell(13,5,'Qty',1,1,'C');
	$this->SetXY(125,110);
	$this->Cell(13,5,'Disc',1,0,'C');
	$this->SetXY(138,110);
	$this->Cell(30,5,'Price',1,1,'C');
	$this->SetXY(168,110);
	$this->Cell(30,5,'Amount',1,0,'C');
}
function addProdSatu($no, $image, $descr, $qty, $disc, $price, $amount)
{
	
	$this->SetXY(13,115);
	$this->SetFont('Arial','B',9);
	$this->Cell(10,5,$no,1,1,'C');
	$id = $_POST['id'];
	$getdata=mysql_query("SELECT model from quot WHERE id = '$_GET[id]'");
	while($data=mysql_fetch_array($getdata))
	{
	$datamodel=explode("|",$data['model']);

	for($i=0;$i<=count($datamodel);$i++) 
	{ 
	$this->SetX(23);
	$this->SetFont('Arial','',9);
	$this->Cell(25,5,$datamodel[$i],1,1,'L'); }
	}
	$getdes=mysql_query("SELECT descr FROM quot WHERE id = '$_GET[id]'");
	while($dataa=mysql_fetch_array($getdes))
	{
	$datadesc=explode("|",$dataa['descr']);

	for($a=0;$a<=count($datadescr);$a++) 
	{ 
	$this->SetXY(48,115);	
	$this->SetFont('Arial','',9);
	$this->Cell(64,5,$datadesc[$a],1,1,'L'); }
	}
	$this->SetXY(112,115);
	$this->SetFont('Arial','B',9);
	$this->Cell(13,5,$qty,1,1,'C');
	$this->SetXY(125,115);
	$this->SetFont('Arial','B',9);
	$this->Cell(13,5,$disc,1,0,'C');
	$this->SetXY(138,115);
	$this->SetFont('Arial','',9);
	$this->Cell(30,5,$price,1,1,'R');
	$this->SetXY(168,115);
	$this->SetFont('Arial','',9);
	$this->Cell(30,5,$amount,1,0,'R');
}

// penambahan produk bisa pake pengulangan yaks biar lbh singkat
function addGrandTotal($no)
{
	$this->SetXY(13,135);
	$this->SetFont('Arial','B',9);
	$this->Cell(155,5,"Grand Total",1,1,'L');
	$this->SetXY(168,135);
	$this->SetFont('Arial','B',9);
	$this->Cell(30,5,$no,1,1,'R');
}
function addExVAT()
{
	$x1  = 13;
	$y1  = 145;
	$this->SetXY( $x1, $y1 );
	$this->SetFont('Arial','',9);
	$this->SetTextColor(0, 0, 0);
	$this->Cell(10,5, "Price Excluding VAT 10%", 0, 0, "L");
}
function addPriceStok()
{
	$x1  = 13;
	$y1  = 150;
	$this->SetXY( $x1, $y1 );
	$this->SetFont('Arial','',9);
	$this->SetTextColor(0, 0, 0);
	$this->Cell(10,5, "Price & Stock may change without prior notice", 0, 0, "L");
}
function addTerm( $term )
{
	$r1  = $this->w - 150;
	$r2  = $r1 + 15;
	$y1  = 155;
	$y2  = $y1 ;
	$mid = $y1 + ($y2 / 2);
	$this->SetXY( $r1 + ($r2-$r1)/2 - 55, $y1+3 );
	$this->SetFont( "Arial", "", 8);
	$this->Cell(55,5, "   Term Payment", 1, 1, "L");
	$this->SetXY( $r1 + ($r2-$r1)/2, $y1+3 );
	$this->SetFont( "Arial", "",8);
	$this->Cell(100,5,$term, 1,1, "L");
}
function addDeliv( $deliv )
{
	$r1  = $this->w - 150;
	$r2  = $r1 + 15;
	$y1  = 160;
	$y2  = $y1 ;
	$mid = $y1 + ($y2 / 2);
	$this->SetXY( $r1 + ($r2-$r1)/2 - 55, $y1+3 );
	$this->SetFont( "Arial", "", 8);
	$this->Cell(55,5, "   Delivery Time", 1, 1, "L");
	$this->SetXY( $r1 + ($r2-$r1)/2, $y1+3 );
	$this->SetFont( "Arial", "",8);
	$this->Cell(100,5,$deliv, 1,1, "L");
}
function addWarranty()
{
	$r1  = $this->w - 150;
	$r2  = $r1 + 15;
	$y1  = 165;
	$y2  = $y1 ;
	$mid = $y1 + ($y2 / 2);
	$this->SetXY( $r1 + ($r2-$r1)/2 - 55, $y1+3 );
	$this->SetFont( "Arial", "", 8);
	$this->Cell(55,10, "   Warranty", 1, 1, "L");
}
function addWarrantyy( $warr )
{
	$r1  = $this->w - 95;
	$r2  = $r1 + 15;
	$y1  = 165;
	$y2  = $y1 ;
	$mid = $y1 + ($y2 / 2);
	$this->SetXY( $r1 + ($r2-$r1)/2 - 55, $y1+3 );
	$this->SetFont( "Arial", "", 8);
	$this->Cell(100,5,$warr, 1, 1, "L");
}
function addWarrantyyy( $warrr )
{
	$r1  = $this->w - 95;
	$r2  = $r1 + 15;
	$y1  = 170;
	$y2  = $y1 ;
	$mid = $y1 + ($y2 / 2);
	$this->SetXY( $r1 + ($r2-$r1)/2 - 55, $y1+3 );
	$this->SetFont( "Arial", "", 8);
	$this->Cell(100,5,$warrr, 1, 1, "L");
}
// bank information
function addBank()
{
	$r1  = $this->w -197;
	$r2  = $r1 + 18;
	$y1  = 180;
	$y2  = $y1 ;
	$this->SetXY( $r1 + ($r2-$r1)/2 - 11, $y1+3 );
	$this->SetFont( "Arial", "BU", 9);
	$this->Cell(10,5, "BANK INFORMATION", 0, 0, "L");
}
function addBCA()
{
	$r1  = $this->w -197;
	$r2  = $r1 + 25;
	$y1  = 185;
	$y2  = $y1 ;
	$this->SetXY( $r1 + ($r2-$r1)/2 - 11, $y1+3 );
	$this->SetFont( "Arial", "B", 9);
	$this->Cell(10,5, "BCA ACCOUNT NUMBER 0461332357 A.N CV. JAVA MULTI MANDIRI KCU PURWOKERTO", 0, 0, "L");
}
function addMDR()
{
	$r1  = $this->w -197;
	$r2  = $r1 + 25;
	$y1  = 189;
	$y2  = $y1 ;
	$this->SetXY( $r1 + ($r2-$r1)/2 - 11, $y1+3 );
	$this->SetFont( "Arial", "B", 9);
	$this->Cell(10,5, "MANDIRI ACCOUNT NUMBER 1390011816315 A.N CV. JAVA MULTI MANDIRI KCU PURWOKERTO", 0, 0, "L");
}
function addBNI()
{
	$r1  = $this->w -197;
	$r2  = $r1 + 25;
	$y1  = 193;
	$y2  = $y1 ;
	$this->SetXY( $r1 + ($r2-$r1)/2 - 11, $y1+3 );
	$this->SetFont( "Arial", "B", 9);
	$this->Cell(10,5, "BNI ACCOUNT NUMBER 0575801234 A.N CV. JAVA MULTI MANDIRI KCU PURWOKERTO", 0, 0, "L");
}
function addThk()
{
	$r1  = $this->w -197;
	$r2  = $r1 + 300;
	$y1  = 210;
	$y2  = $y1 ;
	$this->SetXY( $r1 + ($r2-$r1)/2 - 11, $y1+3 );
	$this->SetFont( "Arial", "", 7);
	$this->Cell(10,5, "Thanks & Best Regards,", 0, 0, "L");
}
function addCv()
{
	$r1  = $this->w -197;
	$r2  = $r1 + 296;
	$y1  = 213;
	$y2  = $y1 ;
	$this->SetXY( $r1 + ($r2-$r1)/2 - 11, $y1+3 );
	$this->SetFont( "Arial", "B", 7);
	$this->Cell(10,5, "CV. JAVA MULTI MANDIRI", 0, 0, "L");
}
//stamp
function addstamp( )
{

	$this->Image(get_template_directory().'/inc/fpdf/jadi.jpg',132,219,25,25);

}
//ttd
function addttd( )
{

	$this->Image(get_template_directory().'/inc/fpdf/ttd.jpg',155,219,23,15);

}
function addFootTelp( $nama, $telp )
{
	$r1  = $this->w - 150;
	$r2  = $r1 + 296;
	$y1  = 231;
	$y2  = $y1 ;
	$mid = $y1 + ($y2 / 2);
	$this->SetXY( $r1 + ($r2-$r1)/2 - 55, $y1+3 );
	$this->SetFont( "Arial", "B", 7);
	$this->Cell(10,5, $nama, 0, 0, "L");
	$this->SetXY( $r1 + ($r2-$r1)/2-70, $y1+6 );
	$this->SetFont( "Arial", "", 7);
	$this->Cell(10,5,$telp, 0,0, "L");
}
// add a watermark (temporary estimate, DUPLICATA...)
// call this method first
function temporaire( $texte )
{
	$this->SetFont('Arial','B',50);
	$this->SetTextColor(203,203,203);
	$this->Rotate(45,55,190);
	$this->Text(55,190,$texte);
	$this->Rotate(0);
	$this->SetTextColor(0,0,0);
}

}
?>
