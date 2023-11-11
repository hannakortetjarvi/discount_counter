<template>

</template>

<script>
import apiClient from '../services/api';

export default {
  data() {
    return {
        email: null,
        password: null,
        loading: false,
    };
  },
  methods: {
    async login() {
      this.loading = true; // can use this to triggle a :disabled on login button
      this.errors = null;

        try {
          await apiClient.get('/sanctum/csrf-cookie'); 
          await apiClient.post('/login', {
            email: this.email,
            password: this.password
          });

          // Do something amazing
          
        } catch (error) {
          this.errors = error.response && error.response.data.errors;
        }

      this.loading = false;
    },

  },
}
</script>