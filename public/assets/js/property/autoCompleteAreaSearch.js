/**
 * Description: This script handles suggestions for Area input.
 * Author: Your Name
 * Version: 1.0
 * Date: December 9, 2023
 */

function autoCompleteAreaSearch(selector, options) {

    let $selects = $(selector);

    $selects.each(function (index) {
        let $thisSelect = $(this);
        let $dropdown = $(
            '<div class="autocomplete-dropdown autocomplete-dropdown-' +
                (index + 1) +
                '"></div>'
        );
        $thisSelect.after($dropdown);
    });

    $(document).on("input", '.select-suggestions',function () {
        let $thisSelect = $(this);
        let $thisSelectAutoDD = $thisSelect.next('.autocomplete-dropdown').first();
        if ($thisSelect.val().length >= 1) {
            loadSuggestions($thisSelect, 1, $thisSelectAutoDD, 'fetch-data'); // Load suggestions for the first page
        } else {
            $thisSelectAutoDD.html('');
        }
    });

    $(document).on('click', '.load-more', function () {
        let $thisSelectAutoDD = $(this).parent().closest('.autocomplete-dropdown'); 
        let $thisSelectEle = $thisSelectAutoDD.parent().find('.select-suggestions'); 
        var nextPage = $(this).data('next-page');
        if (nextPage) {
            loadSuggestions($thisSelectEle, nextPage, $thisSelectAutoDD, 'load-more');
            if(nextPage >= 1 ){
                $('.'+'lmc-'+(nextPage)).remove();
            }
        }
    });

    function loadSuggestions(builder, page, thisSelectAutoDD, type) {
        let builderKey = builder.val();
        $.ajax({
            url: apiUrl + "/surveyor/property/area/get-suggestions",
            method: 'GET',
            data: {
                builderKey : builderKey,
                page : page
            },
            success: function (data) {
                if(type == 'fetch-data'){
                    thisSelectAutoDD.empty();
                }
                 thisSelectAutoDD.append(data);

                let nextPage = $(data).filter('.load-more-container').find('.load-more').data('next-page');
                thisSelectAutoDD.find('.load-more').data('next-page', nextPage);

                if (!nextPage) {
                    thisSelectAutoDD.find('.load-more-container').hide();
                }
                thisSelectAutoDD.show();
            }
        });
    }

    $(document).on('click', '.select-suggestions', function(){
        $(this).next('.autocomplete-dropdown').first().show();
    });

    $(document).on('click', function (e) {
        if (!$(e.target).closest('.autocomplete-dropdown').length && !$(e.target).is('.select-suggestions')) {
            $('.autocomplete-dropdown').hide();
        }
    });

}