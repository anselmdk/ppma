define([
    'can',
    'components/categories/retrieve'
], function(can) {

    return can.Control({

        'categories/:slug route': function() {
            console.log('set <categories-retrieve />')
            this.element.html( can.view.mustache('<categories-retrieve />') );
        }

    });

});