<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Gemini | Frontline Activity Tracker and Productivity Management System </title>

    <!-- Bootstrap -->
    <link href="../../components/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../../components/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../../components/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="../../components/vendors/animate.css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../../components/build/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="login">
    <div id="change-page">
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <form method="post" action="check-log.php">
              <h1>Login Form</h1>
              <div>
                <input type="text" name="checkuser" id="checkuser" class="form-control" placeholder="Username" required="" />
              </div>
              <div>
                <input type="password" name="checkpass" id="checkpass" class="form-control" placeholder="Password" required="" />
              </div>
              <div>
                <input type="submit" class="btn btn-primary" value="Log-in">
              </div>
              <div>
                <a class="btn btn-default forgot-pass-link" href="index.html">Forgot password?</a>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
               

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><i class="fa fa-paw"></i> Gemini</h1>
                  <p>©2020 All Rights Reserved. Gemini</p>
                </div>
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>
  </body>
</html>

<script src="check-log.js"></script>

<style>
  .forgot-pass-link:hover
  {
    color: blue;
    cursor: pointer;
  }
</style>
