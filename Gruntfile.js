module.exports = function(grunt) {

	// Initializing the configuration object
	grunt.initConfig({

		// Task configuration
		copy: {  // copy bootstrap and jquery files
		    main: {
			    files: [
			    	{expand: true, cwd: './bower_components/jquery/', src: ['jquery.js'], dest: './wp-content/themes/setpress/js/'},
			    	{expand: true, cwd: './bower_components/bootstrap/dist/js/', src: ['bootstrap.js'], dest: './wp-content/themes/setpress/js/'},
			    	{expand: true, cwd: './bower_components/bootstrap/dist/css/', src: ['bootstrap.css'], dest: './wp-content/themes/setpress/css/'},
			    ]
		    },
		    init: {
			    files: [
			    	{expand: true, cwd: './bower_components/wordpress/', src: ['**'], dest: './'},
			    ]
		    }
		},
		less: {  // compile .less files
			dev: {
				options: {
					compress: false,  // set to true if you want to minify the result
				},
				files: {
					// compiling style.less into style.css
					'./wp-content/themes/setpress/style.css':'./wp-content/themes/setpress/less/style.less',
					// compiling bootstrap-theme.less into bootstrap-theme.css
					//'./wp-content/themes/setpress/css/bootstrap-theme.css':'./wp-content/themes/setpress/less/bootstrap-theme.less'
				}
			},
			prod: {
				options: {
					compress: true,  // set to true if you want to minify the result
				},
				files: {
					// compiling style.less into style.css
					'./wp-content/themes/setpress/style.css':'./wp-content/themes/setpress/less/style.less',
					// compiling bootstrap-theme.less into bootstrap-theme.css
					//'./wp-content/themes/setpress/css/bootstrap-theme.css':'./wp-content/themes/setpress/less/bootstrap-theme.less'
				}
			}
		},
		concat: {  // concatenate multiple files into one file
			options: {
				separator: ';',
			},
			theme_js: {
				src: [
				'./wp-content/themes/setpress/js/jquery.js',
				'./wp-content/themes/setpress/js/bootstrap.js',
				'./wp-content/themes/setpress/js/main.js'
				],
				dest: './wp-content/themes/setpress/js/production.js'
			}
		},
		uglify: {  // minify js files
			options: {
				mangle: false // Use if you want the names of your functions and variables unchanged
			},
			theme_js: {
				files: {
					'./wp-content/themes/setpress/js/production.js':'./wp-content/themes/setpress/js/production.js',
				}
			}
		},
		watch: {  // watch files and perform tasks after changes
			less: {
				files: ['./wp-content/themes/setpress/less/style.less'], // watched files
				tasks: ['less:dev'], // tasks to run
				options: {
					livereload: true // reloads the browser
				}
			}
		}
	});

	// Plugin loading
	grunt.loadNpmTasks('grunt-contrib-copy');
	grunt.loadNpmTasks('grunt-contrib-less');
	grunt.loadNpmTasks('grunt-contrib-concat');
	grunt.loadNpmTasks('grunt-contrib-uglify');
	grunt.loadNpmTasks('grunt-contrib-watch');

	// Task definition
	grunt.registerTask('default', ['watch']);
	grunt.registerTask('build', ['copy:init']); // run once after 'bower install' to copy wordpress core files
	grunt.registerTask('update', ['copy:main']); // run after 'bower update' to update jquery and bootstrap
	grunt.registerTask('prod', ['less:prod', 'concat', 'uglify']); // on production, concat and minify
};