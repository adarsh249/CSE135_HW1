const activityData = {};
activityData.mouseActivity = {};
activityData.keyboardActivity = {};
const performanceData = {};

//stolen from: https://stackoverflow.com/questions/105034/how-do-i-create-a-guid-uuid
function uuidv4() {
    return ([1e7]+-1e3+-4e3+-8e3+-1e11).replace(/[018]/g, c =>
      (c ^ crypto.getRandomValues(new Uint8Array(1))[0] & 15 >> c / 4).toString(16)
    );
}
let userSessionID;
if(localStorage.getItem("sessionID")){
    userSessionID = localStorage.getItem("sessionID")
}
else {
    userSessionID = uuidv4();
    localStorage.setItem("sessionID", userSessionID);
}
console.log("Your Session ID: " + userSessionID);

activityData.userSessionID = userSessionID;
performanceData.userSessionID = userSessionID;

//static collectors
let userAgent = navigator.userAgent; //user agent string
let userLanguages = navigator.languages; //user's known languages
let userPreferredLanguage = navigator.language; //user's language
let userCookiesEnabled = navigator.cookieEnabled; //if user accepts cookies


// Window Dimension
let userScreenWidth = window.screen.width; //user's screen dimensions
let userScreenHeight = window.screen.height; //user's screen dimensions
let userScreenDimensions = [userScreenWidth, userScreenHeight];
let userWindowWidth = window.innerWidth; //user's window dimensions
let userWindowHeight = window.innerHeight; //user's window dimensions
let userWindowDimensions = [userWindowWidth, userWindowHeight];
let userNetworkConnectionType = navigator.connection.effectiveType; //user's network connection type
// User Performance

//Performance Collectors
window.onload = function() {
    let start = window.performance.timing.navigationStart; //page started loading
    let startDate = new Date(start);
    let startTime = startDate;

    let end = window.performance.timing.domContentLoadedEventEnd; //page load done
    let endDate = new Date(end);
    let endTime = endDate;
    let loadTime = end - start; //total load time
    //debug
    console.log("Start Load Time: ", startTime);
    console.log("End Load Time: ", endTime);
    console.log("Load Time (ms): ", loadTime);
    performanceData.pageLoadTime = loadTime;
    performanceData.pageLoadStartTime = startTime;
    performanceData.pageLoadEndTime = endTime;

    console.log("Performance Data: \n");

    console.log(JSON.stringify(performanceData));
    
    localStorage.setItem("performanceData", JSON.stringify(performanceData));

    fetch('https://cse151group111.online/api/performance', {
        method: 'POST', 
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(performanceData)
    }).then(response => {
        if (response.ok) {
            console.log('Performance data sent successfully');
        } else {
            console.error('Failed to send performance data');
        }
    }).catch(error => {
        console.error(`Error occurrsed while sending performance data: ${error}`);
    })

    let trackerImage = document.getElementById("trackerImage");
    // let userImagesEnabled;
    if(trackerImage.width == 1){
        staticData.userImagesEnabled = true;
        console.log("Images Enabled: true");
    }
    else {
        staticData.userImagesEnabled = false;
        console.log("Images Enabled: false");
    }
    let trackerCSS = document.getElementById("trackerCSS");
    let userCSSEnabled = (trackerCSS.style.color === "white");
    staticData.userCSSEnabled = userCSSEnabled;
    //I just put a noscript tag for Javascript Enabled
    staticData.userJSEnabled = true;
    localStorage.setItem("staticData", JSON.stringify(staticData));
    fetch('https://cse151group111.online/api/static', {
        method: 'POST', 
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(staticData)
    }).then(response => {
        if (response.ok) {
            console.log('Static data sent successfully');
        } else {
            console.error('Failed to send static data');
        }
    }).catch(error => {
        console.error(`Error occurred while sending static data: ${error}`);
    })


    setInterval(() => {
    
        console.log("Activity Data:")
        console.log(JSON.stringify(activityData));
        localStorage.setItem("activityData", JSON.stringify(activityData));
        console.log(localStorage);
    
        fetch(`https://cse151group111.online/api/activity/${id}`, {
            method: 'PUT', 
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(activityData)
        }).then(response => {
            if (response.ok) {
                console.log('Activity data sent successfully');
            } else {
                console.error('Failed to send activity data');
            }
        }).catch(error => {
            console.error(`Error occurred while sending activity data: ${error}`);
        })
    
    }, 10000);

}
let timingObject = window.performance.timing; //timing object
performanceData.pageTimingObject = timingObject;

window.onerror = (message, source, lineo, colno, error) => {
    let errorMessage = message;
    let errorSource = source;
    let errorLineNumber = lineo;
    let errorColumnNumber = colno;
    let errorThrown = error;
    let thrownErrors = {
        errorMessage: errorMessage,
        errorSource: errorSource,
        errorLineNumber: errorLineNumber,
        errorColumnNumber: errorColumnNumber,
        errorThrown: errorThrown
    }
    activityData.errors = thrownErrors;

    return true;
}

