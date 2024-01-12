(function (global, $) {
    if (!global) {
        throw "App is not initialized";
    }
    if (!$) {
        throw "jQuery is not available";
    }

    var obj = {};

    var overlay;
    
    obj.initCard = function (map) {
        var container = document.getElementById('place-card');
        
        var closer = document.getElementById('card-closer');
        overlay = new ol.Overlay({
            element: container,
            autoPan: true,
            autoPanAnimation: {
                duration: 250
            }
        });
        
        closer.onclick = function () {
            overlay.setPosition(undefined);
            closer.blur();
            return false;
        };

        map.addOverlay(overlay);
        
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
    
    obj.showCard = async function (coordinate, place_id) {
        var url = apiUrl+"/surveyor/webgis/get-place-card-controller";
        var content = document.getElementById('card-content');
        var csrfToken = $('#csrf-token').attr('content'); 
        let latLongs = ol.proj.transform(coordinate, 'EPSG:3857','EPSG:4326');

        var api_key = "AIzaSyAm9ekbF8SnmFeUH4BvEffHYu_TuUieoDw";
        
        try {
            // var place_detail = await getPlaceDetail(api_key, place_id);
            var place_detail = await GISApp.googleSearchController.getPlaceDetail(api_key, place_id);
            
            var name = place_detail?.name;
            var url_place = place_detail?.url;
            var rating = place_detail?.rating;
            var website = place_detail?.website;
            var open = place_detail?.opening_hours?.open;
            var pluscode = place_detail?.plus_code?.compound_code;
            var phone_number = place_detail?.formatted_phone_number;
            var user_ratings_total = place_detail?.user_ratings_total;
            
            var photo_list = [];
            
            var photo_detail = place_detail.photos;
            if (photo_detail && photo_detail.length > 0) {
                photo_detail.forEach((photo) => {
                    var photo_reference = photo.photo_reference;
                    var photo_url = GISApp.googleSearchController.getPlacePhoto(api_key, photo_reference);
                    photo_list.push(photo_url);
                    // var photo_url = getPlacePhoto(api_key, photo_reference);
                    // photo_list.push(photo_url);
                })
            } else {
                photo_list.push('https://survey.proper-t.co/public/webgis/images/no-image-v2.png')
            }
            
            $.post(url,{
                "_token": csrfToken, 
                name: name, 
                open: open,
                rating: rating, 
                website: (website && website.length > 50) ? website.substring(0, 50) + " ..." : website,
                pluscode: pluscode,
                url_place: (url_place && url_place.length > 50) ? url_place.substring(0, 50) + " ..." : url_place, 
                phone_number: phone_number,
                photo_list: photo_list,
                user_ratings_total: user_ratings_total
            },function(place_card_data){
                content.innerHTML = '<p>' + place_card_data + '</p>';
                overlay.setPosition(coordinate);
            });
        
        } catch (error) {
            console.error('Error getting place detail:', error);
        }
    }
    
    obj.hideCard = function () {
        overlay.setPosition(undefined);
    }
    
    global.placeCard = obj;
    
})(window.GISApp, jQuery)