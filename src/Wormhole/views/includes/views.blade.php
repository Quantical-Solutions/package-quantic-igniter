<div class="wormholeIncludes" id="wormholeIncludeViews">
    @if(!empty($instant['views']))
        <span class="wormholeNoRender"><icon>!</icon>{{ count($instant['views']) }} templates were rendered</span>
        <ul id="wormholeViewsStack">
            @foreach($instant['views'] as $view)
                <li>
                    <p>{{ $view['name'] }}&nbsp;&nbsp;({{ substr($view['paths'], 1) }})</p>
                    <p>
                        &lt;/&gt; blade
                        <svg viewBox="0 0 32 32">
                            <path d="M3 4v25h25v-25h-25zM15 28h-11v-17h11v17zM27 28h-11v-17h11v17zM27 10h-23v-5h23v5z"></path>
                        </svg>
                        {!! (isset($view['params']) && !empty($view['params']))
                            ? count($view['params'])
                            : 0 !!}
                    </p>
                    @if(isset($view['params']) && !empty($view['params']))
                        <div class="varsDropDown">
                            <table>
                                <thead>
                                <tr>
                                    <th colspan="2">Params</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($view['params'] as $key => $param)
                                    <tr>
                                        <td class="keyTable">{{ $key }}</td>
                                        <td>{{ $param }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </li>
            @endforeach
        </ul>
    @else
        <span class="wormholeNoRender"><icon>!</icon>0 template was rendered</span>
    @endif
</div>
@include('includes.form')