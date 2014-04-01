require.config({
    baseUrl: 'assets/js',
    paths: {
        jquery: '../../bower_components/jquery/dist/jquery.min',
        semantic: '../../bower_components/semantic-ui/build/packaged/javascript/semantic.min',
        can: '../../bower_components/canjs/amd/can'
    }
});


require(['jquery', 'can', 'semantic', 'components/entries'], function($, can) {
    var view = can.view('templates/app', {});
    $('body').html(view).hide().fadeIn();
});