import adapter from '@sveltejs/adapter-static'

/** @type {import('@sveltejs/kit').Config} */

const config = {
	kit: {
		adapter: adapter({
			assets: 'public',
			pages: 'public',
			fallback: '200.html'
		}),
		files: {
			assets: 'public'
		},
		package: {
			dir: 'src/package',
		}
	}
}

export default config