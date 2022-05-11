<?php

namespace App\Helpers;

use Illuminate\Support\Str;


class Helper{
    public static function menu($menus, $parent_id = 0, $char = '')
    {
        $html = '';

        foreach ($menus as $key => $menu) {
            if ($menu->parent_id == $parent_id) {
                $html .= '
                    <tr>
                        <td>' . $menu->id . '</td>
                        <td>' . $char . $menu->name . '</td>
                        <td>' . self::active($menu->active) . '</td>
                        <td>' . $menu->updated_at . '</td>
                        <td>
                            <a class="btn btn-primary btn-sm" href="/admin/menu/edit/' . $menu->id . '">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="#" class="btn btn-danger btn-sm"
                                onclick="removeRow(' . $menu->id . ', \'/admin/menu/destroy\')">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                ';

                unset($menus[$key]);

                $html .= self::menu($menus, $menu->id, $char . '|--');
            }
        }

        return $html;
    }

    public static function active($active = 0): string
    {
        return $active == 0 ? '<span class="btn btn-danger btn-xs">NO</span>'
            : '<span class="btn btn-success btn-xs">YES</span>';
    }


    public static function Users($is_admin = 0): string
    {
        return $is_admin == 0 ? '<span class="btn btn-danger btn-xs">User</span>'
            : '<span class="btn btn-success btn-xs">Admin</span>';
    }

    public static function activeCustomer($active = 0): string
    {
        if($active == 1){
            return '<span class="btn btn-danger btn-xs">Đã huỷ</span>';
        }
        else if($active == 2){
            return'<span class="btn btn-primary btn-xs">Chờ xác nhận</span>';
        }
        else if($active == 3){
            return'<span class="btn btn-warning btn-xs">Đang vận chuyển</span>';
        }
        else{
            return '<span class="btn btn-success btn-xs">Đã hoàn thành</span>';
        }
        
    }
    public static function menus($menus, $parent_id = 0) :string
    {   
        $html = '';
        foreach ($menus as $key => $menu) {
            if ($menu->parent_id == $parent_id) {
                $html .= '
                    <li>
                        <a class="text-decoration-none" 
                            href="/danh-muc/' . $menu->id . '-' . Str::slug($menu->name, '-') . '.html">
                            <span> ' . $menu->name . '</span>
                           
                        </a>
                        <div class="cat-brand-menu ">';

                unset($menus[$key]);

                if (self::isChild($menus, $menu->id)) {
                    $html .= '<ul class="cat-menu ">';
                    $html .= self::menus($menus, $menu->id);
                    $html .= '</ul>';
                    $html .= '</div>';
                }

                $html .= '</li>';
            }
        }

        return $html;
    }

    public static function isChild($menus, $id) : bool
    {
        foreach ($menus as $menu) {
            if ($menu->parent_id == $id) {
                return true;
            }
        }
        return false;
    }
}
