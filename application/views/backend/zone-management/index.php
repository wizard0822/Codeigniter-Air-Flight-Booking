<?php
    // Get your key here: https://developers.google.com/maps/documentation/javascript/get-api-key
    $GMAPS_KEY = 'AIzaSyDmu1Ie1Au-kvOJI64QEuvonXWjkkdX9Uc';
    $colors = explode(',', 'ffcccc,d9ffb3,d9ffb3,d1d1e0,d1d1e0,ecb3ff,b3fff0,cceeff,66ff99,b3ccff,66ffff,ff8080,ffb380,ff99c2,ff99c2,ffe0b3,ffff66,e6e600,00cc00,cc3300,9933ff,94b8b8,00b300,ff5c33');
    $default_sheet = (object) array('ZoomLevel'=>6,'CentreLatitude'=>53.82,'CentreLongitude'=>-2.587);

    // define('MYSQL_HOST', 'localhost');
    // define('MYSQL_USER', 'test_map');
    // define('MYSQL_PASS', 'test_map');
    // define('MYSQL_DB', 'test_map_db');

    // $db_link = @mysqli_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASS, MYSQL_DB);
    // // t($db_link);die;
    // if (mysqli_connect_errno()) {
    //     echo 'Mysql server gone: '.mysqli_connect_error();
    //     exit();
    // }
    // sql_query('set names utf8');

    // function sql($arg)
    // {
    //     Global $db_link;
    //     if( get_magic_quotes_gpc() )
    //         $arg = stripslashes($arg);
    //     return mysqli_real_escape_string($db_link, $arg);
    // }

    // function sql_query($q){
    //     Global $db_link;
    //     $r = mysqli_query($db_link, $q);
    //     if(!$r)
    //     {
    //         $h = fopen('sql_error.log','a+');
    //         fwrite($h, date('Y-m-d H:i:s').';'.$q.';'.mysqli_error($db_link)."\n");
    //         fclose($h);
    //     }
    //     return $r;
    // }
    function dechex6($dec) {
        $hex = dechex($dec);
        return str_repeat('0', 6-strlen($hex)).$hex;
    }

    //
    // AJAX requests
    //
    // load list of zones
    // if( isset($_POST['load_sheet']) ) {

    //     $sheet_id = intval($_POST['load_sheet']);
    //     $ret = array();
    //     $zones = sql_query('SELECT ID_ZoneCode,ID_Zone,Name,Colour,AsText(Zone) AS poly FROM Zone WHERE ID_Sheet = '.$sheet_id.' ORDER BY ID_Zone');
    //     while($z = mysqli_fetch_object($zones)){
    //         $points = explode(',', str_replace(array('POLYGON((','))'),'', $z->poly));
    //         //print_r($points); echo $points[0].' == '.$points[count($points)-1];
    //         if( $points[0]==$points[count($points)-1] ) // remove last double-point
    //             array_pop($points);
    //         $ret[] = (object) array(
    //             'rec_id'  => $z->ID_ZoneCode,
    //             'id_zone' => $z->ID_Zone,
    //             'name'    => $z->Name,
    //             'colour'  => '#'.dechex6($z->Colour),
    //             'points'  => $points
    //         );
    //     }
    //     echo json_encode($ret);
    //     exit();
    // }
    //
    // save new zone and get rec_id
    //
    
    //
    // New Sheet
    //
    // elseif( isset($_POST['new_sheet']) ) {
    //     // echo 2;die;
    //     if( sql_query('INSERT INTO ZoneEditor SET 
    //         SheetName="'.sql($_POST['name']).'",
    //         CentreLatitude="'.sql($_POST['lat']).'",
    //         CentreLongitude="'.sql($_POST['lng']).'",
    //         ZoomLevel="'.intval($_POST['zoom']).'"') )
    //          echo '{"sheet_id":"'.mysqli_insert_id($db_link).'"}';
    //     else
    //         echo '{"message":"Error adding new sheet."}';
    //     exit();
    // }
    //
    // Set Center of Sheet
    //
    // elseif( isset($_POST['center_sheet']) ) {
    //     if( sql_query('UPDATE ZoneEditor SET 
    //         SheetName="'.sql($_POST['name']).'",
    //         CentreLatitude="'.sql($_POST['lat']).'",
    //         CentreLongitude="'.sql($_POST['lng']).'",
    //         ZoomLevel="'.intval($_POST['zoom']).'"
    //         WHERE ID_ZoneEditor = '.intval($_POST['center_sheet']) ) )
    //         echo '{"sheet_id":"'.intval($_POST['center_sheet']).'"}';
    //     else
    //         echo '{"message":"Error changing the sheet."}';
    //     exit();
    // }
    //
    // Delete Sheet
    //
    
    //
    // Select Sheet
    //
    // elseif( isset($_POST['get_sheet']) ) {
    //     $r = sql_query('SELECT * FROM ZoneEditor WHERE ID_ZoneEditor="'.intval($_POST['get_sheet']).'"');
    //     if( $f = mysqli_fetch_object($r) ) {
    //         echo json_encode( array(
    //             'sheet_id'=> $f->ID_ZoneEditor,
    //             'lat'     => $f->CentreLatitude,
    //             'lng'     => $f->CentreLongitude,
    //             'zoom'    => $f->ZoomLevel
    //         ) );
    //     } else echo '{"message":"'.mysqli_error($db_link).'"}';
    //     exit();
    // }

    //
    // Start
    //
    // $sheets = array();
    // $r = 'SELECT * FROM sb_ZoneEditor_tbl ORDER BY ID_ZoneEditor';
    // echo $this->db->last_query();die;
    // while( $f = mysqli_fetch_object($r) ) {
    //     $sheets[$f->ID_ZoneEditor] = $f;
    //     $default_sheet = $f;
    // }

