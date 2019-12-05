<template>
    <div id="personal-page" :loading="loading">
        <h1>{{ $lang.personal.text }}</h1>

        <el-row :gutter="20">
            <el-col :span="12">
                <div class="personal-ads">
                    <el-card v-for="ad in ads" v-bind:key="ad.id" class="box-card">
                        <div slot="header" class="clearfix">
                            <el-button v-if="editing === ad.id" @click="cancelEdit()" style="padding: 3px 0"
                                       type="text">{{ $lang.common.cancel }}
                            </el-button>
                            <el-button v-if="!editing || editing !== ad.id" :disabled="editing && editing !== ad.id"
                                       @click="edit(ad)" style="padding: 3px 0" type="text">{{ $lang.common.edit }}
                            </el-button>

                            <el-button @click="remove(ad)" style="float: right; padding: 3px 0; color: #F56C6C;"
                                       type="text">{{ $lang.common.delete }}
                            </el-button>
                        </div>
                        <div class="text item">
                            <label>Заголовок</label>
                            <div class="field-value" v-if="!(editing === ad.id)">{{ ad.title }}</div>
                            <el-input v-if="editing === ad.id" v-model="editForm.title"></el-input>
                        </div>
                        <div class="text item">
                            <label>Описание</label>
                            <div class="field-value" v-if="!(editing === ad.id)">{{ ad.description }}</div>
                            <el-input v-if="editing === ad.id" type="textarea"
                                      v-model="editForm.description"></el-input>
                        </div>
                        <div class="text item">
                            <label>Категория</label>
                            <div class="field-value" v-if="!(editing === ad.id)">{{ ad.category.name }}</div>
                            <el-select v-if="editing === ad.id" v-model="editForm.category.id" placeholder="Select">
                                <el-option
                                    v-for="item in optionsCategory"
                                    :key="item.id"
                                    :label="item.name"
                                    :value="item.id">
                                </el-option>
                            </el-select>
                        </div>
                        <div class="text item">
                            <label v-if="!(editing === ad.id)">Страна</label>
                            <div class="field-value">{{ ad.city.country.country }}</div>
                            <el-select v-if="editing === ad.id" v-model="editForm.city.country.id" @change=""
                                       placeholder="Select">
                                <el-option
                                    v-for="item in optionsCountry"
                                    :key="item.id"
                                    :label="item.country"
                                    :value="item.id">
                                </el-option>
                            </el-select>
                        </div>
                        <div class="text item">
                            <label>Город</label>
                            <div class="field-value" v-if="!(editing === ad.id)">{{ ad.city.city }}</div>
                            <el-select v-if="editing === ad.id" v-model="editForm.city.id" placeholder="Select">
                                <el-option
                                    v-for="item in optionsCityFiltered"
                                    :key="item.id"
                                    :label="item.city"
                                    :value="item.id">
                                </el-option>
                            </el-select>
                        </div>
                        <div class="text item">
                            <label>Создано</label>
                            <div class="field-value">{{ ad.created_at }}</div>
                        </div>
                        <div class="bottom clearfix">
                            <el-button v-if="editing && ad.id === editing" @click="update(editForm)" type="success"
                                       class="button">{{ $lang.common.save }}
                            </el-button>
                        </div>
                    </el-card>
                </div>
            </el-col>
            <el-col :span="12">
                <ad-form @formSave="formSaveHandler()" :categories="optionsCategory" :cities="optionsCity" :countries="optionsCountry"></ad-form>
            </el-col>
        </el-row>
    </div>
</template>

<script>
    import AdForm from "./AdForm";

    export default {
        name: "Personal",
        data() {
            return {
                ads: [],
                editing: null,
                loading: false,
                editForm: {},
                optionsCity: [],
                optionsCategory: [],
                optionsCountry: [],
            }
        },
        computed: {
            optionsCityFiltered() {
                if (this.editForm) {
                    return this.optionsCity.filter(option => {
                        return option.country.id === this.editForm.city.country.id;
                    });
                }
                return this.optionsCity;
            }
        },
        components: {AdForm},
        methods: {
            formSaveHandler() {
                this.fetchAdsData();
            },
            fetchAdsData(id) {
                let self = this;
                self.loading = true;
                axios
                    .get('/personal/ads')
                    .then(response => {
                        self.loading = false;
                        self.ads = response.data;
                    }).catch(error => {
                    this.loading = false;
                    this.error = error.response.data.message || error.message;
                });
            },
            edit(ad) {
                this.editForm = ad;
                this.editing = ad.id;
            },
            update(ad) {
                if (!ad) return false;

                let self = this;
                self.loading = true;
                axios
                    .put('/ads/' + ad.id, ad)
                    .then(response => {
                        self.loading = false;
                        if (response.data === 'ok') {
                            self.editing = null;
                            self.editForm = {};
                            this.fetchAdsData();
                        }
                    }).catch(error => {
                    this.fullscreenLoading = false;

                    this.error = error.response.data.message || error.message;
                });
            },
            cancelEdit() {
                this.editing = null;
            },
            remove(ad) {
                let self = this;
                axios.delete('/ads/' + ad.id)
                    .then(response => {
                        self.ads.splice(self.ads.indexOf(ad), 1);
                    });
            },
            loadCountriesData() {
                let self = this;
                self.loading = true;
                axios
                    .get('/country')
                    .then(response => {
                        self.loading = false;
                        self.optionsCountry = response.data;
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
                        self.optionsCity = response.data;
                    }).catch(error => {
                    this.loading = false;

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
                        self.optionsCategory = response.data;
                    }).catch(error => {
                    this.loading = false;

                    this.error = error.response.data.message || error.message;
                });
            },
            loadData() {
                this.fetchAdsData();
                this.loadCategoriesData();
                this.loadCitiesData();
                this.loadCountriesData();
            }
        },
        created() {
            this.loadData();
        }
    }
</script>

<style scoped type="scss">
    .el-card {
        margin: 15px 0;

    }

    .el-card .item {
        margin: 24px 0;
    }

    label {
        display: block;
        font-weight: bold;
    }
</style>
