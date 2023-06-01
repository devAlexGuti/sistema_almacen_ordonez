<!DOCTYPE html>
<html lang="es">
<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Sistema Ordoñez Vue Js- DevelopmentAlex">
  <meta name="author" content="developmentJhoan.com">
  <meta name="keyword" content="Sistema Ordoñez Laravel Vue Js, Sistema compras Laravel Vue Js">

  <title>Industrias Ordoñez</title>


  <link rel="stylesheet" href="http://use.fontawesome.com/releases/v5.0.8/css/solid.css" />
  <script src="http://use.fontawesome.com/releases/v5.0.7/js/all.js"></script>

  <!--glyphicon funciono con estos link-->
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <!--<link href="css/plantilla.css" rel="stylesheet">-->

  <!--ICONO EN LA PESTAÑA-->
  <link rel="shortcut icon" href="img/icono-guty.ico">

  <!--<link href="css/style.css" rel="stylesheet">-->
<style>
  @import url('https://fonts.googleapis.com/css?family=Roboto');

  body{
      font-family: 'Roboto', sans-serif !important;
      /*background: url(img/back.png) no-repeat center center fixed !important;*/
      background-size: cover !important; 
  }
  /*Modificación css sis nando*/
  .login-page, .register-page {
    background: linear-gradient(rgba(0,0,0,1), rgba(0,30,50,1));
  }
  .login-page #back {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100vh;
    background: url(img/black-background.jpg);
    background-size: cover;
    overflow: hidden;
    z-index: -1;
  }
  .login-logo, .register-logo {
    font-size: 35px;
    text-align: center;
    margin-bottom: 25px;
    font-weight: 300;
  }
  .login-box-body, .register-box-body {
    background: #fff;
    padding: 20px;
    border-top: 0;
    color: #666;
  }

  .login-box-msg, .register-box-msg {
    margin: 0;
    text-align: center;
    /*padding: 0 20px 20px 20px;*/
  }
  /*FIN Modificación css sis nando*/

  .was-validated .form-control:valid ~ .invalid-feedback{
    display: block;
  }
  .invalid-feedback{
    display: none;
    margin-top: .25rem;
    font-size: 95%;
    text-align: center;
    color: #f86c6b;
  }
  .inner-addon {
  position: relative;
  }
  .inner-addon .glyphicon {
    position: absolute;
    padding: 10px;
    pointer-events: none;
  }
  .left-addon .glyphicon {
    left: 0px;
  }
  .right-addon .glyphicon {
    right: 0px;
  }
  .left-addon input {
    padding-left: 30px;
  }
  .right-addon input {
    padding-right: 30px;
  }

  .material-half-bg {
    height: 100vh;
    background-color: #e7e7e7;
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    z-index: -1;
  }

  .material-half-bg .cover {
    background-color: #009688;
    height: 50vh;
  }

  .login-content {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-orient: vertical;
    -webkit-box-direction: normal;
        -ms-flex-direction: column;
            flex-direction: column;
    -webkit-box-align: center;
        -ms-flex-align: center;
            align-items: center;
    -webkit-box-pack: center;
        -ms-flex-pack: center;
            justify-content: center;
    min-height: 100vh;
  }

  .login-content .logo {
    margin-bottom: 40px;
    font-family: "Niconne";
    color: #fff;
  }

  .login-content .logo h1 {
    font-size: 52px;
    font-weight: 400;
  }


  .login-content .login-box {
    width:360px;
    position: relative;
    min-width: 350px;
    min-height: 390px;
    /*background-color: #fff;*/
    -webkit-box-shadow: 0px 29px 147.5px 102.5px rgba(0, 0, 0, 0.05), 0px 29px 95px 0px rgba(0, 0, 0, 0.16);
            box-shadow: 0px 29px 147.5px 102.5px rgba(0, 0, 0, 0.05), 0px 29px 95px 0px rgba(0, 0, 0, 0.16);
    -webkit-perspective: 800px;
            perspective: 800px;
    -webkit-transition: all 0.5s ease-in-out;
    -o-transition: all 0.5s ease-in-out;
    transition: all 0.5s ease-in-out;
  }

  .login-content .login-box .login-head {
    margin-top: 0;
    margin-bottom: 15px;
    padding-bottom: 15px;
    border-bottom: 1px solid #ddd;
    text-align: center;
  }

  .login-content .login-box label {
    color: #666;
    font-weight: 700;
  }

  .login-content .login-box .utility {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    padding: 1px;
    -webkit-box-pack: justify;
        -ms-flex-pack: justify;
            justify-content: space-between;
    -webkit-box-align: center;
        -ms-flex-align: center;
            align-items: center;
  }

  .login-content .login-box .btn-container {
    margin-bottom: 0;
  }

  .login-content .login-box .login-form, .login-content .login-box .forget-form {
    position: absolute;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    padding: 15px 40px;
    backface-visibility: hidden;
    -webkit-backface-visibility: hidden;
    -webkit-transition: all 0.5s ease-in-out;
    -o-transition: all 0.5s ease-in-out;
    transition: all 0.5s ease-in-out;
  }

  .login-content .login-box .forget-form {
    opacity: 0;
    -webkit-transform: rotateY(180deg);
            transform: rotateY(180deg);
  }

  .login-content .login-box.flipped {
    min-height: 400px;
  }

  .login-content .login-box.flipped .login-form {
    opacity: 0;
    -webkit-transform: rotateY(-180deg);
            transform: rotateY(-180deg);
  }

  .login-content .login-box.flipped .forget-form {
    opacity: 1;
    -webkit-transform: rotateY(0deg);
            transform: rotateY(0deg);
  }

  @media (max-width: 351px) {
    .login-content .login-box {
      min-width: 100%;
    }
    .login-content .login-box .login-form, .login-content .login-box .forget-form {
      width: 100%;
    }
  }
</style>
    

</head>

<body class="login-page">
  <div id="back"></div>
  <div class="container">
    @yield('login')
  </div>

  <!-- Bootstrap and necessary plugins -->
  <script src="js/plantilla.js"></script>
</body>
</html>
<style>
</style>