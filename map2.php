
<html>
  <head><title>OpenLayers Marker Popups</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.4.0/dist/leaflet.css"
     integrity="sha512-puBpdR0798OZvTTbP4A8Ix/l+A4dHDD0DGqYW6RQ+9jxkRFclaxxQb/SJAWZfWAkuyeQUytO7+7N4QKrDh+drA=="
     crossorigin="">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <script src="https://unpkg.com/leaflet@1.4.0/dist/leaflet.js"
     integrity="sha512-QVftwZFqvtRNi0ZyCtsznlKSWOStnDORoefr1enyq5mVL4tmKB3S/EnC3rRJcxCPavG10IcrVGSmPh6Qw5lwrg=="
     crossorigin=""></script>
     <style>
      body {
        margin: 0;
      }
      div#map {
        width: 100%;
        height: 650px;
      }
      div#search {
        background-color: white;
        position: absolute;
        bottom: 40px;
        left: 40px; 
        width: auto;
        height: auto;
        padding: 10px;
      }
      div#search input {
        width: 300px;
      }
      div#results {
        font-style: sans-serif;
        color: black;
        font-size: 75%;
      }
      </style>
  </head>
  <body>
    <!-- <div class="row">< -->
  
  <br/>
  <div class="row">
    <div class="col-md-3">
      <label style="margin: 10px;">Search By : </label><br/>
      <input type="radio" name="search_type" id="cluster" style="margin: 10px;" value = "cluster" /><label for = "cluster">Cluster</label><br/>
      <input type="radio" name="search_type" id="address" style="margin: 10px;" value = "address" /><label for = "address">Address</label><br/>

      <input type="text" name="addr" value="" id="addr" size="30" style="margin: 10px;" />
      <button type="button" onclick="addr_search();" style="margin: 10px;">Search</button>
      <br>
      <div class = "results"></div>
    </div>
    <div class="col-md-9">
        <div id="map" style=""></div>
    </div>
  </div>
  
  <script>

    var map = L.map('map').setView([-6.2030882, 106.8452271], 17);

    var marker = {};
    var loc_marker = {};

    L.tileLayer('http://tile.openstreetmap.org/{z}/{x}/{y}.png', {
       maxZoom: 18
    }).addTo(map);

    var greenIcon = L.icon({
        iconUrl: 'assets/marker_2.png',
        iconSize:     [38, 38], // size of the icon
        iconAnchor:   [22, 22], // point of the icon which will correspond to marker's location
        popupAnchor:  [-3, -15] // point from which the popup should open relative to the iconAnchor
    });

    var marker = L.marker([-6.257302, 106.833988], {icon: greenIcon}).addTo(map);

    var popup = marker.bindPopup('<b>Hello world!</b><br />I am a popup.');

    
    map.setView([-6.2030882, 106.8452271], 17);

    function LongLat(e){
      var long = e.getAttribute('long'),
          lat = e.getAttribute('lat'),
          fat_code = e.getAttribute('fat_code');

      var c = $(parent.document).find('#mindex_acc');

      console.log(c.val());

      var g = '#fe_fat_name'+c.val();
      var h = '#fe_longitude'+c.val();
      var i = '#fe_latitude'+c.val();

      var y = $(parent.document).find(g);
      var z = $(parent.document).find(h);
      var x = $(parent.document).find(i);

      y.val(fat_code);
      z.val(long);
      x.val(lat);

      alert('FAT '+fat_code+' BOOKED');
    }

    function addr_search(){
      var key = $('#addr').val();
      var search_type = $('input[name="search_type"]:checked').val();

      // console.log(search_type);

      if(search_type == 'address'){
        $.ajax({
          type:"GET",
          url:"https://nominatim.openstreetmap.org/search?format=json&q="+key+"&country=Indonesia",
          dataType: 'json',
          success: function (data) {
              if(data.length > 0){
                  var d = "";
                  $.each(data, function(i, e){
                    d += '<button class = "card map-point" style="margin: 10px;" coords="'+e.lat+', '+e.lon+'">'+e.display_name+'</button>';
                  })

                  $(".results").append(d);

              }

              $('.map-point').click(function(e){
                var addr = $(this).attr('coords');
                showRadius(addr);
              })
          }
        });
      } else {
        //http://presales.apps.moratelindo.co.id/index.php/action/xxyy/grand dhika/1
          $.ajax({
            type:"GET",
            url:"http://sf.apps.moratelindo.co.id/customer/cluster_search/"+key,
            dataType: 'json',
            success: function (data) {
                if(data.data.length > 0){
                    var d = "";
                    $.each(data.data, function(i, e){
                      console.log(e[0]);
                      d += '<button class = "card map-point" style="margin: 10px;" coords="'+e[0].LATITUDE+', '+e[0].LONGITUDE+'">'+e[0].CLUSTER_NAME+'</button>';
                    })

                    $(".results").append(d);
                }

                $('.map-point').click(function(e){
                  var addr = $(this).attr('coords');
                  console.log(addr);
                  if(addr == "null, null"){
                    alert('Coordinat Not Found');
                  }
                  showRadius(addr);
                })
            }
        })
      }
      $('.map-point').remove();

      function showRadius(addr){
          var location = new L.circle();
          map.removeLayer(location);

          var coords = addr.split(',');

          if (marker != undefined) {
                map.removeLayer(marker);
          };


          if (loc_marker != undefined) {
                map.removeLayer(loc_marker);
          };

          var marker_atm = L.icon({
              iconUrl: 'assets/marker.png',
              iconSize:     [20, 30], // size of the icon
              iconAnchor:   [22, 22], // point of the icon which will correspond to marker's location
              popupAnchor:  [-3, -15] // point from which the popup should open relative to the iconAnchor
          });

          var fff = L.marker([coords[0], coords[1]], {icon: marker_atm}).addTo(map);

          loc_marker = fff;

          var circle = L.circle([coords[0], coords[1]], 300, {
              color: '#00ACC1',
              fillColor: '#80DEEA',
              fillOpacity: 0.3
          }).addTo(map);

          var boundaries = circle.getBounds();
          console.log(boundaries);
          var sw = boundaries.getSouthWest().wrap();
          var ne = boundaries.getNorthEast().wrap();

          var url = "http://sf.apps.moratelindo.co.id/customer/bounds";

          $.ajax({
            type:"POST",
            url: url,
            data:{minlat: ne.lat, maxlat: sw.lat, minlong: sw.lng, maxlong: ne.lng},
            dataType: 'json',
            success: function (data) {
              if(data.status == 200){
                $.each(data.data, function(i, e){
                  console.log(e);
                  var icon_url = 'assets/marker_'+e.PORT_AVAILABLE+'.png';
                  var greenIcon = L.icon({
                      iconUrl: icon_url,
                      iconSize:     [38, 38], // size of the icon
                      iconAnchor:   [22, 22], // point of the icon which will correspond to marker's location
                      popupAnchor:  [-3, -15] // point from which the popup should open relative to the iconAnchor
                  });

                  var markerd = L.marker([e.LATITUDE, e.LONGITUDE], {icon: greenIcon}).addTo(map);

                  var popup = markerd.bindPopup('<b>'+e.FAT_CODE+'</b><br /> Cluster : '+e.CLUSTER_NAME+'<br /> '+e.LATITUDE+', '+e.LONGITUDE+'<br/><button fat_code = "'+e.FAT_CODE+'" lat = "'+e.LATITUDE+'" long = "'+e.LONGITUDE+'" onclick = "LongLat(this);">Book</button>');
                })
              }

            }
          });

          marker = circle;

          map.setView([coords[0], coords[1]], 17);
      }
    }
  </script>
</body></html>
