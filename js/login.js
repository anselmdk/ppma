// app
window.App = Ember.Application.create();


// routes
App.Router.map(function () {
    this.route('login',    { path: '/' });
});

// controller
App.LoginController = Ember.Controller.extend({

    do: function() {
        this.set('isSubmitted', true);

        $.post(null, {
            username: this.get('username'),
            password: this.get('password')
        }, $.proxy(function(data) {
            this.set('isSubmitted', false);

            // set response
            this.set('loginFailed', data.error);
            this.set('message', data.message);

            // redirect user is login successfully
            if (!data.error) {
                window.location.href = data.forwardTo;
            }
        }, this));
    }

});