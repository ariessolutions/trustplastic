@if (isset($records))

    <?php $index = 0; ?>

    @foreach ($records as $item)
        <tr>
            <td class="py-1 align-middle">{{ $item[6]->item_code . '-' . $item[6]->item_name }}</td>
            <td class="py-1 align-middle">{{ $item[1] }}</td>
            <td class="py-1 align-middle">{{ $item[2] }}</td>
            <td class="py-1 align-middle">{{ $item[3] }}</td>
            <td class="py-1 align-middle">{{ $item[4] }}</td>
            <td class="py-1 align-middle">{{ $item[5] }}</td>
            <td class="py-1 align-middle">
                <div class="input-group flex-nowrap">
                    <div class="m-1">
                        <button class="btn btn-secondary btn-sm" {{-- $item[1], $item[2], $item[3], $item[4], $item[5] --}}
                            onclick="editPOItem({{ $item[6] }},{{ $item[1] }},{{ $item[2] }},{{ $item[3] }},{{ $item[4] }})">
                            View / Edit</button>
                    </div>
                    <div class="m-1">
                        <button class="btn btn-round btn-default btn-sm"
                            onclick="removePOItem('{{ $index }}')">Remove
                        </button>
                    </div>
                </div>
            </td>
        </tr>

        <?php $index += 1; ?>

    @endforeach
@endif
