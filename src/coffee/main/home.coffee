define ["jquery", "underscore", "backbone"
	"text!src/templates/main/home.html"
], ($, _, Backbone, HomeTpl) ->
	class Home extends Backbone.View
		template: _.template HomeTpl

		initialize: ->
			$.ajax
				type: 'post'
				dataType: 'json'
				url: "#{baseUrl}main/getIndexData"
				success: (@data) =>

		render: ->
			@$el.html @template
			@