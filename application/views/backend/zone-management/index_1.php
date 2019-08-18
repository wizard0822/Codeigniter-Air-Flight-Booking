<?php echo $top_header; ?>

<?php //echo $remove_header_open; ?>

<!-- Map View Search -->
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=drawing&amp;key=AIzaSyDmu1Ie1Au-kvOJI64QEuvonXWjkkdX9Uc"></script>
<script type="text/javascript">


    $(document).ready(function() {
	/*	1197.5510728898414,
		41.94589387646933
		-87.71733283996582*/
		
		//$('.gmnoprint').eq(2).css("position", "fixed");
		//$('.gmnoprint').eq(2).css("top", "77px");
	
        // $("html, body").animate({scrollTop: '160px'}, 100);
        //$("#header_bar_toggle").remove();
        
       $('#map_search_frm').bind("keyup keypress", function(e) {
           var code = e.keyCode || e.which;       
            if(code==13){                         
                e.preventDefault();
                codeAddress();
                return false;
            }
       });
        
        
        var url = "<?php echo base_url(); ?>";
        var shapeListString = '';
        $("#now-search").click(function() {
            shapeListString     = JSON.stringify(shapeList);
            $("#shapeListString").val(shapeListString);
            $("#goto_search_page").val('1');
            $("#map_search_frm").submit();
        })
        $("#reset-map-area").click(function() {
            $("#reset_click").val('yes');
            $("#map_search_frm").submit();
        })
//        $("#clear-all-shape").click(function() {
//            $("#shape_delete").val('yes');
//            $("#map_search_frm").submit();
//        })
        $("#center-on-map").click(function() {
            codeAddress();
        })
        $("#back-to-search-page").click(function() {
            window.location.href = "<?php echo base_url();?>propertysearch";            
        })
        
    });


     /* New Data Add */
     var shapeList=new Array();
     var overlayArr = new Array();   
     var previous_shape_list   =   '<?php echo $prevoiusShapeList ; ?>';
     previous_shape_list       =   eval(previous_shape_list);
    
      
     /* End */

    var map;
    var geocoder;
    var marker;
    var markers = [];
    var drawingManager;
    var infowindow;
    var markerCluster;
    var selectedShape;
    var colors = ['#D8687F', '#1E90FF', '#FF1493', '#32CD32', '#FF8C00', '#4B0082'];
    var selectedColor;
    var colorButtons = {};
    var circleCounter = '0';
    var lat_list_for_polygon = '';
    var lng_list_for_polygon = '';
    var all_overlays = [];
    var latLngArr = [];
    var circle_arr = [];
    var rectangle_arr = [];
    var rectangle;
    var center = '';
    var no_marker_for_default;


