<template>
    <el-card class="box-card">
        <div slot="header" class="card_header clearfix">
            <span>{{ ad.title }}</span>
            <div class="location">{{ ad.city.city }} ({{ ad.city.country.country }})</div>
            <span style="float: right; padding: 3px 0" type="text">{{ ad.created_at }}</span>
        </div>
        <div class="desc text item">{{ ad.description }}</div>
        <span class="category-name text item">{{ ad.category.name }}</span>
        <div style="float: right" class="author-name text item">{{ trans('ads.author.label') }}: {{ ad.author.name }}</div>
    </el-card>
</template>

<script>

    export default {
        name: "Add",
        props: ['ad'],
        methods: {},
        created() {

        }
    }
</script>

<style scoped>
    .location {
        position: absolute;
        font-size: 12px;
        bottom: -8px;
        color: #cecece;
    }

    .card_header {
        position: relative;
    }

    .el-card {
        margin: 20px 0;
    }

    .category-name {
        display: inline-block;
        padding: 3px 8px;
        border: 1px solid #e6e6e6;
        border-radius: 3px;
        font-size: 12px;
        margin: 16px 0 0;
        color: #c7c7c7;
    }

    .author-name {
        display: inline-block;
        padding: 3px 8px;
        font-size: 12px;
        margin: 16px 0 0;
        color: #c7c7c7;
    }
</style>
