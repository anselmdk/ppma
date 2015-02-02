define [
  'backbone'
  'models/entry'
], (Backbone, Entry) ->

  return Backbone.Collection.extend(

    model: Entry

    url: '/entries'

  )
