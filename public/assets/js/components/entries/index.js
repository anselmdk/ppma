define(['can', 'models/entry'], function (can, Entry) {

    can.Component.extend({

        tag: 'entries-index',

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

        template: can.view.render('templates/entries/index'),

        events: { }

    })

});