<template>
    <main class="page">
        <div class="container-lg">
            <div class="row">
                <div class="col-lg-12">
                    <div class="h6 mx-4 large">
                        <h2 class="font-weight-bold">CHECKOUT</h2>
                        <hr class="w-5" />
                        <span> DETTAGLI DI FATTURAZIONE </span>
                        <hr />
                    </div>
                </div>
                <div class="col-12 d-flex flex-wrap">
                    <div class="col-lg-6">
                        <div class="mobile h5">Billing Address</div>
                        <div id="details" class="">
                            <v-form ref="entryForm">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <!-- <label class="">NOME</label> -->
                                            <div
                                                class="d-flex jusify-content-start align-items-center"
                                            >
                                                <v-text-field
                                                    v-model="first_name"
                                                    :error-messages="
                                                        firstNameErrors
                                                    "
                                                    label="NOME"
                                                    required
                                                    @blur="
                                                        $v.first_name.$touch()
                                                    "
                                                    @input="
                                                        $v.first_name.$touch()
                                                    "
                                                ></v-text-field>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <!-- <label class="">COGNOME</label> -->
                                            <div
                                                class="d-flex jusify-content-start align-items-center"
                                            >
                                                <v-text-field
                                                    v-model="last_name"
                                                    :error-messages="
                                                        lastNameErrors
                                                    "
                                                    label="COGNOME"
                                                    required
                                                    @blur="
                                                        $v.last_name.$touch()
                                                    "
                                                    @input="
                                                        $v.last_name.$touch()
                                                    "
                                                ></v-text-field>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <!-- <label class="">RAGIONE SOCIALE</label> -->
                                    <div
                                        class="d-flex jusify-content-start align-items-center"
                                    >
                                        <!-- COGNOME
                                        <input type="text" v-model="business_name" /> -->
                                        <v-text-field
                                            v-model="business_name"
                                            :error-messages="businessNameErrors"
                                            label="RAGIONE SOCIALE"
                                            required
                                            @blur="$v.business_name.$touch()"
                                            @input="$v.business_name.$touch()"
                                        ></v-text-field>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <!-- <label class="">INDIRIZZO</label> -->
                                    <div
                                        class="d-flex jusify-content-start align-items-center"
                                    >
                                        <!-- <input type="text" v-model="address" /> -->
                                        <v-text-field
                                            v-model="address"
                                            :error-messages="addressErrors"
                                            label="INDIRIZZO"
                                            required
                                            @blur="$v.address.$touch()"
                                            @input="$v.address.$touch()"
                                        ></v-text-field>
                                    </div>
                                </div>

                                <!-- <div class="form-group">
                                    <label class="">RAGIONE SOCIALE</label>
                                    <div class="d-flex jusify-content-start align-items-center  ">
                                        <input type="text" value="" />
                                    </div>
                                </div> -->

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <!-- <label class="">CAP</label> -->
                                            <div
                                                class="d-flex jusify-content-start align-items-center"
                                            >
                                                <!-- <input type="text" v-model="cap" /> -->
                                                <v-text-field
                                                    v-model="cap"
                                                    :error-messages="capErrors"
                                                    label="CAP"
                                                    required
                                                    @blur="$v.cap.$touch()"
                                                    @input="$v.cap.$touch()"
                                                ></v-text-field>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <!-- <label class="">CITTÀ</label> -->
                                            <div
                                                class="d-flex jusify-content-start align-items-center"
                                            >
                                                <!-- <input type="text" v-model="city" /> -->
                                                <v-text-field
                                                    v-model="city"
                                                    :error-messages="cityErrors"
                                                    label="CITTÀ"
                                                    required
                                                    @blur="$v.city.$touch()"
                                                    @input="$v.city.$touch()"
                                                ></v-text-field>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <!-- <label class="">PROVINCIA</label> -->
                                            <div
                                                class="d-flex jusify-content-start align-items-center"
                                            >
                                                <!-- <input type="text" v-model="province" /> -->
                                                <v-text-field
                                                    v-model="province"
                                                    :error-messages="
                                                        provinceErrors
                                                    "
                                                    label="PROVINCIA"
                                                    required
                                                    @blur="$v.province.$touch()"
                                                    @input="
                                                        $v.province.$touch()
                                                    "
                                                ></v-text-field>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <!-- <label class="">STATO</label> -->
                                            <div
                                                class="d-flex jusify-content-start align-items-center"
                                            >
                                                <!-- <input type="text" v-model="state" /> -->
                                                <v-text-field
                                                    v-model="state"
                                                    :error-messages="
                                                        stateErrors
                                                    "
                                                    label="STATO"
                                                    required
                                                    @blur="$v.state.$touch()"
                                                    @input="$v.state.$touch()"
                                                ></v-text-field>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <!-- <label class="">TELEFONO</label> -->
                                            <div
                                                class="d-flex jusify-content-start align-items-center"
                                            >
                                                <!-- <input type="text" v-model="phone" /> -->
                                                <v-text-field
                                                    v-model="phone"
                                                    :error-messages="
                                                        phoneErrors
                                                    "
                                                    label="TELEFONO"
                                                    required
                                                    @blur="$v.phone.$touch()"
                                                    @input="$v.phone.$touch()"
                                                ></v-text-field>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <!-- <label class="">MAIL</label> -->
                                            <div
                                                class="d-flex jusify-content-start align-items-center"
                                            >
                                                <!-- <input type="text" value="" /> -->
                                                <v-text-field
                                                    :value="mail"
                                                    label="MAIL"
                                                ></v-text-field>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <!-- <label class="">PEC</label> -->
                                            <div
                                                class="d-flex jusify-content-start align-items-center"
                                            >
                                                <!-- <input type="text" v-model="pec" /> -->
                                                <v-text-field
                                                    v-model="pec"
                                                    :error-messages="pecErrors"
                                                    label="PEC"
                                                    required
                                                    @blur="$v.pec.$touch()"
                                                    @input="$v.pec.$touch()"
                                                ></v-text-field>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <!-- <label class="">CODICE SDI</label> -->
                                            <div
                                                class="d-flex jusify-content-start align-items-center"
                                            >
                                                <!-- <input type="text" v-model="code_sdi" /> -->
                                                <v-text-field
                                                    v-model="code_sdi"
                                                    :error-messages="
                                                        codeSdiErrors
                                                    "
                                                    label="CODICE SDI"
                                                    required
                                                    @blur="$v.code_sdi.$touch()"
                                                    @input="
                                                        $v.code_sdi.$touch()
                                                    "
                                                ></v-text-field>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <!-- <label class=""
                                        >NOTE ORDINE (opzionale)</label
                                    > -->
                                    <div
                                        class="d-flex jusify-content-start align-items-center"
                                    >
                                        <!-- <v-textarea
                                            cols="200"
                                            id=""
                                            name=""
                                            rows="5"
                                            v-model="notes"
                                        ></v-textarea> -->
                                        <v-textarea
                                            v-model="notes"
                                            :error-messages="notesErrors"
                                            label="NOTE ORDINE (opzionale)"
                                            required
                                            @blur="$v.notes.$touch()"
                                            @input="$v.notes.$touch()"
                                        ></v-textarea>
                                    </div>
                                </div>
                            </v-form>
                        </div>
                    </div>
                    <div class="summary col-lg-6">
                        <div id="cart" class="bg-white">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="h6">RIEPILOGO ORDINE</div>
                                <div class="h6">
                                    <a href="/cart">Back</a>
                                </div>
                            </div>
                            <template v-if="items">
                                <div v-for="item in items">
                                    <div
                                        class="d-flex jusitfy-content-between align-items-center pt-3 pb-2 border-bottom"
                                    >
                                        <div class="item pr-2">
                                            <img
                                                :src="productImage(item)"
                                                alt=""
                                                height="80"
                                                width="80"
                                            />
                                        </div>

                                        <div class="d-flex flex-column px-3">
                                            <b class="">{{ item.name }}</b>
                                            <strong
                                                >CODICE:
                                                <span> </span>
                                                <a
                                                    class="text-warnings"
                                                    href="#"
                                                >
                                                    {{ item.code }}
                                                </a>
                                            </strong>
                                            <strong
                                                >DIMENSIONI:
                                                <span> </span>
                                                <a
                                                    class="text-warnings"
                                                    href="#"
                                                >
                                                    <strong>
                                                        <a
                                                            class="text-warnings"
                                                            href="#"
                                                        >
                                                            {{ item.length }} x
                                                            {{ item.height }} x
                                                            {{ item.width }}
                                                        </a>
                                                    </strong>
                                                </a>
                                            </strong>
                                            <strong
                                                >QUANTITA'
                                                <span> </span>
                                                <a
                                                    class="text-warnings"
                                                    href="#"
                                                >
                                                    {{ item.cart_quantity }}
                                                </a>
                                            </strong>
                                        </div>
                                    </div>
                                </div>
                            </template>

                            <!-- <div
                                class="d-flex jusitfy-content-between align-items-center pt-3 pb-2 border-bottom"
                            >
                                <div class="item pr-2">
                                    <img
                                        alt=""
                                        height="80"
                                        src="../../../public/Links/cat-scatole-cartone-1-onda.jpg"
                                        width="80"
                                    />
                                    <div class="number">2</div>
                                </div>

                                <div class="d-flex flex-column px-3">
                                    <b class="">Scatole 2 onde</b>
                                    <strong
                                        >CODICE:
                                        <span> </span>
                                        <a class="text-primary" href="#">
                                            PT1014
                                        </a>
                                    </strong>
                                    <strong
                                        >DIMENSIONI:
                                        <span> </span>
                                        <a class="text-primary" href="#">
                                            <strong
                                                >CODICE:
                                                <span> </span>
                                                <a
                                                    class="text-primary"
                                                    href="#"
                                                >
                                                    14 x 14 x 10
                                                </a>
                                            </strong>
                                        </a>
                                    </strong>
                                </div>
                            </div> -->

                            <div class="py-5">
                                <div
                                    class="d-flex align-items-center justify-content-between"
                                >
                                    <div class="display-5">SUBTOTALE</div>
                                    <div class="ml-auto font-weight-bold">
                                        € {{ this.subtotal.toFixed(2) }}
                                    </div>
                                </div>
                                <hr />
                                <!-- <div
                                    class="d-flex align-items-center justify-content-between"
                                >
                                    <div class="display-5">FOXTOP - SCONTO</div>
                                    <div class="ml-auto font-weight-bold">
                                        $80.9
                                    </div>
                                </div> -->
                                <!-- <div
                                    class="d-flex align-items-center justify-content-between"
                                >
                                    <div class="display-5">ABBONAMENTO</div>
                                    <div class="ml-auto font-weight-bold">
                                        $80.9
                                    </div>
                                </div> -->
                                <div
                                    class="d-flex align-items-center justify-content-between"
                                >
                                    <div class="display-5">
                                        SPEDIZIONE GRATUITA
                                    </div>
                                    <div class="ml-auto font-weight-bold">
                                        € {{ this.shipping_cost.toFixed(2) }}
                                    </div>
                                </div>
                                <hr />
                                <div
                                    class="d-flex align-items-center justify-content-between"
                                >
                                    <div class="display-5">
                                        CONTRIBUTO CONAI
                                    </div>
                                    <div class="ml-auto font-weight-bold">
                                        € {{ this.conai.toFixed(2) }}
                                    </div>
                                </div>
                                <hr />
                                <div
                                    class="d-flex align-items-center justify-content-between"
                                >
                                    <div class="display-5">IVA</div>
                                    <div class="ml-auto font-weight-bold">
                                        € {{ this.iva.toFixed(2) }}
                                    </div>
                                </div>
                                <hr />
                                <div
                                    class="total d-flex justify-content-between align-items-center font-weight-bold"
                                >
                                    <div>TOTALE</div>
                                    <div>
                                        €
                                        {{
                                            (
                                                subtotal +
                                                shipping_cost +
                                                conai +
                                                iva
                                            ).toFixed(2)
                                        }}
                                    </div>
                                </div>
                                <hr />
                            </div>
                            <div class="pay">
                                <h5 class="fw-bold">MODALITÀ DI PAGAMENTO</h5>
                                <br />

                                <div class="form-check">
                                    <input
                                        id="bonifico"
                                        v-model="paymentMethod"
                                        class="form-check-input"
                                        name="paymentMethod"
                                        type="radio"
                                        value="bonifico"
                                    />
                                    <label
                                        class="form-check-label"
                                        for="bonifico"
                                    >
                                        BONIFICO BANCARIO
                                    </label>
                                    <p>
                                        Effettua il pagamento tramite bonifico
                                        bancario. Usa l’ID dell’ordine come
                                        causale. Il tuo ordine non verrà spedito
                                        finché i fondi non risulteranno
                                        trasferiti nel nostro conto corrente.
                                    </p>
                                    <hr />
                                </div>

                                <div class="form-check">
                                    <input
                                        id="alla-consegna"
                                        v-model="paymentMethod"
                                        class="form-check-input"
                                        name="paymentMethod"
                                        type="radio"
                                        value="alla-consegna"
                                    />
                                    <label
                                        class="form-check-label"
                                        for="alla-consegna"
                                    >
                                        PAGAMENTO ALLA CONSEGNA
                                    </label>
                                    <p>
                                        Pagamento in contanti al momento della
                                        consegna.
                                    </p>
                                    <hr />
                                </div>

                                <div class="form-check">
                                    <input
                                        id="paypal"
                                        v-model="paymentMethod"
                                        class="form-check-input"
                                        name="paymentMethod"
                                        type="radio"
                                        value="paypal"
                                    />

                                    <div class="d-flex justify-content-between">
                                        <label
                                            class="form-check-label"
                                            for="paypal"
                                        >
                                            PAYPAL E CARTE DI CREDITO
                                        </label>
                                        <div class="d-flex align-items-center">
                                            <i
                                                class="fab fa-cc-paypal fa-2x me-3"
                                            ></i>
                                            <i
                                                class="fab fa-cc-visa fa-2x me-3"
                                            ></i>
                                            <i
                                                class="fab fa-cc-mastercard fa-2x me-3"
                                            ></i>
                                            <i
                                                class="fab fa-cc-apple-pay fa-2x me-3"
                                            ></i>
                                            <i
                                                class="fab fa-google-pay fa-2x me-3"
                                            ></i>
                                        </div>
                                    </div>

                                    <p>
                                        Paga con PayPal; puoi pagare con la tua
                                        carta di credito se non hai un account
                                        PayPal.
                                    </p>
                                    <hr />
                                </div>

                                <p>
                                    I tuoi dati personali verranno utilizzati
                                    per elaborare il tuo ordine, supportare la
                                    tua esperienza in questo sito Web e per
                                    altri scopi descritti nella nostra
                                    <strong>
                                        <a href="">privacy policy.</a>
                                    </strong>
                                </p>
                                <hr />

                                <div class="form-check">
                                    <input
                                        id="terms"
                                        ref="checkTerm"
                                        v-model="agree"
                                        class="form-check-input"
                                        type="checkbox"
                                    />
                                    <label class="form-check-label" for="terms">
                                        Ho letto e accetto
                                        <strong
                                            ><a href=""
                                                >termini e condizioni</a
                                            ></strong
                                        >
                                        del sito web *
                                    </label>
                                </div>
                                <div
                                    class="col-md-12 my-4 d-flex justify-content-center w-100"
                                >
                                    <button
                                        :disabled="pending"
                                        class="yellow-button text-uppercase"
                                        @click="send()"
                                    >
                                        PROCEDI CON L'ORDINE
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</template>

