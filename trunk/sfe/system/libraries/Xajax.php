<?php
/**
 * xajax.inc.php :: Main xajax class and setup file
 *
 * xajax version 0.2.4
 * copyright (c) 2005 by Jared White & J. Max Wilson
 * http://www.xajaxproject.org
 *
 * xajax is an open source PHP class library for easily creating powerful
 * PHP-driven, web-based Ajax Applications. Using xajax, you can asynchronously
 * call PHP functions and update the content of your your webpage without
 * reloading the page.
 *
 * xajax is released under the terms of the LGPL license
 * http://www.gnu.org/copyleft/lesser.html#SEC3
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 * 
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 * 
 * @package xajax
 * @version $Id$
 * @copyright Copyright (c) 2005-2006  by Jared White & J. Max Wilson
 * @license http://www.gnu.org/copyleft/lesser.html#SEC3 LGPL License
 */

/*
   ----------------------------------------------------------------------------
   | Online documentation for this class is available on the xajax wiki at:   |
   | http://wiki.xajaxproject.org/Documentation:xajax.inc.php                 |
   ----------------------------------------------------------------------------
*/

/**
 * Define XAJAX_DEFAULT_CHAR_ENCODING that is used by both
 * the xajax and xajaxResponse classes
 */
if (!defined ('XAJAX_DEFAULT_CHAR_ENCODING'))
{
	define ('XAJAX_DEFAULT_CHAR_ENCODING', 'utf-8' );
}

#require_once(dirname(__FILE__)."/xajaxResponse.inc.php");

/**
 * Communication Method Defines
 */
if (!defined ('XAJAX_GET'))
{
	define ('XAJAX_GET', 0);
}
if (!defined ('XAJAX_POST'))
{
	define ('XAJAX_POST', 1);
}

/**
 * The xajax class generates the xajax javascript for your page including the 
 * Javascript wrappers for the PHP functions that you want to call from your page.
 * It also handles processing and executing the command messages in the XML responses
 * sent back to your page from your PHP functions.
 * 
 * @package xajax
 */ 
class CI_Xajax
{
	/**#@+
	 * @access protected
	 */
	/**
	 * @var array Array of PHP functions that will be callable through javascript wrappers
	 */
	var $aFunctions;
	/**
	 * @var array Array of object callbacks that will allow Javascript to call PHP methods (key=function name)
	 */
	var $aObjects;
	/**
	 * @var array Array of RequestTypes to be used with each function (key=function name)
	 */
	var $aFunctionRequestTypes;
	/**
	 * @var array Array of Include Files for any external functions (key=function name)
	 */
	var $aFunctionIncludeFiles;
	/**
	 * @var string Name of the PHP function to call if no callable function was found
	 */
	var $sCatchAllFunction;
	/**
	 * @var string Name of the PHP function to call before any other function
	 */
	var $sPreFunction;
	/**
	 * @var string The URI for making requests to the xajax object
	 */
	var $sRequestURI;
	/**
	 * @var string The prefix to prepend to the javascript wraper function name
	 */
	var $sWrapperPrefix;
	/**
	 * @var boolean Show debug messages (default false)
	 */
	var $bDebug;
	/**
	 * @var boolean Show messages in the client browser's status bar (default false)
	 */
	var $bStatusMessages;	
	/**
	 * @var boolean Allow xajax to exit after processing a request (default true)
	 */
	var $bExitAllowed;
	/**
	 * @var boolean Use wait cursor in browser (default true)
	 */
	var $bWaitCursor;
	/**
	 * @var boolean Use an special xajax error handler so the errors are sent to the browser properly (default false)
	 */
	var $bErrorHandler;
	/**
	 * @var string Specify what, if any, file xajax should log errors to (and more information in a future release)
	 */
	var $sLogFile;
	/**
	 * @var boolean Clean all output buffers before outputting response (default false)
	 */
	var $bCleanBuffer;
	/**
	 * @var string String containing the character encoding used
	 */
	var $sEncoding;
	/**
	 * @var boolean Decode input request args from UTF-8 (default false)
	 */
	var $bDecodeUTF8Input;
	/**
	 * @var boolean Convert special characters to HTML entities (default false)
	 */
	var $bOutputEntities;
	/**
	 * @var array Array for parsing complex objects
	 */
	var $aObjArray;
	/**
	 * @var integer Position in $aObjArray
	 */
	var $iPos;
	
	/**#@-*/
	
	/**
	 * Constructor. You can set some extra xajax options right away or use
	 * individual methods later to set options.
	 * 
	 * @param string  defaults to the current browser URI
	 * @param string  defaults to "xajax_";
	 * @param string  defaults to XAJAX_DEFAULT_CHAR_ENCODING defined above
	 * @param boolean defaults to false
	 */
	function xajax($sRequestURI="",$sWrapperPrefix="xajax_",$sEncoding=XAJAX_DEFAULT_CHAR_ENCODING,$bDebug=false)
	{
		$this->aFunctions = array();
		$this->aObjects = array();
		$this->aFunctionIncludeFiles = array();
		$this->sRequestURI = $sRequestURI;
		if ($this->sRequestURI == "")
			$this->sRequestURI = $this->_detectURI();
		$this->sWrapperPrefix = $sWrapperPrefix;
		$this->bDebug = $bDebug;
		$this->bStatusMessages = false;
		$this->bWaitCursor = true;
		$this->bExitAllowed = true;
		$this->bErrorHandler = false;
		$this->sLogFile = "";
		$this->bCleanBuffer = false;
		$this->setCharEncoding($sEncoding);
		$this->bDecodeUTF8Input = false;
		$this->bOutputEntities = false;
	}
		
	/**
	 * Sets the URI to which requests will be made.
	 * <i>Usage:</i> <kbd>$xajax->setRequestURI("http://www.xajaxproject.org");</kbd>
	 * 
	 * @param string the URI (can be absolute or relative) of the PHP script
	 *               that will be accessed when an xajax request occurs
	 */
	function setRequestURI($sRequestURI)
	{
		$this->sRequestURI = $sRequestURI;
	}

	/**
	 * Sets the prefix that will be appended to the Javascript wrapper
	 * functions (default is "xajax_").
	 * 
	 * @param string
	 */ 
	// 
	function setWrapperPrefix($sPrefix)
	{
		$this->sWrapperPrefix = $sPrefix;
	}
	
	/**
	 * Enables debug messages for xajax.
	 * */
	function debugOn()
	{
		$this->bDebug = true;
	}
	
	/**
	 * Disables debug messages for xajax (default behavior).
	 */
	function debugOff()
	{
		$this->bDebug = false;
	}
		
	/**
	 * Enables messages in the browser's status bar for xajax.
	 */
	function statusMessagesOn()
	{
		$this->bStatusMessages = true;
	}
	
	/**
	 * Disables messages in the browser's status bar for xajax (default behavior).
	 */
	function statusMessagesOff()
	{
		$this->bStatusMessages = false;
	}
	
	/**
	 * Enables the wait cursor to be displayed in the browser (default behavior).
	 */
	function waitCursorOn()
	{
		$this->bWaitCursor = true;
	}
	
	/**
	 * Disables the wait cursor to be displayed in the browser.
	 */
	function waitCursorOff()
	{
		$this->bWaitCursor = false;
	}	
	
	/**
	 * Enables xajax to exit immediately after processing a request and
	 * sending the response back to the browser (default behavior).
	 */
	function exitAllowedOn()
	{
		$this->bExitAllowed = true;
	}
	
	/**
	 * Disables xajax's default behavior of exiting immediately after
	 * processing a request and sending the response back to the browser.
	 */
	function exitAllowedOff()
	{
		$this->bExitAllowed = false;
	}
	
	/**
	 * Turns on xajax's error handling system so that PHP errors that occur
	 * during a request are trapped and pushed to the browser in the form of
	 * a Javascript alert.
	 */
	function errorHandlerOn()
	{
		$this->bErrorHandler = true;
	}

	/**
	 * Turns off xajax's error handling system (default behavior).
	 */
	function errorHandlerOff()
	{
		$this->bErrorHandler = false;
	}
	
