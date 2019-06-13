var extend = function(child, parent) { for (var key in parent) { if (hasProp.call(parent, key)) child[key] = parent[key]; } function ctor() { this.constructor = child; } ctor.prototype = parent.prototype; child.prototype = new ctor(); child.__super__ = parent.prototype; return child; },
  hasProp = {}.hasOwnProperty;

define(["text", "global", ENV + "/js/components/loader"], function(text, global, Loader) {
  this.$('body').html((new Loader({
    "class": "gLoaderAbsolut"
  })).show());
  return require(["jquery", "underscore", "backbone", ENV + "/js/router", "text!src/templates/app.html", ENV + "/js/main/menu", ENV + "/js/main/home", "bootstrap", ENV + "/js/components/lang"], (function(_this) {
    return function($, _, Backbone, Router, AppTpl, Menu, Home) {
      var App;
      loadCss(baseUrl + "lib/bootstrap/bootstrap.min.css");
      loadCss("" + baseUrl + ENV + "/css/yagoml_frame_styles.css");
      loadCss(baseUrl + "lib/input-labels/input_labels.css");
      loadCss("" + baseUrl + ENV + "/css/style.css");
      App = (function(superClass) {
        extend(App, superClass);

        function App() {
          return App.__super__.constructor.apply(this, arguments);
        }

        App.prototype.template = _.template(AppTpl);

        App.prototype.initialize = function() {
          setLang('pt');
          this.router = new Router;
          Backbone.history.start();
          return this.render();
        };

        App.prototype.render = function() {
          $('body').html(this.template());
          this.menu();
          return this.home();
        };

        App.prototype.menu = function() {
          this.menu = new Menu;
          return $('header').html(this.menu.render().$el);
        };

        App.prototype.home = function() {
          this.home = new Home;
          return $('#mainContent').html(this.home.render().$el);
        };

        return App;

      })(Backbone.View);
      return new App;
    };
  })(this));
});
