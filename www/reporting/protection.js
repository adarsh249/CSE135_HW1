window.addEventListener('load', () => {
    if(sessionStorage.getItem('admin-token') === null && sessionStorage.getItem('auth-token') === null){
        // change display of all content to none and cbackground-color: #242130;
        document.body.style.display = 'none';
        document.body.style.backgroundColor = '#242130';
        console.log('hi')
        // Show a popup message
        alert('Please log in to access this page');
        // Redirect to the login page
        window.location.href = '../login.html';
        return;
    }

    const protectedContent = document.getElementById('protectedContent');
    protectedContent.style.display = 'block';

    if (sessionStorage.getItem('admin-token') !== null) {
        // Code for admin access
        // Show the protected content
    } else if (sessionStorage.getItem('auth-token') !== null) {
        // Code for authenticated user access
        // Show the protected content
    } else {
        // Redirect to the login page
        window.location.href = '../login.html';
    }
});