	/**
	 * Specifies a log file that will be written to by xajax during a request
	 * (used only by the error handling system at present). If you don't invoke
	 * this method, or you pass in "", then no log file will be written to.
	 * <i>Usage:</i> <kbd>$xajax->setLogFile("/xajax_logs/errors.log");</kbd>
	 */
	function setLogFile($sFilename)
	{
		$this->sLogFile = $sFilename;
	}

	/**
	 * Causes xajax to clean out all output buffers before outputting a
	 * response (default behavior).
	 */
	function cleanBufferOn()
	{
		$this->bCleanBuffer = true;
	}
	/**
	 * Turns off xajax's output buffer cleaning.
	 */
	function cleanBufferOff()
	{
		$this->bCleanBuffer = false;
	}
	
	/**
	 * Sets the character encoding for the HTTP output based on
	 * <kbd>$sEncoding</kbd>, which is a string containing the character
	 * encoding to use. You don't need to use this method normally, since the
	 * character encoding for the response gets set automatically based on the
	 * <kbd>XAJAX_DEFAULT_CHAR_ENCODING</kbd> constant.
	 * <i>Usage:</i> <kbd>$xajax->setCharEncoding("utf-8");</kbd>
	 *
	 * @param string the encoding type to use (utf-8, iso-8859-1, etc.)
	 */
	function setCharEncoding($sEncoding)
	{
		$this->sEncoding = $sEncoding;
	}

	/**
	 * Causes xajax to decode the input request args from UTF-8 to the current
	 * encoding if possible. Either the iconv or mb_string extension must be
	 * present for optimal functionality.
	 */
	function decodeUTF8InputOn()
	{
		$this->bDecodeUTF8Input = true;
	}

	/**
	 * Turns off decoding the input request args from UTF-8 (default behavior).
	 */
	function decodeUTF8InputOff()
	{
		$this->bDecodeUTF8Input = false;
	}
	
	/**
	 * Tells the response object to convert special characters to HTML entities
	 * automatically (only works if the mb_string extension is available).
	 */
	function outputEntitiesOn()
	{
		$this->bOutputEntities = true;
	}
	
	/**
	 * Tells the response object to output special characters intact. (default
	 * behavior).
	 */
	function outputEntitiesOff()
	{
		$this->bOutputEntities = false;
	}
				
	/**
	 * Registers a PHP function or method to be callable through xajax in your
	 * Javascript. If you want to register a function, pass in the name of that
	 * function. If you want to register a static class method, pass in an
	 * array like so:
	 * <kbd>array("myFunctionName", "myClass", "myMethod")</kbd>
	 * For an object instance method, use an object variable for the second
	 * array element (and in PHP 4 make sure you put an & before the variable
	 * to pass the object by reference). Note: the function name is what you
	 * call via Javascript, so it can be anything as long as it doesn't
	 * conflict with any other registered function name.
	 * 
	 * <i>Usage:</i> <kbd>$xajax->registerFunction("myFunction");</kbd>
	 * or: <kbd>$xajax->registerFunction(array("myFunctionName", &$myObject, "myMethod"));</kbd>
	 * 
	 * @param mixed  contains the function name or an object callback array
	 * @param mixed  request type (XAJAX_GET/XAJAX_POST) that should be used 
	 *               for this function.  Defaults to XAJAX_POST.
	 */
	function registerFunction($mFunction,$sRequestType=XAJAX_POST)
	{
		if (is_array($mFunction)) {
			$this->aFunctions[$mFunction[0]] = 1;
			$this->aFunctionRequestTypes[$mFunction[0]] = $sRequestType;
			$this->aObjects[$mFunction[0]] = array_slice($mFunction, 1);
		}	
		else {
			$this->aFunctions[$mFunction] = 1;
			$this->aFunctionRequestTypes[$mFunction] = $sRequestType;
		}
	}
	
	/**
	 * Registers a PHP function to be callable through xajax which is located
	 * in some other file.  If the function is requested the external file will
	 * be included to define the function before the function is called.
	 * 
	 * <i>Usage:</i> <kbd>$xajax->registerExternalFunction("myFunction","myFunction.inc.php",XAJAX_POST);</kbd>
	 * 
	 * @param string contains the function name or an object callback array
	 *               ({@link xajax::registerFunction() see registerFunction} for
	 *               more info on object callback arrays)
	 * @param string contains the path and filename of the include file
	 * @param mixed  the RequestType (XAJAX_GET/XAJAX_POST) that should be used 
	 *		          for this function. Defaults to XAJAX_POST.
	 */
	function registerExternalFunction($mFunction,$sIncludeFile,$sRequestType=XAJAX_POST)
	{
		$this->registerFunction($mFunction, $sRequestType);
		
		if (is_array($mFunction)) {
			$this->aFunctionIncludeFiles[$mFunction[0]] = $sIncludeFile;
		}
		else {
			$this->aFunctionIncludeFiles[$mFunction] = $sIncludeFile;
		}
	}
	
	/**
	 * Registers a PHP function to be called when xajax cannot find the
	 * function being called via Javascript. Because this is technically
	 * impossible when using "wrapped" functions, the catch-all feature is
	 * only useful when you're directly using the xajax.call() Javascript
	 * method. Use the catch-all feature when you want more dynamic ability to
	 * intercept unknown calls and handle them in a custom way.
	 * 
	 * <i>Usage:</i> <kbd>$xajax->registerCatchAllFunction("myCatchAllFunction");</kbd>
	 * 
	 * @param string contains the function name or an object callback array
	 *               ({@link xajax::registerFunction() see registerFunction} for
	 *               more info on object callback arrays)
	 */
	function registerCatchAllFunction($mFunction)
	{
		if (is_array($mFunction)) {
			$this->sCatchAllFunction = $mFunction[0];
			$this->aObjects[$mFunction[0]] = array_slice($mFunction, 1);
		}
		else {
			$this->sCatchAllFunction = $mFunction;
		}
	}
	
	/**
	 * Registers a PHP function to be called before xajax calls the requested
	 * function. xajax will automatically add the request function's response
	 * to the pre-function's response to create a single response. Another
	 * feature is the ability to return not just a response, but an array with
	 * the first element being false (a boolean) and the second being the
	 * response. In this case, the pre-function's response will be returned to
	 * the browser without xajax calling the requested function.
	 * 
	 * <i>Usage:</i> <kbd>$xajax->registerPreFunction("myPreFunction");</kbd>
	 * 
	 * @param string contains the function name or an object callback array
	 *               ({@link xajax::registerFunction() see registerFunction} for
	 *               more info on object callback arrays)
	 */
	function registerPreFunction($mFunction)
	{
		if (is_array($mFunction)) {
			$this->sPreFunction = $mFunction[0];
			$this->aObjects[$mFunction[0]] = array_slice($mFunction, 1);
		}
		else {
			$this->sPreFunction = $mFunction;
		}
	}
	
	/**
	 * Returns true if xajax can process the request, false if otherwise.
	 * You can use this to determine if xajax needs to process the request or
	 * not.
	 * 
	 * @return boolean
	 */ 
	function canProcessRequests()
	{
		if ($this->getRequestMode() != -1) return true;
		return false;
	}
	
	/**
	 * Returns the current request mode (XAJAX_GET or XAJAX_POST), or -1 if
	 * there is none.
	 * 
	 * @return mixed
	 */
	function getRequestMode()
	{
		if (!empty($_GET["xajax"]))
			return XAJAX_GET;
		
		if (!empty($_POST["xajax"]))
			return XAJAX_POST;
			
		return -1;
	}
	
