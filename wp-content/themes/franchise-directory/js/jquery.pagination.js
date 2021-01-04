// var Imtech = {};
// Imtech.Pager = function() {
//     this.paragraphsPerPage = 3;
//     this.currentPage = 1;
//     this.pagingControlsContainer = '#pagingControls';
//     this.pagingContainerPath = '#content';
//     this.numPages = function() {
//         var numPages = 0;
//         if (this.paragraphs != null && this.paragraphsPerPage != null) {
//             numPages = Math.ceil(this.paragraphs.length / this.paragraphsPerPage);
//         }
//         return numPages;
//     };
//     this.showPage = function(page) {
//         this.currentPage = page;
//         var html = '';
//         this.paragraphs.slice((page-1) * this.paragraphsPerPage,
//             ((page-1)*this.paragraphsPerPage) + this.paragraphsPerPage).each(function() {
//             html += '<div>' + $(this).html() + '</div>';
//         });
//         $(this.pagingContainerPath).html(html);
//         renderControls(this.pagingControlsContainer, this.currentPage, this.numPages());
//     }
//     var renderControls = function(container, currentPage, numPages) {
//         var pagingControls = 'Page: <ul>';
//         for (var i = 1; i <= numPages; i++) {
//             if (i != currentPage) {
//                 pagingControls += '<li><a href="#" onclick="pager.showPage(' + i + '); return false;">' + i + '</a></li>';
//             } else {
//                 pagingControls += '<li>' + i + '</li>';
//             }
//         }
//         pagingControls += '</ul>';
//         $(container).html(pagingControls);
//     }
// }
(function($) {

    $.fn.my_pagination = function(options) {
        var opts = $.extend($.fn.my_pagination.defaults, options);

        return this.each(function() {
            var
                /*
                * unchanged varaibles during pagination
                *
                */
                collection = $(this),

                /*
                * changed varaibles when page or perPage change.
                *
                */
                topPanel, bottomPanel,
                // position related variables.
                // Note: when paginate, re-rendering the panels that depend on these variables which will be re-calculated first
                items, length, page, perPage, pages, start, end;

            /*
            * Set all position related varaibles based on current page and current number per page.
            *
            */
            function calculate(curPage, curPerPage) {
                items = collection.find(">li");
                length = items.size();
                perPage = Math.max(1, curPerPage);
                pages = Math.ceil(length / perPage);
                page = Math.max(1, Math.min(pages, curPage));
                start = (page - 1) * perPage + 1;
                end = Math.min(page * perPage, length);
            }

            function renderLink(n, args) {
                var clickHandler = function(n) {
                    return function(evt){
                        render(n, perPage, true);
                        return false;
                    }
                }

                var tag, options = args || {};

                if (n < 1 || n > pages)
                    tag = $("<span></span>").addClass("disabled");
                else if (n == page)
                    tag = $("<span></span>");
                else
                    tag = $("<a></a>").bind("click", clickHandler(n));

                tag.html(options.label || n.toString());
                if (options.className) tag.addClass(options.className);

                return tag;
            }

            function renderNavigation() {
                var nav = $("<span></span>").addClass("navigation");

                // add previous link
                nav.append(renderLink(page - 1, { label: opts.prevLabel, className: "prev" }));
                if (opts.withPageSelect) {
                    // add navigation links
                    if (opts.style == "link") for(var i = 1; i <= pages; i++) nav.append(renderLink(i));
                    // add navigation select
                    if (opts.style == "select") nav.append(renderPageSelect());
                }
                // add next link
                nav.append(renderLink(page + 1, { label: opts.nextLabel, className: "next" }));

                return nav;
            }

            function renderDesc() {
                var label = opts.descTemplate.replace(/#\{page\}/g, page).replace(/#\{pages\}/g, pages).replace(/#\{start\}/g, start).replace(/#\{end\}/g, end).replace(/#\{length\}/g, length);
                return $("<span></span>").text(label).addClass('description');
            }

            function renderPageSelect() {
                var select = $("<select></select>").addClass("pages");

                for(var i = 1; i <= pages; i++)
                    select.append($("<option" + (i == page ? " selected" : "") + "></option>").val(i).text(opts.pageTemplate.replace(/#\{page\}/g, i)));

                return select.bind("change" , function(){
                    render($(this).attr("value"), perPage, true);
                    return false;
                });
            }

            function renderPerPageSelect() {
                var select = $("<select></select>").addClass("perPages");

                $.each(opts.perPageOptions, function() {
                    var label = this == 1000 ? "Show All" : opts.perPageTemplate.replace(/#\{perPage\}/g, this);
                    select.append($("<option" + (this == perPage ? " selected" : "") + "></option>").attr("value", this).text(label));
                });

                select.bind("change", function() {
                    render(1, $(this).val(), true);
                    return false;
                });

                return select;
            }

            function renderPanel() {
                var panel = $("<div></div>").addClass(opts.cssClass);

                // add description section
                if (opts.descTemplate) panel.append(renderDesc());
                // add page navigation
                if (pages > 1) panel.append(renderNavigation());
                // add per page select
                if (opts.withPerPageSelect) panel.append(renderPerPageSelect());

                // add inner container if innerClass is given
                if (opts.innerClass) panel.wrapInner($("<div></div>").addClass(opts.innerClass))

                return panel;
            }

            function render(curPage, curPerPage, withCallback) {
                // calculate the position related varaibles
                calculate(curPage, curPerPage);

                // call before click callback
                if (withCallback && opts.beforeClick) {
                    collection.data('page', page).data('perPage', perPage);
                    opts.beforeClick(collection);
                    calculate(collection.data('page'), collection.data('perPage'));
                }

                // render top and bottom navigation panel
                if (topPanel) topPanel.remove();
                if (bottomPanel) bottomPanel.remove();

                if (length > 0) {
                    var panel = renderPanel();
                    if (opts.panel == "top" || opts.panel == "both") topPanel = panel.clone(true).insertBefore(collection).addClass("paginatorTop");
                    if (opts.panel == "bottom" || opts.panel == "both") bottomPanel = panel.clone(true).insertAfter(collection).addClass("paginatorBottom");


                    var showItems = items.hide().slice(start - 1, end);

                    opts.render ? opts.render(collection, showItems) : showItems.show();
                }

                // call after click callback
                if (withCallback && opts.afterClick) {
                    collection.data('page', page).data('perPage', perPage);
                    opts.afterClick(collection);
                }
            };

            render(opts.page, opts.perPage, false);
        });
    };

    $.fn.my_pagination.defaults = {
        page: 1,
        perPage: 20,
        perPageOptions: [20, 40, 60, 80, 100, 1000],
        cssClass: "collectionPagination",
        innerClass: null,
        panel: "both",
        style: "select",
        withPerPageSelect: true,
        withPageSelect: true,
        prevLabel: "<",
        nextLabel: ">",
        descTemplate: "Items #{start} - #{end} of #{length}",
        pageTemplate: "Page #{page}",
        perPageTemplate: "#{perPage} per page",
        beforeClick: null,
        afterClick: null,
        render: null
    };

})(jQuery);
