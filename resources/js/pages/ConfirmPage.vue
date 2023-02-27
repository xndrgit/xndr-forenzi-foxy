<template>
    <main class="page">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="text-left logo p-2 px-5">
                            <img
                                src="../../../public/img/logo.png"
                                style="width: 50px;"
                                alt=""
                            />
                        </div>
                        <div class="invoice p-5">
                            <h5>Your order Confirmed!</h5>
                            <span class="font-weight-bold d-block mt-4">
                                Hello, {{ this.surname }}
                            </span>
                            <span>
                                You order has been confirmed and will be shipped in next two days!
                            </span>
                            <div class="payment border-top mt-3 mb-3 border-bottom table-responsive">
                                <table class="table table-borderless">
                                    <tbody>
                                    <tr>
                                        <td>
                                            <div class="py-2">
                                                <span class="d-block text-muted">Order Date</span>
                                                <span>{{ this.order_date }}</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="py-2">
                                                <span class="d-block text-muted">Order No</span>
                                                <span>{{ this.order_number }}</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="py-2">
                                                <span class="d-block text-muted">Payment</span>
                                                <img
                                                    src="https://img.icons8.com/color/48/000000/mastercard.png"
                                                    width="20"
                                                    alt=""
                                                />
                                            </div>
                                        </td>
                                        <td>
                                            <div class="py-2">
                                                <span class="d-block text-muted">Shiping Address</span>
                                                <span>{{ this.address }}</span>
                                            </div>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="product border-bottom table-responsive">
                                <table v-if="order && order.products" class="table table-borderless">
                                    <tbody>
                                    <tr v-for="item in order.products">
                                        <td style="width: 20%;">
                                            <img
                                                src="../../../public/Links/2-onde.jpg"
                                                style="width: 90px;"
                                                alt=""/>
                                        </td>
                                        <td style="width: 60%;">
                                                <span
                                                    class="font-weight-bold"
                                                >
                                                    {{ item.name }}
                                                </span>
                                            <div class="product-qty">
                                                <span class="d-block">
                                                    {{ item.pivot.quantity }}
                                                </span>
                                                <span>
                                                    Color:{{ item.color }}
                                                </span>
                                            </div>
                                        </td>
                                        <td style="width: 20%;">
                                            <div class="text-right">
                                                <span
                                                    class="font-weight-bold"
                                                >
                                                    €{{ item.price }}
                                                </span>
                                            </div>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="row d-flex justify-content-end">
                                <div class="col-md-5">
                                    <table class="table table-borderless">
                                        <tbody class="totals">
                                        <tr>
                                            <td>
                                                <div class="text-left">
                                                    <span class="text-muted">
                                                        SUBTOTALE
                                                    </span>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="text-right">
                                                    <span>
                                                        €{{ this.subtotal }}
                                                    </span>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="text-left">
                                                    <span class="text-muted">
                                                        SPEDIZIONE GRATUITA
                                                    </span>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="text-right">
                                                    <span>
                                                        €{{ this.shipping_cost }}
                                                    </span>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="text-left">
                                                    <span class="text-muted">
                                                        CONTRIBUTO CONAI
                                                    </span>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="text-right">
                                                    <span>
                                                        €{{ this.conai }}
                                                    </span>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="text-left">
                                                    <span class="text-muted">IVA</span>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="text-right">
                                                    <span class="text-success">
                                                        €{{ this.iva }}
                                                    </span>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr
                                            class="border-top border-bottom"
                                        >
                                            <td>
                                                <div class="text-left">
                                                    <span class="font-weight-bold">
                                                        Total
                                                    </span>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="text-right">
                                                    <span class="font-weight-bold">
                                                        €{{ this.total }}
                                                    </span>
                                                </div>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <p>
                                We will be sending shipping confirmation email
                                when the item shipped successfully!
                            </p>
                            <p class="font-weight-bold mb-0">
                                Thanks for shopping with us!
                            </p>
                            <span>Foxybox Team</span>
                        </div>
                        <div class="d-flex justify-content-between footer p-3">
                            <span>Need Help? visit our <a href="#"> help center</a></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</template>

<script>
export default {
    data() {
        return {
            order: {},
            order_date: "",
            order_number: "",
            subtotal: 0,
            shipping_cost: 0,
            conai: 0,
            iva: 0,
            total: 0,
            address: "",
            surname: "",
        };
    },
    methods: {
        getOrder() {
            axios
                .get(`/shop/orders/${this.$route.params.id}`)
                .then((response) => {
                    this.order = response.data.results;
                    if (this.order) {
                        this.subtotal = parseFloat(this.order.subtotal);
                        this.conai = parseFloat(this.order.conai);
                        this.iva = parseFloat(this.order.iva);
                        this.total = parseFloat(this.order.total);
                        this.order_date = this.order.order_date;
                        this.order_number = this.order.order_number;
                    } else {
                        window.location.href = '/';
                    }
                })
                .catch((error) => {
                    console.log(error.message);
                });
        },
        getUser() {
            axios
                .get("/shop/users/detail", {})
                .then((response) => {
                    this.address = response.data.result.user_detail.address;
                    this.surname = response.data.result.user_detail.surname;
                })
                .catch((error) => {
                });
        },
    },
    mounted() {
        this.getUser();
        this.getOrder();
    },
};
</script>
