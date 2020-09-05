/*
* ============================================================================
* ========================== HandlerErrors Script JS =========================
* ============================================================================
*/

resizeSections();
orderVendorFiles();

window.onresize = function() {
    resizeSections();
}

document.addEventListener('DOMContentLoaded', (event) => {
    document.querySelectorAll('pre code').forEach((block) => {
        hljs.highlightBlock(block);
    });
    seekErrorLineOnLoad();
});

var hideSolution = document.querySelector('#hideSolution');
if (hideSolution) {
    hideSolution.addEventListener('click', function () {
        document.querySelector('#middle').classList.add('hideSolutionSection');
    });
}

var displaySolution = document.querySelector('#displaySolution');
if (displaySolution) {
    displaySolution.addEventListener('click', function () {
        document.querySelector('#middle').classList.remove('hideSolutionSection');
    });
}

var developPlus = document.querySelectorAll('.developPlus');
for (var i = 0; i < developPlus.length; i++) {
    developPlus[i].addEventListener('click', function(ev){
        var target = ev.currentTarget,
            parent = target.parentElement,
            div = parent.nextElementSibling;

        parent.classList.add('displayReportContainer');
        div.classList.add('displayReportContainer');
    })
}

var developMinus = document.querySelectorAll('.developMinus');
for (var i = 0; i < developMinus.length; i++) {
    developMinus[i].addEventListener('click', function(ev){
        var target = ev.currentTarget,
            parent = target.parentElement,
            div = parent.nextElementSibling;

        parent.classList.remove('displayReportContainer');
        div.classList.remove('displayReportContainer');
    })
}

var onglets = document.querySelectorAll('.liToDrop');
for (var i = 0; i < onglets.length; i++) {
    onglets[i].addEventListener('click', selectLi);
}

var filterContainer = document.querySelectorAll('.filterContainer');
for (var i = 0; i < filterContainer.length; i++) {
    filterContainer[i].addEventListener('click', function(ev){
        var target = ev.currentTarget,
            check = 0,
            input = target.querySelector('input[type="checkbox"]'),
            block = document.querySelector('#' + target.dataset.id);

        if (input.checked == false) {
            if (block) {
                block.style.display = 'none';
            }
            document.querySelector('#filter span').style.visibility = 'visible';
        } else {
            if (block) {
                block.style.display = 'flex';
            }
            var allInputs = document.querySelectorAll('.filterContainer input[type="checkbox"]');
            for (var j = 0; j < allInputs.length; j++) {
                if (allInputs[j].checked == false) {
                    check = 1;
                }
            }
            if (check == 1) {
                document.querySelector('#filter span').style.visibility = 'visible';
            } else {
                document.querySelector('#filter span').style.visibility = 'hidden';
            }
        }
    });
}

var filterSpan = document.querySelector('#filter span');
if (filterSpan) {
    filterSpan.addEventListener('click', function (ev) {
        var target = ev.currentTarget,
            inputs = document.querySelectorAll('.filterContainer input[type="checkbox"]');
        for (var i = 0; i < inputs.length; i++) {
            if (inputs[i].checked == false) {
                inputs[i].parentElement.click();
            }
        }
        target.style.visibility = 'hidden';
    });
}

var deleters = document.querySelectorAll('.deleters');
for (var i = 0; i < deleters.length; i++) {
    deleters[i].addEventListener('click', function(ev){
        var target = ev.currentTarget,
            type = target.dataset.del,
            bloc = target.closest('.stdContent'),
            parent = bloc.parentElement,
            json = {
                'mode' : 'xhr',
                'job' : 'deleter',
                'type' : type
            },
            url = '/xmlhttprequests';

        $.post(url, json, function(data, status){
            if (status == 'success') {
                parent.removeChild(bloc);
            } else {
                console.log(data.error);
            }
        });
    });
}

var previewDump = document.querySelectorAll('.previewDump');
for (var i = 0; i < previewDump.length; i++) {
    previewDump[i].addEventListener('click', function(ev){
        var target = ev.currentTarget,
            element = document.querySelector('#' + target.dataset.id),
            scrollRail = element.querySelector('.scrollRail'),
            parentHeight = scrollRail.parentElement.scrollHeight,
            div = scrollRail.previousElementSibling,
            height = div.offsetHeight;

        scrollRail.style.height = 'calc(100% - ' + height + 'px)';
        element.classList.add('displayDumpPreview');
    });
}

var closeDumpPreview = document.querySelectorAll('.closeDumpPreview');
for (var i = 0; i < closeDumpPreview.length; i++) {
    closeDumpPreview[i].addEventListener('click', function(ev){
        var target = ev.currentTarget,
            element = document.querySelector('#' + target.dataset.id);
        element.classList.remove('displayDumpPreview');
    });
}

