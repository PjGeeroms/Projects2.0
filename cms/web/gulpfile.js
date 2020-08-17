"use strict";
/**
 * The gulp configuration file.
 *
 */

const gulp                      = require('gulp'),
    sourcemaps                = require('gulp-sourcemaps'),
    plumber                   = require('gulp-plumber'),
    sass                      = require('gulp-sass'),
    autoprefixer              = require('gulp-autoprefixer'),
    minifyCss                 = require('gulp-clean-css'),
    babel                     = require('gulp-babel'),
    webpack                   = require('webpack-stream'),
    uglify                    = require('gulp-uglify'),
    concat                    = require('gulp-concat'),
    imagemin                  = require('gulp-imagemin'),
    rename                    = require('gulp-rename'),

    node_modules_folder       = './node_modules/',
    node_dependencies         = Object.keys(require('./package.json').dependencies || {});


/**
 * Auto prefixing, minifying goodness.
 */
function css() {
  return gulp
      .src('./assets/scss/**/*.scss')
      .pipe(plumber())
      .pipe(sourcemaps.init())
      .pipe(sass().on('error', sass.logError))
      .pipe(autoprefixer())
      .pipe(minifyCss())
      .pipe(rename('style.min.css'))
      .pipe(sourcemaps.write('.'))
      .pipe(gulp.dest('./assets/css/'));
}

function js() {
  return gulp
      .src(['./assets/js/**/*.js', '!./assets/js/dist/*', '!./assets/js/libraries/*' ])
      .pipe(plumber())
      .pipe(sourcemaps.init())
      .pipe(babel({
        presets: [ '@babel/env' ]
      }))
      .pipe(uglify())
      .pipe(rename({suffix: '.min'}))
      .pipe(sourcemaps.write('.'))
      .pipe(gulp.dest('./assets/js/dist/'));
}

function images() {
  return gulp
      .src(['./assets/images/**/*.+(png|jpg|jpeg|gif|svg|ico)', '!./assets/images/compressed/*.+(png|jpg|jpeg|gif|svg|ico)' ])
      .pipe(plumber())
      .pipe(imagemin())
      .pipe(gulp.dest('./assets/images/compressed'));
};

function watchFiles() {
  gulp.watch("./assets/scss/**/*.scss", css);
  gulp.watch(['./assets/js/**/*.js', '!./assets/js/dist/*' ], js);
  //gulp.watch(['./images/**/*.+(png|jpg|jpeg|gif|svg|ico)', '!./images/compressed/*.+(png|jpg|jpeg|gif|svg|ico)' ], images);
}

const watch = gulp.series(watchFiles);
const build = gulp.series(css, js);
const buildAndThenWatch = gulp.series(build, watch);

exports.sass = css;
exports.js = js;
exports.build = build;
exports.watch = watch;
exports.default = buildAndThenWatch;
