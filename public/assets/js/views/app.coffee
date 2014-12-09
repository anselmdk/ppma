define [
  'backbone',
  'handlebars',
  'views/entries'
  'views/dashboard'
  'router'
  'text!/assets/js/templates/app.hbs'
], (Backbone, Handlebars, Entries, DashboardView, Router, template) ->

  return Backbone.View.extend(

    el: 'body'

    initialize: ->
      # compile template
      @template = Handlebars.compile template

      # init view
      @views =
        dashboard: new DashboardView()
        entries: new Entries()

      @listenTo Router, 'route:entries', @showEntries
      @listenTo Router, 'route:dashboard', @showDashboard
      @render()

    showEntries: ->
      @content.html @views.entries.$el

    showDashboard: ->
      @content.html @views.dashboard.$el

    render: ->
      # add template to dom
      @$el.html @template()

      @content = @$el.find '#content'

  )
