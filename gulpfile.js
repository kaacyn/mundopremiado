/*!
 * gulp
 * $ npm install gulp-ruby-sass gulp-autoprefixer gulp-cssnano gulp-jshint gulp-concat gulp-uglify gulp-imagemin gulp-notify gulp-rename gulp-livereload gulp-cache del --save-dev
 */

// Load plugins
var gulp = require('gulp'),
    sass = require('gulp-ruby-sass'),
	less = require('gulp-less'),
    autoprefixer = require('gulp-autoprefixer'),
    cssnano = require('gulp-cssnano'),
    jshint = require('gulp-jshint'),
    uglify = require('gulp-uglify'),
    imagemin = require('gulp-imagemin'),
    rename = require('gulp-rename'),
    concat = require('gulp-concat'),
    notify = require('gulp-notify'),
    cache = require('gulp-cache'),
    livereload = require('gulp-livereload'),
    del = require('del'),
	gulpFilter = require('gulp-filter'),
	pngquant = require('imagemin-pngquant'),
	mainBowerFiles = require('main-bower-files');



// Styles
gulp.task('styles', function() {
	
	var files = [
	  'public/assets/frontend/src/styles/fonts/ubuntu/stylesheet.css',
	  'public/assets/frontend/src/styles/bootstrap.min.css',
	  'public/assets/frontend/src/styles/main.css'
	]
	
  return gulp.src(files)
    .pipe(concat('main.css'))
    .pipe(gulp.dest('public/assets/frontend/dist/styles'))
    .pipe(rename({ suffix: '.min' }))
    .pipe(cssnano())
    .pipe(gulp.dest('public/assets/frontend/dist/styles'))
    .pipe(notify({ message: 'Styles task complete' }));
});



// Scripts
gulp.task('scripts', function() {
	
	var files = [
	  'public/assets/frontend/src/scripts/jquery.min.js',
	 // 'public/assets/frontend/src/scripts/bootstrap.min.js',
	  'public/assets/frontend/src/scripts/mundo-premiado.js'
	]
	
	return gulp.src(files)
		.pipe(jshint('.jshintrc'))
		.pipe(jshint.reporter('default'))
		.pipe(concat('main.js'))
		.pipe(gulp.dest('public/assets/frontend/dist/scripts'))
		.pipe(rename({ suffix: '.min' }))
		.pipe(uglify())
		.pipe(gulp.dest('public/assets/frontend/dist/scripts'))
		.pipe(notify({ message: 'Scripts task complete' }));

});




// Styles Admin
gulp.task('styles-admin', function() {
  return sass('public/assets/backend/src/styles/main.scss', { style: 'expanded' })
    .pipe(autoprefixer('last 2 version'))
    .pipe(gulp.dest('public/assets/backend/dist/styles'))
    .pipe(rename({ suffix: '.min' }))
    .pipe(cssnano())
    .pipe(gulp.dest('public/assets/backend/dist/styles'))
    .pipe(notify({ message: 'Estilo admin completo' }));
});


// Scripts Admin
gulp.task('scripts-admin', function() {
	
	var files = mainBowerFiles();
	
	files.push('public/assets/backend/src/scripts/**/*.js');
	
	return gulp.src(files)
		.pipe(jshint('.jshintrc'))
		.pipe(jshint.reporter('default'))
		.pipe(concat('main.js'))
		.pipe(gulp.dest('public/assets/backend/dist/scripts'))
		.pipe(rename({ suffix: '.min' }))
		.pipe(uglify())
		.pipe(gulp.dest('public/assets/backend/dist/scripts'))
		.pipe(notify({ message: 'Scripts task complete' }));

});

// Images
gulp.task('images', function() {
  return gulp.src('public/assets/frontend/src/images/**/*')
	.pipe(imagemin({
		progressive: true,
		svgoPlugins: [{removeViewBox: false}],
		use: [pngquant()]
	}))
    .pipe(gulp.dest('public/assets/frontend/dist/images'))
    .pipe(notify({ message: 'Imagem completa' }));
});

// Clean
gulp.task('clean', function() {
  return del([ 'public/assets/frontend/dist/scripts', 'public/assets/frontend/dist/images']);
});

// Default task
gulp.task('default', ['clean'], function() {
  gulp.start('styles', 'scripts', 'images');
});

// Watch
gulp.task('watch', function() {

  // Watch .scss files
  gulp.watch('public/assets/frontend/src/styles/**/*.scss', ['styles']);

  // Watch .js files
  gulp.watch('public/assets/frontend/src/scripts/**/*.js', ['scripts']);

  // Watch image files
  gulp.watch('public/assets/frontend/src/images/**/*', ['images']);

  // Create LiveReload server
  livereload.listen();

  // Watch any files in dist/, reload on change
  gulp.watch(['public/dist/**']).on('change', livereload.changed);

});