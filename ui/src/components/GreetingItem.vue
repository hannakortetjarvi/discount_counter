<script setup>
defineProps({
  msg: {
    type: String,
    required: true
  }
})

</script>

<template>
  <div class="greetings">
    <h1 class="green">{{ msg }}</h1>
  </div>
</template>

<style scoped>
.greetings {
  width: 100%;
  display: flex;
  justify-content: center;
  padding-bottom: 20px;
  border-bottom: 1px solid black;
}

h1 {
  font-weight: 500;
  font-size: 4rem;
  position: relative;
  top: -10px;
}

.greetings h1 {
  text-align: center;
}

@media (min-width: 1024px) {
  .greetings h1 {
    text-align: left;
  }
}
</style>
