jQuery.noConflict();
jQuery(document).ready(function($){

        // $('#vip').checkToggler({
        //     labelOn:'On',
        //     labelOff:'Off',
        // }).on('click', function () {
        //     let url = "http://bizov.com.ua/vip/";
        //     $(location).attr('href', url);
        // });
$('div.elementor-widget-price-table:first-child a.elementor-price-table__button').on('click', function () {

$('span#vip-price-month').text('199.99 ₴');
});
$('div.elementor-widget-price-table:nth-child(2) a.elementor-price-table__button').on('click', function () {
    $('span#vip-price-month').text('');
    $('span#vip-price').text('1900 ₴');
})
$('section#primary aside#right-sidebar div#right-sidebar-content div#send-application input[type="text"]').after('<div style="z-index: 2; position: absolute; transform: translateY(-120%);left: 15px; font-size: 24px;"><i class="fal fa-user"></i></div>')
$('section#primary aside#right-sidebar div#right-sidebar-content div#send-application input[type="email"]').after('<div style="z-index: 2; position: absolute; transform: translateY(-120%);left: 15px; font-size: 24px;"><i class="fal fa-envelope"></i></div>')
$('section#primary aside#right-sidebar div#right-sidebar-content div#send-application input[type="tel"]').after('<div style="z-index: 2; position: absolute; transform: translateY(-120%);left: 15px; font-size: 24px;"><i class="fa fa-phone"></i></div>')
   if($('ul.tab-header>li.js-tab-trigger:first-child').hasClass('active')) {
           $('h3#service-title').text('Пакет «"ПРЕМИУМ"»').css('font-weight', 'bold');
       }
   if($('ul.tab-header>li.js-tab-trigger:first-child').on(
       'click', function () {
           $('h3#service-title').text('Пакет «"ПРЕМИУМ"»').css('font-weight', 'bold');

       }
   ));
   $('ul.tab-header>li.js-tab-trigger:nth-child(2)').on('click',function () {
       $('h3#service-title').text('Пакет «"ОПТИМУМ"»').css('font-weight', 'bold');
   });
    $('ul.tab-header>li.js-tab-trigger:last-child').on('click',function () {
       $('h3#service-title').text('Пакет «"БАЗОВЫЙ"»').css('font-weight', 'bold');
    });

$('div.field button[name="write"]').click(function () {
        location.href = "report.php";
    });

    $('li li:has(li)').find('a:first').addClass ('arrow');

    $('div.breadcrumbs i.fa.fa-arrow-right:first-child').css('display', 'none');
    $.get("http://ipinfo.io", function (response) {
        $('div#user-city a').attr('title', response.city);
    }, "jsonp")

});
try{
    var el=document.getElementById('menu-left-menu').getElementsByTagName('a');
    var url=document.location.href;
    for(var i=0;i<el.length; i++){
        if (url==el[i].href){
            el[i].className += ' act';
        };
    };
}catch(e){}

