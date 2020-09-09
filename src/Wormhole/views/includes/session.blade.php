<div class="wormholeIncludes" id="wormholeIncludeSession">
    <ul>
        @foreach($session as $key => $value)
            <li>
                <label>{{ $key }}</label>
                <span class="thin">
                @if(is_string($value))
                        {{ $value }}
                    @else
                        @php dump($value) @endphp
                    @endif
            </span>
            </li>
        @endforeach
    </ul>
</div>