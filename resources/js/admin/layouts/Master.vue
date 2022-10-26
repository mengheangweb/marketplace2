<template>

    <header class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#">MarketPlace</a>
        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse"
            data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" :class="{show: active}" @click="notifyToggle" href="#" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Dropdown
                    </a>
                    <ul class="dropdown-menu" :class="{show: active}" aria-labelledby="navbarDropdown">
                        <li v-for="item in notifications">
                            <a class="dropdown-item" href="#">{{ item.title}}</a>
                        </li>                       
                    </ul>
                </li>
                <li class="nav-item">
                    <a @click="signout" class="nav-link px-3" href="#">Sign out</a>
                </li>
            </ul>
        </div>



        <!-- <div class="navbar-nav">
            <div class="nav-item text-nowrap">
                <a @click="signout" class="nav-link px-3" href="#">Sign out</a>
            </div>
        </div> -->
    </header>

    <div class="container-fluid">
        <div class="row">

            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                <div class="position-sticky pt-3">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <router-link to="/" class="nav-link">
                                <vue-feather type="home"></vue-feather>
                                Home
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="/post" class="nav-link">
                                <vue-feather type="bookmark"></vue-feather>
                                Post
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="/category" class="nav-link">
                                <vue-feather type="command"></vue-feather>
                                Categories
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="/user" class="nav-link">
                                <vue-feather type="user"></vue-feather>
                                User
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="/administrator" class="nav-link">
                                <vue-feather type="lock"></vue-feather>
                                Admin
                            </router-link>
                        </li>
                    </ul>

                </div>
            </nav>


            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <slot />
            </main>

        </div>
    </div>



</template>

<script>

import store from '../store'

export default {
    data() {
        return {
            active: false,
            notifications: [
                {
                    title: 'New post added',
                },
                {
                    title: 'new account created'
                }
            ]
        };
    },  
    mounted(){
        Echo.private('example-name')
            .listen('.App\\Events\\PostCreated', (e) => {
               // this.notifications.push({ title: e.title})
            });

    },  
    methods: {
        signout() {
            store.dispatch('logout');
            this.$router.push('/login')
        },
        notifyToggle(){
            this.active = !this.active
        }
    }
}

</script>