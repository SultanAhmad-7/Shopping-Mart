// $(document).ready(function() {
//     // $('#sort').on('change', function() {
//     //     //  alert('Its working');
//     //     this.form.submit();
//     // });


// });

$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });



    $('#sort').on('change', function() {
        // alert('Its working');
        let fabric = get_filter("fabric");
        let sleeve = get_filter("sleeve");
        let pattern = get_filter("pattern");
        let fit = get_filter("fit");
        let occasion = get_filter("occasion");
        let sort = $(this).val();
        let url = $('#url').val();
        // alert(sort + " " + url);
        $.ajax({
            method: 'POST',
            url: url,
            data: { sort: sort, url: url, fabric: fabric, sleeve: sleeve, pattern: pattern, fit: fit, occasion: occasion },
            success: function($result) {
                $('.filter_products').html($result);
            }
        });
    });

    $('.fabric,.sleeve,.pattern,.fit,.occasion').on('click', function() {
        let fabric = get_filter("fabric");
        let sleeve = get_filter("sleeve");
        let pattern = get_filter("pattern");
        let fit = get_filter("fit");
        let occasion = get_filter("occasion");
        let sort = $('#sort option:selected').val();
        let url = $('#url').val();
        $.ajax({
            url: url,
            method: 'POST',
            data: { sort: sort, url: url, fabric: fabric, sleeve: sleeve, pattern: pattern, fit: fit, occasion: occasion },
            success: function(result) {
                $('.filter_products').html(result);
            }
        });
        //alert(fabric + sort);
    });

    function get_filter(className) {
        let filter = [];
        $('.' + className + ':checked').each(function() {
            filter.push($(this).val());
        });
        return filter;
    }

    $('#getPrice').on('change', function() {
        // alert('its working');
        let size = $(this).val();
        let product_id = $(this).attr('product-id');
        if (size == '') {
            alert('Please Select a size');
            return false;
        }

        $.ajax({

            url: '/get-product-price',
            data: { size: size, product_id: product_id },
            type: 'POST',
            success: function(result) {
                //alert(result);
                // alert(result['product_price']);
                // alert(result['discounted_price']);
                if (result['discount'] > 0) {
                    $('.getAttrPrice').html("<small>Rs. <del>" + result['product_price'] + "</del></small>" + " Rs. " + result['final_price']);
                } else {
                    $('.getAttrPrice').html("Rs. " + result['product_price']);
                }

            },
            // error: function(params) {
            //     alert('Error');
            // },
        });
    });

    // quantity increase or decrease

    $(document).on('click', '.btnItemUpdate', function() {
        if ($(this).hasClass('qtyMinus')) {
            var quantity = $(this).prev().val();
            if (quantity <= 1) {
                alert("Item quantity must be 1 or greater.");
                return false;
            } else {
                var newQuantity = parseInt(quantity) - 1;
            }

        }

        if ($(this).hasClass('qtyPlus')) {
            var quantity = $(this).prev().prev().val();
            var newQuantity = parseInt(quantity) + 1;

        }
        //alert(newQuantity);
        var cartId = $(this).data('cartid');

        //alert(cartId);
        $.ajax({
            type: 'POST',
            url: '/update-cart-quantity',
            data: { newQuantity: newQuantity, cartId: cartId },
            success: function(response) {
                // alert(response.status);
                if (response.status == false) {
                    alert(response.message);
                }
                $('#chartTableAppend').html(response.view);
            },
            error: function() {
                alert("Error");
            }
        });

    });

    $(document).on('click', '.btnItemDelete', function() {
        // alert('Cart Deleted');
        var cartId = $(this).data('cartid');
        var confirmDelete = confirm('Are You Sure! You want to delete it.');
        if (confirmDelete) {
            $.ajax({
                type: 'post',
                url: '/cart-item-delete',
                data: { cartId: cartId },
                success: function(response) {
                    if (response.status == true) {
                        alert(response.message);
                    }
                    $('#chartTableAppend').html(response.view);
                }
            });
        }

    });

    // validate login form on keyup and submit
		$("#registerForm").validate({
			rules: {
				name: {
					required: true,
				},
                mobile: {
					required: true,
					minlength: 10,
                    maxLength: 11,
                    digits: true
				},
                email: {
                    required: true,
                    email: true,
                    remote: "check-email"
                  },
				password: {
					required: true,
					minlength: 6,
                    
				}
			},
			messages: {
				name: {
					required: "Please enter a name",
				    },
                mobile:{
                    required: "Please enter your Mobile.",
                    minlength: "Your Mobile must consists 10 digits.",
                    maxLength: "Your Mobile must consists 11 digits.",
                    digits: "Please enter valid Mobile"
                },
                email: {
					required: "Please enter email address",
                    email: "Please enter valid email address",
                    remote: "Email already Exists"
				},
				password: {
					required: "Please provide a password",
					minlength: "Your password must be at least 6 characters long"
				},
			}
		});

     // validate signup form on keyup and submit
		$("#loginForm").validate({
			rules: {
				
                email: {
                    required: true,
                    email: true,
                    
                  },
				password: {
					required: true,
					
                    
				}
			},
			messages: {
                email: {
					required: "Please enter email address",
                    email: "Please enter valid email address",
                    
				},
				password: {
					required: "Please provide a password",
				},
			}
		});

});