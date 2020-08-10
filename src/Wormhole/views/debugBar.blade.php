<div id="wormholeBottomBarBtn" class="display_wormholeBottomBarBtn">
    <svg viewBox="0 0 719.3 719.3">
        <path class="logo-st0" d="M570.9,446.7c11-26.8,17.1-56.1,17.1-86.9c0-126.1-102.2-228.3-228.3-228.3S131.3,233.7,131.3,359.8s102.2,228.3,228.3,228.3"/>
        <line class="logo-st0" x1="359.6" y1="588.2" x2="490.2" y2="588.2"/>
        <path class="logo-st1" d="M468.3,468.1c27.8-27.8,45-66.3,45-108.7c0-84.9-68.8-153.7-153.7-153.7c-22.4,0-43.6,4.8-62.8,13.4"/>
        <path class="logo-st2" d="M286.1,404.5c15.1,24.7,42.3,41.1,73.3,41.1c5.9,0,11.7-0.6,17.3-1.7"/>
        <path class="logo-st1" d="M241.9,260.1c-22.7,26.9-36.4,61.6-36.4,99.5c0,79.8,60.7,145.5,138.4,153.4"/>
        <path class="logo-st1" d="M512.9,376.1c0.6-5.4,0.9-10.9,0.9-16.4c0-85.1-69-154.2-154.2-154.2c-27.2,0-52.7,7-74.9,19.4"/>
        <path class="logo-st2" d="M389.4,278.9c-9.3-3.5-19.4-5.4-30-5.4c-47.5,0-86.1,38.5-86.1,86.1"/>
        <path class="logo-st2" d="M424.9,415.5c12.9-15,20.6-34.6,20.6-55.9c0-25.2-10.8-47.9-28.1-63.6"/>
    </svg>
</div>
<div id="wormholeBottomBarFolderOpen">
    @include('includes.window')
</div>
@isset($ux)
    <div id="wormholeBottomBarUXOpen">
        @include('includes.ux')
    </div>
