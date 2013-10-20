// app
window.App = Ember.Application.create();


// routes
App.Router.map(function () {
    this.resource('home',    { path: '/' });
    this.resource('entries', { path: '/entries' });
    this.resource('logout',  { path: '/logout' });
});


App.ApplicationRoute = Ember.Route.extend({

    actions: {
        logout: function() {
            $.get($('#urls .logout').val())
                .then(function() {
                    location.reload();
                });
        }
    }

});