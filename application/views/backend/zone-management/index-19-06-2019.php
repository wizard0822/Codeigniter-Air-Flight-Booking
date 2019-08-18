<script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDmu1Ie1Au-kvOJI64QEuvonXWjkkdX9Uc&libraries=drawing"></script>
<div id="map_canvas" style=" border: 2px solid #3872ac;"></div>
<div id="info">
    
</div>
<style type="text/css">html, body, #map_canvas {
    height: 500px;
    width: 500px;
    margin: 0px;
    padding: 0px
}</style>
<script type="text/javascript">
var geocoder;
var map;
var polygonArray = [];
 var latLngArr = [];
 var polygonArr = [];
 var zonecount=1;
 var shapeList=new Array();
function initialize() {
    map = new google.maps.Map(
    document.getElementById("map_canvas"), {
        center: new google.maps.LatLng(37.4419, -122.1419),
        zoom: 13,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    });
    var drawingManager = new google.maps.drawing.DrawingManager({
        drawingMode: google.maps.drawing.OverlayType.POLYGON,
        drawingControl: true,
        drawingControlOptions: {
            position: google.maps.ControlPosition.TOP_CENTER,
            drawingModes: [
            //google.maps.drawing.OverlayType.MARKER,
            //google.maps.drawing.OverlayType.CIRCLE,
            google.maps.drawing.OverlayType.POLYGON]
            //google.maps.drawing.OverlayType.POLYLINE,
            //google.maps.drawing.OverlayType.RECTANGLE]
        },
        markerOptions: {
            icon: 'images/car-icon.png'
        },
        circleOptions: {
            fillColor: '#ffff00',
            fillOpacity: 1,
            strokeWeight: 5,
            clickable: false,
            editable: true,
            zIndex: 1
        },
        polygonOptions: {
            fillColor: '#00000',
            fillOpacity: 0.5,
            strokeWeight: 2,
            strokeColor: '#57ACF9',
            clickable: true,
            draggable:true,
            editable: false,
            zIndex: 1
        }
    });
    //console.log(drawingManager)
    drawingManager.setMap(map)

    google.maps.event.addListener(drawingManager, 'polygoncomplete', function (polygon) {
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

}
google.maps.event.addDomListener(window, "load", initialize);


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
