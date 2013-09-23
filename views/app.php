
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../../assets/ico/favicon.png">
    <title>ppma // any title</title>
    <link href="/ppmasilex/css/bootstrap.min.css" rel="stylesheet">
    <link href="/ppmasilex/css/app.css" rel="stylesheet">
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

<!-- Fixed navbar -->
<script type="text/x-handlebars">

    <div class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                {{#link-to 'home' classNames='navbar-brand'}}ppma{{/link-to}}
            </div>
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li class="active dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown">Entries <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li>{{#link-to 'entries'}}List{{/link-to}}</li>
                            <li>{{#link-to 'entries'}}Create{{/link-to}}</li>
                        </ul>
                    </li>
                    <li><a href="#about">About</a></li>
                    <li><a href="#contact">Contact</a></li>
                </ul>
                <form class="navbar-form navbar-right">
                    <div class="form-group">
                        <input type="search" placeholder="Search" class="form-control">
                    </div>
                </form>
            </div><!--/.nav-collapse -->
        </div>
    </div>

    <div class="container">

        <div class="container">

            <section class="row">
                <div class="col-lg-10">
                    {{outlet}}
                </div>
            </section>

        </div>

    </div> <!-- /container -->

</script>

<script type="text/x-handlerbars" data-template-name="entries">
    entries
</script>


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="/ppmasilex/js/jquery.js"></script>
<script src="/ppmasilex/js/bootstrap.min.js"></script>
</body>
</html>
