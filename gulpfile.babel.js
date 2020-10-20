"use strict"

import gulp from "gulp"
import sass from "gulp-sass"
import postcss from "gulp-postcss"
import autoprefixer from "autoprefixer"
import cssnano from "cssnano"
import sourcemaps from "gulp-sourcemaps"
import uglify from "gulp-uglify"
import plumber from "gulp-plumber"
import waits from "gulp-wait"
import concat from "gulp-concat"
import babel from "gulp-babel"
import browserSync from "browser-sync"
browserSync.create()

function css() {
  var plugins = [autoprefixer({ browsers: ["last 2 version"] }), cssnano()]

  return gulp
    .src(["./src/sass/**/*.sass"])
    .pipe(waits(800))
    .pipe(plumber())
    .pipe(sourcemaps.init())
    .pipe(sass())
    .pipe(postcss(plugins))
    .pipe(sourcemaps.write("."))
    .pipe(gulp.dest("./dist/assets/css"))
    .pipe(browserSync.stream())
}

function BootstrapCss() {
  var plugins = [autoprefixer({ browsers: ["last 2 version"] }), cssnano()]

  return gulp
    .src(["./node_modules/bootstrap/dist/css/bootstrap.min.css"])
    .pipe(waits(800))
    .pipe(plumber())
    .pipe(sass())
    .pipe(postcss(plugins))
    .pipe(sourcemaps.write("."))
    .pipe(gulp.dest("./dist/assets/css"))
    .pipe(browserSync.stream())
}

function AosCss() {
  var plugins = [autoprefixer({ browsers: ["last 2 version"] }), cssnano()]

  return gulp
    .src(["./node_modules/aos/src/sass/aos.scss"])
    .pipe(waits(800))
    .pipe(plumber())
    .pipe(sass())
    .pipe(postcss(plugins))
    .pipe(sourcemaps.write("."))
    .pipe(gulp.dest("./dist/assets/css"))
    .pipe(browserSync.stream())
}

function javascript() {
  return gulp
    .src("./src/js/*.js")
    .pipe(waits(800))
    .pipe(babel())
    .pipe(plumber())
    .pipe(uglify())
    .pipe(gulp.dest("./dist/assets/js"))
}

function scriptsJs() {
  return gulp
    .src([
      "node_modules/jquery/dist/jquery.min.js",
      "node_modules/popper.js/dist/umd/popper.min.js",
      "node_modules/bootstrap/dist/js/bootstrap.min.js",
    ])
    .pipe(concat("vendors.js"))
    .pipe(gulp.dest("./dist/assets/js/vendors"))
}

function server(done) {
  browserSync.init({
    proxy: "http://localhost/orange/megacable/mega-netflix/dist/",
  })
  done()
}

function watch() {
  gulp.watch("./src/sass/**/*.sass").on("all", css)
  gulp
    .watch("./src/js/*.js")
    .on("all", gulp.series(javascript, browserSync.reload))
  gulp.watch("./dist/**/**/*.php").on("all", browserSync.reload)
}

gulp.task("build", gulp.parallel(javascript, css))

gulp.task(
  "default",
  gulp.series("build", BootstrapCss, AosCss, scriptsJs, server, watch)
)
