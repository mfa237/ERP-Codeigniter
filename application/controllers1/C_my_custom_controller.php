<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_my_custom_controller extends MY_Controller {

    /* ====================================
        Controller for testing function
        - If program ready for launch, make sure this controller cannot be access
        - If in develop periode, you can use this controller for testing your function
        - You can active and non active this controller from config/routes.php
    ==================================== */

	public function __construct() {
        parent::__construct();
	}

    public function index() {
    }

}
