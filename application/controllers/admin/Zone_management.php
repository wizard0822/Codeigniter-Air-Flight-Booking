<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Zone_management extends MY_Controller {
	function __construct()
	{
		parent::__construct();
        $this->load->model('common_model');
	}
	public function index(){
        $usertype=$this->session->userdata('admin_data');
        $cond = "ORDER BY ID_ZoneEditor";
        $list = $this->common_model->fetch('ZoneEditor_tbl', $cond);
        $this->data['list'] = $list;
        $this->get_include();
        $this->load->view($this->viewDir."zone-management/index",$this->data);
    }
    function dechex6($dec) {
        $hex = dechex($dec);
        return str_repeat('0', 6-strlen($hex)).$hex;
    }
    public function load_sheet(){
        // load list of zones
    if( isset($_POST['load_sheet']) ) {

        $sheet_id = intval($_POST['load_sheet']);
        $ret = array();
        //$zones = sql_query('SELECT ID_ZoneCode,ID_Zone,Name,Colour,AsText(Zone) AS poly FROM sb_Zone_tbl WHERE ID_Sheet = '.$sheet_id.' ORDER BY ID_Zone');
        $select = "ID_ZoneCode,ID_Zone,Name,Colour,AsText(Zone) AS poly";
        $cond = "AND ID_Sheet = '$sheet_id'";
        $list = $this->common_model->fetch('sb_Zone_tbl', $cond, $select);
        // echo $this->db->last_query();
        // t($list,1);
        foreach ($list as $key => $z) {
            # code...
            $points = explode(',', str_replace(array('POLYGON((','))'),'', $z['poly']));
            if( $points[0]==$points[count($points)-1] ) // remove last double-point
                array_pop($points);
            $ret[] = (object) array(
                'rec_id'  => $z['ID_ZoneCode'],
                'id_zone' => $z['ID_Zone'],
                'name'    => $z['Name'],
                'colour'  => '#'.$this->dechex6($z['Colour']),
                'points'  => $points
            );
        }
        // while($z = mysqli_fetch_object($zones)){
            //$points = explode(',', str_replace(array('POLYGON((','))'),'', $z->poly));
            //print_r($points); echo $points[0].' == '.$points[count($points)-1];
            
       // }
        echo json_encode($ret);
        exit();
    }
    }
    public function add_new_sheet()
    {
        if( isset($_POST['new_sheet']) ) {

            $data_field['SheetName']=$this->input->post('name');
            $data_field['CentreLatitude']=$this->input->post('lat');
            $data_field['CentreLongitude']=$this->input->post('lng');
            $data_field['ZoomLevel']=$this->input->post('zoom');

                // $cond = "AND id=$id";
            // t($id);
            $add = $this->common_model->add('ZoneEditor_tbl', $data_field);
            // echo $this->db->last_query();
            if($add)
            {
                $sheet_id = $add;
                echo "sheet_id:'$sheet_id'" ;
            }
            else
            {
                echo "Error adding new sheet.";
            }
        //  echo 2;die;
        // if( sql_query('INSERT INTO ZoneEditor SET 
        //     SheetName="'.sql($_POST['name']).'",
        //     CentreLatitude="'.sql($_POST['lat']).'",
        //     CentreLongitude="'.sql($_POST['lng']).'",
        //     ZoomLevel="'.intval($_POST['zoom']).'"') )
        //      echo '{"sheet_id":"'.mysqli_insert_id($db_link).'"}';
        // else
        //     echo '{"message":"Error adding new sheet."}';
        exit();
    }
    } 
    public function center_sheet()
    {
        if( isset($_POST['center_sheet']) ) {
            $data_field['SheetName']=$this->input->post('name');
            $data_field['CentreLatitude']=$this->input->post('lat');
            $data_field['CentreLongitude']=$this->input->post('lng');
            $data_field['ZoomLevel']=$this->input->post('zoom');
            $id = $this->input->post('center_sheet');
            $cond="AND ID_ZoneEditor='$id'"; 
            $edit = $this->common_model->edit_cond('ZoneEditor_tbl', $data_field,$cond);
            if($edit)
            {
                $sheet_id = $id;
                echo $sheet_id;
            }
            else
            {
                echo "Error changing the sheet.";
            }
        // if( sql_query('UPDATE ZoneEditor SET 
        //     SheetName="'.sql($_POST['name']).'",
        //     CentreLatitude="'.sql($_POST['lat']).'",
        //     CentreLongitude="'.sql($_POST['lng']).'",
        //     ZoomLevel="'.intval($_POST['zoom']).'"
        //     WHERE ID_ZoneEditor = '.intval($_POST['center_sheet']) ) )
        //     echo '{"sheet_id":"'.intval($_POST['center_sheet']).'"}';
        // else
        //     echo '{"message":"Error changing the sheet."}';
        exit();
    }
    }
    public function get_sheet()
    {
        if( isset($_POST['get_sheet']) ) {
        // $r = sql_query('SELECT * FROM sb_ZoneEditor_tbl WHERE ID_ZoneEditor="'.intval($_POST['get_sheet']).'"');
        $cond = 'AND ID_ZoneEditor ="'.intval($_POST['get_sheet']).'" ';
        $list = $this->common_model->fetch('ZoneEditor_tbl', $cond);
        // t($list,1);
        if( count($list)>0 ) {
            echo json_encode( array(
                'sheet_id'=> $list[0]['ID_ZoneEditor'],
                'lat'     => $list[0]['CentreLatitude'],
                'lng'     => $list[0]['CentreLongitude'],
                'zoom'    => $list[0]['ZoomLevel']
            ) );
        } else
        {
            echo "No sheet found";
        } 
        exit();
    }
    }
    public function delete_sheet()
    {
        if( isset($_POST['delete_sheet']) ) {
        if( sql_query('DELETE FROM sb_ZoneEditor_tbl WHERE ID_ZoneEditor = '.intval($_POST['delete_sheet']) ) ) {
            sql_query('DELETE FROM sb_Zone_tbl WHERE ID_Sheet = '.intval($_POST['delete_sheet']) );
            $r = sql_query('SELECT ID_ZoneEditor FROM sb_ZoneEditor_tbl ORDER BY ID_ZoneEditor LIMIT 1');
            $f = mysqli_fetch_object($r);
            $sheet_id = $f->ID_ZoneEditor;
            echo '{$sheet_id}';
            //echo '{"sheet_id":"'.$f->ID_ZoneEditor.'"}';
        } else
            echo '{"Error deleting the sheet."}';
        exit();
    }
    }
    public function new_zone()
    {
        if( isset($_POST['new_zone']) ) {

            $data_field['ID_Sheet']=$this->input->post('id_sheet');
            $data_field['ID_Zone']=$this->input->post('id_zone');
            $data_field['Name']=$this->input->post('new_zone');
            $data_field['Colour']=intval(hexdec($this->input->post('colour')));

                // $cond = "AND id=$id";
            // t($id);
            $add = $this->common_model->add('Zone_tbl', $data_field);
            // echo $this->db->last_query();
            if($add)
            {
                $rec_id = $add;
                // echo $rec_id;
                echo '{"rec_id":"'.$rec_id.'"}';
            }
            // else
            // {
            //     echo "Error adding new sheet.";
            // }
            // sql_query('INSERT INTO Zone SET ID_Sheet="'.intval($_POST['id_sheet']).'",
            //             ID_Zone="'.intval($_POST['id_zone']).'", 
            //             Name="'.sql($_POST['new_zone']).'", 
            //             Colour="'.intval(hexdec($_POST['colour'])).'"'
            // );
            // echo '{"rec_id":"'.mysqli_insert_id($db_link).'"}';
            exit();
        }
    }
    //
    // save zone name
    public function save_name()
    {
        if( isset($_POST['save_name']) ) {
            

            $data_field['ID_Zone']=$_POST['id_zone'];
            $data_field['Name']=$_POST['save_name'];
            $cond='AND ID_ZoneCode="'.intval($_POST['rec_id']).'"';
                // $cond = "AND id=$id";
            // t($id);
            $add = $this->common_model->edit_cond('Zone_tbl', $data_field,$cond);
            echo '{"ok":"ok"}';
            exit();
        }
    }

    public function save_points()
    {
        if( isset($_POST['save_points']) ) {
            if( isset($_POST['points']) && count($_POST['points']) ) {
                $polygon = array();
                foreach($_POST['points'] AS $point)
                    $polygon[] = $point['lat'].' '.$point['lng'];
                $polygon[] = $polygon[0];

                $data_field['Zone']='PolyFromText("POLYGON(('.implode(',',$polygon).'))")';
                // $cond='AND ID_ZoneCode="'.intval($_POST['save_points']).'"';
                    // $cond = "AND id=$id";
                // t($id);
                // $add = $this->common_model->edit_cond('Zone_tbl', $data_field,$cond);

                $sql='UPDATE sb_Zone_tbl SET Zone=PolyFromText("POLYGON(('.implode(',',$polygon).'))") 
                    WHERE ID_ZoneCode="'.intval($_POST['save_points']).'"';
                $query = $this->db->query($sql);    
                echo $this->db->last_query();
               
            }
            echo '{"ok":"ok"}';
            exit();
        }
    }
    public function delete_zone()
    {
        if( isset($_POST['delete_zone']) ) {
            $cond=' AND ID_ZoneCode="'.intval($_POST['delete_zone']).'"';
            
            $add = $this->common_model->delete_cond('Zone_tbl', $cond);
            
            echo '{}';
            exit();
        }
    }

    public function save_colour()
    {
        if( isset($_POST['save_colour']) ) {

            $colour = trim($_POST['save_colour'],'#');
            $cond='AND ID_ZoneCode="'.intval($_POST['rec_id']).'"';
            $data_field['Colour']=hexdec($colour);
            $add = $this->common_model->edit_cond('Zone_tbl',$data_field, $cond);
            
            echo '{}';
            exit();
        }
    }
    // //
    // // save zone colour
    // //
    // elseif( isset($_POST['save_colour']) ) {
    //     $colour = trim($_POST['save_colour'],'#');
    //     sql_query('UPDATE Zone SET Colour="'.hexdec($colour).'" WHERE ID_ZoneCode="'.intval($_POST['rec_id']).'"');
    //     echo '{"ok":"ok"}';
    //     exit();
    // }
    // //
    // // save zone points
    // //
    // elseif( isset($_POST['save_points']) ) {
    //     if( isset($_POST['points']) && count($_POST['points']) ) {
    //         $polygon = array();
    //         foreach($_POST['points'] AS $point)
    //             $polygon[] = $point['lat'].' '.$point['lng'];
    //         $polygon[] = $polygon[0];
    //         sql_query($sql=('UPDATE Zone SET Zone=PolyFromText("POLYGON(('.implode(',',$polygon).'))") 
    //                 WHERE ID_ZoneCode="'.intval($_POST['save_points']).'"'));
    //     }
    //     echo '{"ok":"ok"}';
    //     exit();
    // }
    // //
    // // delete zone
    // //
    // elseif( isset($_POST['delete_zone']) ) {
    //     sql_query('DELETE FROM Zone WHERE ID_ZoneCode="'.intval($_POST['delete_zone']).'"');
    //     echo '{}';
    //     exit();
    // }
    // elseif( isset($_POST['delete_sheet']) ) {
    //     if( sql_query('DELETE FROM ZoneEditor WHERE ID_ZoneEditor = '.intval($_POST['delete_sheet']) ) ) {
    //         sql_query('DELETE FROM Zone WHERE ID_Sheet = '.intval($_POST['delete_sheet']) );
    //         $r = sql_query('SELECT ID_ZoneEditor FROM ZoneEditor ORDER BY ID_ZoneEditor LIMIT 1');
    //         $f = mysqli_fetch_object($r);
    //         echo '{"sheet_id":"'.$f->ID_ZoneEditor.'"}';
    //     } else
    //         echo '{"message":"Error deleting the sheet."}';
    //     exit();
    // }
}