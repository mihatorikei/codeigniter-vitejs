<div align="center">
	<img width="160px" src="src/logo.png">
  	<h1>Codeigniter + viteJs</h1>
  	<p>Vitejs Integration For Codeigniter4</p>
	<p><strong>(v2 beta)</strong></p>
	<p>
		<a href="https://github.com/firtadokei/codeigniter-vitejs/releases">
			<img src="https://custom-icon-badges.herokuapp.com/github/v/release/firtadokei/codeigniter-vitejs?logo=tag">
		</a>
		<img src="https://custom-icon-badges.herokuapp.com/packagist/stars/mihatori/codeignitervite?logo=star">
		<a href="https://packagist.org/packages/mihatori/codeignitervite">
			<img src="https://badges.hiptest.com:/packagist/dt/mihatori/codeignitervite?color=%23c700ff&logo=packagist&logoColor=%23c700ff">
		</a>
		<a href="LICENSE">
			<img src="https://custom-icon-badges.herokuapp.com/packagist/l/mihatori/codeignitervite?logo=law">
		</a>
	</p>
</div>

Codeigniter vite is a package that aims to integrate [vitejs](https://vitejs.dev/) with [codeigniter4](https://codeigniter.com/) in a simple way.

## Features:
 - ⏱️ Almost zero configuration
 - 🧩 Easy to install and remove
 - 🔨 Easy to customize
 - ✌️ Support most used frameworks: `react`, `vue`, `svlete` and **`SvelteKit`** 🎉
 - 🔥 Enjoy hot module replacement (HMR)
 
## Installation:

> if you are using v1, please make sure to remove it first.

```
composer require mihatori/codeignitervite:2.0.0-beta
```

then from your project root, run:

```
php spark vite:init --framework <framework>
```

replace `<framework>` with `vue`, `react`, `svelte`, `sveltekit` or `none`

or you can just run:

```
php spark vite:init
```

our body `spark` will handle the rest for you 🙃

## Getting Started:
- Install your node dependencies: `npm install`
- Start vite server: `npm run dev`
- Start CI server: `php spark serve` or access it through your virtual host.
- That's all =)

> **NOTE:**
> 
> `npm run dev` is not where you should work, it main purpose is to serve assets, such as scripts or stylesheets.
> once you build your files, it becomes useless
> but as long as it running, the package will use it instead of the bundled files.
> So make sure to **access your project** from ci server or a vitual host.

## Build your files:

to bundle your files, run: 
```
npm run build
```
this command will generate the bundled assets in your public directory. 
but as we said before, as long as vite server is running, the package will use it instead of bundled files, so make sure to stop it when you're done developing.

## Uninitialize:

`composer remove mihatori/codeignitervite` command will remove the package, but the generated files will remain there (package.json, vite.config.js ...etc).
so to avoid that, make sure to run the following command first:

```
php spark vite:remove
```
This command will do the following:
- delete `package.json`, `packages.lock.json` and `vite.config.js`.
- delete `resources` folder.
- And finally restore your `.env` file.

## 🔥 Need a quick start?
Check out our starter apps for [svelte](https://github.com/firtadokei/ci-svelte-appstarter) and [vue](https://github.com/firtadokei/ci-vue-appstarter).

<a href="https://github.com/firtadokei/ci-svelte-appstarter">
	<img width="120px" src="https://github.com/firtadokei/ci-svelte-appstarter/raw/master/ci-svelte.webp">
</a>
<a href="https://github.com/firtadokei/ci-vue-appstarter">
	<img width="120px" src="https://github.com/firtadokei/ci-vue-appstarter/raw/master/ci-vue.webp">
</a> 

## Contributing
All contributions are welcome, it doesn't matter whether you can code, write documentation, or help find bugs.
feel free to use issues or pull requests.

## Support
Unfortunately, I don't drink coffee 💔, but you can star it instead 🙃

## License

MIT License &copy; 2022 [Mihatori Kei](https://github.com/firtadokei)
