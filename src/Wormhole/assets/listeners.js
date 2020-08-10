/*
* =================================================================
* ===================== Wormhole JS Listeners =====================
* =================================================================
*/

// Open Debugger
var wormholeBottomBarBtn = document.querySelector('#wormholeBottomBarBtn');
if (wormholeBottomBarBtn) {
    wormholeBottomBarBtn.addEventListener('click', displayWormholeBottomBar);
}

// Display PHP Debugger Window
var wormholeBottomBarHeaderDirectory = document.querySelector('#wormholeBottomBarHeaderDirectory');
if (wormholeBottomBarHeaderDirectory) {
    wormholeBottomBarHeaderDirectory.addEventListener('click', displayFolderWormholeBottomBar);
}

// Close PHP Debugger Window
var wormholeBottomBarFolderOpenHeaderRightClose = document.querySelector('#wormholeBottomBarFolderOpenHeaderRightClose');
if (wormholeBottomBarFolderOpenHeaderRightClose) {
    wormholeBottomBarFolderOpenHeaderRightClose.addEventListener('click', closeFolderWormholeBottomBar);
}

// Display UX Debugger Window
var wormholeBottomBarHeaderDirectory = document.querySelector('#wormholeBottomBarHeaderUX');
if (wormholeBottomBarHeaderDirectory) {
    wormholeBottomBarHeaderDirectory.addEventListener('click', displayUXWormholeBottomBar);
}

// Close UX Debugger Window
var wormholeBottomBarFolderOpenHeaderRightClose = document.querySelector('#wormholeBottomBarUXOpenHeaderRightClose');
if (wormholeBottomBarFolderOpenHeaderRightClose) {
    wormholeBottomBarFolderOpenHeaderRightClose.addEventListener('click', closeUXWormholeBottomBar);
}

// Resize Debugger
var wormholeBottomBarHeaderChevron = document.querySelector('#wormholeBottomBarHeaderChevron');
if (wormholeBottomBarHeaderChevron) {
    wormholeBottomBarHeaderChevron.addEventListener('click', sizeDownWormholeBottomBar);
}

// Close Debugger
var wormholeBottomBarClose = document.querySelector('#wormholeBottomBarHeaderClose');
if (wormholeBottomBarClose) {
    wormholeBottomBarClose.addEventListener('click', hideWormholeBottomBar);
}

// Get Archives
var debuggerShowSession = document.querySelectorAll('.debuggerShowSession');
if (debuggerShowSession) {
    for (var i = 0; i < debuggerShowSession.length; i++) {
        debuggerShowSession[i].addEventListener('click', wormholeGetArchives);
    }
}