<template>
    <div>
        <i class="icon-burger-menu" v-on:click="showMenu"></i>
    </div>
</template>

<script>
export default {
    data() {
        return {
            show: false
        }
    },
    methods: {
        showMenu() {
            var menu = document.querySelector('.nav>.menu');
            var rightNav = document.querySelector('.nav>.right-nav');
            if (!this.show && getComputedStyle(menu).display == 'none' && getComputedStyle(rightNav).display == 'none') {
                menu.style.display = 'block';
                rightNav.style.display = 'block';
                this.show = true;
            } else {
                menu.style.display = 'none';
                rightNav.style.display = 'none';
                this.show = false;
            }
        }
    }
}
</script>