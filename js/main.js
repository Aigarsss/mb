let userMail = document.getElementById('email')
let errorElement = document.getElementById('error')
let termsError = document.getElementById('termsError')
let form = document.getElementById("form")
let checkbox = document.getElementById("termsCheckbox")
let submitButton = document.getElementById("emailSubmit")

// Disable submit button if criteria not met
submitButton.disabled = true;

// Email validation regex from SO.
function validateEmail(email) {
    const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}

// Checkbox listener. Listens if terms have been clicked.
checkbox.addEventListener('change', function() {
if (this.checked) {
    termsError.style.visibility = "hidden";

    if (window.getComputedStyle(error).visibility === "hidden") {
        submitButton.disabled = false;
        validated();
    }

} else {
    termsError.style.visibility = "visible";
    termsError.innerHTML('You must accept the terms and conditions');
    }
});


// This shows the messages the first time the input is clicked
userMail.addEventListener('click', function(e){

    let checkCheckboxText = errorElement.textContent.includes("Please provide a valid e-mail address");
    let checkTermsText = termsError.textContent.includes("You must accept the terms and conditions");

    if ((userMail.value == "" ||  userMail.value == null) && ((!checkCheckboxText) && (!checkTermsText))) {

    errorElement.insertAdjacentHTML('beforeend', 'Email address is required');
    termsError.insertAdjacentHTML('beforeend', 'You must accept the terms and conditions');
    }
});


// todo, backspace not deteced, not sure how. Keydown, but then usermail value is not populated. So if user enters valid email, and then deletes it, user can still submit.
userMail.addEventListener('input', (e) => {

    let messages = [];

    //TODO. This doesnt really work, as just clicking in is not an input event.
    if (userMail.value == "" || userMail.value == null) {
        messages.push("Email address is required")
    }

    else if (!validateEmail(userMail.value)) {
        messages.push("Please provide a valid e-mail address")
    }

    if (userMail.value.endsWith(".co")) {
        messages.push("We are not accepting subscriptions from Colombia emails")
    }

    if (messages.length > 0) {
        errorElement.innerHTML = messages.join(", ")
    } else {
        errorElement.style.visibility = "hidden";
        
        if (checkbox.checked) {
            submitButton.disabled = false;
            validated();
        }
    }
});


//handle the success screen in JS if suumbit is clicked. Need to change code and remove the "validated()" from the other functions
//   submitButton.addEventListener('click', e => {
//     e.preventDefault();
//     validated();
//     });

let validated = () => {
    document.getElementById('main').innerHTML = 
    "<div id='successIcon'></div>" +
    "<h1>Thanks for subscribing!</h1>" +
    "<p>You have successfully subscribed to our email listing. Check your email for the discount code.</p>" +
    "<br>"
}