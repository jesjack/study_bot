// Router
const router = require('express').Router()

router.get('/', function(req, res, next) {
	// next()
	res.render('index', {})
})

module.exports = router