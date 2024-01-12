<div class="col-xxl-3 col-md-3 mt-3">
    <div>
        <label for="" class="form-label">Project Name @if(isset($mandatory) && $mandatory === true)<span class="errorcl">*</span>@endif</label>
        <input type="text" name="project_name" class="form-control @if(isset($mandatory) && $mandatory === true) ctfd-required @endif" id="">
    </div>
</div>