	/**
	 * This is the main communications engine of xajax. The engine handles all
	 * incoming xajax requests, calls the apporiate PHP functions (or
	 * class/object methods) and passes the XML responses back to the
	 * Javascript response handler. If your RequestURI is the same as your Web
	 * page then this function should be called before any headers or HTML has
	 * been sent.
	 */
	function processRequests()
	{	
		
		$requestMode = -1;
		$sFunctionName = "";
		$bFoundFunction = true;
		$bFunctionIsCatchAll = false;
		$sFunctionNameForSpecial = "";
		$aArgs = array();
		$sPreResponse = "";
		$bEndRequest = false;
		$sResponse = "";
		
		$requestMode = $this->getRequestMode();
		if ($requestMode == -1) return;
	
		if ($requestMode == XAJAX_POST)
		{
			$sFunctionName = $_POST["xajax"];
			
			if (!empty($_POST["xajaxargs"])) 
				$aArgs = $_POST["xajaxargs"];
		}
		else
		{	
			header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
			header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
			header ("Cache-Control: no-cache, must-revalidate");
			header ("Pragma: no-cache");
			
			$sFunctionName = $_GET["xajax"];
			
			if (!empty($_GET["xajaxargs"])) 
				$aArgs = $_GET["xajaxargs"];
		}
		
		// Use xajax error handler if necessary
		if ($this->bErrorHandler) {
			$GLOBALS['xajaxErrorHandlerText'] = "";
			set_error_handler("xajaxErrorHandler");
		}
		
		if ($this->sPreFunction) {
			if (!$this->_isFunctionCallable($this->sPreFunction)) {
				$bFoundFunction = false;
				$objResponse = new xajaxResponse();
				$objResponse->addAlert("Unknown Pre-Function ". $this->sPreFunction);
				$sResponse = $objResponse->getXML();
			}
		}
		//include any external dependencies associated with this function name
		if (array_key_exists($sFunctionName,$this->aFunctionIncludeFiles))
		{
			ob_start();
			include_once($this->aFunctionIncludeFiles[$sFunctionName]);
			ob_end_clean();
		}
		
		if ($bFoundFunction) {
			$sFunctionNameForSpecial = $sFunctionName;
			if (!array_key_exists($sFunctionName, $this->aFunctions))
			{
				if ($this->sCatchAllFunction) {
					$sFunctionName = $this->sCatchAllFunction;
					$bFunctionIsCatchAll = true;
				}
				else {
					$bFoundFunction = false;
					$objResponse = new xajaxResponse();
					$objResponse->addAlert("Unknown Function $sFunctionName.");
					$sResponse = $objResponse->getXML();
				}
			}
			else if ($this->aFunctionRequestTypes[$sFunctionName] != $requestMode)
			{
				$bFoundFunction = false;
				$objResponse = new xajaxResponse();
				$objResponse->addAlert("Incorrect Request Type.");
				$sResponse = $objResponse->getXML();
			}
		}
		
		if ($bFoundFunction)
		{
			for ($i = 0; $i < sizeof($aArgs); $i++)
			{
				// If magic quotes is on, then we need to strip the slashes from the args
				if (get_magic_quotes_gpc() == 1 && is_string($aArgs[$i])) {
				
					$aArgs[$i] = stripslashes($aArgs[$i]);
				}
				if (stristr($aArgs[$i],"<xjxobj>") != false)
				{
					$aArgs[$i] = $this->_xmlToArray("xjxobj",$aArgs[$i]);	
				}
				else if (stristr($aArgs[$i],"<xjxquery>") != false)
				{
					$aArgs[$i] = $this->_xmlToArray("xjxquery",$aArgs[$i]);	
				}
				else if ($this->bDecodeUTF8Input)
				{
					$aArgs[$i] = $this->_decodeUTF8Data($aArgs[$i]);	
				}
			}

			if ($this->sPreFunction) {
				$mPreResponse = $this->_callFunction($this->sPreFunction, array($sFunctionNameForSpecial, $aArgs));
				if (is_array($mPreResponse) && $mPreResponse[0] === false) {
					$bEndRequest = true;
					$sPreResponse = $mPreResponse[1];
				}
				else {
					$sPreResponse = $mPreResponse;
				}
				if (is_a($sPreResponse, "xajaxResponse")) {
					$sPreResponse = $sPreResponse->getXML();
				}
				if ($bEndRequest) $sResponse = $sPreResponse;
			}
			
			if (!$bEndRequest) {
				if (!$this->_isFunctionCallable($sFunctionName)) {
					$objResponse = new xajaxResponse();
					$objResponse->addAlert("The Registered Function $sFunctionName Could Not Be Found.");
					$sResponse = $objResponse->getXML();
				}
				else {
					if ($bFunctionIsCatchAll) {
						$aArgs = array($sFunctionNameForSpecial, $aArgs);
					}
					$sResponse = $this->_callFunction($sFunctionName, $aArgs);
				}
				if (is_a($sResponse, "xajaxResponse")) {
					$sResponse = $sResponse->getXML();
				}
				if (!is_string($sResponse) || strpos($sResponse, "<xjx>") === FALSE) {
					$objResponse = new xajaxResponse();
					$objResponse->addAlert("No XML Response Was Returned By Function $sFunctionName.");
					$sResponse = $objResponse->getXML();
				}
				else if ($sPreResponse != "") {
					$sNewResponse = new xajaxResponse($this->sEncoding, $this->bOutputEntities);
					$sNewResponse->loadXML($sPreResponse);
					$sNewResponse->loadXML($sResponse);
					$sResponse = $sNewResponse->getXML();
				}
			}
		}
		
		$sContentHeader = "Content-type: text/xml;";
		if ($this->sEncoding && strlen(trim($this->sEncoding)) > 0)
			$sContentHeader .= " charset=".$this->sEncoding;
		header($sContentHeader);
		if ($this->bErrorHandler && !empty( $GLOBALS['xajaxErrorHandlerText'] )) {
			$sErrorResponse = new xajaxResponse();
			$sErrorResponse->addAlert("** PHP Error Messages: **" . $GLOBALS['xajaxErrorHandlerText']);
			if ($this->sLogFile) {
				$fH = @fopen($this->sLogFile, "a");
				if (!$fH) {
					$sErrorResponse->addAlert("** Logging Error **\n\nxajax was unable to write to the error log file:\n" . $this->sLogFile);
				}
				else {
					fwrite($fH, "** xajax Error Log - " . strftime("%b %e %Y %I:%M:%S %p") . " **" . $GLOBALS['xajaxErrorHandlerText'] . "\n\n\n");
					fclose($fH);
				}
			}

			$sErrorResponse->loadXML($sResponse);
			$sResponse = $sErrorResponse->getXML();
			
		}
		if ($this->bCleanBuffer) while (@ob_end_clean());
		print $sResponse;
		if ($this->bErrorHandler) restore_error_handler();
		
		if ($this->bExitAllowed)
			exit();
	}

	/**			
	 * Prints the xajax Javascript header and wrapper code into your page by
	 * printing the output of the getJavascript() method. It should only be
	 * called between the <pre><head> </head></pre> tags in your HTML page.
	 * Remember, if you only want to obtain the result of this function, use
	 * {@link xajax::getJavascript()} instead.
	 * 
	 * <i>Usage:</i>
	 * <code>
	 *  <head>
	 *		...
	 *		< ?php $xajax->printJavascript(); ? >
	 * </code>
	 * 
	 * @param string the relative address of the folder where xajax has been
	 *               installed. For instance, if your PHP file is
	 *               "http://www.myserver.com/myfolder/mypage.php"
	 *               and xajax was installed in
	 *               "http://www.myserver.com/anotherfolder", then $sJsURI
	 *               should be set to "../anotherfolder". Defaults to assuming
	 *               xajax is in the same folder as your PHP file.
	 * @param string the relative folder/file pair of the xajax Javascript
	 *               engine located within the xajax installation folder.
	 *               Defaults to xajax_js/xajax.js.
	 */
	function printJavascript($sJsURI="", $sJsFile=NULL)
	{
		print $this->getJavascript($sJsURI, $sJsFile);
	}
	
	/**
	 * Returns the xajax Javascript code that should be added to your HTML page
	 * between the <kbd><head> </head></kbd> tags.
	 * 
	 * <i>Usage:</i>
	 * <code>
	 *  < ?php $xajaxJSHead = $xajax->getJavascript(); ? >
	 *	<head>
	 *		...
	 *		< ?php echo $xajaxJSHead; ? >
	 * </code>
	 * 
	 * @param string the relative address of the folder where xajax has been
	 *               installed. For instance, if your PHP file is
	 *               "http://www.myserver.com/myfolder/mypage.php"
	 *               and xajax was installed in
	 *               "http://www.myserver.com/anotherfolder", then $sJsURI
	 *               should be set to "../anotherfolder". Defaults to assuming
	 *               xajax is in the same folder as your PHP file.
	 * @param string the relative folder/file pair of the xajax Javascript
	 *               engine located within the xajax installation folder.
	 *               Defaults to xajax_js/xajax.js.
	 * @return string
	 */
	function getJavascript($sJsURI="", $sJsFile=NULL)
	{	
		$html = $this->getJavascriptConfig();
		$html .= $this->getJavascriptInclude($sJsURI, $sJsFile);
		
		return $html;
	}
	
