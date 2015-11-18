module.exports = function(grunt) {
	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),
		uglify: {
			options: {
				banner: '/*! <%= pkg.name %> - v<%= pkg.version %> - ' +
					'<%= grunt.template.today("yyyy-mm-dd") %> */'
			},
			dist: {
				files: {
					'static/js/scripts.min.js': [
					'_dev/js/plugins.js',
					'_dev/js/main.js'
					]
				}
			}
		},
		sass: {
			options: {
            	sourceMap: true
        	},
			dev: {
				files: {
					'_dev/css/main.css': '_dev/scss/main.scss'
				}
			},
			dist: {
				files: {
					'static/css/main.min.css': ['_dev/scss/main.scss']
				}
			}
		},
		postcss: {
            options: {
                map: true,
                processors: [
                    require('autoprefixer')({
                        browsers: ['last 2 versions']
                    })
                ]
            },
            dist: {
                src: 'static/css/*.css'
            }
        },
		watch: {
			sass: {
				files: ['_dev/scss/*'],
				tasks: 'sass'
			},
			uglify: {
				files: ['_dev/js/*'],
				tasks: 'uglify'
			}
		},
		copy: {
			dist: {
				files: [
					{expand: true, cwd: '_dev/js/vendor', src: ['*'], dest: 'static/js/vendor/'},
					{expand: true, cwd: '_dev/img/', src: ['*'], dest: 'static/img/'},
					{expand: true, cwd: '_dev/fonts/', src: ['*'], dest: 'static/fonts/'}
				]
			}
		},
		targethtml: {
			dist: {
				files: {
					'footer.php' : '_dev/footer.php',
					'functions.php' : '_dev/functions.php',
					'header.php' : '_dev/header.php',
					'index.php' : '_dev/index.php',
					'home.php' : '_dev/home.php',
					'single.php' : '_dev/single.php', 
					'sidebar.php' :'_dev/sidebar.php',
					'search.php' : '_dev/search.php',
					'page.php' :'_dev/page.php',
					'author.php' :'_dev/author.php',
					'archive.php' : '_dev/archive.php',
					'404.php' : '_dev/404.php'
				}
			}
		}
	});
	
	grunt.loadNpmTasks('grunt-sass');
	grunt.loadNpmTasks('grunt-postcss');
	grunt.loadNpmTasks('grunt-contrib-uglify');
	grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.loadNpmTasks("grunt-contrib-copy");
	grunt.loadNpmTasks('grunt-targethtml');
	grunt.registerTask('default', ['sass', 'watch', 'postcss']);
	grunt.registerTask('build', ['sass', 'postcss','uglify', 'copy', 'targethtml']);
};
