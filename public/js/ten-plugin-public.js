(function( $ ) {
	'use strict';


	// API Key - MjE1MDY5

	/**
	 * All of the code for your public-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */

	 // Changes XML to JSON
	 // Modified version from here: http://davidwalsh.name/convert-xml-json
	 function xmlToJson(xml) {

	   // Create the return object
	   var obj = {};

	   if (xml.nodeType == 1) { // element
	     // do attributes
	     if (xml.attributes.length > 0) {
	     obj["@attributes"] = {};
	       for (var j = 0; j < xml.attributes.length; j++) {
	         var attribute = xml.attributes.item(j);
	         obj["@attributes"][attribute.nodeName] = attribute.nodeValue;
	       }
	     }
	   } else if (xml.nodeType == 3) { // text
	     obj = xml.nodeValue;
	   }

	   // do children
	   // If just one text node inside
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

	 function apiCall() {
		//  var count = parseInt($('#Ten-Plugin').attr('data-count'));
		//  console.log(count);
		//  $.ajax({
		// 	 method: 'GET',
		// 	 url: 'http://thecatapi.com/api/images/get?api_key=MjE1MDY5&format=xml&results_per_page=' + count
		//  }).done(function (response){
		// 	 var catData = xmlToJson(response);
		 //
		// 	 for (var picture in catData.response.data.images.image) {
		// 			console.log(catData.response.data.images.image[picture].url);
		// 			$('#Ten-Plugin').append(
		// 				//background images to have all the images be the same size for formatting and styling purpose
		// 				'<figure id="' + catData.response.data.images.image[picture].id + '" class="ten-plugin--image--wrap" style="background-image: url(' + catData.response.data.images.image[picture].url + ');background-repeat:no-repeat;background-position: center center;background-size:cover;">' +
		// 				'</figure>'
		// 			);
		// 	 }
		//  });
	 }

	 function clickHandler(clickedElement) {
		 var count = parseInt($('#Ten-Plugin').attr('data-count'));
		 console.log(count);
		 $.ajax({
			 method: 'GET',
			 url: 'http://thecatapi.com/api/images/get?api_key=MjE1MDY5&format=xml&results_per_page=1'
		 }).done(function (response){
			 var catData = xmlToJson(response);
			 console.log(catData.response.data.images.image);
			 $(clickedElement).css('background-image', 'url(' + catData.response.data.images.image.url + ')');
		 });
	 }

	//  $(document).ready(apiCall);

	 $(document).on('click', '.ten-plugin--image--wrap', function () {
		 clickHandler(this);
		 console.log(this);
	 });


})( jQuery );
