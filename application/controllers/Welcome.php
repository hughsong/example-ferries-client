<?php

class Welcome extends Application {

	function __construct()
	{
		parent::__construct();
		$this->load->model('ferryschedule');
		$this->data['pagetitle'] = 'Ferry Trip Planner (Client)';
	}

	/**
	 * Sets up the form and renders it.
	 */
	function index()
	{
		$this->load->helper('formfields');
		$this->data['title'] = 'Ferry Trip Planner';
		$this->data['pagebody'] = 'planner';

		// get all the ports from our model
		$ports = $this->ferryschedule->getPorts();

		$this->data['leaving'] = makeCombobox("Leaving from", "leaving", "TS", $ports);
		$this->data['destination'] = makeCombobox("Destination", "destination", "LH", $ports);
		$this->data['submit'] = makeSubmitButton("Submit", "Submit");

		$this->render();
	}

	/**
	 * Displays all the sailings that can be taken for the desired
	 * origin and destination specified on the homepage.
	 */
	function results()
	{
		$this->data['title'] = 'Your Custom Travel Plan';
		$this->data['errormessages'] = '';
		$this->data['pagebody'] = 'show_results';
		$ports = $this->ferryschedule->getPorts();
		$origin = $ports[$this->input->post('leaving')];
		$depart = $ports[$this->input->post('destination')];
		$this->data['origin'] = $origin;
		$this->data['destination'] = $depart;
		$sailings = array();
		// get the result from the model
		$result = $this->ferryschedule->findSailings(
				$this->input->post('leaving'), $this->input->post('destination'));
		// add each result to our sailings array
		foreach ($result as $sailing)
		{
			$sailings[] = $sailing;
		}
		// display an error if there are no sailings
		if (empty($sailings))
		{
			$this->errors[] = "Sorry, but you can't get there from here!";
		}
		$this->data['sailings'] = $sailings;

		$this->render();
	}

}
