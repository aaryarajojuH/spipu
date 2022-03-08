<?php
/**
 * Html2Pdf Library - example
 *
 * HTML => PDF convertor
 * distributed under the LGPL License
 *
 * isset($_GET['vuehtml']) is not mandatory
 * it allow to display the result in the HTML format
 *
 * @package   Html2pdf
 * @author    Laurent MINGUET <webmaster@html2pdf.fr>
 * @copyright 2016 Laurent MINGUET
 */
require_once dirname(__FILE__).'/../vendor/autoload.php';

use Spipu\Html2Pdf\Html2Pdf;
use Spipu\Html2Pdf\Html2PdfException;

// get the HTML
ob_start();
require dirname(__FILE__).'/res/regle.php';
$content = ob_get_clean();

// convert to PDF
try {
    $html2pdf = new Html2Pdf('L', 'A4', 'fr', true, 'UTF-8', 10);
    $html2pdf->pdf->SetDisplayMode('fullpage');
    $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
    $html2pdf->Output('regle.pdf');
} catch (Html2PdfException $e) {
    echo $e;
    exit;
}
