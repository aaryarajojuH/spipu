<?php
/**
 * Html2Pdf Library - example
 *
 * HTML => PDF convertor
 * distributed under the LGPL License
 *
 * @package   Html2pdf
 * @author    Laurent MINGUET <webmaster@html2pdf.fr>
 * @copyright 2016 Laurent MINGUET
 *
 * isset($_GET['vuehtml']) is not mandatory
 * it allow to display the result in the HTML format
 */

use Spipu\Html2Pdf\Html2Pdf;
use Spipu\Html2Pdf\Html2PdfException;

    require_once(dirname(__FILE__).'/../vendor/autoload.php');

    try
    {
        // init Html2Pdf
        $html2pdf = new Html2Pdf('P', 'A4', 'fr', true, 'UTF-8', array(0, 0, 0, 0));

        // display the full page
        $html2pdf->pdf->SetDisplayMode('fullpage');

        // get the HTML
        ob_start();
        include(dirname(__FILE__).'/res/about.php');
        $content = ob_get_clean();

        // convert
        $html2pdf->writeHTML($content, isset($_GET['vuehtml']));

        // add the automatic index
        $html2pdf->createIndex('Sommaire', 30, 12, false, true, 2);

        // send the PDF
        $html2pdf->Output('about.pdf');
    }
    catch(Html2PdfException $e) {
        echo $e;
        exit;
    }
