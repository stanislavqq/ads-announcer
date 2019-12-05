<template>

    <div>
        <h1>{{ $lang.ads.title }}</h1>

        <div class="filter-ads" v-if="$auth.check()">
            <el-row>
                <el-col :span="6" class="text-center">
                    <el-select v-model="filter.country.value" placeholder="Select">
                        <el-option
                            v-for="item in filter.country.options"
                            :key="item.id"
                            :label="item.country"
                            :value="item.slug_country">
                        </el-option>
                    </el-select>
                </el-col>
                <el-col :span="6" class="text-center">
                    <el-select v-model="filter.city.value" placeholder="Select">
                        <el-option
                            v-for="item in filterCityOptions"
                            :key="item.id"
                            :label="item.city"
                            :value="item.slug_city">
                        </el-option>
                    </el-select>
                </el-col>
                <el-col :span="6" class="text-center">
                    <el-select
                        v-model="filter.category.model"
                        multiple
                        filterable
                        remote
                        reserve-keyword
                        placeholder="Please enter a keyword"
                        :remote-method="loadCategoriesData"
                        :loading="loading">
                        <el-option
                            v-for="item in filter.category.options"
                            :key="item.id"
                            :label="item.name"
                            :value="item.id">
                        </el-option>
                    </el-select>
                </el-col>
                <el-col :span="6" class="text-right">
                    <el-button @click="filterClear" type="primary">{{ $lang.ads.filter.clear_button }}</el-button>
                    <el-button @click="filterHandler" type="primary">{{ $lang.ads.filter.button }}</el-button>
                </el-col>
            </el-row>
        </div>
        <div class="ad-list" :loading="loading" v-if="$auth.check()">
            <el-row :gutter="20">
                <template v-if="adsFiltered.length">
                    <el-col :span="12" v-for="ad in adsFiltered" v-bind:key="ad.id">
                        <ad :ad="ad"></ad>
                    </el-col>
                </template>
                <template v-else>
                    {{ $lang.ads.not_found }}
                </template>
            </el-row>
        </div>
    </div>

</template>

<script>
    import Ad from './Ad';

    export default {
        name: "Home",
        data() {
            return {
                ads: [],
                filter: {
                    city: {
                        options: [],
                        value: this.$route.params.city,
                        model: null
                    },
                    country: {
                        options: [],
                        value: this.$route.params.country,
                        model: null
                    },
                    category: {
                        options: [],
                        value: '',
                        model: null
                    }
                },
                cities: [],
                categories: [],
                fullscreenLoading: true,
                loading: false
            }
        },
        components: {
            Ad
        },
        computed: {
            filterCityOptions() {
                if (this.filter.country.value) {
                    return this.filter.city.options.filter(city => (city.country.slug_country === this.filter.country.value));
                }
                return this.filter.city.options;
            },
            adsFiltered() {
                let self = this;
                let routeParams = this.$route.params;
                let city = routeParams.city !== undefined ? routeParams.city : false;
                let country = routeParams.country !== undefined ? routeParams.country : false;

                return this.ads.filter(ad => {
                    if (country && city) {
                        if (country === ad.city.country.slug_country && city === ad.city.slug_city) {
                            return true;
                        }
                    } else if (country) {
                        if (country === ad.city.country.slug_country) {
                            return true;
                        }
                    } else {
                        return true;
                    }

                    return false;
                }).filter(ad => {
                    return self.filter.category.model.length === 0 || self.filter.category.model.includes(ad.category.id);
                });
            }
        },
        methods: {
            filterHandler() {
                if (this.filter.country.value && this.filter.city.value) {
                    this.$router.push({path: "/" + this.filter.country.value + "/" + this.filter.city.value})
                }
            },
            filterClear() {
                this.filter.country.value = null;
                this.filter.city.value = null;
                this.filter.category.model = [];
                this.$router.push('/');
            },
            loadCountriesData() {
                let self = this;
                self.loading = true;
                axios
                    .get('/country')
                    .then(response => {
                        self.loading = false;
                        self.filter.country.options = response.data;
                    }).catch(error => {
                    this.fullscreenLoading = false;

                    this.error = error.response.data.message || error.message;
                });
            },
            loadCitiesData() {
                let self = this;
                self.loading = true;
                axios
                    .get('/city')
                    .then(response => {
                        self.loading = false;
                        self.filter.city.options = response.data;
                    }).catch(error => {
                    this.fullscreenLoading = false;

                    this.error = error.response.data.message || error.message;
                });
            },
            loadCategoriesData() {
                let self = this;
                self.loading = true;
                axios
                    .get('/category')
                    .then(response => {
                        self.loading = false;
                        self.filter.category.options = response.data;
                    }).catch(error => {
                    this.fullscreenLoading = false;

                    this.error = error.response.data.message || error.message;
                });
            },
            fetchAdsData() {
                let self = this;

                this.error = this.users = null;
                this.fullscreenLoading = true;
                const loading = this.$loading({
                    lock: true,
                    text: 'Loading',
                    spinner: 'el-icon-loading',
                    background: 'rgba(255, 255, 255, 0.7)'
                });
                axios
                    .get('/ads')
                    .then(response => {
                        self.loading = false;
                        self.ads = response.data;
                        loading.close();
                    }).catch(error => {
                    this.fullscreenLoading = false;

                    this.error = error.response.data.message || error.message;
                });
            }
        },
        created() {
            if (this.$auth.check()) {
                this.fetchAdsData();
                this.loadCitiesData();
                this.loadCountriesData();
            }
        }
    }
</script>

<style scoped type="SCSS">
    .ad-list {
        min-height: 100vh;
    }


</style>