@endisset
<div id="wormholeBottomBar">
    <style>{!! file_get_contents(dirname(__DIR__) . '/assets/style.css') !!}</style>
    <div id="resize-wormholeBottomBar">
        <span>___</span>
        <span>___</span>
        <span>___</span>
    </div>
    <div id="wormholeBottomBarHeader">
        <div id="wormholeBottomBarHeaderLeft">
            <div id="wormholeBottomBarBtn2">
                <svg viewBox="0 0 719.3 719.3">
                    <path class="logo-st0" d="M570.9,446.7c11-26.8,17.1-56.1,17.1-86.9c0-126.1-102.2-228.3-228.3-228.3S131.3,233.7,131.3,359.8s102.2,228.3,228.3,228.3"/>
                    <line class="logo-st0" x1="359.6" y1="588.2" x2="490.2" y2="588.2"/>
                    <path class="logo-st1" d="M468.3,468.1c27.8-27.8,45-66.3,45-108.7c0-84.9-68.8-153.7-153.7-153.7c-22.4,0-43.6,4.8-62.8,13.4"/>
                    <path class="logo-st2" d="M286.1,404.5c15.1,24.7,42.3,41.1,73.3,41.1c5.9,0,11.7-0.6,17.3-1.7"/>
                    <path class="logo-st1" d="M241.9,260.1c-22.7,26.9-36.4,61.6-36.4,99.5c0,79.8,60.7,145.5,138.4,153.4"/>
                    <path class="logo-st1" d="M512.9,376.1c0.6-5.4,0.9-10.9,0.9-16.4c0-85.1-69-154.2-154.2-154.2c-27.2,0-52.7,7-74.9,19.4"/>
                    <path class="logo-st2" d="M389.4,278.9c-9.3-3.5-19.4-5.4-30-5.4c-47.5,0-86.1,38.5-86.1,86.1"/>
                    <path class="logo-st2" d="M424.9,415.5c12.9-15,20.6-34.6,20.6-55.9c0-25.2-10.8-47.9-28.1-63.6"/>
                </svg>
            </div>
            <p data-id="wormhole-message" class="wormholeBottomBarHeaderLeftSelected">
                <span class="wormholeNoResp">Messages</span>
                <svg class="wormholeBottomBarHeaderLeftSvg" viewBox="0 0 32 32">
                    <path d="M16.984 16.047h-8v0.906h8v-0.906zM16.984 19.047h-8v0.969h8v-0.969zM12.016 4.016v3.016h-3.032v3.016h-2.953v18.938h13.969v-3.031h2.953v-2.938h3.016v-19h-13.953zM19.031 28.016h-12.031v-17.063h12.031v17.063zM21.984 25.047h-1.984v-15h-10.047v-2.047h12.031v17.047zM25 22.047h-2.047v-15.016h-9.969v-2.047h12.016v17.063zM16.984 25.031h-8v0.969h8v-0.969zM16.984 22.016h-8v0.969h8v-0.969zM16.999 13.016h-8v1h8v-1z"></path>
                </svg>
                @if(false)
                    <span class="wormholeBottomBarCounter">3</span>
                @endif
            </p>
            <p data-id="wormhole-timeline">
                <span class="wormholeNoResp">Timeline</span>
                <svg class="wormholeBottomBarHeaderLeftSvg" viewBox="0 0 32 32">
                    <path d="M27 15.031h-20v5h20c0.552 0 1-0.447 1-1v-3c0-0.552-0.448-1-1-1zM22 25.031v-3c0-0.553-0.448-1-1-1h-14v5h14c0.552 0 1-0.447 1-1zM16 13.031v-3c0-0.552-0.448-1-1-1h-8v5h8c0.552 0 1-0.448 1-1zM10 7.031v-3c0-0.553-0.448-1-1-1h-2v5h2c0.552 0 1-0.448 1-1zM5 3.031h-1v25.938h24v-1h-23v-24.938z"></path>
                </svg>
            </p>
            <p data-id="wormhole-exceptions">
                <span class="wormholeNoResp">Exceptions</span>
                <svg class="wormholeBottomBarHeaderLeftSvg" viewBox="0 0 20 20">
                    <path d="M15.3 14.89l2.77 2.77c0.18 0.181 0.291 0.43 0.291 0.705s-0.111 0.524-0.291 0.705l0-0c-0.181 0.18-0.43 0.291-0.705 0.291s-0.524-0.111-0.705-0.291l0 0-2.59-2.58c-0.825 0.765-1.872 1.303-3.034 1.505l-0.036 0.005v-8.96c0-0.552-0.448-1-1-1s-1 0.448-1 1v0 8.96c-1.198-0.207-2.245-0.744-3.074-1.513l0.004 0.003-2.59 2.58c-0.181 0.18-0.43 0.291-0.705 0.291s-0.524-0.111-0.705-0.291l0 0c-0.18-0.181-0.291-0.43-0.291-0.705s0.111-0.524 0.291-0.705l2.77-2.77c-0.298-0.547-0.518-1.183-0.626-1.856l-0.004-0.034h-3.070c-0.552 0-1-0.448-1-1s0.448-1 1-1v0h3v-2.59l-3.070-3.070c-0.18-0.181-0.291-0.43-0.291-0.705s0.111-0.524 0.291-0.705l-0 0c0.181-0.18 0.43-0.291 0.705-0.291s0.524 0.111 0.705 0.291l2.1 2.1h11.12l2.1-2.1c0.181-0.18 0.43-0.291 0.705-0.291s0.524 0.111 0.705 0.291l-0-0c0.18 0.181 0.291 0.43 0.291 0.705s-0.111 0.524-0.291 0.705l-3.070 3.070v2.59h3c0.552 0 1 0.448 1 1s-0.448 1-1 1v0h-3.070c-0.1 0.67-0.32 1.31-0.63 1.89zM15 5h-10c0-2.761 2.239-5 5-5s5 2.239 5 5v0z"></path>
                </svg>
                @if(false)
                    <span class="wormholeBottomBarCounter">3</span>
                @endif
            </p>
            <p data-id="wormhole-views">
                <span class="wormholeNoResp">Views</span>
                <svg class="wormholeBottomBarHeaderLeftSvg" viewBox="0 0 20 20">
                    <path d="M19.025 3.587c-4.356 2.556-4.044 7.806-7.096 10.175-2.297 1.783-5.538 0.88-7.412 0.113 0 0-1.27 1.603-2.181 3.74-0.305 0.717-1.644-0.073-1.409-0.68 2.978-7.685 13.11-11.519 13.11-11.519s-7.149-0.303-11.927 5.94c-0.128-1.426-0.34-5.284 3.36-7.65 5.016-3.211 14.572-0.715 13.555-0.119z"></path>
                </svg>
                @if(true)
                    <span class="wormholeBottomBarCounter">3</span>
                @endif
            </p>
            <p data-id="wormhole-constellation">
                <span class="wormholeNoResp">Constellation</span>
                <svg class="wormholeBottomBarHeaderLeftSvg" viewBox="0 0 32 32">
                    <path d="M17.987 3h-5v3h5v-3zM17.987 15v-2h-5v2h5zM12.987 30h5v-8h-5v8zM24.987 12l-2.187-2.5 2.187-2.5h-16l-2.6 2.5 2.6 2.5h16zM22.987 16h-16l2.188 2.5-2.188 2.5h16l2.625-2.5-2.625-2.5z"></path>
                </svg>
            </p>
            <p data-id="wormhole-queries">
                <span class="wormholeNoResp">Queries</span>
                <svg class="wormholeBottomBarHeaderLeftSvg" viewBox="0 0 20 20">
                    <path d="M16.726 12.641c-0.843 1.363-3.535 2.361-6.726 2.361s-5.883-0.998-6.727-2.361c-0.178-0.29-0.273-0.135-0.273 0.007 0 0.144 0 2.002 0 2.002 0 1.94 3.134 3.95 7 3.95s7-2.010 7-3.949c0 0 0-1.858 0-2.002s-0.096-0.298-0.274-0.008zM16.737 7.525c-0.83 1.205-3.532 2.090-6.737 2.090s-5.908-0.885-6.738-2.090c-0.171-0.248-0.262-0.113-0.262-0.002 0 0.113 0 2.357 0 2.357 0 1.762 3.134 3.189 7 3.189s7-1.428 7-3.189c0 0 0-2.244 0-2.357 0-0.111-0.092-0.246-0.263 0.002zM10 1c-3.866 0-7 1.18-7 2.633v1.26c0 1.541 3.134 2.791 7 2.791s7-1.25 7-2.791v-1.26c0-1.453-3.134-2.633-7-2.633z"></path>
                </svg>
                @if(false)
                    <span class="wormholeBottomBarCounter">3</span>
                @endif
            </p>
            <p data-id="wormhole-models">
                <span class="wormholeNoResp">Models</span>
                <svg class="wormholeBottomBarHeaderLeftSvg" viewBox="0 0 32 32">
                    <path d="M28.608 11.246l-12.608-8.632-12.608 8.632 12.608 8.631 12.608-8.631zM16 21.803l-11.129-7.338-1.479 1.535 12.608 8.631 12.608-8.631-1.499-1.568-11.109 7.371zM16 26.559l-11.129-7.338-1.479 1.535 12.608 8.631 12.608-8.631-1.499-1.568-11.109 7.371z"></path>
                </svg>
                @if(false)
                    <span class="wormholeBottomBarCounter">3</span>
                @endif
            </p>
            <p data-id="wormhole-mails">
                <span class="wormholeNoResp">Mails</span>
                <svg class="wormholeBottomBarHeaderLeftSvg" viewBox="0 0 32 32">
                    <path d="M21.6 8h-11l-6.6 9v5c0 1.104 0.896 2 2 2h20c1.104 0 2-0.896 2-2v-5l-6.4-9zM22.465 17.023l-2.052 3.002-8.588-0.020-2.202-2.994-4.086-0.024 5.663-7.974h9.8l5.6 7.975-4.135 0.035z"></path>
                </svg>
                @if(false)
                    <span class="wormholeBottomBarCounter">3</span>
                @endif
            </p>
            <p data-id="wormhole-gate">
                <span class="wormholeNoResp">Gate</span>
                <svg class="wormholeBottomBarHeaderLeftSvg" viewBox="0 0 32 32">
                    <path d="M27 29l-1.999-0.062v2.062h-3v-2h-11.938l-0.062 2h-3v-1.938l-2.001-0.062c-1.104 0-2-0.896-2-2v-24c0-1.104 0.896-2 2-2h22c1.104 0 2 0.896 2 2v24c0 1.104-0.896 2-2 2zM26 4h-20v3.958l-0.979-0.020v3.083h0.979v7.917h-1v3.062h1v4h20v-22zM25 25h-18v-3h1v-3.062h-1v-7.938h1l0.021-3.042h-1.021v-2.958h18v20zM14.562 10.562c-2.209 0-4 1.791-4 4s1.791 4 4 4c2.21 0 4-1.791 4-4s-1.79-4-4-4zM23.5 11.518c0-0.553-0.447-1-1-1-0.552 0-1 0.447-1 1 0 0.366 0.207 0.673 0.5 0.847v5.289c-0.293 0.174-0.5 0.48-0.5 0.847 0 0.552 0.448 1 1 1 0.553 0 1-0.448 1-1 0-0.394-0.232-0.726-0.562-0.889v-5.205c0.33-0.164 0.562-0.496 0.562-0.889zM14.5 16.25c-0.828 0-1.5-0.672-1.5-1.5 0-0.829 0.672-1.5 1.5-1.5 0.829 0 1.5 0.671 1.5 1.5 0 0.828-0.671 1.5-1.5 1.5z"></path>
                </svg>
                @if(false)
                    <span class="wormholeBottomBarCounter">3</span>
                @endif
            </p>
            <p data-id="wormhole-session">
                <span class="wormholeNoResp">Session</span>
                <svg class="wormholeBottomBarHeaderLeftSvg" viewBox="0 0 32 32">
                    <path d="M2.005 22.825l13.039 6.169v-13.8l-13.039-5.52v13.151zM6.006 14.791l5.026 2.337-0.029 1.842-5.025-2.336 0.028-1.843zM16 15.194v13.8l12.994-6.169v-13.151l-12.994 5.52zM15.453 3.006l-13.363 5.757 13.375 5.712 13.514-5.725-13.526-5.744z"></path>
                </svg>
            </p>
            <p data-id="wormhole-request">
                <span class="wormholeNoResp">Request</span>
                <svg class="wormholeBottomBarHeaderLeftSvg" viewBox="0 0 32 32">
                    <path d="M27.395 16.112l-12.225-12.141h-11.141l-0.026 11.127 12.078 12.329c0.794 0.794 2.071 0.805 2.853 0.023l8.484-8.485c0.781-0.781 0.771-2.059-0.023-2.853zM6.982 9.004c0-1.104 0.896-2 2-2s2 0.896 2 2c0 1.105-0.896 2-2 2s-2-0.895-2-2zM17.863 22.952l-7.778-7.778 0.707-0.707 7.778 7.778-0.707 0.707zM19.984 20.831l-7.778-7.778 0.708-0.707 7.777 7.778-0.707 0.707zM22.105 18.709l-7.777-7.778 0.707-0.707 7.777 7.778-0.707 0.707z"></path>
                </svg>
            </p>
        </div>
        <div id="wormholeBottomBarHeaderRight">
            <div class="wormholeBottomBarHeaderRightParts">
                <svg class="wormholeBottomBarHeaderRightSvg" viewBox="0 0 32 32">
                    <path d="M17.987 3h-5v3h5v-3zM17.987 15v-2h-5v2h5zM12.987 30h5v-8h-5v8zM24.987 12l-2.187-2.5 2.187-2.5h-16l-2.6 2.5 2.6 2.5h16zM22.987 16h-16l2.188 2.5-2.188 2.5h16l2.625-2.5-2.625-2.5z"></path>
                </svg>
                <p>{{ $_ENV['constellation']['request_type'] }} <span id="debugRoute">{{ $_ENV['constellation']['request_string'] }}</span></p>
                <title>Constellation</title>
            </div>
            <div class="wormholeBottomBarHeaderRightParts">
                <svg class="wormholeBottomBarHeaderRightSvg" viewBox="0 0 32 32">
                    <path d="M11.366 22.564l1.291-1.807-1.414-1.414-1.807 1.291c-0.335-0.187-0.694-0.337-1.071-0.444l-0.365-2.19h-2l-0.365 2.19c-0.377 0.107-0.736 0.256-1.071 0.444l-1.807-1.291-1.414 1.414 1.291 1.807c-0.187 0.335-0.337 0.694-0.443 1.071l-2.19 0.365v2l2.19 0.365c0.107 0.377 0.256 0.736 0.444 1.071l-1.291 1.807 1.414 1.414 1.807-1.291c0.335 0.187 0.694 0.337 1.071 0.444l0.365 2.19h2l0.365-2.19c0.377-0.107 0.736-0.256 1.071-0.444l1.807 1.291 1.414-1.414-1.291-1.807c0.187-0.335 0.337-0.694 0.444-1.071l2.19-0.365v-2l-2.19-0.365c-0.107-0.377-0.256-0.736-0.444-1.071zM7 27c-1.105 0-2-0.895-2-2s0.895-2 2-2 2 0.895 2 2-0.895 2-2 2zM32 12v-2l-2.106-0.383c-0.039-0.251-0.088-0.499-0.148-0.743l1.799-1.159-0.765-1.848-2.092 0.452c-0.132-0.216-0.273-0.426-0.422-0.629l1.219-1.761-1.414-1.414-1.761 1.219c-0.203-0.149-0.413-0.29-0.629-0.422l0.452-2.092-1.848-0.765-1.159 1.799c-0.244-0.059-0.492-0.109-0.743-0.148l-0.383-2.106h-2l-0.383 2.106c-0.251 0.039-0.499 0.088-0.743 0.148l-1.159-1.799-1.848 0.765 0.452 2.092c-0.216 0.132-0.426 0.273-0.629 0.422l-1.761-1.219-1.414 1.414 1.219 1.761c-0.149 0.203-0.29 0.413-0.422 0.629l-2.092-0.452-0.765 1.848 1.799 1.159c-0.059 0.244-0.109 0.492-0.148 0.743l-2.106 0.383v2l2.106 0.383c0.039 0.251 0.088 0.499 0.148 0.743l-1.799 1.159 0.765 1.848 2.092-0.452c0.132 0.216 0.273 0.426 0.422 0.629l-1.219 1.761 1.414 1.414 1.761-1.219c0.203 0.149 0.413 0.29 0.629 0.422l-0.452 2.092 1.848 0.765 1.159-1.799c0.244 0.059 0.492 0.109 0.743 0.148l0.383 2.106h2l0.383-2.106c0.251-0.039 0.499-0.088 0.743-0.148l1.159 1.799 1.848-0.765-0.452-2.092c0.216-0.132 0.426-0.273 0.629-0.422l1.761 1.219 1.414-1.414-1.219-1.761c0.149-0.203 0.29-0.413 0.422-0.629l2.092 0.452 0.765-1.848-1.799-1.159c0.059-0.244 0.109-0.492 0.148-0.743l2.106-0.383zM21 15.35c-2.402 0-4.35-1.948-4.35-4.35s1.948-4.35 4.35-4.35 4.35 1.948 4.35 4.35c0 2.402-1.948 4.35-4.35 4.35z"></path>
                </svg>
                <p>{{ humanizeSize(memory_get_usage()) }}</p>
                <title>Memory usage</title>
            </div>
            <div class="wormholeBottomBarHeaderRightParts">
                <svg class="wormholeBottomBarHeaderRightSvg" viewBox="0 0 32 32">
                    <path d="M16 3.5c-7.181 0-13 5.82-13 13s5.819 13 13 13c7.179 0 13-5.82 13-13s-5.82-13-13-13zM15.895 27.027c-5.799 0-10.5-4.701-10.5-10.5s4.701-10.5 10.5-10.5c5.798 0 10.5 4.701 10.5 10.5s-4.702 10.5-10.5 10.5zM18.93 17.131h-2.98v-5.032c0-0.546-0.443-0.99-0.989-0.99s-0.99 0.443-0.99 0.99v6.021c0 0.547 0.443 0.989 0.99 0.989h3.969c0.547 0 0.99-0.442 0.99-0.989 0-0.546-0.443-0.989-0.99-0.989z"></path>
                </svg>
                <p id="microTime" data-time="{{ constant('QUANTIC_START') }}" data-request="{{ round((microtime(true)
                 - constant('QUANTIC_START'))*1000) }}"></p>
                <title>Render duration</title>
            </div>
            <div class="wormholeBottomBarHeaderRightParts">
                <svg class="wormholeBottomBarHeaderRightSvg" id="wormholeBottomBarHeaderRightSvgVersion" viewBox="0 0 20 20">
                    <path d="M10 12v8c-5.52-0.003-9.994-4.479-9.994-10 0-4.874 3.486-8.933 8.101-9.82l0.063-0.010 1.83 1.83h5c0 0 0 0 0 0 2.758 0 4.994 2.233 5 4.989v9.021c-0.006 2.205-1.794 3.99-4 3.99 0 0 0 0 0 0v0-2c1.105 0 2-0.895 2-2s-0.895-2-2-2v0h-4l-2-2zM15.5 9c0.828 0 1.5-0.672 1.5-1.5s-0.672-1.5-1.5-1.5v0c-0.828 0-1.5 0.672-1.5 1.5s0.672 1.5 1.5 1.5v0z"></path>
                </svg>
                <p>{{ phpversion() }}</p>
                <title>Version</title>
            </div>
            <div id="wormholeArchivesList">
                <select id="wormholeBottomBarHeaderRightSelect">
                    <option value="{{ json_encode($instant) }}" data-id="{{ $instant['id'] }}">#1 ({{ $instant['time'] }})</option>
                </select>
            </div>
            <div class="wormholeBottomBarHeaderRightParts noBordersRightParts">
                <svg class="wormholeBottomBarHeaderRightSvg" id="wormholeBottomBarHeaderDirectory" viewBox="0 0 35 32">
                    <path d="M8.431 9.155h20.958c2.158 0 2.158-2.238 0.084-2.238h-14.486c-0.83 0-1.244-1.244-1.244-1.244s-0.581-1.825-1.743-1.825h-10.789c-1.576 0-1.162 1.825-1.162 1.825s2.407 20.47 2.573 21.715 1.453 1.612 1.453 1.612l2.821-18.103c0.208-1.327 1.12-1.7 1.535-1.742zM33.658 9.942h-24.563c-0.733 0-1.328 0.594-1.328 1.327l-2.572 16.4c0 0.734 0.595 1.328 1.328 1.328h24.563c0.732 0 1.328-0.594 1.328-1.328l2.572-16.4c0-0.733-0.593-1.327-1.328-1.327z"></path>
                </svg>
            </div>
            @isset($ux)
                <div class="wormholeBottomBarHeaderRightParts noBordersRightParts">
                    <svg class="wormholeBottomBarHeaderRightSvg" id="wormholeBottomBarHeaderUX" viewBox="0 0 32 32">
                        <path d="M6.058 6.835l0.686 0.686-2.808 2.808 2.188 2.188 2.821-2.821 0.641 0.641-2.821 2.822 2.16 2.159 6.416-6.416-7.812-7.766-6.393 6.393 2.114 2.115 2.808-2.809zM23.099 16.659l-6.416 6.417 2.159 2.159 2.822-2.821 0.641 0.641-2.821 2.821 2.188 2.188 2.807-2.808 0.686 0.686-2.807 2.808 2.113 2.114 6.394-6.394-7.766-7.811zM29.822 8.451c0.781-0.782 0.787-2.045 0.012-2.821l-3.512-3.511c-0.775-0.775-2.039-0.771-2.82 0.012l-2.17 2.17 6.32 6.32 2.17-2.17zM3.398 25.942l2.623 2.623 5.284-1.877-6.030-6.030-1.877 5.284zM20.65 4.943l-14.885 14.886 6.369 6.369 14.886-14.886-6.37-6.369zM8.657 19.816l11.981-11.981 0.698 0.698-11.982 11.982-0.697-0.699zM10.053 21.213l11.98-11.981 0.698 0.698-11.981 11.98-0.697-0.697zM11.449 22.608l11.981-11.981 0.697 0.698-11.98 11.981-0.698-0.698zM1.954 30.010l3.066-1.117-1.949-1.949-1.117 3.066z"></path>
                    </svg>
                </div>
            @endisset
            <div class="wormholeBottomBarHeaderRightParts noBordersRightParts">
                <svg class="wormholeBottomBarHeaderRightSvg" id="wormholeBottomBarHeaderChevron" viewBox="0 0 20 20">
                    <path d="M9.293 12.95l0.707 0.707 5.657-5.657-1.414-1.414-4.243 4.242-4.243-4.242-1.414 1.414z"></path>
                </svg>
            </div>
            <div class="wormholeBottomBarHeaderRightParts noBordersRightParts">
                <svg class="wormholeBottomBarHeaderRightSvg" id="wormholeBottomBarHeaderClose" viewBox="0 0 32 32">
                    <path d="M19.587 16.001l6.096 6.096c0.396 0.396 0.396 1.039 0 1.435l-2.151 2.151c-0.396 0.396-1.038 0.396-1.435 0l-6.097-6.096-6.097 6.096c-0.396 0.396-1.038 0.396-1.434 0l-2.152-2.151c-0.396-0.396-0.396-1.038 0-1.435l6.097-6.096-6.097-6.097c-0.396-0.396-0.396-1.039 0-1.435l2.153-2.151c0.396-0.396 1.038-0.396 1.434 0l6.096 6.097 6.097-6.097c0.396-0.396 1.038-0.396 1.435 0l2.151 2.152c0.396 0.396 0.396 1.038 0 1.435l-6.096 6.096z"></path>
                </svg>
            </div>
        </div>
    </div>
    <div id="wormholeBottomBarBody">
        <div id="wormhole-message" class="wormholeBottomBarBodyParts selectedWormholeBottomBarBodyPart">
            @include('includes.messages')
        </div>
        <div id="wormhole-timeline" class="wormholeBottomBarBodyParts">
            @include('includes.timeline')
        </div>
        <div id="wormhole-exceptions" class="wormholeBottomBarBodyParts">
            @include('includes.exceptions')
        </div>
        <div id="wormhole-views" class="wormholeBottomBarBodyParts">
            @include('includes.views')
        </div>
        <div id="wormhole-constellation" class="wormholeBottomBarBodyParts">
            @include('includes.constellation')
        </div>
        <div id="wormhole-queries" class="wormholeBottomBarBodyParts">
            @include('includes.queries')
        </div>
        <div id="wormhole-models" class="wormholeBottomBarBodyParts">
            @include('includes.models')
        </div>
        <div id="wormhole-mails" class="wormholeBottomBarBodyParts">
            @include('includes.mails')
        </div>
        <div id="wormhole-gate" class="wormholeBottomBarBodyParts">
            @include('includes.gate')
        </div>
        <div id="wormhole-session" class="wormholeBottomBarBodyParts">
            @include('includes.session')
        </div>
        <div id="wormhole-request" class="wormholeBottomBarBodyParts">
            @include('includes.request')
        </div>
    </div>
    <script type="text/javascript">{!! file_get_contents(dirname(__DIR__) . '/assets/script.js') !!}</script>
    <script type="text/javascript">{!! file_get_contents(dirname(__DIR__) . '/assets/timer.js') !!}</script>
    <script type="text/javascript">{!! file_get_contents(dirname(__DIR__) . '/assets/listeners.js') !!}</script>
</div>