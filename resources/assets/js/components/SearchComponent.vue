<template>
    <div class="search-component">
        <div class="search-form">
            <input class="search-form__input" type="text" placeholder="Быстрый поиск...">
            <div class="search-form__button" @click="fetch(keywords)"><i class=" icon-search"></i></div>
        </div>
        <a class="small" href="#">Расширенный поиск</a>
        <ul v-if="isShow" class="search unstyled" v-bind:class="{show: isShow}">
            <li class="small" v-for="movie in movies" :key="movie.id">
                <a :href="route + '/' + movie.slug">
                    <time>{{movie.premiere}}</time>
                    <div class="search-title">
                        <span>{{movie.title}}</span>
                        <br>
                        <span class="cursive">{{movie.original_title}}</span>
                    </div>
                    <img :src="'https://loremflickr.com/30/45/art/?random=' + movie.image"
                    :alt="'Постер к фильму ' + movie.title"
                    :title="'Постер к фильму ' + movie.title">
                </a>
            </li>
            <li class="small main-color" v-for="error in errors">{{error}}</li>
        </ul>
    </div>
</template>

<script>
    export default {
        props: [
        'route'
        ],
        data() {
            return {
                keywords: '',
                time: null,
                isShow: false,
                movies: [],
                errors: []
            }
        },
        mounted() {
            let input = document.querySelector('input.search-form__input');
            let vm = this;
            document.body.addEventListener('click', function() {
                let searchList = document.querySelector('.search-component>ul.search');

                console.log('ddd' + searchList);
                console.log(searchList == true);


                if (searchList) {
                    vm.isShow = false;
                }
            });
            input.addEventListener('focus', function() {
                this.addEventListener('input', function() {
                    var keywords = this.value;
                    vm.keywords = keywords;
                    if (keywords.length >= 0) {
                        if (vm.time) {
                            clearTimeout(vm.time);
                        }
                        vm.time = setTimeout(() => vm.fetch(keywords), 500);
                    }
                });
            });
        },
        methods: {
            fetch(keywords) {
                console.log(keywords + ' => keywords')
                this.errors = [];
                if (keywords.length == 0) {
                    this.movies = [];
                    this.isShow = false;
                    console.log('пусто');
                } else if (keywords.length < 2) {
                    this.movies = [];
                    this.errors['0'] = 'Введите хотя-бы два символа';
                    this.isShow = true;
                    console.log(this.error);
                } else {
                    console.log(keywords);
                    var rsp = this;
                    axios.get('/api/search/movies', {params: {keywords: keywords}})
                    .then(response => {
                        rsp.movies = response.data
                        if(rsp.movies.length == 0) {
                            rsp.errors['1'] = 'Упс! По вашему запросу ничего не найдено!'
                        }
                        rsp.isShow = true;
                    })
                    .catch(error => {
                        rsp.errors['2'] = error;
                    });
                }
            }
        }
    }
</script>