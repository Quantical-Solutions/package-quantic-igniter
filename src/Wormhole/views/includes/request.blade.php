<div class="wormholeIncludes" id="wormholeIncludeRequest">
    <ul>
        <li>
            <label>path_info</label>
            <span class="thin">{{ $path_info }}</span>
        </li>
        <li>
            <label>status_code</label>
            {!! $status_code !!}
        </li>
        <li>
            <label>status_text</label>
            <span class="thin">{{ $status_text }}</span>
        </li>
        <li>
            <label>format</label>
            <span class="thin" id="request_format"></span>
        </li>
        <li>
            <label>content_type</label>
            <span class="thin" id="request_content_type"></span>
        </li>
        <li>
            <label>request_query</label>
            <span>@php dump($query) @endphp</span>
        </li>
        <li>
            <label>request_request</label>
            <span>@php dump($request) @endphp</span>
        </li>
        <li>
            <label>request_headers</label>
            <span>@php dump($headers) @endphp</span>
        </li>
        <li>
            <label>request_server</label>
            <span>@php dump($server) @endphp</span>
        </li>
        <li>
            <label>request_cookies</label>
            <span>@php dump($cookies) @endphp</span>
        </li>
        <li>
            <label>response_headers</label>
            <span>@php dump($headers_list) @endphp</span>
        </li>
        <li>
            <label>session_attributes</label>
            <span>@php dump($session) @endphp</span>
        </li>
    </ul>
</div>