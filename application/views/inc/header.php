<!DOCTYPE html>
<html>
    <head>        
        <title>My Blog</title>
        <link rel="stylesheet" href="<?php $this->load->helper('url');echo base_url();?>public/css/custom/style.css">
        <script src="<?php $this->load->helper('url');echo base_url();?>public/js/jquery-1.11.1.js"></script>
        <script src="<?php $this->load->helper('url');echo base_url();?>public/js/custom/config.js"></script>
        <script src="<?php $this->load->helper('url');echo base_url();?>public/js/custom/admin.js"></script>
    </head>
    <body>
        <div class="main-nav">
            <ul>
                <li>
                    <a href="<?php
                    $this->load->library('session');
                    $this->load->helper('url');
                    $Pass = $this->session->userdata('gatePass');
                    $login = base_url() . 'admin/login';
                    $logout = base_url() . 'admin/logout';
                    $url = ($Pass) ? $logout : $login;
                    $linkCaption = ($Pass) ? "Logout" : "Login";
                    ?><?= $url ?>">
                           <?= $linkCaption ?>
                    </a>
                </li>                
            </ul>
        </div>
