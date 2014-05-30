$(document).ready(function() {
    
    $("#totalAdmins").click(function() {
        window.location.href = baseUrl + "admin/listout/admin";
    });

    $("#totalUsers").click(function() {
        window.location.href = baseUrl + "admin/listout/user";
    });

    $("#totalMembers").click(function() {
        window.location.href = baseUrl + "admin/listout/all";
    });
});
