<script setup>
import { ref } from 'vue';

const count = ref(0)
</script>
<template>
    <div class="container">
        <div class="logos">
            <img src="https://github.com/firtadokei/codeigniter-vitejs/raw/master/src/logo.png" class="logo" alt="Codeigniter vite logo" />
            <img src="@/vue.svg" class="logo" alt="Vue logo" />
        </div>
        <h2>Codeigniter Vite + Vue</h2>
        <p>
            <button @click="count++">You click me {{ count }} times</button>
        </p>
        <p>
            Edit resources/App.vue to test HMR
        </p>
    </div>
</template>

<style>
:root {
    font-family: Helvetica, Arial, sans-serif;
    font-size: 16px;
    line-height: 24px;
    font-weight: 400;
    color-scheme: light dark;
    color: rgba(255, 255, 255, 0.87);
    background-color: #242424;
    text-rendering: optimizeLegibility;
}

body {
    margin: 0;
    display: flex;
    place-items: center;
    min-width: 320px;
    min-height: 100vh;
}

#app {
    max-width: 1280px;
    margin: 0 auto;
    padding: 2rem;
    text-align: center;
}

.logo {
    height: 6em;
    margin-inline: 10px;
}

button {
    padding: 10px 15px;
    border: 1px solid #6f6f6f;
    border-radius: 11px;
    cursor: pointer;
}

p {
    margin-block: 25px;
}
</style>