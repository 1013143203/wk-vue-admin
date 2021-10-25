<?php


// require __DIR__.'/vendor/autoload.php';

// use Spipu\Html2Pdf\Html2Pdf;

// $html2pdf = new Html2Pdf('P','A5','en');

require __DIR__.'/vendor/Tests/Html2PdfTest.php';


$html2pdf->writeHTML(file_get_contents('./1.html'));
$html2pdf->output("sample.pdf");

echo "PDF file is generated successfully!";