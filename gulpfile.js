const gulp = require('gulp'),
      rename = require('gulp-rename'),
      zip = require('gulp-zip');

const NAME = 'foc_add2cart_box';

gulp.task('mktest', () => {
  gulp.src('./upload/**')
      .pipe(gulp.dest('../oc2/'));
});

gulp.task('build-oc2', () => {
  gulp
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
});

gulp.task('build-oc3', () => {
  gulp.src([
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
});

gulp.task('build-all', ['build-oc2', 'build-oc3'], () => {});

gulp.task('default', ['mktest'], () => {
  gulp.watch('./upload/**', () => {
    gulp.start('mktest');
  });
});