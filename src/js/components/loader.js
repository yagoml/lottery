var extend = function(child, parent) { for (var key in parent) { if (hasProp.call(parent, key)) child[key] = parent[key]; } function ctor() { this.constructor = child; } ctor.prototype = parent.prototype; child.prototype = new ctor(); child.__super__ = parent.prototype; return child; },
  hasProp = {}.hasOwnProperty;

define(['jquery', 'underscore', 'backbone'], function($, _, Backbone) {
  var Loader;
  loadCss("" + baseUrl + ENV + "/css/components/loader.css");
  return Loader = (function(superClass) {
    extend(Loader, superClass);

    function Loader() {
      return Loader.__super__.constructor.apply(this, arguments);
    }

    Loader.prototype.initialize = function(options) {
      this.options = options;
      return this.template = _.template("<img src='" + baseUrl + "lib/images/loading.gif' class='" + this.options["class"] + "'>");
    };

    Loader.prototype.show = function() {
      return this.$el.html(this.template);
    };

    return Loader;

  })(Backbone.View);
});
