<?php
//============================================================+
// File name   : tcpdf_include.php
// Begin       : 2008-05-14
// Last Update : 2014-12-10
//
// Description : Search and include the TCPDF library.
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Search and include the TCPDF library.
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Include the main class.
 * @author Nicola Asuni
 * @since 2013-05-14
 */

// always load alternative config file for examples


// Include the main TCPDF library (search the library on the following directories).
$tcpdf_include_dirs = array(
	realpath('../Tcpdf.php'),
	'/usr/share/php/Tcpdf/Tcpdf.php',
	'/usr/share/Tcpdf/Tcpdf.php',
	'/usr/share/php-tcpdf/Tcpdf.php',
	'/var/www/Tcpdf/Tcpdf.php',
	'/var/www/html/Tcpdf/Tcpdf.php',
	'/usr/local/apache2/htdocs/tcpdf/Tcpdf.php'
);
foreach ($tcpdf_include_dirs as $tcpdf_include_path) {
	if (@file_exists($tcpdf_include_path)) {
		require_once($tcpdf_include_path);
		break;
	}
}

//============================================================+
// END OF FILE
//============================================================+
