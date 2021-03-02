$(document).ready(function () {
    $("#form ").validate({
        rules: {
            "username": {
                required: true,
                minlength: 5
            },
            "email": {
                required: true,
                email: true
            },
            "firstname": {
                required: true,
            },
            "pwd": {
                required: true,
                minlength: 5

            },
            "confirm_password": {
                required: true,
                equalTo: "#pwd",
                minlength: 5
            }
        },
        messages: {
            "username": {
                required: "Please, enter a name"
            },
            "email": {
                required: "Please, enter an email",
                email: "Email is invalid"
            },
            "firstname": {
                required: "Please, enter a firstname",
               
            },
            "pwd": {
                required: "Please, enter a password",
            },
            "confirm_password": {
                required: "Please provide a password",
                equalTo: "Please enter the same password as above"
            }

        },
        
    });

});