	/**
	 * Returns a string containing inline Javascript that sets up the xajax
	 * runtime (typically called internally by xajax from get/printJavascript).
	 * 
	 * @return string
	 */
	function getJavascriptConfig()
	{
		$html  = "\t<script type=\"text/javascript\">\n";
		$html .= "var xajaxRequestUri=\"".$this->sRequestURI."\";\n";
		$html .= "var xajaxDebug=".($this->bDebug?"true":"false").";\n";
		$html .= "var xajaxStatusMessages=".($this->bStatusMessages?"true":"false").";\n";
		$html .= "var xajaxWaitCursor=".($this->bWaitCursor?"true":"false").";\n";
		$html .= "var xajaxDefinedGet=".XAJAX_GET.";\n";
		$html .= "var xajaxDefinedPost=".XAJAX_POST.";\n";
		$html .= "var xajaxLoaded=false;\n";

		foreach($this->aFunctions as $sFunction => $bExists) {
			$html .= $this->_wrap($sFunction,$this->aFunctionRequestTypes[$sFunction]);
		}

		$html .= "\t</script>\n";
		return $html;		
	}
	
	/**
	 * Returns a string containing a Javascript include of the xajax.js file
	 * along with a check to see if the file loaded after six seconds
	 * (typically called internally by xajax from get/printJavascript).
	 * 
	 * @param string the relative address of the folder where xajax has been
	 *               installed. For instance, if your PHP file is
	 *               "http://www.myserver.com/myfolder/mypage.php"
	 *               and xajax was installed in
	 *               "http://www.myserver.com/anotherfolder", then $sJsURI
	 *               should be set to "../anotherfolder". Defaults to assuming
	 *               xajax is in the same folder as your PHP file.
	 * @param string the relative folder/file pair of the xajax Javascript
	 *               engine located within the xajax installation folder.
	 *               Defaults to xajax_js/xajax.js.
	 * @return string
	 */
	function getJavascriptInclude($sJsURI="", $sJsFile=NULL)
	{
		if ($sJsFile == NULL) $sJsFile = "xajax_js/xajax.js";
			
		if ($sJsURI != "" && substr($sJsURI, -1) != "/") $sJsURI .= "/";
		
		$html = "\t<script type=\"text/javascript\" src=\"" . $sJsURI . $sJsFile . "\"></script>\n";	
		$html .= "\t<script type=\"text/javascript\">\n";
		$html .= "window.setTimeout(function () { if (!xajaxLoaded) { alert('Error: the xajax Javascript file could not be included. Perhaps the URL is incorrect?\\nURL: {$sJsURI}{$sJsFile}'); } }, 6000);\n";
		$html .= "\t</script>\n";
		return $html;
	}

	/**
	 * This method can be used to create a new xajax.js file out of the
	 * xajax_uncompressed.js file (which will only happen if xajax.js doesn't
	 * already exist on the filesystem).
	 * 
	 * @param string an optional argument containing the full server file path
	 *               of xajax.js.
	 */
	function autoCompressJavascript($sJsFullFilename=NULL)
	{	
		$sJsFile = "xajax_js/xajax.js";
		
		if ($sJsFullFilename) {
			$realJsFile = $sJsFullFilename;
		}
		else {
			$realPath = realpath(dirname(__FILE__));
			$realJsFile = $realPath . "/". $sJsFile;
		}

		// Create a compressed file if necessary
		if (!file_exists($realJsFile)) {
			$srcFile = str_replace(".js", "_uncompressed.js", $realJsFile);
			if (!file_exists($srcFile)) {
				trigger_error("The xajax uncompressed Javascript file could not be found in the <b>" . dirname($realJsFile) . "</b> folder. Error ", E_USER_ERROR);	
			}
			#require(dirname(__FILE__)."/xajaxCompress.php");
			$javaScript = implode('', file($srcFile));
			$compressedScript = xajaxCompressJavascript($javaScript);
			$fH = @fopen($realJsFile, "w");
			if (!$fH) {
				trigger_error("The xajax compressed javascript file could not be written in the <b>" . dirname($realJsFile) . "</b> folder. Error ", E_USER_ERROR);
			}
			else {
				fwrite($fH, $compressedScript);
				fclose($fH);
			}
		}
	}
	
	/**
	 * Returns the current URL based upon the SERVER vars.
	 * 
	 * @access private
	 * @return string
	 */
	function _detectURI() {
		$aURL = array();

		// Try to get the request URL
		if (!empty($_SERVER['REQUEST_URI'])) {
			$aURL = parse_url($_SERVER['REQUEST_URI']);
		}

		// Fill in the empty values
		if (empty($aURL['scheme'])) {
			if (!empty($_SERVER['HTTP_SCHEME'])) {
				$aURL['scheme'] = $_SERVER['HTTP_SCHEME'];
			} else {
				$aURL['scheme'] = (!empty($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) != 'off') ? 'https' : 'http';
			}
		}

		if (empty($aURL['host'])) {
			if (!empty($_SERVER['HTTP_HOST'])) {
				if (strpos($_SERVER['HTTP_HOST'], ':') > 0) {
					list($aURL['host'], $aURL['port']) = explode(':', $_SERVER['HTTP_HOST']);
				} else {
					$aURL['host'] = $_SERVER['HTTP_HOST'];
				}
			} else if (!empty($_SERVER['SERVER_NAME'])) {
				$aURL['host'] = $_SERVER['SERVER_NAME'];
			} else {
				print "xajax Error: xajax failed to automatically identify your Request URI.";
				print "Please set the Request URI explicitly when you instantiate the xajax object.";
				exit();
			}
		}

		if (empty($aURL['port']) && !empty($_SERVER['SERVER_PORT'])) {
			$aURL['port'] = $_SERVER['SERVER_PORT'];
		}

		if (empty($aURL['path'])) {
			if (!empty($_SERVER['PATH_INFO'])) {
				$sPath = parse_url($_SERVER['PATH_INFO']);
			} else {
				$sPath = parse_url($_SERVER['PHP_SELF']);
			}
			$aURL['path'] = $sPath['path'];
			unset($sPath);
		}

		if (!empty($aURL['query'])) {
			$aURL['query'] = '?'.$aURL['query'];
		}

		// Build the URL: Start with scheme, user and pass
		$sURL = $aURL['scheme'].'://';
		if (!empty($aURL['user'])) {
			$sURL.= $aURL['user'];
			if (!empty($aURL['pass'])) {
				$sURL.= ':'.$aURL['pass'];
			}
			$sURL.= '@';
		}

		// Add the host
		$sURL.= $aURL['host'];

		// Add the port if needed
		if (!empty($aURL['port']) && (($aURL['scheme'] == 'http' && $aURL['port'] != 80) || ($aURL['scheme'] == 'https' && $aURL['port'] != 443))) {
			$sURL.= ':'.$aURL['port'];
		}

		// Add the path and the query string
		$sURL.= $aURL['path'].@$aURL['query'];

		// Clean up
		unset($aURL);
		return $sURL;
	}
	
	/**
	 * Returns true if the function name is associated with an object callback,
	 * false if not.
	 * 
	 * @param string the name of the function
	 * @access private
	 * @return boolean
	 */
	function _isObjectCallback($sFunction)
	{
		if (array_key_exists($sFunction, $this->aObjects)) return true;
		return false;
	}
	
	/**
	 * Returns true if the function or object callback can be called, false if
	 * not.
	 * 
	 * @param string the name of the function
	 * @access private
	 * @return boolean
	 */
	function _isFunctionCallable($sFunction)
	{
		if ($this->_isObjectCallback($sFunction)) {
			if (is_object($this->aObjects[$sFunction][0])) {
				return method_exists($this->aObjects[$sFunction][0], $this->aObjects[$sFunction][1]);
			}
			else {
				return is_callable($this->aObjects[$sFunction]);
			}
		}
		else {
			return function_exists($sFunction);
		}	
	}
	
