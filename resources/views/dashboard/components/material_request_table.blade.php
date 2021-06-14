<?php

$rowdata = 0;

?>

@foreach ($mr as $mr_data)

<?php

$job = App\Models\Job::find($mr_data->job_id);
$location = App\Models\location::find($job->location);
$vehicle = App\Models\Vehicle::find($job->vehicle);

?>

<tr>
    <td scope="row" class="py-1 align-middle">{{ $rowdata+1 }}</td>
    <td class="py-1 align-middle">{{ $job->code }}</td>
    <td class="py-1 align-middle">{{ $mr_data->mr_code }}</td>
    <td class="py-1 align-middle">{{ $mr_data->date }}</td>
    <td class="py-1 align-middle">{{ $location->location_name }}</td>
    <td class="py-1 align-middle">{{ $vehicle->code }}</td>
    <td class="py-1 align-middle">{{ $vehicle->model }}</td>
    <td class="py-1 align-middle">

        @if($mr_data->status== 1)
        <span
            class="badge bg-green-100 text-success px-2 pt-5px pb-5px rounded fs-12px d-inline-flex align-items-center"><i
                class="fa fa-circle text-teal fs-9px fa-fw me-5px"></i>
            Approved
        </span>
        @elseif($mr_data->status==2)
        <span
            class="badge bg-red-100 text-danger px-2 pt-5px pb-5px rounded fs-12px d-inline-flex align-items-center"><i
                class="fa fa-circle text-danger fs-9px fa-fw me-5px"></i>
            Refused
        </span>
        @elseif($mr_data->status==3)
        <span
            class="badge bg-yellow-100 text-warning px-2 pt-5px pb-5px rounded fs-12px d-inline-flex align-items-center"><i
                class="fa fa-circle text-warning fs-9px fa-fw me-5px"></i>
            Pending
        </span>
        @elseif($mr_data->status==4)
        <span
            class="badge bg-blue-100 text-primary px-2 pt-5px pb-5px rounded fs-12px d-inline-flex align-items-center"><i
                class="fa fa-circle text-primary fs-9px fa-fw me-5px"></i>
            Item Issued
        </span>
        @endif

    </td>
    <td>
        <div class="input-group flex-nowrap">
            <div class="px-1">
                <button id="mr_view_modal_button" href="#mr_view_modal" data-bs-toggle="modal"
                    onclick="mr_view_modal_on_mr({{ $mr_data->id }})" class="btn btn-secondary btn-sm">
                    View</button>
            </div>

            <div>
                <button id="mr_view_print" class="btn btn-default btn-sm" onclick="mr_view_print({{ $mr_data->id }})">
                    <i class="fa fa-print" aria-hidden="true"></i>
                    Print</button>
            </div>
        </div>

    </td>
</tr>

<?php

$rowdata +=1;

?>

@endforeach