function selectLi(ev) {

    var target = ev.currentTarget,
        id = target.dataset.section,
        onglets = document.querySelectorAll('.liToDrop'),
        sections = document.querySelectorAll('.sections');

    for (var i = 0; i < onglets.length; i++) {
        onglets[i].classList.remove('selectedLi');
    }
    target.classList.add('selectedLi');

    for (var i = 0; i < sections.length; i++) {
        if (sections[i].id == id) {
            sections[i].classList.remove('hideSection');
        } else {
            sections[i].classList.add('hideSection');
        }
    }
}

function resizeSections() {

    var sections = document.querySelectorAll('.sections'),
        onglets = document.querySelector('#ongletsSection'),
        div = document.querySelector('#issuesBox'),
        ongletsSize = onglets.scrollHeight - div.scrollHeight;

    for (var i = 0; i < sections.length; i++) {
        sections[i].style.height = 'calc(100% - ' + ongletsSize + 'px)';
    }

    var aside = document.querySelector('#aside'),
        supAside = document.querySelector('#supAside'),
        asideSize = supAside.scrollHeight;

    aside.style.height = 'calc(100% - ' + asideSize + 'px)';

    var content = document.querySelectorAll('.content')
    for (var i = 0; i <content.length ; i++) {
        var sup = content[i].previousElementSibling,
            supSize = sup.scrollHeight;

        content[i].style.height = 'calc(100% - ' + supSize + 'px)';
    }
}

function navigateInFrames(mode) {

    var actual = document.querySelector('.selectedStack'),
        all = document.querySelectorAll('.traceList'),
        vendorContainers = document.querySelectorAll('.vendorsContainer'),
        parent = actual.parentElement;

    if (mode == 'prev') {

        if (actual.previousElementSibling) {
            if (!actual.previousElementSibling.classList.contains('vendorFile')) {
                actual.classList.remove('selectedStack');
                if (actual.previousElementSibling.classList.contains('vendorsContainer')) {
                    actual.previousElementSibling.previousElementSibling.click();
                } else {
                    actual.previousElementSibling.click();
                }
            } else {
                actual.classList.remove('selectedStack');
                if (!actual.previousElementSibling.classList.contains('vendorFileDisplay')) {
                    var dataset = actual.previousElementSibling.dataset.vendor;
                    for (var i = 0; i < vendorContainers.length; i++) {
                        if (vendorContainers[i].dataset.vendor == dataset) {
                            vendorContainers[i].click();
                        }
                    }
                }
                actual.previousElementSibling.click();
            }
        } else {
            if (!parent.children[parent.children.length - 1].classList.contains('vendorFile')) {
                actual.classList.remove('selectedStack');
                if (parent.children[parent.children.length - 1].classList.contains('vendorsContainer')) {
                    parent.children[parent.children.length - 2].click();
                } else {
                    parent.children[parent.children.length - 1].click();
                }
            } else {
                actual.classList.remove('selectedStack');
                if (!parent.children[parent.children.length - 1].classList.contains('vendorFileDisplay')) {
                    var dataset = parent.children[parent.children.length - 1].dataset.vendor;
                    for (var i = 0; i < vendorContainers.length; i++) {
                        if (vendorContainers[i].dataset.vendor == dataset) {
                            vendorContainers[i].click();
                        }
                    }
                }
                parent.children[parent.children.length - 1].click();
            }
        }

    } else if (mode == 'next') {

        if (actual.nextElementSibling) {
            if (!actual.nextElementSibling.classList.contains('vendorsContainer')) {
                actual.classList.remove('selectedStack');
                actual.nextElementSibling.click();
            } else {
                actual.classList.remove('selectedStack');
                if (!actual.nextElementSibling.classList.contains('deployVendors')) {
                    actual.nextElementSibling.click();
                }
                actual.nextElementSibling.nextElementSibling.click();
            }
        } else {
            if (!parent.children[0].classList.contains('vendorsContainer')) {
                actual.classList.remove('selectedStack');
                parent.children[0].click();
            } else {
                actual.classList.remove('selectedStack');
                if (!parent.children[0].classList.contains('deployVendors')) {
                    parent.children[0].click();
                }
                parent.children[1].click();
            }
        }
    }
}

