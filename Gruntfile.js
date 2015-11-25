module.exports = function(grunt) {
	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),
		uglify: {
			options: {
				banner: '/*! <%= pkg.name %> - v<%= pkg.version %> - ' +
					'<%= grunt.template.today("yyyy-mm-dd") %> */'
			},
			dev: {
				files: {
					'static/js/scripts.min.js': [
					'_dev/js/plugins/*.js',
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
					'static/css/main.min.css': '_dev/scss/main.scss'
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
            dev: {
                src: 'static/css/*.css'
            }
        },
        jshint: {
	    	dev: {
	    		src: ['_dev/js/main.js']
	    	}
	  	},
		watch: {
			sass: {
				files: ['_dev/scss/**'],
				tasks: ['sass', 'postcss'],
			},
			jshint: {
				files: ['_dev/js/main.js'],
				tasks: 'jshint',
			},
			uglify: {
				files: ['_dev/js/*'],
				tasks: 'uglify',
			},
			copy: {
				files: ['_dev/dev-templates/*', '_dev/*.php'],
				tasks: 'copy',
			}
		},
		copy: {
			dev: {
				files: [
					{expand: true, cwd: '_dev/js/vendor', src: ['*'], dest: 'static/js/vendor/'},
					{expand: true, cwd: '_dev/img/', src: ['*'], dest: 'static/img/'},
					{expand: true, cwd: '_dev/fonts/', src: ['*'], dest: 'static/fonts/'},
					{expand: true, cwd: '_dev/dev-templates/', src: ['*'], dest: 'templates/'},
					{expand: true, cwd: '_dev/', src: '*.php', dest: './'}
				]
			}
		}
	});
	
	grunt.loadNpmTasks('grunt-sass');
	grunt.loadNpmTasks('grunt-postcss');
	grunt.loadNpmTasks('grunt-contrib-uglify');
	grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.loadNpmTasks('grunt-contrib-copy');
	grunt.loadNpmTasks('grunt-contrib-jshint');
	grunt.registerTask('build', ['sass', 'postcss', 'jshint', 'uglify', 'copy']);
};