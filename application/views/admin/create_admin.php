<h4>Create Admin</h4>
<form method="post" action="<?php $this->load->helper('url');echo base_url().'admin/create_admin';?>">
    User Name <input type="email" name="email" /><br />
    Password <input type="password" name="password" /><br />
    <input type="submit" name="submit" name="Create" />
</form>
