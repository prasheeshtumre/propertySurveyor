/**
 * Description: This script handles suggestions.
 * Version: 1.0
 * Date: December 9, 2023
 */

    function autoCompleteBuilderSearch(selector, options) {
        let $selects = $(selector);

        $selects.each(function (index) {
            let $thisSelect = $(this);
            let $dropdown = $(
                '<div class="autocomplete-dropdown autocomplete-dropdown-' +
                (index + 1) +
                '"></div><div class="suggestion-lables"></div>'
            );
            if(!$thisSelect.hasClass('edit')){
                $thisSelect.after($dropdown);
            }
        });

        $(document).on("input", ".select-suggestions", function () {
            let $thisSelect = $(this);
            let $thisSelectAutoDD = $thisSelect
                .next(".autocomplete-dropdown")
                .first();
            let suggestionLabelContainer = $(this)
                .parent()
                .find(".suggestion-lables")
                .find(".badge");
            let selectedBuilders = [];
            suggestionLabelContainer.map(function (i, v) {
                selectedBuilders.push($(v).attr("data-id"));
            });
            if ($thisSelect.val().length >= 1) {
                loadSuggestions(
                    $thisSelect,
                    1,
                    $thisSelectAutoDD,
                    "fetch-data",
                    selectedBuilders
                ); // Load suggestions for the first page
            } else {
                $thisSelectAutoDD.html("");
            }
        });

        $(document).on("click", ".load-more", function () {
            let $thisSelectAutoDD = $(this)
                .parent()
                .closest(".autocomplete-dropdown");
            let $thisSelectEle = $thisSelectAutoDD
                .parent()
                .find(".select-suggestions");
            var nextPage = $(this).data("next-page");
            let suggestionLabelContainer = $(this)
                .parent()
                .closest(".autocomplete-dropdown")
                .next(".suggestion-lables")
                .children(".badge");
            let selectedBuilders = [];
            suggestionLabelContainer.map(function (i, v) {
                selectedBuilders.push($(v).attr("data-id"));
            });
            if (nextPage) {
                loadSuggestions(
                    $thisSelectEle,
                    nextPage,
                    $thisSelectAutoDD,
                    "load-more",
                    selectedBuilders
                );
                if (nextPage >= 1) {
                    $("." + "lmc-" + nextPage).remove();
                }
            }
        });

        function loadSuggestions(
            builder,
            page,
            thisSelectAutoDD,
            type,
            selectedBuilders
        ) {
            let builderKey = builder.val();
            $.ajax({
                url: apiUrl + "/surveyor/property/builder/get-suggestions",
                method: "GET",
                data: {
                    searchKey: builderKey,
                    page: page,
                    selectedBuilders: selectedBuilders ?? [],
                },
                success: function (data) {
                    if (type == "fetch-data") {
                        thisSelectAutoDD.empty();
                    }
                    thisSelectAutoDD.append(data);

                    let nextPage = $(data)
                        .filter(".load-more-container")
                        .find(".load-more")
                        .data("next-page");
                    thisSelectAutoDD.find(".load-more").data("next-page", nextPage);

                    if (!nextPage) {
                        thisSelectAutoDD.find(".load-more-container").hide();
                    }
                    thisSelectAutoDD.show();
                },
                error: function(xhr, status, error) {
                    if (xhr.status == 404 || xhr.status == 403) {
                        toastr.error('Server Error Occured While Fetching Builders.');
                    }
                }
            });
        }

        $(document).on("click", ".select-suggestions", function () {
            $(this).next(".autocomplete-dropdown").first().show();
        });

        $(document).on("click", function (e) {
            if (
                !$(e.target).closest(".autocomplete-dropdown").length &&
                !$(e.target).is(".select-suggestions") &&
                !$(e.target).is(".input-select-suggestions")
            ) {
                $(".autocomplete-dropdown").hide();
            }
        });
        
    }
    
    function populateBuilderSubGroup(){
        let builders = $('#update_property .builder-dd').filter(":checked");
        let builderIdArr = [];

        let builderSubGroup = $('#update_property .builder-dd')
            .parent()
            .closest(".cfc-content")
            .find(".builder-sub-group-dd");
        let suggestionContainer = builderSubGroup.next(
            ".builder-sub-group-autocomplete-dropdown"
        );
        let suggestionLabelContainer = $('#update_property .builder-dd')
            .parent()
            .closest(".autocomplete-dropdown")
            .next(".suggestion-lables");
        builders.map(function (i, v) {
            suggestionLabelContainer.append(
                '<span class="badge bg-success" data-id="' +
                $(v).val() +
                '">' +
                $(v).attr("data-title") +
                '<input type="hidden" name="builder[]" value="' +
                $(v).val() +
                '">' +
                '<span class="badge bg-danger btn remove-suggestion-label">-</span></span>'
            );
        });
        let suggestionLabels = $('#update_property .builder-dd')
            .nextAll(".suggestion-lables")
            .children(".badge");
        suggestionLabels.map(function (i, v) {
            builderIdArr.push($(v).attr("data-id"));
        });

        let builderSGIdArr = [];
        let subGroupBadges = $('.builder-sub-group__suggestion-lables').children('.badge');
        subGroupBadges.map(function (i, v) {
            builderSGIdArr.push($(v).attr("data-id"));
        });
        
        autoCompleteBuilderSubGroupSearch(
            ".builder-sub-group-select-suggestions",
            builderSubGroup,
            suggestionContainer,
            builderIdArr ?? [],
            "choose-builders",
            builderSGIdArr
        );
    }

    $(document).on("click", ".builder-chk", function () {
     
            let builders = $(this).filter(":checked");
            let builderIdArr = [];

            let builderSubGroup = $(this)
                .parent()
                .closest(".cfc-content")
                .find(".builder-sub-group-dd");
            let suggestionContainer = builderSubGroup.next(
                ".builder-sub-group-autocomplete-dropdown"
            );
            let suggestionLabelContainer = $(this)
                .parent()
                .closest(".autocomplete-dropdown")
                .next(".suggestion-lables");

            let previousBuilders = suggestionLabelContainer.children('.badge');
            let previousBuildersArr = [];
            previousBuilders.map(function (i, v) {
                previousBuildersArr.push($(v).data('id'));
            });
            console.log(previousBuildersArr);
            builders.map(function (i, v) {
                // console.log(previousBuildersArr.includes($(v).val()), $(v).val());
                if(!previousBuildersArr.includes(parseInt($(v).val())))
                {
                    suggestionLabelContainer.append(
                        '<span class="badge bg-success" data-id="' +
                        $(v).val() +
                        '">' +
                        $(v).attr("data-title") +
                        '<input type="hidden" name="builder[]" value="' +
                        $(v).val() +
                        '">' +
                        '<span class="badge bg-danger btn remove-suggestion-label parent__builder-'+ $(v).val() +'">-</span></span>'
                    );
                }
            });

            let suggestionLabels = $(this)
                .parent()
                .closest(".autocomplete-dropdown")
                .next(".suggestion-lables")
                .children(".badge");

            suggestionLabels.map(function (i, v) {
                builderIdArr.push($(v).attr("data-id"));
            });

            if($(this).prop('checked') == true){
                $(this).prop('disabled', true);
            }

            let builderSGIdArr = [];
            let subGroupBadges = $('.builder-sub-group__suggestion-lables').children('.badge');
            subGroupBadges.map(function (i, v) {
                builderSGIdArr.push($(v).attr("data-id"));
            });

            autoCompleteBuilderSubGroupSearch(
                ".builder-sub-group-select-suggestions",
                builderSubGroup,
                suggestionContainer,
                builderIdArr ?? [],
                "choose-builders",
                builderSGIdArr
            );

    });
    $(document).on("click", ".builder-sg-chk", function () {
        $(this).prop('disabled', true);
        let parentBuilderID = $(this).data('pid');
        let builders = $(this).filter(":checked");
            let builderIdArr = [];

            let builderSubGroup = $(this)
                .parent()
                .closest(".cfc-content")
                .find(".builder-sub-group-dd");
            let suggestionContainer = builderSubGroup.next(
                ".builder-sub-group-autocomplete-dropdown"
            );
            let suggestionLabelContainer = $(this)
                .parent()
                .closest(".builder-sub-group-autocomplete-dropdown")
                .next(".builder-sub-group__suggestion-lables");

            let previousBuilders = suggestionLabelContainer.children('.badge');
            let previousBuildersArr = [];
            previousBuilders.map(function (i, v) {
                previousBuildersArr.push($(v).data('id'));
            });
            // console.log(previousBuildersArr);
            builders.map(function (i, v) {
                // console.log(previousBuildersArr.includes($(v).val()), $(v).val());
                if(!previousBuildersArr.includes(parseInt($(v).val())))
                {
                    suggestionLabelContainer.append(
                        '<span class="badge bg-success pbsg-' + ( parentBuilderID ?? 0 ) + '" data-id="' +
                        $(v).val() +
                        '">' +
                        $(v).attr("data-title") +
                        '<input type="hidden" name="builder_sub_group[]" value="' +
                        $(v).val() +
                        '">' +
                        '<span class="badge bg-danger btn remove-suggestion-label">-</span></span>'
                    );
                }
            });
    });

    $(document).on("click", ".remove-suggestion-label", function () {
        let removedBuilder = $(this).parent().attr("data-id") ?? 0;
        let builderIdArr = [];
        let suggestionLabels = $(this)
            .parent()
            .closest(".suggestion-lables")
            .children(".badge");

        $('.pbsg-'+ removedBuilder).remove();
        let builderSubGroup = $(this)
            .parent()
            .closest(".cfc-content")
            .find(".builder-sub-group-dd");
        let suggestionContainer = builderSubGroup.next(
            ".builder-sub-group-autocomplete-dropdown"
        );

        suggestionLabels.map(function (i, v) {
            if (removedBuilder != $(v).attr("data-id"))
                builderIdArr.push($(v).attr("data-id"));
        });



        $(this).parent().remove();
        $('.parent__builder-')

        autoCompleteBuilderSubGroupSearch(
            ".builder-sub-group-select-suggestions",
            builderSubGroup,
            suggestionContainer,
            builderIdArr ?? [],
            "choose-builders"
        );
    });
    $(document).on("click", ".remove-sub-group__suggestion-label", function () {
        $(this).parent().remove();
    });

    $(document).on('click', '.builder-sub-group-dd', function(){
        if($('#update_property .builder-dd').is(':visible') == true){
            populateBuilderSubGroup();
        }
    })

    function autoCompleteBuilderSubGroupSearch(
        selector,
        builderSubGroup,
        suggestionContainer,
        builderIdArr,
        requestType,
        builderSGIdArr
    ) {
         
        let $selects = $(selector);
        if (requestType == "choose-builders") {
            
            loadSubGroupSuggestions(
                builderSubGroup,
                1,
                suggestionContainer,
                builderIdArr,
                "choose-builders",
                builderSGIdArr
            );
        }

        $(document).on(
            "click",
            ".builder-sub-group-select-suggestions",
            function () {
                $(this)
                    .next(".builder-sub-group-autocomplete-dropdown")
                    .first()
                    .show();
            }
        );

        $(document).on("click", function (e) {
            if (
                !$(e.target).closest(".builder-sub-group-autocomplete-dropdown")
                    .length &&
                !$(e.target).is(".builder-sub-group-select-suggestions")&&
                !$(e.target).is(".builder-sub-group-autocomplete-dropdown")&&
                !$(e.target).is(".input-select-suggestions")
            ) {
                $(".builder-sub-group-autocomplete-dropdown").hide();
            }
        });
    }

    $(document).on("input", ".builder-sub-group-dd", function () {
        let $thisSelect = $(this);
        let $thisSelectAutoDD = $thisSelect
            .next(".builder-sub-group-autocomplete-dropdown")
            .first();
        let builders = $(this)
            .parent()
            .closest(".cfc-content")
            .find(".builder-dd")
            .parent()
            .find(".suggestion-lables").find('.badge');
        let builderIdArr = [];
        // let builders = $(this).next('.builder-sub-group-autocomplete-dropdown').children('.builder-group-label');
        builders.map(function (i, v) {
            builderIdArr.push($(v).attr("data-id"));
        });
        let builderSGIdArr = [];
        let subGroupBadges = $('.builder-sub-group__suggestion-lables').children('.badge');
        subGroupBadges.map(function (i, v) {
            builderSGIdArr.push($(v).attr("data-id"));
        });
        console.log('asdf', builderIdArr)
        if ($thisSelect.val().length >= 0) {
            loadSubGroupSuggestions(
                $thisSelect,
                1,
                $thisSelectAutoDD,
                builderIdArr,
                "fetch-data",
                builderSGIdArr
            );
        }   
    });

    function loadSubGroupSuggestions(
        builder,
        page,
        thisSelectAutoDD,
        builderIdArr,
        type,
        builderSGIdArr
    ) {

        let builderKey = builder.val();
        if (builderIdArr.length == 0) {
            thisSelectAutoDD.empty();
            return false;
        }
        $.ajax({
            url: apiUrl + "/surveyor/property/sub-builder/get-suggestions",
            method: "GET",
            data: {
                searchKey: builderKey,
                page: page,
                builderIdArr: builderIdArr,
                builderSGIdArr: builderSGIdArr,
            },
            success: function (data) {
                if (type == "fetch-data" || type == "choose-builders") {
                    thisSelectAutoDD.html("");
                }
                thisSelectAutoDD.append(data);

                let nextPage = $(data)
                    .filter(".load-more-container")
                    .find(".load-more")
                    .data("next-page");
                thisSelectAutoDD.find(".load-more").data("next-page", nextPage);

                if (!nextPage) {
                    thisSelectAutoDD.find(".load-more-container").hide();
                }

                if (type != "choose-builders") thisSelectAutoDD.show();
            },
        });
    }

    function fetchCity() {
        let gisId = $("#gis_id").val();
        $.ajax({
            url: apiUrl + "/surveyor/property/fetch-city",
            method: "GET",
            dataType: "json",
            data: {
                gisId: gisId,
            },
            success: function (data) {
                if (data.status == true) {
                    
                    $('#create_property input[name="city"]').val(data.city);
                    $('#create_property input[name="city_id"]').val(data.id);
                    $('#create_property input[name="pincode"]').val(data.pincode ?? 'N/A');

                    if($('#update_property').is(':visible')){
                        $('#update_property input[name="city"]').val(data.city);
                        $('#update_property input[name="city_id"]').val(data.id);
                        $('#update_property input[name="pincode"]').val(data.pincode ?? 'N/A');
                    }

                } else if (data.status == false) {
                    $('#create_property input[name="city"]').val(data.message);
                    if($('#update_property').is(':visible')){
                        $('#update_property input[name="city"]').val(data.message);
                    }
                }
            },
            error: function (error) {
                toastr.error(error.message);
            },
        });
    }

