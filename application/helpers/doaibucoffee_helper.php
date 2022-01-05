<?php

function is_logged_in()
{
    $ci = get_instance();
    if (!$ci->session->userdata('email')) {
        redirect('auth');
    };
}

function check_access($role_id, $menu_id)
{
    $ci = get_instance();

    $ci->db->where('role_id', $role_id);
    $ci->db->where('menu_id', $menu_id);
    $result = $ci->db->get('user_access_menu');

    if ($result->num_rows() > 0) {
        return "checked='checked'";
    }
}

function escape($string)
{
    if (!empty($string) && is_string($string)) {
        $string = trim($string);
        $string = str_replace(array('\\', "\0", "\n", "\r", "'", '"', "\x1a"), array('\\\\', '\\0', '\\n', '\\r', "\\'", '\\"', '\\Z'), $string);

        return strip_tags($string);
    } else {
        return $string;
    }
}

function generate_code($prefix, $num, $length = 3)
{
    $add_code = (int)filter_var($num, FILTER_SANITIZE_NUMBER_INT) + 1;
    $num_code = str_pad($add_code, $length, "0", STR_PAD_LEFT);
    return $prefix . $num_code;
}
