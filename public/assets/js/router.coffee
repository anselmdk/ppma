define [
  'backbone',
], (Backbone) ->

  Router = Backbone.Router.extend(

    routes:
      "dashboard": "dashboard"
      "entries": "entries"

  )

  new Router()