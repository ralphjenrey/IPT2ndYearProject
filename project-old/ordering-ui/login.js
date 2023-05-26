const container = document.querySelector(".login-container"),
      pwShowHide = document.querySelectorAll(".showHidePw"),
      pwFields = document.querySelectorAll(".password"),
      signUp = document.querySelector(".signup-link"),
      login = document.querySelector(".login-link");

    //   js code to show/hide password and change icon
    pwShowHide.forEach(eyeIcon =>{
        eyeIcon.addEventListener("click", ()=>{
            pwFields.forEach(pwField =>{
                if(pwField.type ==="password"){
                    pwField.type = "text";

                    pwShowHide.forEach(icon =>{
                        icon.classList.replace("uil-eye-slash", "uil-eye");
                    })
                }else{
                    pwField.type = "password";

                    pwShowHide.forEach(icon =>{
                        icon.classList.replace("uil-eye", "uil-eye-slash");
                    })
                }
            }) 
        })
    })

    // js code to appear signup and login form
    signUp.addEventListener("click", ( )=>{
        container.classList.add("active");
    });
    login.addEventListener("click", ( )=>{
        container.classList.remove("active");
    });

    var attempt = 8; // Variable to count number of attempts.
// Below function Executes on click of login button.
function validate(){
var username = document.querySelector(".email").value;
var password = document.querySelector(".password").value;
var incorrect = document.getElementById("incorrect");
var maximum = document.getElementById("maximum");
display = document.querySelector('#time');
if ( username == "admin@gmail.com" && password == "123"){
alert ("Login successfully");
window.location = "success.html"; // Redirecting to other page.
return false;
}
else if(attempt == 6){
// Disabling fields after 3 attempts.
incorrect.style.display = "none";
maximum.style.display = "block";
startTimer(30,display);
disable();
attempt--;
}
else if(attempt == 3){
// Disabling fields after 3 attempts.
incorrect.style.display = "none";
maximum.style.display = "inline";
startTimer(100,display);
disable();
attempt--;
}
else if(attempt == 0){
// Disabling fields after 3 attempts.
incorrect.style.display = "none";
maximum.style.display = "inline";
startTimer(200,display);
disable();
attempt--;
}
else if(attempt < 0){
// Disabling fields after 3 attempts.
incorrect.style.display = "none";
maximum.style.display = "inline";
disable();
}
else {
attempt --;// Decrementing by one.
incorrect.style.display = "flex";
document.querySelector(".email").value = "";
document.querySelector(".password").value = "";
}
}



function disable(){
    document.querySelector(".email").disabled = true;
    document.querySelector(".password").disabled = true;
    document.getElementById("submit").disabled = true;
return false;
}

function enable(){
    document.querySelector(".email").disabled = false;
    document.querySelector(".password").disabled = false;
    document.getElementById("submit").disabled = false;
    return false
}

function startTimer(duration, display) {
    var timer = duration, minutes, seconds;
     var stop = setInterval(function () {
        minutes = parseInt(timer / 60, 10);
        seconds = parseInt(timer % 60, 10);

        minutes = minutes < 10 ? "0" + minutes : minutes;
        seconds = seconds < 10 ? "0" + seconds : seconds;

        display.textContent = minutes + ":" + seconds;

        if (--timer < 0) {
            document.getElementById("maximum").style.display = "none";
            enable();
            clearInterval(stop);
        }
    }, 1000);
}


