<?php

class Mapsearch extends MY_Controller {

    public $arrpagination = array();
    public $view_page;

    function __construct() {       
       parent::__construct();
       $this->load->model('property_model');
       $this->load->model('property_openhouse_model');
       $this->load->model('property_sold_model');
       $this->load->model('fav_properties_model');
       $this->load->model('property_images_model');
       $this->load->model('saved_searches_model');
       $this->load->model('managephoto_model');
       $this->load->model('property_images_model');
       $this->data['offset'] = $_REQUEST['offset'];
    }

    function index() {
    }
    function getPropertyAddress(){
        $this->load->model('property_model');
        $property_id            = $_POST['property_id'];
        $prop_status            = $_POST['prop_status'];
        if($prop_status=='closed'){
            $cond=' AND id="'.$property_id.'"';
            $list = $this->property_sold_model->fetch($cond, '*');
        }else{
            $cond=' AND id="'.$property_id.'"';
            $list = $this->property_model->fetch($cond, '*');
        }
        ########################## Code added by Akash for Get the IMAGES of property manually inserted #############################
         if (count($list) > 0) {
            foreach ($list as $key => $val) {
               // t($list);
                //Start For count total image from property_images table
                $condimg = " AND LN='" . $val['LN'] . "'";
                $fet_img = $this->property_images_model->fetch($condimg);
                $propphotocount = $list[$key]['PHOTOCOUNT'];
                if ((count($fet_img) > 0) || ($propphotocount > 0)) {
                    $list[$key]['count_img'] = count($fet_img) + $propphotocount;
                } else {
                    $list[$key]['count_img'] = 0 + $propphotocount;
                }
                //End For count total image from property_images table
                if(!ctype_digit($val['LN'])){
                   $get_image_cond         = "AND status = '1'  AND LN = '".$val['LN']."' order by order_status asc limit 1";
                   $get_image_details      = $this->property_images_model->fetch($get_image_cond);
                   $get_image_name         = $get_image_details[0]['photo'];
                   $list[$key]['manually_insert_property_image']         = $get_image_name;
                }
                //Get the Mls present in the managephoto table to show only one picture
                $cond_managephoto = "AND status = 1 AND  LN = '" . $val['LN'] . "'";
                $img_managephoto = $this->managephoto_model->fetch($cond_managephoto);
                $list[$key]['img_managephoto']         = $img_managephoto[0]['LN'];
                //Get the Mls present in the managephoto table to show only one picture End
               }
            }
            
        ######################################################### END ###############################################################
        $this->data['row']=$list[0];
        $this->load->view('frontend/marker_property_details',$this->data);
    }
 
    function getPropertyAddressPopup($property_id,$prop_status){
        $this->load->model('property_model');
        // $property_id            = $_POST['property_id'];
        // $prop_status            = $_POST['prop_status'];
        if($prop_status=='closed'){
            $cond=' AND id="'.$property_id.'"';
            $list = $this->property_sold_model->fetch($cond, '*');
        }else{
            $cond=' AND id="'.$property_id.'"';
            $list = $this->property_model->fetch($cond, '*');
        }
        ########################## Code added by Akash for Get the IMAGES of property manually inserted #############################
        // t($list,1);
         if (count($list) > 0) {
            foreach ($list as $key => $val) {
               // t($list);
                //Start For count total image from property_images table
                $condimg = " AND LN='" . $val['LN'] . "'";
                $fet_img = $this->property_images_model->fetch($condimg);
                $propphotocount = $list[$key]['PHOTOCOUNT'];
                if ((count($fet_img) > 0) || ($propphotocount > 0)) {
                    $list[$key]['count_img'] = count($fet_img) + $propphotocount;
                } else {
                    $list[$key]['count_img'] = 0 + $propphotocount;
                }
                //End For count total image from property_images table
                if(!ctype_digit($val['LN'])){
                   $get_image_cond         = "AND status = '1'  AND LN = '".$val['LN']."' order by order_status asc limit 1";
                   $get_image_details      = $this->property_images_model->fetch($get_image_cond);
                   $get_image_name         = $get_image_details[0]['photo'];
                   $list[$key]['manually_insert_property_image']         = $get_image_name;
                }
                //Get the Mls present in the managephoto table to show only one picture
                $cond_managephoto = "AND status = 1 AND  LN = '" . $val['LN'] . "'";
                $img_managephoto = $this->managephoto_model->fetch($cond_managephoto);
                $list[$key]['img_managephoto']         = $img_managephoto[0]['LN'];
                //Get the Mls present in the managephoto table to show only one picture End
               }
            }
            
        ######################################################### END ###############################################################
        $this->data['row']=$list[0];
        $this->load->view('frontend/marker_property_details_mapbox',$this->data);
    }
    
