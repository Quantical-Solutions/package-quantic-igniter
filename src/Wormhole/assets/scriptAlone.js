/*
* =================================================================
* ==================== Wormhole Vanilla Script ====================
* =================================================================
*/

// STAND ALONE MODE

let elmt = document.querySelector('#debug_replace_tag');
let pre = document.querySelector('#debug_pre_tag').innerHTML;
let mode = document.querySelector('#wormholeStandAlone').dataset.mode;
let dBugInserter = {};

switch (mode) {

    case 'vd':

        dBugInserter = {
            '\\]=>\\n': ']<span class="code_red"> =></span>',
            '\\["': '[<span class="code_green">"',
            '"\\]': '"</span>]',
            '\\("': '(<span class="code_green">"',
            '"\\)': '"</span>)',
            '\\{"': '{<span class="code_green">"',
            '"\\}': '"</span>}',
            '\\[': '</li><li><span class="code_orange">[</span>',
            '\\]': '<span class="code_orange">]</span>',
            '\\(': '<span class="code_orange lil_braces">(</span>',
            '\\)': '<span class="code_orange lil_braces">)</span>',
            '\\{': '<span class="code_orange">{</span><ul>',
            '\\}': '</ul><span class="code_orange close_braces">}</span>',
            'array': '<span class="code_blue"><b><i>Array</i></b></span>',
            'Array': '<span class="code_blue"><b><i>Array</i></b></span>',
            'string': '<span class="code_blue"><b><i>String</i></b></span>',
            'String': '<span class="code_blue"><b><i>String</i></b></span>',
            'int': '<span class="code_blue"><b><i>Int</i></b></span>',
            'Int': '<span class="code_blue"><b><i>Int</i></b></span>',
            'float': '<span class="code_blue"><b><i>Float</i></b></span>',
            'Float': '<span class="code_blue"><b><i>Float</i></b></span>',
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
            ' OUTTER' : ' <span class="code_red">OUTTER</span> ',
            ' LEFT ': ' <span class="code_red">LEFT</span> ',
            ' RIGHT ': ' <span class="code_red">RIGHT</span> ',
            ' DESC ': ' <span class="code_red">DESC</span> ',
            ' ASC ': ' <span class="code_red">ASC</span>  ',
            ' LIMIT ': ' <span class="code_red">LIMIT</span>  '
        };
        break;

    case 'pr':

        dBugInserter = {
            '\\[': '</li><li><span class="code_orange">[</span><span class="code_green">',
            '\\]': '</span><span class="code_orange">]</span>',
            '\\(': '<span class="code_orange">(</span><ul>',
            '\\)': '</ul><span class="code_orange close_braces">)</span>',
            'array': '<span class="code_blue"><b><i>Array</i></b></span>',
            'Array': '<span class="code_blue"><b><i>Array</i></b></span>',
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
            ' OUTTER' : ' <span class="code_red">OUTTER</span> ',
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

setTimeout(function(){

    document.querySelector('#wormholeStandAlone').classList.add('display_wormholeStandAlone');
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