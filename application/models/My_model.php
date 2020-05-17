<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class My_model extends CI_Model{

    public function get_all($table, $sort = null, $limit = null, $start = null){
        $this->db->order_by($sort);
        return $this->db->get($table, $limit, $start);
    }

    public function get_where($table, $where, $order = null) { 
        $this->db->order_by($order);
        return $this->db->get_where($table, $where);
    }

    public function store($table, $data) { 
        return $this->db->insert($table, $data);
    }

    public function update($table, $data, $where) { 
        return $this->db->update($table, $data, $where);
    }

    public function delete($table, $where) { 
        $this->db->delete($table, $where);
        return $this->db->affected_rows();
    }

    public function search($table,$search) { 
        $this->db->like($search);
        $this->db->or_like($search);
        return $this->db->get($table);
    }

    public function query($query) { 
        return $this->db->query($query);
    }

    public function get_all_join($table,$select,$join) { 
        $this->db->select($select);
        $this->db->from($table);
        $this->db->join($join[0],$join[1]);
        return $this->db->get();
    }
}