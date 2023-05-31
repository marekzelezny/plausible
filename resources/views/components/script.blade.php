<script
    defer
    data-domain="{{ plausible('domain') }}"
    src="{{ plausible('trackingUrl') }}"
></script>

<script>
    window.plausible = window.plausible || function() {
        (window.plausible.q = window.plausible.q || []).push(arguments)
    }

    @if(plausible()->tracks('pageview_properties'))
        @if(plausible()->properties('simple'))
            plausible('pageview', {
                props: @json(plausible()->properties('simple'))
            });
        @endif

        @foreach(plausible()->properties('array') as $property)
            plausible('pageview', {
                props: @json($property)
            });
        @endforeach
    @endif
</script>