<div class="wormholeIncludes" id="wormholeIncludeRequest">
    <ul>
        <li>
            <label>path_info</label>
            <span><?= $_SERVER['REQUEST_URI'] ?></span>
        </li>
        <li>
            <label>status_code</label>
            <?php $code = http_response_code(); ?>
            <?= ($code == '200') ? '<span class="wormhole-greenCode">' . $code . '</span>' : '<span class="wormhole-redCode">' .
                $code . '</span>' ?>
        </li>
        <li>
            <label>status_text</label>
            <span><?= ($code == '200') ? 'OK' : 'NOK' ?></span>
        </li>
        <li>
            <label>format</label>
            <span id="request_format"></span>
        </li>
        <li>
            <label>content_type</label>
            <span id="request_content_type"></span>
        </li>
        <li>
            <label>request_query</label>
            <span><?php dump(['get' => $_GET, 'post' => $_POST]) ?></span>
        </li>
        <li>
            <label>request_request</label>
            <span><?php dump($_REQUEST); ?></span>
        </li>
        <li>
            <label>request_headers</label>
            <span>
                <?php dump(apache_request_headers()) ?>
            </span>
        </li>
        <li>
            <label>request_server</label>
            <span>
                <?php dump($_SERVER) ?>
            </span>
        </li>
        <li>
            <label>request_cookies</label>
            <span>
                <?php dump($_COOKIE) ?>
            </span>
        </li>
        <li>
            <label>response_headers</label>
            <span>
            <?php dump(headers_list()); ?>
            </span>
        </li>
        <li>
            <label>session_attributes</label>
            <span>
                <?php
                $session = [];
                foreach ($_SESSION as $key => $value) {
                    if ($key != 'exceptions') {
                        $session[$key] = $value;
                    }
                }
                dump($session);
                ?>
            </span>
        </li>
    </ul>
</div>