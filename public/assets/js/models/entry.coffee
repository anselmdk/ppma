define ['can'], (can) ->
  can.Model
    findAll: 'GET api/v1/entries'
    findOne: 'GET api/v1/entries/{id}'
    create:  'POST api/v1/entries'
    update:  'PUT api/v1/entries/{id}'
    destroy: 'DELETE api/v1/entries/{id}'
  , {}