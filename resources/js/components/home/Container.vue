<template>
    <div class="container custom-container d-flex flex-column">
        <header-component :user="user" :social_media="social_media"></header-component>
        <footer-component :heart="icons.heart"></footer-component>
    </div>
</template>
<script>
export default {
    props: ['user', 'social_media', 'icons']
}
</script>
