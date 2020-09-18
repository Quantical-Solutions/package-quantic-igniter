<div class="wormholeIncludes" id="wormholeIncludeMails">
    @if(isset($mails) && !empty($mails))
        <span class="wormholeNoRender"><icon>!</icon>{{ count($mails) }} mails were sent</span>
        <ul id="wormholeMailsStack">
            @php $cnt = 1; @endphp
            @foreach($mails as $mail)
                <li>
                    <h4 class="wormholeMailsTitle">Mail #{{ $cnt }}</h4>
                    @foreach($mail as $key => $value)
                        <dl>
                            <dt>{{ $key }}</dt>
                            <dd>
                                @if(!is_array($value) && !is_object($value))
                                    @if($key == 'Body')
                                        <span class="openWormholePreviewMailCode" onclick="displayBodyPreview(this, 'show')">
                                            <svg viewBox="0 0 32 32">
                                                <path d="M29.156 29.961l-0.709 0.709c-0.785 0.784-2.055 0.784-2.838 0l-5.676-5.674c-0.656-0.658-0.729-1.644-0.281-2.412l-3.104-3.102c-1.669 1.238-3.728 1.979-5.965 1.979-5.54 0-10.031-4.491-10.031-10.031s4.491-10.032 10.031-10.032c5.541 0 10.031 4.491 10.031 10.032 0 2.579-0.98 4.923-2.58 6.7l3.035 3.035c0.768-0.447 1.754-0.375 2.41 0.283l5.676 5.674c0.784 0.785 0.784 2.056 0.001 2.839zM18.088 11.389c0-4.155-3.369-7.523-7.524-7.523s-7.524 3.367-7.524 7.523 3.368 7.523 7.523 7.523 7.525-3.368 7.525-7.523z"></path>
                                            </svg>
                                            Display code
                                        </span>
                                        <div class="wormholePreviewBody">
                                            <p>
                                                <span>Template "{{ $mail['Template']['view'] }}" preview</span>
                                                <span onclick="displayBodyPreview(this, 'hide')">Hide code</span>
                                            </p>
                                            <pre><code class="html">{{ $value }}</code></pre>
                                        </div>
                                    @else
                                        <b>{{ $value }}</b>
                                    @endif
                                @else
                                    @php dump($value) @endphp
                                @endif
                            </dd>
                        </dl>
                    @endforeach
                </li>
                @php $cnt++; @endphp
            @endforeach
        </ul>
    @else
        <span class="wormholeNoRender"><icon>!</icon>0 mail was sent</span>
    @endif
</div>