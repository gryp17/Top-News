module.exports = function (grunt) {

	//load modules
	grunt.loadNpmTasks("grunt-bower-install-simple");
	grunt.loadNpmTasks("grunt-contrib-concat");
	grunt.loadNpmTasks("grunt-contrib-copy");
	grunt.loadNpmTasks("grunt-contrib-uglify");
	grunt.loadNpmTasks("grunt-contrib-watch");

	//project configuration.
	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),
		//bower install
		'bower-install-simple': {
			options: {
				color: true,
				directory: "bower_components"
			},
			dev: {
				options: {
					production: false
				}
			}
		},
		//concat
		concat: {
			js_libs: {
				files: {
					'include/js/lib.js': [
						'bower_components/jquery/dist/jquery.min.js',
						'bower_components/jquery-ui/jquery-ui.min.js',
						'bower_components/bootstrap/dist/js/bootstrap.min.js',
						'bower_components/angular/angular.min.js',
						'bower_components/angular-route/angular-route.min.js',
						'bower_components/angular-sanitize/angular-sanitize.min.js',
						'bower_components/angular-animate/angular-animate.min.js'
					]
				}
			},
			css_libs: {
				files: {
					'include/css/lib.css': [
						'bower_components/jquery-ui/themes/redmond/jquery-ui.min.css',
						'bower_components/bootstrap/dist/css/bootstrap.min.css',
					]
				}
			}
		},
		//copy
		copy: {
			'jquery-ui': {
				files: [
					{
						dest: 'include/css/images/',
						src: 'bower_components/jquery-ui/themes/redmond/images/*',
						flatten: true,
						expand: true
					}
				]
			},
			bootstrap: {
				files: [
					{
						dest: 'include/fonts/',
						src: 'bower_components/bootstrap/dist/fonts/*',
						flatten: true,
						expand: true
					}
				]
			}
		},
		//uglify
		uglify: {
			options: {
				mangle: false
			},
			my_target: {
				files: {
					'include/js/top-news.js': [
						'app/app.js',
						'app/services/API_service.js',
						'app/services/search_service.js',
						'app/filters/custom_filters.js',
						'app/directives/scroll_top.js',
						'app/controllers/home.js',
						'app/controllers/archive.js',
						'app/controllers/articles.js',
						'app/controllers/article.js',
						'app/controllers/search.js'
					]
				}
			}
		},
		//watch
		watch: {
			app_files: {
				files: ['app/**/*.js'],
				tasks: ['uglify'],
				options: {
					spawn: false,
					interrupt: true
				}
			}
		}
	});


	//register get-dependencies task
	grunt.registerTask('get-dependencies', [
		'bower-install-simple',
		'concat',
		'copy',
		'uglify'
	]);


};

