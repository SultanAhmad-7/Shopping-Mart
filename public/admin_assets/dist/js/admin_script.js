$().ready(function() {

    /** check current password at file name admin_setting in view/admin/ */
    $('#chkcurrpwd').keyup(function() {
        let chkcurrpwd = $('#chkcurrpwd').val();
        //window.alert(chkcurrpwd);
        $.ajax({
            method: 'post',
            url: '/admin/check-current-password',
            data: { chkcurrpwd: chkcurrpwd },
            success: function(response) {
                if (response == "false") {
                    $('#chkcurrentpwd').html('<span class="text-danger">Current Password is mis-matched</span>');
                } else {
                    $('#chkcurrentpwd').html('<span class="text-success">Current Password is matched</span>');
                }
            }
        });
    });
    // Section Update Status Code
    $('.updateSectionStatus').click(function(e) {
        event.preventDefault(e);
        let status = $(this).text();
        let section_id = $(this).attr('section_id');

        //window.alert(" status " + status + " section_id-" + section_id);

        $.ajax({
            method: 'post',
            url: '/admin/update-section-status',
            data: { status: status, section_id: section_id },
            success: function(result) {
                if (result['status'] == 1) {
                    $('#section-' + section_id).html('<a href="javascript:void(0)" class="updateSectionStatus"><span class="badge rounded-pill bg-info">Active</span></a>');
                } else {
                    $('#section-' + section_id).html('<a href="javascript:void(0)" class="updateSectionStatus"><span class="badge rounded-pill bg-danger">Inactive</span></a>');
                }
            }
        });
    });

    // User Block and UnBlock Update Status Code
    $('.updateUserStatus').click(function() {
        let status = $(this).text();
        let user_id = $(this).attr('user_id');
        //window.alert(status + " " + user_id);
        $.ajax({
            method: 'post',
            url: '/admin/update-user-status',
            data: { status: status, user_id: user_id },
            success: function(result) {
                if (result['status'] == 1) {
                    $('#user-' + user_id).html('<a href="javascript:void(0)" class="updateUserStatus"><span class="badge rounded-pill bg-info text-dark">UnBlock</span></a>');
                } else {
                    $('#user-' + user_id).html('<a href="javascript:void(0)" class="updateUserStatus"><span class="badge rounded-pill bg-danger text-dark">Block</span></a>');
                }
            }
        });
    });

    // Category Status Active and Inactive

    $('.updateCategoryStatus').click(function() {

        let status = $(this).text();
        let category_id = $(this).attr('category_id');

        //window.alert(" status " + status + " category_id-" + category_id);
        $.ajax({
            method: 'post',
            url: '/admin/update-category-status',
            data: { status: status, category_id: category_id },
            success: function(result) {
                if (result['status'] == 1) {
                    $('#category-' + category_id).html('<a href="javascript:void(0)" class="updateCategoryStatus"><span class="badge rounded-pill bg-info">Active</span></a>');
                } else {
                    $('#category-' + category_id).html('<a href="javascript:void(0)" class="updateCategoryStatus"><span class="badge rounded-pill bg-danger">Inactive</span></a>');
                }
            }
        });
    });

    // section change then related categories will be pop-up
    $('#getSection_id').change(function() {
        let section_id = $(this).val();
       // alert(section_id);
         $.ajax({
             method: 'post',
             url: '/admin/change-section-category-appear',
             data: {section_id:section_id},
             success: function(response) {
                 $('#appendCategoryLevel').html(response);
             }
         });
    });
});