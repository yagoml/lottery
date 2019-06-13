var extend = function(child, parent) { for (var key in parent) { if (hasProp.call(parent, key)) child[key] = parent[key]; } function ctor() { this.constructor = child; } ctor.prototype = parent.prototype; child.prototype = new ctor(); child.__super__ = parent.prototype; return child; },
  hasProp = {}.hasOwnProperty;

define(["jquery", "underscore", "backbone"], function($, _, Backbone) {
  var Router;
  return Router = (function(superClass) {
    extend(Router, superClass);

    function Router() {
      return Router.__super__.constructor.apply(this, arguments);
    }

    Router.prototype.routes = {
      "cadastro(/)": "cadastroOrgaos"
    };

    Router.prototype.initialize = function() {
      return Router.__super__.initialize.apply(this, arguments);
    };

    Router.prototype.cadastroOrgaos = function() {
      return require([ENV + "/js/header/cadastroOrgaos"], function(CadastroOrgaos) {
        return this.$("#mainContent").html((new CadastroOrgaos).render().$el);
      });
    };

    return Router;

  })(Backbone.Router);
});
