/*
* =================================================================
* ==================== Wormhole Vanilla Script ====================
* =================================================================
*/

var count = document.querySelector('p[data-id="wormhole-message"]');

(function() {
    "use strict";

    var baseLogFunction = console.log;
    console.log = function() {

        baseLogFunction.apply(console, arguments);

        var args = Array.prototype.slice.call(arguments);
        for (var i = 0; i < args.length; i++) {

            var node = document.createElement('LI');
            var txt = args[i];
            count.querySelector('.wormholeBottomBarCounter').innerHTML = parseInt(count.querySelector('.wormholeBottomBarCounter').innerHTML) + 1;

            if (typeof txt == 'string' && txt.search("Uncaugth Error:") != -1) {

                node.innerHTML = '<div><svg class="wormholeERROR" viewBox="0 0 32 32"><path d="M16 29c-7.18 0-13-5.82-13-13s5.82-13 13-13 13 5.82 13 13-5.82 13-13 13zM21.961 12.209c0.244-0.244 0.244-0.641 0-0.885l-1.328-1.327c-0.244-0.244-0.641-0.244-0.885 0l-3.761 3.761-3.761-3.761c-0.244-0.244-0.641-0.244-0.885 0l-1.328 1.327c-0.244 0.244-0.244 0.641 0 0.885l3.762 3.762-3.762 3.76c-0.244 0.244-0.244 0.641 0 0.885l1.328 1.328c0.244 0.244 0.641 0.244 0.885 0l3.761-3.762 3.761 3.762c0.244 0.244 0.641 0.244 0.885 0l1.328-1.328c0.244-0.244 0.244-0.641 0-0.885l-3.762-3.76 3.762-3.762z"></path></svg><span class="wormholeERROR">JS Error</span></div><div><p class="wormholeERROR">"' + txt + '"</p></div>';

            } else {

                node.innerHTML = '<div><svg class="wormholeINFO" viewBox="0 0 32 32"><path d="M16 3c-7.18 0-13 5.82-13 13s5.82 13 13 13 13-5.82 13-13-5.82-13-13-13zM18.039 20.783c-0.981 1.473-1.979 2.608-3.658 2.608-1.146-0.187-1.617-1.008-1.369-1.845l2.16-7.154c0.053-0.175-0.035-0.362-0.195-0.419-0.159-0.056-0.471 0.151-0.741 0.447l-1.306 1.571c-0.035-0.264-0.004-0.7-0.004-0.876 0.981-1.473 2.593-2.635 3.686-2.635 1.039 0.106 1.531 0.937 1.35 1.85l-2.175 7.189c-0.029 0.162 0.057 0.327 0.204 0.379 0.16 0.056 0.496-0.151 0.767-0.447l1.305-1.57c0.035 0.264-0.024 0.726-0.024 0.902zM17.748 11.439c-0.826 0-1.496-0.602-1.496-1.488s0.67-1.487 1.496-1.487 1.496 0.602 1.496 1.487c0 0.887-0.67 1.488-1.496 1.488z"></path></svg><span class="wormholeINFO">JS Info</span></div><div><p class="wormholeINFO">"' + txt + '"</p></div>';
            }
            document.querySelector('#wormholeMessagesStack').appendChild(node);
        }
    }

    window.onerror = function(message, url, linenumber) {

        console.log("Uncaugth Error: " + message + " on line " +
            linenumber + " for " + url);
    };

})();

window.mobileAndTabletCheck = function() {
    let check = false;
    (function(a){if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino|android|ipad|playbook|silk/i.test(a)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0,4))) check = true;})(navigator.userAgent||navigator.vendor||window.opera);
    return check;
};

var referenceBaseHeight = 128;
var referebceBaseMinSize = 35;
var isMobile = window.mobileAndTabletCheck();

if (isMobile == true) {
    document.querySelector('#wormholeBottomBar').classList.add('mobileHeight');
    document.querySelector('#resize-wormholeBottomBar').classList.add('resize-wormholeBottomBarMobile');
}

function displayWormholeBottomBar(ev) {

    var target = ev.currentTarget;
    var bar = document.querySelector('#wormholeBottomBar');
    var body = document.querySelector('#wormholeBottomBar');
    var chevron = document.querySelector('#wormholeBottomBarHeaderChevron');
    var masterWindow = document.querySelector('body');

    target.classList.remove('display_wormholeBottomBarBtn');
    bar.classList.add('display_wormholeBottomBar');
    body.style.height = referenceBaseHeight + 'px';
    masterWindow.style.paddingBottom = (isMobile == true) ? 'calc(40vh + 4px)' : (referenceBaseHeight+4) + 'px';
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
    var masterWindow = document.querySelector('body');

    btn.classList.add('display_wormholeBottomBarBtn');
    bar.classList.remove('display_wormholeBottomBar');
    masterWindow.style.paddingBottom = '0';
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
    var masterWindow = document.querySelector('body');

    if (body.style.height != referebceBaseMinSize + 'px') {
        chevron.style.transform = 'rotate(180deg)';
        body.style.height = referebceBaseMinSize + 'px';
        masterWindow.style.paddingBottom = (referebceBaseMinSize + 4) + 'px';
    } else {
        chevron.style.transform = 'rotate(0deg)';
        body.style.height = referenceBaseHeight + 'px';
        masterWindow.style.paddingBottom = (referenceBaseHeight + 4) + 'px';
    }
}

