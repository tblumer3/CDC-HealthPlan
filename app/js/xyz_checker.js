//pass ids in with quotes, they aren't js variables!!!
// ___________________________________________________
//
function checkEmail(email_id) {
    var email = document.getElementById(email_id).value;

    if (email !== "") {
        return true;
    } else {
        alert('You must enter an email address!');
        return false;
    }
}

function checkForNumber(input_id) {
    var person_id_string = document.getElementById(input_id).value;
    var person_id_number = parseInt(person_id_string, 10);
    if (typeof person_id_number === 'number' && (person_id_number % 1) === 0) {
        return true;
    } else {
        alert('Please enter a valid Integer!');
        return false;
    }
}

function checkPassword(password1_id, password2_id) {
    var pass1 = document.getElementById(password1_id).value;
    var pass2 = document.getElementById(password2_id).value;
    if (pass1 !== "") { // is there a new password entered?
        if (pass1 == pass2) {  // are the two passwords identical?
            return true;
        } else {
            alert('Passwords do not match.');
            return false;
        }
    } else {
        alert('You must enter a password.');
        return false;
    }
}

function checkBadgeCode(badge_code_id) {
    var regex = /\s/;
    var space_present = false;
    var short_code = document.getElementById(badge_code_id).value;

    if (short_code !== "") {
        space_present = regex.test(short_code);
        if (space_present) {
            return true;
        } else {
            alert('You must have a space between the two words!');
            return false;
        }
    } else {
        alert('You must enter your badge short code');
        return false;
    }
}