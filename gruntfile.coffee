module.exports = (grunt) ->

  grunt.initConfig
    pkg: grunt.file.readJSON 'package.json'

    sass:
      options:
        style: 'expanded'
        sourcemap: true
      dist:
        files: 
          'laravel/public/assets/css/style.css' : 'laravel/public/assets/css/style.scss'

    autoprefixer:
      options:
        browsers: ['last 10 version']
        src: 'laravel/public/assets/css/style.css'

    watch:      
      files: ['laravel/public/assets/css/*.scss']
      tasks: ['sass', 'autoprefixer']
      options:
        nospawn: true
        interrupt: true


  grunt.loadNpmTasks 'grunt-contrib-watch'
  grunt.loadNpmTasks 'grunt-autoprefixer'
  grunt.loadNpmTasks 'grunt-sass'

  grunt.registerTask 'default', ['sass','watch']
