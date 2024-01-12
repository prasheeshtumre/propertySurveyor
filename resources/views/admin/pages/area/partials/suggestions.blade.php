@forelse($suggestions as $key=>$suggestion)
<div class="form-check">
    <input class="form-check-input builder-chk" type="checkbox" name="builder[]" value="{{ $suggestion->id }}" id="builderSuggestion{{$key}}">
    <label class="form-check-label" for="builderSuggestion{{$key}}">
        {{ $suggestion->name }}
    </label>
</div>
@empty
<div class="form-check">
    <label class="form-check-label" for="">
        No Builders Found.
    </label>
</div>
@endforelse
@if($suggestions->hasMorePages())
<div id="load-more-container" class="lmc-{{ $suggestions->currentPage() + 1 }}">
    <button class="load-more" class="load-more-btn" type="button" data-next-page="{{ $suggestions->currentPage() + 1 }}">Load More</button>
</div>
@endif