<?php
namespace App\Http;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
if ($_SERVER['HTTP_HOST'] == "localhost:8000" || $_SERVER['HTTP_HOST'] == "127.0.0.1:8000") {
    define('DIR_HTTP_CURRENT_PAGE', "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
    define('DIR_HTTP_HOME', "http://" . $_SERVER['HTTP_HOST'] . "/");
    define('DIR_WS_HOME', $_SERVER['DOCUMENT_ROOT']."\\");

    define('DIR_HTTP_CSS', DIR_HTTP_HOME . "css/");
    define('DIR_HTTP_JS', DIR_HTTP_HOME . "js/");
    define('DIR_HTTP_VENDOR', DIR_HTTP_HOME . "vendor/");

    define('DIR_HTTP_IMAGES', DIR_HTTP_HOME . "images/");
    define('DIR_WS_IMAGES', DIR_WS_HOME. "images\\");

    define('DIR_HTTP_CATEGORY_IMAGES', DIR_HTTP_IMAGES . "category/");
    define('DIR_WS_CATEGORY_IMAGES', DIR_WS_IMAGES. "category\\");

    define('DIR_HTTP_PRODUCT_IMAGES', DIR_HTTP_IMAGES . "product/");
    define('DIR_WS_PRODUCT_IMAGES', DIR_WS_IMAGES. "product\\");

    define('DIR_HTTP_SLIDER_IMAGES', DIR_HTTP_IMAGES . "slider/");
    define('DIR_WS_SLIDER_IMAGES', DIR_WS_IMAGES. "slider\\");

    define('DIR_HTTP_CSV', DIR_HTTP_IMAGES . "sample/");
    define('DIR_WS_CSV', DIR_WS_IMAGES. "sample\\");

    define('DIR_HTTP_UPLOAD', DIR_HTTP_IMAGES . "csv/");
    define('DIR_WS_UPLOAD', DIR_WS_IMAGES. "csv\\");

    define('DIR_HTTP_TEMPIMAGES', DIR_HTTP_IMAGES . "tempimages/");
    define('DIR_WS_TEMPIMAGES', DIR_WS_IMAGES. "tempimages\\");

    define('DIR_HTTP_USER_IMAGES', DIR_HTTP_IMAGES . "user/");
    define('DIR_WS_USER_IMAGES', DIR_WS_IMAGES. "user\\");

    define('DIR_HTTP_ASSETS', DIR_HTTP_HOME . "assets/");
    define('DIR_WS_ASSETS', DIR_WS_HOME. "assets\\");
} else {
    define('DIR_HTTP_CURRENT_PAGE', "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
    define('DIR_HTTP_HOME', "http://" . $_SERVER['HTTP_HOST'] . "/public/");
    define('DIR_WS_HOME', $_SERVER['DOCUMENT_ROOT']."/public/");

    define('DIR_HTTP_CSS', DIR_HTTP_HOME . "css/");
    define('DIR_HTTP_JS', DIR_HTTP_HOME . "js/");
    define('DIR_HTTP_VENDOR', DIR_HTTP_HOME . "vendor/");

    define('DIR_HTTP_IMAGES', DIR_HTTP_HOME . "images/");
    define('DIR_WS_IMAGES', DIR_WS_HOME. "images/");

    define('DIR_HTTP_CATEGORY_IMAGES', DIR_HTTP_IMAGES . "category/");
    define('DIR_WS_CATEGORY_IMAGES', DIR_WS_IMAGES. "category/");

    define('DIR_HTTP_PRODUCT_IMAGES', DIR_HTTP_IMAGES . "product/");
    define('DIR_WS_PRODUCT_IMAGES', DIR_WS_IMAGES. "product/");

    define('DIR_HTTP_SLIDER_IMAGES', DIR_HTTP_IMAGES . "slider/");
    define('DIR_WS_SLIDER_IMAGES', DIR_WS_IMAGES. "slider/");

    define('DIR_HTTP_CSV', DIR_HTTP_IMAGES . "sample/");
    define('DIR_WS_CSV', DIR_WS_IMAGES. "sample/");

    define('DIR_HTTP_UPLOAD', DIR_HTTP_IMAGES . "csv/");
    define('DIR_WS_UPLOAD', DIR_WS_IMAGES. "csv/");

    define('DIR_HTTP_TEMPIMAGES', DIR_HTTP_IMAGES . "tempimages/");
    define('DIR_WS_TEMPIMAGES', DIR_WS_IMAGES. "tempimages/");

    define('DIR_HTTP_ASSETS', DIR_HTTP_HOME . "assets/");
    define('DIR_WS_ASSETS', DIR_WS_HOME. "assets/");
}

function draw_action_menu($action_links) {
    $html = '';
    $html .= '<div class="btn-group">
                <button data-toggle="dropdown" class="btn btn-sm btn-white dropdown-toggle" aria-expanded="false">
                    Action
                    <span class="ace-icon fa fa-caret-down icon-on-right"></span>
                </button>
                <ul class="dropdown-menu dropdown-info dropdown-menu-right action-menu">';
    foreach ($action_links as $key => $value) {
        $class = '';
        if(isset($value['class'])) {
            $class = $value['class'];
        }
        $html .= "<li>
                    <a href='{$value['link']}' class='$class'><i class='{$value['icon']}'></i>$key</a>
                </li>";
    }  
    $html .= '</ul></div>';
    return $html;
}

function draw_breadcrumb($breadcrubs_arr) {
    $html = '<li>
                <i class="ace-icon fa fa-home home-icon"></i>
                <a href="'.URL::to('dashboard').'">Home</a>
            </li>';
    foreach ($breadcrubs_arr as $key => $value) {
        if($value['active'] == true) {
            $html .= '<li class="active">'.$value['title'].'</li>';
        } else {
            $html .= '<li>
                        <a href="'.URL::to($value['route']).'">'.$value['title'].'</a>
                    </li>';
        }
    }
    return $html;
}

function draw_action_buttons($action_buttons) {
    $html = '';
    foreach($action_buttons as $key => $item) {
        $html .= "<a href=".URL::to($item['link'])." class='btn btn-app {$item['class']}'>
                    <i class='{$item['icon']}'></i>
                    $key
                </a>";
    }
    return $html;
}

function draw_form_buttons($submit_buttons) {
    $submit_buttons = explode(',', $submit_buttons);
    $html = '<div class="btn-group pull-right">';
    foreach ($submit_buttons as $key => $value) {
        switch ($value) {
            case 'save':
                $html .= '<button class="btn btn-sm btn-info formsubmit" id="formSubmit">
                            <i class="ace-icon far fa-save"></i>
                            Save
                        </button>';
                break;
            case 'back':
                $html .= '<button class="btn btn-sm formsubmit" id="backBtn">
                            <i class="ace-icon fa fa-arrow-left"></i>
                            Back
                        </button>';
                break;
            case 'save_back':
                $html .= '<button class="btn btn-sm btn-info formsubmit" id="formSubmitBack">
                            <i class="ace-icon fa fa-arrow-left"></i>
                            Save & Back
                        </button>';
                break;
        }
    }
    $html .= '<button class="btn btn-sm" id="formReset">
                <i class="ace-icon fa fa-history"></i>
                Reset
            </button>';
    $html .= '</div>';
    return $html;
}

function draw_table_checkbox($id) {
    return "<input name='form-field-checkbox' type='checkbox' id ='table:$id' class='ace table_checkbox'><span class='lbl'></span>";
}

function extract_search_field(Request $request) {
    $array = '';
    if($request->input('data')) {
        parse_str($request->input('data'), $array);
    }
    return $array;
}