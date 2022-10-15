<template>
    <div>
        <li class="nav-item">
            <a class="nav-link btn btn-warning btn-sm" href="/checkout">Cart {{ itemCount }}</a>
        </li>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data(){
        return {
            itemCount: '',
        };
    },
    mounted() {
        this.$root.$on('changeInCart', ($items) => {
            this.itemCount = $items;
        })
    },
    methods: {
        async getCartItemsOnPageLoad(){
            let response = await axios.post('/cart/store');
            this.itemCount = response.data.items
        }
    },
    created(){
        this.getCartItemsOnPageLoad();
    }
}
</script>