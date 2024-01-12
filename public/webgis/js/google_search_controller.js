(function (global, $) {
    var map;
    var location_For_Search = [];
    const searchResults = document.getElementById('search-results');
    const google_search_input = document.getElementById('google-search-input');
    
    function setMap (input) {
        map = input;
    }
    
    function setLocationForSearch (location) {
        location_For_Search = location;
    }
    
    function displaySearchResults(results, textSearch) {
        const textSearchItem = document.createElement('div');
        textSearchItem.textContent = textSearch;
        // textSearchItem.addEventListener('click', function (event) {
        //     GISApp.layerController.removeLayer('Point-Searched', map);
        //     var input = divElement.innerHTML;
        //     handleTextSearch(input);
        //     searchResults.innerHTML = '';
        // });
        
        searchResults.appendChild(textSearchItem);
        results.forEach((result) => {
        
            const resultItem = document.createElement('div');
            const description = result.description;
            const textShow = description.length >= 40 ? description.substring(0, 40) + ' ...' : description;
            
            resultItem.textContent = textShow;
            searchResults.appendChild(resultItem);
        })
        
        const divElements = searchResults.querySelectorAll('div');
        divElements.forEach((divElement, index) => {
            divElement.addEventListener('click', function (event) {
                var input;
                GISApp.layerController.removeLayer('Point-Searched', map);
                if (index === 0) {
                    input = divElement.innerHTML;
                    handleSearchNearBy(input)
                } else {
                    input = results[index - 1].description;
                    handleTextSearch(input);
                }
                searchResults.innerHTML = '';
            });
        });
    
        searchResults.style.display = 'block';
    }
    
    function handleTextSearch(input) {
        var coor_900913 = location_For_Search;
        var coor_4326 = ol.proj.transform(coor_900913, 'EPSG:900913', 'EPSG:4326');
        var location = coor_4326[1] + ',' + coor_4326[0];
        var csrfToken = $('#csrf-token').attr('content');
        var url = apiUrl+"/surveyor/webgis/google-search-textSearch";
        
        $u.ajaxRequest('POST', url,
            {"_token":csrfToken, "input": input, "location": location}, async function (response) {
                if (response.status && response.status == "OK") {
                    try {
                        var bbox = [];
                        var pointList = [];
                        var results = response.results;
                        var icon_url = results[0].icon;
                        var next_page_token = response.next_page_token;
                        
                        results.forEach((data) => {
                            var lat = data.geometry.location.lat;
                            var lng = data.geometry.location.lng;
                            var coor_4326 = [lng, lat];
                            var coor_900913 = ol.proj.transform(coor_4326, 'EPSG:4326', 'EPSG:900913');
                            
                            var point = new ol.Feature({
                                geometry: new ol.geom.Point(coor_900913),
                                place_id: data.place_id,
                                label: data.name
                            });
                            
                            pointList.push(point)
                        })
                        if (results.length === 1) {
                            var viewport = results[0].geometry.viewport;
                            bbox = [
                                  viewport.southwest.lng,
                                  viewport.southwest.lat,
                                  viewport.northeast.lng,
                                  viewport.northeast.lat
                            ];
                        }
                        GISApp.layerController.addPointSearchLayer(map, pointList, icon_url, bbox);
                        // if (next_page_token && next_page_token !== '') {
                        //      setTimeout(() => {
                        //         handleTextSearchNextPage(next_page_token, pointList);
                        //     }, 1000);
                        // }
                    } catch (err) {
                        console.log (err)  
                    }
                }
            }
        );
    }
    
    function handleTextSearchNextPage (pagetoken) {
        var pointList = [];
        var csrfToken = $('#csrf-token').attr('content');
        var url = apiUrl+"/surveyor/webgis/google-search-textSearch-nextPage";
        $u.ajaxRequest('POST', url,
            {"_token":csrfToken, "pagetoken": pagetoken}, function (response) {
                if (response.status && response.status == "OK") {
                    try {
                        var results = response.results;
                        var icon_url = results[0].icon;
                        var next_page_token = response.next_page_token;
                        results.forEach((data) => {
                            var lat = data.geometry.location.lat;
                            var lng = data.geometry.location.lng;
                            var coor_4326 = [lng, lat];
                            var coor_900913 = ol.proj.transform(coor_4326, 'EPSG:4326', 'EPSG:900913');
                            
                            var point = new ol.Feature({
                                geometry: new ol.geom.Point(coor_900913),
                                place_id: data.place_id,
                                label: data.name
                            });
                            
                            pointList.push(point)
                        })
                        GISApp.layerController.addMorePointSearchFeature(map, pointList);
                        if (next_page_token && next_page_token !== '') {
                             setTimeout(() => {
                                handleTextSearchNextPage(next_page_token, pointList);
                            }, 1000);
                        }
                    } catch (err) {
                        console.log (err)
                    }
                }
            }
        );
    }
    
    function handleSearchNearBy (input) {
        var coor_900913 = location_For_Search;
        var coor_4326 = ol.proj.transform(coor_900913, 'EPSG:900913', 'EPSG:4326');
        var location = coor_4326[1] + ',' + coor_4326[0];
        var csrfToken = $('#csrf-token').attr('content');
        var url = apiUrl+"/surveyor/webgis/google-search-searchNearBy";
        
        $u.ajaxRequest('POST', url,
            {"_token":csrfToken, "input": input, "location": location}, async function (response) {
                if (response.status && response.status == "OK") {
                    try {
                        var bbox = [];
                        var pointList = [];
                        var results = response.results;
                        var icon_url = results[0].icon;
                        var next_page_token = response.next_page_token;
                        
                        results.forEach((data) => {
                            var lat = data.geometry.location.lat;
                            var lng = data.geometry.location.lng;
                            var coor_4326 = [lng, lat];
                            var coor_900913 = ol.proj.transform(coor_4326, 'EPSG:4326', 'EPSG:900913');
                            
                            var point = new ol.Feature({
                                geometry: new ol.geom.Point(coor_900913),
                                place_id: data.place_id,
                                label: data.name
                            });
                            
                            pointList.push(point)
                        })
                        if (results.length === 1) {
                            var viewport = results[0].geometry.viewport;
                            bbox = [
                                  viewport.southwest.lng,
                                  viewport.southwest.lat,
                                  viewport.northeast.lng,
                                  viewport.northeast.lat
                            ];
                        }
                        GISApp.layerController.addPointSearchLayer(map, pointList, icon_url, bbox);
                        if (next_page_token && next_page_token !== '') {
                             setTimeout(() => {
                                handleTextSearchNextPage(next_page_token, pointList);
                            }, 1000);
                        }
                    } catch (err) {
                        console.log (err)  
                    }
                }
            }
        );
    }
    
    function handlePlaceSearch (description) {
        var csrfToken = $('#csrf-token').attr('content');
        var url = apiUrl+"/surveyor/webgis/google-search-placeSearch";
        
        $u.ajaxRequest('POST', url,
            {"_token":csrfToken, "input": description}, function (response) {
                if (response.status && response.status == "OK") {
                    try {
                        var pointList = [];
                        iconURL = response.candidates[0].icon;
                        
                        var lat = response.candidates[0].geometry.location.lat;
                        var lng = response.candidates[0].geometry.location.lng;
                        var coor_4326 = [lng, lat];
                        var coor_900913 = ol.proj.transform(coor_4326, 'EPSG:4326', 'EPSG:900913');
                        
                        var point = new ol.Feature({
                            geometry: new ol.geom.Point(coor_900913),
                            place_id: response.candidates[0].place_id,
                            label: description.substring(0, 40) + '...'
                        });
                        pointList.push(point)
                        GISApp.layerController.addPointSearchLayer(map, pointList, iconURL);
                    } catch (err) {
                        console.log (err)  
                    }
                }
            }
        );
    }
    
    function getPlaceDetail(api_key, place_id) {
        var api_url = "https://maps.googleapis.com/maps/api/place/details/json";
        var csrfToken = $('#csrf-token').attr('content');
        var url = apiUrl+"/surveyor/webgis/google-search-placeDetail";
        
        return new Promise(function (resolve, reject) {
            $u.ajaxRequest('POST', url,
                {"_token":csrfToken, "place_id": place_id}, function (response) {
                    if (response.status && response.status == "OK") {
                        try {
                            resolve(response.result);
                        } catch (err) {
                            console.log (err)  
                        }
                    }
                }
            );
            
        })
    }
    
    function getPlacePhoto(api_key, photo_reference) {
        var api_url = "https://maps.googleapis.com/maps/api/place/photo";
        var max_width_param = "?maxwidth=400";
        var photo_reference_param =`&photo_reference=${photo_reference}`
        var api_key_param = `&key=${api_key}`
        return api_url + max_width_param + photo_reference_param + api_key_param;
    }
    
    function debounce(func, delay) {
        let timer;
        return function () {
            const context = this;
            const args = arguments;
            clearTimeout(timer);
            timer = setTimeout(() => {
                func.apply(context, args);
            }, delay);
        };
    }

    function handleEventOnInputSearch (inputValue) {
        if (!inputValue) return;
        
        var url = apiUrl+"/surveyor/webgis/google-search-autocomplete";
        var csrfToken = $('#csrf-token').attr('content');
        var coor_900913 = location_For_Search;
        var coor_4326 = ol.proj.transform(coor_900913, 'EPSG:900913', 'EPSG:4326');
        var location = coor_4326[1] + ',' + coor_4326[0];
        
        $.ajax({
            type: "POST",
            url: url,
            data: JSON.stringify({"_token":csrfToken, "input": inputValue, "location": location}),
            contentType: "application/json",
            success: function(response) {
                if (response.status && response.status == "OK") {
                    try {
                        searchResults.innerHTML = '';
                        var predictions = response.predictions;
                        displaySearchResults(predictions, inputValue);
                    } catch (err) {
                        console.log (err)  
                    }
                }
            },
            error: function(error) {
                console.error("Error:", error);
            }
        });
    }
    
    google_search_input.addEventListener('click', function(event) {
        var inputValue = google_search_input.value;
        handleEventOnInputSearch(inputValue);
    })
    
    google_search_input.addEventListener('input', function(event) {
        global.placeCard.hideCard();
        global.popupController.hidePopup();
        GISApp.layerController.removeLayer('Point-Searched', map);        
        var inputValue = google_search_input.value;
        handleEventOnInputSearch(inputValue);
        
    });
    
    var obj = {
        location_For_Search: location_For_Search,
        setMap: function(){
            return setMap.apply(this, arguments);
        },
        setLocationForSearch: function(){
            return setLocationForSearch.apply(this, arguments);
        },
        getPlaceDetail: function(){
            return getPlaceDetail.apply(this, arguments);
        },
        getPlacePhoto: function(){
            return getPlacePhoto.apply(this, arguments);
        },
    }
    
    global.googleSearchController = obj;
    
})(window.GISApp, jQuery);