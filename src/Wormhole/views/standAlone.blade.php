<div id="wormholeStandAlone" data-mode="{{ config('wormhole.mode') }}">
    <h3 style="color: #fff;">Config Debugger</h3>
    <span id="debugger_desc" style="color: #fff;">Debugger Mode : <b class="code_blue"><i>{{ $debugMethod }}</i></b></span>
    <hr>
    <pre id="debug_pre_tag">

    @php switch (config('wormhole.mode')) {
        case 'vd':

            var_dump($GLOBALS);
            break;

        case 'pr':
            print_r($GLOBALS);
            break;

        default:

            echo '<span style="width: 100%; text-align: center;" class="code_red">Mode inconnu...</span>';
            break;
    } @endphp

    </pre>
    <div id="debug_replace_tag_container">
        <div id="debug_replace_tag"></div>
    </div>
</div>