module.exports = function (grunt) {
	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),

		sass: {
			dist: {
				options: {
					style: 'expanded', //compressed
					sourcemap: 'none',
					cacheLocation: 'sass/.cache-location',
				},
				files: [{
					'style.css': 'sass/style.scss',
				}],
			},
		},

		autoprefixer:{
			dist: {
				files: {
					'style.css': 'style.css',
				},
			},
		},

		watch: {
			options: {
				livereload: true,
			},
			scripts: {
				files: ['**/*.js'],
				tasks: ['jshint'],
			},
			css: {
				files: '**/*.scss',
				tasks: ['sass', 'autoprefixer'],
			},
		},

		jshint: {
			all: ['Gruntfile.js', 'scripts/scripts.js'],
		},
	});

	grunt.loadNpmTasks('grunt-contrib-sass');
	grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.loadNpmTasks('grunt-contrib-jshint');
	grunt.loadNpmTasks('grunt-autoprefixer');

	grunt.registerTask('default', ['watch']);
	grunt.registerTask('css', ['sass', 'autoprefixer']);
};