	/**
	 * Calls the function, class method, or object method with the supplied
	 * arguments.
	 * 
	 * @param string the name of the function
	 * @param array  arguments to pass to the function
	 * @access private
	 * @return mixed the output of the called function or method
	 */
	function _callFunction($sFunction, $aArgs)
	{
		if ($this->_isObjectCallback($sFunction)) {
			$mReturn = call_user_func_array($this->aObjects[$sFunction], $aArgs);
		}
		else {
			$mReturn = call_user_func_array($sFunction, $aArgs);
		}
		return $mReturn;
	}
	
	/**
	 * Generates the Javascript wrapper for the specified PHP function.
	 * 
	 * @param string the name of the function
	 * @param mixed  the request type
	 * @access private
	 * @return string
	 */
	function _wrap($sFunction,$sRequestType=XAJAX_POST)
	{
		$js = "function ".$this->sWrapperPrefix."$sFunction(){return xajax.call(\"$sFunction\", arguments, ".$sRequestType.");}\n";		
		return $js;
	}

	/**
	 * Takes a string containing xajax xjxobj XML or xjxquery XML and builds an
	 * array representation of it to pass as an argument to the PHP function
	 * being called.
	 * 
	 * @param string the root tag of the XML
	 * @param string XML to convert
	 * @access private
	 * @return array
	 */
	function _xmlToArray($rootTag, $sXml)
	{
		$aArray = array();
		$sXml = str_replace("<$rootTag>","<$rootTag>|~|",$sXml);
		$sXml = str_replace("</$rootTag>","</$rootTag>|~|",$sXml);
		$sXml = str_replace("<e>","<e>|~|",$sXml);
		$sXml = str_replace("</e>","</e>|~|",$sXml);
		$sXml = str_replace("<k>","<k>|~|",$sXml);
		$sXml = str_replace("</k>","|~|</k>|~|",$sXml);
		$sXml = str_replace("<v>","<v>|~|",$sXml);
		$sXml = str_replace("</v>","|~|</v>|~|",$sXml);
		$sXml = str_replace("<q>","<q>|~|",$sXml);
		$sXml = str_replace("</q>","|~|</q>|~|",$sXml);
		
		$this->aObjArray = explode("|~|",$sXml);
		
		$this->iPos = 0;
		$aArray = $this->_parseObjXml($rootTag);
        
		return $aArray;
	}
	
	/**
	 * A recursive function that generates an array from the contents of
	 * $this->aObjArray.
	 * 
	 * @param string the root tag of the XML
	 * @access private
	 * @return array
	 */
	function _parseObjXml($rootTag)
	{
		$aArray = array();
		
		if ($rootTag == "xjxobj")
		{
			while(!stristr($this->aObjArray[$this->iPos],"</xjxobj>"))
			{
				$this->iPos++;
				if(stristr($this->aObjArray[$this->iPos],"<e>"))
				{
					$key = "";
					$value = null;
						
					$this->iPos++;
					while(!stristr($this->aObjArray[$this->iPos],"</e>"))
					{
						if(stristr($this->aObjArray[$this->iPos],"<k>"))
						{
							$this->iPos++;
							while(!stristr($this->aObjArray[$this->iPos],"</k>"))
							{
								$key .= $this->aObjArray[$this->iPos];
								$this->iPos++;
							}
						}
						if(stristr($this->aObjArray[$this->iPos],"<v>"))
						{
							$this->iPos++;
							while(!stristr($this->aObjArray[$this->iPos],"</v>"))
							{
								if(stristr($this->aObjArray[$this->iPos],"<xjxobj>"))
								{
									$value = $this->_parseObjXml("xjxobj");
									$this->iPos++;
								}
								else
								{
									$value .= $this->aObjArray[$this->iPos];
									if ($this->bDecodeUTF8Input)
									{
										$value = $this->_decodeUTF8Data($value);
									}
								}
								$this->iPos++;
							}
						}
						$this->iPos++;
					}
					
					$aArray[$key]=$value;
				}
			}
		}
		
		if ($rootTag == "xjxquery")
		{
			$sQuery = "";
			$this->iPos++;
			while(!stristr($this->aObjArray[$this->iPos],"</xjxquery>"))
			{
				if (stristr($this->aObjArray[$this->iPos],"<q>") || stristr($this->aObjArray[$this->iPos],"</q>"))
				{
					$this->iPos++;
					continue;
				}
				$sQuery	.= $this->aObjArray[$this->iPos];
				$this->iPos++;
			}
			
			parse_str($sQuery, $aArray);
			if ($this->bDecodeUTF8Input)
			{
				foreach($aArray as $key => $value)
				{
					$aArray[$key] = $this->_decodeUTF8Data($value);
				}
			}
			// If magic quotes is on, then we need to strip the slashes from the
			// array values because of the parse_str pass which adds slashes
			if (get_magic_quotes_gpc() == 1) {
				$newArray = array();
				foreach ($aArray as $sKey => $sValue) {
					if (is_string($sValue))
						$newArray[$sKey] = stripslashes($sValue);
					else
						$newArray[$sKey] = $sValue;
				}
				$aArray = $newArray;
			}
		}
		
		return $aArray;
	}
	
	/**
	 * Decodes string data from UTF-8 to the current xajax encoding.
	 * 
	 * @param string data to convert
	 * @access private
	 * @return string converted data
	 */
	function _decodeUTF8Data($sData)
	{
		$sValue = $sData;
		if ($this->bDecodeUTF8Input)
		{
			$sFuncToUse = NULL;
			
			if (function_exists('iconv'))
			{
				$sFuncToUse = "iconv";
			}
			else if (function_exists('mb_convert_encoding'))
			{
				$sFuncToUse = "mb_convert_encoding";
			}
			else if ($this->sEncoding == "ISO-8859-1")
			{
				$sFuncToUse = "utf8_decode";
			}
			else
			{
				trigger_error("The incoming xajax data could not be converted from UTF-8", E_USER_NOTICE);
			}
			
			if ($sFuncToUse)
			{
				if (is_string($sValue))
				{
					if ($sFuncToUse == "iconv")
					{
						$sValue = iconv("UTF-8", $this->sEncoding.'//TRANSLIT', $sValue);
					}
					else if ($sFuncToUse == "mb_convert_encoding")
					{
						$sValue = mb_convert_encoding($sValue, $this->sEncoding, "UTF-8");
					}
					else
					{
						$sValue = utf8_decode($sValue);
					}
				}
			}
		}
		return $sValue;	
	}
		
}// end class xajax 

/**
 * This function is registered with PHP's set_error_handler() function if
 * the xajax error handling system is turned on.
 */
function xajaxErrorHandler($errno, $errstr, $errfile, $errline)
{
	$errorReporting = error_reporting();
	if (($errno & $errorReporting) == 0) return;
	
	if ($errno == E_NOTICE) {
		$errTypeStr = "NOTICE";
	}
	else if ($errno == E_WARNING) {
		$errTypeStr = "WARNING";
	}
	else if ($errno == E_USER_NOTICE) {
		$errTypeStr = "USER NOTICE";
	}
	else if ($errno == E_USER_WARNING) {
		$errTypeStr = "USER WARNING";
	}
	else if ($errno == E_USER_ERROR) {
		$errTypeStr = "USER FATAL ERROR";
	}
	else if ($errno == E_STRICT) {
		return;
	}
	else {
		$errTypeStr = "UNKNOWN: $errno";
	}
	$GLOBALS['xajaxErrorHandlerText'] .= "\n----\n[$errTypeStr] $errstr\nerror in line $errline of file $errfile";
}

/**
 * xajaxCompress.php :: function to compress Javascript
 *
 * xajax version 0.2.4
 * copyright (c) 2005 by Jared White & J. Max Wilson
 * http://www.xajaxproject.org
 *
 * xajax is an open source PHP class library for easily creating powerful
 * PHP-driven, web-based Ajax Applications. Using xajax, you can asynchronously
 * call PHP functions and update the content of your your webpage without
 * reloading the page.
 *
 * xajax is released under the terms of the LGPL license
 * http://www.gnu.org/copyleft/lesser.html#SEC3
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 * 
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 * 
 * @package xajax
 * @version $Id$
 * @copyright Copyright (c) 2005-2006  by Jared White & J. Max Wilson
 * @license http://www.gnu.org/copyleft/lesser.html#SEC3 LGPL License
 */

