'use strict';
var gulp = require( 'gulp' ),
    autoprefixer = require( 'gulp-autoprefixer' ),
    concat = require( 'gulp-concat' ),
    csso = require( 'gulp-csso' ),
    del = require( 'del' ),
    imagemin = require( 'gulp-imagemin' ),
    plumber = require( 'gulp-plumber' ),
    pngquant = require( 'imagemin-pngquant' ),
    pug = require( 'gulp-pug' ),
    rename = require( 'gulp-rename' ),
    stylus = require( 'gulp-stylus' ),
    uglify = require( 'gulp-uglify' );

var browserSync = require( 'browser-sync' ).create(),
    reload = browserSync.reload;

var paths = {
  clean: {
    app: [ './app/assets/css', './app/assets/js', './app/*.html' ],
    dist: './dist'
  },
  watch: {
    html: './app/pug/**/*.pug',
    css: [
      './app/blocks/**/*.styl',
      './app/config/**/*.styl'
    ],
    js: './app/common.blocks/**/*.js'
  },
  app: {
    html: {
      src: './app/pug/pages/*.pug',
      dest: './app'
    },
    common: {
      css: {
        src: [
          './app/config/fonts.styl',
          './app/config/vars.styl',
          './app/config/reset.styl',
          './app/blocks/**/*.styl'
        ],
        dest: './app/assets/css'
      },
      js: {
        src: './app/blocks/**/*.js',
        dest: './app/assets/js'
      }
    },
    vendor: {
      jquery: {
        src: './app/vendor/jquery/dist/jquery.min.js',
        dest: './app/libs/js'
      }
    }
  },
  img: {
    src: './app/assets/images/**/*.*',
    dest: './dist/assets/images'
  },
  dist: {
    html: {
      src: './app/*.html',
      dest: './dist'
    },
    css: {
      src: './app/assets/css/common.min.css',
      dest: './dist/assets/css'
    },
    js: {
      src: './app/assets/js/common.min.js',
      dest: './dist/assets/js'
    },
    fonts: {
      src: './app/assets/fonts/**/*.*',
      dest: './dist/assets/fonts'
    },
    libs: {
      src: './app/libs/**/*.*',
      dest: './dist/libs'
    }
  }
}

gulp.task( 'serve', function() {
  browserSync.init( {
    server: './app'
  } );
  gulp.watch( paths.watch.html, gulp.series( 'html' ) );
  gulp.watch( paths.watch.css, gulp.series( 'cssCommon' ) );
  gulp.watch( paths.watch.js, gulp.series( 'jsCommon' ) );
  gulp.watch( '*.html' ).on( 'change', reload );
});

gulp.task( 'html', function () {
  return gulp.src( paths.app.html.src )
    .pipe( plumber() )
    .pipe( pug( { pretty: true } ) )
    .pipe( gulp.dest( paths.app.html.dest ) )
    .pipe(browserSync.stream() );
});

gulp.task( 'cssCommon', function() {
  return gulp.src( paths.app.common.css.src )
    .pipe( plumber() )
    .pipe( concat( 'common.styl' ) )
    .pipe( stylus() )
    .pipe( autoprefixer() )
    .pipe( gulp.dest( paths.app.common.css.dest ) )
    .pipe( rename( { suffix: '.min' } ) )
    .pipe( csso() )
    .pipe( gulp.dest( paths.app.common.css.dest ) )
    .pipe( browserSync.stream() );
});

gulp.task( 'jsCommon', function() {
  return gulp.src( paths.app.common.js.src )
    .pipe( plumber() )
    .pipe( concat( 'common.js' ) )
    .pipe( gulp.dest( paths.app.common.js.dest ) )
    .pipe( rename( {suffix: '.min'} ) )
    .pipe( uglify() )
    .pipe( gulp.dest( paths.app.common.js.dest ) )
    .pipe( browserSync.stream() );
});

gulp.task( 'jquery', function () {
  return gulp.src( paths.app.vendor.jquery.src )
    .pipe( gulp.dest( paths.app.vendor.jquery.dest ) );
});

gulp.task( 'cleanApp', function() {
  return del( paths.clean.app );
});

gulp.task( 'cleanDist', function() {
  return del( paths.clean.dist );
});

gulp.task( 'img', function() {
  return gulp.src( paths.img.src )
    .pipe( imagemin( { use: [ pngquant() ] } ) )
    .pipe( gulp.dest( paths.img.dest ) );
});

gulp.task( 'dist', function () {
  var htmlDist = gulp.src( paths.dist.html.src )
      .pipe( gulp.dest( paths.dist.html.dest ) );
  var cssDist = gulp.src( paths.dist.css.src )
      .pipe( gulp.dest( paths.dist.css.dest ) );
  var jsDist = gulp.src( paths.dist.js.src )
      .pipe( gulp.dest( paths.dist.js.dest ) );
  var fontsDist = gulp.src( paths.dist.fonts.src )
      .pipe( gulp.dest( paths.dist.fonts.dest ) );
  var libsDist = gulp.src( paths.dist.libs.src )
      .pipe( gulp.dest( paths.dist.libs.dest ) );
  return htmlDist, cssDist, jsDist, fontsDist, libsDist;
});

gulp.task( 'build', gulp.parallel( 'html', 'cssCommon', 'jsCommon', 'jquery' ) );

gulp.task( 'default', gulp.series( 'build', 'serve' ) );

gulp.task( 'public', gulp.series( 'cleanDist', 'img', 'dist' ) );
