<?php

class Admin_Module extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function addUser($email, $password) {
        return $this->db->insert('users', [
                    'email_id' => $email,
                    'password' => sha1($password . HASH_KEY),
                    'user_type' => 'user',
                    'made_time' => 'current_timestamp()'
        ]);
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

}
