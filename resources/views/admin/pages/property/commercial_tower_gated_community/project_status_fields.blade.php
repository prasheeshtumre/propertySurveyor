@forelse($options as $key => $option)
    <div class="col-xxl-3 col-md-3 mt-3 append-filter-fields spdd-fields {{ $toggle_class_name }}">
        <div>
            <label for="" class="form-label">{{ $option->field_title }}<span class="errorcl">*</span></label>
            @if ($option->field_type == 'date')
                <input type="date" class="form-control" id="{{ $option->name_attribute }}"
                    name="{{ $option->name_attribute }}">
            @endif
            @if ($option->field_type == 'dropdown')
                <select class="form-select project-status {{ $option->class_name }}" name="{{ $option->name_attribute }}"
                    id="" data-type="{{ $option->data_attr_type }}">
                    @php echo get_psdd_options($option->model, $property_id, $option->level, $option->field_title, $tower_type); @endphp
                </select>
            @endif
        </div>
    </div>
@empty
@endforelse
