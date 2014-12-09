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

      @listenTo Router, 'route:entries', @renderEntries
      @listenTo Router, 'route:dashboard', @renderDashboard
      @render()


    renderEntries: ->
      @entries = new Entries
        el: @content
      @entries.render()


    renderDashboard: ->
      @dashboard = new DashboardView
        el: @content
      @dashboard.render()


    render: ->
      # add template to dom
      @$el.html @template()

      @content = @$el.find '#content'

  )