jQuery(document).ready(function($){
    $('.toggle-nav').click(function() {
        $("aside#left-main-sidebar").animate({
            width: "toggle"
        });
    });
// Dropdown toggle
    $('.category-toggle-nav').click(function() {
        $(this).next('section.fr-catalog div#primary div.navigation aside.widget-area').toggle();
    });
    $('.copy_link').click(function() {
        var $temp = $("<input>");
        $("body").append($temp);
        $temp.val($('#page-link').text()).select();
        document.execCommand("copy");
        $temp.remove();

        $(this).text('Тест скопирован!');
    });
    var footerHeight, $footer = $('div.footer'),
        $main = $('section#primary');
    $(window).resize(function() {
        // вешаем обработчик на изменение размеров страницы - т.е. если меняется ширина страницы,
        // или высота, даже если в футер кто то потом аяксом что то подгрузит -
        // сработает ресайз и все сам поменяет
        footerHeight = $footer.height('auto').height();
        // важный момент - чтобы "снять" правильную высоту элемента - надо чтобы поток документа сам
        // назначил верную высоту футеру. а для этого сделаем её "auto". даже если забыли/не захотели убрать
        // из стилей жестко прописаную высоту - инлайн стиль перебивает весом, и поэтому высота
        // будет такая "как надо". потом снимаем мерку, и юзаем её
        $main.css({
            'paddingBottom': (footerHeight + 15)
        });
        // не забываем кемел-кейс для значений-через-дефис
        $footer.css({
            'height': footerHeight,
            'marginTop': (footerHeight * -1)
        })
    }).trigger('resize'); // после навешивания обработчиков насильно запускаем первый ресайз
});
function copytext(el) {
    var $tmp = jQuery("<input>");
    jQuery("body").append($tmp);
    $tmp.val(jQuery(el).text()).select();
    document.execCommand("copy");
    $tmp.remove();
}
function sum($url, $id){
    var counter = 0;

    /* facebook */
    $.getJSON('http://api.facebook.com/restserver.php?method=links.getStats&amp;amp;amp;urls=' + $url + '&amp;amp;amp;callback=?&amp;amp;amp;format=json', function(data) {
        counter = counter + data[0].like_count;
        $('.voices-'+$id).html(counter);
    });

    /* vkontakte */
    $.getJSON('https://api.vkontakte.ru/method/likes.getList?type=sitepage&amp;amp;amp;owner_id=2409412&amp;amp;amp;item_id='  + $id + '&amp;amp;amp;format=json&amp;amp;amp;callback=?', function(data){
        counter = counter + data.response.count;
        $('.voices-'+$id).html(counter);
    });

    /* twitter */
    $.getJSON('http://urls.api.twitter.com/1/urls/count.json?url=' + $url + '&amp;amp;amp;callback=?', function(data2) {
        counter = counter + data2.count;
        $('.voices-'+$id).html(counter);
    });
}

jQuery(document).ready(function($) {
            $( '#company-slider' ).sliderPro({
                width: 960,
                height: 500,
                fade: true,
                arrows: true,
                buttons: false,
                fullScreen: true,
                shuffle: true,
                smallSize: 500,
                mediumSize: 1000,
                largeSize: 3000,
                thumbnailArrows: true,
                autoplay: false
            });
           // jQuery('select#pa_parus > option:nth-child(5)')slice(2).appendTo('#pa_parus');
});
//var swiper = new Swiper('.swiper-container');

jQuery('.carousel[data-type="multi"] .item').each(function(){
		var next = jQuery(this).next();
		if (!next.length) {
			next = jQuery(this).siblings(':first');
		}
		next.children(':first-child').clone().appendTo(jQuery(this));
	  
		for (let i=0;i<2;i++) {
			next=next.next();
			if (!next.length) {
				next = jQuery(this).siblings(':first');
			}
			next.children(':first-child').clone().appendTo($(this));
		}
	});
    jQuery(document).ready(function($){
        // Call the event handler on #text
        $("a.drop-btn, ul.item-menu").hover(function(){
            $(this).parent().find(".item-menu").addClass("hoverstate");

            }, function(){
                 $(this).parent().find(".item-menu").removeClass('hoverstate');
            });
        $("ul.foot-buttons-group>li.foot-item a").hover(function() {
            $(this).parent().find("div.foot-item-title").addClass("hoverstate");
        }, function(){
            $(this).parent().find("div.foot-item-title").removeClass('hoverstate');

        });
        // if($('li.first').find('ul.sub-menu').length > 0){
        //     $('li.first').find('.sub-btn').addClass('sdsfdfsf');
        // }
        $('li.first').each(function(){
            var content = $(this).children('ul.sub-menu');
            $('button.sub-btn', this).click(function(){
                content.slideToggle('slow');
            });
        });
        $.each($('li.first'), function(idx, ele) {
            if ($(ele).find('ul.sub-menu').length == 0) {
                $(ele).find('.sub-btn').css({"display": "none"});
            }
        });

        $('.foot-modals-group a#btn').click(function() {
           $('ul.foot-buttons-group').slideToggle('slow');
        });
    });
// jQuery(document).ready(function($) {
//     /*
//         Carousel
//     */
//     $('#posts-carousel').on('slide.bs.carousel', function (e) {

//         /*
//             CC 2.0 License Iatek LLC 2018
//             Attribution required
//         */
//         var $e = $(e.relatedTarget);
//         var idx = $e.index();
//         var itemsPerSlide = 5;
//         var totalItems = $('.carousel-item').length;

