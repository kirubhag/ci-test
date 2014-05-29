<table>
    <thead>
        <tr>
            <th>S.No</th>
            <th>Email Id</th>
            <th>Member Type</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 1;
        foreach ($users as $key => $value) {
            ?>
            <tr>
                <td><?php print $i; ?></td>
                <td><?php print $value->email_id; ?></td>
                <td><?php print ucfirst($value->user_type); ?></td>
                <td><a href="<?php $this->load->helper('url');echo base_url() . 'admin/delete/';print $value->id; ?>">Delete</a></td>
            </tr>
            <?php
            $i = $i + 1;
        }
        ?>
    </tbody>
</table>
