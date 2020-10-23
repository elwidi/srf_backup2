
<html>
  <head><title>OpenLayers Marker Popups</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  </head>
  <body>
  <!-- <button id = "button_saja">Try It</button> -->
  <div id="mapdiv"></div>
  <input type="hidden" id = "book_olt">
  <?php 

    $json = file_get_contents('http://presales.apps.moratelindo.co.id/index.php/action/fat_info');

    $e = json_decode($json, true);
    $e = $e['data'];

    // $url = 'http://api-cm.apps.moratelindo.co.id/index.php/API/LatLong/postAndFind';

    // $options = array(
    //     'http' => array(
    //         'header' => "Contents-Type: application/x-www-form-urlencoded\r\n".
    //                 "Auth:Basic QTpC\r\n".
    //                 "grants-type:client_credentials\r\n",
    //         'method'  => 'POST',
    //         'content' => array()
    //     )
    // );
    // $context  = stream_context_create($options);
    // $result = file_get_contents($url, false, $context);
    // if ($result === FALSE) { /* Handle error */ }

    // $e = json_decode($result, true);
  ?>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/openlayers/2.11/lib/OpenLayers.js"></script> 
  <script>
    // var x = document.getElementById("demo");

    // function getLocation() {
    //   if (navigator.geolocation) {
    //     navigator.geolocation.getCurrentPosition(showPosition);
    //   } else { 
    //     x.innerHTML = "Geolocation is not supported by this browser.";
    //   }
    // }

    // function showPosition(position) {
    //   console.log('test');
    //   console.log(position.coords.latitude);
    //   console.log(position.coords.longitude);
    //   /*x.innerHTML = "Latitude: " + position.coords.latitude + 
    //   "<br>Longitude: " + position.coords.longitude;*/
    // }

    map = new OpenLayers.Map("mapdiv");
    map.addLayer(new OpenLayers.Layer.OSM());
    
    epsg4326 =  new OpenLayers.Projection("EPSG:4326"); //WGS 1984 projection
    projectTo = map.getProjectionObject(); //The map projection (Spherical Mercator)
   
    var lonLat = new OpenLayers.LonLat( 106.8452271,-6.2030882).transform(epsg4326, projectTo);
          
    
    var zoom=17;
    map.setCenter (lonLat, zoom);

    var vectorLayer = new OpenLayers.Layer.Vector("Overlay");
    
    // Define markers as "features" of the vector layer:
    <?php foreach($e as $k => $v){
      if($v['LATITUDE'] != '' && $v['LONGITUDE'] != '' && $v['LATITUDE'] != '#N/A' && $v['LONGITUDE'] != '#N/A' && substr($v['LONGITUDE'], 0, 3) != 'JKT') {
        $v['LATITUDE'] = str_replace(",", ".", $v['LATITUDE']);
        $v['LATITUDE'] = str_replace("?", "", $v['LATITUDE']);
        $v['LONGITUDE'] = str_replace(",", ".", $v['LONGITUDE']);
        $v['LONGITUDE'] = str_replace("?", "", $v['LONGITUDE']);
        $v['LATITUDE'] = str_replace(" ", "", $v['LATITUDE']);
        $v['LONGITUDE'] = str_replace(" ", "", $v['LONGITUDE']);
        $v['LATITUDE'] = str_replace('"', "", $v['LATITUDE']);
        $v['LONGITUDE'] = str_replace('"', "", $v['LONGITUDE']);
        $v['LATITUDE'] = str_replace('E', "", $v['LATITUDE']);
        $v['LONGITUDE'] = str_replace('E', "", $v['LONGITUDE']);
        $v['LATITUDE'] = str_replace('S', "", $v['LATITUDE']);
        $v['LONGITUDE'] = str_replace('S', "", $v['LONGITUDE']);

        if(substr($v['LONGITUDE'], -1) == ".") $v['LONGITUDE'] = substr($v['LONGITUDE'], 0, -1);
        if(substr($v['LATITUDE'], -1) == ".") $v['LATITUDE'] = substr($v['LATITUDE'], 0, -1);

        $v['LATITUDE'] = str_replace("=", "", $v['LATITUDE']);
        $v['LONGITUDE'] = str_replace("=", ".", $v['LONGITUDE']);

        if($v['PORT_AVAILABLE'] <= 32){
          $marker = '/assets/marker_'.$v['PORT_AVAILABLE'].'.png';
        } else {
          $marker = '/assets/marker.png';
        }
    ?>
    var feature = new OpenLayers.Feature.Vector(
            new OpenLayers.Geometry.Point( <?php echo $v['LONGITUDE']?>,<?php echo $v['LATITUDE']?>).transform(epsg4326, projectTo),
            {description:'<?php echo $v['CLUSTER_NAME'] ."<br/>". $v['FAT_CODE']?><br/><?php echo $v['LATITUDE'] .", ". $v['LONGITUDE']?><br/>Port Available: <?php echo $v['PORT_AVAILABLE']?><br/><br/><button id = "IDM<?php echo $k?>" class = "booked" long = "<?php echo $v['LONGITUDE']?>" lat = "<?php echo $v['LATITUDE']?>" fat_name = "<?php echo $v['FAT_CODE']?>" onclick = "LongLat(this);">Book</button>'} ,
            {externalGraphic: '<?php echo $marker; ?>', graphicHeight: 35, graphicWidth: 35, graphicXOffset:-12, graphicYOffset:-25  }
        );    
    vectorLayer.addFeatures(feature);
    <?php } } ?>
   
    map.addLayer(vectorLayer);
 
    
    //Add a selector control to the vectorLayer with popup functions
    var controls = {
      selector: new OpenLayers.Control.SelectFeature(vectorLayer, { onSelect: createPopup, onUnselect: destroyPopup })
    };

    function createPopup(feature) {
      feature.popup = new OpenLayers.Popup.FramedCloud("pop",
          feature.geometry.getBounds().getCenterLonLat(),
          null,
          '<div class="markerContent">'+feature.attributes.description+'</div>',
          null,
          true,
          function() { controls['selector'].unselectAll(); }
      );
      //feature.popup.closeOnMove = true;
      map.addPopup(feature.popup);
    }

    function destroyPopup(feature) {
      feature.popup.destroy();
      feature.popup = null;
    }
    
    map.addControl(controls['selector']);
    controls['selector'].activate();

    
    function LongLat(e){

      var long = e.getAttribute("long"),
          lat = e.getAttribute("lat"),
          n = e.getAttribute("fat_name");

      var z = $(parent.document).find('#fe_fat_name');
      var a = $(parent.document).find('#fe_longitude');
      var b = $(parent.document).find('#fe_latitude');
      z.val(n);
      a.val(long);
      b.val(lat);

      $('#book_olt').val(long).trigger('change');

    }

    $('#book_olt').change(function(){
          alert('BOOKED');
          window.parent.closeModal();
    })


      
  </script>
  <div id="explanation">Popup bubbles appearing when you click a marker. The marker content is set within a feature attribute</div>
    }
    }
</body></html>
