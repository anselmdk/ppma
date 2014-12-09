define [
  'backbone',
  'mustache',
  'views/entries'
  'text!/assets/js/templates/app.mustache'
], (Backbone, Mustache, Entries, template) ->

  return Backbone.View.extend(

    el: 'body'

    initialize: ->
      @render()

    render: ->
      @$el.html Mustache.render(template)
      @entries = new Entries(el: @$el.find '#content')
      @entries.render()

  )
