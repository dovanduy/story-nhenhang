<?php
/**
 * Created by JetBrains PhpStorm.
 * User: tienn2t
 * Date: 5/4/14
 * Time: 10:14 PM
 * To change this template use File | Settings | File Templates.
 */
class Story_model extends CI_Model{
    public function __construct(){
        parent::__construct();
        $this->load->database('story',TRUE);
    }

    public function get($table,$query='',$select='',$sort_field='',$sort_type='DESC'){
        if($query!=''){
            $this->db->where($query);

        }
        if($select){
            $this->db->select($select);
        }
        if($sort_field!=''){
            $this->db->order_by($sort_field,$sort_type);
        }
        $result = $this->db->get($table);
        return $result->result_array();
    }
    /**
     * Function get one column from table
     * @param $table
     * @param $id
     * @param $var
     * @return mixed
     */
    function get_one($table, $id, $var)
    {
        return $this->db->query("select * from $table where $id='$var'");
    }

    /**
     * Function delete one row from table
     * @param $table
     * @param $idname
     * @param $id
     * @return mixed
     */
    function delete($table, $idname, $id)
    {
        $this->db->query("Delete from $table where $idname = $id");
        return $this->db->affected_rows();
    }

    /**
     * Function update data
     * @param $id_name
     * @param $id
     * @param $table
     * @param $data
     * @return mixed
     */
    function update($id_name, $id, $table, $data)
    {
        $this->db->where($id_name, $id);
        $this->db->update($table, $data);
        return $this->db->affected_rows();
    }

    /**
     * Function insert
     * @param $table
     * @param $data
     * @return mixed
     */
    function insert($table, $data)
    {
        $this->db->insert($table, $data);
        return $this->db->affected_rows();
    }

    /**
     * Function get data
     * @param $table
     * @param null $data
     * @param null $orderby
     * @param null $start
     * @param null $nums
     * @param null $desc
     * @param null $exp
     * @return mixed
     */
    function get_data($table, $data = NULL, $orderby = NULL, $start = NULL, $nums = NULL, $desc = NULL, $exp = NULL)
    {
        $where = '';
        if ($exp == null) $exp = '=';
        if ($data != null) {
            $where = ' where ';
            $i = 0;
            foreach ($data as $key => $value) {
                $where .= $key . $exp . "'" . $value . "'";
                $i++;
                if ($i < count($data)) {
                    $where .= " and ";
                }
            }
        }
        if ($start != null and $nums != null) {
            $limit = " limit ";
            $limit .= $start . "," . $nums;
        } else {
            $limit = "";
        }
        if ($desc == null) {
            $desc = ' asc ';
        }
        if ($orderby != null) {
            $result = $this->db->query("select * from {$table}  {$where} order by {$orderby} $desc " . $limit);
        } else {
            $result = $this->db->query("select * from {$table}  {$where} " . $limit);
        }

        return $result;
    }
    public function get_pagination($action,$table,$query,$limit='',$start='',$select='',$sort_field='',$sort_type='DESC'){
        if($query!=''){
            $this->db->where($query);
        }
        if($action=='total'){
            return $this->db->count_all_results($table);
        }else{
            if($limit!=''){
                $this->db->limit($limit,$start);
            }
            if($select!=''){
                $this->db->select($select);
            }
            if($sort_field!=''){
                $this->db->order_by($sort_field,$sort_type);
            }
            $result = $this->db->get($table);
            return $result->result_array();
        }
    }

    //function get data with condition
    public function getData($table,$item=FALSE){
        if($item!=FALSE){
            $this->db->where($item);
        }
        $query = $this->db->get($table);
        return $query->result_array();
    }
    //get data with in array condition
    public function get_where_in($table,$key,$in_array){
        $this->db->where_in($key,$in_array);
        $query = $this->db->get($table);
        return $query->result_array();
    }


    /**
     * Function delete all data in table
     * @param $table
     */
    function deleteAll($table){
        $this->db->empty_table(''.$table.'');
    }

    /**
     * function insert and return id of effected row
     */
    function insertData($table,$data){
        $this->db->insert($table,$data);
        return $this->db->insert_id();
    }

    /**
     * insert batch data
     */
    public function insert_batch($table,$data){
        $this->db->insert_batch($table,$data);
        return $this->db->affected_rows();
    }
}