
<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
        <meta charset="UTF-8">
        <title>Drawing Tools</title>
        <script type="text/javascript"
        src="http://maps.google.com/maps/api/js?key=AIzaSyDmu1Ie1Au-kvOJI64QEuvonXWjkkdX9Uc&sensor=false&libraries=geometry,drawing"></script>
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
                // var polylineOptions = drawingManager.get('polylineOptions');
                // polylineOptions.strokeColor = color;
                // drawingManager.set('polylineOptions', polylineOptions);

                // var rectangleOptions = drawingManager.get('rectangleOptions');
                // rectangleOptions.fillColor = color;
                // drawingManager.set('rectangleOptions', rectangleOptions);

                // var circleOptions = drawingManager.get('circleOptions');
                // circleOptions.fillColor = color;
                // drawingManager.set('circleOptions', circleOptions);

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
                var map = new google.maps.Map(document.getElementById('map'), {
                    zoom: 16,
                    center: new google.maps.LatLng(52.25097, 20.97114),
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
                    drawingMode: google.maps.drawing.OverlayType.POLYGON,
                    markerOptions: {
                        draggable: true
                    },
                    drawingControlOptions: {
                        position: google.maps.ControlPosition.TOP_CENTER,
                        drawingModes: [
                        //google.maps.drawing.OverlayType.MARKER,
                        //google.maps.drawing.OverlayType.CIRCLE,
                        google.maps.drawing.OverlayType.POLYGON]
                        //google.maps.drawing.OverlayType.POLYLINE,
                        //google.maps.drawing.OverlayType.RECTANGLE]
                    },
                    polylineOptions: {
                        editable: true,
                        draggable: true
                    },
                    
                    map: map
                });

                google.maps.event.addListener(drawingManager, 'overlaycomplete', function (e) {
                    var newShape = e.overlay;
                    alert('h00');
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
                });

                // Clear the current selection when the drawing mode is changed, or when the
                // map is clicked.
                google.maps.event.addListener(drawingManager, 'drawingmode_changed', clearSelection);
                google.maps.event.addListener(map, 'click', clearSelection);
                google.maps.event.addDomListener(document.getElementById('delete-button'), 'click', deleteSelectedShape);
                google.maps.event.addListener(drawingManager, 'polygoncomplete', function (polygon) {
                    alert('hii');
                    document.getElementById('info').innerHTML += "polygon points:" + "<br>";
                    //var y = 0;
                    console.log(drawingManager.lenth);
                    for (var i = 0; i < polygon.getPath().getLength(); i++) {
                        document.getElementById('info').innerHTML += polygon.getPath().getAt(i).toUrlValue(6) + "<br>";
                    }
                    document.getElementById('info').innerHTML += "polygon name:" + "<br>";
                    document.getElementById('info').innerHTML += 'Zone' + "<br>";
                    
                    
                    polygonArray.push(polygon);
                    trackBoundaryForPolygon(polygon);
                });

                // buildColorPalette();
            }
            google.maps.event.addDomListener(window, 'load', initialize);

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
        // console.log(latLngList);
        
        var south_west_lat      = bounds.getSouthWest().lat();
        var south_west_lng      = bounds.getSouthWest().lng();
        var north_east_lat      = bounds.getNorthEast().lat();
        var north_east_lng      = bounds.getNorthEast().lng();
        
        var myLatlng = bounds.getCenter();

      var mapLabel2 = new MapLabel({
        text: '2',
        position: myLatlng,
        map: map,
        fontSize: 20,
        align: 'left'
      });
      mapLabel2.set('position', myLatlng);
        
        get_lat_lang_bound = bounds;      
        if(1){ // Create
            $.each(latLngList, function(i, data) {
                latlngg = "((" + data.lat + "),(" + data.lng + "))#" + latlngg;
            });
              
            latLngArr.push(get_lat_lang_bound);
            $('#info').append('<input type="hidden" name="latLngArr'+zonecount+'" id="latLngArr'+zonecount+'" value="">');
            $("#latLngArr"+zonecount).val(latLngArr.join("#"));
            /* keeping track polygon shape drawn*/
            polygonArr.push(latlngg);
            // console.log(polygonArr);
            $('#info').append('<input type="hidden" name="polygonlatLngArr'+zonecount+'" id="polygonlatLngArr'+zonecount+'" value="">');
            $("#polygonlatLngArr"+zonecount).val(polygonArr.join("*"));
            /* End*/

            /* Save PolyPath List*/
            var pre_value_polypath_list = $("#polypath_list"+zonecount).val();
            var new_value_polypath_list = pre_value_polypath_list + latlngg + '#';
            $('#info').append('<input type="hidden" name="polypath_list'+zonecount+'" id="polypath_list'+zonecount+'" value="">');
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

                zonecount=zonecount+1;   

           /* End */
        }
    }
        </script>
    </head>
    <body>
        <div id="panel">
            <div id="color-palette"></div>
            <div>
                <button id="delete-button">Delete Selected Shape</button>
            </div>
        </div>
        <div id="map"></div>
        <div id="info"></div>
    </body>
</html>
