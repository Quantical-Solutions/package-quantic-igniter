/*
* =================================================================
* ==================== Wormhole Vanilla Script ====================
* =================================================================
*/

var referenceBaseHeight = 88;
var referebceBaseMinSize = 35;

function displayWormholeBottomBar(ev) {

    var target = ev.currentTarget;
    var bar = document.querySelector('#wormholeBottomBar');
    var body = document.querySelector('#wormholeBottomBar');
    var chevron = document.querySelector('#wormholeBottomBarHeaderChevron');

    target.classList.remove('display_wormholeBottomBarBtn');
    bar.classList.add('display_wormholeBottomBar');
    body.style.height = referenceBaseHeight + 'px';
    chevron.style.transform = 'rotate(0deg)';
}

function closeUXWormholeBottomBar(ev) {

    var window = document.querySelector('#wormholeBottomBarUXOpen');
    window.classList.remove('display_wormholeBottomBarUXOpen');
}

function closeFolderWormholeBottomBar(ev) {

    var window = document.querySelector('#wormholeBottomBarFolderOpen');
    window.classList.remove('display_wormholeBottomBarFolderOpen');
}

function hideWormholeBottomBar(ev) {

    var btn = document.querySelector('#wormholeBottomBarBtn');
    var bar = document.querySelector('#wormholeBottomBar');

    btn.classList.add('display_wormholeBottomBarBtn');
    bar.classList.remove('display_wormholeBottomBar');
}

function displayFolderWormholeBottomBar(ev) {

    var window = document.querySelector('#wormholeBottomBarFolderOpen');
    window.classList.add('display_wormholeBottomBarFolderOpen');
}

function displayUXWormholeBottomBar(ev) {

    var window = document.querySelector('#wormholeBottomBarUXOpen');
    window.classList.add('display_wormholeBottomBarUXOpen');
}

function sizeDownWormholeBottomBar(ev) {

    var target = ev.currentTarget;
    var body = document.querySelector('#wormholeBottomBar');
    var chevron = document.querySelector('#wormholeBottomBarHeaderChevron');

    if (body.style.height != referebceBaseMinSize + 'px') {
        chevron.style.transform = 'rotate(180deg)';
        body.style.height = referebceBaseMinSize + 'px';
    } else {
        chevron.style.transform = 'rotate(0deg)';
        body.style.height = referenceBaseHeight + 'px';
    }
}

const BORDER_SIZE = 49;
const wormholeBody = document.querySelector('#wormholeBottomBar');
const wormholeHandle = document.querySelector('#resize-wormholeBottomBar');

if (wormholeBody) {

    var chevron = document.querySelector('#wormholeBottomBarHeaderChevron');
    let m_pos;
    function resize(e){

        const dx = m_pos - e.y;
        m_pos = e.y;
        if (m_pos > window.innerHeight/3) {
            var height = (parseInt(getComputedStyle(wormholeBody, '').height) + dx);
            if (height > referebceBaseMinSize) {
                wormholeBody.style.height = height + 'px';
                chevron.style.transform = 'rotate(0deg)';
                referenceBaseHeight = height;
            } else {
                wormholeBody.style.height = referebceBaseMinSize + 'px';
                chevron.style.transform = 'rotate(0deg)';
                referenceBaseHeight = referebceBaseMinSize;
            }
        }
    }

    wormholeHandle.addEventListener("mousedown", function(e){

        if (e.offsetY < BORDER_SIZE) {
            m_pos = e.y;
            document.addEventListener("mousemove", resize, false);
            document.querySelector('#wormholeBottomBar').style.transition = 'none';
        }
    }, false);

    document.addEventListener("mouseup", function(){
        document.removeEventListener("mousemove", resize, false);
        document.querySelector('#wormholeBottomBar').style.transition = 'height ease-in-out 0.15s';
    }, false);
}



var wormholeOnglets = document.querySelectorAll('#wormholeBottomBarHeaderLeft p');
if (wormholeOnglets) {
    for (var i = 0; i < wormholeOnglets.length; i++) {
        wormholeOnglets[i].addEventListener('click', displayWormholeContainers);
    }
}

