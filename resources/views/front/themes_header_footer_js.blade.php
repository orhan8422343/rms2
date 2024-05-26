
     {{--- bakery theme js --}}
    @if ($activeTheme == 'bakery')
        @if (!request()->routeIs('front.index'))
            @include('front.bakery.include.bakery_header_footer_js')
        @endif
    @endif
     {{--- End bakery Theme js  ---}}

    @if ($activeTheme == 'pizza')
        @if (!request()->routeIs('front.index'))
            @include('front.pizza.include.pizza_header_footer_js')
        @endif
    @endif

    @if ($activeTheme == 'coffee')
        @if (!request()->routeIs('front.index'))
            @include('front.coffee.include.coffee_header_footer_js')
        @endif
    @endif

    @if ($activeTheme == 'medicine')
        @if (!request()->routeIs('front.index'))
            @include('front.medicine.include.medicine_header_footer_js')
        @endif
    @endif

@if ($activeTheme == 'grocery')
    @if (!request()->routeIs('front.index'))
        @include('front.grocery.include.grocery_header_footer_js')
    @endif
@endif

@if ($activeTheme == 'beverage')
    @if (!request()->routeIs('front.index'))
        @include('front.beverage.include.beverage_header_footer_js')
    @endif
@endif