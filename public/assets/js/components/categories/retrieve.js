define(['can', 'models/category', 'models/entry'], function (can, Category, Entry) {

    can.Component.extend({

        tag: 'categories-retrieve',

        scope: {

            category: null

        },

        template: can.view.render('templates/categories/retrieve'),

        events: {

            'categories/:slug route': function(data) {
                console.log('load category: ' + data.slug);
                var self = this;

                Category.findOne({ slug: data.slug }, function(model) {
                    self.scope.attr('category', model);
                });
            }
        }

    })

});