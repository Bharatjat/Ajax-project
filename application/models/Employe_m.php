<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Employe_m extends CI_Model
{
    public function search()
    {
        $key = $this->input->POST('SearchValue', true);
        $search = $key;
        if (is_numeric($key)) {
            $key = "id";
        } else {
            $key = "name";
        }
        $this->db->order_by('id', 'desc');
        $query = $this->db->get_where('test-1', array($key => $search, 'status' => '1'));
        if ($this->db->affected_rows()) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    public function AddEmploye()
    {
        $field = array(
            'name' => $this->input->POST('NewName'),
            'address' => $this->input->POST('NewAddress'),
            'created_on' => date('Y-m-d H:i:s')
        );
        $this->db->insert('test-1', $field);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function showAllEmployee()
    {
        $this->db->order_by('id', 'desc');
        $query = $this->db->get_where('test-1', array('status' => '1'));
        if ($this->db->affected_rows()) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    public function editEmployee()
    {
        $field = array(
            'name' => $this->input->POST('EditName'),
            'address' => $this->input->POST('EditAddress'),
            'ModefiedOn' => date('Y-m-d H:i:s')
        );
        $this->db->where('id', $this->input->post('EditId'));
        $this->db->update('test-1', $field);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteEmployee()
    {
        $id = $this->input->POST('id');
        $delete = array(
            'status' => 2,
            'ModefiedOn' => date('Y-m-d H:i:s')
        );;
        // $this->db->get('test-1');
        $this->db->where('id', $id);
        $this->db->update('test-1', $delete);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
}
