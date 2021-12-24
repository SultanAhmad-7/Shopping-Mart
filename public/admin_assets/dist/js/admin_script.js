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

$('.updateCategoryStatus').click(function(){
        window.alert("This is the category");
    
    // let status = $(this).text();
    // let Category_id = $(this).attr('category_id');

    // window.alert(status +" " + category_id);
});