<?php

class Admin_Module extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function signIn($email, $password) {
        $this->db->where('email_id', $email);
        if ($this->db->count_all_results('users')) {
            $this->db->where('password', sha1($password . HASH_KEY));
            if ($this->db->count_all_results('users')) {
                return 1;
            } else {
                return ERROR_102;
            }
        } else {
            return ERROR_101;
        }
    }

    public function addUser($email, $password) {
        $this->db->where('email_id', $email);
        if ($this->db->count_all_results('users')) {
            return false;
        } else {
            return $this->db->insert('users', [
                        'email_id' => $email,
                        'password' => sha1($password . HASH_KEY),
                        'user_type' => 'user',
                        'made_time' => 'current_timestamp()'
            ]);
        }
    }

    public function addAdmin($email, $password) {
        $this->db->where('email_id', $email);
        if ($this->db->count_all_results('users')) {
            return false;
        } else {
            return $this->db->insert('users', [
                        'email_id' => $email,
                        'password' => sha1($password . HASH_KEY),
                        'user_type' => 'admin',
                        'made_time' => 'current_timestamp()'
            ]);
        }
    }

    public function deleteMember($userId) {
        $this->db->where('id', $userId);
        if ($this->db->count_all_results('users')) {
            $this->db->where('id', $userId);
            $this->db->delete('users');
            return 1;
        } else {
            return ERROR_103;
        }
    }

    public function getMemberByCategory($jsonName, $fieldName, $value) {
        $query = $this->db->get_where("users", [$fieldName => $value]);
        if (count((array) $query->result())) {
            return json_encode($query->result());
        } else {
            if ($value == 'user') {
                echo json_encode(array($jsonName => array("success" => "no", "error" => ERROR_106)));
            } elseif ($value == "admin") {
                echo json_encode(array($jsonName => array("success" => "no", "error" => ERROR_105)));
            }
            return 1;
        }
    }

    public function allMemberInBlog($jsonName) {
        $query = $this->db->get("users");
        echo json_encode(array($jsonName => $query->result()));
    }

}