    /* This Function Is used to get the property details of givent id list Fir Map data*/
    function getPropertyDetailsFromIdList(){
        $terms_and_condition = '';
        $terms_and_condition = $this->session->userdata('terms_and_condition');
        
        if ($terms_and_condition != 'Yes') {
            $cond = " AND INTERNETLISTING = 'All' " . $cond;
	$cond1 = " AND INTERNETLISTING = 'All' " . $cond1;
        }
        
        
        if(is_array($_POST['property_list'])){
            $this->load->model('property_model');           
            $property_list = $_POST['property_list'];
            $list_id = '';
            foreach($property_list as $id){
                $list_id  .= "'$id'".',';
            }
            $list_id        = rtrim($list_id,',');
            $cond           = ' AND id in('.$list_id.')';         
            $property_rows  = $this->property_model->fetch($cond,'id,HSN,CP,STR,STREETSUFFIX,UN,CIT,STATE,ZP,ADI,LN,BR,FULL_BATHS,HALF_BATHS,ASF,LP,SP,MT,BLT,LN,CLOSEDDATE,type_full,type_short,ST,LAT,LNG,INTERNETLISTING');
            $return_output   ='';
            foreach($property_rows as $key=>$row){                
            
                $show_url_property_address1='';
                $show_property_address1='';
                
                if ($row['ADI'] == 'Yes') {
                    if ($row['HSN'] != '') {
                        $show_url_property_address1 .= ucwords(strtolower($row['HSN'])) . '-';
                    }
                    if ($row['CP'] != '') {
                        $show_url_property_address1 .= ucwords(strtolower($row['CP'])) . '-';
                    }
                    if ($row['STR'] != '') {
                        $show_url_property_address1 .= str_replace(" ", "-", ucwords(strtolower($row['STR']))) . '-';
                    }
                    if ($row['STREETSUFFIX'] != '') {
                        $show_url_property_address1 .= ucwords(strtolower($row['STREETSUFFIX'])) . '-';
                    }
                    if ($row['UN'] != '') {
                        $show_url_property_address1 .= ucwords(strtolower($row['UN'])) . '-';
                    }
                }
                if ($row['CIT'] != '') {
                    $show_url_property_address1 .= str_replace(" ", "-", ucwords(strtolower($row['CIT']))) . '-';
                }
                if ($row['STATE'] != '') {
                    $show_url_property_address1 .= ucwords(strtolower($row['STATE'])) . '-';
                }
                if ($row['ZP'] != '') {
                    $show_url_property_address1 .= ucwords(strtolower($row['ZP']));
                }
                if ($row['ADI'] == 'Yes') {
                    if ($row['HSN'] != '') {
                        $show_property_address1 .= $row['HSN'] . ' ';
                    }
                    if ($row['CP'] != '') {
                        $show_property_address1 .= $row['CP'] . ' ';
                    }
                    if ($row['STR'] != '') {
                        $show_property_address1 .= $row['STR'] . ' ';
                    }
                    if ($row['STREETSUFFIX'] != '') {
                        $show_property_address1 .= $row['STREETSUFFIX'];
                    }
                    if ($row['UN'] != '') {
                        $show_property_address1 .= "unit " . $row['UN'] . ', ';
                    }
                }
                if ($row['CIT'] != '') {
                    $show_property_address1 .= $row['CIT'] . ', ';
                }
                if ($row['STATE'] != '') {
                    $show_property_address1 .= $row['STATE'] . ' ';
                }
                if ($row['ZP'] != '') {
                    $show_property_address1 .= $row['ZP'];
                }       


                //$show_url_property_address = ucwords(strtolower($show_url_property_address));
                $show_url_property_address1 = preg_replace('~[^A-Za-z\d\s-]+~u', '-', $show_url_property_address1);
                $show_property_address1     = ucwords(strtolower($show_property_address1));
                $callMarkerFunction="callMarkerPoint('".$row['LAT']."','".$row['LNG']."','".$row['id']."')";
                
                ###################################################### NEW Condition Add For Address ##############################################
                $address_link   = '';                
                if(strtolower($row['INTERNETLISTING']) == 'all' && $row['HSN']!= '' ) {
                   $address_link   = '<a style="color:#6C6B6A" href="javascript:void(0);" onclick='.$callMarkerFunction.'>'.ucwords(strtolower($row['HSN'])) . ' ' . ucwords(strtolower($row['CP'])) . ' ' . ucwords(strtolower($row['STR'])).'</a>'; 
                }else if(strtolower($row['INTERNETLISTING']) == 'none'){
                    if (strtolower($terms_and_condition) == 'yes' && $row['HSN']!= '' ){
                       $address_link   = '<a style="color:#6C6B6A" href="javascript:void(0);" onclick='.$callMarkerFunction.'>'.ucwords(strtolower($row['HSN'])) . ' ' . ucwords(strtolower($row['CP'])) . ' ' . ucwords(strtolower($row['STR'])).'</a>';  
                    }else{
                        $address_link ='<a class="ajax1" style="color:#6C6B6A" href="'.$this->data['base_url'].'users/shortregistration" >Login to view</a>';
                    }
                }else if($row['HSN']== ''){
                    $address_link='<a style="color:#6C6B6A" href="javascript:void(0);" onclick='.$callMarkerFunction.'>Address Not Available</a>';
                }
               // echo $row['INTERNETLISTING'];
               // die;
                ################################################################ END  #############################################################
                
                
                $return_output.= '<tr>';
                        if ($row['ST'] != 'Closed') {
                            //$return_output.= '<td><input type="checkbox" name="chkLoop[]" id="chkLoop_'.$row['id'].'" value="'.$row['id'].'" onChange="count_check(\''.$row['id'].'\')" /></td>';
                        }
                    $return_output.= '<td>'.$address_link.'</td>';
                    $return_output.= '<td>'.ucwords(strtolower($row['CIT'])).'</td>';
                    $return_output.= '<td>'.$row['BR'].'</td>';
                    $return_output.= '<td>'.$row['FULL_BATHS'].'/'.$row['HALF_BATHS'].'</td>';
                    $return_output.= '<td>'.number_format($row['ASF']).'</td>';
                    $return_output.= '<td>';
                        if ($row['ST'] == 'Closed') {
                            $return_output.= "Sold for $" . number_format($row['SP']) . " - Listed at $" . number_format($row['LP']);
                        } else {
                            $return_output.= "$" . number_format($row['LP']);
                        } 
                    $return_output.= '</td>';
                    //$return_output.= '<td>'.$row['MT'].'</td>';
                    $return_output.= '<td>'.$row['BLT'].'</td>';
                    $return_output.= '<td>'.$row['LN'].'</td>';
                    $return_output.= '<td>';
                        if ($row['ST'] == 'Closed') {
                            $return_output.= "Sold on " . date("M d, Y", strtotime($row['CLOSEDDATE']));
                        } else {
                            $return_output.= $row['ST'];
                        }
                   $return_output.= '</td>';
                   $return_output.= '<td>';
                        if ($row['type_full'] == "Detached Single") {
                            $return_output.= "Single Family Home";
                        } else if ($row['type_full'] == "Attached Single") {
                            $return_output.= "Attached " . $row['TPC'];
                        } else {
                            $return_output.= $row['type_full'];
                        }
                   $return_output.= '</td>';
                   $return_output.= '<td>';
                    if ($this->session->userdata('click_close') != 'yes') { 
                        $return_output.='<a style="color:#6C6B6A" href="'.$this->data['base_url'].'realestate/'.$row['id'].'/'.$row['type_short'].'/'.$show_url_property_address1.'/MLS-'.$row['LN'].'">view details</a>';
                    }else{
                        $return_output.= '<a class="ajax1" style="color:#6C6B6A" href="'.$this->data['base_url'].'users/shortregistration" >view details</a>';
                    }
                   $return_output.= '</td>' ;
                   $return_output.= '</tr>';        
                                                    
            }
         echo $return_output;   
        }
        
    }
    
