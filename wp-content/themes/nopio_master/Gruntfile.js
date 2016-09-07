'use strict';
var Promise = require('es6-promise').Promise;
module.exports = function(grunt) {

    grunt.initConfig({

        // let us know if our JS is sound
        jshint: {
            options: {
                "bitwise": true,
                "browser": true,
                "curly": true,
                "eqeqeq": true,
                "eqnull": true,
                "es5": false,
                "esnext": true,
                "immed": true,
                "jquery": true,
                "latedef": true,
                "newcap": true,
                "noarg": true,
                "node": true,
                "strict": false,
                "trailing": false,
                "undef": true,
                "globals": {
                    "jQuery": true,
                    "alert": true,
                }
            },
            all: [
                'sources/js/functions.js'
            ]
        },

        // concatenation and minification all in one
        uglify: {
            dist: {
                files: {
                    'js/script.min.js': [
                        'sources/js/bootstrap.js',
                        'sources/js/functions.js'
                    ]
                }
            }
        },

        sass: {
            dist: {
                options: {
                    style: 'compressed',
                    require: 'susy'
                },
                files: [{
                    expand: true,
                    cwd: 'sources/css',
                    src: ['*.scss'],
                    dest: 'css',
                    ext: '.css'
                }]
            }
        },

        watch: {
            sass: {
                files: [
                    'sources/css/*',
                    'sources/css/**/*'
                ],
                tasks: ['sass:dist', 'postcss', 'notify'],
                options: {
                    livereload: false
                }
            },
            js: {
                files: [
                    '<%= jshint.all %>'
                ],
                tasks: ['jshint', 'uglify', 'notify'],
                options: {
                    livereload: false
                }
            }
        },

        postcss: {
          options: {
            map: false,
            processors: [
              require('autoprefixer')({browsers: ['last 2 versions', 'ie 9']})
            ]
          },
          dist: {
            src: 'css/*.css'
          }
        },

        notify: {
            watch:{
                options:{
                    title: "Build complete",
                    message: "Build complete"
                }
            }
        }

    });

    grunt.loadNpmTasks('grunt-contrib-jshint');
    grunt.loadNpmTasks('grunt-contrib-sass');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-postcss');
    grunt.loadNpmTasks('grunt-notify');

    grunt.registerTask('default', [
        'jshint',
        'sass',
        'postcss',
        'uglify',
        'watch'
    ]);

    grunt.registerTask('build', [
      'jshint',
      'sass',
      'postcss',
      'uglify'
    ]);

};
