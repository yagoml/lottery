define ["jquery", "underscore", "backbone"
	"#{ENV}/js/components/navBar"
], ($, _, Backbone, NavBar) ->
	class Menu extends Backbone.View
		initialize: ->

		render: ->
			$.when(getLangData('main/menu')).done (@langLib) =>
				@$el.html (new NavBar [
					{title: @langLib["inicio"], href: "#{baseUrl}", icon: "glyphicon glyphicon-home"}
					{title: @langLib['sorteios'], icon: "glyphicon glyphicon-usd", subLinks: [
						{title: @langLib['sorteios.loteria'], href: '#sorteios/loteria(/)'}
						{title: @langLib['sorteios.roletas'], href: '#sorteios/roletas(/)'}
						{title: @langLib['sorteios.ticketsPremiados'], href: '#sorteios/ticketsPremiados(/)'}
						{title: @langLib['sorteios.roletasPremiadas'], href: '#sorteios/roletasPremiadas(/)'}
					]},
					{title: @langLib['rankings'], icon: "glyphicon glyphicon-usd", subLinks: [
						{title: @langLib['rankings.nivel'], href: '#rankings/nivel(/)'}
						{title: @langLib['rankings.tickets'], href: '#rankings/tickets(/)'}
						{title: @langLib['rankings.faturamento'], href: '#rankings/faturamento(/)'}
						{title: @langLib['rankings.ganhadores'], href: '#rankings/ganhadores(/)'}
						{title: @langLib['rankings.indicacoes'], href: '#rankings/indicacoes(/)'}
					]},
					{title: @langLib['compraTickets'], href: "#compraTickets", icon: "glyphicon glyphicon-tags"},
					{title: @langLib['login'], href: "#login", icon: "glyphicon glyphicon-log-in", right: true},
					{title: @langLib['cadastro'], href: "#cadastro", icon: "glyphicon glyphicon-user", right: true}
				]).render().$el
			@