    /* */
    public function selectboundaries($search_id=''){
        
//       $this->session->unset_userdata('redirect_url_from_map_boundaries');
//       echo $this->session->userdata('redirect_url_from_map_boundaries');
//       
//       die;
        //t($this->session->post);
       /* if(empty($search_id)){
            if($this->session->userdata('redirect_url_from_map_boundaries')==''){
                //$this->session->set_userdata('redirect_url_from_map_boundaries',$_SERVER['HTTP_REFERER']);
          
                if($_SERVER['HTTP_REFERER']==base_url()){
                     $this->session->set_userdata('redirect_url_from_map_boundaries',$base_url.'propertysearch');
                }else{
                     $this->session->set_userdata('redirect_url_from_map_boundaries',$_SERVER['HTTP_REFERER']);
                }
            }
        }  */  
       //$this->session->unset_userdata('redirect_url_from_map_boundaries');
        if($search_id==''){
            $previous_page_details  = explode('/',$_SERVER['HTTP_REFERER']);           
            $page_name              = end(explode('/',$_SERVER['HTTP_REFERER']));
            if($page_name=='propertysearch'){
                $this->session->set_userdata('redirect_url_from_map_boundaries','1');
            }else if($page_name=='residential_for_sale'){
                $tot             = count($previous_page_details);
                $controller_name = $previous_page_details[$tot-2];
                if($controller_name=='property_email_alerts'){
                    $this->session->set_userdata('redirect_url_from_map_boundaries',2);
                }else{
                    $this->session->set_userdata('redirect_url_from_map_boundaries',1);
                }
            }
        }
        if($this->input->post('goto_search_page')=='1'){
          
           
           //die;
           
            ################################################################ New Add Code Here On 31 March 2014 #########################################################
             
            $shape_list_obj     = json_decode($_POST['shapeListString']);
            $circle_cond        = '';
            $rectangle_cond     = '';
            $polygon_cond       = '';           
            $no_of_circle       = '0';
            $no_of_rectangle    = '0';
            $no_of_polygon      = '0';
            foreach( $shape_list_obj as $key => $val ){              
                if($val->type=='circle'){
                    $no_of_circle++;
                    $current_location_lat    = $val->center_lat;
                    $current_location_lng    = $val->center_lng;
                    $radius_miles            = trim($val->radious);    
                    $radius_miles            = ($radius_miles/1609.344);
                    $circle_cond            .= " (((acos(sin(('".$current_location_lat."'*pi()/180)) * sin((`LAT`*pi()/180))+cos(('".$current_location_lat."'*pi()/180)) * cos((`LAT`*pi()/180)) * cos((('".$current_location_lng."'- `LNG`)*pi()/180))))*180/pi())*60*1.1515) <= '".$radius_miles."' OR  "; 
                }
                if($val->type=='rectangle'){
                    $no_of_rectangle++;
                    $lat_first_value         = $val->south_west_lat; 
                    $lan_first_value         = $val->south_west_lng;
                    $lat_second_value        = $val->north_east_lat; 
                    $lan_second_value        = $val->north_east_lng;
                    $rectangle_cond         .=" ((LAT BETWEEN '".$lat_first_value."' AND '".$lat_second_value."') AND (LNG BETWEEN '".$lan_first_value."' AND '".$lan_second_value."')) OR ";   
                }
                if($val->type=='polygon'){
                    $no_of_polygon++;                    
                    $lat_first_value         = $val->south_west_lat; 
                    $lan_first_value         = $val->south_west_lng;
                    $lat_second_value        = $val->north_east_lat;
                    $lan_second_value        = $val->north_east_lng;
                    $polygon_cond           .=" ((LAT BETWEEN '".$lat_first_value."' AND '".$lat_second_value."') AND (LNG BETWEEN '".$lan_first_value."' AND '".$lan_second_value."')) OR ";   
                }
            }
             if( $no_of_circle > 0 || $no_of_rectangle > 0 || $no_of_polygon > 0 ) {
                 $final_cond = "( ".$circle_cond." ".$rectangle_cond." ".$polygon_cond." 1!=1 ) ";
             }else{
                  $final_cond = "( 1=1 )";
             }
             if($final_cond){
                $setMapBound=array('setMapBound'=>$final_cond);               
                $this->session->set_userdata($setMapBound);
             }
             if(count(json_decode($_POST['shapeListString'])) > 0 ){
                $_SESSION['shape_in_map_boundary'] = base64_encode ($_POST['shapeListString']);
             }
            ##################################################################   End   ##################################################################### 
            
             
            ################################################################ Keep the location name in sesion ##############################################
             
            if($this->input->post('center_map_lat_value')&& $this->input->post('center_map_lat_value')){ 
                $center_city_click          = $this->input->post('center_map_location');
                $latitude                   = $this->input->post('center_map_lat_value');
                $longitude                  = $this->input->post('center_map_lng_value');                 
                $this->data['address_type'] = $center_city_click;
                $this->data['LAT']          = $latitude;
                $this->data['LNG']          = $longitude;
                $center_map_city_name       = array('center_map_city_name'=>$center_city_click);               
                $this->session->set_userdata($center_map_city_name);

                $center_map_lat_lng         = array('center_map_lat'=>$latitude,'center_map_lng'=>$longitude); 
                $this->session->set_userdata($center_map_lat_lng);
            }
            ###################################################################  END  #######################################################################
  
            
            ############################################################## Reset The last seen in the map view in listing page ############################################
            
            unset($_SESSION['last_catch_center_poistion']);
            unset($_SESSION['last_catch_zoom_level']);
            
            ###################################################################  END  #######################################################################
            $this->session->set_userdata('is_check_search',1);
            if($this->input->post('search_id')!=''){
                $searchid = $this->input->post('search_id');
                redirect('property_email_alerts/residential_for_sale/'.$searchid);
            } else {
                if($this->session->userdata('redirect_url_from_map_boundaries')==2){
                    $this->session->unset_userdata('redirect_url_from_map_boundaries');
                    redirect('property_email_alerts/residential_for_sale');
                }else{
                    $this->session->unset_userdata('redirect_url_from_map_boundaries');
                    redirect('propertysearch');
                }
            }
        } 
       
        if($this->input->post('shape_delete')=='yes'){        
            unset($_SESSION['drawing_list_zoom_level']);
            unset($_SESSION['shape_in_map_boundary']);
            $this->session->unset_userdata('setMapBound');  
            $this->session->unset_userdata('circle_list');
            $this->session->unset_userdata('rectangle_list');
            $this->session->unset_userdata('polygon_list');   
            redirect('mapsearch/selectboundaries');
        }
        if($this->input->post('reset_click')=='yes'){   
            unset($_SESSION['shape_in_map_boundary']);
            unset($_SESSION['drawing_list_zoom_level']);
            unset($_SESSION['drawing_list_center_poistion']);
            $this->session->unset_userdata('center_map_city_name');
            $this->session->unset_userdata('setMapBound');  
            $this->session->unset_userdata('circle_list');
            $this->session->unset_userdata('rectangle_list');
            $this->session->unset_userdata('polygon_list');
            $this->session->unset_userdata('center_map_lat');
            $this->session->unset_userdata('center_map_lng');     
            redirect('mapsearch/selectboundaries');
        }    
        if($this->session->userdata('center_map_city_name')){           
            $center_city_click          = $this->session->userdata('center_map_city_name');
            $this->data['address_type'] = $center_city_click;
            $this->data['LAT']          = $this->session->userdata('center_map_lat');
            $this->data['LNG']          = $this->session->userdata('center_map_lng');
//             
//            $center_map_lat_lng         = array('center_map_lat'=>$latitude,'center_map_lng'=>$longitude); 
//            $this->session->set_userdata($center_map_lat_lng);
        }

        
        ####################################################### For All Shape List Start Here ##########################################################
        if($search_id!=''){
            $search_id                           = base64_decode($search_id);           
            $condsearch                          = " AND id='" . $search_id . "'";
            $fet_search                          = $this->saved_searches_model->fetch($condsearch,'searchquery');
            $searchquery                         = unserialize($fet_search[0]['searchquery']);
            $saved_shape_list                    = $searchquery['shape_draw_in_map_boundary'];
            $this->data['saved_shape_list']      = base64_decode($saved_shape_list);
            $this->data['search_id']             = $search_id;  
            $drawing_list_center_poistion        = $searchquery['drawing_list_center_poistion'];
            $drawing_list_zoom_level             = $searchquery['drawing_list_zoom_level'];
            $tem                                       = explode(",",$drawing_list_center_poistion);
            $tem1                                      = explode("(",$tem[0]);
            $tem2                                      = explode(")",$tem[1]);
            $lat                                       = $tem1[1];
            $lng                                       = $tem2[0];
            if($lat=='42.0450722' && $lng =='-87.68769689999999'){
                $drawing_list_center_poistion =''; // That means user does not have chnage hos postion in google map
            }
            
        }else if(isset($_SESSION['shape_in_map_boundary'])){ 
            ##################################### Code For Track of the Map center where shape has been drawn last time #################################################
        
            if( isset($_SESSION['drawing_list_zoom_level']) && $_SESSION['drawing_list_zoom_level']!=''){
               $drawing_list_center_poistion              = $_SESSION['drawing_list_center_poistion'];
               $drawing_list_zoom_level                   = $_SESSION['drawing_list_zoom_level'];
               $tem                                       = explode(",",$drawing_list_center_poistion);
               $tem1                                      = explode("(",$tem[0]);
               $tem2                                      = explode(")",$tem[1]);
               $lat                                       = $tem1[1];
               $lng                                       = $tem2[0];
               if($lat=='42.0450722' && $lng =='-87.68769689999999'){
                   $drawing_list_center_poistion =''; // That means user does not have chnage hos postion in google map
               }
            }
            ###################################################################   END   #################################################################################
            
            
            
            
            
            $this->data['saved_shape_list']     = base64_decode($_SESSION['shape_in_map_boundary']);
        }else {
            $this->data['saved_shape_list']     = '';
        }
        ##########################################################  For ALl Sphae List End HEre ########################################################## 
        
        $this->data['catch_center_poistion']    = $drawing_list_center_poistion;
        $this->data['catch_zoom_level']         = $drawing_list_zoom_level;
        $this->data['circle_list']              = $this->session->userdata('circle_list');
        $this->data['rectangle_list']           = $this->session->userdata('rectangle_list');
        $this->data['polygon_list']             = $this->session->userdata('polygon_list');
               
        
        $this->data['set_meta']['title']        = "Select Map Boundaries";
        $this->data['set_meta']['description']  = "Map View";
        $this->data['set_meta']['keyword']      = "Map View";
        $this->data['viewtype']                 = 'map';
        $remove_header_open                     = '';
        $remove_header_open                     = "<script type='text/javascript'>";        
        $remove_header_open                    .= "document.getElementById('header_bar_toggle').remove();";
        //$remove_header_open                    .= "document.getElementById('header_bar_div').remove();";
        $remove_header_open                    .= "</script>";
        $this->data['remove_header_open']       = $remove_header_open;
        $this->get_include();
        $this->load->view('frontend/select_map_boundary',$this->data);
    }
  
    

 
    
   
    
