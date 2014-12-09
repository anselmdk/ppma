define [
  'backbone'
  'router'
], (Backbone, Router) ->

  return Backbone.View.extend(

    el: '#navigation'

    initialize: ->
      @listenTo Router, 'route:dashboard', -> @setActive 'dashboard'
      @listenTo Router, 'route:entries', -> @setActive 'entries'


    clearActives: ->
      actives = @$el.find '.active'
      actives.removeClass 'active'

    setActive: (clz) ->
      @clearActives()
      @$('.' + clz).addClass 'active'

  )