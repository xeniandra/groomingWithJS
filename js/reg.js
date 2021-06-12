function checkRegister(event) {
    event.preventDefault();
    let fio = document.getElementById("fio").value;
    let login = document.getElementById("login").value;
    let password = document.getElementById("password").value;
    let passwordCheck = document.getElementById("confirmPassword").value;
    let errorFlag = false;
    let form = document.getElementById("formReg");
    let fio_reg = /^[а-яА-ЯёЁ\-\ ]+$/;
    let login_reg = /^[A-Za-z -]+$/;

    if(!fio_reg.test(fio)) {
        document.getElementById("fioError").textContent = "ФИО должен содержать только кириллические буквы, дефис и пробелы";
        document.getElementById("fioError").animate([
            {transform: 'scale(1)'},
            {transform: 'scale(1.5)'},
            {transform: 'scale(1)'}
        ],{
            duration: 1000
        })
        errorFlag = true;
    }
    if(!login_reg.test(login)) {
        errorFlag = true;
        document.getElementById("loginError").textContent = "Логин должен содержать только только латиницу и дефис";
        document.getElementById("loginError").animate([
            {transform: 'scale(1)'},
            {transform: 'scale(1.5)'},
            {transform: 'scale(1)'}
        ],{
            duration: 1000
        })   
    }
    if(password != passwordCheck) {
        errorFlag = true;
        document.getElementById("passwordError").textContent = "Пароли не совпадают";
        document.getElementById("passwordError").animate([
            {transform: 'scale(1)'},
            {transform: 'scale(1.5)'},
            {transform: 'scale(1)'}
        ],{
            duration: 1000
        })
    }
    
    if(errorFlag === false){
        // event.currentTarget.send();
        form.submit();
        console.log(event.currentTarget);
    }
    else{
        console.log(event.currentTarget);
    }
}
let form = document.getElementById("submitReg");
form.addEventListener("click", checkRegister);
document.getElementById("login").addEventListener("input", checkLogin)

function checkLogin(e){
    fetch(`../php/check_logins.php?login=${e.currentTarget.value}`)
    .then(r => r.text())
    .then(data => {
        console.log(data)
        if(parseInt(data) === 0){
            document.getElementById("loginError").textContent = "Логин свободен";
            document.getElementById("loginError").animate([
                {transform: 'scale(1)'},
                {transform: 'scale(1.5)'},
                {transform: 'scale(1)'}
            ],{
                duration: 1000
            })   
        }
        else{
            document.getElementById("loginError").textContent = "Такой логин уже есть";
            document.getElementById("loginError").animate([
                {transform: 'scale(1)'},
                {transform: 'scale(1.5)'},
                {transform: 'scale(1)'}
            ],{
                duration: 1000
            })   
        }
    })
}



