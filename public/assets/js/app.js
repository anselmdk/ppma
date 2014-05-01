require.config({
    baseUrl: 'assets/js',
    paths: {
        jquery: '../../bower_components/jquery/dist/jquery.min',
        semantic: '../../bower_components/semantic-ui/build/packaged/javascript/semantic.min',
        can: '../../bower_components/canjs/amd/can'
    }
});


require([
    'jquery',
    'can',
    'controls/categories',
    'semantic',
    'components/submenu',
    'components/entries/index'
], function($, can, Categories) {

    new (can.Control({

        init: function(el) {
            // load app template
            var app = can.view('templates/app', {});

            // append template
            el.html(app).hide();

            // get content el
            var content = el.find('#content');

            // show only entries/index
            content.children().hide();
            content.find('entries-index').show();

            // show app
            el.fadeIn('fast');

            // init controller
            new Categories(content);

            // start routing
            can.route.ready();
        }


    }))('body');

});