<script>
import { maxLength, required } from "vuelidate/lib/validators";
import mixinCart from "../mixins/mixinCart";

export default {
    mixins: [mixinCart],
    data() {
        return {
            products: [],
            order: {},
            order_products: [],
            computedPrice: 0,
            quantity: 0,
            shipping_cost: 0,

            first_name: "",
            last_name: "",
            business_name: "",
            notes: "",
            address: "",
            phone: "",
            city: "",
            cap: "",
            province: "",
            state: "",
            pec: "",
            code_sdi: "",
            mail: "",
            agree: "",

            paymentMethod: "",

            first_name_error: ["error"],
            last_name_error: ["error"],
            business_name_error: ["error"],
            address_error: ["error"],
            cap_error: ["error"],
            city_error: ["error"],
            province_error: ["error"],
            state_error: ["error"],
            phone_error: ["error"],
            pec_error: ["error"],
            code_sdi_error: ["error"],
            notes_error: ["error"],

            pending: false,
        };
    },

    validations: {
        first_name: { required, maxLength: maxLength(10) },
        last_name: { required, maxLength: maxLength(10) },
        business_name: { required, maxLength: maxLength(15) },
        address: { required },
        cap: { required },
        city: { required },
        province: { required },
        state: { required },
        phone: { required },
        pec: { required },
        code_sdi: { required },
        notes: { required },
    },

    computed: {
        productImage() {
            return function (product) {
                if (/^http/.test(product.img)) {
                    return product.img;
                } else {
                    return "/storage/" + product.img;
                }
            };
        },
        firstNameErrors() {
            const errors = [];
            this.first_name_error = [];
            if (!this.$v.first_name.$dirty) {
                this.first_name_error.push("error");
                return errors;
            }
            !this.$v.first_name.maxLength &&
                errors.push("Must be at most 10 characters long") &&
                this.first_name_error.push("error");
            !this.$v.first_name.required &&
                errors.push("First Name is required.") &&
                this.first_name_error.push("error");
            return errors;
        },

        lastNameErrors() {
            const errors = [];
            this.last_name_error = [];
            if (!this.$v.last_name.$dirty) {
                this.last_name_error.push("error");
                return errors;
            }
            !this.$v.last_name.maxLength &&
                errors.push("Must be at most 10 characters long") &&
                this.last_name_error.push("error");
            !this.$v.last_name.required &&
                errors.push("Last Name is required.") &&
                this.last_name_error.push("error");
            return errors;
        },

        businessNameErrors() {
            const errors = [];
            this.business_name_error = [];
            if (!this.$v.business_name.$dirty) {
                this.business_name_error.push("error");
                return errors;
            }
            !this.$v.business_name.maxLength &&
                errors.push("Must be at most 10 characters long") &&
                this.business_name_error.push("error");
            !this.$v.business_name.required &&
                errors.push("Business Name is required.") &&
                this.business_name_error.push("error");
            return errors;
        },

        addressErrors() {
            const errors = [];
            this.address_error = [];
            if (!this.$v.address.$dirty) {
                this.address_error.push("error");
                return errors;
            }
            !this.$v.address.required &&
                errors.push("ADDRESS is required.") &&
                this.address_error.push("error");
            return errors;
        },

        capErrors() {
            const errors = [];
            this.cap_error = [];
            if (!this.$v.cap.$dirty) {
                this.cap_error.push("error");
                return errors;
            }
            !this.$v.cap.required &&
                errors.push("POSTAL CODE is required.") &&
                this.cap_error.push("error");
            return errors;
        },

        cityErrors() {
            const errors = [];
            this.city_error = [];
            if (!this.$v.city.$dirty) {
                this.city_error.push("error");
                return errors;
            }
            !this.$v.city.required &&
                errors.push("CITY is required.") &&
                this.city_error.push("error");
            return errors;
        },

        provinceErrors() {
            const errors = [];
            this.province_error = [];
            if (!this.$v.province.$dirty) {
                this.province_error.push("error");
                return errors;
            }
            !this.$v.province.required &&
                errors.push("PROVINCE is required.") &&
                this.province_error.push("error");
            return errors;
        },

        stateErrors() {
            const errors = [];
            this.state_error = [];
            if (!this.$v.state.$dirty) {
                this.state_error.push("error");
                return errors;
            }
            !this.$v.state.required &&
                errors.push("STATE is required.") &&
                this.state_error.push("error");
            return errors;
        },

        phoneErrors() {
            const errors = [];
            this.phone_error = [];
            if (!this.$v.phone.$dirty) {
                this.phone_error.push("error");
                return errors;
            }
            !this.$v.phone.required &&
                errors.push("TELEPHONE is required.") &&
                this.phone_error.push("error");
            return errors;
        },

        pecErrors() {
            const errors = [];
            this.pec_error = [];
            if (!this.$v.pec.$dirty) {
                this.pec_error.push("error");
                return errors;
            }
            !this.$v.pec.required &&
                errors.push("PEC is required.") &&
                this.pec_error.push("error");
            return errors;
        },

        codeSdiErrors() {
            const errors = [];
            this.code_sdi_error = [];
            if (!this.$v.code_sdi.$dirty) {
                this.code_sdi_error.push("error");
                return errors;
            }
            !this.$v.code_sdi.required &&
                errors.push("SDI CODE is required.") &&
                this.code_sdi_error.push("error");
            return errors;
        },

        notesErrors() {
            const errors = [];
            this.notes_error = [];
            if (!this.$v.notes.$dirty) {
                this.notes_error.push("error");
                return errors;
            }
            !this.$v.notes.required &&
                errors.push("NOTES is required.") &&
                this.notes_error.push("error");
            return errors;
        },
    },
    mounted() {
        this.getUserInfo();
        this.items = this.getCartItems();
    },
    methods: {
        pushBack() {
            this.$router.push("/cart");
        },
        getUserInfo() {
            axios.get("/shop/users/detail", {}).then((response) => {
                const details = response.data.result;
                this.mail = details.email;
                if (details.user_detail) {
                    this.first_name = details.name;
                    this.last_name = details.user_detail.surname;
                    this.business_name = details.user_detail.business_name;
                    this.notes = details.user_detail.notes;
                    this.address = details.user_detail.address;
                    this.phone = details.user_detail.phone;
                    this.city = details.user_detail.city;
                    this.cap = details.user_detail.cap;
                    this.province = details.user_detail.province;
                    this.state = details.user_detail.state;
                    this.pec = details.user_detail.pec;
                    this.code_sdi = details.user_detail.code_sdi;
                    this.agree = details.user_detail.agree;

                    this.$forceUpdate();
                }
            });
        },

        send() {
            // Trigger form validation
            this.$v.$touch();

            const total =
                this.subtotal + this.shipping_cost + this.conai + this.iva;

            if (total <= 0) {
                alert("Cart Failed!");
                return false;
            }

            if (!this.$v.$invalid && this.$refs.checkTerm.checked) {
                this.pending = true;
                axios
                    .post(`/shop/orders`, {
                        user_detail: {
                            surname: this.last_name,
                            business_name: this.business_name,
                            notes: this.notes,
                            address: this.address,
                            phone: this.phone,
                            city: this.city,
                            cap: this.cap,
                            province: this.province,
                            state: this.state,
                            pec: this.pec,
                            code_sdi: this.code_sdi,
                        },
                        payment: {
                            paymentMethod: this.paymentMethod,
                            amount: total,
                        },
                    })
                    .then((res) => {
                        if (res.data.result === "success" && res.data.id) {
                            if (this.paymentMethod === "paypal") {
                                this.$nextTick(() => {
                                    window.location.href = `/shop/payment?order_id=${res.data.id}&amount=${total}`;
                                });
                            } else {
                                this.$nextTick(() => {
                                    window.location.href = `/confirm/${res.data.id}`;
                                });
                            }
                        } else {
                            alert("Failed!");
                            this.pending = false;
                        }
                    })
                    .catch((err) => {
                        alert("Failed!");
                        this.pending = false;
                    });
            }
        },
    },
};
</script>

