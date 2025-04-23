const container = document.getElementById('container');
const registerBtn = document.getElementById('register');
const loginBtn = document.getElementById('login');

registerBtn.addEventListener('click', () => {
    container.classList.add("active");
});

loginBtn.addEventListener('click', () => {
    container.classList.remove("active");
});

window.addEventListener('DOMContentLoaded', () => {
  const urlParams = new URLSearchParams(window.location.search);
  if (urlParams.get('login') === 'success') {
    alert("Thank you for logging in. You will receive the details via email.");
    // Optional: remove the query string
    window.history.replaceState({}, document.title, "home_index.html");
  }
});
