<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function index() {
        $this->load->view('inc/header');
        $this->load->view('inc/admin_menu');
        $this->load->view('admin');
        $this->load->view('inc/footer');
    }

    public function admin_login($email, $password) {
        
    }

    public function create_admin() {
        if (!isset($_POST['submit'])) {
            $this->load->view('inc/header');
            $this->load->view("admin/create_admin");
            $this->load->view('inc/footer');
        } else {
            if (isset($_POST['submit']) && isset($_POST['email']) && isset($_POST['password']) && !empty($_POST['email']) && !empty($_POST['password'])) {
                $email = $this->input->post('email');
                $password = $this->input->post('password');
                $this->load->model('admin_module');
                if ($this->admin_module->addAdmin($email, $password)) {
                    echo json_encode(array("create_admin" => array("success" => "yes", "error" => "no")));
                } else {
                    echo json_encode(array("create_admin" => array("success" => "no", "error" => ERROR_100)));
                }
            }
        }
    }

    public function create_user() {
        if (!isset($_POST['submit'])) {
            $this->load->view('inc/header');
            $this->load->view("admin/create_admin");
            $this->load->view('inc/footer');
        } else {
            if (isset($_POST['submit']) && isset($_POST['email']) && isset($_POST['password']) && !empty($_POST['email']) && !empty($_POST['password'])) {
                $email = $this->input->post('email');
                $password = $this->input->post('password');
                $this->load->model('admin_module');
                if ($this->admin_module->addUser($email, $password)) {
                    echo json_encode(array("create_admin" => array("success" => "yes", "error" => "no")));
                } else {
                    echo json_encode(array("create_admin" => array("success" => "no", "error" => ERROR_100)));
                }
            }
        }
    }

    public function login() {
        if (!isset($_POST['submit'])) {
            $this->load->view('inc/header');
            $this->load->view("admin/login");
            $this->load->view('inc/footer');
        } else {
            if (isset($_POST['submit']) && isset($_POST['email']) && isset($_POST['password']) && !empty($_POST['email']) && !empty($_POST['password'])) {
                $email = $this->input->post('email');
                $password = $this->input->post('password');
                $this->load->model('admin_module');
                $rs = $this->admin_module->signIn($email, $password);
                if ($rs == 1) {
                    //echo json_encode(array("login" => array("success" => "yes", "error" => "no")));
                    $this->load->view('inc/header');
                    $this->load->view("inc/admin_menu");

                    $this->load->view('inc/footer');
                } else {
                    echo json_encode(array("login" => array("success" => "no", "error" => $rs)));
                }
            }
        }
    }

    public function delete() {
        if (isset($_POST['submit']) && isset($_POST['email']) && isset($_POST['password']) && !empty($_POST['email']) && !empty($_POST['password'])) {
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $this->load->model('admin_module');
            $rs = $this->admin_module->signIn($email, $password);
            if ($rs == 1) {
                //echo json_encode(array("login" => array("success" => "yes", "error" => "no")));
                $this->load->view('inc/header');
                $this->load->view("inc/admin_menu");

                $this->load->view('inc/footer');
            } else {
                echo json_encode(array("login" => array("success" => "no", "error" => $rs)));
            }
        }
    }

    public function listout($type = false) {
        $jsonName = ($type) ? 'listout_' . strtolower($type) : 'listout_all';
        $this->load->model("admin_module");
        if ($type) {
            switch (strtolower($type)) {
                case "all":
                    $this->admin_module->allMemberInBlog($jsonName);
                    break;
                case "user":
                    $rs = $this->admin_module->getMemberByCategory($jsonName, "user_type", 'user');
                    if ($rs == 1) {
                        
                    } else {
                        echo json_encode(array($jsonName => $rs));
                    }
                    break;
                case "admin":
                    $rs = $this->admin_module->getMemberByCategory($jsonName, "user_type", 'admin');
                    if ($rs == 1) {
                        
                    } else {
                        echo json_encode(array($jsonName => $rs));
                    }
                    break;
                default:
                    return json_encode(array("listout" => ERROR_104));
                    break;
            }
        } else {
            $this->admin_module->allMemberInBlog($jsonName);
        }
    }

}
