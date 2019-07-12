<template>
    <!-- swiper -->
    <swiper :options="swiperOption">
        <swiper-slide v-for="(video, index) in videos" :key="index">
            <div class="card-slider">
                <div class="card-poster">
                    <a :href="route + '/' + video.slug" class="card-link-poster">
                        <img class="lazy-load-image"
                        :src="'data:image/gif;base64,R0lGODlhAgADAIAAAP///wAAACH5BAEAAAEALAAAAAACAAMAAAICjF8AOw=='"
                        :data-src="'https://loremflickr.com/250/375/art/?random=' + video.image"
                        :alt="'Постер к фильму ' + video.title"
                        :title="'Постер к фильму ' + video.title">
                        <div class="card-info">
                            <div>
                                <time :datetime="video.premiere">{{video.premiere}}</time>
                            </div>
                            <div class="card-raiting">
                                <div class="flex-row-center">
                                    <i class="icon-kinopoisk kinopoisk"></i>
                                    <div>{{video.kp_raiting | raiting}}</div>
                                </div>
                                <div class="flex-row-center">
                                    <i class="icon-imdb imdb"></i>
                                    <div>{{video.kp_raiting | raiting}}</div>
                                </div>
                            </div>
                        </div>
                        <div class="card-loader">
                            <div class="loader">
                                <div class="item-1"></div>
                                <div class="item-2"></div>
                                <div class="item-3"></div>
                                <div class="item-4"></div>
                                <div class="item-5"></div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="card-description">
                    <a :href="route + '/' + video.slug">
                        <div class="card-description__title nowrap">{{video.title}}</div>
                    </a>
                    <a :href="route + '/' + video.slug">
                        <div class="card-description__title card-description__title__small nowrap cursive">{{video.original_title}}</div>
                    </a>
                </div>
            </div>
        </swiper-slide>
        <div class="swiper-pagination" slot="pagination"></div>
    </swiper>
</template>

<script>
    export default {
        props: [
        'videos',
        'route'
        ],
        data() {
            return {
                swiperOption: {
                    slidesPerView: 'auto',
                    spaceBetween: 30,
                    freeMode: true,
                    pagination: {
                        el: '.swiper-pagination',
                        dynamicBullets: true,
                        dynamicMainBullets: 10,
                        clickable: true
                    }
                }
            }
        },
        filters: {
            raiting(value) {
                let raiting = value / 10000;
                return raiting.toFixed(1);
            }
        },
        mounted() {
            let layoutLoader = document.querySelector('.layout-loader');
            let hiddens = document.querySelectorAll('.hidden');
            let images = document.querySelectorAll('.card-poster img');
            if (!layoutLoader.classList.contains('hidden')) {
                layoutLoader.classList.add('hidden');
                if (hiddens.length > 0) {
                    for (var i = 0; i < hiddens.length; i++) {
                        hiddens[i].classList.remove('hidden');
                    }
                }
                // for (i = 0; i < images.length; i++) {
                //     images[i].setAttribute('src', images[i].getAttribute('data-src'));
                //     images[i].onload = function() {
                //         this.removeAttribute('data-src');
                //     };
                // }
            }
        }
    }
</script>
