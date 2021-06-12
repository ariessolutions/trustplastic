<?php

namespace App\Http\Controllers;

use App\Models\bin_location;
use App\Models\Currency;
use App\Models\Job;
use App\Models\JobHasProduct;
use App\Models\OutsideExp;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;

class JobController extends Controller
{

    protected $jobSession = 'jobdata';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'locations' => (new LocationController)->getLocations(),
            'statistics' => $this->recordsStatistics(),
        ];

        if (!Session::has('isJobEnroll')) {
            $this->clearSession();
            Session::forget('isJobEnroll');
        }

        return view('dashboard.pages.job')->with('data', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $check = true;
        $updateRecord = Job::where('id', $request->formkey)->first();
        if ($request->formconfig == 'update') {
            $request->validate([
                'formkey' => ['required', 'integer', 'exists:jobs,id'],
            ]);

            if ($updateRecord->status == 3) {
                Job::where('id', $request->formkey)->delete();

                foreach (JobHasProduct::where('job_id', $request->formkey)->get() as $exKey => $exVal) {
                    OutsideExp::where('jobproduct', $exVal->id)->delete();
                }

                JobHasProduct::where('job_id', $request->formkey)->delete();
            } else {
                $check = false;
            }

        }

        if ($check) {
            Session::put('isJobEnroll', true);

            $request->validate([
                'job_location' => 'required|integer|exists:locations,id',
                'job_vehicle' => 'required|integer|exists:vehicles,id',
                'job_remark' => 'nullable|string',
            ]);

            $jobRecords = $this->sessionData();

            if (count($jobRecords) == 0) {
                throw ValidationException::withMessages(['commonerror' => 'No Job Products Available.']);
            }

            Session::forget('isJobEnroll');

            $jobData = [
                'vehicle' => $request->job_vehicle,
                'location' => $request->job_vehicle,
                'user' => Auth::user()->id,
                'code' => ($request->formconfig == 'update' && $updateRecord) ? $updateRecord->code : $this->next(),
                'cost' => 0,
            ];

            if ($request->has('remark')) {
                $jobData['remark'] = $request->job_remark;
            }

            $job = (new Job)->add($jobData, ['view' => Session::get('view', 'non'), 'activity' => 'Create New Job']);

            $jobTotal = 0;

            foreach ($jobRecords as $key => $value) {
                $jobHasProductRecord = (new JobHasProduct)->add([
                    'job_id' => $job->id,
                    'bin' => $value[0],
                    'product' => $value[1],
                    'qty' => $value[3],
                    'cost' => $value[2] * $value[3],
                    'subtotal' => ($value[2] * $value[3]) * (100 + $value[4]) / 100,
                    'vat' => $value[4],
                    'ex_total' => 0,
                    'nettotal' => 0,
                ]);

                $jobProductEXTotal = 0;

                foreach ($value[5] as $key1 => $value1) {
                    $jobProductEXTotal += $value1[2];
                    (new OutsideExp)->add(['jobproduct' => $jobHasProductRecord->id, 'expense' => $value1[0], 'reference' => $value1[1], 'amount' => $value1[2], 'remark' => $value1[3]]);
                }

                $jobProductNetTotal = $jobProductEXTotal + $jobHasProductRecord->subtotal;

                (new JobHasProduct)->edit($jobHasProductRecord->id, ['ex_total' => $jobProductEXTotal, 'nettotal' => $jobProductNetTotal], ['view' => Session::get('view', 'non'), 'activity' => 'Edited New Job Has Product Rercord']);

                $jobTotal += $jobProductNetTotal;
            }

            (new Job)->edit($job->id, ['cost' => $jobTotal], ['view' => Session::get('view', 'non'), 'activity' => 'Edited New Job Rercord']);

            return redirect()->back()->with(['code' => 1, 'color' => 'success', 'msg' => 'Job ' . (($request->formconfig == 'update') ? 'Updated' : 'Submitted') . ' Successfully.']);

        } else {
            throw ValidationException::withMessages(['commonerror' => 'Something Error On Structure.']);
        }

    }
    public function show($id)
    {
        $record = (new Job)->getRecord($id);
        $record['date'] = $record->created_at->format('Y-m-d');

        $data = $this->sessionData([], true);

        foreach ($record['jobhasproducts'] as $key => $value) {
            $exp = [];
            foreach ($value['outsideex'] as $key1 => $value1) {
                $exp[] = [$value1->expense, $value1->reference, $value1->amount, $value1->remark];
            }
            $data[] = [$value->bin, $value->product, $value->cost / $value->qty, $value->qty, $value->vat, $exp];
        }

        $this->sessionData($data);

        return $record;
    }

    public function getAll()
    {
        $resp = [];
        $index = 1;

        foreach ((new Job)->getAll() as $key => $value) {

            $statusText = '';
            $statusColor1 = '';
            $statusColor2 = '';

            switch ($value->status) {
                case 1:
                    $statusText = 'Approved';
                    $statusColor1 = 'success';
                    $statusColor2 = 'green';
                    break;
                case 2:
                    $statusText = 'Refused';
                    $statusColor1 = 'danger';
                    $statusColor2 = 'red';
                    break;
                case 3:
                    $statusText = 'Pending';
                    $statusColor1 = 'warning';
                    $statusColor2 = 'yellow';
                    break;
                case 4:
                    $statusText = 'Meterial Approve';
                    $statusColor1 = 'success';
                    $statusColor2 = 'green';
                    break;
                case 5:
                    $statusText = 'Item Issued';
                    $statusColor1 = 'primary';
                    $statusColor2 = 'blue';
                    break;
                default:
                    $statusText = '-';
                    $statusColor1 = 'default';
                    $statusColor2 = 'white';
                    break;
            }

            $status = '<span class="badge my-1 bg-' . $statusColor2 . '-100 text-' . $statusColor1 . ' px-2 pt-5px pb-5px rounded fs-12px d-inline-flex align-items-center"><i class="fa fa-circle text-' . $statusColor1 . ' fs-9px fa-fw me-5px"></i>' . $statusText . '</span>';

            $actions = '<div class="input-group flex-nowrap">
                            <div class="m-1">

                            ' . (($value->status == 2) ? '' : '<a onclick="viewJob(' . $value->id . ')" class="btn btn-primary btn-sm">
                            View
                        </a>') . '
                        ' . (($value->status == 1) ? '<a onclick="addMaterial(' . $value->id . ')" class="btn btn-teal text-white btn-sm">
                            <i class="fa fa-plus"></i> Add Materials
                        </a>' : '') . '
                                ' . (($value->status == 3) ? '<a onclick="editJob(' . $value->id . ')" class="btn btn-secondary btn-sm">
                                Edit
                            </a>' : '') . '
                            </div>
                        </div>';

            $resp[] = [$index, $value->created_at->format('d M Y'), $value->code, $value['locationdata']['location_name'], $value['vehicleData']['brand'] . ' - ' . $value['vehicleData']['model'], (new Currency)->format($value->cost), $status, $actions];
            $index++;
        }

        return $resp;
    }

    public function next()
    {
        return $this->genarateNextId();
    }

    public function genarateNextId()
    {
        return env('JOBPREFIX', '') . str_pad((new Job)->getNextId(), 3, "0", STR_PAD_LEFT);
    }

    protected function sessionData($data = null, $reset = false)
    {
        if ($reset == true) {
            Session::put($this->jobSession, []);
        }

        if ($data != null) {
            Session::put($this->jobSession, $data);
        }

        return Session::get($this->jobSession, []);
    }

    public function sessionAdd(Request $request)
    {
        $data = $this->sessionData();
        $request->validate([
            'bin' => 'required|exists:bin_locations,id',
            'product' => 'required|exists:products,id',
            'lcost' => 'required|regex:/^\d*(\.\d{2})?$/|min:0',
            'qty' => 'required|regex:/^\d*(\.\d{2})?$/|min:0',
            'vat' => 'nullable|numeric',
            'expenses' => 'nullable',
        ]);

        if (count($data) > 0) {

            $check = false;

            foreach ($data as $key => $value) {
                if ($request->product == $value[1]) {
                    $data[$key][2] = $request->lcost;
                    $data[$key][3] = $request->qty;
                    $data[$key][4] = ($request->has('vat') && $request->vat != '') ? $request->vat : 0;
                    $data[$key][5] = ($request->has('expenses')) ? $request->expenses : [];
                    $check = true;
                    break;
                }
            }

            if ($check == false) {
                $data[] = [$request->bin, $request->product, $request->lcost, $request->qty, ($request->has('vat') && $request->vat != '') ? $request->vat : 0, ($request->has('expenses')) ? $request->expenses : []];
            }
        } else {
            $data[] = [$request->bin, $request->product, $request->lcost, $request->qty, ($request->has('vat') && $request->vat != '') ? $request->vat : 0, ($request->has('expenses')) ? $request->expenses : []];
        }

        $this->sessionData($data);
    }

    public function clearSession()
    {
        $this->sessionData([], true);
    }

    public function removeFromSession($index)
    {
        $data = $this->sessionData();

        array_splice($data, $index, 1);

        $this->sessionData($data, true);
    }

    public function getFromSession($index)
    {
        $data = $this->sessionData();

        if (count($data) > 0) {
            $data = $data[$index];
            $data[0] = (new bin_location)->getBinLocationById($data[0]);
            $data[1] = (new Product)->getData($data[1]);
            return json_encode($data);
        }

        return 2;
    }

    public function sessionTable()
    {
        $resp = [];
        foreach ($this->sessionData() as $key => $value) {
            $bin = (new bin_location)->getBinLocationById($value[0])->bin_location_name;
            $product = (new Product)->getData($value[1])->code;

            $subTotal = $value[2] * $value[3];

            $subTotal = $subTotal * (100 + $value[4]) / 100;

            $exTotal = 0;

            foreach ($value[5] as $key1 => $value1) {
                $exTotal += $value1[2];
            }

            $netTotal = $exTotal + $subTotal;

            $buttons = '<div class="input-group flex-nowrap">
                <div class="m-1">
                    <a class="btn btn-secondary btn-sm" onclick="jobViewEditSession(' . $key . ')">
                        View / Edit
                    </a>
                </div>
                <div class="m-1">
                    <a class="btn btn-round btn-default btn-sm"  onclick="jobRemoveSession(' . $key . ')">
                        Remove
                    </a>
                </div>
            </div>';

            $resp[] = [$key + 1, $bin, $product, (new Currency)->format($value[2]), $value[3], $value[4], (new Currency)->format($subTotal), (new Currency)->format($exTotal), (new Currency)->format($netTotal), $buttons];
        }

        return $resp;
    }

    public function approve($id)
    {
        (new Job)->edit($id, ['status' => 1, 'approval_date' => Carbon::now()->format('Y/m/d'), 'approval_user' => Auth::user()->id], ['view' => Session::get('view', 'non'), 'activity' => 'Job Approved']);
    }

    public function refused($id)
    {
        (new Job)->edit($id, ['status' => 2], ['view' => Session::get('view', 'non'), 'activity' => 'Job Approved']);
    }

    public function recordsStatistics()
    {
        $approved = Job::where('status', 1)->get()->count();
        $refused = Job::where('status', 2)->get()->count();
        $pending = Job::where('status', 3)->get()->count();

        $total = $approved + $refused + $pending;

        return [[$approved, (int) (($approved / $total) * 100)], [$refused, (int) (($refused / $total) * 100)], [$pending, (int) (($pending / $total) * 100)]];
    }

    public function printJob($id)
    {
        $data = (new Job)->getRecord($id);
        if ($data) {
            return view('reports.jobReport')->with('data', $data);
        } else {
            return 2;
        }
    }

}
