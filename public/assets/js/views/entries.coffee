define [
  'backbone'
  'handlebars'
  'collections/entries'
  'views/entry'
  'text!/assets/js/templates/entries/index.hbs'
], (Backbone, Handlebars, EntryCollection, EntryView, template) ->

  return Backbone.View.extend(

    initialize: ->
      # compile template
      @template = Handlebars.compile template

      # render
      @render()

      # create collection
      @entries = new EntryCollection();

      # listen to collection
      @listenTo @entries, 'add', @addEntry

      # fetch collection
      @entries.fetch()

    render: ->
      # add template to dom
      @$el.html @template()

      # save table and "no entry"-placeholder
      @table = @$el.find 'table'
      @placeholder = @$el.find '.no-entries'

      # hide table
      @table.hide()

    addEntry: (model) ->
      # create view for entry
      entry = new EntryView(
        model: model
        el: @table.find 'tbody'
      )

      # render entry
      entry.render()

      # show table
      @table.show()
      @placeholder.hide()

  )
