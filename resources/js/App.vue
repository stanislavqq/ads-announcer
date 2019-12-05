<template>

    <div>
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <router-link class="navbar-brand" :to="{ name: 'home' }">Ads announcer</router-link>

                <lang-switch :availableLang="langs" :lang="$lang.getLang()" @changeLang="changeLangEvent"></lang-switch>
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
                            <router-link :to="{ name: 'login' }" class="nav-link">{{ $lang.auth.login.text }}</router-link>
                        </li>

                        <li v-if="!$auth.check()" class="nav-item">
                            <router-link :to="{ name: 'register' }" class="nav-link">{{ $lang.auth.register.text }}</router-link>
                        </li>

                        <li v-if="$auth.check()" class="nav-item dropdown">
                            <el-dropdown>
                                <a href="#" id="navbarDropdown" class="nav-link dropdown-toggle">
                                    {{ $auth.user().name }}
                                </a>
                                <el-dropdown-menu slot="dropdown">
                                    <el-dropdown-item>
                                        <router-link :to="{name: 'personal'}">{{ $lang.personal.text }}</router-link>
                                    </el-dropdown-item>
                                    <el-dropdown-item divided>
                                        <a href="#" @click.prevent="$auth.logout()">
                                            {{ $lang.auth.logout }}
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
    import LangSwitch from "./components/LangSwitch";
    export default {
        name: "App",
        components: {LangSwitch},
        data() {
            return {
                langs: [
                    {key: 'ru', img: '/images/lang_ru.png', value: 'RU'},
                    {key: 'en', img: '/images/lang_en.png', value: "ENG"}
                ]
            }
        },
        methods: {
            changeLangEvent(lang) {
                this.$lang.setLang(lang);
            }
        },
        mounted() {
            console.log(this.$auth.check());
            console.log(this.$lang.getLang());

        }
    }
</script>

<style scoped>

</style>
