<?php

// TODO global.php MUST BE PLACED ONE FILE LEVEL ABOVE TO FUNCTION
include_once '../global.php';

// get the identifier for the page we want to load
$action = $_GET['action'];

// instantiate a controller and route it
$sc = new Index();
$sc->route($action);


class Index{
	
	// route us to the appropriate class method for this action
	public function route($action) {
		switch($action) {
			
			// home page, login, logout
			case 'home':
				$this->home();
				break;
			case 'login':
				$this->login();
				break;
			case 'loginSubmit':
				$username = $_POST['username'];
				$password = $_POST['pw'];
				$this -> loginSubmit($username, $password);
				break;
			case 'loginSuccess':
				$this -> loginSuccess();
				break;
			case 'logout':
				$this -> logout();
				break;
				
			// add location/people
			case 'add_loc':
				$this->add_location();
				break;
			case 'confirm_loc':
				$this->confirm_location();
				break;
			case 'add_person':
				$this->add_person();
				break;
			case 'confirm_person':
				$this->confirm_person();
				break;
				
			// display/edit people
			case 'view_person':
				$name = $_GET['name'];
				$this->view_person($name);
				break;
			case 'edit_person':
				$name = $_GET['name'];
				$this->edit_person($name);
				break;
			case 'edit_person_complete':
				$name = $_GET['name'];
				$this->edit_person_complete($name);
				break;
				
			// display/edit locations
			case 'view_loc':
				$name = $_GET['name'];
				$this->view_loc($name);
				break;
			case 'edit_loc':
				$name = $_GET['name'];
				$this->edit_loc($name);
				break;
			case 'edit_loc_complete':
				$name = $_GET['name'];
				$this->edit_loc_complete($name);
				break;
			
			
			// list view
			case 'list_locations':
				$this->list_locations();
				break;
			case 'list_people':
				$this->list_people();
				break;
		}
	}
	
	//////////////////////////////////////////////////////////////////////////////////
	
	public function home() {
		$pageTitle = 'Home';
		include_once SYSTEM_PATH.'/view/header.tpl';
		include_once SYSTEM_PATH.'/view/home.tpl';
		include_once SYSTEM_PATH.'/view/footer.tpl';
	}

	public function login(){
		$pageTitle = 'Login';
		include_once SYSTEM_PATH.'/view/header.tpl';
		include_once SYSTEM_PATH.'/view/login.tpl';
		include_once SYSTEM_PATH.'/view/footer.tpl';
	}
	
	public function loginSubmit($un, $pw){		
		// TODO correct username/password
		$correctUsername = 'Joseph';
		$correctPassword = 'Joestar';
		
		// bounce to login if unsuccessful
		if($un != $correctUsername)
			header('Location: '.BASE_URL.'/login');
		elseif($pw != $correctPassword)
			header('Location: '.BASE_URL.'/login');
			
		// if correct username/pw, send to confirmation screen
		else {
			$_SESSION['username'] = $un;
			// Moves to dashboard page
			header('Location: '.BASE_URL);
		}
	}
	
	public function loginSuccess(){
		$pageTitle = "Welcome";
		// TODO post template here
		// we can get rid of the dashboard page if we don't want it
	}
	
	public function logout(){
		// end session
		unset($_SESSION['username']);
		session_destroy();
		// return to home page
		header('Location: '.BASE_URL);
	}
	
	//////////////////////////////////////////////////////////////////////////////////
	
	public function add_person(){
		// can not add if not logged in
		// TODO uncomment this
		// if(!isset($_SESSION['username'])){
		// 	header('Location: '.BASE_URL);
		// }
		
		$pageTitle = "Add New Person";
		include_once SYSTEM_PATH.'/view/header.tpl';
		include_once SYSTEM_PATH.'/view/add_person.tpl';
		include_once SYSTEM_PATH.'/view/footer.tpl';
	}
	
	public function confirm_person(){
		
		// can not edit if not logged in
		if(!isset($_SESSION['username'])){
			header('Location: '.BASE_URL);
		}
		
		// get POST variables
		$name 	 			= $_POST['name_in']; // required
		$date_captured		= $_POST['date_captured_in'];
		$age	 			= $_POST['age_in'];
		$etc 		 		= $_POST['etc_in'];

		// name is required
		if( empty($name)) {
			header('Location: '.BASE_URL.'/add_person/');
		}

		$person = new Person();
		
		$person->name = $name;
		$person->date_captured = $date_captured;
		$person->age = $age;
		$person->etc = $etc;

		$memID = $person->p_save();
		$name = ucwords(str_replace(" ", "_", $name));
		header('Location: '.BASE_URL.'/people/'.$name);
	}
	
	public function add_loc(){
		// can not add if not logged in
		if(!isset($_SESSION['username'])){
			header('Location: '.BASE_URL);
		}
		
		$pageTitle = "Add New Location";
		// TODO post template here
	}
	
