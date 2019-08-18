<?php

function show_message(){        
    $ci_instane = & get_instance();
    if ($ci_instane->session->flashdata('success_message')) { 
        echo $ci_instane->session->flashdata('success_message');
    } elseif ($ci_instane->session->flashdata('error_message')) { 
        echo $ci_instane->session->flashdata('error_message');
    } 
}

function create_unique_slug($string,$table,$field,$key=NULL,$value=NULL,$count=0)
    { //echo $string;exit;
        $ci =& get_instance();
        
        $slug=strtolower(url_title($string)); 
    
        $params = array ();
        
        $params[$field] = $slug;
        
        if($count!=0)$params[$field] = $slug.$count;
        
        if($key)$params["$key !="] = $value;
        //print_r($params); die();
        if($ci->db->where($params)->get($table)->num_rows()>0)
        {
            //echo $ci->db->last_query();die;
            $count++;
            return create_unique_slug($string,$table,$field,$key,$value,$count);
        }
        else
        {
            if($count == 0)
            {
                return $slug;
            }
            else
            {
                return $slug.$count;
            }
        }
        
    } 
function sub_str($str_content,$num_of_words_to_show,$symbol_to_more='.',$num_of_symbols=3) 
    {
        $db =& get_instance();
        $subword_output ='';
        $str_arr_num=0;
        $smbl_to_mr = '';
        $str_arr = explode(' ',$str_content);
        for($str_arr_num=0;$str_arr_num < $num_of_words_to_show;$str_arr_num++)
        {
            $subword_output = $subword_output.$str_arr[$str_arr_num].' ';
        }
        for($smbl_num=0;$smbl_num < $num_of_symbols;$smbl_num++)
        {
            $smbl_to_mr = $smbl_to_mr.$symbol_to_more;
        }
        $subword_output = $subword_output.$smbl_to_mr;
        
        return $subword_output; 
    }


?>