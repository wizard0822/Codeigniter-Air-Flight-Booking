<?php
/**
 * Class MY_Model inherites all the property from CI_Model class and
 * Contain some function which we require commonly for every tables 
 * are listed below.
 */
class MY_Model extends CI_Model
{
	
	function __construct(){
		parent::__construct();
	}

	/**
	 * [fetch Function is used to fetch all the records matches condition.]
	 * @param  string  $table  [table name]
	 * @param  string  $cond   [condtion query string]
	 * @param  string  $select [comma sperated string containg field name]
	 * @param  integer $limit  [limit value]
	 * @param  integer $offset [offset value]
	 * @return array           [returns array which are matched]
	 */
	public function fetch($table,$cond='',$select='*', $limit='', $offset=''){
		if(empty($table)){
			die('Error Table Not Found');
		}

		if ($cond) {
			$where = '1 '.$cond;
            $this->db->where($where,null,false);
        }
        $this->db->select($select);
         
        if($limit!=0){
        	$this->db->limit($limit, $offset);
        }

        $query = $this->db->get($table);
        return $query->result_array();
	}

	/**
	 * [add function helps in inserting the recors to table.]
	 * @param   string $table      [table name ]
	 * @param   array  $data_field [array of all the fields which are to be inserted.]
	 * @return  integer [return last row id.]
	 */
	public function add($table,$data_field = array()){
		if(empty($table)){
			die('Error Table Not Found');
		}

        $this->db->insert($table,$data_field);
        return $this->db->insert_id();
    }

    
    
    
        /**
     * [edit_cond function helps in updating the record.]
     * @param  string $table      [table name]
     * @param  array  $data_field [array of all the fields which are to be updated]
     * @param  [type] $cond       [string based on which above fields will be updated.]
     * @return integer            [Returns affected rows.]
     */
        public function edit_cond($table,$data_field=array(),$cond){
    	if(empty($table)){
			die('Error Table Not Found');
		}

		if(empty($cond)){
			die("Edit Condition Not There");
		}

        $where = ' 1 '.$cond;
        $this->db->where($where, null, false);
        $re=$this->db->update($table, $data_field);
        return $re;
    }  

        /**
     * [count_cond function is used to count all records according to the condition provided]
     * @param  string $table [table name]
     * @param  string $cond  [comma seprated string starting with and.]
     * @return integer       [no of rows.]
     */
         public function count_cond($table,$cond){
    	if(empty($table)){
			die('Error Table Not Found');
		}

		if(empty($cond)){
			die("Edit Condition Not There");
		}

		$where = ' 1 '.$cond;
        $this->db->where($where, null, false);
        return $this->db->count_all_results($table);
    }

        /**
     * [count_all function returns total no of records present in table.]
     * @param  string $table [table name]
     * @return integer       [no of rows.]
     */
	public function count_all($table){
    	if(empty($table)){
			die('Error Table Not Found');
		}

    	return $this->db->count_all_results($table);
    }

        /**
     * [delete_cond function is used to delete the records which matches the condition.]
     * @param  string $table [table name]
     * @param  string $cond  [comma sperated string]
     * @return integer       [return no of affected row]
     */
        public function delete_cond($table,$cond){
    	if(empty($table)){
			die('Error Table Not Found');
		}

		if(empty($cond)){
			die("Edit Condition Not There");
		}

    	$where = ' 1 ' . $cond;
        $this->db->where($where, NULL, false);
        $this->db->delete($table);
        return $this->db->affected_rows();
    }

    


}