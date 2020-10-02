<?php

namespace App\Http;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

define('DIR_HTTP_CURRENT_PAGE', "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
define('DIR_HTTP_ROUTENAME', substr($_SERVER['REQUEST_URI'], strpos($_SERVER['REQUEST_URI'], '/') + 1));

if ($_SERVER['HTTP_HOST'] == "localhost:8000" || $_SERVER['HTTP_HOST'] == "127.0.0.1:8000") {
    define('DIR_HTTP_HOME', "http://" . $_SERVER['HTTP_HOST'] . "/");
    define('DIR_WS_HOME', $_SERVER['DOCUMENT_ROOT'] . "\\");

    define('DIR_HTTP_CSS', DIR_HTTP_HOME . "css/");
    define('DIR_HTTP_JS', DIR_HTTP_HOME . "js/");
    define('DIR_HTTP_VENDOR', DIR_HTTP_HOME . "vendor/");

    define('DIR_HTTP_IMAGES', DIR_HTTP_HOME . "images/");
    define('DIR_WS_IMAGES', DIR_WS_HOME . "images\\");

    define('DIR_HTTP_CATEGORY_IMAGES', DIR_HTTP_IMAGES . "category/");
    define('DIR_WS_CATEGORY_IMAGES', DIR_WS_IMAGES . "category\\");

    define('DIR_HTTP_PRODUCT_IMAGES', DIR_HTTP_IMAGES . "product/");
    define('DIR_WS_PRODUCT_IMAGES', DIR_WS_IMAGES . "product\\");

    define('DIR_HTTP_SLIDER_IMAGES', DIR_HTTP_IMAGES . "slider/");
    define('DIR_WS_SLIDER_IMAGES', DIR_WS_IMAGES . "slider\\");

    define('DIR_HTTP_CSV', DIR_HTTP_IMAGES . "sample/");
    define('DIR_WS_CSV', DIR_WS_IMAGES . "sample\\");

    define('DIR_HTTP_UPLOAD', DIR_HTTP_IMAGES . "csv/");
    define('DIR_WS_UPLOAD', DIR_WS_IMAGES . "csv\\");

    define('DIR_HTTP_TEMPIMAGES', DIR_HTTP_IMAGES . "tempimages/");
    define('DIR_WS_TEMPIMAGES', DIR_WS_IMAGES . "tempimages\\");

    define('DIR_HTTP_USER_IMAGES', DIR_HTTP_IMAGES . "user/");
    define('DIR_WS_USER_IMAGES', DIR_WS_IMAGES . "user\\");

    define('DIR_HTTP_ASSETS', DIR_HTTP_HOME . "assets/");
    define('DIR_WS_ASSETS', DIR_WS_HOME . "assets\\");
} else {
    define('DIR_HTTP_HOME', "http://" . $_SERVER['HTTP_HOST'] . "/public/");
    define('DIR_WS_HOME', $_SERVER['DOCUMENT_ROOT'] . "/public/");

    define('DIR_HTTP_CSS', DIR_HTTP_HOME . "css/");
    define('DIR_HTTP_JS', DIR_HTTP_HOME . "js/");
    define('DIR_HTTP_VENDOR', DIR_HTTP_HOME . "vendor/");

    define('DIR_HTTP_IMAGES', DIR_HTTP_HOME . "images/");
    define('DIR_WS_IMAGES', DIR_WS_HOME . "images/");

    define('DIR_HTTP_CATEGORY_IMAGES', DIR_HTTP_IMAGES . "category/");
    define('DIR_WS_CATEGORY_IMAGES', DIR_WS_IMAGES . "category/");

    define('DIR_HTTP_PRODUCT_IMAGES', DIR_HTTP_IMAGES . "product/");
    define('DIR_WS_PRODUCT_IMAGES', DIR_WS_IMAGES . "product/");

    define('DIR_HTTP_SLIDER_IMAGES', DIR_HTTP_IMAGES . "slider/");
    define('DIR_WS_SLIDER_IMAGES', DIR_WS_IMAGES . "slider/");

    define('DIR_HTTP_CSV', DIR_HTTP_IMAGES . "sample/");
    define('DIR_WS_CSV', DIR_WS_IMAGES . "sample/");

    define('DIR_HTTP_UPLOAD', DIR_HTTP_IMAGES . "csv/");
    define('DIR_WS_UPLOAD', DIR_WS_IMAGES . "csv/");

    define('DIR_HTTP_TEMPIMAGES', DIR_HTTP_IMAGES . "tempimages/");
    define('DIR_WS_TEMPIMAGES', DIR_WS_IMAGES . "tempimages/");

    define('DIR_HTTP_ASSETS', DIR_HTTP_HOME . "assets/");
    define('DIR_WS_ASSETS', DIR_WS_HOME . "assets/");
}

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

function extract_search_field(Request $request)
{
    $array = '';
    if ($request->input('data')) {
        parse_str($request->input('data'), $array);
    }
    return $array;
}

function export_report($spreadsheet, $fileName = 'download.xlsx')
{
    ob_start();
    IOFactory::createWriter($spreadsheet, 'Xlsx')->save('php://output');
    $pdfData = ob_get_contents();
    ob_end_clean();
    return array(
        'op' => 'ok',
        'file' => "data:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;base64," . base64_encode($pdfData),
        'fileName' => $fileName,
    );
}

function export_file_generate($export_data_structure, $export_data, $extra)
{
    if (!empty($export_data)) {
        $rowIndex = 0;
        $colIndex = 0;
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle($extra['sheetTitle']);

        $styleArray = [
            'font' => [
                'bold' => true,
                'color' => [
                    'rgb' => "ffffff"
                ]
            ],
            'borders' => [
                'top' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
                'bottom' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
                'right' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
                'left' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'rotation' => 90,
                'startColor' => [
                    'rgb' => '4659d4',
                ],
                'endColor' => [
                    'argb' => 'FFFFFFFF',
                ],
            ],
        ];

        $styleUrlArray = [
            'font' => [
                'underline' => true,
                'color' => [
                    'rgb' => "1a58c7"
                ]
            ],
        ];
        $headerCells = array();
        foreach ($export_data_structure as $key => $value) {
            foreach ($value as $key1 => $value1) {
                $header[] = $value1['title'];
                $sheet->setCellValue(chr(65 + $key) . '1', $value1['title']);
                $sheet->getStyle(chr(65 + $key) . '1')->applyFromArray($styleArray);
                $sheet->getColumnDimension(chr(65 + $key))->setAutoSize(true);
            }
            $headerCells[] = chr(65 + $key) . '1';
        }
        $rowIndex++;

        $sheet->insertNewRowBefore(1, 2);
        $rowIndex += 2;
        $sheet->mergeCells($headerCells[0] . ":" . $headerCells[count($headerCells) - 1]);
        $sheet->setCellValue("A1", "Report {$extra['headerDate']}");
        $sheet->getStyle("A1")->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("A1")->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

        $sheet->getRowDimension(1)->setRowHeight(30);
        $cellvalue = array();
        foreach ($export_data as $rowcount => $value) {
            $rowcount += $rowIndex;
            foreach ($export_data_structure as $columncount => $value1) {
                $cellHeight = 15;
                $value1 = array_values($value1)[0];
                if (is_array($value[$value1['name']])) {
                    $cellHeight = count($value[$value1['name']]) * 15;
                    $value[$value1['name']] = implode("\n", $value[$value1['name']]);
                }

                if (isset($value1['datatype'])) {
                    switch ($value1['datatype']) {
                        case 'email':
                            $sheet->getCell(chr(65 + $columncount) . ($rowcount + 1))->getHyperlink()->setUrl("mailto:" . $value[$value1['name']]);
                            $sheet->getStyle(chr(65 + $columncount) . ($rowcount + 1))->applyFromArray($styleUrlArray);
                            break;

                        case 'date':
                            $sheet->getStyle(chr(65 + $columncount) . ($rowcount + 1))->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_DATE_DDMMYYYY);
                            $value[$value1['name']] = \PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel($value[$value1['name']]);
                            break;

                        case 'currency':
                            $sheet->getStyle(chr(65 + $columncount) . ($rowcount + 1))->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_NUMBER_00);
                            break;

                        default:
                            break;
                    }
                }
                if (isset($value1['total'])) {
                    if ($value1['total'] == TRUE) {
                        $cellvalue[chr(65 + $columncount)][] = chr(65 + $columncount) . ($rowcount + 1);
                        $cellvalue[chr(65 + $columncount)]['lastcell'] = chr(65 + $columncount) . ($rowcount + 1 + 2);
                    }
                }
                $sheet->setCellValue(chr(65 + $columncount) . ($rowcount + 1), $value[$value1['name']]);

                $sheet->getStyle(chr(65 + $columncount) . ($rowcount + 1))->getAlignment()->setWrapText(true);
                $sheet->getRowDimension($rowcount + 1)->setRowHeight($cellHeight);
                $colIndextemp = $columncount + 1;
            }
            $colIndex += $colIndextemp;
            $rowIndextemp = $rowcount;
        }
        $rowIndex += $rowIndextemp;

        foreach ($cellvalue as $key => $value) {
            $sheet->setCellValue($value['lastcell'], "=SUM({$cellvalue[$key][0]}:" . array_pop($cellvalue[$key]) . ")");
        }
        foreach ($headerCells as $key => $value) {
            $sheet->getStyle(chr(65 + $key) . $rowIndex)->applyFromArray($styleArray);
        }
        return $spreadsheet;
    }
}

function show_download_button($url)
{
    $html = '';
    if (!empty($url)) {
        $html = "<a href='import_download/$url' class='btn btn-success'><i class='fas fa-download ace-icon'></i>Download File</a>";
    }
    return $html;
}

function get_leftbar_links()
{
    $links = array(
        array(
            'title' => 'Dashboard',
            'icon' => 'menu-icon fas fa-tachometer-alt',
            'route' => '/dashboard'
        ),
        array(
            'title' => 'Services',
            'icon' => 'menu-icon fa fa-list',
            'route' => '',
            'children' => array(
                array(
                    'title' => 'Services',
                    'route' => '/service-list',
                ),
            ),
        ),
        array(
            'title' => 'Website Customers',
            'icon' => 'menu-icon fa fa-users',
            'route' => '',
            'children' => array(
                array(
                    'title' => 'Website Customers',
                    'route' => '/customer-list',
                ),
            ),
        ),
    );
    return $links;
}
