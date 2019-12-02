<template>

    <div>
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <router-link class="navbar-brand" :to="{ name: 'home' }">Ads announcer</router-link>

                <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        <li v-if="!$auth.check()" class="nav-item">
                            <router-link :to="{ name: 'login' }" class="nav-link">{{ trans('auth.login.text') }}</router-link>
                        </li>

                        <li v-if="!$auth.check()" class="nav-item">
                            <router-link :to="{ name: 'register' }" class="nav-link">{{ trans('auth.register.text') }}</router-link>
                        </li>

                        <li v-if="$auth.check()" class="nav-item dropdown">
                            <el-dropdown>
                                <a href="#" id="navbarDropdown" class="nav-link dropdown-toggle">
                                    {{ $auth.user().name }}
                                </a>
                                <el-dropdown-menu slot="dropdown">
                                    <el-dropdown-item>
                                        <router-link :to="{name: 'personal'}">{{ trans('personal.text') }}</router-link>
                                    </el-dropdown-item>
                                    <el-dropdown-item divided>
                                        <a href="#" @click.prevent="$auth.logout()">
                                            {{ trans('auth.logout') }}
                                        </a>
                                    </el-dropdown-item>
                                </el-dropdown-menu>
                            </el-dropdown>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="overflow-hide">
            <el-row :gutter="20">
                <el-col :span="16"
                        :lg="{span: 16, offset: 4}"
                        :md="{span: 12, offset: 6}"
                        :xs="{span: 20, offset: 0}"
                        :offset="4">
                    <main id="main-content">
                        <router-view></router-view>
                    </main>
                </el-col>
            </el-row>
        </div>
    </div>

</template>

<script>
    export default {
        name: "App",
        methods: {

        },
        created() {

        }
    }
</script>

<style scoped>

</style>
