jQuery(document).ready(function($){
    $('.mos-product-search').on('input',function(e){
        var currentRequest;
        var $this = $(this);
        var search_value = $(this).val();
        console.log(search_value);
        if (!search_value){
            //if(search_value.length>=2){                      
            $this.closest('form').siblings('.search-results').innerhtml('');
        } else {
            $.ajax({
                url: mos_ajax_object.ajaxurl, // or example_ajax_obj.ajaxurl if using on frontend
                type:"POST",
                dataType:"json",
                data: {
                    'action': 'get_searched_products',
                    'search_value' : search_value,
                },
                success: function(result){
                    console.log(result);
                    $this.closest('form').siblings('.search-results').html(result);
                    //$('.track-output').html(result);
                },
                error: function(errorThrown){
                    console.log(errorThrown);
                }
            });             
        }           
        // } else {
        //     $this.closest('form').siblings('.search-results').html('');
        // } 
        // if (!search_value) {
        //     $this.closest('form').siblings('.search-results').html('');
        // }
	});
    $(window).click(function() {
        $('.search-results').html('');
    });
    //$('body').on('click', '.projects-wrapper .pagination-wrapper .page-numbers', function (e){
    
	/*$('.track-form').submit(function(e){
		e.preventDefault();
		var form_data = $(this).serialize();
		console.log(form_data);
        $.ajax({
            url: mos_ajax_object.ajaxurl, // or example_ajax_obj.ajaxurl if using on frontend
            type:"POST",
            dataType:"json",
            data: {
                'action': 'order_tracking',
                'form_data' : form_data,
            },
            success: function(result){
                // console.log(result);
                $('.track-output').html(result);
            },
            error: function(errorThrown){
                console.log(errorThrown);
            }
        });
	});*/
});