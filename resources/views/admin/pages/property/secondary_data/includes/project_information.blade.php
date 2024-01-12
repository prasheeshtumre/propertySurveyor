<div class="row border-bottom pt-3 pb-3">
    <div class="col-md-4">
        <p><b>Project Name : </b> <span class="project-head">
                {{ $property->project_name ?? '' }}</span></p>
    </div>
    <div class="col-md-4">
        <p><b>Builder Name : </b> <span class="project-head">{{ $property->getBuilderName->name ?? '' }}</span>
        </p>
    </div>
    <div class="col-md-4">
        <p><b>Address : </b> <span class="project-head">
                {{ $property->locality_name ?? '' }} </span></p>
    </div>
</div>
