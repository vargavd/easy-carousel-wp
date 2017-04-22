// REQUIRES
var gulp        = require('gulp');
var plumber     = require('gulp-plumber');
var less        = require('gulp-less');
var eslint      = require('gulp-eslint');

// VARIABLES
var adminLessFiles  = 'admin/css/*.less';
var adminCssDest    = 'admin/css';
var jsFiles         = ['js/*.js', 'admin/js/*.js', 'inc/*.php', '!admin/js/jquery-ui.min.js', '!admin/js/spectrum.js'];
var isItProduction  = false;

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
        .pipe(eslint({ config: '.eslintrc' }))
        .pipe(eslint.format());
    // return gulp.src(jsFiles)
    //     .pipe(plumber({ errorHandler: handleError }))
    //     .pipe(jsLint(jsLintConfig))
    //     .pipe(jsLint.reporter('default'));
});
gulp.task('start-dev', ['admin-less', 'js'], function () {
    // watch for admin less changes
    gulp.watch(adminLessFiles, ['admin-less']);

    // watch for js changes
    gulp.watch(jsFiles, ['js']);
});