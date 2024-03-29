<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.2.1/axios.min.js"></script>
        <title>Laravel</title>

        <!--style from the template-->
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700;900&display=swap');

            *, body {
                font-family: 'Poppins', sans-serif;
                font-weight: 400;
                -webkit-font-smoothing: antialiased;
                text-rendering: optimizeLegibility;
                -moz-osx-font-smoothing: grayscale;
            }

            html, body {
                height: 100%;
                background-color: #152733;
                overflow: hidden;
            }


            .form-holder {
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                text-align: center;
                min-height: 100vh;
            }

            .form-holder .form-content {
                position: relative;
                text-align: center;
                display: -webkit-box;
                display: -moz-box;
                display: -ms-flexbox;
                display: -webkit-flex;
                display: flex;
                -webkit-justify-content: center;
                justify-content: center;
                -webkit-align-items: center;
                align-items: center;
                padding: 60px;
            }

            .form-content .form-items {
                border: 3px solid #fff;
                padding: 40px;
                display: inline-block;
                width: 100%;
                min-width: 540px;
                -webkit-border-radius: 10px;
                -moz-border-radius: 10px;
                border-radius: 10px;
                text-align: left;
                -webkit-transition: all 0.4s ease;
                transition: all 0.4s ease;
            }

            .form-content h3 {
                color: #fff;
                text-align: left;
                font-size: 28px;
                font-weight: 600;
                margin-bottom: 5px;
            }

            .form-content h3.form-title {
                margin-bottom: 30px;
            }

            .form-content p {
                color: #fff;
                text-align: left;
                font-size: 17px;
                font-weight: 300;
                line-height: 20px;
                margin-bottom: 30px;
            }


            .form-content label, .was-validated .form-check-input:invalid~.form-check-label, .was-validated .form-check-input:valid~.form-check-label{
                color: #fff;
            }

            .form-content input[type=text], .form-content input[type=password], .form-content input[type=email], .form-content select {
                width: 100%;
                padding: 9px 20px;
                text-align: left;
                border: 0;
                outline: 0;
                border-radius: 6px;
                background-color: #fff;
                font-size: 15px;
                font-weight: 300;
                color: #8D8D8D;
                -webkit-transition: all 0.3s ease;
                transition: all 0.3s ease;
                margin-top: 16px;
            }


            .btn-primary{
                background-color: #6C757D;
                outline: none;
                border: 0px;
                box-shadow: none;
            }

            .btn-primary:hover, .btn-primary:focus, .btn-primary:active{
                background-color: #495056;
                outline: none !important;
                border: none !important;
                box-shadow: none;
            }

            .form-content textarea {
                position: static !important;
                width: 100%;
                padding: 8px 20px;
                border-radius: 6px;
                text-align: left;
                background-color: #fff;
                border: 0;
                font-size: 15px;
                font-weight: 300;
                color: #8D8D8D;
                outline: none;
                resize: none;
                height: 120px;
                -webkit-transition: none;
                transition: none;
                margin-bottom: 14px;
            }

            .form-content textarea:hover, .form-content textarea:focus {
                border: 0;
                background-color: #ebeff8;
                color: #8D8D8D;
            }

            .mv-up{
                margin-top: -9px !important;
                margin-bottom: 8px !important;
            }

            .invalid-feedback{
                color: #ff606e;
            }

            .valid-feedback{
            color: #2acc80;
            }
        </style>

    </head>
    <body>
        <div class="form-body">
            <div class="row">
                <div class="form-holder">
                    <div class="form-content">
                        <div class="form-items">
                            <h3>Register Today</h3>
                            <p>Fill in the data below.</p>
                            <form class="requires-validation" method="POST" id="form">
                                @csrf
                                <div class="col-md-12">
                                <input class="form-control"  id="name" type="text" name="name" placeholder="Full Name" required>
                                </div>

                                <div class="col-md-12">
                                    <input class="form-control" id="email" type="email" name="email" placeholder="E-mail Address" required>
                                </div>

                                <div class="col-md-12">
                                    <input class="form-control" id="password" type="password" name="password" placeholder="Password" required>
                                </div>

                                <div class="col-md-12">
                                    <input class="form-control" id="password-confirm" type="password" name="password_confirmation" placeholder="password_confirmation" required autocomplete="new-password">
                                </div>

                                <div class="col-md-12 mt-3">
                                    <input class="form-control" id="customFile" type="file" name="avatar" placeholder="select image" >
                                </div>

                                <div class="form-button mt-3">
                                    <button id="submit" type="submit" class="btn btn-primary">Register</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            const form = document.getElementById("form");
            form.addEventListener("submit", (e) => {
                e.preventDefault();
                const formData = new FormData(form);
                axios
                .post("http://localhost:8000/api/v1/register", formData, {
                    headers: {
                    "Content-Type": "multipart/form-data",
                    },
                })
                .then((res) => {
                    console.log(res);
                })
                .catch((err) => {
                    console.log(err);
                });
            });

        </script>
    </body>
</html>
