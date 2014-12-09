define [
  'backbone'
], (Backbone) ->

  return Backbone.View.extend(

    el: '#navigation'

    events:
      'click a': 'setActive'


    clearActives: ->
      actives = @$el.find '.active'
      actives.removeClass 'active'

    setActive: (event) ->
      @clearActives()
      target = @$ event.currentTarget
      target.addClass 'active'

  )