/* construction partner autosearch suggestions starts */
    function autoCompleteConstructionPartnerSearch(selector, options) {
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
        $(document).on("input", ".construction-partner-select-suggestions", function () {
            let $thisSelect = $(this);
            let $thisSelectAutoDD = $thisSelect
                .next(".autocomplete-dropdown")
                .first();
            let suggestionLabelContainer = $(this)
                .parent()
                .find(".suggestion-lables")
                .find(".badge");
            let endPoint = apiUrl + "/surveyor/property/construction-partner";
            if ($thisSelect.val().length >= 1) {
                loadInpSuggestions($thisSelect,1,$thisSelectAutoDD,"fetch-data", endPoint, 'construction_partner'); // Load suggestions for the first page
            } else {
                $thisSelectAutoDD.html("");
            }
        });
        $(document).on("click", ".construction-partner-select-suggestions", function () {
            $(this).next(".autocomplete-dropdown").first().show();
        });
        $(document).on("click", function (e) {
            if (
                !$(e.target).is(".construction-partner-select-suggestions")&&
                !$(e.target).is(".input-select-suggestions")
                
            ) {
                $(".choose-suggestion-label-body .autocomplete-dropdown").hide();
                // $('.choose-suggestion-label').show();
            }
        });
      
    }
/* construction partner autosearch suggestions ends */