<style lang="scss" scoped>
.text-warnings {
    color: #f68630;
    font-weight: 800;
}

.display-5 {
    font-weight: bold;
}

label {
    font-weight: bold;
}

.col-lg-6 {
    padding-top: 0;
    padding-bottom: 0;
}

.v-text-field {
    padding-left: 0;
    margin: 0 0;
    font-weight: 900;
    font-size: 0.7rem;
}

i {
    margin-left: 0.4rem;
    font-size: 0.8rem;
}

.pay {
    h6 {
        font-weight: bold;
    }
}

.circle {
    display: inline-block;
    width: 1em;
    height: 1em;
    border-radius: 0.5em;
    background-color: #007bff;
    color: white;
    text-align: center;
    cursor: pointer;
}

.square {
    display: inline-block;
    width: 1em;
    height: 1em;
    background-color: #6c757d;
    color: white;
    text-align: center;
    cursor: pointer;
}

#details {
    min-height: 300px;
}

input {
    border: none;
    outline: none;
    padding: 0.2rem;
    font-size: 1.5rem;
}

textarea {
    border: none;
    outline: none;
    font-size: 1.5rem;
}

.form-group .d-flex {
    font-size: 0.8rem;
    margin: 0.5rem 0;
}

.form-group .d-flex input {
    width: 100%;
}

