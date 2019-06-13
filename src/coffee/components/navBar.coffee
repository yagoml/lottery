define ["jquery", "underscore", "backbone"
	"text!src/templates/components/navBarTpl.html"
	"text!#{ENV}/css/components/navBar.css"
], ($, _, Backbone, NavBarTpl, NavBarCss) ->
	class NavBar extends Backbone.View
		events:
			'mouseover .drop-menu': 'mouseEnterDrop'
			'mouseover .drop-menu li': 'mouseEnterDropLI'
			'mouseover .drop-menu li a': 'mouseEnterDropA'
			'mouseleave .drop-menu': 'mouseLeaveDrop'
			'mouseleave .botao-menu': 'mouseLeaveBotaoMenu'
			'mouseleave .drop-menu li': 'mouseLeaveDropLI'
			'mouseleave .drop-menu li a': 'mouseLeaveDropA'

		template: _.template NavBarTpl

		initialize: (@options) ->

		render: ->
			$.when(loadCssInline NavBarCss).then =>
				@$el.html @template links: @options
			@

		mouseEnterDrop: (e) ->
			$(e.target).prev('a').addClass('green')
		
		mouseEnterDropLI: (e) ->
			$(e.target).parent().prev('a').addClass('green')

		mouseEnterDropA: (e) ->
			$(e.target).parent().parent().prev('a').addClass('green')

		mouseLeaveDrop: (e) ->
			$(e.target).prev('a').removeClass('green')

		mouseLeaveDropLI: (e) ->
			$(e.target).parent().prev('a').removeClass('green')

		mouseLeaveDropA: (e) ->
			$(e.target).parent().parent().prev('a').removeClass('green')

		mouseLeaveBotaoMenu: (e) ->
			$(e.target).removeClass 'green'