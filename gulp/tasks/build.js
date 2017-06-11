var gulp = require('gulp'); //main gulp package needed
imagemin = require('gulp-imagemin'),
del = require('del'),
usemin = require('gulp-usemin'),
rev = require('gulp-rev'),
cssnano = require('gulp-cssnano'),
uglify = require('gulp-uglify');
browserSync= require('browser-sync').create();

gulp.task('previewDist', function() {
	browserSync.init({
    notify: false, //toglie la notifica che compare sul browser
		server: {
			baseDir: "docs" //browserSync needs to kwow where the html file is. baseDir stands for basedirectory.
		}
	});
});


//task for canceling the old dist folder before executing all other tasks
gulp.task('deleteDistFolder', ['icons'], function() {
	return del("./docs")
});

//generic task for adding additional files
gulp.task('copyGeneralFiles', ['deleteDistFolder'], function() {
	var pathsToCopy = [                     //variable for easiness of read
	'./app/**/*',
	'!./app/index.html',
	'!./app/assets/images/**',
	'!./app/assets/styles/**',
	'!./app/assets/scripts/**',
	'!./app/temp',
	'!./app/temp/**',
	]
	
	return gulp.src(pathsToCopy)
	.pipe(gulp.dest("./docs"));
});

//task for optimizing images
gulp.task('optimizeImages', ['deleteDistFolder'], function() {
	return gulp.src(['./app/assets/images/**/*', '!./app/assets/images/icons', '!./app/assets/images/icons/**/*']) //files to be edited. the '!' excludes some files
	.pipe(imagemin({
		progressive: true, //will optimize further jpeg images
		interlaced: true,  //will help with gif images
		multipass: true    //will help with svg files
	}))
	.pipe(gulp.dest("./docs/assets/images")); //edited files sent to a destination
});

//intermidiate task for usemin
gulp.task('useminTrigger', ['deleteDistFolder'], function() {
	gulp.start("usemin");
});

//task for copying the css, js and files
gulp.task('usemin', ['styles', 'scripts'], function() {  //adding 'styles','scripts' to dependancies assures the latest files are used
	return gulp.src("./app/index.html")
	.pipe(usemin({ //revision & compression of files
		css: [function() {return rev()}, function() {return cssnano()}],  //array of functions (filters) to perform
		js: [function() {return rev()}, function() {return uglify()}]
	}))  
	.pipe(gulp.dest("./docs"));
});

gulp.task('build', ['deleteDistFolder', 'copyGeneralFiles', 'optimizeImages', 'useminTrigger']); //build task will call multiple tasks in []