//    NEW
    var circleRadiusArr = [];
    var pre_defined_circle_list;
    var rectangleArr = [];
    var polygonArr = [];
    var polygonPathArr = [];
    
    var markerBounds;


    var pre_defined_rectangle_list;
    var pre_defined_polygon_list;
	var saved_shape_list;
    
    

    function clearSelection() {
        if (selectedShape) {
            selectedShape.setEditable(false);
            selectedShape = null;
        }
    }
    function setSelection(shape) {
        clearSelection();
        selectedShape = shape;
        shape.setEditable(true);
       // selectColor(shape.get('fillColor') || shape.get('strokeColor'));
    }
    function deleteAllShape(s) {
         //alert(s);
         //console.log(s);
         s.setMap(null);
        for (var i = 0; i < all_overlays.length; i++)
        {
            all_overlays[i].overlay.setMap(null);
        }
        all_overlays = [];

        for (var i = 0; i < circle_arr.length; i++)
        {
            circle_arr[i].setMap(null);
        }
        circle_arr = [];


        for (var i = 0; i < rectangle_arr.length; i++)
        {
            rectangle_arr[i].setMap(null);
        }

        for (var i = 0; i < polygonArr.length; i++)
        {
            //polygonArr[i].setMap(null);
            polygonArr = [];
        }

    }
 
 
   
    function initialize() {
		
		var catch_center_poistion;
		var catch_zoom_level 				= "<?php echo($catch_zoom_level?$catch_zoom_level:'0'); ?>";
		var lat;
		var lng;
		var zoom = 10;
		 <?php   if( $catch_center_poistion != '' ){?>
            catch_center_poistion = "<?php echo $catch_center_poistion  ;?>";
            tem                   = catch_center_poistion.split(",");
            tem1                  = tem[0].split("(");
            tem2                  = tem[1].split(")");
            lat            		  = tem1[1];
            lng            		  = tem2[0];
			zoom				  = "<?php echo $catch_zoom_level  ;?>";	
			zoom				  = parseInt(zoom);
			 $('body,html').animate({scrollTop: 0}, 800);
		 <?php } else{ ?>
					lat = "<?php echo $LAT ?>";
        			lng = "<?php echo $LNG ?>";
		 <?php } ?>

       
		
		
        if (lat == '') {
            lat = "42.0450722";
            no_marker_for_default='1';
            
        }
        if (lng == '') {
            lng = "-87.68769689999999";
            no_marker_for_default='1';
        }
		

        

        //Latitude = 41.8781, Longitude = -87.6298
        geocoder 		= new google.maps.Geocoder();
        center 			= new google.maps.LatLng(lat, lng);
        markerBounds 	= new google.maps.LatLngBounds();
        map 			= new google.maps.Map(document.getElementById('map'), {
            zoom:zoom,
            center: center,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });
        markerBounds.extend(center);
		
     
        // Creates a drawing manager attached to the map that allows the user to draw
        // markers, lines, and shapes.
        drawingManager = new google.maps.drawing.DrawingManager({
            drawingMode: null,
            drawingControlOptions: {
                drawingModes: [
                    google.maps.drawing.OverlayType.CIRCLE,
                    google.maps.drawing.OverlayType.RECTANGLE,
                    google.maps.drawing.OverlayType.POLYGON
                ]
            },
            rectangleOptions: {
                fillColor: 'red',
                fillOpacity: 0.5,
                strokeWeight: 0,
                editable: false,
                clickable: true,
                draggable: false,
                zIndex: 1
            },
            circleOptions: {
                fillColor: 'red',
                fillOpacity: 0.5,
                strokeWeight: 0,
                editable: false,
                clickable: false,
                draggable: false,
                zIndex: 1

            },
            polygonOptions: {
				strokeWeight: 0,
				fillOpacity: 0.45,
				editable: true,
				fillColor: 'red',
				clickable: true,
				draggable: false,
			},
            drawingControl: true,
            map: map
        });
        //CentralPark = new google.maps.LatLng(37.7699298, -122.4469157);
        if( no_marker_for_default!='1'){
            addMarker(center);
            map.setZoom(10);
        }
        google.maps.event.addListener(drawingManager, 'drawingmode_changed', clearSelection);
        google.maps.event.addListener(map, 'click', clearSelection);
        //google.maps.event.addDomListener(document.getElementById('clear-all-shape'), 'click', deleteAllShape);
        google.maps.event.addListener(drawingManager, 'polygoncomplete', function(polygon) {
			drawingManager.setDrawingMode(null);
           	trackBoundaryForPolygon(polygon);
		google.maps.event.addDomListener(document.getElementById('clear-all-shape'), 'click', function(){polygon.setMap(null);});	
        });
        google.maps.event.addListener(drawingManager, 'overlaycomplete', function(event) {
			map_position_track();// Map postion track record
            if (event.type != google.maps.drawing.OverlayType.MARKER) {
                drawingManager.setDrawingMode(null);
                var newShape = event.overlay;
                newShape.type = event.type;
                google.maps.event.addListener(newShape, 'click', function() {
                    setSelection(newShape);
                });
                setSelection(newShape);
            }  
            if(event.type == google.maps.drawing.OverlayType.POLYGON){
                
            }
            if (event.type == google.maps.drawing.OverlayType.CIRCLE) {
                drawingManager.setDrawingMode(null);
                trackBoundaryForCircle(event); 
                google.maps.event.addDomListener(document.getElementById('clear-all-shape'), 'click', function(){deleteAllShape(newShape);});
            }
            if (event.type == google.maps.drawing.OverlayType.RECTANGLE) {               
                drawingManager.setDrawingMode(null);
                trackBoundaryForRectangle(event);
                google.maps.event.addDomListener(document.getElementById('clear-all-shape'), 'click', function(){deleteAllShape(newShape);});
            }
        });
	
		///////////////////////////////////////////////////////////
		saved_shape_list = '<?php echo $saved_shape_list; ?>';
		if(saved_shape_list){
			var result = $.parseJSON(saved_shape_list);
			$.each(result, function(k, val) {
				 shapeList.push(val);   
				//##################################  Draw saved circle once again ##########################################//			
				if(val['type']=='circle'){
					var radious 		= val['radious'];
					var center_lat		= val['center_lat'];
					var center_lng		= val['center_lng'];
					var circle_center = new google.maps.LatLng(center_lat, center_lng);
					//drawPredefinedCircle(parseInt(radious),center_lat,center_lng);
						circle = new google.maps.Circle({
							center: circle_center,
							radius:parseInt(radious),
							map: map,
							fillColor: 'red',
							fillOpacity: 0.5,
							strokeColor: '#FF0000',
							strokeOpacity: 0.8,
							strokeWeight: 0,
							editable: false,
							clickable: false,
							draggable: false,
							zIndex: 1
        				})
						 //markerBounds.extend(circle_center);					
				}
				//################################# Circle Draw End Here ####################################################//
				//################################# Draw Saved Rectangle  Start Here ########################################//	
				if(val['type']=='rectangle'){
					var south_west_lat = val['south_west_lat'] ;
					var south_west_lng = val['south_west_lng'] ;
					var north_east_lat = val['north_east_lat'] ;
					var north_east_lng = val['north_east_lng'] ;
					rectangle = new google.maps.Rectangle({
									strokeColor: '#FF0000',
									strokeOpacity: 0.8,
									strokeWeight: 0,
									fillColor: '#FF0000',
									fillOpacity: 0.35,
									map: map,
									clickable: false,
									editable: false,
									draggable: false,
									bounds: new google.maps.LatLngBounds(
											new google.maps.LatLng(south_west_lat, south_west_lng),
											new google.maps.LatLng(north_east_lat, north_east_lng))
        						});
					
				}
			  //################################# Rectangle Draw End Here ######################################################//	
			  
			  //################################## Polygon Draw Start Here ####################################################//
			  if(val['type']=='polygon'){
				  
				  var polygon_points = val['points'];
				  var polygonCoord;
				  var polygonShape;
				  polygonCoord = [ $.each(polygon_points, function(k, val2) {
											new google.maps.LatLng(val2['lat'],val2['lng']);
				  					}) 
								 ];
				  // Construct the polygon.
				  polygonShape = new google.maps.Polygon({
					paths: polygonCoord,
					strokeColor: '#FF0000',
					strokeOpacity: 0.8,
					strokeWeight: 0,
					fillColor: '#FF0000',
					fillOpacity: 0.35
				  });
				  polygonShape.setMap(map);
			  }
			  //####################################  Polygon Draw End Here ###################################################//
			});
			//console.log(shapeList);
		}
	
    
       
    }
	// This function is used to track the last map boundary Start //
		function map_position_track(){       
            var addr_url 						= SITE_ROOT + 'mapsearch/keepTheCenterOftheMapAccordingToDrawnShape';
            var bounds 							= map.getBounds().toString();
			var drawing_list_center_poistion 	= map.getCenter().toString();
			var drawing_list_zoom_level 		= map.getZoom().toString();	
            var datasent 						= {drawing_list_center_poistion:drawing_list_center_poistion,drawing_list_zoom_level:drawing_list_zoom_level};
            $.ajax({
                type: 'POST',
                url: addr_url,
                data: datasent,
                dataType: 'json',
                async: false,
                success: function(data) {}
            });
		}
		
		//  End Here //
    // Function To Update Circle Object Data into Array and track data
   function trackBoundaryForCircle(event){
    
            var circle_id           = event.overlay.__gm_id;
            var circle_bounds       = event.overlay.getBounds();
            var south_west_lat      = event.overlay.getBounds().getSouthWest().lat();
            var south_west_lng      = event.overlay.getBounds().getSouthWest().lng();
            var north_east_lat      = event.overlay.getBounds().getNorthEast().lat();
            var north_east_lng      = event.overlay.getBounds().getNorthEast().lng();          
            var cir_radious         = event.overlay.radius;
            var center_circle_latt  = event.overlay.getCenter().lat();
            var center_circle_lngg  = event.overlay.getCenter().lng();
            var nncircle_center     = event.overlay.getCenter(); 
            
               
            if(1){ // First time Circle Create
                var circleCreate        = new Object();
                circleCreate.id         = circle_id;
                circleCreate.radious    = cir_radious;
                circleCreate.type       = 'circle';
                circleCreate.bound      = circle_bounds;
                circleCreate.center_lat = center_circle_latt;
                circleCreate.center_lng = center_circle_lngg;
                circleCreate.points     = '';
                shapeList.push(circleCreate);   
				//console.log(shapeList);
            }
    
    }
    // Function To Update Rectangle data into Array
    function trackBoundaryForRectangle(event){    
        var rectangle_id        = event.overlay.__gm_id;
        var rectangle_bounds    = event.overlay.getBounds();
        var south_west_lat      = event.overlay.getBounds().getSouthWest().lat();
        var south_west_lng      = event.overlay.getBounds().getSouthWest().lng();
        var north_east_lat      = event.overlay.getBounds().getNorthEast().lat();
        var north_east_lng      = event.overlay.getBounds().getNorthEast().lng();
        if(1){ // First time Rectange Create
            var rectangleCreate             = new Object();
            rectangleCreate.id              = rectangle_id;
            rectangleCreate.radious         = '0';
            rectangleCreate.type            = 'rectangle';
            rectangleCreate.bound           = rectangle_bounds;
            rectangleCreate.south_west_lat  = south_west_lat;
            rectangleCreate.south_west_lng  = south_west_lng;
            rectangleCreate.north_east_lat  = north_east_lat;
            rectangleCreate.north_east_lng  = north_east_lng;
            rectangleCreate.center_lat      = '';
            rectangleCreate.center_lng      = '';
            rectangleCreate.points          = '';
            shapeList.push(rectangleCreate);
        }
    }
     // function To Update Polygon data in to Array    
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

           /* End */
        }
    }
    
   
   
   
    function addMarker(location) {
        marker = new google.maps.Marker({
            position: location,
            map: map
        });
    }
    // Function to center map location 
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
    // Function To Show Propert details using infowimdow    
    function attachSecretMessage(marker, property_id) {

        //alert('hi');
        if (infowindow) {
            infowindow.close();
        }
        var addr_url = SITE_ROOT + 'google_map_data_for_property_searches/getPropertyAddress';
        infowindow = new google.maps.InfoWindow({maxWidth: 1000, maxHeight: 300})
        google.maps.event.addListener(marker, 'click', function() {
            $.ajax({
                type: 'POST',
                url: addr_url,
                data: {property_id: marker.title},
                success: function(resp) {
                    infowindow.setContent(resp);
                    infowindow.open(marker.get('map'), marker);
                    propertyDetailsClick = '1';
                }
            });
        });
    }
    
	
	google.maps.event.addDomListener(window, 'load', initialize);


