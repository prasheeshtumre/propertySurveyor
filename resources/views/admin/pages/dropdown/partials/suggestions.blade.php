@forelse($suggestions as $key=>$suggestion)
<div class="form-check">
    @php $currentkey = \Str::uuid(); @endphp
    <input class="form-check-input d-none auto-complete-label" type="radio" data-id="{{$suggestion->id ?? ''}}" value="{{ $suggestion->name ?? ''}}" data-name="{{$fieldName ?? ''}}" id="{{ $currentkey ?? 0}}">
    <label class="form-check-label" for="{{ $currentkey ?? 0 }}">
        {{ $suggestion->name ?? ''}}
    </label>
</div>
@empty
<div class="form-check">
    <label class="form-check-label" for="">
        No Data Found.
    </label>
</div>
@endforelse
@if($suggestions->hasMorePages())
<div id="load-more-container" class="lmc-{{ $suggestions->currentPage() + 1 }}">
    <button class="load-next" class="load-more-btn" type="button" data-name="{{$fieldName ?? ''}}" data-next-url="{{ $suggestions->path() ?? '' }}" data-next-page="{{ $suggestions->currentPage() + 1 }}">Load More</button>
</div>
@endif