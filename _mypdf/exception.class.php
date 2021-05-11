<?php
/**
 * HTML2PDF Librairy - HTML2PDF Exception
 *
 * HTML => PDF convertor
 * distributed under the LGPL License
 *
 * @author    Laurent MINGUET <webmaster@html2pdf.fr>
 * @version   4.02
 */

class HTML2PDF_exception extends exception
{
    protected $_tag = null;
    protected $_html = null;
    protected $_image = null;
    protected $_messageHtml = '';

    /**
     * generate a HTML2PDF exception
     *
     * @param    int     $err error number
     * @param    mixed   $other additionnal informations
     * @return   string  $html optionnal code HTML associated to the error
     */
    final public function __construct($err = 0, $other = null, $html = '')
    {
        // read the error
        switch($err)
        {
            case 1: // Unsupported tag
                $msg = (HTML2PDF::textGET('err01'));
                $msg = str_replace('[[OTHER]]', $other, $msg);
                $this->_tag = $other;
                break;

            case 2: // too long sentence
                $msg = (HTML2PDF::textGET('err02'));
                $msg = str_replace('[[OTHER_0]]', $other[0], $msg);
                $msg = str_replace('[[OTHER_1]]', $other[1], $msg);
                $msg = str_replace('[[OTHER_2]]', $other[2], $msg);
                break;

            case 3: // closing tag in excess
                $msg = (HTML2PDF::textGET('err03'));
                $msg = str_replace('[[OTHER]]', $other, $msg);
                $this->_tag = $other;
                break;

            case 4: // tags closed in the wrong order
                $msg = (HTML2PDF::textGET('err04'));
                $msg = str_replace('[[OTHER]]', print_r($other, true), $msg);
                break;

            case 5: // unclosed tag
                $msg = (HTML2PDF::textGET('err05'));
                $msg = str_replace('[[OTHER]]', print_r($other, true), $msg);
                break;

            case 6: // image can not be loaded
                $msg = (HTML2PDF::textGET('err06'));
                $msg = str_replace('[[OTHER]]', $other, $msg);
                $this->_image = $other;
                break;

            case 7: // too big TD content
                $msg = (HTML2PDF::textGET('err07'));
                break;

            case 8: // SVG tag not in DRAW tag
                $msg = (HTML2PDF::textGET('err08'));
                $msg = str_replace('[[OTHER]]', $other, $msg);
                $this->_tag = $other;
                break;

            case 9: // deprecated
                $msg = (HTML2PDF::textGET('err09'));
                $msg = str_replace('[[OTHER_0]]', $other[0], $msg);
                $msg = str_replace('[[OTHER_1]]', $other[1], $msg);
                $this->_tag = $other[0];
                break;

            case 0: // specific error
            default:
                $msg = $other;
                break;
        }

        // create the HTML message
        $this->_messageHtml = '<span style="color: #AA0000; font-weight: bold;">'.(HTML2PDF::textGET('txt01')).$err.'</span><br>';
        $this->_messageHtml.= (HTML2PDF::textGET('txt02')).' '.$this->file.'<br>';
        $this->_messageHtml.= (HTML2PDF::textGET('txt03')).' '.$this->line.'<br>';
        $this->_messageHtml.= '<br>';
        $this->_messageHtml.= $msg;

        // create the text message
        $msg = HTML2PDF::textGET('txt01').$err.' : '.strip_tags($msg);

        // add the optionnal html content
        if ($html) {
            $this->_messageHtml.= "<br><br>HTML : ...".trim(htmlentities($html)).'...';
            $this->_html = $html;
            $msg.= ' HTML : ...'.trim($html).'...';
        }

        // construct the exception
        parent::__construct($msg, $err);
    }

    /**
     * get the message as string
     *
     * @access public
     * @return string $messageHtml
     */
    public function __toString()
    {
        return $this->_messageHtml;
    }

    /**
     * get the html tag name
     *
     * @access public
     * @return string $tagName
     */
    public function getTAG()
    {
        return $this->_tag;
    }

    /**
     * get the optional html code
     *
     * @access public
     * @return string $html
     */
    public function getHTML()
    {
        return $this->_html;
    }

    /**
     * get the image source
     *
     * @access public
     * @return string $imageSrc
     */
    public function getIMAGE()
    {
        return $this->_image;
    }
}