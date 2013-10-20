<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Login</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo site() ?>css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo site() ?>css/login.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="<?php echo site() ?>js/html5shiv.js"></script>
    <script src="<?php echo site() ?>js/respond.min.js"></script>
    <![endif]-->
</head>

<body>


<script src="<?php echo site() ?>js/jquery-1.10.2.min.js"></script>
<script src="<?php echo site() ?>js/handlebars-1.0.0.js"></script>
<script src="<?php echo site() ?>js/ember.js"></script>
<script src="<?php echo site() ?>js/ember-data.js"></script>
<script src="<?php echo site() ?>js/login.js"></script>

<script type="text/x-handlebars" data-template-name="login">
    <div class="container">

        <div class="col-lg-4 col-lg-offset-4">
            <form class="form-signin">
                {{#if loginFailed}}
                    <div class="alert alert-danger">{{message}}</div>
                {{/if}}

                {{input value=username type="text" classNames="form-control" placeholder="Username" disabled=isSubmitted}}
                {{input value=password type="password" classNames="form-control" placeholder="Password" disabled=isSubmitted}}
                <button {{action 'do'}} class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
            </form>
        </div>

    </div>
</script>


</body>
</html>
