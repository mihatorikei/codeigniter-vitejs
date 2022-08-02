import { sveltekit } from '@sveltejs/kit/vite';

/** @type {import('vite').UserConfig} */

const config = {
	plugins: [sveltekit()],
	server: {
		origin: 'http://localhost:3479',
		strictPort: true,
		port: 3479
	}
};

export default config;
