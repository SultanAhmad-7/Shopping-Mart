$(document).ready(function() {
    // $('#sort').on('change', function() {
    //     //  alert('Its working');
    //     this.form.submit();
    // });

    $(document).ready(function() {
        $('#sort').on('change', function() {
            // alert('Its working');
            let sort = $(this).val();
            let url = $('#url').val();
            // alert(sort + " " + url);
            $.ajax({
                method: 'POST',
                url: url,
                data: { sort: sort, url: url },
                success: function($result) {
                    $('.filter_products').html($result);
                }
            });
        });
    });
});