    public function resetSelectMapBoundary(){
        $this->session->unset_userdata('center_map_city_name');
        $this->session->unset_userdata('setMapBound');  
        $this->session->unset_userdata('circle_list');
        $this->session->unset_userdata('rectangle_list');
        $this->session->unset_userdata('polygon_list');
        $this->session->unset_userdata('center_map_lat');
        $this->session->unset_userdata('center_map_lng');
        $this->session->unset_userdata('total_property');
        unset($_SESSION['drawing_list_center_poistion']);
        unset($_SESSION['drawing_list_zoom_level']);
        redirect('propertysearch');
    }
    public function dataPopulateAccordingToDrawShape(){
        if($_POST['first_lat'] && $_POST['first_lng'] ){         
            $lat_first_value    = trim($_POST['first_lat']);
            $lat_second_value   = trim($_POST['last_lat']);
            $lan_first_value    = trim($_POST['first_lng']);
            $lan_second_value   = trim($_POST['last_lng']);            
            $cond               = " AND `type_short` IN('AT','DE') AND ST IN ('New','Price Change','Re-activated','Back on Market','Active')  AND ((LAT BETWEEN '".$lat_first_value."' AND '".$lat_second_value."') AND (LNG BETWEEN '".$lan_first_value."' AND '".$lan_second_value."')) ";
            $result             = $this->property_model->fetch($cond, "id,LAT,LNG,ST,LN");
           
            $map_data_list['lat_lng_list'] = array();
            foreach ($result as $key => $val) {
                $map_data_list['lat_lng_list'][] = array(
                    "property_id" => $val['id'],
                    "longitude" => $val['LNG'],
                    "latitude" => $val['LAT'],
                    "status"=>  strtolower($val['ST'])
                );
            }
            $total_row = count($result);
//            if($this->session->userdata('total_property')){
//                $total_row = $this->session->userdata('total_property');
//                $total_row = $total_row+count($result);
//            }else{
//                $total_row = count($result);
//                $this->session->set_userdata('total_property',$total_row);
//            }
            if(count($result)>0){
                 $total_row = $this->session->userdata('total_property');
                 $total_row = $total_row+count($result);
                 $this->session->set_userdata('total_property',$total_row);
                 $total_row = number_format($total_row);
            }
            $map_data_list['total_row']=$total_row;
             $map_data_list['for_this_shape_row']=count($result);
            echo json_encode($map_data_list);
            exit();
        }
    }

    
    public function dataPopulateAccordingToDrawCircle(){
        
       
        if($_POST['center_circle_latt'] && $_POST['center_circle_lngg'] ){     
        
            
            $current_location_lat    = trim($_POST['center_circle_latt']);
            $current_location_lng   = trim($_POST['center_circle_lngg']);
            $radius_miles           = trim($_POST['cir_radious']);    
            $radius_miles           =($radius_miles/1609.344);
            $cond =" AND `type_short` IN('AT','DE') AND ST IN ('New','Price Change','Re-activated','Back on Market','Active')  AND  (((acos(sin(('".$current_location_lat."'*pi()/180)) * sin((`LAT`*pi()/180))+cos(('".$current_location_lat."'*pi()/180)) * cos((`LAT`*pi()/180)) * cos((('".$current_location_lng."'- `LNG`)*pi()/180))))*180/pi())*60*1.1515) <= '".$radius_miles."'";
           // $cond                 = " AND `type_short` IN('AT','DE') AND ST IN ('New','Price Change','Re-activated','Back on Market','Active')  AND ACOS( SIN( RADIANS( `LAT` ) ) * SIN( RADIANS( '".$current_location_lat."' ) ) + COS( RADIANS( `LAT` ) ) * COS( RADIANS( '".$current_location_lat."' )) * COS( RADIANS( `LNG` ) - RADIANS( '".$current_location_lng."' )) ) * 3964.348 < ".$radius_miles."  ";  
            //$cond               = " AND `type_short` IN('AT','DE') AND ST IN ('New','Price Change','Re-activated','Back on Market','Active')  AND ((LAT BETWEEN '".$lat_first_value."' AND '".$lat_second_value."') AND (LNG BETWEEN '".$lan_first_value."' AND '".$lan_second_value."')) ";
            $result             = $this->property_model->fetch($cond, "id,LAT,LNG,ST,LN");
         
            $map_data_list['lat_lng_list'] = array();
            foreach ($result as $key => $val) {
                $map_data_list['lat_lng_list'][] = array(
                    "property_id" => $val['id'],
                    "longitude" => $val['LNG'],
                    "latitude" => $val['LAT'],
                    "status"=>  strtolower($val['ST'])
                );
            }
            $total_row = count($result);
//            if($this->session->userdata('total_property')){
//                $total_row = $this->session->userdata('total_property');
//                $total_row = $total_row+count($result);
//            }else{
//                $total_row = count($result);
//                $this->session->set_userdata('total_property',$total_row);
//            }
            if(count($result)>0){
                 $total_row = $this->session->userdata('total_property');
                 $total_row = $total_row+count($result);
                 $this->session->set_userdata('total_property',$total_row);
                 $total_row = number_format($total_row);
            }
            $map_data_list['total_row']=$total_row;
            $map_data_list['for_this_shape_row']=count($result);
            echo json_encode($map_data_list);
            exit();
        }
        
    }
    
  
    
