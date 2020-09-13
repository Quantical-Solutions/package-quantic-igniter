<div class="wormholeIncludes" id="wormholeIncludeMessages">
    @if(isset($messages) && !empty($messages))
        <span class="wormholeNoRender"><icon>!</icon>{{ count($messages) }} messages were received</span>
        <ul id="wormholeMessagesStack">
            @foreach($messages as $message)
                <li>
                    <div>
                    @switch($message['type'])
                        @case('DUMP')
                        <svg class="wormhole{{ $message['type'] }}" viewBox="0 0 32 32">
                            <path d="M28 4h-24c-1.105 0-2 0.896-2 2v20c0 1.104 0.895 2 2 2h24c1.104 0 2-0.896 2-2v-20c0-1.104-0.896-2-2-2zM11.562 5.5c0.552 0 0.999 0.448 0.999 1s-0.447 1-0.999 1c-0.553 0-1-0.448-1-1s0.448-1 1-1zM8.5 5.5c0.552 0 1 0.448 1 1s-0.448 1-1 1c-0.553 0-1-0.448-1-1s0.447-1 1-1zM5.499 5.5c0.553 0 1 0.448 1 1s-0.447 1-1 1c-0.552 0-0.999-0.448-0.999-1s0.447-1 0.999-1zM28 26h-24v-16.979h24v16.979zM28 7.021h-14v-1h14v1z"></path>
                        </svg>
                        @break
                        @case('INFO')
                        <svg class="wormhole{{ $message['type'] }}" viewBox="0 0 32 32">
                            <path d="M16 3c-7.18 0-13 5.82-13 13s5.82 13 13 13 13-5.82 13-13-5.82-13-13-13zM18.039 20.783c-0.981 1.473-1.979 2.608-3.658 2.608-1.146-0.187-1.617-1.008-1.369-1.845l2.16-7.154c0.053-0.175-0.035-0.362-0.195-0.419-0.159-0.056-0.471 0.151-0.741 0.447l-1.306 1.571c-0.035-0.264-0.004-0.7-0.004-0.876 0.981-1.473 2.593-2.635 3.686-2.635 1.039 0.106 1.531 0.937 1.35 1.85l-2.175 7.189c-0.029 0.162 0.057 0.327 0.204 0.379 0.16 0.056 0.496-0.151 0.767-0.447l1.305-1.57c0.035 0.264-0.024 0.726-0.024 0.902zM17.748 11.439c-0.826 0-1.496-0.602-1.496-1.488s0.67-1.487 1.496-1.487 1.496 0.602 1.496 1.487c0 0.887-0.67 1.488-1.496 1.488z"></path>
                        </svg>
                        @break
                        @case('WARNING')
                        <svg class="wormhole{{ $message['type'] }}" viewBox="0 0 32 32">
                            <path d="M30.555 25.219l-12.519-21.436c-1.044-1.044-2.738-1.044-3.782 0l-12.52 21.436c-1.044 1.043-1.044 2.736 0 3.781h28.82c1.046-1.045 1.046-2.738 0.001-3.781zM14.992 11.478c0-0.829 0.672-1.5 1.5-1.5s1.5 0.671 1.5 1.5v7c0 0.828-0.672 1.5-1.5 1.5s-1.5-0.672-1.5-1.5v-7zM16.501 24.986c-0.828 0-1.5-0.67-1.5-1.5 0-0.828 0.672-1.5 1.5-1.5s1.5 0.672 1.5 1.5c0 0.83-0.672 1.5-1.5 1.5z"></path>
                        </svg>
                        @break
                        @case('ERROR')
                        <svg class="wormhole{{ $message['type'] }}" viewBox="0 0 32 32">
                            <path d="M16 29c-7.18 0-13-5.82-13-13s5.82-13 13-13 13 5.82 13 13-5.82 13-13 13zM21.961 12.209c0.244-0.244 0.244-0.641 0-0.885l-1.328-1.327c-0.244-0.244-0.641-0.244-0.885 0l-3.761 3.761-3.761-3.761c-0.244-0.244-0.641-0.244-0.885 0l-1.328 1.327c-0.244 0.244-0.244 0.641 0 0.885l3.762 3.762-3.762 3.76c-0.244 0.244-0.244 0.641 0 0.885l1.328 1.328c0.244 0.244 0.641 0.244 0.885 0l3.761-3.762 3.761 3.762c0.244 0.244 0.641 0.244 0.885 0l1.328-1.328c0.244-0.244 0.244-0.641 0-0.885l-3.762-3.76 3.762-3.762z"></path>
                        </svg>
                        @break
                    @endswitch
                        <span class="wormhole{{ $message['type'] }}">{{ ucfirst(strtolower($message['type'])) }}</span>
                    @if($message['is_html'] == true)
                        <p>&nbsp;&nbsp;HTML type</p>
                    </div>
                    <pre><code class="html">{{ $message['message'] }}</code></pre>
                    @else
                    </div>
                        @if($message['is_string'] == true)
                    <div>
                        <p class="wormhole{{ $message['type'] }}">"{{ $message['message'] }}"</p>
                    </div>
                        @elseif($message['is_string'] == false && !is_array($message['message']) && !is_object($message['message']))
                    <div>
                        <p class="wormhole{{ $message['type'] }}">{{ $message['message'] }}</p>
                    </div>
                        @else
                        @php dump($message['message']) @endphp
                        @endif
                    @endif
                </li>
            @endforeach
        </ul>
    @else
        <span class="wormholeNoRender"><icon>!</icon>0 message was received</span>
    @endif
    </div>
@include('includes.form')