?>
<!DOCTYPE html>
<html>
<head>
    <title>Zone Editor</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.css">
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
    <style>
    #panel {
        float: left;
        width: 250px;
        height: 100%;
        padding: 10px;
    }
    .ui-icon {
        margin-top:0!important;
    }
    button,
    .zone_name,
    .colour_button,
    .edit_button,
    .del_button {
        cursor: pointer;
    }
    .zone_name:hover {
        color: red;
    }
    .edit_button:hover,
    .del_button:hover {
        background-color: #fcc;
    }
    .colour_button,
    .edit_button,
    .del_button {
        margin-left: 3px;
        float: right;
    }
    #AddButton,
    #SaveButton,
    #CancelButton {
        float: right;
        display: none;
    }
    #map {
        height: 100%;
    }
    /* Optional: Makes the sample page fill the window. */
    html, body {
        height: 100%;
        margin: 0;
        padding: 0;
        font-family: Arial, sans-serif;
        font-size: 12px;
    }
    .jconfirm{
        max-width:350px;
    }
    #palette {
        position: absolute;
        z-index: 2;
        width: 90px;
        left: 95px;
        padding: 5px;
        background-color: #fff;
        border: 1px solid #666
    }
    .palette-item {
        display: inline-block;
        width: 16px;
        height: 16px;
        cursor: pointer;
        border: 1px solid white;
    }
    #select_sheets {
        width:200px;
    }
    #NewSheetButton, #SetCenterButton, #DeleteSheetButton{
        float:right;
    }
    </style>
</head>
<body>
<div id="panel">
    <p>Sheet: <select id="select_sheets"><?php
        foreach($list as $id=>$sheet)
            echo '<option value="'.$sheet['ID_ZoneEditor'].'">'.$sheet['ID_ZoneEditor'].'. '.$sheet['SheetName'].'</option>';
        ?></select> <!--<button id="" title="Select this sheet">Go</button>-->
    </p>
    <p>
        <button id="DeleteSheetButton" title="Delete this sheet"><span class="ui-icon ui-icon-circle-close"></span></button>
        <button id="SetCenterButton" title="Set center for this sheet"><span class="ui-icon ui-icon-arrow-4"></span></button>
        <button id="NewSheetButton" title="Create new sheet"><span class="ui-icon ui-icon-circle-plus"></span></button>
    </p>
    <div style="clear:both"></div>
    <hr/>
    <div id="zones"></div>
    <div style="clear:both"></div>
    <button id="AddButton">Add zone</button><button id="SaveButton">Save</button>
    <button id="CancelButton">Cancel</button>
