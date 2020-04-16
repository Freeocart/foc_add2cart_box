const gulp = require('gulp'),
      rename = require('gulp-rename'),
      zip = require('gulp-zip');

const NAME = 'foc_add2cart_box';

function copyToTest () {
  return gulp.src('./upload/**')
    .pipe(gulp.dest('../oc2/'));
}

function buildOc2 () {
  return gulp
    .src([
      './install.oc2.xml',
      './upload/**/controller/**',
      './upload/**/model/**',
      './upload/**/language/**',
      './upload/**/view/**/*.tpl'
    ], {base: '.'})
    .pipe(rename((file) => {
      if (file.dirname == '.' && file.extname == '.xml') {
        file.basename = 'install'
      }
    }))
    .pipe(zip(`${NAME}-oc2.ocmod.zip`))
    .pipe(gulp.dest('./'))
}

function buildOc3 () {
  return gulp.src([
      './install.oc3.xml',
      './upload/**/controller/**',
      './upload/**/model/**',
      './upload/**/language/**',
      './upload/**/view/**/*.twig'
    ], {base: '.'})
    .pipe(rename((file) => {
      if (file.dirname == '.' && file.extname == '.xml') {
        file.basename = 'install'
      }
    }))
    .pipe(zip(`${NAME}-oc3.ocmod.zip`))
    .pipe(gulp.dest('./'))
}

function startWatcher () {
  return gulp.watch('./upload/**', copyToTest)
}

gulp.task('mktest', copyToTest);
gulp.task('build-oc2', buildOc2);
gulp.task('build-oc3', buildOc3);
gulp.task('build-all', gulp.parallel(buildOc2, buildOc3))
gulp.task('default', gulp.series(copyToTest, startWatcher));