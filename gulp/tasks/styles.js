var gulp = require('gulp'),     //variabile. require serve ad importare un package. La , permette di elencare tutte le var.
postcss =  require('gulp-postcss'),
autoprefixer = require('autoprefixer'),
cssvars = require('postcss-simple-vars'),
nested =  require('postcss-nested'),
cssImport = require('postcss-import'),
mixins = require('postcss-mixins'),
hexrgba = require('postcss-hexrgba');

//definizione della funzione styles per far passare il codice contenuto in style.css attraverso i PostCSS filters che lo 
//traducono in linguaggio leggibile da tutti i browser (aggiunta vendor prefixes,variabili,classi annidate, ).
gulp.task('styles', function(){
  return gulp.src('./app/assets/styles/style.css') //return serve perché gulp.src è A-synchronous function.Serve a far sapere a gulp quando .src termina
    .pipe(postcss([cssImport, mixins, cssvars, nested, hexrgba, autoprefixer])) //.pipe serve a far passare a pipe() il contenuto di gulp.src 
    .on('error', function(errorInfo) {
	   console.log(errorInfo.toString());  //verrano stampate informazioni sull'errore
	   this.emit('end');  //in caso di errore si esegue termina styles
    })
  
  .pipe(gulp.dest('./app/temp/styles'));  // 2° pipe per far passare il codice attraverso PostCSS filters
  });
 