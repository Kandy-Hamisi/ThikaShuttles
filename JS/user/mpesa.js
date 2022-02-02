const form = document.querySelector(".form form"),
errorText = form.querySelector(".error-text"),
payBtn = form.querySelector(".btn");

form.onsubmit = (e) => {
    e.preventDefault();
}


payBtn.onclick = () => {
    

    // the start of ajax
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "../controller/mpesa.php", true);
    xhr.onload = ()=>{
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response;
                // console.log(data);
                
                if(data == "Success"){
                    location.href = 'reserve.php';
                }else{
                    errorText.textContent = data;
                    errorText.style.display = "block";
                }
            }
            
        }
    }

    // we have to send the form data through ajax to php
    let formData = new FormData(form); //Creating new formData Object
    xhr.send(formData); //sending the form data to php
}