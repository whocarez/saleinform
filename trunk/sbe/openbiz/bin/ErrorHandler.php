<?php
/**
 * Openbiz Error Handler can handle php error and uncaught exception.
 * The default behavior is to show popup on client side. Developer can overide it to add more logic
 *
 * @package BizSystem
 * @author rocky swen
 * @copyright Copyright (c) 2005
 * @access public
 */
class OB_ErrorHandler
{
   /**
    * User error handler
    **/
   public static function ErrorHandler($errno, $errmsg, $filename, $linenum, $vars)
   {
       // don't respond to the error if it
       // was suppressed with a '@'
       if (error_reporting() == 0) return;
    
       // set of errors for which a var trace will be saved
       $user_errors = array(E_USER_ERROR, E_USER_WARNING, E_USER_NOTICE);

       // Zend_Translate code uses exception handling
       // but if warnings are displayed exception can't be thrown, so we disable warnings here too
		if ($errno == E_NOTICE || $errno == E_STRICT) // || $errno == E_WARNING) 
		    return;  // ignore notice error

       $err = self::GetOutputErrorMsg($errno, $errmsg, $filename, $linenum);
       self::ErrorBacktrace();

       global $g_BizSystem;
       echo $g_BizSystem->GetClientProxy()->ShowErrorPopup($err);

       if ($errno == E_USER_ERROR || $errno == E_ERROR)
          exit;
   }
   
   /**
    * User exception handler
    **/
   public static function ExceptionHandler($exc)
   {
        $errno = $exc->getCode();
        $errmsg = $exc->getMessage();
        $filename = $exc->getFile();
        $linenum = $exc->getLine();
        $backtrace = $exc->getTrace();
        
        $err = self::GetOutputErrorMsg($errno, $errmsg, $filename, $linenum);
        global $g_BizSystem;
        echo $g_BizSystem->GetClientProxy()->ShowErrorPopup($err);
        exit;
   }
   
   /**
    * Get output error message
    * @return string error message in html
    */
   private static function GetOutputErrorMsg($errno, $errmsg, $filename, $linenum)
   {
      // timestamp for the error entry
       date_default_timezone_set('GMT');   // to avoid error PHP 5.1
       $dt = date("Y-m-d H:i:s (T)");
        
       $err = "<div style='font-size: 12px; color: blue; font-family:Arial; font-weight:bold;'>";
       $err .= "[$dt] An exception occurred while executing this script:<br>";
       $err .= "Error message: <font color=maroon> #$errno, $errmsg</font><br>";
       $err .= "Script name and line number of error: <font color=maroon>$filename:$linenum</font><br>";
       //$err .= "Variable state when error occurred: $vars<br>";
       $err .= "<hr>";
       $err .= "Please ask system administrator for help...</div>";
       return $err;
   }

   /**
    * Print out call stack of the error
    */
   private static function ErrorBacktrace($print=true)
   {
       $debug_array = debug_backtrace();
       $counter = count($debug_array);
       for($tmp_counter = 0; $tmp_counter != $counter; ++$tmp_counter)
       {
          echo "<br><b>function:</b> ";
          echo $debug_array[$tmp_counter]["function"] . " ( ";
          //count how many args a there
          $args_counter = count($debug_array[$tmp_counter]["args"]);
          //print them
          for($tmp_args_counter = 0; $tmp_args_counter != $args_counter; ++$tmp_args_counter)
          {
             echo($debug_array[$tmp_counter]["args"][$tmp_args_counter]);
             if(($tmp_args_counter + 1) != $args_counter)
               echo(", ");
             else
               echo(" ");
          }
          echo ") @ ";
          echo($debug_array[$tmp_counter]["file"]." ");
          echo($debug_array[$tmp_counter]["line"]);
          if(($tmp_counter + 1) != $counter)
             echo "\n";
       }
       //exit();
   }
}
?>