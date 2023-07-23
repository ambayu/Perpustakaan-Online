<?php
function is_logged_in()
{
    $ci = get_instance();
    if (!$ci->session->userdata('username')) {
        redirect('auth');
    } else {
        $role_id = $ci->session->userdata('level');
        $menu = $ci->uri->segment(1);

        $queryMenu = $ci->db->get_where('user_menu', ['menu' => $menu])->row_array();
        $menu_id = $queryMenu['id'];
        $userAcces = $ci->db->get_where('tbl_acces_menu', ['level' => $role_id

            , 'menu_id' => $menu_id,
        ])->num_rows();

        if ($userAcces < 1) {
            redirect('auth/bloked');
        }
    }
}
function check_access($role_id, $menu_id)
{

    $ci = get_instance();

    $ci->db->where('level', $role_id);

    $ci->db->where('menu_id', $menu_id);
    $result = $ci->db->get('tbl_acces_menu');
    if ($result->num_rows() > 0) {
        return "checked='checked'";
    }
}