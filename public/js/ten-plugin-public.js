/**
 * All of the code for your public-facing JavaScript source
 */

(function( $ ) {
	'use strict';

	/**
	* @function xmlToJson A function to convert an XML response to an object
	* @param xml The XML response to be converted into an object
	*/
	function xmlToJson(xml) {
		var obj = {};
		if (xml.nodeType == 1) {
			if (xml.attributes.length > 0) {
				obj["@attributes"] = {};
				for (var j = 0; j < xml.attributes.length; j++) {
					var attribute = xml.attributes.item(j);
					obj["@attributes"][attribute.nodeName] = attribute.nodeValue;
				}
			}
		} else if (xml.nodeType == 3) {
			obj = xml.nodeValue;
		}

		if (xml.hasChildNodes() && xml.childNodes.length === 1 && xml.childNodes[0].nodeType === 3) {
			obj = xml.childNodes[0].nodeValue;
		}
		else if (xml.hasChildNodes()) {
			for(var i = 0; i < xml.childNodes.length; i++) {
				var item = xml.childNodes.item(i);
				var nodeName = item.nodeName;
				if (typeof(obj[nodeName]) == "undefined") {
					obj[nodeName] = xmlToJson(item);
				} else {
					if (typeof(obj[nodeName].push) == "undefined") {
						 var old = obj[nodeName];
						 obj[nodeName] = [];
						 obj[nodeName].push(old);
					}
					obj[nodeName].push(xmlToJson(item));
				}
			}
		}
		return obj;
	}
	/**
	* @function clickHandler A function to handle the click event of the returned API image
	* @param clickedElement The elment that the click event occured
	*/
	function clickHandler(clickedElement) {
	 var count = parseInt($('#Ten-Plugin').attr('data-count'));
	 console.log(count);
	 $.ajax({
		 method: 'GET',
		 url: '/wp-content/plugins/ten-plugin/public/partials/ten-plugin-ajax.php'
	 }).done(function (response){
		 var catData = xmlToJson(response);
		 $(clickedElement).css('background-image', 'url(' + catData.response.data.images.image.url + ')');
	 });
	}

	$(document).on('click', '.ten-plugin--image--wrap', function () {
	 clickHandler(this);
	});

})( jQuery );
