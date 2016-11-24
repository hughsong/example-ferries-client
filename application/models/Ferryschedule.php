<?php

/**
 * Modified to use REST client to get port data from our server.
 */
define('REST_SERVER', 'http://server.local');	// the REST server host
define('REST_PORT', $_SERVER['SERVER_PORT']);				// the port you are running the server on
define('RPC_SERVER', 'http://server.local');	// the XML-RPC server host
define('RPC_PORT', $_SERVER['SERVER_PORT']);				// the port you are running the server on

class Ferryschedule extends CI_Model {

	private $xml;

	/**
	 * Manage the ferry schedule sorta -> it is now done server-side
	 */
	function __construct()
	{
		parent::__construct();

		//*** Explicitly load the REST libraries. 
		$this->load->library(['curl', 'format', 'rest']);
	}

	/**
	 * Returns all the ports from the REST server
	 * @return the ports
	 */
	function getPorts()
	{
		$this->rest->initialize(array('server' => REST_SERVER));
		$this->rest->option(CURLOPT_PORT, REST_PORT);
		$result = $this->rest->get('ports');
		return $result;
	}

	/**
	 * Finds all the sailings from the desired origin to the
	 * desired destination.
	 * Use XML-RPC!!! *************
	 * @param type $origin the origin of the trip
	 * @param type $destination the trip destination
	 * @return string all of the sailings from origin to destination
	 */
	function findSailings($origin, $destination)
	{
        // Prepare for XML-RPC ***
        $this->load->library('xmlrpc');
        $this->xmlrpc->server(RPC_SERVER . ':' . RPC_PORT . '/sailings');
        $this->xmlrpc->method('lookup');  // this is mapped by the server
		$this->xmlrpc->set_debug(true);

        $request = array(
            array($origin, 'string'),
            array($destination, 'string'),
            'struct'
        );
        $this->xmlrpc->request($request);

        if (!$this->xmlrpc->send_request())
        {
            echo $this->xmlrpc->display_error();
            exit();
        }

        $answer = $this->xmlrpc->display_response();
        return $answer;
	}

}