	public function confirm_loc(){
		
		// can not edit if not logged in
		if(!isset($_SESSION['username'])){
			header('Location: '.BASE_URL);
		}
		
		// get POST variables
		$name 	 			= $_POST['name_in']; // required
		$activities			= $_POST['activities_in'];
		$staff	 			= $_POST['staff_in'];
		$capacity		 	= $_POST['capacity_in'];
		$cost		 		= $_POST['cost_in'];

		// name is required
		if( empty($name)) {
			header('Location: '.BASE_URL.'/add_location/');
		}

		$place = new Location();
		
		$place->name = $name;
		$place->activities = $activities;
		$place->staff = $staff;
		$place->capacity = $capacity;
		$place->cost = $cost;

		$memID = $place->l_save();
		$name = ucwords(str_replace(" ", "_", $name));
		header('Location: '.BASE_URL.'/locations/'.$name);
	}
	
	//////////////////////////////////////////////////////////////////////////////////
	
	public function view_person($name){
		// title
		$name = ucwords(str_replace("_", " ", $name));
		$pageTitle = $name;
		
		include_once SYSTEM_PATH.'/view/header.tpl';
		
		// check if valid, and post
		$person = Person::p_loadByName($name);
		if($person != null) {
			include_once SYSTEM_PATH.'/view/person.tpl';
		} else {
			die('Invalid name');
		}
		
		include_once SYSTEM_PATH.'/view/header.tpl';
	}
	
	public function edit_person($name){
		
		// can not edit if not logged in
		if(!isset($_SESSION['username'])){
			header('Location: '.BASE_URL);
		}
		
		// title
		$name = ucwords(str_replace("_", " ", $name));
		$pageTitle = "Edit $name";
		
		// TODO add header templates
		
		// check if valid, and post
		$person = Person::p_loadByName($name);
		if($person != null) {
			// TODO add content template
		} else {
			die('Invalid name');
		}
		
		//  TODO add footer template
	}
	
	public function edit_person_complete($name){
		
		// can not edit if not logged in
		if(!isset($_SESSION['username'])){
			header('Location: '.BASE_URL);
		}
		
		// get POST variables
		$name 	 			= $_POST['name_in'];
		$date_captured		= $_POST['date_captured_in'];
		$age	 			= $_POST['age_in'];
		$etc 		 		= $_POST['etc_in'];

		
		$name = ucwords(str_replace("_", " ", $name));
		$person = Person::p_loadByName($name);
		
		$person->name = $name;
		$person->date_captured = $date_captured;
		$person->age = $age;
		$person->etc = $etc;
		
		$memID = $person->p_save();
		$name = ucwords(str_replace(" ", "_", $name));
		header('Location: '.BASE_URL.'/people/'.$name);
	}
	
	
	//////////////////////////////////////////////////////////////////////////////////
	
	public function view_loc($name){
		// title
		$name = ucwords(str_replace("_", " ", $name));
		$pageTitle = $name;
		
		// TODO add header templates
		
		// check if valid, and post
		$place = Location::l_loadByName($name);
		if($person != null) {
			// TODO add content template
		} else {
			die('Invalid name');
		}
		
		//  TODO add footer template
	}
	
	public function edit_loc($name){
		
		// can not edit if not logged in
		if(!isset($_SESSION['username'])){
			header('Location: '.BASE_URL);
		}
		
		// title
		$name = ucwords(str_replace("_", " ", $name));
		$pageTitle = "Edit $name";
		
		// TODO add header templates
		
		// check if valid, and post
		$place = Location::l_loadByName($name);
		if($place != null) {
			// TODO add content template
		} else {
			die('Invalid name');
		}
		
		//  TODO add footer template
	}
	
	public function edit_loc_complete($name){
		
		// can not edit if not logged in
		if(!isset($_SESSION['username'])){
			header('Location: '.BASE_URL);
		}
		
		// get POST variables
		$name 	 			= $_POST['name_in']; // required
		$activities			= $_POST['activities_in'];
		$staff	 			= $_POST['staff_in'];
		$capacity		 	= $_POST['capacity_in'];
		$cost		 		= $_POST['cost_in'];

		
		$name = ucwords(str_replace("_", " ", $name));
		$place = Location::l_loadByName($name);
		
		$place->name = $name;
		$place->activities = $activities;
		$place->staff = $staff;
		$place->capacity = $capacity;
		$place->cost = $cost;
		
		$memID = $place->l_save();
		$name = ucwords(str_replace(" ", "_", $name));
		header('Location: '.BASE_URL.'/locations/'.$name);
	}
	
	
	//////////////////////////////////////////////////////////////////////////////////
	
	public function list_people(){
		$pageTitle = "People";
		
		include_once SYSTEM_PATH.'/view/header.tpl';	

		// get list of all persons and display 
		$list = Person::getPeople();
		
		include_once SYSTEM_PATH.'/view/people.tpl';
		include_once SYSTEM_PATH.'/view/footer.tpl';
		
	}
	
	public function list_locations(){
		$pageTitle = "People";
		
		// TODO add header templates
		
		// get list of all persons and display 
		$list = Location::getLocations();
		// TODO add content template
		
		//  TODO add footer template
		
	}

}