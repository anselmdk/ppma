<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <title>Login</title>

    <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700|Open+Sans:300italic,400,300,700' rel='stylesheet' type='text/css'>
    <link href="<?php echo site() ?>css/semantic.min.css" rel="stylesheet">
    <link href="<?php echo site() ?>css/login.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="<?php echo site() ?>js/html5shiv.js"></script>
    <script src="<?php echo site() ?>js/respond.min.js"></script>
    <![endif]-->
</head>

<body>


<script src="<?php echo site() ?>js/jquery-1.10.2.min.js"></script>
<script src="<?php echo site() ?>js/semantic.min.js"></script>
<script src="<?php echo site() ?>js/handlebars-1.0.0.js"></script>
<script src="<?php echo site() ?>js/ember.js"></script>
<script src="<?php echo site() ?>js/ember-data.js"></script>
<script src="<?php echo site() ?>js/login.js"></script>


<script type="text/x-handlebars" id="login">
    <div class="ui page">
        <div class="ui three column grid">
            <div class="column"></div>
            <div class="column">
                <div class="ui error form segment">
                    {{#if loginFailed}}
                        <div class="ui error message">
                            <div class="header">Error</div>
                            <p>{{message}}</p>
                        </div>
                    {{/if}}

                    <div class="field">
                        {{input value=username type="text" placeholder="Username"}}
                    </div>
                    <div class="field">
                        {{input value=password type="password" placeholder="Password"}}
                    </div>
                    <div class="fluid ui right labeled  submit icon button" {{action 'do'}}>
                        <i class="sign in icon"></i>
                        Login
                    </div>
                </div>

            </div>
        </div>
    </div>
</script>


</body>
</html>
