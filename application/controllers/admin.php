<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->model('admin_module');
    }

    public function index() {
        if ($this->session->userdata('gatePass')) {
            $this->load->view('inc/header');
            $adminMenuData = $this->admin_module->getAdminMenuData();
            $this->load->view('inc/admin_menu', ["adminMenuData" => $adminMenuData]);
            $this->load->view('admin/index', ["adminMenuData" => $adminMenuData]);
            $this->load->view('inc/footer');
        } else {
            $this->load->view('inc/header');
            $this->load->view('inc/footer');
        }
    }

    public function create_admin() {
        if (!$this->session->userdata('gatePass')) {
            redirect(base_url() . "admin", 'refresh');
        } else {
            if (!isset($_POST['submit'])) {
                $this->load->view('inc/header');
                $adminMenuData = $this->admin_module->getAdminMenuData();
                $this->load->view('inc/admin_menu', ["adminMenuData" => $adminMenuData]);
                $this->load->view("admin/create_admin");
                $this->load->view('inc/footer');
            } else {
                if (isset($_POST['submit']) && isset($_POST['email']) && isset($_POST['password']) && !empty($_POST['email']) && !empty($_POST['password'])) {
                    $email = $this->input->post('email');
                    $password = $this->input->post('password');
                    if ($this->admin_module->addAdmin($email, $password)) {
                        $this->listout();
                    } else {
                        echo json_encode(array("create_admin" => array("success" => "no", "error" => ERROR_100)));
                    }
                }
            }
        }
    }

    public function create_user() {
        if (!$this->session->userdata('gatePass')) {
            redirect(base_url() . "admin", 'refresh');
        } else {
            if (!isset($_POST['submit'])) {
                $this->load->view('inc/header');
                $adminMenuData = $this->admin_module->getAdminMenuData();
                $this->load->view('inc/admin_menu', ["adminMenuData" => $adminMenuData]);
                $this->load->view("admin/create_user");
                $this->load->view('inc/footer');
            } else {
                if (isset($_POST['submit']) && isset($_POST['email']) && isset($_POST['password']) && !empty($_POST['email']) && !empty($_POST['password'])) {
                    $email = $this->input->post('email');
                    $password = $this->input->post('password');
                    if ($this->admin_module->addUser($email, $password)) {
                        $this->listout();
                    } else {
                        echo json_encode(array("create_admin" => array("success" => "no", "error" => ERROR_100)));
                    }
                }
            }
        }
    }

    public function login() {
        if ($this->session->userdata('gatePass')) {
            redirect(base_url() . "admin", 'refresh');
        } else {
            if (!isset($_POST['submit'])) {
                $this->load->view('inc/header');
                $this->load->view("admin/login");
                $this->load->view('inc/footer');
            } else {
                if (isset($_POST['submit']) && isset($_POST['email']) && isset($_POST['password']) && !empty($_POST['email']) && !empty($_POST['password'])) {
                    $email = $this->input->post('email');
                    $password = $this->input->post('password');
                    $rs = $this->admin_module->signIn($email, $password);
                    if ($rs == 1) {
                        $this->session->set_userdata(array("user_id" => $this->admin_module->getSingleValue("users", "id", "email_id", $email), "gatePass" => true));
                        redirect(base_url() . "admin", 'refresh');
                    } else {
                        echo json_encode(array("login" => array("success" => "no", "error" => $rs)));
                    }
                }
            }
        }
    }

    public function logout() {
        //$this->session->unset_userdata(array('user_id' => '', 'gatePass' => false));
        $this->session->sess_destroy();
        redirect(base_url() . "admin", 'refresh');
    }

    public function delete($userId = false) {
        if (!$this->session->userdata('gatePass')) {
            redirect(base_url() . "admin", 'refresh');
        } else {
            if (isset($userId) && $userId) {
                $rs = $this->admin_module->deleteMember($userId);
                if ($rs == 1) {
                    $this->listout();
                } else {
                    echo json_encode(array("login" => array("success" => "no", "error" => $rs)));
                }
            }
        }
    }

    public function listout($type = false) {
        if (!$this->session->userdata('gatePass')) {
            redirect(base_url() . "admin", 'refresh');
        } else {
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
            $adminMenuData = $this->admin_module->getAdminMenuData();
            $this->load->view('inc/admin_menu', ["adminMenuData" => $adminMenuData]);
            $this->load->view("admin/list", ['users' => $users]);
            $this->load->view('inc/footer');
        }
    }

}
