var gulp = require("gulp");
var ts = require("gulp-typescript");
var tsProject = ts.createProject("tsconfig.json");

var paths = {
  script:['src/**/*']
};

gulp.task("default", function () {
  return tsProject.src().pipe(tsProject()).js.pipe(gulp.dest("dist"));
});

gulp.watch(paths.script, function(){
  return tsProject.src().pipe(tsProject()).js.pipe(gulp.dest("dist"));
});