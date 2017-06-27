'use strict';

module.exports = function(grunt) {

    // Project configuration.
    grunt.initConfig({
        // Metadata.
        pkg: grunt.file.readJSON('package.json'),
        banner: '/*! <%= pkg.title || pkg.name %> - v<%= pkg.version %> - ' + '<%= grunt.template.today("yyyy-mm-dd") %>\n' + '<%= pkg.homepage ? "* " + pkg.homepage + "\\n" : "" %>' + '* Copyright (c) <%= grunt.template.today("yyyy") %> <%= pkg.author.name %>;' + ' Licensed <%= _.pluck(pkg.licenses, "type").join(", ") %> */\n',
        // Task configuration.
        // -- clean Config ---------------------------------------------------------
        clean: {
            files: ['dist']
        },

        // -- concat Config ---------------------------------------------------------
        concat: {
            options: {
                banner: '<%= banner %>',
                stripBanners: true
            },
            dist: {
                src: ['src/<%= pkg.name %>.js'],
                dest: 'dist/<%= pkg.name %>.js'
            },
        },

        // -- uglify Config ---------------------------------------------------------
        uglify: {
            options: {
                banner: '<%= banner %>'
            },
            dist: {
                src: '<%= concat.dist.dest %>',
                dest: 'dist/<%= pkg.name %>.min.js'
            },
        },

        // -- jshint Config ---------------------------------------------------------
        jshint: {
            gruntfile: {
                options: {
                    jshintrc: '.jshintrc'
                },
                src: 'Gruntfile.js'
            },
            src: {
                options: {
                    jshintrc: 'src/.jshintrc'
                },
                src: ['src/**/*.js']
            }
        },

        // -- watch Config ---------------------------------------------------------
        watch: {
            gruntfile: {
                files: '<%= jshint.gruntfile.src %>',
                tasks: ['jshint:gruntfile']
            },
            src: {
                files: '<%= jshint.src.src %>',
                tasks: ['jshint:src', 'qunit']
            }
        },

        // -- jsbeautifier Config ---------------------------------------------------------
        jsbeautifier: {
            files: ["Gruntfile.js", "src/**/*.js"],
            options: {
                "indent_size": 4,
                "indent_char": " ",
                "indent_level": 0,
                "indent_with_tabs": true,
                "preserve_newlines": true,
                "max_preserve_newlines": 10,
                "jslint_happy": false,
                "brace_style": "collapse",
                "keep_array_indentation": false,
                "keep_function_indentation": false,
                "space_before_conditional": true,
                "eval_code": false,
                "indent_case": false,
                "unescape_strings": false
            }
        },

        // -- less Config ---------------------------------------------------------
        less: {
            dist: {
                files: {
                    'demo/css/asSwitch.css': 'less/asSwitch.less'
                }
            }
        },

        // -- autoprefixer Config ---------------------------------------------------------
        autoprefixer: {
            options: {
                browsers: ['last 2 versions', 'ie 8', 'ie 9', 'android 2.3', 'android 4', 'opera 12']
            },
            src: {
                src: ['demo/css/asSwitch.css'],
            }
        },

        // -- replace Config ---------------------------------------------------------
        replace: {
            bower: {
                src: ['bower.json'],
                overwrite: true, // overwrite matched source files
                replacements: [{
                    from: /("version": ")([0-9\.]+)(")/g,
                    to: "$1<%= pkg.version %>$3"
                }]
            },
            jquery: {
                src: ['asSwitch.jquery.json'],
                overwrite: true, // overwrite matched source files
                replacements: [{
                    from: /("version": ")([0-9\.]+)(")/g,
                    to: "$1<%= pkg.version %>$3"
                }]
            },
        }
    });

    // Load npm plugins to provide necessary tasks.
    require('load-grunt-tasks')(grunt, {
        pattern: ['grunt-*']
    });

    // Default task.
    grunt.registerTask('default', ['js', 'dist']);

    grunt.registerTask('dist', ['clean', 'concat', 'uglify']);

    grunt.registerTask('js', ['jsbeautifier', 'jshint']);
    grunt.registerTask('css', ['less', 'autoprefixer']);

    grunt.registerTask('version', [
        'replace:bower',
        'replace:jquery'
    ]);

};
