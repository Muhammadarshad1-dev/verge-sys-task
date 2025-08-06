
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">
<title>Login</title>
<!-- Custom fonts for this template-->
<link href="/assets/css/aos.css" rel="stylesheet" type="text/css">

<link
href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
rel="stylesheet">
<!-- Custom styles for this template-->
 <link href="./assets/css/bootstrap.css" rel="stylesheet">
 <link href="./assets/css/main.css" rel="stylesheet">
 <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
 <link rel="stylesheet" href="./assets/css/bootstrap.min.css.map">
 <style>
  .alert{
    height: 45px; 
    padding: 10px;
  }
 </style>
</head>
<body class="bg-gradient-primary">
<div class="container">
<!-- Outer Row -->
<div class="row justify-content-center">
<div class="col-xl-10 col-lg-12 col-md-9">
<div class="card o-hidden border-0 shadow-lg my-5">
<div class="card-body p-0">
<!-- Nested Row within Card Body -->
<div class="row">
<div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
<div class="col-lg-6">
<div class="p-5">
<div class="text-center">
<h1 class="h4 text-gray-900 mb-4">Login Portal</h1>
</div>

<form class="user_login" id="user_login" method="post">
<div id="login_msg"></div>

<div class="form-group">
<input type="email" name="email" class="form-control form-control-login"
id="email" aria-describedby="emailHelp"
placeholder="Enter Email Address..." required/>
<span id="error_email"></span>
</div></br>

<div class="form-group">
<input type="password" name="password" class="form-control form-control-login"
id="password" placeholder="Password" required>
<span id="error_password"></span>
</div></br>

<div class="form-group">
<div class="custom-control custom-checkbox small">
<input type="checkbox" class="custom-control-input" id="customCheck">
<label class="custom-control-label" for="customCheck" style="font-size: 15px;">Remember
Me</label>
</div>
</div></br>

<button type="button" id="loginbtn" class="btn btn-primary btn-user btn-block loginformbtn">Login</button>
<hr>
</form>
<hr>

<div class="text-center">
<a class="small" href="#">Forgot Password?</a>
</div>

<div class="text-center">
<a class="small" href="./register.php">Create an Account!</a>
</div>

</div>
</div>
</div>
</div>
</div>

</div>
</div>
</div>

<!-- Bootstrap core JavaScript-->
</body>
</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>


<script>
    $(document).ready(function(){
        $(document).on('click','#loginbtn','#user_login',function(){
         var email=$('#email').val();
         var password=$('#password').val();

        if(email ==false )
          {
            $('#error_email').html('<span class="text-danger">Email is required</span>');
          }else{
            $('#error_email').hide();
          }

         if (password ==false) 
          {
           $('#error_password').html('<span class="text-danger">Password is required</span>');
          }else{
            $('#error_password').hide();
          }


       if (email !='' && password !='')
          {
             $.ajax({
                 type:'post',
                 url:'./model/UserLoginModel.php',
                 data:$('.user_login').serialize(),
                 success:function(data)
                 {
                    if (data ==1)
                    {
                        window.location = "./view/index.php";
                    }else{
                        $('#login_msg').html('<div class="alert alert-danger">Email or Password is Incorrect</div>');
                    }   
                 }
             });
           }
        });
    });
</script>
