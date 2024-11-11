

const forms = document.querySelector(".forms"),
      pwShowHide = document.querySelectorAll(".eye-icon"),
      links = document.querySelectorAll(".link");

pwShowHide.forEach(eyeIcon => {
    eyeIcon.addEventListener("click", () => {
        let pwFields = eyeIcon.parentElement.parentElement.querySelectorAll(".password");
        pwFields.forEach(password => {
            if (password.type === "password") {
                password.type = "text";
                eyeIcon.classList.replace("bx-hide", "bx-show");
            } else {
                password.type = "password";
                eyeIcon.classList.replace("bx-show", "bx-hide");
            }
        });
    });
});

// Adjust the links event listener to handle both Login and Signup toggling
// links.forEach(link => {
//     link.addEventListener("click", e => {
//         e.preventDefault(); // Prevent the default anchor behavior
//         forms.classList.toggle("show-login"); // Toggle to show the login form
//     });
// });
