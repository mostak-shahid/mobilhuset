jQuery(document).ready(function($) {
    $(document).on("click", ".ajax_add_to_cart", function(e){
    //$('.ajax_add_to_cart').on('click', function(e){
        e.preventDefault();
        $thisbutton = $(this),
        product_id = $(this).data('product_id');
        var data = {
            action: 'ql_woocommerce_ajax_add_to_cart',
            product_id: product_id,
            product_sku: '',
            quantity: 1,
            variation_id: 0,
        };        
        popupGenerator(data); 
    }); 
    $('.single_add_to_cart_button').on('click', function(e){ 
        e.preventDefault();
        $thisbutton = $(this),
        $form = $thisbutton.closest('form.cart'),
        id = $thisbutton.val(),
        product_qty = $form.find('input[name=quantity]').val() || 1,
        product_id = $form.find('input[name=product_id]').val() || id,
        variation_id = $form.find('input[name=variation_id]').val() || 0;
        var data = {
            action: 'ql_woocommerce_ajax_add_to_cart',
            product_id: product_id,
            product_sku: '',
            quantity: product_qty,
            variation_id: variation_id,
        };
        popupGenerator(data);
     }); 
    function popupGenerator(data){
        $.ajax({
            type: 'post',
            url: mos_ajax_object.ajaxurl,
            data: data,
            beforeSend: function (response) {
                $thisbutton.removeClass('added').addClass('loading');
            },
            complete: function (response) {
                $thisbutton.addClass('added').removeClass('loading');
            }, 
            success: function (response) { 
                if (response.error & response.product_url) {
                    window.location = response.product_url;
                    return;
                } else { 
                    $(document.body).trigger('added_to_cart', [response.fragments, response.cart_hash, $thisbutton]);                    
                    $("#crossProductModal").find('.modal-body').html(response.html);
                    $("#crossProductModal").modal('show');
                } 
            }, 
        }); 

    }
});