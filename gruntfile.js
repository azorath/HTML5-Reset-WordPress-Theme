// Make grunt work
// ===========================
// 1. Install node.js (http://nodejs.org/)
// 2. $ npm install -g grunt-cli
// 3. goto project where package.json is located
// 4. $ npm install (HINT: CHECK VERSIONS IN PACKAGE.JSON AND UPDATE IF AVAILABLE)
// 5. run 'default' grunt task => $ grunt
// 6. run specific task (e.g. 'watch') => grunt watch


module.exports = function(grunt) {

  var enviroment = 'production'; // production, development

  // Project configuration.
  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),





    /********************\
    * Uglify
    \********************/
    uglify: {
      production: {
        options: {
          mangle: true,
          compress: {
            drop_console: true
          }
        },
        files: {
          '_/js/app.min.js': [
            // include
            'source/js/frameworks/**/*.js',
            'source/js/plugins/**/*.js',
            'source/js/project.js',
            'source/js/behaviours/**/*.js',

            // exclude
            '!source/js/plugins/html5shiv.js',
            '!source/js/plugins/html5shiv-printshiv.js'
          ]
        }
      },

      development: {
        options: {
          mangle: false,
          compress: false,
          beautify: true
        },
        files: {
          '_/js/app.min.js': [
            // include
            'source/js/frameworks/**/*.js',
            'source/js/plugins/**/*.js',
            'source/js/project.js',
            'source/js/behaviours/**/*.js',

            // exclude
            '!source/js/plugins/html5shiv.js',
            '!source/js/plugins/html5shiv-printshiv.js'
          ]
        }
      }
    },





    /********************\
    * Watch
    \********************/
    watch: {
      // CSS
      css: {
        files: 'source/css/**/*.scss',
        tasks: 'css'
      },

      // JavaScript
      js: {
        files: 'source/js/**/*.js',
        tasks: 'js'
      },
    },





    /********************\
    * Sass Globbing
    \********************/
    sass_globbing: {
      all: {
        files: {
          'source/css/_02-mixins-functions.scss': 'source/css/mixins-functions/*.scss',
          'source/css/_08-plugins.scss': 'source/css/plugins/*.scss',
          'source/css/_10-modules.scss': 'source/css/modules/*.scss',
          'source/css/_11-custom.scss': 'source/css/custom/*.scss'
        }
      }
    },





    /********************\
    * Sass
    \********************/
    sass: {
      // Production
      production: {
        options: {
          sourcemap: 'none',   // auto, file, inline, none
          style: 'compressed'  // nested, compact, compressed, expanded
        },
        files: {
          '_/css/main.css': 'source/css/00-main.scss'
        }
      },

      // Development
      development: {
        options: {
          style: 'expanded'  // nested, compact, compressed, expanded
        },
        files: {
          '_/css/main.css': 'source/css/00-main.scss'
        }
      },
    },





    /********************\
    * Autoprefixer
    \********************/
    autoprefixer: {
      // Production
      production: {
        options: {
          cascade: false
        },
        src: '_/css/main.css',
        dest: '_/css/main.css'
      },

      // Development
      development: {
        options: {
          cascade: true
        },
        src: '_/css/main.css',
        dest: '_/css/main.css'
      }
    },





    /********************\
    * Delete files
    \********************/
    clean: {
      // Production
      production: 'deploy',

      // Development
      development: '!deploy'
    },




    /********************\
    * Copy files
    \********************/
    copy: {
      // Images
      images: {
        files: [
          {
            expand: true,
            src: [
              '**/*',
              '!PSD/**/*'
            ],
            dest: '_/images/',
            cwd: 'source/images/'
          }
        ],
      },


      // Webfonts
      webfonts: {
        files: [
          {
            expand: true,
            src: [
              '**/*.woff',
              '**/*.woff2',
              '**/*.ttf',
              '!**/source/**/*',
              '!**/src/**/*',
            ],
            dest: '_/webfonts',
            cwd: 'source/webfonts/',
            filter: 'isFile'
          }
        ],
      },


      // JS
      js: {
        files: [
          {
            expand: true,
            src: [
              '!*',
              'html5shiv.js',
              'html5shiv-printshiv.js'
            ],
            dest: '_/js',
            cwd: 'source/js/plugins/',
            filter: 'isFile'
          }
        ],
      }
    }





  });





  /********************\
  * Load plugins
  \********************/
  grunt.loadNpmTasks('grunt-contrib-uglify');   // minify JS
  grunt.loadNpmTasks('grunt-contrib-watch');    // watch files and start task on save
  grunt.loadNpmTasks('grunt-sass-globbing');    // glob scss files
  grunt.loadNpmTasks('grunt-sass');             // create css from scss files
  grunt.loadNpmTasks('grunt-autoprefixer');     // prefix css
  grunt.loadNpmTasks('grunt-contrib-clean');    // before production task, delete deploy folder
  grunt.loadNpmTasks('grunt-contrib-copy');     // copy files from source to deploy folder
  grunt.loadNpmTasks('grunt-newer');            // only process modified files





  /********************\
  * Tasks
  \********************/
  grunt.registerTask('default', [
    'clean:'+enviroment,
    // css
    'sass_globbing',
    'sass:'+enviroment,
    'autoprefixer:'+enviroment,
    // js
    'uglify:'+enviroment,
    'copy:js',
    // copy other files
    'copy:images',
    'copy:webfonts'
  ]);

  grunt.registerTask('css', ['newer:sass_globbing', 'sass:'+enviroment, 'autoprefixer:'+enviroment]);
  grunt.registerTask('js', 'uglify:'+enviroment);
};
