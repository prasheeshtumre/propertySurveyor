<div class="card bg-light">
    <div class="card-body">
        <div class="">

            @if(!empty($property->project_status))
            <div class="Unit_Details"><strong>Project Status :</strong> <span>{{$property->projectStatus->name ?? ''}}</span> </div>
            @endif
            @if(!empty($property->project_expected_date_of_start))
            <div class="Unit_Details"><strong>Project Expected Date Of Start :</strong> <span>{{$property->project_expected_date_of_start ?? ''}}</span> </div>
            @endif
            @if(!empty($property->project_expected_date_of_completion))
            <div class="Unit_Details"><strong>Project Expected Date Of Completion :</strong> <span>{{$property->project_expected_date_of_completion ?? ''}}</span> </div>
            @endif
            @if(!empty($property->project_date_of_completion))
            <div class="Unit_Details"><strong>Project Date Of Completion :</strong> <span>{{$property->project_date_of_completion ?? ''}}</span> </div>
            @endif

        </div>
    </div>
</div>

<div class="row">
    @forelse($towers as $tower)
    <div class="col-md-12 col-xxl-12">
        <div class="card bg-light border border-secondary">
            <div class="card-body">
                <div class="">

                    <div class="Unit_Details"><strong>Tower :</strong> <span>{{$tower->tower_name ?? ''}}</span> </div>

                    @if(!empty($tower->tower_status))
                    <div class="Unit_Details"><strong>Tower Status :</strong> <span>{{$tower->towerStatus->name ?? ''}}</span> </div>
                    @endif

                    @if(!empty($tower->tower_expected_date_of_start))
                    <div class="Unit_Details"><strong>Tower Expected Date Of Start :</strong> <span>{{$tower->tower_expected_date_of_start ?? ''}}</span> </div>
                    @endif

                    @if(!empty($tower->tower_expected_date_of_completion))
                    <div class="Unit_Details"><strong>Tower Expected Date Of Completion :</strong> <span>{{$tower->tower_expected_date_of_completion ?? ''}}</span> </div>
                    @endif

                    @if(!empty($tower->tower_date_of_completion))
                    <div class="Unit_Details"><strong>Tower Date Of Completion :</strong> <span>{{$tower->tower_date_of_completion ?? ''}}</span> </div>
                    @endif

                    @if(!empty($tower->construction_stage))
                    <div class="Unit_Details"><strong>Construction Stage :</strong> <span>{{$tower->constructionStage->stage_name ?? ''}}</span> </div>
                    @endif

                    @if(!empty($tower->floor_range))
                    <div class="Unit_Details"><strong>Floor Range :</strong> <span>{{$tower->floor_range ?? ''}}</span> </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
    @empty

    @endforelse

</div>
