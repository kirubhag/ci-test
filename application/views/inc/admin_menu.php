<nav class="admin-nav">
    <ul>
        <li>
            <a href="<?php $this->load->helper('url');echo base_url().'admin/create_admin';?>">
                Admin Management
            </a>
            <span><?= $adminMenuData['totalAdmin'] ?></span>
        </li>
        <li>
            <a href="<?php $this->load->helper('url');echo base_url().'admin/create_user';?>">
                User Management
            </a>
            <span><?= $adminMenuData['totalUser'] ?></span>
        </li>
        <li>
            <a href="<?php $this->load->helper('url');echo base_url().'admin/listout';?>">
                List Out
            </a>
            <span><?= $adminMenuData['totalAdmin']+$adminMenuData['totalUser'] ?></span>
        </li>
        <li>
            <a href="<?php $this->load->helper('url');echo base_url().'admin/logout';?>">
                Logout
            </a>
        </li>
    </ul>
</nav>
