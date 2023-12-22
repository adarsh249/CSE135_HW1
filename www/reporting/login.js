const loginForm = document.getElementById("login")

loginForm.onsubmit = async (e) => {
    e.preventDefault();

    var usernameOrEmail = document.getElementById("email").value;
    var password = document.getElementById("password").value;
    var error = document.getElementById("error-text");
    requestBody = {
        usernameOrEmail,
        password
    }
    const res = await fetch("https://reporting.cse151group111.online/user/login",{
        method: 'POST',
        headers:{
            "Content-Type":'application/json'
        },
        body: JSON.stringify(requestBody)
    }).then(response => {
        response.json().then(data => {
            if(response.status != 200){
                error.innerHTML = data.msg;
            } else {
                if(data.admin) {
                    sessionStorage.removeItem('auth-token');
                    sessionStorage.setItem('admin-token', data.token);
                    window.location.href = "./protected/dashboard.html";
                }
                else {
                    sessionStorage.removeItem('admin-token');
                    sessionStorage.setItem('auth-token', data.token);
                    window.location.href = "./protected/dashboard.html";
                }
                
            }
        })
    }).catch(error =>{
        console.log(error);
    });

}