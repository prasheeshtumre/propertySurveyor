(function (global, $, appData) {

    if (!$) {
        throw "jQuery plugin is not present";
    }

    if (!global) {
        throw "window object is not present";
    }
    if (!appData) {
    	throw "appData object is not present";
    }

    let base = {};
    
    function argumentsWithCallback(arguments, callback){
    	this.args = arguments || null;
    	this.callback = callback || null;
    }
    
    function processCallBack(o){
    	
    	if(o instanceof argumentsWithCallback){
    		
    		if(o.callback instanceof Function){
    			
    			o.callback.apply(null, o.args);
    		}
    		
    	}
    }
    
    base["argumentsWithCallback"] = argumentsWithCallback;
    base["processCallBack"] = processCallBack;

    base["log"] = function (str) {
        console.log(str);
    }

    base["elById"] = function (tagId) {
        if (!tagId) {
            throw "invalid tag";
        }
        return document.getElementById(tagId);
    }

    base["setTimeout"] = function(funcBody, timeout){
    	
    	timeout = timeout || 200;
    	
    	setTimeout(funcBody, timeout);
    	
    }

    base["showLoading"] = function () {
        $('#ajaxLoader').addClass('lodding-show');
    }

    base["hideLoading"] = function () {
        $('#ajaxLoader').removeClass('lodding-show');
    }

    base["wait"] = function (milliseconds, callback) {
        if (!base.timer) {
            $('#ajaxLoader').addClass('lodding-show');
            milliseconds = milliseconds || 1000; // default 1 second

            base.timer = setTimeout(() => {
                $('#ajaxLoader').removeClass('lodding-show');
                base.timer = null;

                if (typeof callback === "function") {
                    callback();
                }

            }, milliseconds);
        }
    }

    
    base["replaceAll"] = function (string, pattern, replacement) {
        return string.replace(new RegExp(pattern, "g"), replacement);
    }

    base["flattenArray"] = function (arr) {

        var that = this;

        return arr.reduce(function (flat, toFlatten) {
            return flat.concat(Array.isArray(toFlatten) ? that
                    .flattenArray(toFlatten) : toFlatten);
        }, []);
    }
    
    base["notify"] = function (style,title,text,image) {
        $.notify({
            title: title,//'Email Notification',
            text: text//'You received an e-mail from your boss. You should read it right now!',
            //image: image//"<img src='Mail.png'/>"
        }, {
            style: 'metro',
            className: style,
            autoHide: true,
            clickToHide: true
        });
    }
    

    base["removeItem"] = function (arr, item) {

        if (!item) {
            return arr.pop();
        } else {
            var index = arr.indexOf(item);
            if (index === -1) {
                return false;
            }

            arr.splice(index, 1);
            return item;
        }
    }
    
      
   base["addLoading"] = function (id){
	   
	   if($('#ajaxLoader').length){
		   
		   let div = document.createElement("div");
		   
		   div.id = id;
		   
		   div.className = $('#ajaxLoader').attr("class") + " lodding-show";
		   
		   div.innerHTML = $('#ajaxLoader')[0].innerHTML
		   
		   $('body').append(div);
		   
	   }
	   
   }
   
   base["removeLoading"] =  function (id){
	  
	   $('#'+ id).remove();
   }
   
    base["ajaxRequest"] = function (method, url, postData, successCallBack, failedCallback,
            dataType, contentType) {
 
        if (!url) {
            throw "invalid URL";
        }
        postData = postData || {};       
    	
        let loadingId = "ajaxLoader" + new Date().getTime();
        
        var errorCallback = function () {       	
        	
        	base.removeLoading(loadingId);
        };

        if (typeof failedCallback === "function") {
            errorCallback = function (xhr, status, error) {

            	base.removeLoading(loadingId);

                failedCallback(xhr, status, error);
            }
        }

        var obj = {
            beforeSend: function () {
            	base.addLoading(loadingId);
            },
            complete: function (data, textStatus, xhr) {
            	
            	base.removeLoading(loadingId);
                
                var statusCode = data.status;
                var statusText = data.statusText || "";
                 
                if(statusText.toLowerCase() === "unauthorized" || statusCode == "401"){
                	
                	$u.notify('error','Notification','Your session has expired!!!\nPlease login again to continue.','');
                	
                	if(typeof parent === "object"){
                		//parent.location.reload();
                	} else{
                		//location.reload();
                	}               	
                } else if(statusText.toLowerCase() === "forbidden" || statusCode == "403"){
                	
                	
                	//alert("You are not authorized to access this area.\nPlease Contact System Administrator");
                	$u.notify('error','Notification','You are not authorized to access this area.\nPlease Contact System Administrator.','');
                	if(typeof parent === "object"){
                		//parent.location.reload();
                	} else{
                		//location.reload();
                	} 
                }
                
            },
            error: errorCallback
        };

        obj.url = url;
        obj.method = method || "POST";
        obj.data = postData || "{}";

        // obj.contentType = contentType || "application/x-www-form-urlencoded";

        if (contentType) {
            obj.contentType = contentType;
        }

        if (dataType) {
            obj.dataType = dataType;
        }

        obj.success = successCallBack || function (result) {
            alert("successfull");
            console.log(result);
        }

        return $.ajax(obj);
    }

    global["utility"] = global["$u"] = base;
})(window, jQuery,window.GISApp.appConfig);;