</script>
<!-- Map View Ends --><body>
<input type="hidden" name="header_bar_toggle" id="header_bar_toggle">
    <!--............ WRAPER START...............-->
    <div id="wraper11"> 
        <!--............ HEADER START...............--> 
        <?php //echo $header; ?> 
        <!--............ HEADER END...............-->

        <div id="inner_area_div11" class="inner_area" style=" width: 98% !important; margin-left: 20px; margin-right: 20px;"> 
            <div style="position: fixed; height: 80px; width: 100%;  z-index: 2147483647; background-color: #fff;">
<!--                <div style=" float: left; width: 18%; margin-top: 14px;"><span ><h3 style="color:black;margin-top: -1px;">Select Map Area</h3></span></div>-->
                <div style=" float: left ; width: 100%; margin-bottom: 10px; margin-left: -31px;">
                    <form name="map_search_frm" id="map_search_frm" action="<?php echo base_url(); ?>mapsearch/selectboundaries" method="post"  class="mform" >
                        <div style=" margin-bottom:15px;" >           
	                        <input type="hidden" name="shapeListString" id="shapeListString" value="">     
                            <input type="hidden" name="search_id" id="search_id" value="<?php echo $search_id;?>">               
                            <input type="hidden" name="set_lat_lang_bound" id="set_lat_lang_bound" value="">
                            <input type="hidden" name="goto_search_page" id="goto_search_page" value="">
                            <input type="hidden" name="reset_click" id="reset_click" value="">
                            <input type="hidden" name="shape_delete" id="shape_delete" value="">
                            <input type="hidden" name="shape_draw" id="shape_draw" value="">
                            <input type="hidden" name="shape_draw_polygon" id="shape_draw_polygon" value="">
                            <input type="hidden" name="lng_list" id="lng_list" value="">
                            <input type="hidden" name="latLngArr" id="latLngArr" value="">                            
                            <input type="hidden" name="center_map_lat_value" id="center_map_lat_value" value="">
                             <input type="hidden" name="center_map_lng_value" id="center_map_lng_value" value="">

                            <!------------*******************************-->

                            <input type="hidden" name="circle_radius_list" id="circle_radius_list" value="">              
                            <input type="hidden" name="circlelatLngArr" id="circlelatLngArr" value="<?php echo $circle_list ?>">

                            <!--******************************-->


                            <!-- For Draw Rectangle Code -->
                            <input type="hidden" name="rectangle_list" id="rectangle_list" value="">              
                            <input type="hidden" name="rectanglelatLngArr" id="rectanglelatLngArr" value="<?php echo $rectangle_list ?>">
                            <!-- For Draw Rectangle End Code -->


                            <!-- For Polygon draw code -->
                            <input type="hidden" name="polypath_list" id="polypath_list" value="">
                            <input type="hidden" name="polygonlatLngArr" id="polygonlatLngArr" value="<?php echo $polygon_list ?>">
                            <!-- End -->
                            
                            <!--Get redirect url submit from select map search-->
                            <input type="hidden" name="redirect_url" id="redirect_url" value="<?php echo $redirect_url; ?>">
                            <!--end-->



                            <div style=" float: left;margin-top:6px;">
                                <span style="">  Center Map On: </span>
                            </div>
                            <div style=" float: left; margin-left: 4px; margin-top: -1px;">
                                <!-- placeholder="3025 North Oakley Avenue, Chicago, Illinois, 60618" -->
                                <input type="text" autocomplete="OFF"  name="center_map_location" id="center_map_location" placeholder="Address, City or Point of Interest" value="<?php echo $address_type; ?>" class="text-box" style="width:300px"><br>
                               <!-- <span style="font-size: 10px; color: #BFBFBF">Example:3025 North Oakley Avenue, Chicago, Illinois, 60618</span>-->
                            </div>

                            <div class="mar-top" style=" float: left; margin-left: 4px;">                           
                                <button id="center-on-map" type="button" class="black_bt">Find</button>
                            </div> 

                            <div class="mar-top" style="float: left; margin-left: 4px;  margin-top: 6px;color:#D1D1D1;">
                            	<a href="javascript:void(0);" id="clear-all-shape" class="" style=" text-decoration:underline;  color:#D1D1D1;font-size:14px;" >Delete All Shapes</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" id="reset-map-area" class="" style=" text-decoration:underline; color:#D1D1D1; font-size:14px;" >Reset Map</a>
                              <!--  <button id="clear-all-shape" type="button" class="grey_bt">Delete All Shapes</button>  -->         
                            </div> 
                            <div class="mar-top" style=" float: left; margin-left: 10px;;">
                                <button id="now-search" type="button" class="black_bt">Submit to Search</button>
                               
                            </div>
                            <div class="mar-top" style=" float: left; margin-left: 4px; margin-top: 6px;">
                            <a href="<?php echo $base_url.'propertysearch'?>" id="reset-map-area" class="" style=" text-decoration:underline; color:#D1D1D1; font-size:14px;" >Cancel</a>
                            <!--    <button id="reset-map-area" type="button" class="grey_bt">Reset</button>-->
                            </div>    
                            