</div>
<div id="map"></div>
<script>
// 
var new_sheet = $("#select_sheets").val();
//alert(sheet1);
    $.ajax({
            data: {
                get_sheet: new_sheet
            },
            method: "POST",
            dataType: 'json',
            url: '<?php echo base_url();?>admin/zone_management/get_sheet'
        }).done(function(data) {
            // console.log(data);
            if(data.sheet_id) {
                Sheet_ID =data.sheet_id;
                map.setCenter(new google.maps.LatLng(data.lat, data.lng));
                map.setZoom(Number(data.zoom));
                load_sheet(new_sheet);
                $.ajax({
                data: {
                    load_sheet: Sheet_ID
                },
                method: "POST",
                dataType: 'json',
                url: '<?php echo base_url();?>admin/zone_management/load_sheet'
            }).done(function(data) {
                Sheet_ID = Sheet_ID;
                clear_zones();
                var zones_div = $('#zones');
                for(var i=0;i<data.length;i++) {
                    var z = {
                        rec_id:  data[i].rec_id,
                        id_zone: Number(data[i].id_zone),
                        name:    data[i].name,
                        colour:  data[i].colour
                    }, points =  data[i].points;
                    zones_div.append( new_line(z, i+1) );
                    if( points!=null && Array.isArray(points) && points.length) {
                        for(var p=0;p<points.length;p++) {
                            var point = points[p].split(' ');
                            points[p] = new google.maps.LatLng(point[0], point[1]);
                        }
                        z.g = new_polygon(points, z.colour);
                    }
                    zones.push(z);
                }
            });
            } else $.alert(''+data.message);
        });
    var map, Colours = ["#<?php echo implode('","#',$colors);?>"], zones=[], NowEdit=0,
        Sheet_ID='';
        
    // $('#select_sheets option[value="1"] : selected');
    $('#select_sheets').change(change_sheet).val(Sheet_ID);
    console.log(Sheet_ID);
    $('#NewSheetButton').click(function(){sheet_name(new_sheet)});
    $('#SetCenterButton').click(function(){sheet_name(center_sheet,Sheet_ID)});
    $('#DeleteSheetButton').click(delete_sheet);

    $('#AddButton').click(function(){prompt_name(add_zone)}).show();
    $('#SaveButton').click(save_edit).hide();
    $('#CancelButton').click(cancel_edit).hide();

    function is_now_edit() {
        if( NowEdit ) {
            $.alert("You're in the middle of zone editing. Please save before.");
            return true;
        }
        return false;
    }
    function change_sheet() {
        if( is_now_edit() ) return;
        var new_sheet = $('#select_sheets').val();
        if( Sheet_ID == new_sheet ) {
            $.alert("You're already on sheet "+Sheet_ID);
            return;
        }
        $.ajax({
            data: {
                get_sheet: new_sheet
            },
            method: "POST",
            dataType: 'json',
            url: '<?php echo base_url();?>admin/zone_management/get_sheet'
        }).done(function(data) {
            // console.log(data);
            if(data.sheet_id) {
                Sheet_ID =data.sheet_id;
                map.setCenter(new google.maps.LatLng(data.lat, data.lng));
                map.setZoom(Number(data.zoom));
                load_sheet(new_sheet);
            } else $.alert(''+data.message);
        });
    }
    function sheet_name(callback,sheet_id=0) {
        if( is_now_edit() ) return;
        var name = sheet_id ? $('#select_sheets > option[value="'+Sheet_ID+'"]').text().split('.')[1].trim():'';
        console.log(sheet_id,$('#select_sheets > option[value="'+Sheet_ID+'"]').text());
        $.confirm({
            title: sheet_id? 'Edit sheet name ('+sheet_id+')': 'Create new sheet?',
            content: 'You will also set the zoom level and map center for this sheet.' +
            '<form action="" class="formName">' +
            '<div class="form-group">' +
            '<p>Sheet name: <input type="text" placeholder="Sheet name" class="name form-control" maxlength="30" style="width:80%" value="" required /></p>' +
            '</div>' +
            '</form>',
            buttons: {
                formSubmit: {
                    text: 'Submit',
                    btnClass: 'btn-blue',
                    action: function () {
                        var name = this.$content.find('.name').val();
                        if(!name){
                            $.alert('Provide a valid name');
                            return false;
                        }
                        callback(sheet_id,name);
                    }
                },
                cancel: function () {
                    //close
                }
            },
            onContentReady: function () {
                // bind to events
                var jc = this;
                this.$content.find('.name').val(name).focus();
                this.$content.find('form').on('submit', function (e) {
                    // if the user submits the form by pressing enter in the field.
                    e.preventDefault();
                    jc.$$formSubmit.trigger('click'); // reference the button and click it
                });
            }
        });
    }
    function new_sheet(id,name) {
        $.ajax({
            data: {
                new_sheet: 1,
                name: name,
                zoom: map.getZoom(),
                lat: map.getCenter().lat(),
                lng: map.getCenter().lng()
            },
            method: "POST",
            dataType: 'json',
            url: '<?php echo base_url();?>admin/zone_management/add_new_sheet'
        }).done(function(data) {
            console.log(data);
            if(data.sheet_id) {
                Sheet_ID = data.sheet_id;
                $('#select_sheets').append('<option value="'+Sheet_ID+'">'+Sheet_ID+'. '+name+'</option>').val(Sheet_ID);
                clear_zones();
            } else $.alert(data.message);
        });
    }
    function center_sheet(id,name) {
        $.ajax({
            data: {
                center_sheet: id,
                name: name,
                zoom: map.getZoom(),
                lat: map.getCenter().lat(),
                lng: map.getCenter().lng()
            },
            method: "POST",
            dataType: 'json',
            url: '<?php echo base_url();?>admin/zone_management/center_sheet'
        }).done(function(data) {
            if(data.sheet_id) {
                Sheet_ID = data.sheet_id;
                $('#select_sheets').val(data.sheet_id).find('option[value="'+Sheet_ID+'"]').text(Sheet_ID+'. '+name);
                load_sheet(data.sheet_id);
            } else $.alert(data.message);
        });
    }
    function delete_sheet() {
        if( is_now_edit() ) return;
        $.confirm({
            title: 'Delete this sheet ('+Sheet_ID+')?',
            content: 'Are you sure?',
            buttons: {
                confirm: function () {
                    $.ajax({
                        data: {
                            delete_sheet: Sheet_ID
                        },
                        method: "POST",
                        dataType: 'json',
                        url: '<?php echo base_url();?>admin/zone_management/delete_sheet'
                    }).done(function(data) {
                        if(data.sheet_id) {
                            $('#select_sheets > option[value="'+Sheet_ID+'"]').remove();
                            Sheet_ID = data.sheet_id;
                            load_sheet(Sheet_ID);
                        } else $.alert(data.message);
                    });
                },
                cancel: function(){}
            }
        });
    }

    function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
            zoom: <?php echo $default_sheet->ZoomLevel?>,
            center: new google.maps.LatLng(<?php echo $default_sheet->CentreLatitude.','.$default_sheet->CentreLongitude?>),
            mapTypeId: 'terrain'
        });
        map.addListener("click", click_on_map);
        window.onkeypress = function(e){
            if( e.keyCode==27 ) {
                $('img').each(function(){
                    if( this.src=='https://maps.gstatic.com/mapfiles/undo_poly.png' )
                        this.click();
                });
            }
        };
        load_sheet();
    }

    function click_on_map(event) {
        if(NowEdit) {
            var z = zones[NowEdit-1], points;
            if(z.g) {
                points = z.g.getPath().getArray();
                if( points.length>=4) return;
                z.g.setMap(null);
            }
            else
                points = [];
            points.push(event.latLng);
            z.g = new_polygon(points, z.colour);
            z.g.setEditable(true);
            dblclickpoly(z.g);
        }
    }
    function load_sheet(sheet_id=Sheet_ID) {
        $.ajax({
            data: {
                load_sheet: sheet_id
            },
            method: "POST",
            dataType: 'json',
            url: '<?php echo base_url();?>admin/zone_management/load_sheet'
        }).done(function(data) {
            Sheet_ID = sheet_id;
            clear_zones();
            var zones_div = $('#zones');
            for(var i=0;i<data.length;i++) {
                var z = {
                    rec_id:  data[i].rec_id,
                    id_zone: Number(data[i].id_zone),
                    name:    data[i].name,
                    colour:  data[i].colour
                }, points =  data[i].points;
                zones_div.append( new_line(z, i+1) );
                if( points!=null && Array.isArray(points) && points.length) {
                    for(var p=0;p<points.length;p++) {
                        var point = points[p].split(' ');
                        points[p] = new google.maps.LatLng(point[0], point[1]);
                    }
                    z.g = new_polygon(points, z.colour);
                }
                zones.push(z);
            }
        });
    }

    function update_list(){
        var zones_div = $('#zones');
        zones_div.html('');
        for(var i=0;i<zones.length;i++)
            zones_div.append( new_line(zones[i], i+1) );
    }
    function new_line(z,num=0){
        var p = $('<p id="zline' + z.rec_id + '"></p>');
        // delete
        p.append($('<span class="del_button ui-icon ui-icon-trash" title="Delete"></span>')
            .click(function(){delete_zone(z.rec_id)}));
        // edit
        p.append($('<span class="edit_button ui-icon ui-icon-pencil" title="Edit"></span>')
            .click(function(){edit_zone(num)}));
        // color
        p.append($('<span class="colour_button ui-icon ui-icon-blank" style="background-color:'+z.colour+'" ' +
            'title="Change colour"></span>')
            .click(function(){change_colour(z.rec_id, num)}));
        // name
        var name = $('<span class="zone_name">' + z.id_zone + '. ' + z.name + '</span>');
        name.click(function(){prompt_name(function(id_zone,name){save_name(z.rec_id,id_zone,name)},z.id_zone,z.name)});
        p.append(name);
        return p;
    }
    function new_polygon(points, colour){
        var g = new google.maps.Polygon({
            paths: points,
            strokeColor: colour,
            strokeOpacity: 0.8,
            strokeWeight: 5,
            fillColor: colour,
            fillOpacity: 0.6,
            draggable: false,
            geodesic: true
        });
        g.setMap(map);
        return g;
    }

    function change_colour(rec_id, num){
        if( $('#palette') )
            $('#palette').remove();
        var div = $('<div id="palette"></div>');
        div.append($('<div style="float:right;cursor:pointer" class="ui-icon ui-icon-close" title="Close"></div>')
            .click(function(){div.remove()}) );
        for(var i=0;i<Colours.length;i++) {
            div.append($('<span class="palette-item" title="'+Colours[i]+'" style="background-color:'+Colours[i]+'"></span>')
                .click(function(){save_colour(rec_id,this.title)}));
        }
        var zline = $("#zline"+rec_id);
        div.css({top: zline.offset().top});
        zline.append(div);
    }
    function save_colour(rec_id,colour){
        $.ajax({
            data: {
                rec_id: rec_id,
                save_colour: colour
            },
            method: "POST",
            dataType: 'json',
            url: '<?php echo base_url();?>admin/zone_management/save_colour'
        }).done(function(data) {
            if( data.ok )
                for(var i=0;i<zones.length;i++)
                    if(zones[i].rec_id==rec_id) {
                        if(zones[i].g)
                            zones[i].g.setOptions({strokeColor: colour, fillColor: colour});
                        zones[i].colour = colour;
                        $('#zline'+rec_id).find('.colour_button').css('background-color',colour);
                        $('#palette').remove();
                        break;
                    }
        });
    }
    function prompt_name(callback,incoming_id_zone='',name=''){
        var id_zone = incoming_id_zone;
        if(!id_zone) {
            id_zone = 1;
            for (var i = 0; i<zones.length; i++)
                if( zones[i].id_zone>=id_zone ) id_zone = Number(zones[i].id_zone)+1;
        }
        $.confirm({
            title: incoming_id_zone?'Edit zone':'New zone',
            content: '' +
            '<form action="" class="formName">' +
            '<div class="form-group">' +
            '<p>ID_Zone: <input type="number" placeholder="Zone ID" class="id_zone form-control" style="width:60px" value="' +id_zone+'" required /></p>' +
            '<p>Name: <input type="text" placeholder="Zone name" class="name form-control" maxlength="30" style="width:80%" value="" required /></p>' +
            '</div>' +
            '</form>',
            buttons: {
                formSubmit: {
                    text: 'Submit',
                    btnClass: 'btn-blue',
                    action: function () {
                        var id_zone = parseInt(this.$content.find('.id_zone').val());
                        if( !id_zone || id_zone<0 ){
                            $.alert('Provide a valid zone id');
                            return false;
                        }
                        if( id_zone!=incoming_id_zone )
                            for(var i=0;i<zones.length;i++)
                                if( zones[i].id_zone==id_zone ) {
                                    $.alert('Zone id ('+id_zone+') already taken, set another.');
                                    return false;
                                }
                        var name = this.$content.find('.name').val();
                        if(!name){
                            $.alert('Provide a valid name');
                            return false;
                        }
                        callback(id_zone,name);
                    }
                },
                cancel: function () {
                    //close
                }
            },
            onContentReady: function () {
                // bind to events
                var jc = this;
                this.$content.find('.name').val(name).focus();
                this.$content.find('form').on('submit', function (e) {
                    // if the user submits the form by pressing enter in the field.
                    e.preventDefault();
                    jc.$$formSubmit.trigger('click'); // reference the button and click it
                });
            }
        });
    }

    function add_zone(id_zone,name){
        console.log(Sheet_ID);
        if( !id_zone || id_zone==null || !name || name==null ) return;
        var colour = Colours[ parseInt( Math.random()*Colours.length ) ];
        $.ajax({
            data: {
                id_sheet: Sheet_ID,
                id_zone: id_zone,
                new_zone: name,
                colour: colour
            },
            method: "POST",
            dataType: 'json',
            url: '<?php echo base_url();?>admin/zone_management/new_zone'
        }).done(function(data) {
            var z = {
                rec_id: data.rec_id,
                id_zone: id_zone,
                name: name,
                colour: colour,
                points: []
            };
            $('#zones').append( new_line(z, zones.length+1) );
            zones.push(z);
            edit_zone(zones.length);
        });
    }
    function save_name(rec_id,id_zone,name){
        $.ajax({
            data: {
                rec_id: rec_id,
                id_zone: id_zone,
                save_name: name
            },
            method: "POST",
            dataType: 'json',
            url: '<?php echo base_url();?>admin/zone_management/save_name'
        }).done(function(data) {
            if( data.ok )
            for(var i=0;i<zones.length;i++)
                if(zones[i].rec_id==rec_id) {
                    zones[i].id_zone = Number(id_zone);
                    zones[i].name = name;
                    $('#zline'+rec_id).find('.zone_name').text(id_zone+'. '+name);
                    break;
                }
        });
    }
    function edit_zone(num){
        if( is_now_edit() ) return;
        NowEdit = num;
        map.setOptions({draggableCursor:'default'});
        $('#AddButton').hide();
        $('#SaveButton').show();
        $('#CancelButton').show();
        SaveForUndo = false;
        z = zones[num-1];
        if( z.g ) {
            SaveForUndo = [];
            var list = z.g.getPath().getArray();
            for(var p=0; p<list.length; p++)
                SaveForUndo[p] = list[p].toJSON();
            z.g.setEditable(true);
            dblclickpoly(z.g);
        }
    }
    function dblclickpoly(poly){
        google.maps.event.addListener(poly, 'dblclick', function(e) {
            if (e.vertex != undefined)
                poly.getPath().removeAt(e.vertex);
        });
    }
    function edit_end(){
        NowEdit = 0;
        map.setOptions({draggableCursor:'url(http://maps.google.com/intl/en_us/mapfiles/openhand_8_8.cur),default'});
        $('#AddButton').show();
        $('#SaveButton').hide();
        $('#CancelButton').hide();
    }
    function cancel_edit(){
        if(!NowEdit) return;
        var num = NowEdit-1;
        edit_end();
        if( SaveForUndo ) {
            zones[num].g.setMap(null);
            delete zones[num].g;
            zones[num].g = new_polygon(SaveForUndo, zones[num].colour);
            zones[num].g.setMap(map);
        }
    }
    function save_edit(){
        if(!NowEdit) return;
        z = zones[NowEdit-1];
        edit_end();
        if( !z.g ) return;
        z.g.setEditable(false);
        var list = z.g.getPath().getArray(), points = [];
        for(var p=0; p<list.length; p++)
            points[p] = list[p].toJSON();
        $.ajax({
            data: {
                save_points: z.rec_id,
                points: points
            },
            method: "POST",
            dataType: 'json',
            url: '<?php echo base_url();?>admin/zone_management/save_points'
        }).done(function(data) {
        });
    }
    function delete_zone(rec_id){
        if( is_now_edit() ) return;
        $.confirm({
            title: 'Delete this zone?',
            content: 'Are you sure?',
            buttons: {
                confirm: function () {
                    var line_num = -1;
                    for(var i=0;i<zones.length;i++)
                        if( zones[i].rec_id == rec_id ) {
                            line_num = i;
                            break;
                        }
                    if( line_num==-1 ) {
                        $.alert({
                            title: 'Alert!',
                            content: 'Something wrong with zones list'
                        });
                        return;
                    }
                    $.ajax({
                        data: {
                            delete_zone: rec_id
                        },
                        method: "POST",
                        dataType: 'json',
                        url: '<?php echo base_url();?>admin/zone_management/delete_zone'
                    }).done(function(data) {
                        if(zones[line_num].g) {
                            zones[line_num].g.setMap(null);
                            delete zones[line_num].g;
                        }
                        zones.splice(line_num,1);
                        update_list();
                    });
                },
                cancel: function(){}
            }
        });
    }
    function clear_zones(){
        for(var i=0; zones&&i<zones.length; i++) {
            // gmap delete polygon zones[i].points
            zones[i].g.setMap(null);
            delete zones[i].g;
        }
        zones = [];
        $('#zones').html('');
    }
</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=<?php echo$GMAPS_KEY?>&callback=initMap"></script>
</body>
</html>