/**
 * Compresses the Javascript code for more efficient delivery.
 * (used internally)
 * 
 * @param string contains the Javascript code to compress
 */
function xajaxCompressJavascript($sJS)
{
	//remove windows cariage returns
	$sJS = str_replace("\r","",$sJS);
	
	//array to store replaced literal strings
	$literal_strings = array();
	
	//explode the string into lines
	$lines = explode("\n",$sJS);
	//loop through all the lines, building a new string at the same time as removing literal strings
	$clean = "";
	$inComment = false;
	$literal = "";
	$inQuote = false;
	$escaped = false;
	$quoteChar = "";
	
	for($i=0;$i<count($lines);$i++)
	{
		$line = $lines[$i];
		$inNormalComment = false;
	
		//loop through line's characters and take out any literal strings, replace them with ___i___ where i is the index of this string
		for($j=0;$j<strlen($line);$j++)
		{
			$c = substr($line,$j,1);
			$d = substr($line,$j,2);
	
			//look for start of quote
			if(!$inQuote && !$inComment)
			{
				//is this character a quote or a comment
				if(($c=="\"" || $c=="'") && !$inComment && !$inNormalComment)
				{
					$inQuote = true;
					$inComment = false;
					$escaped = false;
					$quoteChar = $c;
					$literal = $c;
				}
				else if($d=="/*" && !$inNormalComment)
				{
					$inQuote = false;
					$inComment = true;
					$escaped = false;
					$quoteChar = $d;
					$literal = $d;	
					$j++;	
				}
				else if($d=="//") //ignore string markers that are found inside comments
				{
					$inNormalComment = true;
					$clean .= $c;
				}
				else
				{
					$clean .= $c;
				}
			}
			else //allready in a string so find end quote
			{
				if($c == $quoteChar && !$escaped && !$inComment)
				{
					$inQuote = false;
					$literal .= $c;
	
					//subsitute in a marker for the string
					$clean .= "___" . count($literal_strings) . "___";
	
					//push the string onto our array
					array_push($literal_strings,$literal);
	
				}
				else if($inComment && $d=="*/")
				{
					$inComment = false;
					$literal .= $d;
	
					//subsitute in a marker for the string
					$clean .= "___" . count($literal_strings) . "___";
	
					//push the string onto our array
					array_push($literal_strings,$literal);
	
					$j++;
				}
				else if($c == "\\" && !$escaped)
					$escaped = true;
				else
					$escaped = false;
	
				$literal .= $c;
			}
		}
		if($inComment) $literal .= "\n";
		$clean .= "\n";
	}
	//explode the clean string into lines again
	$lines = explode("\n",$clean);
	
	//now process each line at a time
	for($i=0;$i<count($lines);$i++)
	{
		$line = $lines[$i];
	
		//remove comments
		$line = preg_replace("/\/\/(.*)/","",$line);
	
		//strip leading and trailing whitespace
		$line = trim($line);
	
		//remove all whitespace with a single space
		$line = preg_replace("/\s+/"," ",$line);
	
		//remove any whitespace that occurs after/before an operator
		$line = preg_replace("/\s*([!\}\{;,&=\|\-\+\*\/\)\(:])\s*/","\\1",$line);
	
		$lines[$i] = $line;
	}
	
	//implode the lines
	$sJS = implode("\n",$lines);
	
	//make sure there is a max of 1 \n after each line
	$sJS = preg_replace("/[\n]+/","\n",$sJS);
	
	//strip out line breaks that immediately follow a semi-colon
	$sJS = preg_replace("/;\n/",";",$sJS);
	
	//curly brackets aren't on their own
	$sJS = preg_replace("/[\n]*\{[\n]*/","{",$sJS);
	
	//finally loop through and replace all the literal strings:
	for($i=0;$i<count($literal_strings);$i++)
		$sJS = str_replace("___".$i."___",$literal_strings[$i],$sJS);
	
	return $sJS;
}


/**
 * xajaxResponse.inc.php :: xajax XML response class
 *
 * xajax version 0.2.4
 * copyright (c) 2005 by Jared White & J. Max Wilson
 * http://www.xajaxproject.org
 *
 * xajax is an open source PHP class library for easily creating powerful
 * PHP-driven, web-based Ajax Applications. Using xajax, you can asynchronously
 * call PHP functions and update the content of your your webpage without
 * reloading the page.
 *
 * xajax is released under the terms of the LGPL license
 * http://www.gnu.org/copyleft/lesser.html#SEC3
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 * 
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 * 
 * @package xajax
 * @version $Id$
 * @copyright Copyright (c) 2005-2006  by Jared White & J. Max Wilson
 * @license http://www.gnu.org/copyleft/lesser.html#SEC3 LGPL License
 */

/*
   ----------------------------------------------------------------------------
   | Online documentation for this class is available on the xajax wiki at:   |
   | http://wiki.xajaxproject.org/Documentation:xajaxResponse.inc.php         |
   ----------------------------------------------------------------------------
*/

/**
 * The xajaxResponse class is used to create responses to be sent back to your
 * Web page.  A response contains one or more command messages for updating
 * your page.
 * Currently xajax supports 21 kinds of command messages, including some common
 * ones such as:
 * <ul>
 * <li>Assign - sets the specified attribute of an element in your page</li>
 * <li>Append - appends data to the end of the specified attribute of an
 * element in your page</li>
 * <li>Prepend - prepends data to the beginning of the specified attribute of
 * an element in your page</li>
 * <li>Replace - searches for and replaces data in the specified attribute of
 * an element in your page</li>
 * <li>Script - runs the supplied JavaScript code</li>
 * <li>Alert - shows an alert box with the supplied message text</li>
 * </ul>
 *
 * <i>Note:</i> elements are identified by their HTML id, so if you don't see
 * your browser HTML display changing from the request, make sure you're using
 * the right id names in your response.
 * 
 * @package xajax
 */
class xajaxResponse
{
	/**#@+
	 * @access protected
	 */
	/**
	 * @var string internal XML storage
	 */	
	var $xml;
	/**
	 * @var string the encoding type to use
	 */
	var $sEncoding;
	/**
	 * @var boolean if special characters in the XML should be converted to
	 *              entities
	 */
	var $bOutputEntities;

	/**#@-*/
	
	/**
	 * The constructor's main job is to set the character encoding for the
	 * response.
	 * 
	 * <i>Note:</i> to change the character encoding for all of the
	 * responses, set the XAJAX_DEFAULT_ENCODING constant before you
	 * instantiate xajax.
	 * 
	 * @param string  contains the character encoding string to use
	 * @param boolean lets you set if you want special characters in the output
	 *                converted to HTML entities
	 * 
	 */
	function xajaxResponse($sEncoding=XAJAX_DEFAULT_CHAR_ENCODING, $bOutputEntities=false)
	{
		$this->setCharEncoding($sEncoding);
		$this->bOutputEntities = $bOutputEntities;
	}
	
	/**
	 * Sets the character encoding for the response based on $sEncoding, which
	 * is a string containing the character encoding to use. You don't need to
	 * use this method normally, since the character encoding for the response
	 * gets set automatically based on the XAJAX_DEFAULT_CHAR_ENCODING
	 * constant.
	 * 
	 * @param string
	 */
	function setCharEncoding($sEncoding)
	{
		$this->sEncoding = $sEncoding;
	}
	
	/**
	 * Tells the response object to convert special characters to HTML entities
	 * automatically (only works if the mb_string extension is available).
	 */
	function outputEntitiesOn()
	{
		$this->bOutputEntities = true;
	}
	
	/**
	 * Tells the response object to output special characters intact. (default
	 * behavior)
	 */
	function outputEntitiesOff()
	{
		$this->bOutputEntities = false;
	}

	/**
	 * Adds a confirm commands command message to the XML response.
	 * 
	 * <i>Usage:</i> <kbd>$objResponse->addConfirmCommands(1, "Do you want to preview the new data?");</kbd>
	 *
	 * @param integer the number of commands to skip if the user presses
	 *                Cancel in the browsers's confirm dialog
	 * @param string  the message to show in the browser's confirm dialog
	 */
	function addConfirmCommands($iCmdNumber, $sMessage)
	{
		$this->xml .= $this->_cmdXML(array("n"=>"cc","t"=>$iCmdNumber),$sMessage);
	}
	
