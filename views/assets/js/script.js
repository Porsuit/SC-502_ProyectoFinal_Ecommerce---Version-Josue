
// Handle the registration process
document.getElementById("registerBtn").addEventListener("click", function () {
    // Get user input
    
    const username = document.getElementById("username").value.trim();

    if (username) {
        // Store the username in localStorage
        localStorage.setItem('username', username);

        // Replace the user icon with the username, making it non-clickable
        const userIcon = document.getElementById("userIcon");
        userIcon.parentElement.innerHTML = `<span class="nav-link">Bienvenido ${username}</span>`;

        // Close the register modal
        const modal = bootstrap.Modal.getInstance(document.getElementById('registerModal'));
        modal.hide();  // Hides the modal
        window.location.href = "index.html";
    } else {
        alert("Por favor, complete todos los campos.");
    }
    
});

// When the page loads, check if the username is saved in localStorage
window.addEventListener('DOMContentLoaded', function () {
    const storedUsername = localStorage.getItem('username');
    if (storedUsername) {
        // If a username is stored, display it in the nav (non-clickable)
        const userIcon = document.getElementById("userIcon");
        userIcon.parentElement.innerHTML = `<span class="nav-link" style="font-weight: bold; font-family: 'Cursive'; font-size: 20px;">Bienvenido ${storedUsername}</span>`;

        // Make the profile icon open the logout modal instead of register modal
        const profileLink = document.querySelector('#1234');
        
        // Trigger logout modal when the icon is clicked
        profileLink.addEventListener('click', function (e) {
            e.preventDefault();  // Prevent the default action (which would be to open the register modal)
            const logoutModal = new bootstrap.Modal(document.getElementById('logoutModal'));
            logoutModal.show(); // Manually show the logout modal
        });
    }
});



