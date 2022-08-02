<script>
	import logo from '$lib/svelte.webp'
	let count = 0
</script>

<svelte:head>
	<title>Home - CodeIgniter SvelteKit</title>
	<meta name="description" content="SvelteKit + CodeIgniter demo app" />
</svelte:head>

<section>
		<div>
			<img src="{logo}" class="logo" alt="Svelte logo" />
			<img src="https://github.com/firtadokei/codeigniter-vitejs/raw/master/src/logo.png" class="logo" alt="Codeigniter vite logo" />
		</div>
		<h2>Codeigniter Vite + SvelteKit</h2>
		<p>
			<button on:click={() => count++}>Count { count }</button>
		</p>
		<p>
			try editing <strong>src/routes/index.svelte</strong> to test HMR
		</p>
</section>

<style>

</style>