    public function dataPopulateAccordingToDrawPolygon(){
        if($_POST['first_lat']){
            $lat_first_value    = trim($_POST['first_lat']);
            $lat_second_value   = trim($_POST['last_lat']);
            $lan_first_value    = trim($_POST['first_lng']);
            $lan_second_value   = trim($_POST['last_lng']);            
            $cond               = " AND `type_short` IN('AT','DE') AND ST IN ('New','Price Change','Re-activated','Back on Market','Active')  AND ((LAT BETWEEN '".$lat_first_value."' AND '".$lat_second_value."') AND (LNG BETWEEN '".$lan_first_value."' AND '".$lan_second_value."')) ";
            $result             = $this->property_model->fetch($cond, "id,LAT,LNG,ST,LN");

            $map_data_list['lat_lng_list']  = array();        
            $polygon                        = array();
            $getCoordinatePoins             = array();
            $lngList                        = array();
            foreach( $_POST['latLngList'] as $k=>$v){
                $polygon[]=$v['lat']." ".$v['lng'];
            }
            $polygon[] = $_POST['latLngList'][0]['lat']." ".$_POST['latLngList'][0]['lng'];//// The last point's coordinates must be the same as the first one's, to "close the loop"

             foreach ($result as $key => $val) {
                 $point = $val['LAT']." ".$val['LNG'] ;
                 if($this->pointInPolygon($point, $polygon)){                 
                     $map_data_list['lat_lng_list'][] = array(
                        "property_id" => $val['id'],
                        "longitude" => $val['LNG'],
                        "latitude" => $val['LAT'],
                        "status"=>  strtolower($val['ST'])
                    );
                 }
             }
             if(count($result)>0){
                     $total_row = $this->session->userdata('total_property');
                     $total_row = $total_row+count($map_data_list['lat_lng_list']);
                     $this->session->set_userdata('total_property',$total_row);
                     $total_row = number_format($total_row);
             }
            $map_data_list['total_row']=$total_row;
            $map_data_list['for_this_shape_row']=count($map_data_list['lat_lng_list']);
            echo json_encode($map_data_list);
            exit();
        }
    }

    
    /** This is added on 27 March*/
 
