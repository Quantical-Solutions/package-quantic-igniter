<div class="wormholeIncludes" id="wormholeIncludeGate">
    @if(isset($gate) && !empty($gate))
        <span class="wormholeNoRender"><icon>!</icon>{{ count($gate) }} gates were available</span>
    @else
        <span class="wormholeNoRender"><icon>!</icon>0 gate was available</span>
    @endif
</div>