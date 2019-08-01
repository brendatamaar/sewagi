
module.exports = function(grunt){
  grunt.initConfig({
    // sass:{
  	// 	dist: {
  	// 		files: {
  	// 			'assets/css/app.css': '../../resources/sass/app.scss'
  	// 		}
  	// 	}
    // },
    // uglify: {
    //   build: {
    //     files: {
    //       'build/js/app.min.js': ['src/js/*.js']
    //     }
    //   }
    // },
    codekit: {
      files: {
        src: ['kit/**/*.kit'],
        dest: '../build/'
      }
    },
    watch: {
      // scss: {
      //   files: ['../../**/*.scss'],
      //   tasks: ['sass']
      // },
      // uglify: {
      //   files: ['src/js/*.js'],
      //   tasks: ['uglify']
      // },
      codekit: {
        files: ['**/*.kit'],
        tasks: ['codekit']
      },
    }
  });

  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-contrib-sass');
  grunt.registerTask('default', ['watch']);
  require('load-grunt-tasks')(grunt);
}
