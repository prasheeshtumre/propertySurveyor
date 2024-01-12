@forelse($floors as $floor_key=>$floor)
    <div
        class="row gx-2 mt-3 py-2 align-items-center floor_no_child storey pfloor-{{ $floor_key }} rounded border border-dark">

        <p class="tower-title mb-3"><b>{{ $floor->floor_name ?? '' }}</b></p>

        <ul class="block-items clearfix">
            @if ($floor->units > 1)
                @forelse($units as $key=>$unit)
                    @if ($floor->id == $unit->floor_id)
                        <li><a target="__blank"
                                href="{{ url('surveyor/property/unit_details') }}/{{ $unit->id }}">{{ $unit->unit_name == '' ? $floor->floor_name : $unit->unit_name }}</a>
                        </li>
                    @endif
                @empty
                @endforelse
            @else
                @forelse($single_units as $key=>$unit)
                    @if ($floor->id == $unit->floor_id)
                        <li><a target="__blank"
                                href="{{ url('surveyor/property/unit_details') }}/{{ $unit->id }}">{{ $unit->unit_name == '' ? $floor->floor_name : $unit->unit_name }}</a>
                        </li>
                    @endif
                @empty
                @endforelse
            @endif
        </ul>
    </div>
@empty
@endforelse
