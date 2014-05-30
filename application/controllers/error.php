<?php

class Error extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('MY_Router');
    }

    function error_404() {
        $this->output->set_status_header('404');
        echo "404 - not found";
    }

}