	/**
	 * Adds an assign command message to the XML response.
	 * 
	 * <i>Usage:</i> <kbd>$objResponse->addAssign("contentDiv", "innerHTML", "Some Text");</kbd>
	 * 
	 * @param string contains the id of an HTML element
	 * @param string the part of the element you wish to modify ("innerHTML",
	 *               "value", etc.)
	 * @param string the data you want to set the attribute to
	 */
	function addAssign($sTarget,$sAttribute,$sData)
	{
		$this->xml .= $this->_cmdXML(array("n"=>"as","t"=>$sTarget,"p"=>$sAttribute),$sData);
	}

	/**
	 * Adds an append command message to the XML response.
	 * 
	 * <i>Usage:</i> <kbd>$objResponse->addAppend("contentDiv", "innerHTML", "Some New Text");</kbd>
	 * 
	 * @param string contains the id of an HTML element
	 * @param string the part of the element you wish to modify ("innerHTML",
	 *               "value", etc.)
	 * @param string the data you want to append to the end of the attribute
	 */
	function addAppend($sTarget,$sAttribute,$sData)
	{	
		$this->xml .= $this->_cmdXML(array("n"=>"ap","t"=>$sTarget,"p"=>$sAttribute),$sData);
	}

	/**
	 * Adds an prepend command message to the XML response.
	 * 
	 * <i>Usage:</i> <kbd>$objResponse->addPrepend("contentDiv", "innerHTML", "Some Starting Text");</kbd>
	 * 
	 * @param string contains the id of an HTML element
	 * @param string the part of the element you wish to modify ("innerHTML",
	 *               "value", etc.)
	 * @param string the data you want to prepend to the beginning of the
	 *               attribute
	 */
	function addPrepend($sTarget,$sAttribute,$sData)
	{
		$this->xml .= $this->_cmdXML(array("n"=>"pp","t"=>$sTarget,"p"=>$sAttribute),$sData);
	}

	/**
	 * Adds a replace command message to the XML response.
	 * 
	 * <i>Usage:</i> <kbd>$objResponse->addReplace("contentDiv", "innerHTML", "text", "<b>text</b>");</kbd>
	 * 
	 * @param string contains the id of an HTML element
	 * @param string the part of the element you wish to modify ("innerHTML",
	 *               "value", etc.)
	 * @param string the string to search for
	 * @param string the string to replace the search string when found in the
	 *               attribute
	 */
	function addReplace($sTarget,$sAttribute,$sSearch,$sData)
	{
		$sDta = "<s><![CDATA[$sSearch]]></s><r><![CDATA[$sData]]></r>";
		$this->xml .= $this->_cmdXML(array("n"=>"rp","t"=>$sTarget,"p"=>$sAttribute),$sDta);
	}

	/**
	 * Adds a clear command message to the XML response.
	 * 
	 * <i>Usage:</i> <kbd>$objResponse->addClear("contentDiv", "innerHTML");</kbd>
	 * 
	 * @param string contains the id of an HTML element
	 * @param string the part of the element you wish to clear ("innerHTML",
	 *               "value", etc.)
	 */	
	function addClear($sTarget,$sAttribute)
	{
		$this->addAssign($sTarget,$sAttribute,'');
	}
	
	/**
	 * Adds an alert command message to the XML response.
	 * 
	 * <i>Usage:</i> <kbd>$objResponse->addAlert("This is important information");</kbd>
	 * 
	 * @param string the text to be displayed in the Javascript alert box
	 */
	function addAlert($sMsg)
	{
		$this->xml .= $this->_cmdXML(array("n"=>"al"),$sMsg);
	}

	/**
	 * Uses the addScript() method to add a Javascript redirect to another URL.
	 * 
	 * <i>Usage:</i> <kbd>$objResponse->addRedirect("http://www.xajaxproject.org");</kbd>
	 * 
	 * @param string the URL to redirect the client browser to
	 */	
	function addRedirect($sURL)
	{
		//we need to parse the query part so that the values are rawurlencode()'ed
		//can't just use parse_url() cos we could be dealing with a relative URL which
		//  parse_url() can't deal with.
		$queryStart = strpos($sURL, '?', strrpos($sURL, '/'));
		if ($queryStart !== FALSE)
		{
			$queryStart++;
			$queryEnd = strpos($sURL, '#', $queryStart);
			if ($queryEnd === FALSE)
				$queryEnd = strlen($sURL);
			$queryPart = substr($sURL, $queryStart, $queryEnd-$queryStart);
			parse_str($queryPart, $queryParts);
			$newQueryPart = "";
			foreach($queryParts as $key => $value)
			{
				$newQueryPart .= rawurlencode($key).'='.rawurlencode($value).ini_get('arg_separator.output');
			}
			$sURL = str_replace($queryPart, $newQueryPart, $sURL);
		}
		$this->addScript('window.location = "'.$sURL.'";');
	}

	/**
	 * Adds a Javascript command message to the XML response.
	 * 
	 * <i>Usage:</i> <kbd>$objResponse->addScript("var x = prompt('get some text');");</kbd>
	 * 
	 * @param string contains Javascript code to be executed
	 */
	function addScript($sJS)
	{
		$this->xml .= $this->_cmdXML(array("n"=>"js"),$sJS);
	}

	/**
	 * Adds a Javascript function call command message to the XML response.
	 * 
	 * <i>Usage:</i> <kbd>$objResponse->addScriptCall("myJSFunction", "arg 1", "arg 2", 12345);</kbd>
	 * 
	 * @param string $sFunc the name of a Javascript function
	 * @param mixed $args,... optional arguments to pass to the Javascript function
	 */
	function addScriptCall() {
		$arguments = func_get_args();
		$sFunc = array_shift($arguments);
		$sData = $this->_buildObjXml($arguments);
		$this->xml .= $this->_cmdXML(array("n"=>"jc","t"=>$sFunc),$sData);
	}

	/**
	 * Adds a remove element command message to the XML response.
	 * 
	 * <i>Usage:</i> <kbd>$objResponse->addRemove("Div2");</kbd>
	 * 
	 * @param string contains the id of an HTML element to be removed
	 */
	function addRemove($sTarget)
	{
		$this->xml .= $this->_cmdXML(array("n"=>"rm","t"=>$sTarget),'');
	}

	/**
	 * Adds a create element command message to the XML response.
	 * 
	 * <i>Usage:</i> <kbd>$objResponse->addCreate("parentDiv", "h3", "myid");</kbd>
	 * 
	 * @param string contains the id of an HTML element to to which the new
	 *               element will be appended.
	 * @param string the tag to be added
	 * @param string the id to be assigned to the new element
	 * @param string deprecated, use the addCreateInput() method instead
	 */
	function addCreate($sParent, $sTag, $sId, $sType="")
	{
		if ($sType)
		{
			trigger_error("The \$sType parameter of addCreate has been deprecated.  Use the addCreateInput() method instead.", E_USER_WARNING);
			return;
		}
		$this->xml .= $this->_cmdXML(array("n"=>"ce","t"=>$sParent,"p"=>$sId),$sTag);
	}

	/**
	 * Adds a insert element command message to the XML response.
	 * 
	 * <i>Usage:</i> <kbd>$objResponse->addInsert("childDiv", "h3", "myid");</kbd>
	 * 
	 * @param string contains the id of the child before which the new element
	 *               will be inserted
	 * @param string the tag to be added
	 * @param string the id to be assigned to the new element
	 */
	function addInsert($sBefore, $sTag, $sId)
	{
		$this->xml .= $this->_cmdXML(array("n"=>"ie","t"=>$sBefore,"p"=>$sId),$sTag);
	}

	/**
	 * Adds a insert element command message to the XML response.
	 * 
	 * <i>Usage:</i> <kbd>$objResponse->addInsertAfter("childDiv", "h3", "myid");</kbd>
	 * 
	 * @param string contains the id of the child after which the new element
	 *               will be inserted
	 * @param string the tag to be added
	 * @param string the id to be assigned to the new element
	 */
	function addInsertAfter($sAfter, $sTag, $sId)
	{
		$this->xml .= $this->_cmdXML(array("n"=>"ia","t"=>$sAfter,"p"=>$sId),$sTag);
	}
	