<!--                        <div style=" float: right; margin-left: 4px;">                            
                                <button type="button" id="back-to-search-page" >Back</button>
                            </div>-->
                        </div>
                    </form>
                    <!--                    <div style=" float: left; margin-left: 4px; margin-top: -0px;">
                                            <button id="delete-button">Delete Selected Shape</button>           
                                        </div> -->


                </div>
                
                
                <div style=" color:black; margin-left:156px;">
         <img src="<?php echo base_url(); ?>assets/images/frontend/drawing-tools.jpg">
            </div>

            </div>
			
			

            <!-- 1 start -->
            <div style=" width: 100%; ">
                <div id="map" style="width: 100%; height: 800px; margin-bottom: 3%; margin-top: 80px; "></div>
            </div>
            <!-- 1 End -->


        </div>
    </div>


    <!--............ footer START...............--> 
    <?php //echo $footer; ?> 
    <!--............ footer END...............-->

</div>
<!--............ WRAPER END...............-->

</body>




<style type="text/css">
.black_bt {
    background-color: #000000;
    border: 1px solid #000000;
    border-radius: 3px;
    color: #FFFFFF;
    cursor: pointer;
    display: block;
    float: left;
    font-family: Arial,Helvetica,sans-serif;
    font-size: 12px;
    font-weight: bold;
    line-height: 16px;
    margin: 12px 10px 0 5px;
    padding: 4px 16px;
    text-decoration: none;
   
}
.grey_bt{
     background-color: #BFBFBF;
    border: 1px solid #BFBFBF;
    border-radius: 3px;
    color: #FFFFFF;
    cursor: pointer;
    display: block;
    float: left;
    font-family: Arial,Helvetica,sans-serif;
    font-size: 12px;
    font-weight: bold;
    line-height: 16px;
    margin: 12px 10px 0 5px;
    padding: 4px 16px;
    text-decoration: none;
    
    
}


