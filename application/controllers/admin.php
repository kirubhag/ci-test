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
            $this->load->view('inc/admin_menu');
            $this->load->view("admin/create_admin");
            $this->load->view('inc/footer');
        } else {
            if (isset($_POST['submit']) && isset($_POST['email']) && isset($_POST['password']) && !empty($_POST['email']) && !empty($_POST['password'])) {
                $email = $this->input->post('email');
                $password = $this->input->post('password');
                $this->load->model('admin_module');
                if ($this->admin_module->addAdmin($email, $password)) {
                    $this->listout();
                } else {
                    echo json_encode(array("create_admin" => array("success" => "no", "error" => ERROR_100)));
                }
            }
        }
    }

    public function create_user() {
        if (!isset($_POST['submit'])) {
            $this->load->view('inc/header');
            $this->load->view('inc/admin_menu');
            $this->load->view("admin/create_user");
            $this->load->view('inc/footer');
        } else {
            if (isset($_POST['submit']) && isset($_POST['email']) && isset($_POST['password']) && !empty($_POST['email']) && !empty($_POST['password'])) {
                $email = $this->input->post('email');
                $password = $this->input->post('password');
                $this->load->model('admin_module');
                if ($this->admin_module->addUser($email, $password)) {
                    $this->listout();
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
                    $this->load->view('inc/header');
                    $this->load->view("inc/admin_menu");
                    $this->load->view('inc/footer');
                } else {
                    echo json_encode(array("login" => array("success" => "no", "error" => $rs)));
                }
            }
        }
    }

    public function delete($userId = false) {
        if (isset($userId) && $userId) {
            $this->load->model('admin_module');
            $rs = $this->admin_module->deleteMember($userId);
            if ($rs == 1) {
                $this->listout();
            } else {
                echo json_encode(array("login" => array("success" => "no", "error" => $rs)));
            }
        }
    }

    public function listout($type = false) {
        $this->load->model("admin_module");
        if ($type) {
            switch (strtolower($type)) {
                case "all":
                    $users = $this->admin_module->allMemberInBlog();
                    break;
                case "user":
                    $users = $this->admin_module->getMemberByCategory("user_type", 'user');
                    break;
                case "admin":
                    $users = $this->admin_module->getMemberByCategory("user_type", 'admin');
                    break;
                default:
                    $users = ERROR_104;
                    break;
            }
        } else {
            $users = $this->admin_module->allMemberInBlog();
        }
        $this->load->view('inc/header');
        $this->load->view("inc/admin_menu");
        $this->load->view("admin/list", ['users' => $users]);
        $this->load->view('inc/footer');
    }

}
