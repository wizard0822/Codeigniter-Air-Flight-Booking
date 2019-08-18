<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
        <meta charset="UTF-8">
        <title>Drawing Tools</title>
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script type="text/javascript"
        src="http://maps.google.com/maps/api/js?key=AIzaSyDmu1Ie1Au-kvOJI64QEuvonXWjkkdX9Uc&v=3.exp&sensor=false&libraries=drawing"></script>
        <style type="text/css">
            #map, html, body {
                padding: 0;
                margin: 0;
                width: 960px;
                height: 700px;
            }
            #panel {
                width: 200px;
                font-family: Arial, sans-serif;
                font-size: 13px;
                float: right;
                margin: 10px;
            }
            #color-palette {
                clear: both;
            }
            .color-button {
                width: 14px;
                height: 14px;
                font-size: 0;
                margin: 2px;
                float: left;
                cursor: pointer;
            }
            #delete-button {
                margin-top: 5px;
            }
        </style>
        <script type="text/javascript">
            var drawingManager;
            var selectedShape;
            var colors = ['#1E90FF', '#FF1493', '#32CD32', '#FF8C00', '#4B0082'];
            var selectedColor;
            var colorButtons = {};
            var saved_shape_list;
            var no_marker_for_default;
            var latLngArr = [];
            var polygonArr = [];
            var polygonPathArr = [];
            var shapeList=new Array();
            function clearSelection () {
                if (selectedShape) {
                    if (selectedShape.type !== 'marker') {
                        selectedShape.setEditable(false);
                    }
                    
                    selectedShape = null;
                }
            }
            function setSelection (shape) {
                if (shape.type !== 'marker') {
                    clearSelection();
                    shape.setEditable(true);
                    selectColor(shape.get('fillColor') || shape.get('strokeColor'));
                }
                
                selectedShape = shape;
            }
            function deleteSelectedShape () {
                if (selectedShape) {
                    selectedShape.setMap(null);
                }
            }
            function selectColor (color) {
                selectedColor = color;
                for (var i = 0; i < colors.length; ++i) {
                    var currColor = colors[i];
                    colorButtons[currColor].style.border = currColor == color ? '2px solid #789' : '2px solid #fff';
                }
                // Retrieves the current options from the drawing manager and replaces the
                // stroke or fill color as appropriate.
                var polylineOptions = drawingManager.get('polylineOptions');
                polylineOptions.strokeColor = color;
                drawingManager.set('polylineOptions', polylineOptions);
                var rectangleOptions = drawingManager.get('rectangleOptions');
                rectangleOptions.fillColor = color;
                drawingManager.set('rectangleOptions', rectangleOptions);
                var circleOptions = drawingManager.get('circleOptions');
                circleOptions.fillColor = color;
                drawingManager.set('circleOptions', circleOptions);
                var polygonOptions = drawingManager.get('polygonOptions');
                polygonOptions.fillColor = color;
                drawingManager.set('polygonOptions', polygonOptions);
            }
            function setSelectedShapeColor (color) {
                if (selectedShape) {
                    if (selectedShape.type == google.maps.drawing.OverlayType.POLYLINE) {
                        selectedShape.set('strokeColor', color);
                    } else {
                        selectedShape.set('fillColor', color);
                    }
                }
            }
            function makeColorButton (color) {
                var button = document.createElement('span');
                button.className = 'color-button';
                button.style.backgroundColor = color;
                google.maps.event.addDomListener(button, 'click', function () {
                    selectColor(color);
                    setSelectedShapeColor(color);
                });
                return button;
            }
            function buildColorPalette () {
                var colorPalette = document.getElementById('color-palette');
                for (var i = 0; i < colors.length; ++i) {
                    var currColor = colors[i];
                    var colorButton = makeColorButton(currColor);
                    colorPalette.appendChild(colorButton);
                    colorButtons[currColor] = colorButton;
                }
                selectColor(colors[0]);
            }
            function initialize () {

                var catch_center_poistion;
                var catch_zoom_level                = "<?php echo($catch_zoom_level?$catch_zoom_level:'0'); ?>";
                var lat;
                var lng;
                var zoom = 10;
                 <?php   if( $catch_center_poistion != '' ){?>
                    catch_center_poistion = "<?php echo $catch_center_poistion  ;?>";
                    tem                   = catch_center_poistion.split(",");
                    tem1                  = tem[0].split("(");
                    tem2                  = tem[1].split(")");
                    lat                   = tem1[1];
                    lng                   = tem2[0];
                    zoom                  = "<?php echo $catch_zoom_level  ;?>";    
                    zoom                  = parseInt(zoom);
                     $('body,html').animate({scrollTop: 0}, 800);
                 <?php } else{ ?>
                            lat = "<?php echo $LAT ?>";
                            lng = "<?php echo $LNG ?>";
                 <?php } ?>

               
                
                
                if (lat == '') {
                    lat = "55.3781";
                    no_marker_for_default='1';
                    
                }
                if (lng == '') {
                    lng = "3.4360";
                    no_marker_for_default='1';
                }
                

                

                //Latitude = 41.8781, Longitude = -87.6298
                geocoder        = new google.maps.Geocoder();
                center          = new google.maps.LatLng(lat, lng);
                markerBounds    = new google.maps.LatLngBounds();
                map             = new google.maps.Map(document.getElementById('map'), {
                    zoom:zoom,
                    center: center,
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                });
                markerBounds.extend(center);


                var map = new google.maps.Map(document.getElementById('map'), {
                    zoom: 6,
                    center: new google.maps.LatLng(55.3781, 3.4360),
                    // mapTypeId: google.maps.MapTypeId.SATELLITE,
                    disableDefaultUI: true,
                    zoomControl: true
                });
                var polyOptions = {
                    strokeWeight: 0,
                    fillOpacity: 0.45,
                    editable: true,
                    draggable: true
                };
                // Creates a drawing manager attached to the map that allows the user to draw
                // markers, lines, and shapes.
                drawingManager = new google.maps.drawing.DrawingManager({
                    // drawingMode: google.maps.drawing.OverlayType.POLYGON,
                    // markerOptions: {
                    //     draggable: true
                    // },
                    drawingMode: null,
                    drawingControlOptions: {
                        drawingModes: [
                            google.maps.drawing.OverlayType.POLYGON
                        ]
                    },
                    polylineOptions: {
                        editable: true,
                        draggable: true
                    },
                    rectangleOptions: polyOptions,
                    circleOptions: polyOptions,
                    polygonOptions: polyOptions,
                    map: map
                });
                if( no_marker_for_default!='1'){
                addMarker(center);
                map.setZoom(10);
            }
            google.maps.event.addListener(drawingManager, 'drawingmode_changed', clearSelection);
            google.maps.event.addListener(map, 'click', clearSelection);
            google.maps.event.addListener(drawingManager, 'polygoncomplete', function(polygon) {
            drawingManager.setDrawingMode(null);
                trackBoundaryForPolygon(polygon);
            google.maps.event.addDomListener(document.getElementById('clear-all-shape'), 'click', function(){polygon.setMap(null);});   
            });
                google.maps.event.addListener(drawingManager, 'overlaycomplete', function (e) {
                    // map_position_track();
                    var newShape = e.overlay;
                    
                    newShape.type = e.type;
                    
                    if (e.type !== google.maps.drawing.OverlayType.MARKER) {
                        // Switch back to non-drawing mode after drawing a shape.
                        drawingManager.setDrawingMode(null);
                        // Add an event listener that selects the newly-drawn shape when the user
                        // mouses down on it.
                        google.maps.event.addListener(newShape, 'click', function (e) {
                            if (e.vertex !== undefined) {
                                if (newShape.type === google.maps.drawing.OverlayType.POLYGON) {
                                    var path = newShape.getPaths().getAt(e.path);
                                    path.removeAt(e.vertex);
                                    if (path.length < 3) {
                                        newShape.setMap(null);
                                    }
                                }
                                if (newShape.type === google.maps.drawing.OverlayType.POLYLINE) {
                                    var path = newShape.getPath();
                                    path.removeAt(e.vertex);
                                    if (path.length < 2) {
                                        newShape.setMap(null);
                                    }
                                }
                            }
                            setSelection(newShape);
                        });
                        setSelection(newShape);
                    }
                    else {
                        google.maps.event.addListener(newShape, 'click', function (e) {
                            setSelection(newShape);
                        });
                        setSelection(newShape);
                    }

                    // console.log("newShape",newShape);
                });
                // Clear the current selection when the drawing mode is changed, or when the
                // map is clicked.
                google.maps.event.addListener(drawingManager, 'drawingmode_changed', clearSelection);
                google.maps.event.addListener(map, 'click', clearSelection);
                google.maps.event.addDomListener(document.getElementById('delete-button'), 'click', deleteSelectedShape);
                buildColorPalette();
            }
            google.maps.event.addDomListener(window, 'load', initialize);
            // This function is used to track the last map boundary Start //
        function map_position_track(){       
            var addr_url                        = '<?php echo base_url();?>' + 'admin/mapsearch/keepTheCenterOftheMapAccordingToDrawnShape';
            //var bounds                          = map.getBounds().toString();
            // var drawing_list_center_poistion    = map.getCenter().toString();
            // var drawing_list_zoom_level         = map.getZoom().toString(); 
            var datasent                        = {drawing_list_center_poistion:drawing_list_center_poistion,drawing_list_zoom_level:drawing_list_zoom_level};
            $.ajax({
                type: 'POST',
                url: addr_url,
                data: datasent,
                dataType: 'json',
                async: false,
                success: function(data) {}
            });
        }
        function trackBoundaryForPolygon(polygon){
        var get_lat_lang_bound  = polygon.getPath();
        var paths               = polygon.getPaths();
        var bounds              = new google.maps.LatLngBounds();
        
        var vertices            = polygon.getPath();
        var latLngList          = [];
        var latlngg             = "";
        var path;
        var polygon_id          = polygon.__gm_id;

         for (var i = 0; i < paths.getLength(); i++) {
            path = paths.getAt(i);
            for (var ii = 0; ii < path.getLength(); ii++) {
                bounds.extend(path.getAt(ii));
            }
        } 
        
       
        for (var i =0; i < vertices.getLength(); i++) {
          var xy = vertices.getAt(i);
          latLngList.push({lat: xy.lat(), lng: xy.lng()});
        }
        
        var south_west_lat      = bounds.getSouthWest().lat();
        var south_west_lng      = bounds.getSouthWest().lng();
        var north_east_lat      = bounds.getNorthEast().lat();
        var north_east_lng      = bounds.getNorthEast().lng();
        
        
        
        get_lat_lang_bound = bounds;      
        if(1){ // Create
            $.each(latLngList, function(i, data) {
                latlngg = "((" + data.lat + "),(" + data.lng + "))#" + latlngg;
            });
                 
            latLngArr.push(get_lat_lang_bound);
            $("#latLngArr").val(latLngArr.join("#"));
            /* keeping track polygon shape drawn*/
            polygonArr.push(latlngg);
            // console.log(polygonArr);
            $("#polygonlatLngArr").val(polygonArr.join("*"));
            /* End*/

            /* Save PolyPath List*/
            var pre_value_polypath_list = $("#polypath_list").val();
            var new_value_polypath_list = pre_value_polypath_list + latlngg + '#';
            $("#polypath_list").val(new_value_polypath_list);
             
            /* Polygon Track Records */
                var polygon_id                  = polygon.__gm_id;             
                var polygonCreate               = new Object();
                polygonCreate.id                = polygon_id;
                polygonCreate.type              = 'polygon';
                polygonCreate.radious           = '0';
                polygonCreate.center_lat        = '';
                polygonCreate.center_lng        = '';              
                polygonCreate.bound             = get_lat_lang_bound;               
                polygonCreate.points            = latLngList;
                polygonCreate.south_west_lat    = south_west_lat;
                polygonCreate.south_west_lng    = south_west_lng;
                polygonCreate.north_east_lat    = north_east_lat;
                polygonCreate.north_east_lng    = north_east_lng;
                shapeList.push(polygonCreate);
                console.log(shapeList);

           /* End */
        }
    }
    function addMarker(location) {
        marker = new google.maps.Marker({
            position: location,
            map: map
        });
    }
    function codeAddress() {
        var address = document.getElementById("center_map_location").value;
        geocoder.geocode( { 'address': address}, function(results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    if (marker) {
                        marker.setMap(null);
                        map.setCenter(results[0].geometry.location);
                        map.setZoom(14);
                        marker = new google.maps.Marker({
                             map: map,
                             position: results[0].geometry.location
                         });
                     } else {
                         //create a marker
                         map.setCenter(results[0].geometry.location);
                         map.setZoom(14);
                         marker = new google.maps.Marker({
                             map: map,
                             position: results[0].geometry.location
                         });
                     }        
                    var inp = results[0].geometry.location;
                    var lat = results[0].geometry.location.lat();
                    var lng = results[0].geometry.location.lng();
                    var boun_c = new google.maps.LatLng(lat, lng);
                    markerBounds.extend(boun_c);
                    $("#center_map_lat_value").val(lat);
                    $("#center_map_lng_value").val(lng);
                   //alert($("#center_map_lat_value").val());
                   //alert($("#center_map_lng_value").val());
                    //return true;
      } 
        });
        return 0;
    }
        
        //  End Here //

        </script>
    </head>
    <body>
    <form name="map_search_frm" id="map_search_frm" action="<?php echo base_url(); ?>admin/zone_management/selectboundaries" method="post"  class="mform" >
        <div id="panel">
            <div id="color-palette"></div>
            <div>
                <button id="delete-button">Delete Selected Shape</button>
                <button id="center-on-map" type="submit" class="black_bt">Find</button>
            </div>
        </div>
        <div id="map"></div>
    </form>
    </body>
</html>
   <!--  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDmu1Ie1Au-kvOJI64QEuvonXWjkkdX9Uc&libraries=drawing&callback=initMap"
         async defer></script>
  </body>
</html> -->