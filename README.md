<div align="center">
	<img width="160px" src="src/logo.png">
  	<h1>Codeigniter + viteJs</h1>
  	<p>Vitejs Integration For Codeigniter4</p>
	<p>
		<a href="https://github.com/firtadokei/codeigniter-vitejs/releases"><img src="https://custom-icon-badges.herokuapp.com/github/v/release/firtadokei/codeigniter-vitejs?logo=tag"></a>
		<img src="https://custom-icon-badges.herokuapp.com/packagist/stars/mihatori/codeignitervite?logo=star">
		<img src="https://badges.hiptest.com:/packagist/dt/mihatori/codeignitervite?color=%23c700ff&logo=packagist&logoColor=%23c700ff">
		<img src="https://custom-icon-badges.herokuapp.com/packagist/l/mihatori/codeignitervite?logo=law">
	</p>
</div>

Codeigniter vite is a package that aims to integrate [vitejs](https://vitejs.dev/) with [codeigniter4](https://codeigniter.com/) in a simple way.

## Features:
 - ⏱️ Almost zero configuration
 - 🧩 Easy to install and remove
 - 🔨 Easy to customize
 - ✌️ Support most used frameworks: `react`, `vue`, and `svlete`
 - 🔥 Enjoy hot module replacement (HMR)
 
## Installation:

```
composer require mihatori/codeignitervite
```

then from your project root, run:

```
php spark vite:init --framework <framework>
```

replace `<framework>` with `vue`, `react`, `svelte`, or `none`

or you can just run:

```
php spark vite:init
```

our body `spark` will handle the rest for you 🙃

💥 **That's it**
you can now run `npm install`, `npm run dev` and enjoy

## Uninitialize
You can run the following command to uninitialize it:

```
php spark vite:remove
```
then you can run `composer remove mihatori/codeignitervite` to remove it completely.

### additional:
You will find some new variables in your `.env` file, you can change them as you like.

## Contributing
All contributions are welcome, it doesn't matter whether you can code, write documentation, or help find bugs.
feel free to use issues tracker or pull requests

## What next?
More informations will be available as soon as possible ❤️.

## Support
Unfortunately, I don't drink coffee 💔, but you can star it instead 🙃

## License

MIT License &copy; 2022 [Mihatori Kei](https://github.com/firtadokei)
