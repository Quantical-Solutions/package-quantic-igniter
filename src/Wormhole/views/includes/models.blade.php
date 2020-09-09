<div class="wormholeIncludes" id="wormholeIncludeModels">
    @if(isset($models) && !empty($models))
        <span class="wormholeNoRender"><icon>!</icon>{{ count($models) }} models were used</span>
        <ul>
            @php dump($instant) @endphp
            @php dump($queries) @endphp
            @php dump($env) @endphp
        </ul>
    @else
        <span class="wormholeNoRender"><icon>!</icon>0 model was used</span>
    @endif
</div>
@include('includes.form')