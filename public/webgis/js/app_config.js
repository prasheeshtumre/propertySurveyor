

(function (global, $) {

    "use strict";


    var obj = {
        appName: "",
        //geoserverURL: "//199.241.185.218:8080/geoserver",
        // geoserverURL: "//101.53.144.81:8080/geoserver",
        // geoserverURL: "//proper-t.co/geoserver",
        geoserverURL: "//konu.co.in/geoserver",
        urlGWC: "/gwc/service",
        urlWMS: "/wms",

        WMSService: "/wms",
        WMTSService: "/wmts?",

        appModes: ["Prod", "Dev"],
        appMode: 1,

        workspaceName: "suhsurvey",
        //defaultExtent: [8766632.845215818, 2081276.9040471965, 8779522.039110405, 2087439.6394526886],
        defaultExtent: [8745736.383507777, 1968230.0312960234, 8751999.895157477, 1973837.5467922268],
        dataProjection: 'EPSG:4326',
        dataProjectionValue: '4326',
        //defaultCenter: [8772852.908392515, 2084143.292607891],
        defaultCenter: [8698839.81288167, 1969895.75858627],
        resetCenter: [8730000, 1970000],
        resetZoom: 11,
        defaultZoom: 12,
        maxZoom: 25,
        minZoom: 4,
        mapProjection: "EPSG:900913",
        
        API_Google_Key: "AIzaSyAm9ekbF8SnmFeUH4BvEffHYu_TuUieoDw",
        API_Autocomplete_Url: "https://maps.googleapis.com/maps/api/place/autocomplete/json"
        
    }


    global.appConfig = obj;

})(window.GISApp, jQuery)