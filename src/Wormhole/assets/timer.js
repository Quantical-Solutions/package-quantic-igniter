/*
* =================================================================
* ======================= Wormhole JS Timer =======================
* =================================================================
*/

var microTimer = document.querySelector('#microTime');

if (microTimer) {

    var microTime = parseInt(microTimer.dataset.time)*1000;
    var microTimeDate = new Date();
    var microTimeTotal = parseInt(microTimeDate.getTime()) - microTime;
    var totalMicrotime = Math.round(microTimeTotal);
    microTimer.innerHTML = (totalMicrotime < 1200) ? totalMicrotime + 'ms' : (totalMicrotime/1000).toFixed(2) + 's';
}