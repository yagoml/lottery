var extend = function(child, parent) { for (var key in parent) { if (hasProp.call(parent, key)) child[key] = parent[key]; } function ctor() { this.constructor = child; } ctor.prototype = parent.prototype; child.prototype = new ctor(); child.__super__ = parent.prototype; return child; },
  hasProp = {}.hasOwnProperty;

define(["jquery", "underscore", "backbone", "text!src/templates/main/home.html"], function($, _, Backbone, HomeTpl) {
  var Home;
  return Home = (function(superClass) {
    extend(Home, superClass);

    function Home() {
      return Home.__super__.constructor.apply(this, arguments);
    }

    Home.prototype.template = _.template(HomeTpl);

    Home.prototype.initialize = function() {
      return $.ajax({
        type: 'post',
        dataType: 'json',
        url: baseUrl + "main/getIndexData",
        success: (function(_this) {
          return function(data) {
            _this.data = data;
          };
        })(this)
      });
    };

    Home.prototype.render = function() {
      this.$el.html(this.template);
      return this;
    };

    return Home;

  })(Backbone.View);
});
