<div class="wormholeIncludes" id="wormholeIncludeQueries">
    @if(isset($queries) && !empty($queries))
         <span class="wormholeNoRender"><icon>!</icon>{{ count($queries) }} queries were executed</span>
         @php dump($queries); @endphp
    @else
        <span class="wormholeNoRender"><icon>!</icon>0 query was executed</span>
    @endif
</div>