<div align="center">
	<img width="160px" src="src/logo.png">
  	<h1>Codeigniter + viteJs</h1>
  	<p>Vitejs Integration For Codeigniter4</p>
</div>

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

our body ```spark``` will handle the rest for you 🙃

💥 **That's it**
you can now run `npm install`, `npm run dev` and enjoy your time

## Uninitialize
You can run the following command to uninitialize it:

```
php spark vite:remove
```
then you can run ``` composer remove mihatori/codeignitervite ``` to remove it completely.

## What next?
More informations will be available as soon as possible ❤️.

### additional:
You will find som new vaiables in your .env file, you can change them as you like.

## License

MIT License &copy; 2022 [Mihatori Kei](https://github.com/firtadokei)
