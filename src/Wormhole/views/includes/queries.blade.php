<div class="wormholeIncludes" id="wormholeIncludeQueries">
    @if(isset($queries) && !empty($queries))
        <span class="wormholeNoRender"><icon>!</icon>{{ count($queries) }} queries were executed</span>
        <ul id="wormholeQueriesStack">
            @foreach($queries as $query)
                <li>
                    <div>
                        <pre><code class="sql">{{ $query['query'] }}</code></pre>
                    </div>
                    <div>
                        <p>
                            <svg viewBox="0 0 32 32">
                                <path d="M20.586 23.414l-6.586-6.586v-8.828h4v7.172l5.414 5.414zM16 0c-8.837 0-16 7.163-16 16s7.163 16 16 16 16-7.163 16-16-7.163-16-16-16zM16 28c-6.627 0-12-5.373-12-12s5.373-12 12-12c6.627 0 12 5.373 12 12s-5.373 12-12 12z"></path>
                            </svg>
                            {{ $query['time'] }}ms
                        </p>
                        <p>
                            <svg viewBox="0 0 32 32">
                                <path d="M17 0l-3 3 3 3-7 8h-7l5.5 5.5-8.5 11.269v1.231h1.231l11.269-8.5 5.5 5.5v-7l8-7 3 3 3-3-15-15zM14 17l-2-2 7-7 2 2-7 7z"></path>
                            </svg>
                            {{ $query['loc'] }}
                        </p>
                        <p>
                            <svg viewBox="0 0 40 32">
                                <path d="M26 23l3 3 10-10-10-10-3 3 7 7z"></path>
                                <path d="M14 9l-3-3-10 10 10 10 3-3-7-7z"></path>
                                <path d="M21.916 4.704l2.171 0.592-6 22.001-2.171-0.592 6-22.001z"></path>
                            </svg>
                            {!! $query['func'] !!}
                        </p>
                        <p>
                            <svg viewBox="0 0 32 32">
                                <path d="M16 0c-8.837 0-16 2.239-16 5v4c0 2.761 7.163 5 16 5s16-2.239 16-5v-4c0-2.761-7.163-5-16-5z"></path>
                                <path d="M16 17c-8.837 0-16-2.239-16-5v6c0 2.761 7.163 5 16 5s16-2.239 16-5v-6c0 2.761-7.163 5-16 5z"></path>
                                <path d="M16 26c-8.837 0-16-2.239-16-5v6c0 2.761 7.163 5 16 5s16-2.239 16-5v-6c0 2.761-7.163 5-16 5z"></path>
                            </svg>
                            {{ $query['db'] }}
                        </p>
                    </div>
                </li>
            @endforeach
        </ul>
    @else
        <span class="wormholeNoRender"><icon>!</icon>0 query was executed</span>
    @endif
</div>