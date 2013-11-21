// app
window.App = Ember.Application.create();


// routes
App.Router.map(function () {
    this.route('login',    { path: '/' });
});

// controller
App.LoginController = Ember.Controller.extend({

    do: function() {
        var view = Ember.View.create({
            templateName: 'login'
        });

        $(view.element).find('.form').addClass('loading');

        //$('#login').find('.form').addClass('loading');

        $.post(null, {
            username: this.get('username'),
            password: this.get('password')
        }, $.proxy(function(data) {
            // redirect user is login successfully
            if (!data.error) {
                location.reload();
            }
            else {
                $('#login .form').removeClass('loading');
                this.set('loginFailed', true);
                this.set('message', data.message);
            }
        }, this));
    }

});