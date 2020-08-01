<?php
// memanggil library FPDF
require('fpdf.php');
// intance object dan memberikan pengaturan halaman PDF
$pdf = new FPDF('l','mm','A5');
// membuat halaman baru
$pdf->AddPage();
// setting jenis font yang akan digunakan
$pdf->SetFont('Arial','B',16);
// mencetak string 
$pdf->Cell(190,7,'Perpustakaan Daerah Sleman',0,1,'C');
$pdf->SetFont('Arial','B',12);
$pdf->Cell(190,7,'DAFTAR PEMINJAMAN BUKU DIGILIB PERPUSDA SLEMAN',0,1,'C');

// Memberikan space kebawah agar tidak terlalu rapat
$pdf->Cell(10,7,'',0,1);

$pdf->SetFont('Arial','B',8);
$pdf->Cell(20,6,'Kode',1,0);
$pdf->Cell(85,6,'Judul Buku',1,0);
$pdf->Cell(27,6,'Nama Peminjam',1,0);
$pdf->Cell(25,6,'Tanggal Pinjam',1,1);
//$pdf->Cell(25,6,'Status',1,1);

$pdf->SetFont('Arial','',10);

include 'function.php';
$pinjam = mysqli_query($conn, "select * from tblpinjam");
while ($row = mysqli_fetch_array($pinjam)){
    $pdf->Cell(20,6,$row['kode'],1,0);
    $pdf->Cell(85,6,$row['judul'],1,0);
    $pdf->Cell(27,6,$row['nama'],1,0);
    $pdf->Cell(25,6,$row['tanggal'],1,1); 
   // $pdf->Cell(25,6,$row['status'],1,1); 
}

$pdf->Output();
?>