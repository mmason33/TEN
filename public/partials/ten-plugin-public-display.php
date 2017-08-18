<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       https://mmason33.github.io
 * @since      1.0.0
 *
 * @package    Ten_Plugin
 * @subpackage Ten_Plugin/public/partials
 */
?>

<section id="Ten-Plugin" class="ten-plugin" data-count="<?php echo get_option('ten_plugin_count'); ?>">
  <script>

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

    var count = parseInt($('#Ten-Plugin').attr('data-count'));
    console.log(count);
    $.ajax({
      method: 'GET',
      url: 'http://thecatapi.com/api/images/get?api_key=MjE1MDY5&format=xml&results_per_page=3'
    }).done(function (response){
      var catData = xmlToJson(response);
      console.log(catData.response.data.images.image);

      for (var image in catData.response.data.images.image) {
        console.log(catData.response.data.images.image[image].url);
      }
    });
  </script>
</section>
