<template>
  <div class="admin">
    <h1>Admin</h1>
    <p>Hello <small>{{ user }}</small></p>
    <p>{{ token }}</p>
    <button class="btn btn-danger" v-on:click="handleLogout()">Logout</button>
  </div>

  <router-view></router-view>
</template>

<script>
    import store from '../../store';
    import { useRouter } from "vue-router";
    import { computed } from "vue";
    import { useStore } from "vuex";
    
    const token = store.state.user.token;
    const user = store.state.user.data;

    export default {
        name: "LogoutPage",
        
        data() {
            return {
                'user': user,
                'token': token
            };
        },
        methods: {
            handleLogout() {
                const router = useRouter();
                store
                    .dispatch('logout', token)
                    .then(() => {
                        this.$router.push({
                            name: 'login'
                        })
                    })
            },
        },
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