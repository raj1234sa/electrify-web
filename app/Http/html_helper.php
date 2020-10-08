<?php

namespace App\Http;

use Illuminate\Support\Facades\URL;

function draw_action_menu($action_links)
{
    $html = '';
    $html .= '<div class="btn-group">
                <button data-toggle="dropdown" class="btn btn-sm btn-white dropdown-toggle" aria-expanded="false">
                    Action
                    <span class="ace-icon fa fa-caret-down icon-on-right"></span>
                </button>
                <ul class="dropdown-menu dropdown-info dropdown-menu-right action-menu">';
    foreach ($action_links as $key => $value) {
        $class = '';
        if (isset($value['class'])) {
            $class = $value['class'];
        }
        $html .= "<li>
                    <a href='{$value['link']}' class='$class'><i class='{$value['icon']}'></i>$key</a>
                </li>";
    }
    $html .= '</ul></div>';
    return $html;
}

function draw_breadcrumb($breadcrubs_arr)
{
    $html = '<li>
                <i class="ace-icon fa fa-home home-icon"></i>
                <a href="' . URL::to('dashboard') . '">Home</a>
            </li>';
    foreach ($breadcrubs_arr as $key => $value) {
        if ($value['active'] == true) {
            $html .= '<li class="active">' . $value['title'] . '</li>';
        } else {
            $html .= '<li>
                        <a href="' . URL::to($value['route']) . '">' . $value['title'] . '</a>
                    </li>';
        }
    }
    return $html;
}

function draw_action_buttons($action_buttons)
{
    $html = '';
    foreach ($action_buttons as $key => $item) {
        $html .= "<a href=" . URL::to($item['link']) . " class='btn btn-app {$item['class']}'>
                    <i class='{$item['icon']}'></i>
                    $key
                </a>";
    }
    return $html;
}

function draw_form_buttons($submit_buttons, $extra = array())
{
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
                if (isset($extra['backUrl']) && !empty($extra['backUrl']))
                    $html .= '<a class="btn btn-sm" href="' . $extra['backUrl'] . '">
                            <i class="ace-icon fa fa-arrow-left"></i>
                            Back
                        </a>';
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

function draw_table_checkbox($id)
{
    return "<input name='form-field-checkbox' type='checkbox' id ='table:$id' class='ace table_checkbox'><span class='lbl'></span>";
}

function show_download_button($url)
{
    $html = '';
    if (!empty($url)) {
        $html = "<a href='$url' class='btn btn-success' download=''><i class='fas fa-download ace-icon'></i>Download File</a>";
    }
    return $html;
}

function show_upload_button($url)
{
    $html = '';
    $csrf = csrf_token();
    if (!empty($url)) {
        $html = '<form id="upload_form" enctype="multipart/form-data">';
        $html .= "<div class='upload-div'>";
        $html .= "<a data-upload-route='$url' class='btn btn-success upload-import'><i class='fas fa-upload ace-icon'></i>Upload File</a>";
        $html .= "</div>";
        $html .= "<div class='hide'>";
        $html .= "<input type='text' class='' value='$csrf' name='_token'>";
        $html .= "<input type='file' class='' name='import_csv' id='import_csv' accept='text/csv'>";
        $html .= '<label id="fileName"></label>';
        $html .= "</div>";
        $html .= '</form>';
    }
    return $html;
}
