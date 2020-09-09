<div class="wormholeIncludes" id="wormholeIncludeConstellations">
    <ul>
        <li>
            <label>uri</label>
            <span class="thin">
            {{ (isset($env['constellation']['main']['request_type']))
                ? $env['constellation']['main']['request_type']
                : $_SERVER['REQUEST_METHOD'] }} {{ (isset($env['constellation']['main']['request_string']))
                ? $env['constellation']['main']['request_string']
                : '' }}
            </span>
        </li>
        <li>
            <label>vortex</label>
            <span class="thin">
            @if(isset($env['constellation']['main']['vortex']) && $env['constellation']['main']['vortex'] != '')
                    {{ $env['constellation']['main']['vortex'] }}
                @else
                    --
                @endif
            </span>
        </li>
        <li>
            <label>domain</label>
            <span class="thin">
            {{ (($_SERVER['HTTPS']) ? 'https://' : 'http://') . $_SERVER['SERVER_NAME'] }}
            </span>
        </li>
        <li>
            <label>as</label>
            <span class="thin">
            @if(isset($env['constellation']['main']['as']) && $env['constellation']['main']['as'] != '')
                    {{ $env['constellation']['main']['as'] }}
                @else
                    --
                @endif
            </span>
        </li>
        <li>
            <label>controller</label>
            <span class="thin">
            @if(isset($env['constellation']['main']['controller']) && $env['constellation']['main']['controller'] != '')
                    {{ $env['constellation']['main']['controller'] . ((isset($env['constellation']['main']['method']) &&
                    $env['constellation']['main']['method'] != '') ? '@' . $env['constellation']['main']['method'] : '') }}
                @else
                    --
                @endif
            </span>
        </li>
        <li>
            <label>namespace</label>
            <span class="thin">
            @if(isset($env['constellation']['main']['namespace']) && $env['constellation']['main']['namespace'] != '')
                    {{ $env['constellation']['main']['namespace'] }}
                @else
                    --
                @endif
            </span>
        </li>
        <li>
            <label>prefix</label>
            <span class="thin">
            @if(isset($env['constellation']['main']['prefix']) && $env['constellation']['main']['prefix'] != '')
                    {{ $env['constellation']['main']['prefix'] }}
                @else
                    --
                @endif
            </span>
        </li>
        <li>
            <label>file</label>
            <span class="thin">
            @if(isset($env['constellation']['main']['file']) && $env['constellation']['main']['file'] != '')
                    {{ $env['constellation']['main']['file'] }}
                @else
                    --
                @endif
            </span>
        </li>
    </ul>
</div>