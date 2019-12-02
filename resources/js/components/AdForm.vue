<template>
    <div class="ad-form">
        <el-card class="box-card">
            <el-form ref="form" :model="form" label-width="120px" :loading="loading">
                <el-form-item :label="trans('common.title')">
                    <el-input v-model="form.title"></el-input>
                </el-form-item>

                <el-form-item :label="trans('common.description')">
                    <el-input type="textarea" v-model="form.description"></el-input>
                </el-form-item>

                <el-form-item :label="trans('common.category')">
                    <el-select v-model="form.category_id" placeholder="Select">
                        <el-option
                            v-for="item in categories"
                            :key="item.id"
                            :label="item.name"
                            :value="item.id">
                        </el-option>
                    </el-select>
                </el-form-item>

                <el-form-item :label="trans('common.country')">
                    <el-select v-model="form.country_id" placeholder="Select">
                        <el-option
                            v-for="item in countries"
                            :key="item.id"
                            :label="item.country"
                            :value="item.id">
                        </el-option>
                    </el-select>
                </el-form-item>

                <el-form-item :label="trans('common.city')">
                    <el-select v-model="form.city_id" placeholder="Select">
                        <el-option
                            v-for="item in cities"
                            :key="item.id"
                            :label="item.city"
                            :value="item.id">
                        </el-option>
                    </el-select>
                </el-form-item>
                <el-button @click="save(form)" type="primary">{{ trans('common.save') }}</el-button>
            </el-form>
        </el-card>
    </div>
</template>

<script>
    export default {
        name: "AdForm",
        props: ['countries', 'cities', 'categories'],
        data() {
            return {
                form: {
                    title: '',
                    description: '',
                    category_id: null,
                    country_id: null,
                    city_id: null,
                },
                loading: false
            }
        },
        methods: {
            save(form) {
                let self = this;
                self.loading = true;
                axios
                    .post('/ads', form)
                    .then(response => {
                        self.loading = false;
                        console.log(response.data);
                        this.$emit('formSave')
                        self.clearForm();
                    }).catch(error => {
                    this.loading = false;
                    this.error = error.response.data.message || error.message;
                });
            },
            clearForm() {
                this.form = {
                    title: '',
                    description: '',
                    category_id: null,
                    country_id: null,
                    city_id: null,
                };
            }
        }
    }
</script>

<style scoped>
    .el-card {
        margin: 15px 0;
    }
</style>
