var extend = function(child, parent) { for (var key in parent) { if (hasProp.call(parent, key)) child[key] = parent[key]; } function ctor() { this.constructor = child; } ctor.prototype = parent.prototype; child.prototype = new ctor(); child.__super__ = parent.prototype; return child; },
  hasProp = {}.hasOwnProperty;

define(["jquery", "underscore", "backbone", "text!src/templates/components/navBarTpl.html", "text!" + ENV + "/css/components/navBar.css"], function($, _, Backbone, NavBarTpl, NavBarCss) {
  var NavBar;
  return NavBar = (function(superClass) {
    extend(NavBar, superClass);

    function NavBar() {
      return NavBar.__super__.constructor.apply(this, arguments);
    }

    NavBar.prototype.events = {
      'mouseover .drop-menu': 'mouseEnterDrop',
      'mouseover .drop-menu li': 'mouseEnterDropLI',
      'mouseover .drop-menu li a': 'mouseEnterDropA',
      'mouseleave .drop-menu': 'mouseLeaveDrop',
      'mouseleave .botao-menu': 'mouseLeaveBotaoMenu',
      'mouseleave .drop-menu li': 'mouseLeaveDropLI',
      'mouseleave .drop-menu li a': 'mouseLeaveDropA'
    };

    NavBar.prototype.template = _.template(NavBarTpl);

    NavBar.prototype.initialize = function(options) {
      this.options = options;
    };

    NavBar.prototype.render = function() {
      $.when(loadCssInline(NavBarCss)).then((function(_this) {
        return function() {
          return _this.$el.html(_this.template({
            links: _this.options
          }));
        };
      })(this));
      return this;
    };

    NavBar.prototype.mouseEnterDrop = function(e) {
      return $(e.target).prev('a').addClass('green');
    };

    NavBar.prototype.mouseEnterDropLI = function(e) {
      return $(e.target).parent().prev('a').addClass('green');
    };

    NavBar.prototype.mouseEnterDropA = function(e) {
      return $(e.target).parent().parent().prev('a').addClass('green');
    };

    NavBar.prototype.mouseLeaveDrop = function(e) {
      return $(e.target).prev('a').removeClass('green');
    };

    NavBar.prototype.mouseLeaveDropLI = function(e) {
      return $(e.target).parent().prev('a').removeClass('green');
    };

    NavBar.prototype.mouseLeaveDropA = function(e) {
      return $(e.target).parent().parent().prev('a').removeClass('green');
    };

    NavBar.prototype.mouseLeaveBotaoMenu = function(e) {
      return $(e.target).removeClass('green');
    };

    return NavBar;

  })(Backbone.View);
});
