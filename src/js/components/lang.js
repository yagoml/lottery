var defaultLang, getLang, getLangData, langDir, langs, setLang,
  indexOf = [].indexOf || function(item) { for (var i = 0, l = this.length; i < l; i++) { if (i in this && this[i] === item) return i; } return -1; };

defaultLang = 'en';

langs = ['pt'];

langDir = 'src/lang/';

getLangData = function(langFile) {
  var def, langCode, langData;
  langCode = getLang();
  def = $.Deferred();
  def.promise();
  langData = $.Deferred();
  langData.promise();
  langData = $.getJSON((langDir + langFile) + ".json");
  if (!(indexOf.call(langs, langCode) >= 0)) {
    langCode = defaultLang;
  }
  $.when(langData).done(function(langData) {
    if (langData[langCode] != null) {
      return def.resolve(langData[langCode]);
    } else {
      return def.reject();
    }
  });
  return def;
};

setLang = function(lang) {
  return window.systemLang = lang;
};

getLang = function() {
  return window.systemLang;
};
