// app
window.App = Ember.Application.create();


// routes
App.Router.map(function () {
    this.route('home',    { path: '/' });
    this.route('entries', { path: '/entries' });
    this.route('logout',  { path: '/logout' });
});

App.EntriesRoute = Ember.Route.extend({


});

App.EntriesController = Ember.Controller.extend({

    bla: function() {
        alert('yo');
    }

});