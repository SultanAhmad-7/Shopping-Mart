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
        // alert(size + " " + product_id);
        $.ajax({

            url: '/get-product-price',
            data: { size: size, product_id: product_id },
            type: 'POST',
            success: function(result) {
                //alert(result);
                $('.getAttrPrice').html("Rs. " + result);
            },
            // error: function(params) {
            //     alert('Error');
            // },
        });
    });

});