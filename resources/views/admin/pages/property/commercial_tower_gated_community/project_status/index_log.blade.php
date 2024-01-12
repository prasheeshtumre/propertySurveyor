<div class="card bg-light border border-dark">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table-bordered table table-stripped ">
                <thead style="background: #bbbbbb;">
                    <tr>
                        <th>Sl.no</th>
                        <th>Project Status</th>
                        <th>Project Expected Date Of Start </th>
                        <th>Project Expected Date Of Completion </th>
                        <th>Project Date Of Completion</th>
                        <th>Updated date</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($project_status_log as $status)
                        <tr>
                            <td>{{ $loop->iteration ?? 'N/A' }}</td>
                            <td>{{ $status->projectStatus->name ?? 'N/A' }}</td>
                            <td>
                                @if (!empty($status->project_expected_date_of_start))
                                    {{ date('d-m-Y', strtotime($status->project_expected_date_of_start)) ?? 'N/A' }}
                                @else
                                    N/A
                                @endif
                            </td>
                            <td>
                                @if (!empty($status->project_expected_date_of_completion))
                                    {{ date('d-m-Y', strtotime($status->project_expected_date_of_completion)) ?? 'N/A' }}
                                @else
                                    N/A
                                @endif
                            </td>
                            <td>
                                @if (!empty($status->project_date_of_completion))
                                    {{ date('d-m-Y', strtotime($status->project_date_of_completion)) ?? 'N/A' }}
                                @else
                                    N/A
                                @endif
                            </td>
                            <th>{{ date('d-m-Y H:i:s', strtotime($status->created_at)) }}</th>
                        </tr>
                    @empty
                    <tr align="center">
                        <td  colspan="6" >No records Found</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            <div id="pagination">
                {{-- {{ $project_status_log->links('pagination::bootstrap-4', ['secure' => true]) }} --}}
            </div>
        </div>
    </div>
</div>
<div class="card bg-light border border-dark">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table-bordered table table-stripped">
                <thead style="background: #bbbbbb;">
                    @if ($property->residential_type == config('constants.APARTMENT'))
                        <tr>
                            <th>Sl.no</th>
                            <th>Tower</th>
                            <th>Tower Status</th>
                            <th>Tower Expected Date Of Start</th>
                            <th>Tower Expected Date Of Completion </th>
                            <th>Tower Date Of Completion</th>
                            <th>Construction Stage</th>
                            <th>Floor Range</th>
                            <th>Updated date</th>
                        </tr>
                    @else
                        <tr>
                            <th>Sl.no</th>
                            <th>Unit</th>
                            <th>Unit Status</th>
                            <th>Unit Expected Date Of Start</th>
                            <th>Unit Expected Date Of Completion </th>
                            <th>Unit Date Of Completion</th>
                            <th>Construction Stage</th>
                            {{-- <th>Floor Range</th> --}}
                            <th>Updated date</th>
                        </tr>
                    @endif
                </thead>
                <tbody>
                    @forelse($towers as $tower)
                        <tr>
                            <td>{{ $loop->iteration ?? 'N/A' }}</td>
                            <td>{{ $tower->towerName->tower_name ?? '' }}</td>
                            <td>{{ $tower->towerStatus->name ?? 'N/A' }}</td>
                            <td>
                                @if (!empty($tower->tower_expected_date_of_start))
                                    {{ date('d-m-Y', strtotime($tower->tower_expected_date_of_start)) ?? 'N/A' }}
                                @else
                                    N/A
                                @endif
                            </td>
                            <td>
                                @if (!empty($tower->tower_expected_date_of_completion))
                                    {{ date('d-m-Y', strtotime($tower->tower_expected_date_of_completion)) ?? 'N/A' }}
                                @else
                                    N/A
                                @endif
                            </td>
                            <td>
                                @if (!empty($tower->tower_date_of_completion))
                                    {{ date('d-m-Y', strtotime($tower->tower_date_of_completion)) ?? 'N/A' }}
                                @else
                                    N/A
                                @endif
                            </td>
                            <td>{{ $tower->constructionStage->stage_name ?? 'N/A' }}</td>
                            @if ($property->residential_type == config('constants.APARTMENT'))
                                <td>{{ $tower->FloorRangesPerTower->floor_range ?? 'N/A' }}</td>
                            @endif
                            <th>{{ date('d-m-Y H:i:s', strtotime($tower->created_at)) }}</th>
                        </tr>
                    @empty
                     <tr align="center">
                        <td  colspan="8" >No records Found</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            <div id="pagination">
                {{-- {{ $project_status_log->links('pagination::bootstrap-4', ['secure' => true]) }} --}}
            </div>
        </div>
    </div>
</div>
