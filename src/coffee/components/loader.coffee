define ['jquery', 'underscore', 'backbone'], ($, _, Backbone) ->

    loadCss "#{baseUrl}#{ENV}/css/components/loader.css"

    class Loader extends Backbone.View

        initialize: (@options) ->
            @template = _.template "<img src='#{baseUrl}lib/images/loading.gif' class='#{@options.class}'>"

        show: ->
            @$el.html @template