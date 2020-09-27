<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Kreait\Firebase\Factory;

use function App\Http\draw_action_menu;
use function App\Http\draw_table_checkbox;
use function App\Http\extract_search_field;

class ServiceController extends Controller
{
    public function create()
    {
        $breadcrumbs = array(
            array(
                'route'=>'service-list',
                'title'=>'Services',
                'active'=>false,
            ),
            array(
                'title'=>'Add Service',
                'active'=>true,
            ),
        );
        $data = array(
            'page_name' => substr(url()->current(), strrpos(url()->current(), '/')+1),
            'breadcrumbs'=> $breadcrumbs,
            'service_id'=>time(),
        );
        return view('services.add', $data);
    }

    public function index()
    {
        $breadcrumbs = array(
            array(
                'title'=>'Services',
                'active'=>true,
            ),
        );
        $action_buttons = array();
        $action_buttons['Add Service'] = array(
            'class'=>'btn btn-success',
            'link'=>'add-service',
            'icon'=>'fa fa-plus',
        );
        $data = array(
            'page_name' => substr(url()->current(), strrpos(url()->current(), '/')+1),
            'breadcrumbs' => $breadcrumbs,
            'actions'=>$action_buttons,
        );
        return view('services.index', $data);
    }

    public function ajaxlist(Request $request) {
        $fieldArr = array(
            '',
            'id',
            'name',
            'price',
            'status',
        );
        $searchArr = extract_search_field($request);
        $start = $request->input('start');
        $length = $request->input('length');
        $order = $request->input('order')[0]['column'];
        $dir = $request->input('order')[0]['dir'];
        if(!empty($searchArr)) {
            $search = $searchArr['keyword'];
        }
        FirebaseController::setCollection('services');
        FirebaseController::orderBy($fieldArr[$order], strtoupper($dir));
        $documents = FirebaseController::getData();
        $htmlArray = array();
        $counter = 0;
        $lengthCounter = 0;
        $sr=$start+1;
        $recCount=0;
        foreach ($documents as $key => $document) {
            if(empty($searchArr)) {
                $recCount++;
            }
            if($length == $lengthCounter) {
                continue;
            }
            if ($document->exists() && $key+1 > $start) {
                $service = $document->data();
                if(isset($search) && !empty($search)) {
                    if(strpos($service['name'], $search) === FALSE) {
                        continue;
                    }
                }
                if(!empty($searchArr)) {
                    $recCount++;
                }
                $rec = array();
                $rec['DT_RowId'] = 'serv:'.$service['id'];
                $rec[] = draw_table_checkbox($service['id']);
                $rec[] = $sr;
                $rec[] = $service['name'];
                $rec[] = $service['price'];
                $status = $service['status'] ? 'checked' : '';
                $rec[] = "<input class='ace ace-switch ace-switch-6 change_status ajax' type='checkbox' id='service_status' name='service_status' value='1' data-url='/service-status-change' $status />
                <span class='lbl'></span>";
                $action_links = array();
                $action_links['Edit'] = array(
                    'icon'=>'far fa-edit',
                    'link'=>'add-service/'.$service['id'],
                );
                $action_links['Delete'] = array(
                    'class'=>'label-danger ajax delete',
                    'icon'=>'far fa-trash-alt',
                    'link'=>'delete-service/'.$service['id'],
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

    public function insert(Request $req) {
        $back = $req->input('back');
        if(isset($back)) {
            return redirect('service-list');
        }
        $service_id = $req->input('service_id');
        $mode = $req->input('mode');
        $service_name = $req->input('service_name');
        $service_price = $req->input('service_price');
        $service_status = $req->input('service_status');
        $save_back = $req->input('save_back');
        $save = $req->input('save');
        FirebaseController::setCollectionAndDocument('services', $service_id);
        $data = array(
            'id' => $service_id,
            'name' => $service_name,
            'price' => (double) $service_price,
            'status' => (isset($service_status)) ? true : false,
        );
        FirebaseController::setDataToCollection($data);
        $message = "Data is added successfully.";
        if($mode == 'edit') {
            $message = "Data is updated successfully.";
        }
        if(isset($save_back)) {
            return redirect('service-list')->with('success', $message);
        } else if(isset($save)) {
            return redirect('add-service/'.$service_id)->with('success', $message);
        }
    }

    public function edit($id) {
        FirebaseController::setCollectionAndDocument('services', $id);
        $database = FirebaseController::getData();
        $breadcrumbs = array(
            array(
                'title'=>'Services',
                'route'=>'service-list',
                'active'=>false,
            ),
            array(
                'title'=>'Edit Services',
                'active'=>true,
            ),
        );
        $data = array(
            'page_name'=>'service-list',
            'postdata' => $database,
            'service_id' => $database['id'],
            'breadcrumbs' => $breadcrumbs,
        );
        return view('services.add', $data);
    }

    public function changeStatus(Request $req)
    {
        $id = $req->input('id');
        $status = $req->input('status');
        FirebaseController::setCollectionAndDocument('services', $id);
        $serviceData = FirebaseController::getData();
        $serviceData['status'] = empty($status) ? false : true;
        FirebaseController::setDataToCollection($serviceData);
        $response = new Response('success');
        return $response;
    }

    public function delete($id) {
        FirebaseController::setCollectionAndDocument('services', $id);
        FirebaseController::deleteDocument();
        $reponse = new Response('success');
        return $reponse;
    }
}
