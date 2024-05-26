@if ($bs->preloader_status == 1)
<div id="preloader">
    <div class="loader revolve">
        <img src="{{ asset('assets/front/img/' . $bs->preloader) }}" alt="">
    </div>
</div>
@endif