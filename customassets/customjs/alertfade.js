 document.addEventListener("DOMContentLoaded", function() {
        const alert = document.querySelector('.alert-container .alert');
        if (alert) {
            setTimeout(() => {
                alert.style.opacity = '0'; // Fade out
                setTimeout(() => {
                    alert.parentNode.removeChild(alert); // Remove from DOM after fade out
                }, 500); // Match the duration of the fade out transition
            }, 3000); // Alert stays for 3 seconds
        }    });