//         if (idx >= totalItems-(itemsPerSlide-1)) {
//             var it = itemsPerSlide - (totalItems - idx);
//             for (var i=0; i<it; i++) {
//                 // append slides to end
//                 if (e.direction==="left") {
//                     $('.carousel-item').eq(i).appendTo('.carousel-inner');
//                 }
//                 else {
//                     $('.carousel-item').eq(0).appendTo('.carousel-inner');
//                 }
//             }
//         }
//     });
// });
// var slider = tns({
//     container: '#posts-carousel',
//     items: 3,
//     fixedWidth: 100,
//     nav: true,
//     navPosition: 'bottom',
//     autoplay: true,
    
// });
jQuery(document).ready(function($) {
    $(".contests-category-list").collapsorz({
        minimum: 3
        , showText: "Развернуть список >>>"
        , hideText: "Свернуть список <<<"
    });
        $(".company-contacts").collapsorz({
        minimum: 1
        , showText: "Показать телефоны"
        , hideText: ""
    });
      
     $(".company-adr-links").collapsorz({
        minimum: 3,
        showText: "Показать все <i class='fal fa-map-marker-check'></i>",
        hideText: ""
    });
    $('#imagemodal').hide();
    $("div.zoom-in-photo a").click(function() {
        let src = $(this).parent().parent().find("div.concurs-image img").attr('src');
        $('.imagepreview').attr('src', src);
        $('#imagemodal').show();
    });
    // $('#posts-carousel').owlCarousel({
    //     items: 3,
    //     dots: false,
    //     dotsEach: 1,
    //     // Включаем стандартные кнопки
    //     nav: true,
    //
    //     // Можно еще задать тексты кнопок
    //     navText: [
    //         '<i class="fas fa-chevron-circle-left"></i> Влево',
    //         'Вправо <i class="fas fa-chevron-circle-right"></i>'
    //     ],
    //     autoplay: true,
    //     autoplayTimeout: 1500,
    //     autoWidth: true,
    // });

    // $("#ads-list").my_pagination({
    //     panel: "top",
    //     cssClass: "paginator",
    //     innerClass: null,
    //     style: "none",
    //     withPerPageSelect: false,
    //     perPage: 3,
    //     descTemplate: "Page #{page} of #{pages}",
    //     beforeClick: function(collection) {
    //         //alert("beforeClick");
    //     }
    // });
 });
 
//Pagination
(function($) {
	var pagify = {
		items: {},
		container: null,
		totalPages: 10,
		perPage: 10,
		currentPage: 5,
		createNavigation: function() {
			this.totalPages = Math.ceil(this.items.length / this.perPage);

			$('.pagination', this.container.parent()).remove();
			var pagination = $('<div class="pagination"></div>').append('<a class="nav prev disabled" data-next="false"><</a>');

			for (var i = 0; i < this.totalPages; i++) {
				var pageElClass = "page";
				if (!i)
					pageElClass = "page current";
				var pageEl = '<a class="' + pageElClass + '" data-page="' + (
				i + 1) + '">' + (
				i + 1) + "</a>";
				pagination.append(pageEl);
			}
			pagination.append('<a class="nav next" data-next="true">></a>');

			this.container.after(pagination);

			var that = this;
			$("body").off("click", ".nav");
			this.navigator = $("body").on("click", ".nav", function() {
				var el = $(this);
				that.navigate(el.data("next"));
			});

			$("body").off("click", ".page");
			this.pageNavigator = $("body").on("click", ".page", function() {
				var el = $(this);
				that.goToPage(el.data("page"));
			});
		},
		navigate: function(next) {
			// default perPage to 5
			if (isNaN(next) || next === undefined) {
				next = true;
			}
			$(".pagination .nav").removeClass("disabled");
			if (next) {
				this.currentPage++;
				if (this.currentPage > (this.totalPages - 1))
					this.currentPage = (this.totalPages - 1);
				if (this.currentPage == (this.totalPages - 1))
					$(".pagination .nav.next").addClass("disabled");
				}
			else {
				this.currentPage--;
				if (this.currentPage < 0)
					this.currentPage = 0;
				if (this.currentPage == 0)
					$(".pagination .nav.prev").addClass("disabled");
				}

			this.showItems();
		},
		updateNavigation: function() {

			var pages = $(".pagination .page");
			pages.removeClass("current");
			$('.pagination .page[data-page="' + (
			this.currentPage + 1) + '"]').addClass("current");
		},
		goToPage: function(page) {

			this.currentPage = page - 1;

			$(".pagination .nav").removeClass("disabled");
			if (this.currentPage == (this.totalPages - 1))
				$(".pagination .nav.next").addClass("disabled");

			if (this.currentPage == 0)
				$(".pagination .nav.prev").addClass("disabled");
			this.showItems();
		},
		showItems: function() {
			this.items.hide();
			var base = this.perPage * this.currentPage;
			this.items.slice(base, base + this.perPage).show();

			this.updateNavigation();
		},
		init: function(container, items, perPage) {
			this.container = container;
			this.currentPage = 0;
			this.totalPages = 1;
			this.perPage = perPage;
			this.items = items;
			this.createNavigation();
			this.showItems();
		}
	};

	// stuff it all into a jQuery method!
	$.fn.pagify = function(perPage, itemSelector) {
		var el = $(this);
		var items = $(itemSelector, el);

		// default perPage to 5
		if (isNaN(perPage) || perPage === undefined) {
			perPage = 7;
		}

		// don't fire if fewer items than perPage
		if (items.length <= perPage) {
			return true;
		}

		pagify.init(el, items, perPage);
	};
})(jQuery);

