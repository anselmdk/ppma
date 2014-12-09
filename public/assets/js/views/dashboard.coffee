define [
  'backbone'
  'handlebars'
  'text!/assets/js/templates/dashboard.hbs'
], (Backbone, Handlebars, template) ->

  return Backbone.View.extend(

    initialize: ->
      # compile template
      @template = Handlebars.compile template


    render: ->
      # add template to dom
      @$el.html @template()

  )