    function pointInPolygon($point, $polygon, $pointOnVertex = true) {            
        
            //http://assemblysys.com/php-point-in-polygon-algorithm/
            // Transform string coordinates into arrays with x and y values
            $point = $this->pointStringToCoordinates($point);
            $vertices = array(); 
            foreach ($polygon as $vertex) {
                $vertices[] = $this->pointStringToCoordinates($vertex); 
            }

            // Check if the point sits exactly on a vertex
            if ($pointOnVertex == true and $this->pointOnVertex($point, $vertices) == true) {
                return "vertex";
            }

            // Check if the point is inside the polygon or on the boundary
            $intersections = 0; 
            $vertices_count = count($vertices);

            for ($i=1; $i < $vertices_count; $i++) {
                $vertex1 = $vertices[$i-1]; 
                $vertex2 = $vertices[$i];
                if ($vertex1['y'] == $vertex2['y'] and $vertex1['y'] == $point['y'] and $point['x'] > min($vertex1['x'], $vertex2['x']) and $point['x'] < max($vertex1['x'], $vertex2['x'])) { // Check if point is on an horizontal polygon boundary
                   return 1;
                    // return "boundary";
                }
                if ($point['y'] > min($vertex1['y'], $vertex2['y']) and $point['y'] <= max($vertex1['y'], $vertex2['y']) and $point['x'] <= max($vertex1['x'], $vertex2['x']) and $vertex1['y'] != $vertex2['y']) { 
                    $xinters = ($point['y'] - $vertex1['y']) * ($vertex2['x'] - $vertex1['x']) / ($vertex2['y'] - $vertex1['y']) + $vertex1['x']; 
                    if ($xinters == $point['x']) { // Check if point is on the polygon boundary (other than horizontal)
                         return 1;
                        //return "boundary";
                    }
                    if ($vertex1['x'] == $vertex2['x'] || $point['x'] <= $xinters) {
                        $intersections++; 
                    }
                } 
            } 
            // If the number of edges we passed through is odd, then it's in the polygon. 
            if ($intersections % 2 != 0) {
                return 1; // Inside
            } else {
                return 0; // Outside
            }
    }
 