	/**
	 * Adds a create input command message to the XML response.
	 * 
	 * <i>Usage:</i> <kbd>$objResponse->addCreateInput("form1", "text", "username", "input1");</kbd>
	 * 
	 * @param string contains the id of an HTML element to which the new input
	 *               will be appended
	 * @param string the type of input to be created (text, radio, checkbox,
	 *               etc.)
	 * @param string the name to be assigned to the new input and the variable
	 *               name when it is submitted
	 * @param string the id to be assigned to the new input
	 */
	function addCreateInput($sParent, $sType, $sName, $sId)
	{
		$this->xml .= $this->_cmdXML(array("n"=>"ci","t"=>$sParent,"p"=>$sId,"c"=>$sType),$sName);
	}

	/**
	 * Adds an insert input command message to the XML response.
	 * 
	 * <i>Usage:</i> <kbd>$objResponse->addInsertInput("input5", "text", "username", "input1");</kbd>
	 * 
	 * @param string contains the id of the child before which the new element
	 *               will be inserted
	 * @param string the type of input to be created (text, radio, checkbox,
	 *               etc.)
	 * @param string the name to be assigned to the new input and the variable
	 *               name when it is submitted
	 * @param string the id to be assigned to the new input
	 */
	function addInsertInput($sBefore, $sType, $sName, $sId)
	{
		$this->xml .= $this->_cmdXML(array("n"=>"ii","t"=>$sBefore,"p"=>$sId,"c"=>$sType),$sName);
	}

	/**
	 * Adds an insert input command message to the XML response.
	 * 
	 * <i>Usage:</i> <kbd>$objResponse->addInsertInputAfter("input7", "text", "email", "input2");</kbd>
	 * 
	 * @param string contains the id of the child after which the new element
	 *               will be inserted
	 * @param string the type of input to be created (text, radio, checkbox,
	 *               etc.)
	 * @param string the name to be assigned to the new input and the variable
	 *               name when it is submitted
	 * @param string the id to be assigned to the new input
	 */
	function addInsertInputAfter($sAfter, $sType, $sName, $sId)
	{
		$this->xml .= $this->_cmdXML(array("n"=>"iia","t"=>$sAfter,"p"=>$sId,"c"=>$sType),$sName);
	}

	/**
	 * Adds an event command message to the XML response.
	 * 
	 * <i>Usage:</i> <kbd>$objResponse->addEvent("contentDiv", "onclick", "alert(\'Hello World\');");</kbd>
	 * 
	 * @param string contains the id of an HTML element
	 * @param string the event you wish to set ("onclick", "onmouseover", etc.)
	 * @param string the Javascript string you want the event to invoke
	 */
	function addEvent($sTarget,$sEvent,$sScript)
	{
		$this->xml .= $this->_cmdXML(array("n"=>"ev","t"=>$sTarget,"p"=>$sEvent),$sScript);
	}

	/**
	 * Adds a handler command message to the XML response.
	 * 
	 * <i>Usage:</i> <kbd>$objResponse->addHandler("contentDiv", "onclick", "content_click");</kbd>
	 * 
	 * @param string contains the id of an HTML element
	 * @param string the event you wish to set ("onclick", "onmouseover", etc.)
	 * @param string the name of a Javascript function that will handle the
	 *               event. Multiple handlers can be added for the same event
	 */
	function addHandler($sTarget,$sEvent,$sHandler)
	{	
		$this->xml .= $this->_cmdXML(array("n"=>"ah","t"=>$sTarget,"p"=>$sEvent),$sHandler);
	}

	/**
	 * Adds a remove handler command message to the XML response.
	 * 
	 * <i>Usage:</i> <kbd>$objResponse->addRemoveHandler("contentDiv", "onclick", "content_click");</kbd>
	 * 
	 * @param string contains the id of an HTML element
	 * @param string the event you wish to remove ("onclick", "onmouseover",
	 *               etc.)
	 * @param string the name of a Javascript handler function that you want to
	 *               remove
	 */
	function addRemoveHandler($sTarget,$sEvent,$sHandler)
	{	
		$this->xml .= $this->_cmdXML(array("n"=>"rh","t"=>$sTarget,"p"=>$sEvent),$sHandler);
	}

	/**
	 * Adds an include script command message to the XML response.
	 * 
	 * <i>Usage:</i> <kbd>$objResponse->addIncludeScript("functions.js");</kbd>
	 * 
	 * @param string URL of the Javascript file to include
	 */
	function addIncludeScript($sFileName)
	{
		$this->xml .= $this->_cmdXML(array("n"=>"in"),$sFileName);
	}

	/**	
	 * Returns the XML to be returned from your function to the xajax processor
	 * on your page. Since xajax 0.2, you can also return an xajaxResponse
	 * object from your function directly, and xajax will automatically request
	 * the XML using this method call.
	 * 
	 * <i>Usage:</i> <kbd>return $objResponse->getXML();</kbd>
	 * 
	 * @return string response XML data
	 */
	function getXML()
	{
		$sXML = "<?xml version=\"1.0\"";
		if ($this->sEncoding && strlen(trim($this->sEncoding)) > 0)
			$sXML .= " encoding=\"".$this->sEncoding."\"";
		$sXML .= " ?"."><xjx>" . $this->xml . "</xjx>";
		
		return $sXML;
	}
	
	/**
	 * Adds the commands of the provided response XML output to this response
	 * object
	 * 
	 * <i>Usage:</i>
	 * <code>$r1 = $objResponse1->getXML();
	 * $objResponse2->loadXML($r1);
	 * return $objResponse2->getXML();</code>
	 * 
	 * @param string the response XML (returned from a getXML() method) to add
	 *               to the end of this response object
	 */
	function loadXML($mXML)
	{
		if (is_a($mXML, "xajaxResponse")) {
			$mXML = $mXML->getXML();
		}
		$sNewXML = "";
		$iStartPos = strpos($mXML, "<xjx>") + 5;
		$sNewXML = substr($mXML, $iStartPos);
		$iEndPos = strpos($sNewXML, "</xjx>");
		$sNewXML = substr($sNewXML, 0, $iEndPos);
		$this->xml .= $sNewXML;
	}

	/**
	 * Generates XML from command data
	 * 
	 * @access private
	 * @param array associative array of attributes
	 * @param string data
	 * @return string XML command
	 */
	function _cmdXML($aAttributes, $sData)
	{
		if ($this->bOutputEntities) {
			if (function_exists('mb_convert_encoding')) {
				$sData = call_user_func_array('mb_convert_encoding', array(&$sData, 'HTML-ENTITIES', $this->sEncoding));
			}
			else {
				trigger_error("The xajax XML response output could not be converted to HTML entities because the mb_convert_encoding function is not available", E_USER_NOTICE);
			}
		}
		$xml = "<cmd";
		foreach($aAttributes as $sAttribute => $sValue)
			$xml .= " $sAttribute=\"$sValue\"";
		if ($sData !== null && !stristr($sData,'<![CDATA['))
			$xml .= "><![CDATA[$sData]]></cmd>";
		else if ($sData !== null)
			$xml .= ">$sData</cmd>";
		else
			$xml .= "></cmd>";
		
		return $xml;
	}

	/**
	 * Recursively serializes a data structure in XML so it can be sent to
	 * the client. It could be thought of as the opposite of
	 * {@link xajax::_parseObjXml()}.
	 * 
	 * @access private
	 * @param mixed data structure to serialize to XML
	 * @return string serialized XML
	 */
	function _buildObjXml($var) {
		if (gettype($var) == "object") $var = get_object_vars($var);
		if (!is_array($var)) {
			return "<![CDATA[$var]]>";
		}
		else {
			$data = "<xjxobj>";
			foreach ($var as $key => $value) {
				$data .= "<e>";
				$data .= "<k>" . htmlspecialchars($key) . "</k>";
				$data .= "<v>" . $this->_buildObjXml($value) . "</v>";
				$data .= "</e>";
			}
			$data .= "</xjxobj>";
			return $data;
		}
	}
	
}// end class xajaxResponse


?>