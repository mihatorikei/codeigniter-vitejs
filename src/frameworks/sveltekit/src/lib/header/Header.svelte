<script>
	import { page } from '$app/stores';
</script>

<header>
	<nav>
		<ul>
			<li class:active={$page.url.pathname === '/'}><a sveltekit:prefetch href="/">Home</a></li>
			<li class:active={$page.url.pathname === '/about'}>
				<a sveltekit:prefetch href="/about">About</a>
			</li>
		</ul>
	</nav>
</header>

<style>
	nav{
		position: fixed;
		top: 0;
		display: flex;
		justify-content: center;
		left: 0;
		right: 0;
	}
	ul{
		display: flex;
		list-style: none;
		gap: 7px;
		padding: 0;
	}
	a{
		color: white;
		font-weight: bold;
		text-decoration: none;
	}
</style>
