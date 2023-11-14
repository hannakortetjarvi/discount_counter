<script setup>
import { RouterLink, RouterView } from 'vue-router'
import GreetingItem from './components/GreetingItem.vue'
</script>

<template>
  <header>
    <div class="wrapper">
      <GreetingItem msg="Discount Counter" />
      <nav>
        <RouterLink to="/prices">Prices</RouterLink>
        <RouterLink to="/data">Data</RouterLink>
        <RouterLink to="/create-discount">Create Discount</RouterLink>
        <RouterLink to="/create-sale">Add Sale</RouterLink>
      </nav>
    </div>
  </header>

  <div class="view">
    <RouterView/>
  </div>
</template>

<style scoped>

.wrapper {
  width: 100%;
  display: flex;
  justify-content: center;
}

header .wrapper {
    display: flex;
    place-items: flex-start;
    flex-wrap: wrap;

}

.view {
  display: flex;
  justify-content: center;
  width: 100%;
}

nav {
  width: 100%;
  font-size: 14px;
  text-align: center;
  margin-top: 1rem;
  display: flex;
  justify-content: center;
}

nav a.router-link-exact-active {
  color: var(--color-text);
  font-weight: bold;
}

nav a.router-link-exact-active:hover {
  background-color: transparent;
}

nav a {
  display: inline-block;
  padding: 0 1rem;
  border-left: 1px solid var(--color-border);
}

nav a:first-of-type {
  border: 0;
}
</style>
