(function (global, $) {

    if (!global) {
        throw "App is not initialized";
    }
    if (!$) {
        throw "jQuery is not available";
    }


    var base = {};

    var infoInstance = null;

    var InformationControl = function (opt_options) {

        const this_ = this;
        const options = opt_options || {};

        const button = document.createElement('button');
        button.innerHTML = '<i class="fa fa-info-circle"></i>';

        this.isActive = function () {
            return $(element).hasClass("ol-active");
        }
        this.setActive = function (active) {

            active = !!active;
            if (active) {

                if (!$(element).hasClass("ol-active")) {

                    $(element).addClass("ol-active");
                    if (this_.getMap()) {
                        base.activateInfoOnClickForVector(false);
                        this_.getMap().on('singleclick', getWMSFeatureInfoFromGeoserver);
                    }
                }
            } else {

                $(element).removeClass("ol-active");

                if (this_.getMap()) {
                    this_.getMap().un('singleclick', getWMSFeatureInfoFromGeoserver);
                }
            }
        }


        const clickHandler = function () {
            $(element).toggleClass("ol-active");

            /*if (typeof options.clickHandler === "function") {
             options.clickHandler.apply(this_, this.arguments);
             }*/

            if ($(element).hasClass("ol-active")) {
                this_.getMap().on('singleclick', getWMSFeatureInfoFromGeoserver);
            } else {
                this_.getMap().un('singleclick', getWMSFeatureInfoFromGeoserver);
            }

            this_.getMap().getView().setRotation(0);
        };

        button.addEventListener('click', clickHandler, false);
        button.addEventListener('touchstart', clickHandler, false);

        const element = document.createElement('div');
        element.className = 'rotate-north ol-unselectable ol-control';
        element.appendChild(button);

        ol.control.Control.call(this, {
            element: element,
            target: options.target,
            //active: true
        });

    };
    ol.inherits(InformationControl, ol.control.Control);


    base.InformationControl = InformationControl;

    base.getInstance = function (options) {
        if (!infoInstance) {
            infoInstance = new InformationControl(options);
        }
        return infoInstance;
    }

    base.activateInfoOnClickForVector = function (activate) {

        activate = !!activate;

        if (activate) {
            //disable wmsGetFeatureInfo 
            base.getInstance().setActive(false);

            global.mapController.map.on('singleclick', getVectorFeatureInfo);
        } else {

            global.mapController.map.un('singleclick', getVectorFeatureInfo);
        }

    }
    
    
    
    //New code
    
    
    ///end new code
    
       

    const dialogID = "#popupModal";
    const dialogContentID = "#popupModalContent";
    function showDialog(content) {

        content = !content ? "Sorry, No information!" : content;

        $(popupModalContent).html(content);

        $(dialogID).modal("show");

    }

    function hideDialog() {

        $(dialogID).modal("hide");
    }

    var getVectorFeatureInfo = function (evt) {

        const feature = global.mapController.map.forEachFeatureAtPixel(evt.pixel, function (feature) {
            return feature;
        },
                {
                    layerFilter: function (l) {
                        return l === global.mapController.resultVectorLayer;
                    }
                });

        if (!feature) {
            return global.popupController.hidePopup();
        }

        var attr = feature.getProperties();

        /*var str = "";
         for (var k in attr) {
         
         if (attr[k] instanceof ol.geom.Geometry || k === "geom"|| k === "property_id")
         continue;
         
         str += "<b>" + k + "</b>" + " : " + attr[k] + ""
         //str += attr[k]
         }*/
            //alert(attr);
        var str = "<table border='1' class='table'>";
        for (var k in attr) {

            if (attr[k] instanceof ol.geom.Geometry || k === "geom" || k === "property_id")
                continue;

            str += "<tr><td>" + k + "</td>" + " <td> " + attr[k] + "</td></tr>"

        }
        str += "</table>"




        //global.popupController.showPopup(evt.coordinate, str);
        showDialog(str);
    }

    var fill = new ol.style.Fill({
        color: [255, 0, 0, 0.8]
    });
    var stroke = new ol.style.Stroke({
        color: 'black',
        width: 1.5
    });
    var square = new ol.style.RegularShape({
        fill: fill,
        stroke: stroke,
        points: 4,
        radius: 10,
        angle: Math.PI / 4
    });
    var star = new ol.style.RegularShape({
        fill: fill,
        stroke: stroke,
        points: 5,
        radius: 15,
        radius2: 4,
        angle: 0
    });

    var point_style = new ol.style.Style({
        image: square,
        fill: fill,
        stroke: stroke
    })

    var getWMSFeatureInfoFromGeoserver = function (evt) {

        var coor = evt.coordinate;
        if (!global.layerController.layers["municipalservce:yadadri_choutuppal_kaitapur"]) {
            return global.popupController.hidePopup();
        }

        const viewResolution = (global.mapController.view.getResolution());
		
		
		if(!global.layerController.layers["municipalservce:yadadri_choutuppal_kaitapur"] || !global.layerController.layers["municipalservce:yadadri_choutuppal_kaitapur"].getVisible()) {
			return;
		}
		
        const url = global.layerController.layers["municipalservce:yadadri_choutuppal_kaitapur"].getSource().getGetFeatureInfoUrl(
                evt.coordinate, viewResolution, global.appConfig.mapProjection,
                {'INFO_FORMAT': 'application/json', 'FEATURE_COUNT': 1 });

        //let loadingId = "ajaxLoader" + new Date().getTime();
        let loadingId = "ajaxLoader" + new Date().getTime();
        //alert(loadingId);
        if (url) {
            $.ajax({
                type: 'GET',
                url: url,
                beforeSend: function () {
                    $u.addLoading(loadingId);
                },
                success: function (response) {
                    
                    const allFeatures = new ol.format.GeoJSON().readFeatures(response);
                    if (allFeatures instanceof Array && allFeatures.length > 0) {
						
						var data = allFeatures[0].getProperties();
						
                                                
                        if(!data /*|| !data.show_on_map*/) {
                            /*
                             * for handling the not highlighted features
                             * @type type
                             */
                           $u.removeLoading(loadingId);
						   
						   return; 
                        }
                        
                        //alert(allFeatures[0]);
                        var id=data['newids'];
						
						
						if(id === undefined || id === null) {
							$u.removeLoading(loadingId);
							
							return;
						}
						                      
                        
                        $.post("./php/test2.php",{id:id},function(data1){
                           // alert(data1);
						   $u.removeLoading(loadingId);
						   if(data1) {
							global.popupController.showPopup(coor, data1);
						   }
                        }).fail(function() {
							$u.removeLoading(loadingId);
						  });
                        /*$.ajax({
                            type: 'POST',
                            url: "./php/test.php",
                            data: id:id,
                            success: function(result){
                               // $("#div1").html(result);
                               //alert(result);
                               
                            }});*/
                        //main table which is showing
                        
                        
                        var str = "<table border='1' class='table'>";
                        for (var k in data) 
                        {
                            //alert(k);
                          if (data[k] instanceof ol.geom.Geometry || k === "geom")
                                continue;
                            str += "<tr><td>" + k + "</td>" + " <td> " + data[k] + "</td></tr>";

                        }
                        
                        
                        str += "</table>"
                            
                            
                         
                        //
                        //showDialog(str);
                        
                        /*
                         * the `data` contain the unique_id, extract and use it in your API
                         */

                    } else {
                        $u.removeLoading(loadingId);
                        global.popupController.hidePopup();
                        hideDialog();
                    }

                },
                error: function () {
                    $u.removeLoading(loadingId);
                    var n = noty({
                        text: 'Error warning!',
                        type: 'error',
                        animation: {
                            open: {height: 'toggle'},
                            close: {height: 'toggle'},
                            easing: 'swing',
                            speed: 2000 // opening & closing animation speed
                        }
                    });
                    n.close();
                }
            });
        }
    }

    function getInfoFromAPI(data) {

        var url = "./php/getInfoPoint.php";

         
        let loadingId = "ajaxLoader" + new Date().getTime();
        //global.sourceGeomBuilding.clear();
      //alert(loadingId);
        $.ajax({
            type: 'GET',
            url: url,
            data: data,
            beforeSend: function () {

                $u.addLoading(loadingId);
            },
            success: function (response) {
                
                //alert(response);
                $u.removeLoading(loadingId);

                  //alert(response);
                if (response) {
                    if (response.message instanceof Array && response.message.length) {
                        var data = response.message[0];

                        var str = "";
                        
                        var str = "<table border='0' class='table'>";
                        for (var k in data) {

                            if (k === "geom" || k === "property_id")
                                continue;

                            str += "<tr><td>" + k + "</td>" + " <td> " + data[k] + "</td></tr>"

                        }
                        str += "</table>"
                        /*var wkt = data.geom;
                        var format = new ol.format.WKT();

                        var feature = format.readFeature(wkt, {
                            dataProjection: global.appConfig.dataProjection,
                            featureProjection: global.appConfig.mapProjection
                        });
                        feature.setStyle(point_style);*/

                        //global.sourceGeomBuilding.addFeature(feature);

                        //global.popupController.showPopup(coor, str);
                        showDialog(str);
                    } else {

                        //global.popupController.hidePopup();
                        hideDialog();
                    }


                } else {
                    global.popupController.hidePopup();
                }

            },
            error: function (response) {
                $u.removeLoading(loadingId);
                var n = noty({
                    text: 'Error warning!',
                    type: 'error',
                    animation: {
                        open: {height: 'toggle'},
                        close: {height: 'toggle'},
                        easing: 'swing',
                        speed: 2000 // opening & closing animation speed
                    }
                });
                n.close();
            }
        });
    }
    
    
    
    
    
    
    
    

    /*var getWMSFeatureInfoFromAPI = function (evt) {

        var coor = evt.coordinate;

        var lonlat = ol.proj.transform(evt.coordinate, global.appConfig.mapProjection,
                global.appConfig.dataProjection);

        var data = {
            lat: lonlat[1],
            long: lonlat[0]
        };
        getInfoFromAPI(data);

    }*/


    global.infoOnClick = base;

})(window.GISApp, jQuery)


;