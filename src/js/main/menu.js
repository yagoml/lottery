var extend = function(child, parent) { for (var key in parent) { if (hasProp.call(parent, key)) child[key] = parent[key]; } function ctor() { this.constructor = child; } ctor.prototype = parent.prototype; child.prototype = new ctor(); child.__super__ = parent.prototype; return child; },
  hasProp = {}.hasOwnProperty;

define(["jquery", "underscore", "backbone", ENV + "/js/components/navBar"], function($, _, Backbone, NavBar) {
  var Menu;
  return Menu = (function(superClass) {
    extend(Menu, superClass);

    function Menu() {
      return Menu.__super__.constructor.apply(this, arguments);
    }

    Menu.prototype.initialize = function() {};

    Menu.prototype.render = function() {
      $.when(getLangData('main/menu')).done((function(_this) {
        return function(langLib) {
          _this.langLib = langLib;
          return _this.$el.html((new NavBar([
            {
              title: _this.langLib["inicio"],
              href: "" + baseUrl,
              icon: "glyphicon glyphicon-home"
            }, {
              title: _this.langLib['sorteios'],
              icon: "glyphicon glyphicon-usd",
              subLinks: [
                {
                  title: _this.langLib['sorteios.loteria'],
                  href: '#sorteios/loteria(/)'
                }, {
                  title: _this.langLib['sorteios.roletas'],
                  href: '#sorteios/roletas(/)'
                }, {
                  title: _this.langLib['sorteios.ticketsPremiados'],
                  href: '#sorteios/ticketsPremiados(/)'
                }, {
                  title: _this.langLib['sorteios.roletasPremiadas'],
                  href: '#sorteios/roletasPremiadas(/)'
                }
              ]
            }, {
              title: _this.langLib['rankings'],
              icon: "glyphicon glyphicon-usd",
              subLinks: [
                {
                  title: _this.langLib['rankings.nivel'],
                  href: '#rankings/nivel(/)'
                }, {
                  title: _this.langLib['rankings.tickets'],
                  href: '#rankings/tickets(/)'
                }, {
                  title: _this.langLib['rankings.faturamento'],
                  href: '#rankings/faturamento(/)'
                }, {
                  title: _this.langLib['rankings.ganhadores'],
                  href: '#rankings/ganhadores(/)'
                }, {
                  title: _this.langLib['rankings.indicacoes'],
                  href: '#rankings/indicacoes(/)'
                }
              ]
            }, {
              title: _this.langLib['compraTickets'],
              href: "#compraTickets",
              icon: "glyphicon glyphicon-tags"
            }, {
              title: _this.langLib['login'],
              href: "#login",
              icon: "glyphicon glyphicon-log-in",
              right: true
            }, {
              title: _this.langLib['cadastro'],
              href: "#cadastro",
              icon: "glyphicon glyphicon-user",
              right: true
            }
          ])).render().$el);
        };
      })(this));
      return this;
    };

    return Menu;

  })(Backbone.View);
});
