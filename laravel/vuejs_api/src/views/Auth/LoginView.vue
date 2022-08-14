<template>
  <form @submit="handleSubmit">
    <div class="form-group">
        <label for="email">Email address:</label>
        <input type="email" class="form-control" placeholder="Enter email" v-model="user.email">
    </div>
    <div class="form-group">
        <label for="pwd">Password:</label>
        <input type="password" class="form-control" placeholder="Enter password" v-model="user.password">
    </div>
    <div class="form-group form-check">
        <label class="form-check-label">
        <input class="form-check-input" type="checkbox" v-model="user.checked"> Remember me
        </label>
    </div>
    <button type="submit" class="btn btn-primary"><i class="fa fa-spinner fa-spin" v-if="loading"></i> Submit</button>
    </form>
</template>

<script setup>
    import store from '../../store';
    import { useRouter } from "vue-router";
    import { ref } from "vue";

    const router = useRouter();

    const user = {
        email: '',
        password: '',
        checked: false
    }

    let loading = ref(false);

    function handleSubmit(ev) {
        ev.preventDefault();

        loading.value = true;
        store
            .dispatch("login", user)
            .then(() => {
                loading.value = false;
                router.push({
                    path: '/admin'
                });
            })
            .catch((err) => {
                loading.value = false;
            });
    }
</script>

<style>
@media (min-width: 1024px) {
  .about {
    min-height: 100vh;
    display: flex;
    align-items: center;
  }
}
</style>
