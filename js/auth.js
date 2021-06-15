let form = document.getElementById("submitReg");
form.addEventListener("click", checkAuth);

function checkAuth(e){
    fetch(`../php/check_auth.php?login=${document.getElementById("login").value}&password=${document.getElementById("password").value}`)
    .then(r => r.text())
    .then(data => {
        console.log(data)
        if(parseInt(data) === 0){
            form.submit();
        }

        else{
            document.getElementById("logPassErr").textContent = "Неправильный логин или пароль";
            document.getElementById("logPassErr").animate([
                {transform: 'scale(1)'},
                {transform: 'scale(1.5)'},
                {transform: 'scale(1)'}
            ],{
                duration: 1000
            })   

            document.getElementById("login").style.border= '2px solid red';
        }
    })
}



