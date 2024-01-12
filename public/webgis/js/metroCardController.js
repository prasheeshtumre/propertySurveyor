(function (global, $) {

    if (!global) {
        throw "App is not initialized";
    }
    if (!$) {
        throw "jQuery is not available";
    }

    var obj = {};

    var overlay;

    obj.initCard = function (map, name, coordinate) {
        var modifiedName = name?.replace(/\s+/g, '-');
        // Card Container
        var metroCard = $('<div>').attr({
            'id': `metro-card-${modifiedName}`,
            'class': 'metro-card-container ol-popup animate__animated animate__flipInX'
        });
        // Card Content
        var metroCardContent = $('<div>').attr({
            'id': `metro-card-content-${modifiedName}`,
            'class': 'metro-card-content'
        });
        metroCardContent.text(name);
        // Card Close
        // <a href="#" id="metro-card-closer" class="ol-popup-closer">
        //     <i class="fa-solid fa-circle-xmark clo_btn"></i>
        // </a>
        var metroCardCloser = $('<a>').attr({
            'href': '#',
            'id': `metro-card-closer-${modifiedName}`,
            'class': 'ol-popup-closer'
        });
        var closerIcon = $('<div>').addClass('metro-clo-btn');
        closerIcon.text("x")
        metroCardCloser.append(closerIcon); 
        
        
        metroCard.append(metroCardCloser, metroCardContent);
        $('body').append(metroCard);
        
        var container = document.getElementById(`metro-card-${modifiedName}`);
        var overlay = new ol.Overlay({
            element: container,
            autoPan: true,
            autoPanAnimation: {
                duration: 250
            }
        });
        overlay.setPosition(coordinate);
        
        setTimeout(() => {
            var closer = document.getElementById(`metro-card-closer-${modifiedName}`);
            if (closer && closer !== null) {
                closer.onclick = function () {
                    overlay.setPosition(undefined);
                    closer.blur();
                    return false;
                };
            }
        }, 300)
        
        
        map.addOverlay(overlay);
    }
    
    obj.removeCard = function (name) {
        var modifiedName = name?.replace(/\s+/g, '-');
        $(`#metro-card-${modifiedName}`).remove();
    }

    obj.showCard = function (coordinate, data) {
        var url = apiUrl+"/surveyor/webgis/get-metro-card-controller";
        var content = document.getElementById('metro-card-content');
        var csrfToken = $('#csrf-token').attr('content'); 
        
        $.post(url,{"_token":csrfToken,metro_name:data, coordinate: coordinate},function(metro_data){
            content.innerHTML = '<p>' + metro_data + '</p>';
            overlay.setPosition(coordinate);
            
        });

        
    }

    obj.hideCard = function () {
        overlay.setPosition(undefined);
    }

    global.metroCard = obj;

})(window.GISApp, jQuery);