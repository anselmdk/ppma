define [
  'backbone',
  'handlebars'
  'text!/assets/js/templates/entries/row.hbs'
], (Backbone, Handlebars, template) ->

  Backbone.View.extend(

    initialize: ->
      # compile templates
      @template =  Handlebars.compile template

    render: ->
      # render template
      html = @template @model.toJSON()

      # add to dome
      @$el.append html

  )