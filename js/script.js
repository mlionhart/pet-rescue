// function to show/hide password
function showPassword() {
    const passwordField = document.querySelector('#password')
    const showPassword = document.querySelector('#showPassword')

    if (showPassword.innerText == 'Show Password') {
        showPassword.innerText = 'Hide Password'
        passwordField.type = 'text'
    } else if (showPassword.innerText === 'Hide Password') {
        passwordField.type = 'password'
        showPassword.innerText = 'Show Password'
    }
}

// is the user logged in or not?
// fetch is a way in js to execute code behind the scenes of the browser
fetch('helper/is_logged_in.php')
    // once you receive a response, convert response to json
    .then(res => res.json())
    // then call anonymous function with that data you received
    .then(function (res) {
        // if value of status property that came back is yes
        if (res.status == 'yes') {
            // hide login button
            const login = document.querySelector('#login')
            login.style.display = 'none'
            // hide register button
            // const register = document.querySelector('#register')
            // register.style.display = 'none'
            // show logout button
            const logout = document.querySelector('#logout')
            logout.style.display = 'inline-block'

            // add event listener to logout button
            logout.addEventListener('click', function (e) {
                // prevent link from going where it normally goes
                e.preventDefault()
                // use fetch again to get info from logout_ajax.php
                fetch('helper/logout_ajax.php')
                    // once you receive a response, convert to json
                    .then(res => res.json())
                    .then(function (res) {
                        // if value of status property in logout_ajax.php is success
                        if (res.status == 'success') {
                            // show login button
                            login.style.display = 'inline-block'
                            // // show register button
                            // register.style.display = 'inline-block'
                            // hide logout button
                            logout.style.display = 'none'
                            // add a message to the message div that user has been logged out
                            // document.querySelector('#message').innerHTML = '<p>You have been logged out</p>'
                            // add welcome message to h1
                            // document.querySelector('h1').innerText = 'Welcome to our Site!'
                            document.location.href = 'home.php?message=You%20Have%20Been%20Logged%20Out'
                        }
                    })
            })
        } else {
            document.querySelector('#login').style.display = 'inline-block';
            document.querySelector('#logout').style.display = 'none';
        }
    })