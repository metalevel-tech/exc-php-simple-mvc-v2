# Additional explanations about the project structure

## Why here have dist/ and project/ directories?

The `project/` directory is presented because the main guide of the project ["Build PHP MVC Framework from Scratch"](https://www.youtube.com/watch?v=WKy-N0q3WRo&list=PLLQuc_7jk__Uk_QnJMPndbdKECcTEwTA1) uses it. The `dist/` directory is presented because some guides as [Bootstrap 5.2 Webpack](https://getbootstrap.com/docs/5.2/getting-started) uses it.

So at the moment I decided to save my time and have created the `dist/` directory as sym-link to the `project/` directory. It is not a good idea to have a sym-link in the repository, but I will decide later which way to go.

## What is the meaning of the /dist directory in open source projects?

*Answer of the question provided by [Vadorequest at Stack Overflow](https://stackoverflow.com/a/22844164/6543935):*

**`/dist` means "distributable", the compiled code/library.**

Folder structure varies by build system and programming language. Here are some standard conventions:

* `src/`: "source" files to build and develop the project. This is where the original source files are located, before being compiled into fewer files to `dist/`, `public/` or `build/`.
* `dist/`: "distribution", the compiled code/library, also named `public/` or `build/`. The files meant for production or public use are usually located here.

  There may be a slight difference between these three:

  * `build/`: is a compiled version of your `src/` but not a production-ready.
  * `dist/`: is a production-ready compiled version of your code.
  * `public/`: usually used as the files runs on the browser. which it may be the server-side JS and also include some HTML and CSS.

* `assets/`: static content like images, video, audio, fonts etc.
* `lib/`: external dependencies (when included directly).
* `test/`: the project's tests scripts, mocks, etc.
* `node_modules/`: includes libraries and dependencies for JS packages, used by Npm.
* `vendor/`: includes libraries and dependencies for PHP packages, used by Composer.
* `bin/`: files that get added to your PATH when installed.

Markdown/Text Files:

* `README.md`: A help file which addresses setup, tutorials, and documents the project. `README.txt` is also used.
* `LICENSE.md`: any [rights](https://choosealicense.com/no-permission/) given to you regarding the project. `LICENSE` or `LICENSE.txt` are variations of the license file name, having the same contents.
* `CONTRIBUTING.md`: how to [help out](https://github.com/blog/1184-contributing-guidelines) with the project. Sometimes this is addressed in the `README.md` file.

Specific (these could go on forever):

* `package.json`: defines libraries and dependencies for JS packages, used by Npm.
* `package-lock.json`: specific version lock for dependencies installed from `package.json`, used by Npm.
* `composer.json`: defines libraries and dependencies for PHP packages, used by Composer.
* `composer.lock`: specific version lock for dependencies installed from `composer.json`, used by Composer.
* `gulpfile.js`: used to define functions and tasks to be run with Gulp.
* `.travis.yml`: configuration file for the [Travis CI](https://travis-ci.com) environment.
* `.gitignore`: Specification of the files meant [to be ignored](https://help.github.com/articles/ignoring-files/) by Git.
