/*
* =================================================================
* ===================== Wormhole JS Listeners =====================
* =================================================================
*/

var wormholeBottomBarBtn = document.querySelector('#wormholeBottomBarBtn');
if (wormholeBottomBarBtn) {
    wormholeBottomBarBtn.addEventListener('click', displayWormholeBottomBar);
}

var wormholeBottomBarHeaderDirectory = document.querySelector('#wormholeBottomBarHeaderDirectory');
if (wormholeBottomBarHeaderDirectory) {
    wormholeBottomBarHeaderDirectory.addEventListener('click', displayFolderWormholeBottomBar);
}

var wormholeBottomBarHeaderChevron = document.querySelector('#wormholeBottomBarHeaderChevron');
if (wormholeBottomBarHeaderChevron) {
    wormholeBottomBarHeaderChevron.addEventListener('click', sizeDownWormholeBottomBar);
}

var wormholeBottomBarClose = document.querySelector('#wormholeBottomBarHeaderClose');
if (wormholeBottomBarClose) {
    wormholeBottomBarClose.addEventListener('click', hideWormholeBottomBar);
}