//jQuery("#ads-list, #pagin-list").pagify(20, ".line-content");
jQuery(document).ready(function($){
$("#companies-list").pajinate({
    items_per_page : 20,
	item_container_id : '.content',
	nav_panel_id : '.page_navigation',
						num_page_links_to_display : 7,
	nav_label_first : '<<',
					nav_label_last : '>>',
					nav_label_prev : '<',
					nav_label_next : '>'
    });
});
jQuery(document).ready(function($){
    if($('table.company-excerpt>tr>td.excerpt-company').html() == "") {
        $(this).css('background-color','yellow');
    $('table.company-excerpt>tr>td:first-child').setAttribute("colspan", "2");
    }
    $('td.excerpt-company').each(function (){
    if ($(this).html() == '') {
        $(this).css('backgroundColor', 'red');
    }
});
});
       
 jQuery(document).ready(function() {

   jQuery('table.company-excerpt tr').each(function() {
    var tr = this;
    var counter = 0;
    var strLookupText = '';

    jQuery('td.excerpt-company', tr).each(function(index, value) {
      var td = jQuery(this);

      if ((td.text() == strLookupText) || (td.text() == "")) {
        counter++;
        td.prev().attr('colSpan', '' + parseInt(counter + 1,10) + '').css({textAlign : 'center'});
        td.remove();
      }
      else {
        counter = 0;
      }

      // Sets the strLookupText variable to hold the current value. The next time in the loop the system will check the current value against the previous value.
      strLookupText = td.text();

    });

  });
 });
 jQuery(document).ready(function(){
      jQuery('.cv-carousel').trigger('goTo', [5]);
});
 jQuery(function(){
	// simple multiple select
	jQuery('#rudr_select2_tags').select2();
 
	// multiple select with AJAX search
	jQuery('#rudr_select2_posts').select2({
  		ajax: {
    			url: ajaxurl, // AJAX URL is predefined in WordPress admin
    			dataType: 'json',
    			delay: 250, // delay in ms while typing when to perform a AJAX search
    			data: function (params) {
      				return {
        				q: params.term, // search query
        				action: 'mishagetposts' // AJAX action for admin-ajax.php
      				};
    			},
    			processResults: function( data ) {
				var options = [];
				if ( data ) {
 
					// data is the array of arrays, and each of them contains ID and the Label of the option
					$.each( data, function( index, text ) { // do not forget that "index" is just auto incremented value
						options.push( { id: text[0], text: text[1]  } );
					});
 
				}
				return {
					results: options
				};
			},
			cache: true
		},
		minimumInputLength: 3 // the minimum of symbols to input before perform a search
	});
});