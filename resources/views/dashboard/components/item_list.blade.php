<?php
$rowval = 0; ?>

@foreach ($item as $key => $item)

    <?php
    $item_category = App\Models\item_category::find($item->item_category_id);
    $measure_unit = App\Models\measure_unit::find($item->measure_unit_id);
    ?>

    <tr>
        <td class="py-1 align-middle">{{ $rowval += 1 }}</td>
        <td class="py-1 align-middle">{{ $item->item_code }}</td>
        <td class="py-1 align-middle">{{ $item->item_part_code }}</td>
        <td class="py-1 align-middle">{{ $item->item_name }}</td>
        <td class="py-1 align-middle">{{ $item_category->item_category_name }}</td>
        <td class="py-1 align-middle">{{ $measure_unit->symbol }}</td>

        @if ($item->status == 1)
            <td class="py-1 align-middle"><span
                    class="badge bg-green-100 text-success px-2 pt-5px pb-5px rounded fs-12px d-inline-flex align-items-center"><i
                        class="fa fa-circle text-teal fs-9px fa-fw me-5px"></i>
                    Active</span>
            </td>
            <td>
                <div class="input-group flex-nowrap">
                    <div class="m-1">
                        <a class="btn btn-secondary btn-sm"
                            onclick="setItemValueForEdit({{ $item }});">
                            Edit
                        </a>
                    </div>
                    <div class="m-1">
                        <a class="btn btn-round btn-default btn-sm" data-id="form-control-{{ $item->id }}"
                            data-role="completed-deactivate" data-token="{{ csrf_token() }}">
                            Deactivate
                        </a>
                    </div>
                </div>
            </td>

        @elseif($item->status == 2)
            <td class=" py-1 align-middle"><span
                    class="badge bg-red-100 text-danger px-2 pt-5px pb-5px rounded fs-12px d-inline-flex align-items-center"><i
                        class="fa fa-circle text-danger fs-9px fa-fw me-5px"></i>
                    Inactive</span>
            </td>
            <td>
                <div class="input-group flex-nowrap">
                    <div class="m-1">
                        <a class="btn btn-round btn-default btn-sm" data-id="form-control-{{ $item->id }}"
                            data-role="completed-activate" data-token="{{ csrf_token() }}">
                            Activate
                        </a>
                    </div>
                </div>
            </td>
        @endif

    </tr>

@endforeach
