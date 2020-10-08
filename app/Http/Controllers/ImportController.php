<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ImportController extends Controller
{
    public function uploadFile(Request $req)
    {
        $req->session()->forget('file_upload');
        $req->session()->forget('record_add');
        $file = $req->file("import_csv");
        if ($file != null) {
            $ext = $file->getClientOriginalExtension();
            if ($ext == "csv" || $ext == "xlsx") {
                $destination = DIR_WS_IMAGES . "csv\\";
                $fileName = basename($file->getClientOriginalName(), '.' . $ext);
                $fileName .= time();
                $fileName .= '.' . $ext;
                if (!file_exists($destination)) {
                    mkdir($destination, 0777, true);
                }
                if ($file->move($destination, $fileName)) {
                    $req->session()->put('file_upload', $fileName);
                    $html = $this->showvalidate();
                    return json_encode(array("success" => "success", "data" => $html));
                }
            }
        }
        exit;
    }

    private function showvalidate($for = 'service')
    {
        $file = DIR_WS_UPLOAD . Session::get('file_upload');
        $dataArr = $this->csvToArray($file);
        $outputArr = array();
        $success = $skipped = 0;

        if ($dataArr) {
            $headers = array_keys($dataArr[0]);
            $outputArr = "<table class='table bg-white table-bordered'><thead><tr>";
            foreach ($headers as $key => $value) {
                $outputArr .= "<th>" . ucwords(str_replace("_", " ", $value)) . "</th>";
            }
            $outputArr .= "</tr></thead><tbody>";
            $successData = array();
            switch ($for) {
                case 'service':
                    foreach ($dataArr as $key => $value) {
                        $service_name = $value['service_name'];
                        $service_amount = $value['service_amount'];
                        $status = $value['status'];
                        $err_service_name = $err_service_amount = $err_status = "";
                        if ($service_name == "") {
                            $err_service_name = "bg-danger text-white";
                        }

                        $pattern = '/^\d+$/';
                        if ($service_amount == "" || !preg_match($pattern, $service_amount)) {
                            $err_service_amount = "bg-danger text-white";
                        }

                        $statusArr = array('1', '0');
                        if (!in_array($status, $statusArr)) {
                            $err_status = "bg-danger text-white";
                        }

                        $outputArr .= "<tr><td class='{$err_service_name}'>{$value['service_name']}</td><td class='{$err_service_amount}'>{$value['service_amount']}</td><td class='{$err_status}'>{$value['status']}</td></tr>";

                        if ($err_service_name != "" || $err_service_amount != "" || $err_status != "") {
                            $skipped++;
                        }

                        if ($err_service_name == "" && $err_service_amount == "" & $err_status == "") {
                            $success++;
                            $successData[] = $value;
                        }
                    }
                    break;

                default:
                    break;
            }
            Session::put('record_add', $successData);
            $outputArr .= "</tbody></table>";
        }
        return array("html" => $outputArr, "rowsuccess" => $success, "rowskipped" => $skipped);
    }

    private function csvToArray($filename = '', $delimiter = ',')
    {
        if (!file_exists($filename) || !is_readable($filename))
            return false;

        $header = null;
        $data = array();
        if (($handle = fopen($filename, 'r')) !== false) {
            while (($row = fgetcsv($handle, 1000, $delimiter)) !== false) {
                if (!$header) {
                    $header = $row;
                    foreach ($header as $key => $value) {
                        $header[$key] = strtolower(str_replace(" ", "_", $value));
                    }
                } else
                    $data[] = array_combine($header, $row);
            }
            fclose($handle);
        }
        return $data;
    }
}
