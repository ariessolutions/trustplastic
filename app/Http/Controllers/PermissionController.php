<?php

namespace App\Http\Controllers;

use App\Models\Permissions;
use App\Models\Route;
use App\Models\UserType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PermissionController extends Controller
{
    public function index($term = null)
    {
        $data = [
            'usertypes' => (new UserType)->getUserTypes(),
            'routes' => (new Route)->getAll(),
        ];

        return view('dashboard.pages.permissions')->with('data', $data);
    }

    public function get()
    {

        $resp = [];

        $index = 1;

        foreach ((new UserType)->getUserTypes() as $key => $value) {
            $resp[] = [$index,
                $value->usertype,
                '<span class="badge bg-' . (($value->status == 1) ? 'green' : 'red') . '-100 text-' . (($value->status == 1) ? 'success' : 'danger') . ' px-2 pt-5px pb-5px rounded fs-12px d-inline-flex align-items-center"><i class="fa fa-circle text-' . (($value->status == 1) ? 'teal' : 'danger') . ' fs-9px fa-fw me-5px"></i>' . (($value->status == 1) ? 'ACTIVE' : 'INACTIVE') . '</span>',
                '<div class="input-group flex-nowrap">
                <div class="m-1">
                    <button class="btn btn-secondary btn-sm" onclick="gutdata(' . $value->id . ')">
                        Edit
                    </button>
                </div>
                <div class="m-1">
                    <button style="width:80px" class="btn btn-round btn-outline-' . (($value->status == 1) ? 'danger' : 'success') . ' btn-sm" onclick="csusertypes(' . $value->id . ',' . $value->status . ')">
                        ' . (($value->status == 1) ? 'Deactive' : 'Active') . '
                    </button>
                </div>
                </div>'];
            $index++;
        }

        return $resp;
    }

    public function editStatus($id, $status)
    {
        return (new UserType())->edit($id, ['status' => ($status == 2) ? 1 : 2], ['view' => Session::get('view', 'non'), 'activity' => 'Status Updated']);
    }

    public function find($id)
    {
        return (new UserType)->findFirst($id);
    }

    public function enrollorupdate(Request $request)
    {

        if ($request->formconfig == 'update') {
            $request->validate([
                'formkey' => ['required', 'integer', 'exists:user_types,id'],
                'name' => ['required', 'string', 'max:255'],
                'status' => ['nullable', 'string', 'max:255'],
            ]);

            $data = [
                'usertype' => $request->name,
                'status' => ($request->status == 'on') ? 1 : 2,
            ];

            (new Permissions)->removeRecords($request->formkey,['view' => Session::get('view', 'non'), 'activity' => 'Permissions Deleted And Enrolled']);

            foreach ((new Route)->getAll() as $key => $value) {
                if($request['status'.$value->id]=='on'){
                    (new Permissions)->createPermission([
                        'usertype'=>$request->formkey,
                        'route'=>$value->id
                    ], ['view' => Session::get('view', 'non'), 'activity' => 'Permission Enroll']);
                }
            }

            (new UserType)->edit($request->formkey, $data, ['view' => Session::get('view', 'non'), 'activity' => 'Updated']);

            return redirect()->back()->with(['code' => 1, 'color' => 'warning', 'msg' => 'Successfully Permitted.']);
        } else {
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'status' => ['nullable', 'string', 'max:255'],
            ]);

            $data = [
                'usertype' => $request->name,
                'status' => ($request->status == 'on') ? 1 : 2,
            ];

            $newRecords=(new UserType)->createUserType($data, ['view' => Session::get('view', 'non'), 'activity' => 'Enroll']);

            foreach ((new Route)->getAll() as $key => $value) {
                if($request['status'.$value->id]=='on'){
                    (new Permissions)->createPermission([
                        'usertype'=>$newRecords->id,
                        'route'=>$value->id
                    ], ['view' => Session::get('view', 'non'), 'activity' => 'Permission Enroll']);
                }
            }

            return redirect()->back()->with(['code' => 1, 'color' => 'success', 'msg' => 'Successfully Created.']);
        }
    }
}
