var pattern = /^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/;

function emailValidation() {

    var str = document.getElementById('email').value;

    if (str.match(pattern) == null) {
        document.getElementById('email').style.backgroundColor = 'red';
    } else {
        document.getElementById('email').style.backgroundColor = null;
    }
}
