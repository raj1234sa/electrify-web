<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use function App\Http\draw_action_menu;
use function App\Http\draw_table_checkbox;
use function App\Http\export_file_generate;
use function App\Http\export_report;
use function App\Http\extract_search_field;

class CustomersController extends Controller
{
    function index()
    {
        $breadcrumbs = array();
        $breadcrumbs[] = array(
            'active' => true,
            'title' => 'Customers',
        );
        $data = array(
            'page_name' => '/customer-list',
            'breadcrumbs' => $breadcrumbs,
        );
        return view('customers.index', $data);
    }

    function create()
    {
        $action_buttons = array();
        $action_buttons['Add Customer'] = array(
            'icon' => 'fa fa-plus',
            'class' => 'btn btn-success',
            'link' => 'add-customer',
        );
        $breadcrumbs = array();
        $breadcrumbs[] = array(
            'active' => false,
            'title' => 'Customers',
            'route' => '/customer-list'
        );
        $breadcrumbs[] = array(
            'active' => true,
            'title' => 'Add Customer',
        );
        $data = array(
            'actions' => $action_buttons,
            'page_name' => '/customer-list',
            'breadcrumbs' => $breadcrumbs,
        );
        return view('customers.add', $data);
    }

    public function ajaxlist(Request $request)
    {
        $fieldArr = array(
            '',
            'userId',
            'username',
            'phoneNumber',
        );
        $searchArr = extract_search_field($request);
        $start = $request->input('start');
        $length = $request->input('length');
        $order = $request->input('order')[0]['column'];
        $dir = $request->input('order')[0]['dir'];
        if (!empty($searchArr)) {
            $search = $searchArr['keyword'];
        }
        $firebaseController = new FirebaseController();
        $firebaseController->setCollection('users');
        $firebaseController->orderByColumn($fieldArr[$order], strtoupper($dir));
        $documents = $firebaseController->getData();
        $htmlArray = array();
        $counter = 0;
        $lengthCounter = 0;
        $sr = $start + 1;
        $recCount = 0;
        foreach ($documents as $key => $document) {
            if (empty($searchArr)) {
                $recCount++;
            }
            if ($length == $lengthCounter) {
                continue;
            }
            if ($document->exists() && $key + 1 > $start) {
                $service = $document->data();
                if (isset($search) && !empty($search)) {
                    if (strpos(strtolower($service['username']), strtolower($search)) === FALSE) {
                        continue;
                    }
                }
                if (!empty($searchArr)) {
                    $recCount++;
                }
                $rec = array();
                $rec['DT_RowId'] = 'cust:' . $service['userId'];
                $rec[] = draw_table_checkbox($service['userId']);
                $rec[] = $sr;
                $rec[] = $service['userId'];
                $rec[] = $service['username'];
                $rec[] = $service['phoneNumber'];
                $action_links = array();
                $action_links['Edit'] = array(
                    'icon' => 'far fa-edit',
                    'link' => 'add-customer/' . $service['userId'],
                );
                $action_links['Delete'] = array(
                    'class' => 'label-danger ajax delete',
                    'icon' => 'far fa-trash-alt',
                    'link' => 'delete-customer/' . $service['userId'],
                );
                $rec[] = draw_action_menu($action_links);
                $htmlArray[] = $rec;
                $lengthCounter++;
                $sr++;
                $counter++;
            }
        }
        $totalRec = $recCount;
        return array(
            'data' => $htmlArray,
            'recordsTotal' => $totalRec,
            'recordsFiltered' => $totalRec,
            'draw' => $request->input('draw'),
        );
    }

    function export(Request $req)
    {
        $search = extract_search_field($req);
        $firebaseController = new FirebaseController();
        $firebaseController->setCollection('users');
        $usersDocs = $firebaseController->getData();
        $userData = array();
        foreach ($usersDocs as $user) {
            if (!empty($search)) {
                if (strpos($user['username'], $search['keyword']) === FALSE)
                    continue;
            }
            $rec = array();
            $rec['userId'] = $user['userId'];
            $rec['username'] = $user['username'];
            $rec['phoneNumber'] = $user['phoneNumber'];
            $userData[] = $rec;
        }
        $fields = array();
        $fields[] = array('userId' => array('name' => 'userId', 'title' => "User ID"));
        $fields[] = array('username' => array('name' => 'username', 'title' => "Username"));
        $fields[] = array('phoneNumber' => array('name' => 'phoneNumber', 'title' => "Phone Number"));
        $spreadsheet = export_file_generate($fields, $userData, array('sheetTitle' => 'Users Report','headerDate'=>'All'));
        return export_report($spreadsheet, 'all_users.xlsx');
    }
}
