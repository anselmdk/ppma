define(['can'], function(can) {

    return can.Model({
        findAll: 'GET api/v1/categories',
        findOne: 'GET api/v1/categories/{slug}',
        create:  'POST api/v1/categories',
        update:  'PUT api/v1/categories/{id}',
        destroy: 'DELETE api/v1/categories/{id}'
    }, {});

});