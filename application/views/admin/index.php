<div>
    <h4>Admin Dashboard</h4>
    <hr />
</div>
<div class="info-box">
    <div class="box-holder">               
        <div class="small-individual-box colorA" id="totalAdmins">
            <div>
                <p>Total Admin's</p>
                <span><?= $adminMenuData['totalAdmin'] ?></span>
            </div>
        </div>
        <div class="small-individual-box colorB" id="totalUsers">
            <div>
                <p>Total Users</p>
                <span><?= $adminMenuData['totalUser'] ?></span>
            </div>
        </div>
        <div class="small-individual-box colorC" id="totalMembers">
            <div>
                <p>Total Members</p>
                <span><?= $adminMenuData['totalAdmin'] + $adminMenuData['totalUser'] ?></span>
            </div>
        </div>
    </div>
</div>
