define(['can', 'models/entry'], function (can, Entry) {

    can.Component.extend({
        tag: 'entry-list',
        scope: {

            models: new Entry.List({}),

            edit: function(ctx) {
                alert('will implement')
            },

            delete: function(ctx) {
                $('#entry-delete-modal').modal('setting', {
                    onApprove: function() {
                        ctx.destroy();
                    }
                }).modal('show');
            }
        },
        template: can.view.render('templates/entry-list'),
        helpers: {
            isVisible: function (options) {
                return this.attr("visible") ?
                    options.fn() : options.inverse();
            }
        },
        events: {
            "inserted": function () {
                console.log("you add a my-element to the page")
            }
        }
    })

});