jQuery(document).ready(function($){
    $('.mos-product-search').on('click',function(e){        
        var $this = $(this);
        var search_value = $(this).val();
        // var search_category = $(this).siblings('.mos-product-categories').val();
        //ajax_result ($this, search_value, search_category); 
        if (search_value) $this.closest('form').siblings('.search-suggestion-results').show();
    });
    $('.mos-product-categories').on('change',function(e){
        var $this = $(this);
        var search_value = $(this).siblings('.mos-product-search').val();
        var search_category = $(this).val();
        ajax_result ($this, search_value, search_category); 
        console.log('changed');
    })
    $('.mos-product-search').on('input',function(e){
        //var currentRequest;
        var $this = $(this);
        var search_value = $(this).val();
        var search_category = $(this).siblings('.mos-product-categories').val();
        ajax_result ($this, search_value, search_category); 

	});
    function ajax_result ($this, search_value = '', search_category='') {
        if (search_value.length <= 1){
            //if(search_value.length>=2){                      
            //$this.closest('form').siblings('.search-results').html('');
            $this.closest('form').siblings('.search-suggestion-results').find('#suggestions').html('');
            $this.closest('form').siblings('.search-suggestion-results').html('');
            return;
        } else {   
            $.ajax({
                url: mos_ajax_object.ajaxurl, // or example_ajax_obj.ajaxurl if using on frontend
                type:"POST",
                dataType:"json",
                data: {
                    'action': 'get_searched_products',
                    'search_value' : search_value,
                    'search_category' : search_category,
                },
                beforeSend: function() {
                    $('.search-suggestion-loader').remove();
                    $this.closest('.input-group').after('<i class="fa fa-spinner fa-pulse fa-fw search-suggestion-loader"></i>');
                },
                success: function(result){
                    //console.log(result);
                    $this.closest('form').siblings('.search-suggestion-results').html(result);
                    $('.search-suggestion-loader').remove();
                    //$('.track-output').html(result);
                },
                error: function(errorThrown){
                    console.log(errorThrown);
                }
            });    
        } 

    }
    // $(window).click(function() {
    //     $('.search-suggestion-results').html('');
    // });
    $(document).mouseup(function(e) {
        var container = $(".woo-searchform-wrapper");

        // if the target of the click isn't the container nor a descendant of the container
        if (!container.is(e.target) && container.has(e.target).length === 0) 
        {
            //container.hide();
            container.find('.search-suggestion-results').hide();
        }
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

// function showHint(str) {
//     if (str.length <= 1) {
//         jQuery('#suggestions').html('');
//         jQuery('.search-suggestion-results').html('');
//         return;
//     } else {
//         jQuery.ajax({
//             url: mos_ajax_object.ajaxurl, // or example_ajax_obj.ajaxurl if using on frontend
//             type:"POST",
//             dataType:"json",
//             data: {
//                 'action': 'get_searched_products',
//                 'search_value' : str,
//             },
//             success: function(result){
//                 console.log(result);
//                 jQuery('.search-suggestion-results').html(result);
//                 //$('.track-output').html(result);
//             },
//             error: function(errorThrown){
//                 console.log(errorThrown);
//             }
//         }); 
//     }
// }