let cursorPositions = [];
//All Mouse Activity
window.addEventListener("mousemove", function(event) {
    let cursorX = event.clientX;
    let cursorY = event.clientY;
    cursorPositions.push({x: cursorX, y: cursorY});
});
activityData.mouseActivity.cursorPositions = cursorPositions;

let clickPositions = [];
let mouseButtonClicked = [];
window.addEventListener("mousedown", function(event) {
    let clickX = event.clientX;
    let clickY = event.clientY;
    clickPositions.push({x: clickX, y: clickY});
    // taken from https://developer.mozilla.org/en-US/docs/Web/API/MouseEvent/button
    switch (event.button) {
        case 0: // left button
            mouseButtonClicked.push("Left Click");
            break;
        case 1: // middle button
            mouseButtonClicked.push("Middle Click");
            break;
        case 2: // right button
            mouseButtonClicked.push("Right Click");
            break;
        case 3:
            mouseButtonClicked.push("Auxiliary Back Button Click");
            break;
        case 4:
            mouseButtonClicked.push("Auxiliary Forward Button Click");
            break;
        default:
            mouseButtonClicked.push(`Unknown:  ${e.button}`);
   }
});
activityData.mouseActivity.clickPositions = clickPositions;
activityData.mouseActivity.mouseButtonClicked = mouseButtonClicked;

let scrollPositions = [];
window.addEventListener("scroll", function() {
    let scrollX = window.scrollX;
    let scrollY = window.scrollY;
    scrollPositions.push({x: scrollX, y: scrollY});
});
activityData.mouseActivity.scrollPositions = scrollPositions;

let keyDowns = [];
window.addEventListener("keydown", function(event) {
    let keydown = event.key;
    keyDowns.push(keydown);
});
activityData.keyboardActivity.keyDowns = keyDowns;
let keyUps = [];
window.addEventListener("keyup", function(event) {
    let keyup = event.key;
    keyUps.push(keyup);
});
activityData.keyboardActivity.keyUps = keyUps;
//Track user idle time
let timeOut;
let idleStart;
let idleEnd;
function idling() {
    window.addEventListener("mousemove", resetTimer, false);
    window.addEventListener("mousedown", resetTimer, false);
    window.addEventListener("keypress", resetTimer, false);
    window.addEventListener("scroll", resetTimer, false);
    window.addEventListener("wheel", resetTimer, false);
    window.addEventListener("touchmove", resetTimer, false);
    window.addEventListener("pointermove", resetTimer, false);
    startTimer();
}
idling();

function startTimer() {
    timeOut = window.setTimeout(inactive, 2000);
    idleStart = new Date();
}

function inactive() {

}
let idleTimes = [];
function activity() {
    clearTimeout(timeOut);
    idleEnd = new Date();
    idleDuration = idleEnd - idleStart;
    if(idleDuration > 2000){
        idleTimes.push({idleEnd: idleEnd, idleDuration: idleDuration});
    }
    
    idleStart = null;
}
activityData.idleTimes = idleTimes;
function resetTimer() {
   if(idleStart == null) {
        idleStart = new Date();
   }
   else {
    activity();
   }
}
let userTimeEntered = [];
let userTimeLeft = [];
window.addEventListener("visibilitychange", () => {
    let userTimeEntered;
    let userTimeLeft;
    let userCurrentPage = window.location.href;
    if(document.visibilityState === "visible"){
        userTimeEntered = [new Date()];
        userTimeEntered.push({userTimeEntered: userTimeEntered, page: userCurrentPage});
    }
    else {
        userTimeLeft = [new Date()];
        userTimeLeft.push({userTimeLeft: userTimeLeft, page: userCurrentPage});
    }
    
});

window.addEventListener("DOMContentLoaded", () => {
    let userIntialPageEnteredTime = new Date();
    let userIntialPage = window.location.href;
    userTimeEntered.push({userIntialPageEnteredTime: userIntialPageEnteredTime, page: userIntialPage});
});

activityData.userTimeEntered = userTimeEntered;
activityData.userTimeLeft = userTimeLeft;


//I just put a noscript tag for Javascript Enabled
// Saving Data Locally
let staticData = {
    userSessionID: userSessionID,
    userAgent: userAgent,
    userLanguages: userLanguages,
    userPreferredLanguage: userPreferredLanguage,
    userCookiesEnabled: userCookiesEnabled,
    userScreenDimensions: userScreenDimensions,
    userWindowDimensions: userWindowDimensions,
    userNetworkConnectionType: userNetworkConnectionType
};


localStorage.setItem("activityData", JSON.stringify(activityData));

var id;

fetch('https://cse151group111.online/api/activity', {
    method: 'POST', 
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify(activityData)
}).then(response => {
    if (response.ok) {
        console.log('Activity data sent successfully');
    } else {
        console.error('Failed to send activity data');
    }
    return response.json();
}).then(data => {
    console.log(data);
    id = data.result.insertId;
    console.log(id);
}).catch(error => {
    console.error(`Error occurred while sending activity data: ${error}`);
});
