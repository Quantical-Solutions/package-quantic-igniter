<div class="wormholeIncludes" id="wormholeIncludeMails">
    @if(isset($mails) && !empty($mails))
        <span class="wormholeNoRender"><icon>!</icon>{{ count($mails) }} mails were sent</span>
    @else
        <span class="wormholeNoRender"><icon>!</icon>0 mail was sent</span>
    @endif
</div>