function displayWormholeContainers(ev) {

    var target = ev.currentTarget;

    var onglets = document.querySelectorAll('#wormholeBottomBarHeaderLeft p');
    for (var i = 0; i < onglets.length; i++) {
        onglets[i].classList.remove('wormholeBottomBarHeaderLeftSelected');
    }
    target.classList.add('wormholeBottomBarHeaderLeftSelected');

    var containers = document.querySelectorAll('.wormholeBottomBarBodyParts');
    for (var i = 0; i < containers.length; i++) {
        var cont = containers[i];
        if (cont.id == target.dataset.id) {
            cont.style.display = 'flex';
        } else {
            cont.style.display = 'none';
        }
    }
}

// STAND ALONE MODE

let elmt = document.querySelector('#debug_replace_tag');
if (elmt) {

    let pre = document.querySelector('#debug_pre_tag').innerHTML;
    let mode = document.querySelector('#wormholeStandAlone').dataset.mode;
    let dBugInserter = {};

    switch (mode) {

        case 'vd':

            dBugInserter = {
                '\\]=>\\n': ']<span class="code_red code_bold"> =></span>',
                '\\["': '[<span class="code_green code_bold">"',
                '"\\]': '"</span>]',
                '\\("': '(<span class="code_green code_bold">"',
                '"\\)': '"</span>)',
                '\\{"': '{<span class="code_green code_bold">"',
                '"\\}': '"</span>}',
                '\\[': '</li><li><span class="code_orange code_bold">[</span>',
                '\\]': '<span class="code_orange code_bold">]</span>',
                '\\(': '<span class="code_orange code_bold lil_braces">(</span>',
                '\\)': '<span class="code_orange code_bold lil_braces">)</span>',
                '\\{': '<span class="code_orange code_bold">{</span><ul>',
                '\\}': '</ul><span class="code_orange code_bold close_braces">}</span>',
                'array': '<span class="code_blue code_bold"><b><i>Array</i></b></span>',
                'Array': '<span class="code_blue code_bold"><b><i>Array</i></b></span>',
                'string': '<span class="code_blue code_bold"><b><i>String</i></b></span>',
                'String': '<span class="code_blue code_bold"><b><i>String</i></b></span>',
                'object': '<span class="code_blue code_bold"><b><i>Object</i></b></span>',
                'Object': '<span class="code_blue code_bold"><b><i>Object</i></b></span>',
                'int': '<span class="code_blue code_bold"><b><i>Int</i></b></span>',
                'Int': '<span class="code_blue code_bold"><b><i>Int</i></b></span>',
                'float': '<span class="code_blue code_bold"><b><i>Float</i></b></span>',
                'Float': '<span class="code_blue code_bold"><b><i>Float</i></b></span>',
                ' ORDER BY ': ' <span class="code_red">ORDER BY</span> ',
                ' OFFSET ': ' <span class="code_red">OFFSET</span> ',
                ' ON ': ' <span class="code_red">ON</span> ',
                ' AS ': ' <span class="code_red">AS</span> ',
                'SELECT ': '<span class="code_red">SELECT</span> ',
                ' FROM ': ' <span class="code_red">FROM</span> ',
                'DELETE ': '<span class="code_red">DELETE</span> ',
                'UPDATE ': '<span class="code_red">UPDATE</span> ',
                ' WHERE ': ' <span class="code_red">WHERE</span> ',
                ' AND ': ' <span class="code_red">AND</span> ',
                ' OR ': ' <span class="code_red">OR</span> ',
                ' NOT ': ' <span class="code_red">NOT</span> ',
                ' SET ': ' <span class="code_red">SET</span> ',
                ' VALUES ': ' <span class="code_red">VALUES</span> ',
                'INSERT ': '<span class="code_red">INSERT</span> ',
                ' INTO ': ' <span class="code_red">INTO</span> ',
                ' JOIN ': ' <span class="code_red">JOIN</span> ',
                ' INNER ': ' <span class="code_red">INNER</span> ',
                ' OUTTER': ' <span class="code_red">OUTTER</span> ',
                ' LEFT ': ' <span class="code_red">LEFT</span> ',
                ' RIGHT ': ' <span class="code_red">RIGHT</span> ',
                ' DESC ': ' <span class="code_red">DESC</span> ',
                ' ASC ': ' <span class="code_red">ASC</span>  ',
                ' LIMIT ': ' <span class="code_red">LIMIT</span>  '
            };
            break;

        case 'pr':

            dBugInserter = {
                '\\[': '</li><li><span class="code_orange code_bold">[</span><span class="code_green">',
                '\\]': '</span><span class="code_orange code_bold">]</span>',
                '\\(': '<span class="code_orange code_bold">(</span><ul>',
                '\\)': '</ul><span class="code_orange code_bold close_braces">)</span>',
                'array': '<span class="code_blue code_bold"><b><i>Array</i></b></span>',
                'Array': '<span class="code_blue code_bold"><b><i>Array</i></b></span>',
                ' ORDER BY ': ' <span class="code_red">ORDER BY</span> ',
                ' OFFSET ': ' <span class="code_red">OFFSET</span> ',
                ' ON ': ' <span class="code_red">ON</span> ',
                ' AS ': ' <span class="code_red">AS</span> ',
                'SELECT ': '<span class="code_red">SELECT</span> ',
                ' FROM ': ' <span class="code_red">FROM</span> ',
                'DELETE ': '<span class="code_red">DELETE</span> ',
                'UPDATE ': '<span class="code_red">UPDATE</span> ',
                ' WHERE ': ' <span class="code_red">WHERE</span> ',
                ' AND ': ' <span class="code_red">AND</span> ',
                ' OR ': ' <span class="code_red">OR</span> ',
                ' NOT ': ' <span class="code_red">NOT</span> ',
                ' SET ': ' <span class="code_red">SET</span> ',
                ' VALUES ': ' <span class="code_red">VALUES</span> ',
                'INSERT ': '<span class="code_red">INSERT</span> ',
                ' INTO ': ' <span class="code_red">INTO</span> ',
                ' JOIN ': ' <span class="code_red">JOIN</span> ',
                ' INNER ': ' <span class="code_red">INNER</span> ',
                ' OUTTER': ' <span class="code_red">OUTTER</span> ',
                ' LEFT ': ' <span class="code_red">LEFT</span> ',
                ' RIGHT ': ' <span class="code_red">RIGHT</span> ',
                ' DESC ': ' <span class="code_red">DESC</span> ',
                ' ASC ': ' <span class="code_red">ASC</span>  ',
                ' LIMIT ': ' <span class="code_red">LIMIT</span>  '
            };
            break;

        default:

            dBugInserter = {};
            break;
    }

    for (key in dBugInserter) {
        if (dBugInserter.hasOwnProperty(key)) {
            let reg = new RegExp(key, "g");
            pre = pre.replace(reg, dBugInserter[key]);
        }
    }

    elmt.innerHTML = pre.trim();

    let here = document.querySelector('#wormholeStandAlone');
    let append = document.createElement('DIV');

    append.setAttribute('id', 'wormholeStandAlone');
    append.innerHTML = here.innerHTML;
    document.body.appendChild(append);
    here.parentElement.removeChild(here);

    setTimeout(function () {

        //document.querySelector('#wormholeStandAlone').classList.add('display_wormholeStandAlone');
        dragElement(document.querySelector("#wormholeStandAlone"));

        function dragElement(elmt) {

            let pos1 = 0, pos2 = 0, pos3 = 0, pos4 = 0;
            document.querySelector("#wormholeStandAlone h3").onmousedown = dragMouseDown;

            function dragMouseDown(event) {

                event.preventDefault();
                pos3 = event.clientX;
                pos4 = event.clientY;
                document.onmouseup = closeDragElement;
                document.onmousemove = elementDrag;
            }

            function elementDrag(event) {

                event.preventDefault();
                pos1 = pos3 - event.clientX;
                pos2 = pos4 - event.clientY;
                pos3 = event.clientX;
                pos4 = event.clientY;

                elmt.style.top = (elmt.offsetTop - pos2) + "px";
                elmt.style.left = (elmt.offsetLeft - pos1) + "px";
            }

            function closeDragElement() {

                document.onmouseup = null;
                document.onmousemove = null;
            }
        }

    }, 1500);

    var debugAloneBtn = document.querySelector('#wormStandAlonebtn');
    if (debugAloneBtn) {
        debugAloneBtn.addEventListener('click', displayStandAloneDebugger);
    }
}

function displayStandAloneDebugger(ev) {

    var debug = document.querySelector('#wormholeStandAlone');
    var target = ev.currentTarget;

    if (debug.classList.contains('display_wormholeStandAlone')) {

        debug.classList.remove('display_wormholeStandAlone');
        target.classList.remove('display_wormholeStandAloneBtn');

    } else {

        debug.classList.add('display_wormholeStandAlone');
        target.classList.add('display_wormholeStandAloneBtn');
    }
}