.mar-top{ margin-top: -13px;}
@media screen and (-webkit-min-device-pixel-ratio:0) {
.mar-top{ margin-top: -11px;}
}
    </style>
</html><script language="javascript">

<?php
if ($this->session->userdata("admin_type") != 'S' && $this->session->userdata('admin_type') != 'M' && $this->session->userdata('admin_type') != 'A') {//check open from administrater (start) ----------- 
    if ($this->session->userdata('user_id') > 0) {
        
    } else {
        ?>
            //            $("#next_prev_block_div").click(function() {
            //                $("#open_shortregistration").trigger('click');
            //            });
            //            $("#next_prev_block_div2").click(function() {
            //                $("#open_shortregistration").trigger('click');
            //            });

            //            $("#inner_area_div").click(function() {
            //                document.getElementById("city_hold_div").style.display = "none";
            //                //------------------------------------------------------------------------
            //                var dat = "submit=1";
            //                var url = SITE_ROOT + 'property/count_click/';
            //
            //                $.ajax({
            //                    type: 'POST',
            //                    url: url,
            //                    data: dat,
            //                    success: function(resp)
            //                    {
            //                        //alert(resp);
            //                        if (resp == 2)
            //                        {
            //                            document.location.reload(true);
            //                        }
            //                    },
            //                    error: function(e) {
            //                        //alert('Error: ' + e);  
            //                    }
            //                });
            //                //--------------------------------------------------------------------------
            //
            //            });

        <?php
    }
}
?>
    
</script>