var gulp = require('gulp'),     //variabile. require serve ad importare un package. La , permette di elencare tutte le var.
watch = require ('gulp-watch'),
browserSync= require('browser-sync').create(); //.create calls the method create() of browser-sync

//Definizione della funzione watch (osserva il alcuni file ed effettua operazioni in caso di modifiche e salvataggi).
gulp.task('watch', function(){
  
  //durante watch apre in automatico il file html nel browser web
  browserSync.init({
    notify: false, //toglie la notifica che compare sul browser
	server: {
		baseDir: "app" //browserSync needs to kwow where the html file is. baseDir stands for basedirectory.
	}
  });
  
  //durante watch ricarica in automatico il file html se subisce modifiche
  watch('./app/index.html', function(){
    browserSync.reload();
  });
  
  //durante watch esegue styles (vedere sopra).
  watch('./app/assets/styles/**/*.css', function(){  // watch osserva il file del percorso. /**/ permette di far riferimento a qualsiasi cartella
     gulp.start('cssInject');   //in questo modo tutte le volte che si usa watch (monitora le change), viene attivato il metodo html.
  });                        //.start permette di accedere ad un metodo di gulp

  //durante watch ricarica il file degli script se subisce modifiche
  watch('./app/assets/scripts/**/*.js', function(){
	  gulp.start('scriptsRefresh');
  });
  
});

//funzione cssInject per usare il file css compilato e usarlo sulla pagina html
gulp.task('cssInject', ['styles'],function() { //[''] esegue e completa 'styles' (in tal modo si genera il PostCSS) prima di eseguire cssInject
	return gulp.src('./app/temp/styles/style.css')
	.pipe(browserSync.stream()); //il metodo .stream() di pipe permette di rendere disponibile sul browser il file immesso nel pipe 
								 //'./app/temp/styles/style.css' in questo caso
});

//task per far aggiornare la pagina web a seguito di modifiche degli script
gulp.task('scriptsRefresh', ['scripts'], function() {
	browserSync.reload();
})