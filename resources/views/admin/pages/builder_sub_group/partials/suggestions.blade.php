@forelse($suggestions as $suggestion)
<label class="form-check-label text-center builder-group-label" data-id="{{ $suggestion->id ?? 0 }}">
    {{ $suggestion->name }}
</label>
@forelse($suggestion->sub_groups as $key=>$subGroup)
<div class="form-check">
    <input class="form-check-input builder-sg-chk parent__builder-{{ $suggestion->id}}" data-pid="{{ $suggestion->id ?? 0 }}" data-title="{{$subGroup->name ?? '' }}" type="checkbox" name="" value="{{ $subGroup->id }}" id="builderSubGroupSuggestion{{$key}}" @if(isset($builderSubGroupIds) && in_array($subGroup->id, $builderSubGroupIds)) checked disabled @endif >
    <label class="form-check-label" for="builderSubGroupSuggestion{{$key}}">
        {{ $subGroup->name }}
    </label>
</div>
@empty
<div class="form-check">
    <label class="form-check-label" for="">
        No Sub groups Found.
    </label>
</div>
@endforelse

@empty
<div class="form-check">
    <label class="form-check-label" for="">
        No Builders Selected.
    </label>
</div>
@endforelse