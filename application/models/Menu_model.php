<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu_model extends CI_Model
{
    public function SubMenu()
    {
        $query = "SELECT a.id,a.menu_id,a.title,a.url,a.icons,b.menu,b.id as idme from user_sub_menu a
        left join user_menu b on a.menu_id=b.id order by a.id ASC";
        return $this->db->query($query)->result_array();
    }
    public function Account()
    {
        $query = "SELECT a.*,b.id as ids,b.menu from tbl_pengguna a
        left join user_menu b on a.level=b.id order by b.id ASC";
        return $this->db->query($query)->result_array();
    }

    public function icons()
    {
        $query = "SELECT * from tbl_surat a left join tbl_icon b on a.type=b.type";
        return $this->db->query($query)->result_array();

    }

}