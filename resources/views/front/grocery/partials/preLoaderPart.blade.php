@if ($bs->preloader_status == 1)
<div id="preLoader">
    <div class="loader">
        <img src="{{ asset('assets/front/img/' . $bs->preloader) }}" alt="Preloader">
    </div>
</div>
@endif