<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Configuration_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    public function insert($table, $data)
    {
        $this->db->insert($table, $data);
    }
    public function edit($where, $table)
    {
        return $this->db->get_where($table, $where);
    }
    public function update($id, $data, $table)
    {
        $this->db->where($id);
        $this->db->update($table, $data);
    }
    public function delete($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table,);
    }

    //-- Configuration --//

    public function getConfig()
    {
        return $this->db->get_where('configuration')->row_array();
    }

    //-- Menu & Submenu --//

    public function getMenuId($id)
    {
        $response = false;
        $query = $this->db->get_where('sidebar_menu', array('id' => $id));
        if ($query && $query->num_rows()) {
            $response = $query->result();
        }
        return $response;
    }
    public function getSubMenu()
    {
        $query = "SELECt `sidebar_submenu`.*, `sidebar_menu`.`menu`
                FROM `sidebar_submenu` JOIN `sidebar_menu`
                ON `sidebar_submenu`.`menu_id` = `sidebar_menu`.`id`";

        return $this->db->query($query)->result_array();
    }
    public function edit_submenu($id)
    {
        $result = $this->db->where('id', $id)->get('sidebar_submenu');
        if ($result->num_rows() > 0) {
            return $result->result();
        } else {
            return false;
        }
    }

    //-- Slider --//

    public function slider()
    {
        $this->db->order_by('id_slider', 'desc');
        return $this->db->get('slider_settings')->result_array();
    }
    public function getSlider()
    {
        return $this->db->get('slider_settings')->result();
    }
    public function getApiSlider()
    {
        $this->db->where('slider_settings.is_active', '1');
        return $this->db->get('slider_settings')->result_array();
    }
    public function detailSlider($id)
    {
        $this->db->select('*')
            ->from('slider_settings')
            ->where('id_slider', $id)
            ->order_by('id_slider', 'desc');
        $query = $this->db->get();
        return $query->row();
    }

    //-- Background --//

    public function getBackground()
    {
        return $this->db->get('background_settings')->result();
    }
    public function getBgHome()
    {
        $this->db->select('*')
            ->from('background_settings')
            ->where('name', 'Shop');
        $query = $this->db->get();
        return $query->row();
    }

    //-- About --//

    public function getAbout()
    {
        return $this->db->get_where('about')->row_array();
    }

    //-- Gallery --//

    public function getGallery()
    {
        $this->db->order_by('id', 'desc');
        return $this->db->get('gallery')->result_array();
    }
    public function homepageGallery()
    {
        $this->db->order_by('id', 'desc');
        $this->db->where('gallery.status', 'displayed');
        return $this->db->get('gallery')->result_array();
    }
    public function detailGallery($id)
    {
        $this->db->select('*')
            ->from('gallery')
            ->where('id', $id)
            ->order_by('id', 'desc');
        $query = $this->db->get();
        return $query->row();
    }

    //-- Service --//

    public function getService()
    {
        $this->db->order_by('id', 'desc');
        return $this->db->get('service')->result_array();
    }
    public function homepageService()
    {
        $this->db->order_by('id', 'desc');
        $this->db->where('service.status', 'displayed');
        $this->db->limit(3);
        return $this->db->get('service')->result_array();
    }
    public function detailService($id)
    {
        $this->db->select('*')
            ->from('service')
            ->where('id', $id)
            ->order_by('id', 'desc');
        $query = $this->db->get();
        return $query->row();
    }
}
