<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once 'Tcpdf/Tcpdf.php';

class Pdf extends TCPDF
{
    function __construct()
    {
        parent::__construct();
    }
}
/*Author:Tutsway.com */  
/* End of file Pdf.php */
/* Location: ./application/libraries/Pdf.php */
?>