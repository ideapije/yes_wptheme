<?php
$pdf = new PDF_Quotation( 'P', 'mm', 'A4' );
$pdf->AddPage();
$pdf->addlogo("");
$pdf->addjvm("");
$pdf->fact_dev( "QUOTATION " , " ");
$pdf->temporaire( "CV. Java Multi Mandiri" );
$pdf->descr("");
$pdf->addHeadAlamat(": Jl. Raya Baturaden Timur KM 7 No. 17 Rempoah, Baturaden - Jawa Tengah - 53100");
$pdf->addHeadTelp(": 0281-5755222 / 0281-6572222, Email : info@jvm.co.id, Website : http://www.jvm.co.id");
$pdf->addTabelDate(date("F d, Y"));
$pdf->addTabelAttn("Ari Sebastian"); //nama
$pdf->addTabelQuNo($data['id']); // no. quot
$pdf->addTabelCc("-"); // cc
$pdf->addTabelTo("PT. Rafa Bhakti Mulya"); //penerima
$pdf->addTabelTelp("02183786432"); // telp
$pdf->addTabelAddress("Rasuna Office Park III Jl. HR Rasuna Said - Kuningan Suite ZO-12 (komp. Apartemen rasuna) Jakarta Selatan"); //alamat
$pdf->addTabelFaks("02183703107"); // faks
$pdf->addEmail("ptrafabhakti@yahoo.com"); // email
$pdf->AddWeAre("");
$pdf->Ln();
$pdf->Ln();

//
$pdf->addExVAT("");
$pdf->addPriceStok("");
$pdf->addTerm("DP 50% with order balances 50% before delivery (Full Amount)");
$pdf->addDeliv("1 Day After Payment"); // bisa ganti
$pdf->addwarranty("");
$pdf->addwarrantyy("1st Month (Replacement)");
$pdf->addwarrantyyy("12nd Month (Repair / Service Hardware & Software)");
$pdf->addBank("");
$pdf->addBCA("");
$pdf->addMDR("");
$pdf->addBNI("");
$pdf->addThk("");
$pdf->addttd("");
$pdf->addstamp("");
$pdf->addCv("");
$pdf->addFootTelp("Eka Setiawati Irawan", "0281-5755222/087837160608/Pin BB 29433756"); // ini juga bs ganti
$pdf->Output();
?>
