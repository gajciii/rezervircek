
function checkLoginStatus() {
    const prijavljen = sessionStorage.getItem('prijavljen');
    const prijavljen2 = sessionStorage.getItem('prijavljen2');
    const rezervirajBtn = document.getElementById('rezervirajBtn');
    const loginBtn = document.getElementById('loginBtn');
    const registerBtn = document.getElementById('registerBtn');
    const profilBtn = document.getElementById('profilBtn');
    const profil2Btn = document.getElementById('profil2Btn');
    

    if (prijavljen) {
        loginBtn.remove();
        registerBtn.remove();
        //loginBtn.style.display = 'none';
        //registerBtn.style.display = 'none'; 
        profilBtn.style.display = 'block';
        profil2Btn.style.display = 'none';
    } else if (prijavljen2) {
        loginBtn.remove();
        registerBtn.remove();
        rezervirajBtn.remove();
        //loginBtn.style.display = 'none';
       // registerBtn.style.display = 'none';
        profilBtn.style.display = 'none';
        profil2Btn.style.display = 'block';
    } else {
        rezervirajBtn.style.display = 'none';
        loginBtn.style.display = 'block';
        registerBtn.style.display = 'block';
        profilBtn.style.display = 'none';
        profil2Btn.style.display = 'none';
    }
}

document.addEventListener('DOMContentLoaded', checkLoginStatus);
