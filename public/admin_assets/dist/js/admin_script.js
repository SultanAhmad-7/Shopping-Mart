$(document).ready(function() {

    /** check current password at file name admin_setting in view/admin/ */
    $('#chkcurrpwd').keyup(function() {
        let chkcurrpwd = $('#chkcurrpwd').val();
        //window.alert(chkcurrpwd);
        $.ajax({
            method: 'post',
            url: '/admin/check-current-password',
            data: {
                chkcurrpwd: chkcurrpwd
            },
            success: function(response) {
                if (response == "false") {
                    $('#chkcurrentpwd').html('<span class="text-danger">Current Password is mis-matched</span>');
                } else {
                    $('#chkcurrentpwd').html('<span class="text-success">Current Password is matched</span>');
                }
            }
        });
    });
    // Brand Update Status Code
    $('.updateBrandStatus').click(function(e) {
        event.preventDefault(e);
        let status = $(this).children("i").attr("status");
        // alert(status);
        // return false;
        let brand_id = $(this).attr('brand_id');

        //window.alert(" status " + status + " section_id-" + section_id);

        $.ajax({
            method: 'post',
            url: '/admin/update-brand-status',
            data: {
                status: status,
                brand_id: brand_id
            },
            success: function(result) {
                if (result['status'] == 1) {
                    $('#brand-' + brand_id).html('<i class="fas fa-toggle-on fa-1x" aria-hidden="true" status="Active"></i>');
                } else {
                    $('#brand-' + brand_id).html('<i class="fas fa-toggle-off fa-1x" aria-hidden="true" status="Inactive"></i>');
                }
            }
        });
    });
    // Section Update Status Code
    $('.updateSectionStatus').click(function(e) {
        event.preventDefault(e);
        let status = $(this).children("i").attr("status");
        // alert(status);
        // return false;
        let section_id = $(this).attr('section_id');

        //window.alert(" status " + status + " section_id-" + section_id);

        $.ajax({
            method: 'post',
            url: '/admin/update-section-status',
            data: {
                status: status,
                section_id: section_id
            },
            success: function(result) {
                if (result['status'] == 1) {
                    $('#section-' + section_id).html('<i class="fas fa-toggle-on fa-1x" aria-hidden="true" status="Active"></i>');
                } else {
                    $('#section-' + section_id).html('<i class="fas fa-toggle-off fa-1x" aria-hidden="true" status="Inactive"></i>');
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
            data: {
                status: status,
                user_id: user_id
            },
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
            data: {
                status: status,
                category_id: category_id
            },
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
            data: {
                section_id: section_id
            },
            success: function(response) {
                $('#appendCategoryLevel').html(response);
            }
        });
    });

    // confirm delete category.
    // $('.confirmDelete').click(function () {
    //     let record = $(this).attr('record');
    //     let recordid = $(this).attr('recordid');
    //     // if(confirm("Are you sure want to delete this " + attributeName + " field?.")){
    //     //     return true;
    //     // }else{
    //     //     return false;
    //     // };
    // });

    $('.confirmDelete').click(function(e) {
        event.preventDefault(e);
        let record = $(this).attr('record');
        let recordid = $(this).attr('recordid');

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {

                window.location.href = "/admin/delete-" + record + "/" + recordid;
            }
        })
    });


    // Product Status Active and Inactive

    $('.updateProductStatus').click(function() {

        let status = $(this).text();
        let product_id = $(this).attr('product_id');

        // window.alert(" status " + status + " product_id-" + product_id);
        $.ajax({
            method: 'post',
            url: '/admin/update-product-status',
            data: {
                status: status,
                product_id: product_id
            },
            success: function(result) {
                if (result['status'] == 1) {
                    $('#product-' + product_id).html('<a href="javascript:void(0)" class="updateProductStatus"><span class="badge rounded-pill bg-info">Active</span></a>');
                } else {
                    $('#product-' + product_id).html('<a href="javascript:void(0)" class="updateProductStatus"><span class="badge rounded-pill bg-danger">Inactive</span></a>');
                }
            }
        });
    });



    // add remove field dynamically
    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper
    var fieldHTML = `<div style="margin-top: 4px; margin-left: 1px;">
                        <input name="size[]" type="text" style="width: 120px;" value="" placeholder="Size" required=""/>&nbsp;
                        <input  name="sku[]" type="text" name="sku[]" style="width: 120px;" value="" placeholder="SKU" required=""/>&nbsp;
                        <input  name="stock[]" type="number" style="width: 120px;" value="" placeholder="Stock" required=""/>&nbsp;
                        <input  name="price[]" type="number" style="width: 120px;" value="" placeholder="Price" required=""/>&nbsp;
                        <a href="javascript:void(0);" class="remove_button"><i class="fas fa-minus-circle fa-x1"></i></a>
                    </div>`; //New input field html 
    var x = 1; //Initial field counter is 1

    //Once add button is clicked
    $(addButton).click(function() {
        //Check maximum number of input fields
        if (x < maxField) {
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); //Add field html
        }
    });

    //Once remove button is clicked
    $(wrapper).on('click', '.remove_button', function(e) {
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });

    // Attribute updateStatus
    $('.updateAttributesStatus').click(function() {

        let status = $(this).text();
        let attributes_id = $(this).attr('attributes_id');

        // window.alert(" status " + status + " product_id-" + product_id);
        $.ajax({
            method: 'post',
            url: '/admin/update-attribute-status',
            data: {
                status: status,
                attributes_id: attributes_id
            },
            success: function(result) {
                if (result['status'] == 1) {
                    $('#attributes-' + attributes_id).html('Active');
                } else {
                    $('#attributes-' + attributes_id).html('Inactive');
                }
            }
        });
    });

    // Product Image updateStatus
    $('.updateImageStatus').click(function() {

        let status = $(this).text();
        let image_id = $(this).attr('image_id');

        // window.alert(" status " + status + " product_id-" + product_id);
        $.ajax({
            method: 'post',
            url: '/admin/update-image-status',
            data: {
                status: status,
                image_id: image_id
            },
            success: function(result) {
                if (result['status'] == 1) {
                    $('#image-' + image_id).html('Active');
                } else {
                    $('#image-' + image_id).html('Inactive');
                }
            }
        });
    });
});