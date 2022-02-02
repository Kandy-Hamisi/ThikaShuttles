const form = document.querySelector(".displayprice form"),
errorText = form.querySelector(".error-text"),
submitBtn = form.querySelector(".btn");



form.onsubmit = (e) => {
    e.preventDefault();
}

submitBtn.onclick = () => {
    
    // the start of ajax
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "../controller/hiring.php", true);
    xhr.onload = ()=>{
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response;
                // console.log(data);
                
                if(data == "Success"){
                    location.href = 'hire.php';
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