<?php
/**
 * Created by PhpStorm.
 * User: sebastian
 * Date: 21.10.14
 * Time: 13:09
 */

class Helpers {

    public static function servant_status($status)
    {
        if ($status) {
            $text = 'Aktywny';
            $class = 'status-active';
        } else {
            $text = 'Nieaktywny';
            $class = 'status-inactive';
        }
        return '<span class="'.$class.'">'.$text.'</span>';
    }

    public static function avatar($servant)
    {
        if (!empty($servant->avatar)) {
            return 'http://azm_panel.dgreen.pl/uploads/servant/avatar/' . $servant->id .'/'. $servant->avatar;
        } else {
            return 'http://img834.imageshack.us/img834/6807/3588i.jpg';
        }
    }
} 