<template>
    <div class="lang-switch">
        <el-select v-model="langModel" @change="changeLangHandler">
            <el-option
                v-for="item in availableLang"
                :key="item.key"
                :label="item.value"
                :value="item.key">
            </el-option>
        </el-select>
    </div>
</template>

<script>
    export default {
        name: "LangSwitch",
        data() {
            return {
                langModel: ''
            }
        },
        props: ['availableLang', 'lang'],
        methods: {
          changeLangHandler() {
              this.$emit('changeLang', this.langModel)
          }
        },
        created() {
            this.langModel = this.lang;
        },
    }
</script>

<style scoped>

</style>
