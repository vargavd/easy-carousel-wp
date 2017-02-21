// REQUIRES
var gulp        = require('gulp');
var jsLint      = require('gulp-jslint');
var plumber     = require('gulp-plumber');
var less        = require('gulp-less');

// VARIABLES
var adminLessFiles  = 'admin/css/*.less';
var adminCssDest    = 'admin/css';
var jsFiles         = ['admin/js/*.js'];
var isItProduction  = false;
var jsLintConfig    = { 
    global : ['jQuery', 'window', 'Modernizr', 'wp', 'Exception', 'QU'], 
    browser: true,
    devel  : isItProduction,
    maxerr : 5,
    this: true
};

// HELPER FUNCTIONS
var handleError   = function (error) {
    console.log(error);
    this.emit('end');
};

// TASKS
gulp.task('admin-less', function () {
    return gulp.src(adminLessFiles)
        .pipe(less())
        .pipe(gulp.dest(adminCssDest));
});
gulp.task('js', function () {
    return gulp.src(jsFiles)
        .pipe(plumber({ errorHandler: handleError }))
        .pipe(jsLint(jsLintConfig))
        .pipe(jsLint.reporter('default'));
});
gulp.task('start-dev', ['admin-less', 'js'], function () {
    // watch for admin less changes
    gulp.watch(adminLessFiles, ['admin-less']);

    // watch for js changes
    gulp.watch(jsFiles, ['js']);
});