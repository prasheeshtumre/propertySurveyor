<div class="mainDiiv">
    @forelse($secondary_level_unit_data->getImages($secondary_level_unit_data->unit_id, $secondary_level_unit_data->property_id) as $rec)
        <div class="img-container">
            <a data-fancybox="gallery" href="{{ asset($rec->file_path . '/' . $rec->file_name) }}">
                <img src="{{ asset($rec->file_path . '/' . $rec->file_name) }}" width="100">
            </a>
        </div>
    @empty
    @endforelse
</div>
