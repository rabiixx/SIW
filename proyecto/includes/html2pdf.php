<?php 


	require_once  __DIR__ . 'vendor/autoload.php';

	echo __DIR__ . 'vendor/autoload.php';

	$mpdf = new mPDF();

	// Write some HTML code:

	$html = utf8_encode($POST['data']);

	$mpdf->WriteHTML($html);

	// Output a PDF file directly to the browser
	$mpdf->Output('hackpdf.pdf');