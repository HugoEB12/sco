<?php
	
	error_reporting(0);
	require '../Assets/plugins/html2pdf/vendor/autoload.php';

	use Spipu\Html2Pdf\Html2Pdf;

/**
 *
 */
class PDFController
{
	private $html2pdf;

	public function __construct()
	{
		//'P','A4','es','true','UTF-8'
		$this->html2pdf = new Html2Pdf('P','A4','es','true','UTF-8');
		$this->html2pdf->setDefaultFont('Arial');

	}

	public function writeHtmlContent($content)
	{
		$this->html2pdf->writeHTML($content);
	}

	public function show()
	{
		$this->html2pdf->output("turno.pdf","D");
	}

}
//END_CLASS


//MAIN

	if (isset($_GET["template"])) {
		ob_start();
	  require_once "../Views/Templates/pdf/".$_GET["template"];
	  $html=ob_get_clean();
	  try {
	  	$pdf = new PDFController();
			$pdf->writeHtmlContent($html);
			$pdf->show();
	  } catch (Html2PdfException $e) {
	  	$html2pdf->clean();
	    $formatter = new ExceptionFormatter($e);
	    echo $formatter->getHtmlMessage();
	  }
	}

//END_MAIN

?>
