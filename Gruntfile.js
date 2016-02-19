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
					'customizer.css': 'sass/customizer.scss',
				}],
			},
		},

		autoprefixer:{
			dist: {
				files: {
					'style.css': 'style.css',
					'customizer.css': 'customizer.css',
				},
			},
		},

		watch: {
			options: {
				livereload: 35729,
			},
			css: {
				files: '*/*.scss',
				tasks: ['sass', 'autoprefixer'],
			},
		},
	});

	grunt.loadNpmTasks('grunt-contrib-sass');
	grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.loadNpmTasks('grunt-autoprefixer');
	grunt.loadNpmTasks('grunt-livereload');
	grunt.registerTask('default', ['watch']);
	grunt.registerTask('css', ['sass', 'autoprefixer']);
};