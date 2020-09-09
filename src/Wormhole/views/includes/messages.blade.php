<div class="wormholeIncludes" id="wormholeIncludeMessages">
    @if(isset($messages) && !empty($messages))
        <span class="wormholeNoRender"><icon>!</icon>{{ count($messages) }} messages were received</span>
    @else
        <span class="wormholeNoRender"><icon>!</icon>0 message was received</span>
    @endif
</div>
@include('includes.form')