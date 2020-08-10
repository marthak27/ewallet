<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Balance_m extends CI_Model {

    public function __construct() {
        parent::__construct();
        
        // Load the database library
        $this->load->database();
        
        $this->userBalanceTbl = 'user_balance';
    }

    /*
     * Get rows from the users table
     */

    function get_list_balance()
    {
        return $this->db->get('user_balance');
    }
    
    function getRows($params = array()){
        $this->db->select('*');
        $this->db->from($this->userBalanceTbl);
        
        //fetch data by conditions
        if(array_key_exists("conditions",$params)){
            foreach($params['conditions'] as $key => $value){
                $this->db->where($key,$value);
            }
        }
        
        if(array_key_exists("id",$params)){
            $this->db->where('id',$params['id']);
            $query = $this->db->get();
            $result = $query->row_array();
        }else{
            //set start and limit
            if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
                $this->db->limit($params['limit'],$params['start']);
            }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
                $this->db->limit($params['limit']);
            }
            
            if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){
                $result = $this->db->count_all_results();    
            }elseif(array_key_exists("returnType",$params) && $params['returnType'] == 'single'){
                $query = $this->db->get();
                $result = ($query->num_rows() > 0)?$query->row_array():false;
            }else{
                $query = $this->db->get();
                $result = ($query->num_rows() > 0)?$query->result_array():false;
            }
        }
    }
    
    public function insert($data){
    
        if(!array_key_exists("created", $data)){
            $data['created'] = date("Y-m-d H:i:s");
        }
        if(!array_key_exists("modified", $data)){
            $data['modified'] = date("Y-m-d H:i:s");
        }
        
        $insert = $this->db->insert($this->userBalanceTbl, $data);
        
        return $insert?$this->db->insert_id():false;
    }
    
    
    public function update($data, $id){
        
        if(!array_key_exists('modified', $data)){
            $data['modified'] = date("Y-m-d H:i:s");
        }

        $update = $this->db->update($this->userBalanceTbl, $data, array('id'=>$id));
        
        return $update?true:false;
    }

    public function update_balance($data, $id){
        if(!array_key_exists('modified', $data)){
            $data['modified'] = date("Y-m-d H:i:s");
        }
        
        // $this->db->where('id', $userID);
        // $this->db->where('status', 1);
        $update = $this->db->update($this->userBalanceTbl, $data, array('id'=>$id, 'status'=>1));

        return $update?true:false;
    }
    
    
    public function delete($id){
        $delete = $this->db->delete('user_balance',array('id'=>$id));
        return $delete?true:false;
    }

}