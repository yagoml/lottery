define ["jquery", "underscore", "backbone"],
($, _, Backbone) ->
	class Router extends Backbone.Router
		routes:
			# Menu Superior
			"cadastro(/)": "cadastroOrgaos"

		initialize: ->
			super

		cadastroOrgaos: ->
			require ["#{ENV}/js/header/cadastroOrgaos"], (CadastroOrgaos) ->
				@$("#mainContent").html (new CadastroOrgaos).render().$el