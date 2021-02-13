// Declaraciones
const { spawnSync } = require('child_process')

const main_conf = require('./src/config/main.conf.json')
const cookieParser = require('cookie-parser')
const session = require('express-session')
const circular = require('circular')
const express = require('express')
const morgan = require('morgan')
const path = require('path')
const fs = require('fs')

// APP de express
const app = express()

// Middlewares
	// Úso común
app.use(express.urlencoded({ extended: false }))
app.use(morgan('dev', {}))
app.use(express.json())
	// Sesiones
app.use(cookieParser())
app.use(session({
  secret: 'keyboard cat',
  resave: false,
  saveUninitialized: true
}))

// PHP engine
app.use(function(req, res, next) {
  app.set('_GET', req.query)
  app.set('_POST', req.body)
  app.set('_SESSION', req.session)
  next()
})
app.engine('php', function(filePath, options, callback) {
  options._TEMPLATE = filePath
  options._VIEWS_PATH = options.settings.views
  const output = spawnSync('php', [ path.join(__dirname, 'src', 'private', 'php', 'loader.php'), JSON.stringify(options, circular()) ])
  return callback(output.stderr.toString(), output.stdout.toString())
})
app.set('views', './src/private/view') // specify the views directory
app.set('view engine', 'php') // register the template engine

app.set('main_conf', main_conf) // El archivo main.conf.json se guardará en la variable php $settings['main_conf']

// Archivos estaticos
app.use('/src', express.static(path.join(__dirname, 'src', 'public')))

// Router
	/**
	 * Cree archivos.js para añadir rutas a la página principal en ./src/private/router/
	 */
fs.readdir(path.join(__dirname, 'src', 'private', 'router'), function(error, files) {
	if(error) throw error
	else files.forEach(function(file) {
		app.use(`/${file.split('.js')[0]}`, require(path.join(__dirname, 'src', 'private', 'router', file)))
	})
})
app.use('/', require('./src/private/router/index.js'))

module.exports = app