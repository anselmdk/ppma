define ['can'], (can) ->
  can.Model
    findAll: 'GET api/v1/tags',
    findOne: 'GET api/v1/tags/{id}',
    create:  'POST api/v1/tags',
    update:  'PUT api/v1/tags/{id}',
    destroy: 'DELETE api/v1/tags/{id}'
  , {}