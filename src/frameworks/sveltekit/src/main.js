import { start } from '../.svelte-kit/runtime/client/start.js'

start({
    // @ts-ignore
    target: document.querySelector('#app'),
    paths: {
        base: "",
        assets: "http://localhost"
    },
    route: true,
    spa: true,
})