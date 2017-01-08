var gulp = require('gulp'),
webpack = require('webpack');

//task for automating the execution of webpack
gulp.task('scripts', function(callback) {
	webpack(require('../../webpack.config.js'), function(err, stats) {  //webpack() needs 2 arguments
		if (err) {
			console.log(err.toString())
		}
		console.log(stats.toString());
		callback();  //serve a far sapere a gulp che webpack ha terminato
	});  // "../" fa salire su di una cartella
});