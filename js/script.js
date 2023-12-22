let userBox = document.querySelector('.header .flex .account-box');

document.querySelector('#user-btn').onclick = () => {
	userBox.classList.toggle('active');
	navbar.classList.remove('active');
};

let navbar = document.querySelector('.header .flex .navbar');

document.querySelector('#menu-btn').onclick = () => {
	navbar.classList.toggle('active');
	userBox.classList.remove('active');
};

window.onscroll = () => {
	userBox.classList.remove('active');
	navbar.classList.remove('active');
};

function validate() {
	var email = document.forms[0]['email'].value;
	var password = document.forms[0]['pass'].value;

	if (email.trim() === '' || password.trim() === '') {
		alert('Please enter both email and password.');
		return false;
	}
	return true;
}

function validateForm() {
	var name = document.forms[0]['name'].value.trim();
	var email = document.forms[0]['email'].value.trim();
	var password = document.forms[0]['pass'].value.trim();
	var confirmPassword = document.forms[0]['cpass'].value.trim();

	if (
		name === '' ||
		email === '' ||
		password === '' ||
		confirmPassword === ''
	) {
		alert('Please fill in all fields.');
		return false; 
	}


	return true;
}

function showAlert() {
	alert('Please login first.');
}
