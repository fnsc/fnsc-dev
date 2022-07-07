<template>
    <header class="row">
        <div class="col-12 avatar">
            <img :src="user.avatarUrl" alt="avatar" class="avatar-img img-fluid mx-auto d-block">
        </div>
        <div class="col-12 mt-3">
            <h1 class="text-center" v-text="user.name"></h1>
        </div>
        <div class="col-12 mt-1">
            <p class="text-center" v-text="user.bio"></p>
        </div>
        <div class="col-12 mt-1 d-flex flex-wrap justify-content-center">
            <a
                v-for="socialNetwork in social_media"
                :key="socialNetwork.id" :href="socialNetwork.profileUrl"
                :title="socialNetwork.name"
                class="icon-anchor"
                rel="nofollow"
            >
                <svg class="img-fluid icon-img">
                    <use :xlink:href="socialNetwork.iconPath"/>
                </svg>
            </a>
        </div>
    </header>
</template>
<script>
export default {
    props: ['user', 'social_media']
}
</script>
