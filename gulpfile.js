var gulp = require('gulp'),
    concat = require('gulp-concat'),
    uglify = require('gulp-uglify'),
    uglifycss = require('gulp-uglifycss'),
    //imagemin = require('gulp-imagemin'),
    minify = require('gulp-minify'),
    sass = require('gulp-sass');
    //stripCssComments = require('gulp-strip-css-comments');

//Compile SASS
gulp.task('sass', function () {
     return gulp.src('resources/assets/sass/workers.scss')
        .pipe(sass({outputStyle: 'compressed'}).on('error', sass.logError))
        .pipe(gulp.dest('public/css/'));
});

//all in one css
gulp.task('css_one', function(){
     gulp.src('resources/assets/css/**/*.css')
        .pipe(concat('allStyles.css'))
        .pipe(uglifycss({
            "maxLineLen": 80,
            "uglyComments": true}) )
        .pipe(gulp.dest('public/css/'));
});

//union and uglify JS
gulp.task('js_one', function(){
    gulp.src('resources/assets/js/main/**/*.js')
        .pipe(concat('all.js'))
        .pipe(minify())
        .pipe(gulp.dest('public/js/'));
});


//CSS
gulp.task('build_css',['sass', 'css_one'], function (){
console.log('css refresh');
});

//JS
gulp.task('build_js', function (){
    console.log('js refresh');
});

//check refresh files
gulp.task('watch', function () {
    gulp.watch('./resources/assets/sass/**/*.scss', ['sass']);
    /*gulp.watch('./resources/assets/css/main/!**!/!*.css', ['css_one']);
    gulp.watch('./resources/assets/js/!**!/!*.js', ['build_js']);*/
});