/* area autosearch suggestions starts */
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
        $(document).on("input", ".area-select-suggestions", function () {
            let $thisSelect = $(this);
            let $thisSelectAutoDD = $thisSelect
                .next(".autocomplete-dropdown")
                .first();
            let endPoint = apiUrl + "/surveyor/property/area/get-area-by-search-key";
            if ($thisSelect.val().length >= 1) {
                let cityId = $('#city_id').val();
                loadInpSuggestions($thisSelect,1,$thisSelectAutoDD,"fetch-data", endPoint, 'area', {cityId : cityId ?? 0}); // Load suggestions for the first page
            } else {
                $thisSelectAutoDD.html("");
            }
        });
        

        $(document).on("click", ".area-select-suggestions", function () {
            $(this).next(".autocomplete-dropdown").first().show();
        });

    }
/* area autosearch suggestions ends */

/* common for auto search suggestions */
    $(document).on("click", ".load-next", function () {
        let $thisSelectAutoDD = $(this)
            .parent()
            .closest(".autocomplete-dropdown");
        let $thisSelectEle = $thisSelectAutoDD
            .parent()
            .find(".input-select-suggestions");
        let nextPage = $(this).data("next-page");
        let endPoint = $(this).data("next-url");
        let fieldName = $(this).data("name");
        if (nextPage) {
            loadInpSuggestions($thisSelectEle, nextPage, $thisSelectAutoDD, "load-more", endPoint, fieldName);
            if (nextPage >= 1) {
                $("." + "lmc-" + nextPage).remove();
            }
        }
    });

    $(document).on('focus',".choose-suggestion-label-body", function () {
        $(this).find('.choose-suggestion-label').hide();
        // $(this).parent().find('.autocomplete-dropdown').show()
    });
    $(document).on('blur',".choose-suggestion-label-body", function () {
        $(this).find('.choose-suggestion-label').show();
    });
    $(document).on("click", ".input-select-suggestions", function () {
        $(this).parent().find('.autocomplete-dropdown').show();
    });

    $(document).on('click', '.auto-complete-label', function(){
        let selectedValue = $(this).val();
        let selectedValueId = $(this).data('id');
        let fieldName = $(this).data('name');
        let chooseSuggestionLabel = $(this).parent().closest('.choose-suggestion-label-body').find('.choose-suggestion-label');
        chooseSuggestionLabel.html(selectedValue + "<input type='hidden' value='"+selectedValueId+"' name='"+fieldName+"'>");
        chooseSuggestionLabel.find('.area-select-suggestions').val('');
    });

    function loadInpSuggestions( input,
        page,
        thisSelectAutoDD,
        type,
        endPoint,
        fieldName,
        additionalParams = {}) {
        let searchKey = input.val();
         let reqData = {
            searchKey: searchKey,
            page: page,
            fieldName: fieldName
        };

        for (const key in additionalParams) {
            if (additionalParams.hasOwnProperty(key)) {
                reqData[key] = additionalParams[key];
            }
        }
        
        $.ajax({
            url: endPoint,
            method: "GET",
            data: reqData,
            success: function (data) {
                if (type == "fetch-data") {
                    thisSelectAutoDD.empty();
                }
                thisSelectAutoDD.append(data);

                let nextPage = $(data)
                    .filter(".load-more-container")
                    .find(".load-more")
                    .data("next-page");
                thisSelectAutoDD.find(".load-more").data("next-page", nextPage);

                if (!nextPage) {
                    thisSelectAutoDD.find(".load-more-container").hide();
                }
                thisSelectAutoDD.show();
            },
            error: function (error) {
                console.log(error);
                // toastr.success(error.message);
            },
        });
    }
/* common for auto search suggestions */