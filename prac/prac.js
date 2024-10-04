// script.js
document.querySelector('.flip-card__form').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent default form submission
    const isLogin = document.getElementById('toggle').checked;
    
    if (isLogin) {
        alert('Logging in...');
        // Perform login action (e.g., AJAX request)
    } else {
        alert('Signing up...');
        // Perform signup action (e.g., AJAX request)
    }
});
