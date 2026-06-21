document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".password-toggle").forEach(function (button) {
        var input = button
            .closest(".relative")
            ?.querySelector('input[type="password"], input[type="text"]');
        if (!input) {
            return;
        }
        button.addEventListener("click", function () {
            if (input.type === "password") {
                input.type = "text";
                button.textContent = "visibility_off";
            } else {
                input.type = "password";
                button.textContent = "visibility";
            }
        });
    });
});
