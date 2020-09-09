<div class="wormholeIncludes" id="wormholeIncludeExceptions">
    @if(isset($exceptions) && !empty($exceptions))
        <div id="wormholeExceptionHead">
            <p id="wormholeExceptionMessage">{{ $exceptions['message'] }}</p>
            <p>{{ $exceptions['file'] }}#{{ $exceptions['line'] }}</p>
            <p id="wormholeErrorType">{{ $exceptions['severity'] }}</p>
        </div>
        <div id="wormholeExceptionDropdown">
            <div id="wormholeFilePreview">
                <table>
                    @foreach(file($exceptions['file']) as $key => $line)
                        @if($key >= ($exceptions['line'] - 4) && $key <= ($exceptions['line'] + 2))
                            @php $cssClass = ($key + 1 == $exceptions['line']) ? 'errorLine' : ''; @endphp
                            <tr class="{{ $cssClass }}">
                                <td class="lines">{{ $key + 1 }}</td>
                                <td><pre><code class="php">{{ $line }}</code></pre></td>
                            </tr>
                        @endif
                    @endforeach
                </table>
            </div>
            <ul>
                @foreach($exceptions['trace'] as $key => $trace)
                    <li>
                        <span class="wormholeTracesNb">#{{ $key }}</span>&nbsp;&nbsp;{{ $trace['file'] }}({{ $trace['line'] }}):&nbsp;
                        @if(isset($trace['class']) && isset($trace['type']))
                            {{ $trace['class'] }}{{ $trace['type'] }}
                        @endif
                        @isset($trace['function'])
                            {{ $trace['function'] . '(' }}
                        @endisset
                        @if(!empty($trace['args']))
                            @foreach($trace['args'] as $cle => $args)
                                @if(is_string($args) && $args != '')
                                    {{ $args }}
                                @elseif(is_array($args))
                                    {{ 'Array' }}
                                @elseif(is_object($args))
                                    {{ 'Object' }}
                                @endif
                                @if($cle < count($trace['args']) - 1)
                                    {{ ', ' }}
                                @endif
                            @endforeach
                        @endif
                        {{ ')' }}
                    </li>
                @endforeach
            </ul>
        </div>
    @else
        <span class="wormholeNoRender"><icon>!</icon>No exception caught</span>
    @endif
</div>