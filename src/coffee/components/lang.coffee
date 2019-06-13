
##########################################################################################
	# Multi Language Config Plugin
	# Possibilita configurar várias linguagens para o sistema
	# Autor: Yago M. Laignier
	##########################################################################################
	# Definir as linguagens suportados no array LANGS. São as 2 primeiras letras do LANGCODE
	# Criar o arquivo de chave:linguagem em LANGDIR
	##########################################################################################
	# Ex. uso: 
	# 	$.when(getLangData('main/menu')).done (@langLib) =>
##########################################################################################

# Configuração
defaultLang = 'en' # Linguagem padrão do sistema
langs = ['pt'] # Linguagens suportadas
langDir = 'src/lang/' # Diretório de linguagens

# Carrega dados de determinado arquivo de linguagem
# Parâmetros:
# langFile: [string] Caminho dps de LANGDIR + nome do arquivo. Ex.: 'main/menu'
getLangData = (langFile) ->
	# langCode = navigator.language.substr 0, 2 # Config do navegador
	langCode = getLang()
	def = $.Deferred()
	def.promise()
	langData = $.Deferred()
	langData.promise()
	langData = $.getJSON("#{langDir + langFile}.json")
	langCode = defaultLang unless (langCode in langs)
	$.when(langData).done (langData) ->
		if langData[langCode]?
			def.resolve langData[langCode]
		else
			def.reject()
	def

# Define linguagem do sistema
# Parâmetros:
# lang: [string] Linguagem. Ex.: 'pt'
setLang = (lang) ->
	window.systemLang = lang

getLang = ->
	window.systemLang