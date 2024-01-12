<li class="list-group-item">
    <span class="w-md-25">Builders / Builder Sub Groups</span><strong class="px-1 atp-title--seperator">:</strong>
    <!-- {{ $property->getBuilderName->name ?? 'N/A' }} -->
    <div class="d-flex flex-column">
        @forelse($property->builders as $builder)
        <b>{{$builder->name}}</b>
        <ul>
            @forelse($builder->sub_groups as $builderSubGroup)
            <li>{{$builderSubGroup->name}}</li>
            @empty
            <!-- <li>Not Available</li> -->
            @endforelse
        </ul>
        @empty
        @endforelse
    </div>
</li>