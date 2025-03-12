document.addEventListener("DOMContentLoaded", function () {
    // Gumawa ng modal dynamically
    let modal = document.createElement("div");
    modal.id = "screenshotModal";
    modal.className = "custom-modal";
    modal.style.display = "none";

    modal.innerHTML = `
        <div class="custom-modal-content" style="width: 400px; max-width: 90%; padding: 40px;">
            <h2 style="color: red; margin-bottom: 10px;">Warning!</h2>
            <p>Taking screenshots is not allowed on this page.</p>
            <button id="closeScreenshotBtn" style="background: green; color: white; border: none; padding: 10px 20px; cursor: pointer; border-radius: 5px; margin-top: 10px;">OK</button>
        </div>
    `;

    document.body.appendChild(modal);

    // Event listeners
    document.addEventListener("keyup", function (e) {
        if (e.key === "PrintScreen") {
            navigator.clipboard.writeText(""); // Clear clipboard
            showScreenshotWarning();
        }
    });

    document.getElementById("closeScreenshotBtn").addEventListener("click", closeScreenshotModal);
});

// Functions
function showScreenshotWarning() {
    document.getElementById("screenshotModal").style.display = "flex";
}

function closeScreenshotModal() {
    document.getElementById("screenshotModal").style.display = "none";
}
