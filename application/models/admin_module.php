<?php

class Admin_Module extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function addUser($email, $password) {
        echo '<br />email' . $email;
        echo '<br />password' . $password;
        exit;
        return $this->db->insert('users', [
                    'email_id' => $email,
                    'password' => sha1($password . HASH_KEY),
                    'user_type' => 'user',
                    'made_time' => 'current_timestamp()'
        ]);
    }

    public function addAdmin($email, $password) {

        return $this->db->insert('users', [
                    'email_id' => $email,
                    'password' => sha1($password . HASH_KEY),
                    'user_type' => 'admin',
                    'made_time' => 'current_timestamp()'
        ]);
    }

}