.form-group .d-flex:hover {
    color: #000;
    cursor: pointer;
}

select {
    width: 100%;
    padding: 8px 5px;
    border: 1px solid #ddd;
    border-radius: 5px;
}

input[type="checkbox"] + label {
    font-size: 0.85rem;
    font-weight: 600;
}

#address,
#cart,
#summary {
    padding: 20px 50px;
    font-size: 0.8rem;
}

#address .d-md-flex p.text-justify,
#register p.text-muted {
    margin: 0;
}

#register {
    background-color: #d9ecf2;
}

#register a {
    text-decoration: none;
    color: #333;
}

#cart,
#summary {
    max-width: 500px;
    border: 1px solid lightgrey;
}

.h6 {
    font-size: 1rem;
    font-weight: 700;
}

.h6 a {
    text-decoration: none;
    font-size: 0.6rem;
}

.item img {
    object-fit: cover;
    border-radius: 5px;
}

.item {
    position: relative;
}

.number {
    position: absolute;
    font-weight: 800;
    color: #fff;
    background-color: orange;
    padding-left: 7px;
    border-radius: 50%;
    border: 1px solid #fff;
    width: 25px;
    height: 25px;
    top: -5px;
    right: -5px;
}

.display-5 {
    font-size: 0.8rem;
    font-weight: bold;
}

