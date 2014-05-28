<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function index() {
        $this->load->view('inc/header');
        $this->load->view('admin');
        $this->load->view('inc/footer');
    }

    public function admin_login($email, $password) {
        
    }

    public function create_admin($email = false, $password = false) {
        $this->load->view("admin/create_admin");
    }

    public function add_admin() {
        if (isset($_POST['submit']) && isset($_POST['email']) && isset($_POST['password']) && !empty($_POST['email']) && !empty($_POST['password'])) {
//            $email = $_POST['email'];
//            $password = $_POST['password'];
            $email = $this->post('email');
            $password = $this->post('password');exit;
            $this->load->model('admin_module');
            if ($this->admin_module->addAdmin($email, $password)) {
                echo 'Record Added';
            }
        }
    }

    public function create_user($email, $password) {
        $email = $this->post('email');
        $password = $this->post('password');
        $this->load->model('admin_module');
        $this->load->admin_module->addAdmin($email, $password);
    }

}
