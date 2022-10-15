<template>
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-7 col-xs-12">
                    <div class="box">
                        <h3 class="box-title">Product in your cart</h3>
                        <div class="plan-selection" v-for="product in items" :key="product.id">
                            <div class="plan-data" v-if="product.name">
                                <!-- <input id="question1" name="question" type="radio" class="with-font" value="sel" /> -->
                                <label for="question1">{{ product.name }}</label>
                                <p class="plan-text">
                                    Quantity: {{ product.quantity }}
                                </p>
                                <span class="plan-price">Price: {{ product.sale_price }}</span>
                            </div>
                        </div>
                    </div>

                    <a href="#" class="btn btn-primary btn-lg mb30">Continue With Shopping</a>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-5 col-xs-12">

                    <div class="widget">
                        <h4 class="widget-title">Order Summary</h4>
                        <div class="summary-block" v-for="summaryItem in items" :key="summaryItem.id">
                            <div class="summary-content" v-if="summaryItem.name">
                                <div class="summary-head">
                                    <h5 class="summary-title">{{ summaryItem.name }}</h5>
                                </div>
                                <div class="summary-price">
                                    <p class="summary-text">{{ summaryItem.total }}</p>
                                    <span class="summary-small-text pull-right">
                                        Q {{ summaryItem.quantity }} X
                                        P {{ summaryItem.sale_price }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="summary-block" >
                            <div class="summary-content">
                                <div class="summary-head">
                                    <h5 class="summary-title">Total</h5>
                                </div>
                                <div class="summary-price">
                                    <p class="summary-text">{{ items.totalAmount }}</p>
                                    
                                </div>
                            </div>
                            <div class="text-right">
                                <hr>
                                <button class="btn btn-warning">Place Order</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12  text-center mt20">
                    Created for <a href="" target="_blank">easetemplate</a>
                </div>
            </div>
</div>
</div>
</template>

<script>
    export default {
        data(){
            return {
                items: [],
            };
        },
        methods: {
            async getCartItems(){
                let response = await axios.get('checkout/get/items');
                this.items = response.data;
                console.log(this.items);
            }
        },
        created(){
            this.getCartItems();
        }
    }
</script>