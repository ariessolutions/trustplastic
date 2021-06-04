<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserType;
use App\Models\UserTypeString;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    public function index($term = null)
    {
        $data = [
            'usertypes' => (new UserType)->getUserTypes(1),
        ];

        return view('dashboard.user_registration')->with('data', $data);
    }

    public function enrollorupdate(Request $request)
    {

        if ($request->formconfig == 'update') {
            $request->validate([
                'formkey' => ['required', 'integer', 'exists:users,id'],
                'firstname' => ['required', 'string', 'max:255'],
                'lastname' => ['nullable', 'string', 'max:255'],
                'password' => ['nullable', 'st  ring', 'min:8'],
                'confirm_password' => ['nullable', 'string', 'min:8', 'same:password'],
                'usertype' => ['required', 'integer', 'exists:user_types,id'],
            ]);

            $data = [
                'fname' => $request->firstname,
                'email' => $request->email,
                'usertype' => $request->usertype,
                'status' => ($request->status == 'on') ? 1 : 2,
            ];

            if (isset($request->lastname)) {
                $data['lname'] = $request->lastname;
            }

            if (isset($request->password)) {
                $data['password'] = Hash::make($request->password);
            }

            (new User)->edit($request->formkey, $data, ['view' => 'Dashboard/Users', 'activity' => 'Updated']);

            return redirect()->back()->with(['code' => 1, 'color' => 'warning', 'msg' => 'Successfully Updated.']);
        } else {
            $request->validate([
                'firstname' => ['required', 'string', 'max:255'],
                'lastname' => ['required', 'string', 'max:255'],
                'emp_number' => ['required', 'string', 'max:255', 'unique:users,emp_no'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'st  ring', 'min:8'],
                'confirm_password' => ['required', 'string', 'min:8', 'same:password'],
                'usertype' => ['required', 'integer', 'exists:user_types,id'],
            ]);

            $data = [
                'fname' => $request->firstname,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'emp_no' => $request->emp_number,
                'email' => $request->email,
                'usertype' => $request->usertype,
                'status' => ($request->status == 'on') ? 1 : 2,
            ];

            if (isset($request->lastname)) {
                $data['lname'] = $request->lastname;
            }

            (new User)->createUser($data, ['view' => 'Dashboard/Users', 'activity' => 'Enroll']);

            return redirect()->back()->with(['code' => 1, 'color' => 'success', 'msg' => 'Successfully Added.']);
        }
    }

    public function get()
    {

        $resp = [];

        $index = 1;

        foreach ((new User)->getUsers(null) as $key => $value) {
            $resp[] = [$index, $value->emp_no,
                $value->fname,
                (strlen($value->email) > 12) ? substr($value->email, 0, 12) . ' ..' : $value->email,
                (new UserTypeString)->getType($value->usertype),
                '<span class="badge bg-' . (($value->status == 1) ? 'green' : 'red') . '-100 text-' . (($value->status == 1) ? 'success' : 'danger') . ' px-2 pt-5px pb-5px rounded fs-12px d-inline-flex align-items-center"><i class="fa fa-circle text-' . (($value->status == 1) ? 'teal' : 'danger') . ' fs-9px fa-fw me-5px"></i>' . (($value->status == 1) ? 'ACTIVE' : 'INACTIVE') . '</span>',
                '<div class="input-group flex-nowrap">
                <div class="m-1">
                    <button class="btn btn-secondary btn-sm" onclick="gudata(' . $value->id . ')">
                        Edit
                    </button>
                </div>
                <div class="m-1">
                    <button style="width:80px" class="btn btn-round btn-outline-' . (($value->status == 1) ? 'danger' : 'success') . ' btn-sm" onclick="csusers(' . $value->id . ',' . $value->status . ')">
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
        return (new User)->edit($id, ['status' => ($status == 2) ? 1 : 2], ['view' => 'Dashboard/Users', 'activity' => 'Status Updated']);
    }

    public function find($id)
    {
        return (new User)->getData($id);
    }
}
