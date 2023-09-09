// Function to validate the form

function validateSignupForm() {
    // Retrieve form input values
    var name = document.getElementById('name').value;
    var username = document.getElementById('username').value;
    var email = document.getElementById('email').value;
    var phone = document.getElementById('phone').value;
    var password = document.getElementById('password').value;
    var password2 = document.getElementById('password2').value;
    var address = document.getElementById('address').value;
    var checkbox = document.getElementById("terms");


    // Regular expressions for validation
    var nameRegex = /^[a-zA-Z\s]+$/;
    var usernameRegex = /^[a-zA-Z][a-zA-Z0-9]*$/;
    var emailRegex = /^[\w-]+(\.[\w-]+)*@([\w-]+\.)+[a-zA-Z]{2,7}$/;
    var phoneRegex = /^\d{1,70}$/;
    var passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[#$@!%&*?])[A-Za-z\d#$@!%&*?]{8,30}$/;
    // Perform individual validations and show error messages
    if (!checkbox.checked) {
       alert('You have to agree with terms and conditions');
       return false;
    }
    if (!nameRegex.test(name)) {
      alert('Invalid name. Please enter a name without special characters.');
      return false;
    }

    if (!usernameRegex.test(username)) {
      alert('Invalid username. It must start with a letter and can contain only letters and numbers.');
      return false;
    }

    if (!emailRegex.test(email) || email.length > 70) {
      alert('Invalid email. Email should be a valid address and cannot exceed 70 characters.');
      return false;
    }

    if (!phoneRegex.test(phone) || phone.length > 70) {
      alert('Invalid phone number. Phone number should only contain digits and cannot exceed 70 characters.');
      return false;
    }

    if (!passwordRegex.test(password)) {
      alert('Invalid password. Password should contain at least 8 characters, including one uppercase letter, one lowercase letter, one number, and one special character.');
      return false;
    }

    if (password !== password2) {
      alert('Passwords do not match...');
      return false;
    }

    if (address.length > 128) {
      alert('Address exceeds the maximum length of 128 characters.');
      return false;
    }

    // If all validations pass, the form is valid
    return true;
  }
  var form = document.getElementById('signupForm');
  form.onsubmit = validateSignupForm;