const BORDER_SIZE = 49;
const wormholeBody = document.querySelector('#wormholeBottomBar');
const wormholeHandle = document.querySelector('#resize-wormholeBottomBar');

if (wormholeBody) {

    var chevron = document.querySelector('#wormholeBottomBarHeaderChevron');
    var masterWindow = document.querySelector('body');
    let m_pos;
    function resize(e){

        const dx = m_pos - e.y;
        m_pos = e.y;
        if (m_pos > window.innerHeight/3) {
            var height = (parseInt(getComputedStyle(wormholeBody, '').height) + dx);
            if (height > referebceBaseMinSize) {
                wormholeBody.style.height = height + 'px';
                masterWindow.style.paddingBottom = (height + 4) + 'px';
                chevron.style.transform = 'rotate(0deg)';
                referenceBaseHeight = height;
            } else {
                wormholeBody.style.height = referebceBaseMinSize + 'px';
                masterWindow.style.paddingBottom = (referebceBaseMinSize + 4) + 'px';
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

function wormholeGetArchives(ev) {

    var target = ev.currentTarget,
        windowOpen = document.querySelector('#wormholeBottomBarFolderOpen'),
        parent = target.closest('tr'),
        data = JSON.parse(parent.dataset.infos),
        select = document.querySelector('#wormholeBottomBarHeaderRightSelect'),
        debugBar = document.querySelector('#wormholeBottomBar'),
        optionsCounter = select.children.length + 1,
        options = select.children,
        selectChild = 1,
        check = false,
        time = (data.date) ? '(' + data.date.split(' ')[1] + ')' : '(Unknown date)';

    debugBar.classList.add('wormholeArchivesDisplay');

    for (var i = 0; i < options.length; i++) {
        if (options[i].dataset.id == data.id) {
            check = true;
            selectChild = i;
            break;
        }
    }

    if (check == false) {

        var option = document.createElement('option');
        option.setAttribute('value', parent.dataset.infos);
        option.setAttribute('data-id', data.id);
        option.innerHTML = '#' + optionsCounter + ' (opened) ' + time;
        select.appendChild(option);
        option.selected = true;

    } else {

        options[selectChild].selected = true;
    }

    windowOpen.classList.remove('display_wormholeBottomBarFolderOpen');
}

function searchInList(input) {

    var filter, ul, li, a, i, txtValue;
    filter = input.value.toUpperCase();
    ul = input.closest(".wormholeBottomBarBodyParts").querySelector('ul');
    if (ul) {

        lis = ul.querySelectorAll("li");
        for (i = 0; i < lis.length; i++) {

            var li = lis[i];
            txtValue = li.textContent || li.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                li.style.display = "";
            } else {
                li.style.display = "none";
            }
        }
    }
}

setFormatAndContentType();

function setFormatAndContentType() {

    var formatSpan = document.querySelector('#request_format'),
        contentTypeSpan = document.querySelector('#request_content_type'),
        charset = (document.characterSet) ? 'charset=' + document.characterSet : 'charset not defined',
        format = (document.doctype && document.doctype.name) ? document.doctype.name : 'not defined';

    formatSpan.innerHTML = format;
    contentTypeSpan.innerHTML = ((format.toLowerCase() == 'html' || format.toLowerCase() == 'xml') ? 'text/' : 'data/') + format + '; ' + charset;
}

function displayWormholeViewsStack(ev) {

    var li = ev.currentTarget,
        div = li.querySelector('div'),
        allDivs = document.querySelectorAll('.varsDropDown');

    if (div) {

        if (div.classList.contains('displayViewVars')) {
            div.classList.remove('displayViewVars');
        } else {
            for (var i = 0; i < allDivs.length; i++) {
                allDivs[i].classList.remove('displayViewVars');
            }
            div.classList.add('displayViewVars');
        }

    } else {

        for (var i = 0; i < allDivs.length; i++) {
            allDivs[i].classList.remove('displayViewVars');
        }
    }
}

function displayBodyPreview(elmt, mode) {

    if (mode == 'show') {

        var div = elmt.nextElementSibling;
        div.classList.add('displayWormholePreviewBody');

    } else if (mode == 'hide') {

        var div = elmt.closest('.wormholePreviewBody');
        div.classList.remove('displayWormholePreviewBody');
    }
}



