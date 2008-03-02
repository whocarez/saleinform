<?php

/*
	Copyright (C) 2003-2007 UseBB Team
	http://www.usebb.net
	
	$Header: /cvsroot/usebb/UseBB/sources/db_mysqli.php,v 1.24 2007/01/01 11:58:47 pc_freak Exp $
	
	This file is part of UseBB.
	
	UseBB is free software; you can redistribute it and/or modify
	it under the terms of the GNU General Public License as published by
	the Free Software Foundation; either version 2 of the License, or
	(at your option) any later version.
	
	UseBB is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.
	
	You should have received a copy of the GNU General Public License
	along with UseBB; if not, write to the Free Software
	Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

/**
 * MySQLi database driver
 *
 * Contains the db class for MySQLi handling.
 *
 * @author	UseBB Team
 * @link	http://www.usebb.net
 * @license	GPL-2
 * @version	$Revision: 1.24 $
 * @copyright	Copyright (C) 2003-2007 UseBB Team
 * @package	UseBB
 * @subpackage Core
 */

//
// Die when called directly in browser
//
if ( !defined('INCLUDED') )
	exit();

if ( !extension_loaded('mysqli') && !defined('NO_DB') )
	trigger_error('Unable to load module for database server "mysqli": PHP mysqli extension not available!', E_USER_ERROR);

ini_set('mysql.trace_mode', '0');

/**
 * MySQLi database driver
 *
 * Performs database handling for MySQLi.
 *
 * @author	UseBB Team
 * @link	http://www.usebb.net
 * @license	GPL-2
 * @version	$Revision: 1.24 $
 * @copyright	Copyright (C) 2003-2007 UseBB Team
 * @package	UseBB
 * @subpackage Core
 */
class db {
	
	/**#@+
	 * @access private
	 */
	var $connection;
	var $queries = array();
	/**#@-*/
	
	/**
	 * Make a connection to the MySQL server
	 *
	 * @param array $config Database configuration
	 */
	function connect($config) {
		
		global $functions;
		
		if ( defined('NO_DB') )
			return;
		
		//
		// Connect to server
		//
		$this->connection = @mysqli_connect($config['server'], $config['username'], $config['passwd']) or trigger_error('SQL: '.mysqli_error($this->connection), E_USER_ERROR);
		
		//
		// Select database
		//
		@mysqli_select_db($this->connection, $config['dbname']) or trigger_error('SQL: '.mysqli_error($this->connection), E_USER_ERROR);
		
		//
		// Set transaction to latin1
		//
		if ( $functions->get_config('force_latin1_db', true) )
			$this->query("SET NAMES latin1", true, false);
		
	}
	
	/**
	 * Execute database queries
	 *
	 * @param string $query SQL query
	 * @param bool $return_error Return error instead of giving general error
	 * @returns mixed SQL result resource or SQL error (only when $return_error is true)
	 */
	function query($query, $return_error=false, $log=true) {
		
		global $functions;
		
		if ( $log )
			$this->queries[] = preg_replace('#\s+#', ' ', $query);
		$result = @mysqli_query($this->connection, $query) or $error = mysqli_error($this->connection);
		if ( isset($error) ) {
			
			if ( $return_error ) 
				return $error;
			else
				trigger_error('SQL: '.$error, E_USER_ERROR);
			
		}
		return $result;
		
	}
	
	/**
	 * Fetch query results
	 *
	 * @param resource $result SQL query resource
	 * @returns array Array containing one result
	 */
	function fetch_result(&$result) {
		
		return mysqli_fetch_array($result, MYSQLI_ASSOC);
		
	}
	
	/**
	 * Count row number
	 *
	 * @param resource $result SQL query resource
	 * @returns int Number of result rows
	 */
	function num_rows(&$result) {
		
		return mysqli_num_rows($result);
		
	}
	
	/**
	 * Last inserted ID
	 *
	 * @returns int Last inserted auto increment ID
	 */
	function last_id() {
		
		return mysqli_insert_id($this->connection);
		
	}
	
	/**
	 * Get used queries array
	 *
	 * @returns array Array containing executed queries
	 */
	function get_used_queries() {
		
		return $this->queries;
		
	}
	
	/**
	 * Get server version info
	 *
	 * @returns array Array containing database driver info and server version
	 */
	function get_server_info() {
		
		return array(
			'MySQL (mysqli)',
			mysqli_get_server_info($this->connection)
		);
		
	}
	
	/**
	 * Disconnect the database connection
	 */
	function disconnect() {
		
		@mysqli_close($this->connection);
		
	}
	
}

?>
