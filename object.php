<?php

/**
 * @package REST_API
 * @version 1.0
 *
 */
abstract class RA_Object 
{

	protected $log;

	protected $me;

	/**
	 * constructor
	 * @access public
	 */
	public function __construct() 
	{
		$this->log = Log::factory('file', FR_LOG_FILE);
		$this->me = new ReflectionClass($this);
	}

	/**
	 * return 
	 * @access public
	 * @param mixed $data Array of variables.
	 * @return void
	 */
	public function setFrom($data) 
	{
		if(is_array($data) && count($data)) {
			$valid = get_class_vars(get_class($this));
			foreach($valid as $var=>$val) {
				if(isset($data[$var])) {
					$this->var = $data[$var];
				}
			}
		}
	} 
}