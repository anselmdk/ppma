define [
  'backbone'
  'handlebars'
  'collections/entries'
  'views/entry'
  'text!/assets/js/templates/entries/index.hbs'
], (Backbone, Handlebars, Entries, EntryView, template) ->

  return Backbone.View.extend(

    initialize: ->
      # compile template
      @template = Handlebars.compile template

      # create collection
      @entries = new Entries();

      # listen to collection
      @listenTo @entries, 'add', @addEntry

      # fetch collection
      @entries.fetch()


    getTable: ->
      @$el.find 'table'


    getPlaceholer: ->
      @$el.find '.no-entries'


    render: ->
      # render template
      html = @template()

      # add to dom
      @$el.html html

      # hide table
      @getTable().hide()


    addEntry: (model) ->
      # create view for entry
      entry = new EntryView(
        model: model
        el: @getTable().find 'tbody'
      )

      # render entry
      entry.render()

      # show table
      @getTable().show()
      @getPlaceholer().hide()

  )
