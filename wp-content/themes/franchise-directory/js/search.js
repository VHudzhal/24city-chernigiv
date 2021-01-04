//  WP AJAX Search
$.fn.donetyping=function(n,t){t||(t=1e3);var i,u=function(t){i&&(i=null,n(t))};return this.each(function(){var n=$(this);n.on("keyup",function(){i&&clearTimeout(i),i=setTimeout(function(){u(n)},t)}).on("blur",function(){u(n)})}),this};

$('.search_box input[type="text"]').donetyping(function(){
    var t = $('.search_box input[type="text"]'),
        val = t.val(),
        form = t.parent();
    if(val.length >= 3) {
        $.ajax({
            type: 'post',
            url: $('html').data('a'),
            data: {
                action: 'wpa_ajax_search',
                key: val
            },
            beforeSend: function(){
                $('img, .close', form).fadeIn(250);
                form.next().find('.showsearch').html('<mark>Searching...</mark>');
            },
            success: function(html) {
                form.next().find('.showsearch').html(html);
                $('img', form).fadeOut(250);
            }
        });
    } else {
        form.next().find('.showsearch').html('<mark>Enter 3 or more letters</mark>');
        $('img', form).fadeOut(250);
    }
});
$(document).on('click', '.search_box i', function(){
    $(this).fadeOut(250).prev().fadeOut(250).parent().next().find('>div').html('');
    $(this).next().val('');
});
