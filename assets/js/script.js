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
      // Show alert
      alert("Thank you for logging in. You will receive the details via email.");

      // Clean up URL
      window.history.replaceState({}, document.title, window.location.pathname);
  }
});
