define(['can', 'models/category', 'models/tag'], function (can, Category, Tag) {

    can.Component.extend({
        tag: 'submenu',
        scope: {

            categories: new Category.List({}),

            tags: new Tag.List({}),

            activate: function(ctx, el) {
                el.toggleClass('active');
            }

        },

        template: can.view.render('templates/submenu'),

        events: {
        }
    })

});