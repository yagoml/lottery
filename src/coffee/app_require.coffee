define [
	"text"
	"global"
	"#{ENV}/js/components/loader"
], (text, global, Loader) ->

	@$('body').html (new Loader class: "gLoaderAbsolut").show()

	require ["jquery", "underscore", "backbone",
		"#{ENV}/js/router"
		"text!src/templates/app.html"
		"#{ENV}/js/main/menu"
		"#{ENV}/js/main/home"
		"bootstrap"
		"#{ENV}/js/components/lang"
	], ($, _, Backbone, Router, AppTpl, Menu, Home) =>
		loadCss "#{baseUrl}lib/bootstrap/bootstrap.min.css"
		loadCss "#{baseUrl}#{ENV}/css/yagoml_frame_styles.css"
		loadCss "#{baseUrl}lib/input-labels/input_labels.css"
		loadCss "#{baseUrl}#{ENV}/css/style.css"

		class App extends Backbone.View
			template: _.template AppTpl

			initialize: ->
				setLang 'pt' # Define linguagem do sistema
				@router = new Router
				Backbone.history.start()
				@render()

			render: ->
				$('body').html @template()
				@menu()
				@home()

			menu: ->
				@menu = new Menu
				$('header').html @menu.render().$el

			home: ->
				@home = new Home
				$('#mainContent').html @home.render().$el

		new App