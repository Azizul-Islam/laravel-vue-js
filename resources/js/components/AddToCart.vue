<template>
    <div>
        <button class="btn btn-warning" @click.prevent="addProductToCart()">Add To Cart</button>
    </div>
</template>

<script>
    export default {
        data(){
            return {

            };
        },
        props: ['productId','userId'],
        methods: {
            async addProductToCart(){
                if(this.userId == 0){
                    this.$toastr.e("You need to login, To add this product in cart!");
                    return;
                }

                //if user logged in then add item to cart.
                let response = await axios.post('/cart/store', {
                    'product_id': this.productId,
                    'user_id': this.userId,
                })
                
                this.$root.$emit('changeInCart', response.data.items);
            }
        },
       
    }
</script>
