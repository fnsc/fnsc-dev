<template>
    <footer class="row mt-auto p-3">
        <div class="col-12 text-center">
            <span>
                Made with
                <svg class="img-fluid heart">
                    <use :xlink:href="heart.url"/>
                </svg>
                using
                <a href="https://laravel.com">Laravel</a>.
                See this project on
                <a href="https://github.com/fnsc/fnsc-dev">GitHub</a>.
            </span>
        </div>
    </footer>
</template>
<script>
export default {
    props: ['heart']
}
</script>