function expanderFrames(elmt) {

    var expanders = document.querySelectorAll('.vendorsContainer'),
        vendors = document.querySelectorAll('.vendorFile');

    if (elmt.classList.contains('expandFrames')) {

        elmt.innerHTML = 'Expand vendor frames';
        elmt.classList.remove('expandFrames');
        for (var i = 0; i < expanders.length; i++) {
            expanders[i].classList.remove('deployVendors');
            var dataset = expanders[i].dataset.vendor;
            for (var j = 0; j < vendors.length; j++) {
                if (vendors[j].dataset.vendor == dataset) {
                    vendors[j].classList.remove('vendorFileDisplay');
                }
            }
        }
    } else {

        elmt.innerHTML = 'Collapse vendor frames';
        elmt.classList.add('expandFrames');
        for (var i = 0; i < expanders.length; i++) {
            expanders[i].classList.add('deployVendors');
            var dataset = expanders[i].dataset.vendor;
            for (var j = 0; j < vendors.length; j++) {
                if (vendors[j].dataset.vendor == dataset) {
                    vendors[j].classList.add('vendorFileDisplay');
                }
            }
        }
    }
}

var listers = document.querySelectorAll('.traceList');
for (var i = 0; i < listers.length; i++) {
    listers[i].addEventListener('click', function(ev) {

        var onglet = ev.currentTarget,
            id = onglet.dataset.id,
            listers = document.querySelectorAll('.traceList'),
            editors = document.querySelectorAll('#stackTrace section:nth-child(2) .container'),
            line = parseInt(onglet.children[2].innerHTML.replace(':', ''));

        for (var i = 0; i < editors.length; i++) {
            var editor = editors[i],
                editorID = editor.dataset.id;
            if (editorID == id) {
                editor.classList.remove('hideStackFile');
                var tr = editor.querySelector('tr[data-line="' + line + '"]');
                tr.scrollIntoView();
            } else {
                editor.classList.add('hideStackFile');
            }
        }

        for (var i = 0; i < listers.length; i++) {
            listers[i].classList.remove('selectedStack');
        }

        onglet.classList.add('selectedStack');
        resizeSections();
    });
}

var vendorsContainer = document.querySelectorAll('.vendorsContainer');
for (var i = 0; i < vendorsContainer.length; i++) {
    vendorsContainer[i].addEventListener('click', function(ev) {

        var target = ev.currentTarget,
            data = target.dataset.vendor,
            vendors = document.querySelectorAll('.vendorFile');

        if (target.classList.contains('deployVendors')) {
            target.classList.remove('deployVendors');
        } else {
            target.classList.add('deployVendors');
        }

        for (var i = 0; i < vendors.length; i++) {
            var vendor = vendors[i],
                dataVendor = vendor.dataset.vendor;

            if (dataVendor == data) {
                if (vendor.classList.contains('vendorFileDisplay')) {
                    vendor.classList.remove('vendorFileDisplay');
                } else {
                    vendor.classList.add('vendorFileDisplay');
                }
            }
        }
    });
}

function orderVendorFiles() {

    var files = document.querySelectorAll('.vendorFile'),
        onglets = document.querySelectorAll('.vendorsContainer');

    for (var i = 0; i < onglets.length; i++) {
        var onglet = onglets[i],
            data = onglet.dataset.vendor,
            count = 0;

        for (var j = 0; j < files.length; j++) {
            var file = files[j],
                fileData = file.dataset.vendor;

            if (data == fileData) {
                count++;
            }
        }

        onglet.querySelector('p').innerHTML = (count > 1) ? count + ' vendor frames' : count + ' vendor frame';
    }
}

function seekErrorLineOnLoad() {

    var first = document.querySelector('.selectedStack');
    first.click();
}

function fetchSimilarHeaders (callback) {
    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.readyState === XMLHttpRequest.DONE) {
            //
            // The following headers may often be similar
            // to those of the original page request...
            //
            if (callback && typeof callback === 'function') {
                callback(request.getAllResponseHeaders());
            }
        }
    };

    //
    // Re-request the same page (document.location)
    // We hope to get the same or similar response headers to those which
    // came with the current page, but we have no guarantee.
    // Since we are only after the headers, a HEAD request may be sufficient.
    //
    request.open('HEAD', document.location, true);
    request.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    request.send(null);
}

fetchSimilarHeaders(function(data){

    var splitLines = data.split('\n'),
        final = '',
        responseHeader = document.querySelector('#responseHeader');

    for (var i = 0; i < splitLines.length; i++) {
        var line = splitLines[i];
        if (line != '' && line.split(': ')[0] != 'status') {
            final += '<dl><dt>' + line.split(': ')[0] + ' :</dt>';
            final += '<dd>' + line.split(': ')[1] + '</dd></dl>';
        }
    }
    if (responseHeader) {
        responseHeader.innerHTML += final;
    }
});