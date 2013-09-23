// app
window.App = Ember.Application.create();


// routes
App.Router.map(function () {
    this.route('home',    { path: '/' });
    this.route('entries', { path: '/entries' });
});