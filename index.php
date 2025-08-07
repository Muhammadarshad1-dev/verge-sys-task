<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Login | Admin Panel</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Login page for admin">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- AOS -->
  <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">

  <!-- Custom Styles -->
  <style>
    body {
      font-family: 'Nunito', sans-serif;
      background: linear-gradient(135deg, #4e73df, #1cc88a);
      min-height: 100vh;
    }
    .login-card {
      border: none;
      border-radius: 1rem;
      overflow: hidden;
      box-shadow: 0 15px 30px rgba(0,0,0,0.1);
    }
    .bg-login-image {
      background: url('https://source.unsplash.com/600x800/?office,technology') center center;
      background-size: cover;
      position: relative;
    }
    .bg-login-image::after {
      content: '';
      position: absolute;
      top: 0; left: 0;
      width: 100%; height: 100%;
      background: rgba(0, 0, 0, 0.5);
    }
    .image-text {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      color: white;
      text-align: center;
      z-index: 1;
      padding: 20px;
    }
    .image-text h2 {
      font-size: 28px;
      font-weight: 700;
    }
    .image-text p {
      font-size: 16px;
      opacity: 0.9;
    }
    .form-control-login {
      border-radius: 0.375rem;
      box-shadow: none;
      border: 1px solid #ddd;
    }
    .form-control-login:focus {
      border-color: #1cc88a;
      box-shadow: 0 0 0 0.1rem rgba(28, 200, 138, 0.25);
    }
    .loginformbtn {
      font-weight: 600;
      font-size: 16px;
    }
    .alert {
      padding: 10px;
      margin-top: 10px;
      font-size: 14px;
    }
  </style>
</head>

<body>
  <div class="container py-5">
    <div class="row justify-content-center align-items-center min-vh-100">
      <div class="col-lg-10">
        <div class="card login-card" data-aos="zoom-in">
          <div class="row g-0">
            <!-- Left Image Section -->
            <div class="col-lg-6 position-relative d-none d-lg-block bg-login-image">
              <div class="image-text">
                <h2>Welcome Admin</h2>
                <p>Access your dashboard, manage employes</p>
              </div>
            </div>

            <!-- Right Form Section -->
            <div class="col-lg-6 p-5 bg-white">
              <div class="text-center mb-4">
                <h3 class="text-primary fw-bold">Login Portal</h3>
                <p class="text-muted small">Please enter your credentials</p>
              </div>

              <form class="user_login" id="user_login" method="post">
                <div id="login_msg"></div>

                <div class="form-group mb-3">
                  <input type="email" name="email" class="form-control form-control-login" id="email" placeholder="Enter Email Address..." required>
                  <span id="error_email" class="text-danger small"></span>
                </div>

                <div class="form-group mb-3">
                  <input type="password" name="password" class="form-control form-control-login" id="password" placeholder="Password" required>
                  <span id="error_password" class="text-danger small"></span>
                </div>

                <button type="button" id="loginbtn" class="btn btn-primary w-100 loginformbtn">Login</button>
              </form>
              <hr>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- jQuery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
  <!-- Bootstrap Bundle JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <!-- AOS -->
  <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
  <script>AOS.init();</script>

  <!-- Login Logic -->
  <script>
    $(document).ready(function(){
      $('#loginbtn').on('click', function(){
        var email = $('#email').val();
        var password = $('#password').val();
        let valid = true;

        if (!email) {
          $('#error_email').text('Email is required');
          valid = false;
        } else {
          $('#error_email').text('');
        }

        if (!password) {
          $('#error_password').text('Password is required');
          valid = false;
        } else {
          $('#error_password').text('');
        }

        if (valid) {
          $.ajax({
            type: 'POST',
            url: './model/UserLoginModel.php',
            data: $('#user_login').serialize(),
            success: function(data) {
              if (data == 1) {
                window.location = "./view/index.php";
              } else {
                $('#login_msg').html('<div class="alert alert-danger">Email or Password is Incorrect</div>');
              }
            }
          });
        }
      });
    });
  </script>
</body>
</html>
