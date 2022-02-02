const form = document.querySelector(".form-div form"),
errorText = form.querySelector(".error-text"),
submitBtn = form.querySelector("button");

console.log(form);
console.log(errorText);



form.onsubmit = (e) => {
    e.preventDefault();
}


submitBtn.onclick = () => {
    
    

    // starting Ajax scripts
    let xhr = new XMLHttpRequest(); // new XML object
    xhr.open("POST", "../controller/add-seat.php", true);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) { {
            if (xhr.status === 200) {
                let data = xhr.response;
                console.log(data);
                if (data == "Success") {
                    location.href = "add-seats.php";
                }else{
                    errorText.textContent = data;
                    errorText.style.display = "block";
                }
            }
        }
            
        }
    }
    
    let formData = new FormData(form);
    xhr.send(formData);
}