// Erik Cruz - @greatelse
// Base gulpfile - Frontend
// Plugins que utilizamos en el gulpfile
var gulp = require('gulp');
var sass = require('gulp-sass');
var plumber = require('gulp-plumber');
var connect = require('gulp-connect');

// Esta tarea ejecutara todas las demas
gulp.task('serve',['sass-build','watch','move-html','html-load','connect','move-js','move-jpg','move-png','move-files-scss','Notify'], function(){

});

// Crea el servidor en el puerto 8000
gulp.task('connect',function(){
  connect.server({
    root: 'staging',
    livereload: true,
    port: '8000'
  });
});

// Creamos una tarea llamada watch - Que ejecutara y las tareas declaradas como segundo parametro
gulp.task('watch',function(){
  gulp.watch('app/assets/styles/*.scss',['sass-build'])
  gulp.watch('app/*.html',['html-load'])
  gulp.watch('app/assets/images/*.png',['move-png'])
  gulp.watch('app/assets/js/*.js',['move-js'])
  gulp.watch('app/assets/images/*.jpg',['move-jpg'])
  gulp.watch('app/assets/sass/fonts/',['move-files-scss'])
});

// Movemos todos los archivos html de la carpeta de desarrollo a produccion/staging
gulp.task('move-html',function(){
  gulp.src('app/*.html')
  .pipe(gulp.dest('staging/'))
  .pipe(connect.reload())
});
// Movemos folders completos en la carpeta de scss
gulp.task('move-files-scss',function(){
  gulp.src('app/assets/styles/fonts/*')
  .pipe(gulp.dest('staging/assets/styles/fonts/'))
  .pipe(connect.reload())
});


// Movemos todos los archivos html de la carpeta de desarrollo a produccion/staging
gulp.task('move-js',function(){
  gulp.src('app/assets/js/*.js')
  .pipe(gulp.dest('staging/assets/js/'))
  .pipe(connect.reload())
});

// Movemos todos los archivos html de la carpeta de desarrollo a produccion/staging
gulp.task('move-png',function(){
  gulp.src('app/assets/images/*.png')
  .pipe(gulp.dest('staging/assets/images/'))
  .pipe(connect.reload())
});

// Movemos todos los archivos html de la carpeta de desarrollo a produccion/staging
gulp.task('move-jpg',function(){
  gulp.src('app/assets/images/*.jpg')
  .pipe(gulp.dest('staging/assets/images/'))
  .pipe(connect.reload())
});

// Recargamos gulp cuando haya un cambio en algun archivo html dentro de la carpeta de produccion/staging
// Ejecutamos la tarea MOVE-HTML como segundo parametro
gulp.task('html-load',['move-html'],function(){
    gulp.src('staging/*.html')
    .pipe(connect.reload())
});

// Esta tarea compilara todos los archivos '.scss' y los movera a la carpeta 'staging/assets/css' ya compilados.
gulp.task('sass-build', function(){
  gulp.src('app/assets/styles/*.scss')
    .pipe(sass())
    .pipe(gulp.dest('staging/assets/styles'))
    .pipe(plumber())
    .pipe(connect.reload())
});

// Si todas las tareas se completaron con exito - Nos saldra este console log
gulp.task('Notify', function(){
    console.log('Todo salio bien!! ;)');
});
