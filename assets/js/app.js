function changeUserRoleAjax(member_id, new_role) {
    $.ajax({
        method: "get",
        url: "/project/member/change_role/"+member_id+"/"+new_role,
        success: function(result){
            alert(result.success);
        }
    });
}

function showTaskProfile(task_id) {

}