<template>

</template>
<script>
export default {
    data() {
        return {
        }
    },
    mounted() {
        let lazyImages = document.querySelectorAll('img.lazy-load-image');
        let imgLoaders = document.querySelectorAll('.card-loader');
        for (var i = 0; i < lazyImages.length; i++) {
            let img = new Image();
            img.lazyImage = lazyImages[i];
            img.imgLoader = imgLoaders[i];
            img.src = img.lazyImage.getAttribute('data-src');
            img.onload = function() {
                this.lazyImage.parentNode.replaceChild(this, this.lazyImage);
                this.imgLoader.style.display='none';
            }
        }
    },
    methods: {
    }
}
</script>