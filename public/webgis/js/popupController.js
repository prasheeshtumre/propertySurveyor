(function (global, $) {

    if (!global) {
        throw "App is not initialized";
    }
    if (!$) {
        throw "jQuery is not available";
    }

    var obj = {};

    var overlay;

    obj.initPopup = function (map) {

        /**
         * Elements that make up the popup.
         */
        var container = document.getElementById('popup');

        var closer = document.getElementById('popup-closer');


        /**
         * Create an overlay to anchor the popup to the map.
         */
        overlay = new ol.Overlay({
            element: container,
            autoPan: true,
            autoPanAnimation: {
                duration: 250
            }
        });


        /**
         * Add a click handler to hide the popup.
         * @return {boolean} Don't follow the href.
         */
        closer.onclick = function () {
            overlay.setPosition(undefined);
            closer.blur();
            return false;
        };

        map.addOverlay(overlay);

    }

    obj.showPopup = function (coordinate, data) {
        // var url = "https://webgis.proper-t.co/php/get_popup_info.php";
        var url = apiUrl+"/surveyor/webgis/get-popup-controller";
        var content = document.getElementById('popup-content');
        var  csrfToken = $('#csrf-token').attr('content'); 
        let latLongs = ol.proj.transform(coordinate, 'EPSG:3857','EPSG:4326');

        var apiKey = 'YOUR_API_KEY';

        // Make a reverse geocoding request to obtain postal code
        $.get('https://maps.googleapis.com/maps/api/geocode/json', {
            latlng: latLongs[1] + ',' + latLongs[0],
            key: apiKey
        });
        
        $.post(url,{"_token":csrfToken,gis_id:data, coordinate: coordinate, latLongs: latLongs},function(popup_data){
            content.innerHTML = '<p>' + popup_data + '</p>';
            overlay.setPosition(coordinate);
            
        });

        
    }

    obj.hidePopup = function () {
        overlay.setPosition(undefined);
    }

    global.popupController = obj;

})(window.GISApp, jQuery);