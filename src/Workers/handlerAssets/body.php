<main id="handlerMain">
    <section class="xLarge-12 large-12 medium-12 small-12 xSmall-12 mainSection" id="top">
        <section class="xLarge-12 large-12 medium-12 small-12 xSmall-12">
            <div class="container">
                <div id="titleLeft">
                    <svg viewBox="0 0 719.3 719.3">
                        <path class="logo-st0" d="M570.9,446.7c11-26.8,17.1-56.1,17.1-86.9c0-126.1-102.2-228.3-228.3-228.3S131.3,233.7,131.3,359.8s102.2,228.3,228.3,228.3"></path>
                        <line class="logo-st0" x1="359.6" y1="588.2" x2="490.2" y2="588.2"></line>
                        <path class="logo-st1" d="M468.3,468.1c27.8-27.8,45-66.3,45-108.7c0-84.9-68.8-153.7-153.7-153.7c-22.4,0-43.6,4.8-62.8,13.4"></path>
                        <path class="logo-st2" d="M286.1,404.5c15.1,24.7,42.3,41.1,73.3,41.1c5.9,0,11.7-0.6,17.3-1.7"></path>
                        <path class="logo-st1" d="M241.9,260.1c-22.7,26.9-36.4,61.6-36.4,99.5c0,79.8,60.7,145.5,138.4,153.4"></path>
                        <path class="logo-st1" d="M512.9,376.1c0.6-5.4,0.9-10.9,0.9-16.4c0-85.1-69-154.2-154.2-154.2c-27.2,0-52.7,7-74.9,19.4"></path>
                        <path class="logo-st2" d="M389.4,278.9c-9.3-3.5-19.4-5.4-30-5.4c-47.5,0-86.1,38.5-86.1,86.1"></path>
                        <path class="logo-st2" d="M424.9,415.5c12.9-15,20.6-34.6,20.6-55.9c0-25.2-10.8-47.9-28.1-63.6"></path>
                    </svg>
                    <p><?= ROOTDIR ?>/</p>
                </div>
                <div id="titleRight">
                    <p><?= (config('app.name')) ? config('app.name') : '' ?></p>
                </div>
            </div>
        </section>
        <section class="xLarge-12 large-12 medium-12 small-12 xSmall-12">
            <div class="container">
                <div id="header">
                    <small><?= $data['error'] ?></small>
                    <p><?= $data['severity'] ?></p>
                    <h1><?= $data['message'] ?></h1>
                    <a href="<?= (($_SERVER['HTTPS']) ? 'https://' : 'http://') . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'] ?>">
                        <?= (($_SERVER['HTTPS']) ? 'https://' : 'http://') . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'] ?>
                    </a>
                </div>
            </div>
        </section>
    </section>
    <?php if (!empty($data['solution']) && isset($data['solution']['message'])) { ?>
        <section class="xLarge-12 large-12 medium-12 small-12 xSmall-12 mainSection" id="middle">
            <p id="displaySolution">
                Display solution
                <svg class="solutionBG" viewBox="0 0 250 500">
                    <polygon class="cls-1" points="250 250 0 250 125 125 250 0 250 250"/>
                    <polygon class="cls-2" points="250 250 250 500 125 375 0 250 250 250"/>
                </svg>
            </p>
            <div class="container">
                <svg class="solutionBG" viewBox="0 0 250 500">
                    <polygon class="cls-1" points="250 250 0 250 125 125 250 0 250 250"/>
                    <polygon class="cls-2" points="250 250 250 500 125 375 0 250 250 250"/>
                </svg>
                <p id="hideSolution">Hide solution</p>
                <div id="message">
                    <ul>
                        <li><?= $data['solution']['message'] ?></li>
                        <li><?= $data['solution']['description'] ?></li>
                        <li>
                            <a href="https://stackoverflow.com/search?q=<?= urlencode($data['message']) ?>" target="_blank">Help</a>
                            <a href="https://github.com/Quantical-Solutions/Quantic/blob/master/README.md" target="_blank">Quantic Docs</a>
                        </li>
                    </ul>
                </div>
            </div>
        </section>
    <?php } ?>
    <section class="xLarge-12 large-12 medium-12 small-12 xSmall-12 mainSection" id="bottom">
        <section class="xLarge-12 large-12 medium-12 small-12 xSmall-12" id="ongletsSection">
            <div class="container">
                <div id="onglets">
                    <ul>
                        <li data-section="stackTrace" class="liToDrop selectedLi">Stack Trace</li>
                        <li data-section="request" class="liToDrop">Request</li>
                        <li data-section="app" class="liToDrop">App</li>
                        <li data-section="user" class="liToDrop">User</li>
                        <li data-section="context" class="liToDrop">Context</li>
                        <li data-section="debug" class="liToDrop">Debug</li>
                        <li class="dropDown">
                            <svg id="paperplane" viewBox="0 0 32 32">
                                <path d="M3.363 4.414l4.875 19.348 9.467-3.018-8.448-10.298 10.902 9.56 8.853-2.77-25.649-12.822zM18.004 27.586v-5.324l-3.116 0.926 3.116 4.398z"></path>
                            </svg>
                            Report
                            <div id="issuesBox">
                                <div class="square"></div>
                                <div id="issuesBoxContainer">
                                    <p>Contact us for unsolved issues</p>
                                    <a href="mailto:tech-support@quanticalsolutions.com?subject=<?= $data['message']
                                    ?>&cc=<?= init('MAIL_FROM_ADDRESS', 'contact@exemple.com')
                                    ?>&body=Project%20%3D%20<?= config('app.name') ?>" target="_blank">Send E-mail</a>
                                    <p>Visits our web site</p>
                                    <a href="https://quanticalsolutions.com" target="_blank">Quantical Solutions</a>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </section>

        <!-- Stack Trace -->
        <section class="xLarge-12 large-12 medium-12 small-12 xSmall-12 sections" id="stackTrace">
            <section class="xLarge-4 large-4 medium-12 small-12 xSmall-12">
                <div class="container">
                    <div id="supAside">
                        <div id="asideNav">
                            <svg onclick="navigateInFrames('prev')" id="arrowup" viewBox="0 0 20 20">
                                <path d="M9 3.828l-6.071 6.071-1.414-1.414 8.485-8.485 8.485 8.485-1.414 1.414-6.071-6.071v16.172h-2v-16.172z"></path>
                            </svg>
                            <svg onclick="navigateInFrames('next')" id="arrowdown" viewBox="0 0 20 20">
                                <path d="M9 16.172l-6.071-6.071-1.414 1.414 8.485 8.485 8.485-8.485-1.414-1.414-6.071 6.071v-16.172h-2z"></path>
                            </svg>
                        </div>
                        <p onclick="expanderFrames(this)">Expand vendor frames</p>
                    </div>
                    <div id="aside">
                        <div class="traceList selectedStack" data-id="0">
                            <p><?= count($data['trace']) + 1 ?></p>
                            <div>
                                <p><?= str_replace(ROOTDIR . '/', '', $data['file']) ?></p>
                                <p><?= $data['class'] ?></p>
                            </div>
                            <p>:<?= $data['line'] ?></p>
                        </div>
                        <?php
                        $vendorCounter = 0;
                        $vendorGroup = 0;
                        $cnt = count($data['trace']);
                        foreach ($data['trace'] as $id => $datum) { ?>
                        <?php if (isset($datum['file'])) { ?>
                        <?php if (strpos($datum['file'], '/vendor/') !== false) { ?>
                        <?php if ($vendorCounter == 0) { ?>
                            <div class="vendorsContainer" data-vendor="vendorGroup_<?= $vendorGroup ?>">
                                <div>
                                    <svg class="stackVendorsPlus" viewBox="0 0 32 32">
                                        <path d="M15.5 29.5c-7.18 0-13-5.82-13-13s5.82-13 13-13 13 5.82 13 13-5.82 13-13 13zM21.938 15.938c0-0.552-0.448-1-1-1h-4v-4c0-0.552-0.447-1-1-1h-1c-0.553 0-1 0.448-1 1v4h-4c-0.553 0-1 0.448-1 1v1c0 0.553 0.447 1 1 1h4v4c0 0.553 0.447 1 1 1h1c0.553 0 1-0.447 1-1v-4h4c0.552 0 1-0.447 1-1v-1z"></path>
                                    </svg>
                                    <svg class="stackVendorsMoins" viewBox="0 0 32 32">
                                        <path d="M15.5 3.5c-7.18 0-13 5.82-13 13s5.82 13 13 13c7.18 0 13-5.82 13-13s-5.82-13-13-13zM22 16.875c0 0.553-0.448 1-1 1h-11c-0.553 0-1-0.447-1-1v-1c0-0.552 0.447-1 1-1h11c0.552 0 1 0.448 1 1v1z"></path>
                                    </svg>
                                </div>
                                <p></p>
                            </div>
                            <?php $vendorCounter = 1; } ?>
                        <div class="traceList vendorFile" data-vendor="vendorGroup_<?= $vendorGroup ?>" data-id="<?= $id + 1 ?>">
                            <?php } else { $vendorGroup++; ?>
                            <div class="traceList" data-id="<?= $id + 1 ?>">
                                <?php $vendorCounter = 0; } ?>
                                <p><?= $cnt ?></p>
                                <div>
                                    <p><?= str_replace(ROOTDIR . '/', '', $datum['file']) ?></p>
                                    <?php if (isset($datum['class'])) { ?>
                                        <p><?= $datum['class'] ?></p>
                                    <?php } else { ?>
                                        <p>Procedural function</p>
                                    <?php } ?>
                                </div>
                                <p>:<?= $datum['line'] ?></p>
                            </div>
                            <?php $cnt--; } ?>
                            <?php } ?>
                        </div>
                    </div>
            </section>
            <section class="xLarge-8 large-8 medium-12 small-12 xSmall-12">
                <div class="container" data-id="0">
                    <div class="supContent">
                        <p><?= $data['class'] ?><?= @$data['type'] ?><?= @$data['function'] ?></p>
                        <p>
                            <?= str_replace(ROOTDIR . '/', '', $data['file']) . ':' . $data['line'] ?>
                            <a href="phpstorm://open?file=<?= urlencode($data['file']) ?>&line=<?= $data['line'] ?>">
                                <svg class="pencil" viewBox="0 0 32 32">
                                    <path d="M5.582 20.054l14.886-14.886 6.369 6.369-14.886 14.886-6.369-6.369zM21.153 8.758l-0.698-0.697-11.981 11.98 0.698 0.698 11.981-11.981zM22.549 10.154l-0.698-0.698-11.981 11.982 0.697 0.697 11.982-11.981zM23.945 11.55l-0.698-0.698-11.981 11.981 0.698 0.698 11.981-11.981zM23.319 2.356c0.781-0.783 2.045-0.788 2.82-0.013l3.512 3.512c0.775 0.775 0.77 2.038-0.012 2.82l-2.17 2.17-6.32-6.32 2.17-2.169zM5.092 20.883l6.030 6.030-5.284 1.877-2.623-2.623 1.877-5.284zM4.837 29.117l-3.066 1.117 1.117-3.066 1.949 1.949z"></path>
                                </svg>
                            </a>
                        </p>
                    </div>
                    <div class="content">
                        <div class="stackRail">
                            <table>
                                <?php
                                foreach (file($data['file']) as $nb => $line) { ?>
                                    <tr data-line="<?= $nb + 1 ?>" class="<?= ($nb + 1 == $data['line']) ? 'errorLine' : '' ?>"
                                        onclick="window.location = 'phpstorm://open?file=<?= urlencode($data['file']) ?>&line=<?= $nb + 1 ?>'">
                                        <td class="lines"><code><?= $nb + 1 ?></code></td>
                                        <td><pre><code class="php"><?= $line ?></code></pre></td>
                                    </tr>
                                <?php } ?>
                            </table>
                        </div>
                    </div>
                </div>
                <?php $cntFile = count($data['trace']); foreach ($data['trace'] as $id => $datum) { ?>
                    <?php if (isset($datum['file'])) { ?>
                        <div class="container hideStackFile" data-id="<?= $id + 1 ?>">
                            <div class="supContent">
                                <?php if (isset($datum['class'])) { ?>
                                    <p><?= $datum['class'] ?><?= @$datum['type'] ?><?= @$datum['function'] ?></p>
                                <?php } else { ?>
                                    <p>Procedural function <?= ($datum['function']) ? '::' . $datum['function'] . '()' : '' ?></p>
                                <?php } ?>
                                <p>
                                    <?= str_replace(ROOTDIR . '/', '', $datum['file']) . ':' . $datum['line'] ?>
                                    <a href="phpstorm://open?file=<?= urlencode($datum['file']) ?>&line=<?= $datum['line'] ?>">
                                        <svg class="pencil" viewBox="0 0 32 32">
                                            <path d="M5.582 20.054l14.886-14.886 6.369 6.369-14.886 14.886-6.369-6.369zM21.153 8.758l-0.698-0.697-11.981 11.98 0.698 0.698 11.981-11.981zM22.549 10.154l-0.698-0.698-11.981 11.982 0.697 0.697 11.982-11.981zM23.945 11.55l-0.698-0.698-11.981 11.981 0.698 0.698 11.981-11.981zM23.319 2.356c0.781-0.783 2.045-0.788 2.82-0.013l3.512 3.512c0.775 0.775 0.77 2.038-0.012 2.82l-2.17 2.17-6.32-6.32 2.17-2.169zM5.092 20.883l6.030 6.030-5.284 1.877-2.623-2.623 1.877-5.284zM4.837 29.117l-3.066 1.117 1.117-3.066 1.949 1.949z"></path>
                                        </svg>
                                    </a>
                                </p>
                            </div>
                            <div class="content">
                                <div class="stackRail">
                                    <table>
                                        <?php
                                        foreach (file($datum['file']) as $nb => $line) { ?>
                                            <tr data-line="<?= $nb + 1 ?>" class="<?= ($nb + 1 == $datum['line']) ? 'errorLine' : '' ?>"
                                                onclick="window.location = 'phpstorm://open?file=<?= urlencode($datum['file'])
                                                ?>&line=<?= $nb + 1 ?>'">
                                                <td class="lines"><code><?= $nb + 1 ?></code></td>
                                                <td><pre><code class="php"><?= $line ?></code></pre></td>
                                            </tr>
                                        <?php } ?>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <?php $cntFile--; } ?>
                <?php } ?>
            </section>
        </section>

        <!-- Request -->
        <section class="xLarge-12 large-12 medium-12 small-12 xSmall-12 hideSection sections" id="request">
            <div class="stdContent">
                <h3>General</h3>
                <dl>
                    <dt>Request URL :</dt>
                    <dd><?= (($_SERVER['HTTPS']) ? 'https://' : 'http://') . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'] ?></dd>
                </dl>
                <dl>
                    <dt>Request Method :</dt>
                    <dd><?= $_SERVER['REQUEST_METHOD'] ?></dd>
                </dl>
                <dl>
                    <dt>Status Code :</dt>
                    <dd><?php
                        $code = http_response_code();
                        echo ($code == '200') ? $code . '<span class="greenCode"></span>' : $code . '<span class="redCode"></span>';
                        ?></dd>
                </dl>
                <dl>
                    <dt>Remote Address :</dt>
                    <dd>
                        <?php
                        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
                            $ip = $_SERVER['HTTP_CLIENT_IP'];
                        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
                        } else {
                            $ip = $_SERVER['REMOTE_ADDR'];
                        }
                        echo $ip;
                        ?>
                    </dd>
                </dl>
            </div>
            <div class="stdContent" id="responseHeader">
                <h3>Response Headers</h3>
                <?php
                $apache = apache_request_headers();
                foreach ($apache as $key => $value) {
                    if (ucfirst($key) != 'Cache-Control' && ucfirst($key) != 'Pragma') { ?>
                        <dl>
                            <dt><?= ucfirst($key) ?> :</dt>
                            <dd><?= (is_string($value)) ? $value : '<code>' . json_encode($value, true) . '</code>' ?></dd>
                        </dl>
                    <?php }} ?>
            </div>
            <div class="stdContent">
                <h3>Query String</h3>
                <?php if (!empty($_POST)) { ?>
                    <?php foreach ($_POST as $key => $value) { ?>
                        <dl>
                            <dt><?= $key ?> :</dt>
                            <dd><?= (is_string($value)) ? $value : '<code>' . json_encode($value, true) . '</code>' ?></dd>
                        </dl>
                    <?php } ?>
                <?php } ?>
                <?php if (!empty($_GET)) { ?>
                    <?php foreach ($_GET as $key => $value) { ?>
                        <dl>
                            <dt><?= $key ?> :</dt>
                            <dd><?= (is_string($value)) ? $value : '<code>' . json_encode($value, true) . '</code>' ?></dd>
                        </dl>
                    <?php } ?>
                <?php } ?>
                <?php if (empty($_POST) && empty($_GET)) { ?>
                    <p>No query attached to the request</p>
                <?php } ?>
            </div>
            <?php if (false) { ?>
                <div class="stdContent">
                    <h3>Body</h3>
                    <?php if (true) { ?>
                        <dl>
                            <dt>Preview :</dt>
                            <dd>
                        <pre>

                        </pre>
                            </dd>
                        </dl>
                    <?php } else { ?>
                        <p>Header response is empty</p>
                    <?php } ?>
                </div>
            <?php } ?>
            <div class="stdContent">
                <h3>Files</h3>
                <?php if (!empty($_FILES)) { ?>
                    <?php foreach ($_FILES as $key => $value) { ?>
                        <dl>
                            <dt><?= $key ?> :</dt>
                            <dd><?= (is_string($value)) ? $value : '<pre>' . json_encode($value, true) . '</pre>' ?></dd>
                        </dl>
                    <?php } ?>
                <?php } else { ?>
                    <p>No file has been sent</p>
                <?php } ?>
            </div>
            <div class="stdContent">
                <h3>Session</h3>
                <?php $emptySession = 0; ?>
                <?php if (!empty($_SESSION)) { ?>
                    <?php foreach ($_SESSION as $key => $value) {
                        if ($key != "exceptions" && $key != "last_exception") { ?>
                            <dl>
                                <dt><?= $key ?> :</dt>
                                <dd><?= (is_string($value)) ? $value : '<pre>' . json_encode($value, true) . '</pre>' ?></dd>
                            </dl>
                            <?php $emptySession = 1; ?>
                        <?php } else {
                            $emptySession = 0;
                        } ?>
                    <?php } ?>
                <?php }
                if ($emptySession == 0) { ?>
                    <p>Session global variable is empty</p>
                <?php } ?>
            </div>
            <div class="stdContent">
                <h3>Cookies</h3>
                <?php if (!empty($_COOKIE)) { ?>
                    <?php foreach ($_COOKIE as $key => $value) { ?>
                        <dl>
                            <dt><?= $key ?> :</dt>
                            <dd><?= (is_string($value)) ? $value : '<pre>' . json_encode($value, true) . '</pre>' ?></dd>
                        </dl>
                    <?php } ?>
                <?php } else { ?>
                    <p>No cookie recorded</p>
                <?php } ?>
            </div>
        </section>

        <!-- App -->
        <section class="xLarge-12 large-12 medium-12 small-12 xSmall-12 hideSection sections" id="app">
            <div class="stdContent">
                <h3>Mapper</h3>
                <dl>
                    <dt>Constellation Name :</dt>
                    <dd>
                        <?php if (isset($_ENV['constellation']['main']['as'])) {
                            echo $_ENV['constellation']['main']['as'];
                        } else {
                            echo '--';
                        } ?>
                    </dd>
                </dl>
                <dl>
                    <dt>Constellation Controller :</dt>
                    <dd>
                        <?php if (isset($_ENV['constellation']['main']['controller'])) {
                            echo $_ENV['constellation']['main']['controller'];
                        } else {
                            echo '--';
                        } ?>
                    </dd>
                </dl>
                <dl>
                    <dt>Constellation Method :</dt>
                    <dd>
                        <?php if (isset($_ENV['constellation']['main']['method'])) {
                            echo $_ENV['constellation']['main']['method'];
                        } else {
                            echo '--';
                        } ?>
                    </dd>
                </dl>
                <dl>
                    <dt>Constellation Parameters :</dt>
                    <dd>
                        <?php if (isset($_ENV['constellation']['main']['options'])
                            && !empty($_ENV['constellation']['main']['options'])) {
                            $options = $_ENV['constellation']['main']['options'];
                            foreach ($options as $index => $option) { ?>
                                <span><?= $index ?> => <b><?= $option ?></b></span>
                            <?php }
                        } else {
                            echo '--';
                        } ?>
                    </dd>
                </dl>
                <dl>
                    <dt>Vortex :</dt>
                    <dd>
                        <?php if (isset($_ENV['constellation']['main']['vortex'])
                            && !empty($_ENV['constellation']['main']['vortex'])) {
                            $vortex = $_ENV['constellation']['main']['vortex'];
                            foreach ($vortex as $index => $vor) { ?>
                                <span><?= $index ?> => <b><?= $vor ?></b></span>
                            <?php }
                        } else {
                            echo '--';
                        } ?>
                    </dd>
                </dl>
            </div>
            <div class="stdContent">
                <h3>View</h3>
                <dl>
                    <dt>View Name :</dt>
                    <dd>
                        <?php if (isset($_ENV['constellation']['main']['view'])) {
                            echo $_ENV['constellation']['main']['view'];
                        } else {
                            echo '--';
                        } ?>
                    </dd>
                </dl>
                <dl>
                    <dt>View Data :</dt>
                    <?php if (isset($_ENV['constellation']['main']['data'])) {
                        echo '<dd class="ddArray">';
                        foreach ($_ENV['constellation']['main']['data'] as $index => $data) { ?>
                            <span>$<?= $index ?> : <b><?= (is_string($data)) ? $data : 'Array' ?></b></span>
                        <?php }
                        echo '</dd>';
                    } else {
                        echo '<dd>--</dd>';
                    } ?>
                    </dd>
                </dl>
            </div>
        </section>

        <!-- User -->
        <section class="xLarge-12 large-12 medium-12 small-12 xSmall-12 hideSection sections" id="user">
            <div class="stdContent">
                <h3>User Data</h3>
                <dl>
                    <dt>Email :</dt>
                    <?php if (isset($_SESSION['user']['email']) && $_SESSION['user']['email'] != '') { ?>
                        <dd><?= $_SESSION['user']['email'] ?></dd>
                    <?php } else { ?>
                        <dd>--</dd>
                    <?php } ?>
                </dl>
                <dl>
                    <dt>Data :</dt>
                    <dd>
                        <?php if (isset($_SESSION['user']) && !empty($_SESSION['user'])) { ?>
                            <pre>
                            <?php print_r($_SESSION['user']) ?>
                        </pre>
                        <?php } else { ?>
                            <pre></pre>
                        <?php } ?>
                    </dd>
                </dl>
            </div>
            <div class="stdContent">
                <h3>Client Info</h3>
                <dl>
                    <dt>IP Address :</dt>
                    <dd>
                        <?php
                        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
                            $ip = $_SERVER['HTTP_CLIENT_IP'];
                        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
                        } else {
                            $ip = $_SERVER['REMOTE_ADDR'];
                        }
                        echo $ip;
                        ?>
                    </dd>
                </dl>
                <dl>
                    <dt>User Agent :</dt>
                    <dd><?= $_SERVER['HTTP_USER_AGENT'] ?></dd>
                </dl>
            </div>
        </section>

        <!-- Context -->
        <section class="xLarge-12 large-12 medium-12 small-12 xSmall-12 hideSection sections" id="context">
            <div class="stdContent">
                <h3>Environment information</h3>
                <dl>
                    <dt>Quantic Version :</dt>
                    <dd><?= config('app.version') ?></dd>
                </dl>
                <dl>
                    <dt>Quantic Locale :</dt>
                    <dd><?= config('app.locale') ?></dd>
                </dl>
                <dl>
                    <dt>Quantic Config Cache :</dt>
                    <dd><?= config('cache.default') ?></dd>
                </dl>
                <dl>
                    <dt>PHP Version :</dt>
                    <dd><?= phpversion() ?></dd>
                </dl>
            </div>
            <div class="stdContent">
                <h3>Generic context</h3>
                <?php if (isset($_ENV['contexts'])) {
                    foreach ($_ENV['contexts'] as $index => $item) { ?>
                        <dl>
                            <dt><?= $index ?> :</dt>
                            <?php if (is_array($item) && !empty($item)) { ?>
                                <dd class="ddArray">
                                    <?php foreach ($item as $k => $it) { ?>
                                        <span><?= $k ?> : <b><?= $it ?></b></span>
                                    <?php } ?>
                                </dd>
                            <?php } else { ?>
                                <dd><?= $item ?></dd>
                            <?php } ?>
                        </dl>
                    <?php } ?>
                <?php } else { ?>
                    <p>No context listed</p>
                <?php } ?>
            </div>
        </section>

        <!-- Debug -->
        <section class="xLarge-12 large-12 medium-12 small-12 xSmall-12 hideSection sections" id="debug">
            <div class="stdContent">
                <div class="xLarge-12 large-12 medium-12 small-12 xSmall-12">
                    <div id="queryFilter">
                        <div class="filters">
                            <label class="filterContainer" data-id="stdContentDumps">Dumps
                                <input type="checkbox" checked="checked">
                                <span class="checkmark"></span>
                            </label>
                        </div>
                        <div class="filters">
                            <label class="filterContainer" data-id="stdContentGlows">Glows
                                <input type="checkbox" checked="checked">
                                <span class="checkmark"></span>
                            </label>
                        </div>
                        <div class="filters">
                            <label class="filterContainer" data-id="stdContentLogs">Logs
                                <input type="checkbox" checked="checked">
                                <span class="checkmark"></span>
                            </label>
                        </div>
                        <div class="filters">
                            <label class="filterContainer" data-id="stdContentQueries">Queries
                                <input type="checkbox" checked="checked">
                                <span class="checkmark"></span>
                            </label>
                        </div>
                        <div id="filter">
                            <span>Reset Filters</span>
                        </div>
                    </div>
                </div>
            </div>
            <?php $noData = 0; ?>
            <?php if (isset($dumps) && !empty($dumps)) { $noData = 1; ?>
                <div class="stdContent" id="stdContentDumps">
                    <div class="xLarge-12 large-12 medium-12 small-12 xSmall-12">
                        <h3>
                            Dumps<span class="titleCounter"><?= count($dumps) ?></span>
                            <svg class="developPlus" viewBox="0 0 32 32">
                                <path d="M15.5 29.5c-7.18 0-13-5.82-13-13s5.82-13 13-13 13 5.82 13 13-5.82 13-13 13zM21.938 15.938c0-0.552-0.448-1-1-1h-4v-4c0-0.552-0.447-1-1-1h-1c-0.553 0-1 0.448-1 1v4h-4c-0.553 0-1 0.448-1 1v1c0 0.553 0.447 1 1 1h4v4c0 0.553 0.447 1 1 1h1c0.553 0 1-0.447 1-1v-4h4c0.552 0 1-0.447 1-1v-1z"></path>
                            </svg>
                            <svg class="developMinus" viewBox="0 0 32 32">
                                <path d="M15.5 3.5c-7.18 0-13 5.82-13 13s5.82 13 13 13c7.18 0 13-5.82 13-13s-5.82-13-13-13zM22 16.875c0 0.553-0.448 1-1 1h-11c-0.553 0-1-0.447-1-1v-1c0-0.552 0.447-1 1-1h11c0.552 0 1 0.448 1 1v1z"></path>
                            </svg>
                            <p class="deleters" data-del="dumps">Delete Dumps</p>
                        </h3>
                        <div id="dumpsContainer" class="reportContainers">

                        </div>
                    </div>
                </div>
            <?php } ?>
            <?php if (isset($_ENV['glows']) && !empty($_ENV['glows'])) { $noData = 1; ?>
                <div class="stdContent" id="stdContentGlows">
                    <div class="xLarge-12 large-12 medium-12 small-12 xSmall-12">
                        <h3>
                            Glows<span class="titleCounter"><?= count($_ENV['glows']) ?></span>
                            <svg class="developPlus" viewBox="0 0 32 32">
                                <path d="M15.5 29.5c-7.18 0-13-5.82-13-13s5.82-13 13-13 13 5.82 13 13-5.82 13-13 13zM21.938 15.938c0-0.552-0.448-1-1-1h-4v-4c0-0.552-0.447-1-1-1h-1c-0.553 0-1 0.448-1 1v4h-4c-0.553 0-1 0.448-1 1v1c0 0.553 0.447 1 1 1h4v4c0 0.553 0.447 1 1 1h1c0.553 0 1-0.447 1-1v-4h4c0.552 0 1-0.447 1-1v-1z"></path>
                            </svg>
                            <svg class="developMinus" viewBox="0 0 32 32">
                                <path d="M15.5 3.5c-7.18 0-13 5.82-13 13s5.82 13 13 13c7.18 0 13-5.82 13-13s-5.82-13-13-13zM22 16.875c0 0.553-0.448 1-1 1h-11c-0.553 0-1-0.447-1-1v-1c0-0.552 0.447-1 1-1h11c0.552 0 1 0.448 1 1v1z"></path>
                            </svg>
                        </h3>
                        <div id="glowsContainer" class="reportContainers">
                            <?php foreach ($_ENV['glows'] as $glow) { ?>
                                <dl>
                                    <dt>Message :</dt>
                                    <dd><?= $glow['message'] ?></dd>
                                    <dt>Level :</dt>
                                    <dd><?= $glow['level'] ?></dd>
                                    <dt>Arguments :</dt>
                                    <?php if (!empty($glow['arguments'])) { ?>
                                        <dd>
                                            <?php foreach ($glow['arguments'] as $index => $item) { ?>
                                                <span><?= $index ?> : <b><?= ($item != '') ? $item : '--' ?></b></span>
                                            <?php } ?>
                                        </dd>
                                    <?php } else { ?>
                                        <dd>--</dd>
                                    <?php } ?>
                                </dl>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <?php if (isset($_SESSION['exceptions']) && !empty($_SESSION['exceptions'])) { $noData = 1; ?>
                <div class="stdContent" id="stdContentLogs">
                    <div class="xLarge-12 large-12 medium-12 small-12 xSmall-12">
                        <h3>
                            Logs<span class="titleCounter"><?= count($_SESSION['exceptions']) ?></span>
                            <svg class="developPlus" viewBox="0 0 32 32">
                                <path d="M15.5 29.5c-7.18 0-13-5.82-13-13s5.82-13 13-13 13 5.82 13 13-5.82 13-13 13zM21.938 15.938c0-0.552-0.448-1-1-1h-4v-4c0-0.552-0.447-1-1-1h-1c-0.553 0-1 0.448-1 1v4h-4c-0.553 0-1 0.448-1 1v1c0 0.553 0.447 1 1 1h4v4c0 0.553 0.447 1 1 1h1c0.553 0 1-0.447 1-1v-4h4c0.552 0 1-0.447 1-1v-1z"></path>
                            </svg>
                            <svg class="developMinus" viewBox="0 0 32 32">
                                <path d="M15.5 3.5c-7.18 0-13 5.82-13 13s5.82 13 13 13c7.18 0 13-5.82 13-13s-5.82-13-13-13zM22 16.875c0 0.553-0.448 1-1 1h-11c-0.553 0-1-0.447-1-1v-1c0-0.552 0.447-1 1-1h11c0.552 0 1 0.448 1 1v1z"></path>
                            </svg>
                            <p class="deleters" data-del="logs">Delete Logs</p>
                        </h3>
                        <div id="logsContainer" class="reportContainers">
                            <?php foreach (array_reverse($_SESSION['exceptions']) as $index => $excep) { ?>
                                <dl>
                                    <dt>Message :</dt>
                                    <dd>
                                        <pre><?= $excep ?></pre>
                                    </dd>
                                </dl>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <?php if (isset($queries) && !empty($queries)) { $noData = 1; ?>
            <div class="stdContent" id="stdContentQueries">
                <div class="xLarge-12 large-12 medium-12 small-12 xSmall-12">
                    <h3>
                        Queries<span class="titleCounter"><?= count($queries) ?></span>
                        <svg class="developPlus" viewBox="0 0 32 32">
                            <path d="M15.5 29.5c-7.18 0-13-5.82-13-13s5.82-13 13-13 13 5.82 13 13-5.82 13-13 13zM21.938 15.938c0-0.552-0.448-1-1-1h-4v-4c0-0.552-0.447-1-1-1h-1c-0.553 0-1 0.448-1 1v4h-4c-0.553 0-1 0.448-1 1v1c0 0.553 0.447 1 1 1h4v4c0 0.553 0.447 1 1 1h1c0.553 0 1-0.447 1-1v-4h4c0.552 0 1-0.447 1-1v-1z"></path>
                        </svg>
                        <svg class="developMinus" viewBox="0 0 32 32">
                            <path d="M15.5 3.5c-7.18 0-13 5.82-13 13s5.82 13 13 13c7.18 0 13-5.82 13-13s-5.82-13-13-13zM22 16.875c0 0.553-0.448 1-1 1h-11c-0.553 0-1-0.447-1-1v-1c0-0.552 0.447-1 1-1h11c0.552 0 1 0.448 1 1v1z"></path>
                        </svg>
                    </h3>
                    <div id="queriesContainer" class="reportContainers">
                        <?php foreach ($queries as $index => $query) { ?>
                            <dl>
                                <dt>Query :</dt>
                                <dd></dd>
                            </dl>
                            <dl>
                                <dt>Time :</dt>
                                <dd></dd>
                            </dl>
                            <dl>
                                <dt>Connexion driver :</dt>
                                <dd></dd>
                            </dl>
                            <?php if (isset($params) && !empty($params)) { ?>
                                <dl>
                                    <dt>Variables :</dt>
                                    <dd>
                                        <ul>
                                            <?php foreach ($params as $param) { ?>
                                                <li><?= $param ?></li>
                                            <?php } ?>
                                        </ul>
                                    </dd>
                                </dl>
                            <?php }
                        } ?>
                    </div>
                    <?php } ?>
                </div>
            </div>
            <?php if ( $noData == 0) { ?>
                <div class="xLarge-12 large-12 medium-12 small-12 xSmall-12 noData">
                    <p>No data available</p>
                </div>
            <?php } ?>
        </section>
    </section>
</main>