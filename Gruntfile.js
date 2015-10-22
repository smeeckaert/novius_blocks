module.exports = function (grunt) {

    grunt.initConfig({
        sass       : {
            options: {
                sourceMap: true
            },
            dist   : {
                files: {
                    'static/css/admin/block.css': 'assets/sass/block.scss'
                }
            }
        },
        watch      : {
            //js        : {
            //    files: ['../src/**/*.js'],
            //    tasks: ['uglify']
            //},
            sass      : {
                files: ['assets/**/*.scss'],
                tasks: ['sass']
            }
        }
    });
    grunt.loadNpmTasks("grunt-sass");
    grunt.loadNpmTasks('grunt-contrib-watch');

    grunt.registerTask('default', ['watch']);

};