<?php
/**
 * Html2Pdf Library - Tests
 *
 * HTML => PDF convertor
 * distributed under the LGPL License
 *
 * @package   Html2pdf
 * @author    Laurent MINGUET <webmaster@html2pdf.fr>
 * @copyright 2016 Laurent MINGUET
 */

namespace Spipu\Html2Pdf\Tests\Tag;

use Spipu\Html2Pdf\Html2Pdf;

/**
 * Class TagInterfaceErrorTest
 */
class TdTooLongTest extends \PHPUnit_Framework_TestCase
{
    /**
     * test: The tag class must implement TagInterface
     *
     * @return void
     * @expectedException \Spipu\Html2Pdf\Exception\TableException
     */
    public function testCase()
    {
        $sentence = 'Hello World ! ';
        $sentences = '';
        for ($k=0; $k<100; $k++) {
            $sentences.= $sentence;
        }

        $object = new Html2Pdf();
        $object->pdf->SetTitle('PhpUnit Test');
        $object->writeHTML('<table><tr><td style="width: 28mm">'.$sentences.'</td></tr></table>');
        $object->Output('test.pdf', 'S');
    }
}
