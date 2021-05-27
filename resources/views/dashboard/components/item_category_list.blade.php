<?php
$rowval = 0; ?>

@foreach ($itemCategories as $key => $itemCategory)

    <tr>
        <td scope="row">{{ $rowval += 1 }}</td>
        <td>{{ $itemCategory->item_category_code }}</td>
        <td>{{ $itemCategory->item_category_name }}</td>

        @if ($itemCategory->status == 1)
            <td class="py-1 align-middle"><span
                    class="badge bg-green-100 text-success px-2 pt-5px pb-5px rounded fs-12px d-inline-flex align-items-center"><i
                        class="fa fa-circle text-teal fs-9px fa-fw me-5px"></i>
                    Active</span>
            </td>
            <td>
                <div class="input-group flex-nowrap">
                    <div class="m-1">
                        <a class="btn btn-secondary btn-sm"
                            onclick="setItemCategoryValueForEdit({{ $itemCategory }});">
                            Edit
                        </a>
                    </div>
                    <div class="m-1">
                        <a class="btn btn-round btn-default btn-sm" data-id="form-control-{{ $itemCategory->id }}"
                            data-role="completed-deactivate" data-token="{{ csrf_token() }}">
                            Deactivate
                        </a>
                    </div>
                </div>
            </td>

        @elseif($itemCategory->status == 2)
            <td class=" py-1 align-middle"><span
                    class="badge bg-red-100 text-danger px-2 pt-5px pb-5px rounded fs-12px d-inline-flex align-items-center"><i
                        class="fa fa-circle text-danger fs-9px fa-fw me-5px"></i>
                    Inactive</span>
            </td>
            <td>
                <div class="input-group flex-nowrap">
                    <div class="m-1">
                        <a class="btn btn-round btn-default btn-sm" data-id="form-control-{{ $itemCategory->id }}"
                            data-role="completed-activate" data-token="{{ csrf_token() }}">
                            Activate
                        </a>
                    </div>
                </div>
            </td>
        @endif


    </tr>

@endforeach
