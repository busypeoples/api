<?php
if(!defined('BASE_HTTP')) {
   header("HTTP 1.1 400 BAD REQUEST");
   echo 'no access allowed';
   die();
}

require_once('restrequest.php');

/**
 * @package REST_API
 * @version 1.0
 *
 */
 
class RestUtils {
	
	public static function processRequest() {
		$request_method = strtolower($_SERVER['REQUEST_METHOD']);
		$return_obj = new RestRequest();
		$data = array();
		
		switch($request_method) {
			case 'get' :
				$data = $_GET;
				break;
			case 'post' :
				$data = $_POST;
				break;
			case 'put' :
				parse_str(file_get_contents("php://input"), $put_vars);
				$data = $put_vars;
				break;
		}
		
		$return_obj->setMethod($request_method);
		
		$return_obj->setRequestVars($data);
		
		if(isset($data['data'])) {
			$return_obj->setData(json_decode($data['data']));
		}
		
		return $return_obj;
	}
	
	public static function sendResponse($status = 200, $body = '', $content_type = 'text/html')
	{
		$status_header = 'HTTP/1.1 ' . $status . ' ' . RestUtils::getStatusCodeMessage($status);
		// set the status
		header($status_header);
		// set the content type
		header('Content-type: ' . $content_type);

		// pages with body are easy
		if($body != '')
		{
			// send the body
			echo $body;
			exit;
		}
		// we need to create the body if none is passed
		else
		{
			// create some body messages
			$message = '';

			// this is purely optional, but makes the pages a little nicer to read
			// for your users.  Since you won't likely send a lot of different status codes,
			// this also shouldn't be too ponderous to maintain
			switch($status)
			{
				case 401:
					$message = 'You must be authorized to view this page.';
					break;
				case 404:
					$message = 'The requested URL ' . $_SERVER['REQUEST_URI'] . ' was not found.';
					break;
				case 500:
					$message = 'The server encountered an error processing your request.';
					break;
				case 501:
					$message = 'The requested method is not implemented.';
					break;
			}

			// servers don't always have a signature turned on (this is an apache directive "ServerSignature On")
			$signature = ($_SERVER['SERVER_SIGNATURE'] == '') ? $_SERVER['SERVER_SOFTWARE'] . ' Server at ' . $_SERVER['SERVER_NAME'] . ' Port ' . $_SERVER['SERVER_PORT'] : $_SERVER['SERVER_SIGNATURE'];

			// this should be templatized in a real-world solution
			$body = '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
						<html>
							<head>
								<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
								<title>' . $status . ' ' . RestUtils::getStatusCodeMessage($status) . '</title>
							</head>
							<body>
								<h1>' . RestUtils::getStatusCodeMessage($status) . '</h1>
								<p>' . $message . '</p>
								<hr />
								<address>' . $signature . '</address>
							</body>
						</html>';

			echo $body;
			exit;
		}
	
	}
	
	public static function getStatusCodeMessage($status) {
	//@todo store in a .ini files and load with parse_ini_file()
		$codes = array(
			100 => 'Continue',	
			101 => 'Switching Protocols',
			200 => 'OK',
			201 => 'Created',
			202 => 'Accepted',
			203 => 'Non-Authoritative Information',
			204 => 'No Content',
			205 => 'Reset Content',
			206 => 'Partial Content',
			300 => 'Multiple Choices',
			301 => 'Moved Permanently',
			302 => 'Found',
			303 => 'See Other',
			304 => 'Not Modified',
			305 => 'Use Proxy',
			307 => 'Temporaray Redirect',
			400 => 'Bad Request',
			401 => 'Unauthorized',	
			402 => 'Payment Required',
			403 => 'Forbidden',
			404 => 'Not Found',
			405 => 'Method Not Allowed',
			406 => 'Not Acceptable',
			407 => 'Proxy Authentication Required',
			408 => 'Request Timeout',
			409 => 'Conflict',
			410 => 'Gone',
			411 => 'Length Required',
			412 => 'Recondition Failed',
			500 => 'Internal Server Error',
			501 => 'Not Implemented',
			502 => 'Bad Gateway',
			503 => 'Service Unavailable',
			504 => 'Gateway Timeout',
			505 => 'HTTP Version Not Supported'
		);
		return (isset($codes[$status]))? $codes[$status] : '';
	}
} 

$data = RestUtils::processRequest();


switch($data->getMethod()) {
	// this is a request for all users, not one in particular
	case 'get':
		//$user_list = array("hello", "hi", "yo"); // assume this returns an array//
                $mainModel = new Main_Model();
                $stats = $mainModel->getData(1);
                // check against data

		if($data->getHttpAccept() == 'json')
		{
			RestUtils::sendResponse(200, json_encode($stats), 'application/json');
		}
		else if ($data->getHttpAccept() == 'xml')
		{
			// using the XML_SERIALIZER Pear Package
			$options = array
			(
				'indent' => '     ',
				'addDecl' => false,
				'rootName' => $fc->getAction(),
				XML_SERIALIZER_OPTION_RETURN_RESULT => true
			);
			$serializer = new XML_Serializer($options);

			RestUtils::sendResponse(200, $serializer->serialize($user_list), 'application/xml');
		}

		break;
	// new user create
	case 'post':
		$user = new User();
		$user->setFirstName($data->getData()->first_name);  // just for example, this should be done cleaner
		// and so on...
		$user->save();

		// just send the new ID as the body
		RestUtils::sendResponse(201, $user->getId());
		break;
}