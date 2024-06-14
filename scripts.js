/* This section is for displaying and closing the login modal */
var modal = document.getElementById("loginModal");

// Getting the button which will open the login modal
var btn = document.querySelector(".nav-link[href='#']");

// Get the <span> element twhich will allow a user to close the login modal
var span = document.getElementsByClassName("close")[0];

// function to open the login modal
btn.onclick = function() {
    modal.style.display = "block";
}

// When the user clicks on <span> "x" symbol, close the modal
span.onclick = function() {
    modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal it will close
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

//This section is handling the "forgot password" in the login modal

var forgotmodal = document.getElementById("forgotPasswordModal");

var forgotbtn = document.querySelector(".forgot-password-link");

var closebtn = document.getElementsByClassName("close")[1];

forgotbtn.onclick = function(){
    modal.style.display = "none";
    forgotmodal.style.display = "block";
}

closebtn.onclick = function(){
    forgotmodal.style.display = "none";
}

//This section is handling the "create account" in the login modal 

var createaccountmodal = document.getElementById("createAccountModal");

var createbtn = document.querySelector(".create-account-link");

var loginclose = document.getElementsByClassName("close")[2];

createbtn.onclick = function(){
    modal.style.display = "none";
    createaccountmodal.style.display = "block";
}

loginclose.onclick = function(){
    createaccountmodal.style.display = "none";
}


//This section is handling the confirmation prompt when you submit a custom order

var sendbtn = document.getElementsByClassName("submit-btn")[0];

var message = "Thank you for submitting a custom order! We will check our database for the custom request.";

sendbtn.onclick = function(){
    confirm(message);
}