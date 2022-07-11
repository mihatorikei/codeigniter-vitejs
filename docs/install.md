# Installation


>  IMPORTANT: 🚧 THIS DOCUMENTATION IS NOT YET COMPLETE (UNSTABLE) 🚧




These instructions assume that you have already installed [composer](https://getcomposer.org/download/) and [CodeIgniter 4 app starter](https://codeigniter.com/user_guide/installation/installing_composer.html).

from your project root run:
```
composer require mihatori/codeignitervite
```

then:
```
php spark vite:init
```

or
```
php spark vite:init --framework <framework>
```
replace `<framework>` with `vue`, `react`, `svelte` or `none`.

That's all, you can now run `npm install`, `npm run dev` and start coding.

## What happened?

no need to explain composer command, but `php spark vite:init` did the hardest part.

let's make it clear:

- Generated `vite.config.js`, `package.json` in your project root.
- Created a `resources` folder in you project root with the following files:
    - `main.js` - your frontend entry file.
    - Main component eg: `App.vue`, `App.svelte`, `App.jsx` depends on the framework you selected.
- Added some useful variables in your `.env` file, make sure to check them out.
