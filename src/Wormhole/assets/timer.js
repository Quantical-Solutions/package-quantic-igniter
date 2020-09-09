/*
* =================================================================
* ======================= Wormhole JS Timer =======================
* =================================================================
*/

var microTimer = document.querySelector('#microTime');

if (microTimer) {

    var microTime = parseInt(microTimer.dataset.time)*1000,
        requestTime = microTimer.dataset.request,
        bootLine = document.querySelector('#bootingLine .timeCalculated'),
        appLine = document.querySelector('#appLine .timeCalculated'),
        bootCalc = document.querySelector('#bootCalc calc'),
        appCalc = document.querySelector('#appCalc calc'),
        timeCalculatedBoot = document.querySelector('#timeCalculatedBoot'),
        timeCalculatedApp = document.querySelector('#timeCalculatedApp'),
        microTimeDate = new Date(),
        microTimeTotal = parseInt(microTimeDate.getTime()) - microTime,
        totalMicrotime = Math.round(microTimeTotal),
        microApp = totalMicrotime - requestTime,
        bootPercent = ((requestTime * 100)/totalMicrotime).toFixed(2),
        appPercent = 100 -  bootPercent,
        bootBar1 = document.querySelector('#bootingLine .bgTimeLine'),
        appBar1 = document.querySelector('#appLine .bgTimeLine'),
        bootBar2 = document.querySelector('#bootCalc'),
        appBar2 = document.querySelector('#appCalc');

    timeCalculatedBoot.innerHTML = bootPercent + '%';
    timeCalculatedApp.innerHTML = appPercent + '%';

    bootBar1.style.width = 'calc(' + bootPercent + '% - 10px)';
    appBar1.style.width = 'calc(' + appPercent + '% - 10px)';
    appBar1.style.left = bootPercent + '%';

    bootBar2.style.width = 'calc(' + bootPercent + '% - 10px)';
    appBar2.style.width = 'calc(' + appPercent + '% - 10px)';

    microTimer.innerHTML = (totalMicrotime < 1200) ? totalMicrotime + 'ms' : (totalMicrotime/1000).toFixed(2) + 's';
    bootLine.innerHTML = (requestTime < 1200) ? requestTime + 'ms' : (requestTime/1000).toFixed(2) + 's';
    appLine.innerHTML = (microApp < 1200) ? microApp + 'ms' : (microApp/1000).toFixed(2) + 's';
    bootCalc.innerHTML = (requestTime < 1200) ? requestTime + 'ms' : (requestTime/1000).toFixed(2) + 's';
    appCalc.innerHTML = (microApp < 1200) ? microApp + 'ms' : (microApp/1000).toFixed(2) + 's';
}