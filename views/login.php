<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../../assets/ico/favicon.png">

    <title>Login</title>

    <!-- Bootstrap core CSS -->
    <link href="/ppmasilex/css/bootstrap.min.css" rel="stylesheet">
    <link href="/ppmasilex/css/login.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="/ppmasilex/js/html5shiv.js"></script>
    <script src="/ppmasilex/js/respond.min.js"></script>
    <![endif]-->
</head>

<body>

<script src="/ppmasilex/js/jquery-1.10.2.min.js"></script>
<script src="/ppmasilex/js/handlebars-1.0.0.js"></script>
<script src="/ppmasilex/js/ember.js"></script>
<script src="/ppmasilex/js/ember-data.js"></script>
<script src="/ppmasilex/js/app.js"></script>

<script type="text/x-handlebars" data-template-name="login">
    <div class="container">

        <div class="col-lg-4 col-lg-offset-4">
            <form class="form-signin">
                    <input type="text" class="form-control" placeholder="Username" autofocus="autofocus">
                    <input type="password" class="form-control" placeholder="Password">
                <button {{action 'login'}} class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
            </form>
        </div>

    </div>
</script>


</body>
</html>