#cart ~ p.text-muted {
    margin: 0;
    font-size: 0.9rem;
}

tr.text-muted td {
    border: none;
}

.fa-minus,
.fa-plus {
    font-size: 0.7rem;
}

.table td {
    padding: 0.3rem;
}

.yellow-button {
    width: -webkit-fill-available;
    width: -moz-available;
    width: stretch;
    font-size: 1.1rem;
}

.yellow-button.text-uppercase:hover {
    background-color: #333;
    color: #eee;
}

.yellow-button.text-white {
    background-color: #66cdaa;
    border-radius: 0;
}

.yellow-button.text-white:hover {
    background-color: #3cb371;
}

.yellow-button:disabled {
    cursor: not-allowed;
}

.wrapper .row + div.text-muted {
    font-size: 0.9rem;
}

.mobile,
#mobile {
    display: none;
}

.buttons {
    vertical-align: text-bottom;
}

#register {
    width: 50%;
}

@media (min-width: 768px) and (max-width: 991px) {
    .progress .progress-bar {
        width: 33%;
    }

    #cart,
    #summary {
        max-width: 100%;
    }

    .wrapper div.h5.large,
    .wrapper .row + div.text-muted {
        display: none;
    }

    .mobile.h5,
    #mobile {
        display: block;
    }
}

@media (min-width: 576px) and (max-width: 767px) {
    .progress .progress-bar {
        width: 29%;
    }

    #cart,
    #summary {
        max-width: 100%;
    }

    .wrapper div.h5.large,
    .wrapper .row + div.text-muted {
        display: none;
    }

    .mobile.h5,
    #mobile {
        display: block;
    }

    .buttons {
        width: 100%;
    }
}

@media (max-width: 575px) {
    .progress .progress-bar {
        width: 38%;
    }

    #cart,
    #summary {
        max-width: 100%;
    }

    nav,
    .wrapper {
        padding: 10px 30px;
    }

    #register {
        width: 100%;
    }
}

@media (max-width: 424px) {
    body {
        width: fit-content;
    }
}

@media (max-width: 375px) {
    .progress .progress-bar {
        width: 35%;
    }

    body {
        width: fit-content;
    }
}

.total * {
    color: orange;
    font-size: 0.8rem;
    font-weight: bold;
}
</style>
