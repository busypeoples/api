<?php

namespace Sling\Logger;

/**
 * @package REST_API
 * @version 1.0
 *
 */
interface LoggerInterface {
	
	public function setLogs($logData);

	public function getLogs();

}