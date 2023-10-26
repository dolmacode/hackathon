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
    $.ajax({
        method: "get",
        url: "/task/get_info/"+task_id,
        success: function(result) {
            console.log(result.success);
            $('#task_id_input').val(result.success.task.id);
            $('#task_name_input').val(result.success.task.name);
            $('#task_deadline_input').val(result.success.deadline);
            $('#task_priority_input').append("<option selected value='"+result.success.task.priority+"'>"+result.success.task.priority+"</option>");
            $('#task_status_input').append("<option selected value='"+result.success.task.status.id+"'>"+result.success.task.status.name+"</option>");
            $('#task_category_input').append("<option selected value='"+result.success.task.category.id+"'>"+result.success.task.category.name+"</option>");
            $('#task_description_input').html(result.success.task.description);

            let task_members = "Участники: ";
            let members_list = result.success.members;

            members_list.forEach(function (member) {
                task_members += member.user.name+" <small><a href='/task/members/remove/"+member.id+"'>[Удалить]</a></small>; ";
            });

            $('#task_member_id_input').val(result.success.task.id);
            $('#task_comment_id_input').val(result.success.task.id);

            $('#task_members_list').html(task_members);

            let task_comments = "";
            let task_comments_list = result.success.task.comments;

            task_comments_list.forEach(function (comment) {
                $('.task__comments-list').append("<div class=\"task__comments-item\">\n" +
                    "<h6>"+ comment.user.name +"</h6>\n" +
                    "<p>"+ comment.content +"</p>\n" +
                    "</div>");
            });
        },
        error: function(result) {
            alert(result.error);
        }
    });
}