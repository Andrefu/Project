var gulp = require('gulp'), //require the entire gulp package
svgSprite = require('gulp-svg-sprite'),
rename = require('gulp-rename'),
del = require('del');

//object literal (comma-separated list of name-value pairs wrapped in braces, tidily encapsulating data)
var config = {
	mode: {
		css: {
			sprite: 'sprite.svg', //per eliminare il pezzo .css nel nome del file in _sprite.css
			render: {
				css: {
					template: './gulp/templates/sprite.css'
				}
			}
		}
	}
}

gulp.task('beginClean', function() {
	return del(['./app/temp/sprite', './app/assets/images/sprites']); //del will the delete an array of folders between brackets
});

//task creating the Sprite file in the ./app/temp/sprite/ folder
gulp.task('createSprite', ['beginClean'], function() { //1st argument: name of the task, 2nd argument is what it will do
	return gulp.src('./app/assets/images/icons/**/*.svg')  //gulp source needs the return command. the adress goes to the folder with all svg photos
		.pipe(svgSprite(config)) //config is an object literal needed by gulp-svg-sprite for containing all its objects
		.pipe(gulp.dest('./app/temp/sprite/')); //brings the elaborated source stuff to its destination
}); 

//task per spostare il file sprite nella cartella delle immagini
gulp.task('copySpriteGraphic', ['createSprite'], function() {
	return gulp.src('./app/temp/sprite/css/**/*.svg')
	.pipe(gulp.dest('./app/assets/images/sprites'));
});

//task copying the sprite.css file in the modules folder
gulp.task('copySpriteCSS', ['createSprite'], function(){ // in [] are the dependancies (i.e. functions on which it depends)
	return gulp.src('./app/temp/sprite/css/*.css') //grab all stuff in the folder ending with .css
	.pipe(rename('_sprite.css')) //rename file adding _
	.pipe(gulp.dest('./app/assets/styles/modules/'));
});

gulp.task('endClean', ['copySpriteGraphic', 'copySpriteCSS'], function() {
	return del('./app/temp/sprite');
});

//task executing the above two commands for an eventual new icon in order to shorten the generation of a new sprite file
gulp.task('icons', ['beginClean', 'createSprite', 'copySpriteGraphic','copySpriteCSS', 'endClean']); //both tasks are executed at the same time