<script>
import svelteLogo from "@/svelte.svg";

let count = 0;
const increment =
	() => {
		count += 1;
	};
</script>

<main>
	<div
		class="container">
		<div
			class="logos">
			<img
				src="https://github.com/firtadokei/codeigniter-vitejs/raw/master/src/logo.png"
				class="logo"
				alt="Codeigniter vite logo" />
			<img
				src={svelteLogo}
				class="logo"
				alt="Svelte logo" />
		</div>
		<h2>
			Codeigniter
			Vite
			+
			Svelte
		</h2>
		<p>
			<button
				on:click={increment}
				>Count
				is
				{count}</button>
		</p>
		<p>
			Edit
			resources/App.svelte
			to
			test
			HMR
		</p>
	</div>
</main>

<style>
</style>