    function pointOnVertex($point, $vertices) {
        foreach($vertices as $vertex) {
            if ($point == $vertex) {
                return true;
            }
        }
 
    }
 
    function pointStringToCoordinates($pointString) {
        $coordinates = explode(" ", $pointString);
        return array("x" => $coordinates[0], "y" => $coordinates[1]);
    }
 

    /******** For Save Saerch Start Here ********/
    
    public function selectboundaries2($search_id=''){
      
       //unset($_SESSION['shape_in_map_boundary']);
        //$this->session->unset_userdata('setMapBound');
//       / echo "<br>hi";
              //t($this->session->userdata('shapeListString'));
        // t($this->session->all_userdata());  
         //die("Shreyan");
        //$this->session->unset_userdata('shapeListString');  
        if($this->input->post('goto_search_page')=='1'){
             
              /* New Add Code Here On 31 March 2014 */
             
            $shape_list_obj     = json_decode($_POST['shapeListString']);
            $circle_cond        = '';
            $rectangle_cond     = '';
            $polygon_cond       = '';           
            $no_of_circle       = '0';
            $no_of_rectangle    = '0';
            $no_of_polygon      = '0';
            foreach( $shape_list_obj as $key => $val ){              
                if($val->type=='circle'){
                    $no_of_circle++;
                    $current_location_lat    = $val->center_lat;
                    $current_location_lng    = $val->center_lng;
                    $radius_miles            = trim($val->radious);    
                    $radius_miles            = ($radius_miles/1609.344);
                    $circle_cond            .= " (((acos(sin(('".$current_location_lat."'*pi()/180)) * sin((`LAT`*pi()/180))+cos(('".$current_location_lat."'*pi()/180)) * cos((`LAT`*pi()/180)) * cos((('".$current_location_lng."'- `LNG`)*pi()/180))))*180/pi())*60*1.1515) <= '".$radius_miles."' OR  "; 
                }
                if($val->type=='rectangle'){
                    $no_of_rectangle++;
                    $lat_first_value         = $val->south_west_lat; 
                    $lan_first_value         = $val->south_west_lng;
                    $lat_second_value        = $val->north_east_lat; 
                    $lan_second_value        = $val->north_east_lng;
                    $rectangle_cond         .=" ((LAT BETWEEN '".$lat_first_value."' AND '".$lat_second_value."') AND (LNG BETWEEN '".$lan_first_value."' AND '".$lan_second_value."')) OR ";   
                }
                if($val->type=='polygon'){
                    $no_of_polygon++;                    
                    $lat_first_value         = $val->south_west_lat; 
                    $lan_first_value         = $val->south_west_lng;
                    $lat_second_value        = $val->north_east_lat;
                    $lan_second_value        = $val->north_east_lng;
                    $polygon_cond           .=" ((LAT BETWEEN '".$lat_first_value."' AND '".$lat_second_value."') AND (LNG BETWEEN '".$lan_first_value."' AND '".$lan_second_value."')) OR ";   
                }
                
            }
           /* echo "Circle Cond:=".$circle_cond;
            echo "<br>Rectangle Cond:=".$rectangle_cond;
            echo "<br>Polygon Cond:=".$polygon_cond;
            echo "<br>**********************";
            echo "Final Con<br>";*/
             if( $no_of_circle > 0 || $no_of_rectangle > 0 || $no_of_polygon > 0 ) {
                 $final_cond = "( ".$circle_cond." ".$rectangle_cond." ".$polygon_cond." 1!=1 ) ";
             }else{
                  $final_cond = "( 1=1 )";
             }
            
             if($final_cond){
                $setMapBound=array('setMapBound'=>$final_cond);               
                $this->session->set_userdata($setMapBound);
             }
             if(count(json_decode($_POST['shapeListString'])) > 0 ){
                 //echo  $this->data['shape_data'];
                //echo $GLOBALS['shapeData']= $_POST['shapeListString'];
                // echo "bye";
                ///$this->somevar['msg'] = $_POST['shapeListString'];
                $_SESSION['shape_in_map_boundary'] = base64_encode ($_POST['shapeListString']);
               // die;
                //$dd = base64_encode ($_POST['shapeListString']);
                // $str = str_split($dd, 100);
                 //t($str);
                 //die;
                 //$shapeListString = array('shapeListString'=>$str);
                 //$this->session->set_userdata('shapeListString',$str);
               //  echo "see";
                 //t($this->session->userdata('shapeListString'));
                // die;
             }
               //  die;
             /* End Here */
                
        
        
           
            //t($this->session->all_userdata());  
            //die("aaa");
             //for check box add a session
            $this->session->set_userdata('is_check_search',1);
            if($this->input->post('search_id')!=''){
                $searchid = $this->input->post('search_id');
                redirect('property_email_alerts/residential_for_sale/'.$searchid);
            } else {
                redirect('propertysearch');
            }
           
           // redirect('mapsearch/selectboundaries2');
        } 
        if($this->input->post('center_map_lat_value')&& $this->input->post('center_map_lat_value')){                  
             
            $center_city_click          = $this->input->post('center_map_location');
            $latitude                   = $this->input->post('center_map_lat_value');
            $longitude                  = $this->input->post('center_map_lng_value');                 
            $this->data['address_type'] = $center_city_click;
            $this->data['LAT']          = $latitude;
            $this->data['LNG']          = $longitude;
            $center_map_city_name       = array('center_map_city_name'=>$center_city_click);               
            $this->session->set_userdata($center_map_city_name);

            $center_map_lat_lng         = array('center_map_lat'=>$latitude,'center_map_lng'=>$longitude); 
            $this->session->set_userdata($center_map_lat_lng);
          }
        if($this->input->post('shape_delete')=='yes'){ 
            $this->session->unset_userdata('setMapBound');  
            $this->session->unset_userdata('circle_list');
            $this->session->unset_userdata('rectangle_list');
            $this->session->unset_userdata('polygon_list');   
            redirect('mapsearch/selectboundaries');
        }
        if($this->input->post('reset_click')=='yes'){        
            $this->session->unset_userdata('center_map_city_name');
            $this->session->unset_userdata('setMapBound');  
            $this->session->unset_userdata('circle_list');
            $this->session->unset_userdata('rectangle_list');
            $this->session->unset_userdata('polygon_list');
            $this->session->unset_userdata('center_map_lat');
            $this->session->unset_userdata('center_map_lng');     
            redirect('mapsearch/selectboundaries');
        }    
        if($this->session->userdata('center_map_city_name')){           
            $center_city_click          = $this->session->userdata('center_map_city_name');
            $this->data['address_type'] = $center_city_click;
            $this->data['LAT']          = $this->session->userdata('center_map_lat');
            $this->data['LNG']          = $this->session->userdata('center_map_lng');
//             
//            $center_map_lat_lng         = array('center_map_lat'=>$latitude,'center_map_lng'=>$longitude); 
//            $this->session->set_userdata($center_map_lat_lng);
        }

        
        /* For All Shape List Start Here */
        if($search_id!=''){
            $search_id                           = base64_decode($search_id);
            $condsearch                          = " AND id='" . $search_id . "'";
            $fet_search                          = $this->saved_searches_model->fetch($condsearch,'searchquery');
            $searchquery                         = unserialize($fet_search[0]['searchquery']);
            $saved_shape_list                    = $searchquery['shape_draw_in_map_boundary'];
            $this->data['saved_shape_list']      = base64_decode($saved_shape_list);
            $this->data['search_id']             = $search_id;            
            
        }else if(isset($_SESSION['shape_in_map_boundary'])){              
            $this->data['saved_shape_list']     = base64_decode($_SESSION['shape_in_map_boundary']);
        }else {
            $this->data['saved_shape_list']     = '';
        }
        /* For ALl Sphae List End HEre */
        $this->data['circle_list']              = $this->session->userdata('circle_list');
        $this->data['rectangle_list']           = $this->session->userdata('rectangle_list');
        $this->data['polygon_list']             = $this->session->userdata('polygon_list');
               
        
        $this->data['set_meta']['title']        = "Select Map Boundaries";
        $this->data['set_meta']['description']  = "Map View";
        $this->data['set_meta']['keyword']      = "Map View";
        $this->data['viewtype']                 = 'map';
        $remove_header_open                     = '';
        $remove_header_open                     = "<script type='text/javascript'>";        
        $remove_header_open                    .= "document.getElementById('header_bar_toggle').remove();";
        //$remove_header_open                    .= "document.getElementById('header_bar_div').remove();";
        $remove_header_open                    .= "</script>";
        $this->data['remove_header_open']       = $remove_header_open;

        
        $this->get_include();
        $this->load->view('frontend/select_map_boundary_save',$this->data);
        
    }
    
    /***/
    ###################################################################################################################################################
    #                                                                                                                                                 #  
    #                                             Keep the map center fixed                                                                           #  
    #                                                                                                                                                 #  
    ###################################################################################################################################################
    public function keepTheCenterOftheMapAccordingToDrawnShape(){
        if($this->input->post('drawing_list_center_poistion')){
            $drawing_list_zoom_level                           = $this->input->post('drawing_list_zoom_level');
            $drawing_list_center_poistion                      = $this->input->post('drawing_list_center_poistion');
            $_SESSION['drawing_list_zoom_level']               = $drawing_list_zoom_level;
            $_SESSION['drawing_list_center_poistion']          = $drawing_list_center_poistion;
        }
    }
    ###################################################################################################################################################
    
 }// Class End Here


        