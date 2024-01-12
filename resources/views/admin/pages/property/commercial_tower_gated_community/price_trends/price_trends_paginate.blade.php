<div class="table-responsive">
    <table class="table-bordered table table-stripped mt-3 mb-3 price-trends-table" >

    <thead style="background: #c0cfff;">

        <tr>
            <th>Sl.no</th>
            <th>Project Name</th>
            <th>Tower</th>
            <th>Status of the Project/Tower </th>
            <th>Date</th>
            <th>Price In Sq.fts</th>
            @if (\Request::route()->getName() != 'commercial-tower.ct-details')
                <th>Action</th>
            @endif
        </tr>

    </thead>

    <tbody>

        @forelse ($price_trends as $price_trend)
            <tr>
                <td>{{ $loop->iteration ?? 'N/A' }}</td>
                <td>{{ $property->project_name ?? 'N/A' }}</td>
                <td>{{ $price_trend->tower->tower_name ?? 'N/A' }}</td>
                <td>
                    @if (empty($price_trend->tower->tower_name))
                        {{ $price_trend->projectStatus->name ?? '' }}
                    @else
                        {{ $price_trend->towerStatus->name ?? '' }}
                    @endif
                </td>
                <td>{{ date('d-m-Y', strtotime($price_trend->date)) ?? 'N/A' }} </td>

                <td>{{ $price_trend->price ? $price_trend->price : 'N/A' }}</td>
                @if (\Request::route()->getName() != 'commercial-tower.ct-details')
                    <td>
                        <button data-ptid="{{ $price_trend->id ?? 0 }}"
                            data-tower_name="{{ $price_trend->tower->tower_name ?? 'N/A' }}"
                            data-tower_id="{{ $price_trend->tower_id ?? '0' }}"
                            data-project_status="{{ $price_trend->projectStatus->name ?? 'N/A' }}"
                            data-project_status_id="{{ $price_trend->project_status ?? '' }}"
                            data-tower_status_id="{{ $price_trend->tower_status ?? '' }}"
                            data-ptdate="{{ $price_trend->date ?? 'N/A' }}" data-ptprice="{{ $price_trend->price }}"
                            class="btn btn-warning btn-sm icons-f edit-price-trends" id="edit-price-trends">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </button>
                    </td>
                @endif
            </tr>
        @empty
            <tr align="center">
                <td colspan="6">No records Found</td>
            </tr>
        @endforelse

    </tbody>

    </table>

    <div id="pagination">

    {{ $price_trends->links('pagination::bootstrap-4', ['secure' => true]) }}

    </div>
</div>
