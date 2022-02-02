const pwd1 = document.querySelector("#password");
const pwd2 = document.querySelector("#password2");
const matching = document.querySelector(".matching");

const kenyaID = document.querySelector("#idno");
const contact = document.querySelector("#contact");
const contactError = document.querySelector(".cont-error");

const clicker = document.querySelector(".clicker");

const hireBtn = document.querySelector(".card-footer .btn-hire");
const reserveBtn = document.querySelector(".card-footer .btn-reserve");


reserveBtn.onclick = () => {
    location.href = "user/login.php";
}

hireBtn.onclick = () => {
    location.href = "user/login.php";
}

console.log(clicker);

clicker.onclick = (e) => {
    e.preventDefault();
}



const checkContact = () => {
    try {
        let myContact = contact.value;
        if (myContact[0] != 2) {
            console.log("use 254 format");
            contactError.innerText = "use 254 format, without a plus sign";
            contactError.style.display = "block";
        }
        if (myContact.length < 12) {
            console.log("count error! Check your number");
            contactError.innerText = "count error! Check your number"
            contactError.style.display = "block";
        }

    } catch (error) {
        console.log(error);
    }
}


const checkNumber = () => {
    try {
        let numbers = kenyaID.value;
        console.log(numbers);
        console.log(numbers.length);
        if (numbers.length < 8 || numbers.length > 10 ) {
            console.log("Number must be length of 8 or 10");
        }
    } catch (error) {
        console.log(error);
    }

    
}




const checkValue = () => {
    console.log(pwd1.value);
    console.log(pwd2.value);
    if (pwd1.value === pwd2.value) {
        matching.innerText = "The Two Passwords match";
    }else{
        matching.innerText = "The Two Passwords dont match";
    }
}

