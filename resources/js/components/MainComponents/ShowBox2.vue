<template>
    <!-- <div class="d-flex justify-content-center" v-if="loadingCategory">
        <LoadingRollComponent />
    </div> -->
        <div
          class="d-flex flex-wrap justify-content-center align-items-center"
        >
          <div class="col-11 col-md-8">
            <h2 class="font-weight-bold">
              {{ category.name }}
            </h2>

            <!-- <div class="stars">
            <i v-for="n in 5" :key="n" class="far fa-star"></i>
        </div> -->
            <hr class="w-5"/>
            <div class="d-flex align-items-center">
              <span>da </span>
              <h3 class="p-2 font-weight-bold">
                €{{ minimumPrice.toFixed(2) }}
              </h3>
              <span>IVA esclusa</span>
            </div>
            <span>
              {{ category.description }}
            </span>
          </div>

          <div class="col-11 col-md-4 position-relative">
            <img :src="category.img" alt="" class="img-fluid"/>
            <img
              :src="category.img2"
              alt=""
              class="logo img-fluid position-absolute"
            />
          </div>
        </div>

        <!-- <div class="d-flex text-center fs-5">
            <div class="orange w-60 p-2 m-1">
                <i class="fas fa-info-circle"> </i
                ><strong> SCONTO </strong><span>FOX</span
                ><strong>TOP </strong>
                <span>
                    > Seleziona per vedere il prezzo in anteprima
                </span>
            </div>
            <div class="orange w-20 p-2 m-1">
                <input type="checkbox" />
                <strong> SCONTO 5%</strong> Totale ordine fino a €999
            </div>
            <div class="orange w-20 p-2 m-1">
                <input type="checkbox" />
                <strong>SCONTO 10%</strong> Totale ordine da €1.000
            </div>
        </div> -->

    <!-- <div class="row">
        <section
            class="boxes d-flex flex-wrap justify-content-center"
            v-for="product in category.products"
        >
            <div class="box">
                <div class="card-header">
                    <router-link
                        :to="{
                            name: 'product',
                            params: { id: product.id },
                        }"
                    >
                        <img
                            class="img-fluid"
                            src="https://static.wixstatic.com/media/2cd43b_0fe4090271224c51a780c0cccb961b83~mv2_d_2132_2400_s_2.png/v1/fill/w_320,h_360,q_90/2cd43b_0fe4090271224c51a780c0cccb961b83~mv2_d_2132_2400_s_2.png"
                            :alt="product.name"
                        />
                    </router-link>
                </div>

                <div class="card-body">
                    <h5 class="card-title">{{ product.name }}</h5>
                    <div class="d-flex align-items-center">
                        <p class="category">
                            {{ category.name }}
                        </p>
                        <p class="category">
                            {{ product.subcategory_id }}
                        </p>
                    </div>
                    <div class="d-flex align-items-center">
                        <p>
                            CODE:
                            {{ product.code }}
                        </p>
                    </div>
                    <div class="d-flex align-items-center">
                        <p>
                            <span v-if="!product.price_saled" class="price">
                                <i class="fas fa-tags"></i>
                                € {{ product.price }}
                            </span>
                            <span
                                v-if="product.price_saled"
                                class="current-price text-danger"
                            >
                                <i class="fas fa-tags"></i>
                                € {{ product.price_saled }}
                            </span>
                        </p>
                        <p>
                            <i class="fas fa-box"></i>
                            {{ product.quantity }}
                        </p>
                    </div>
                    <div class="d-flex align-items-center">
                        <p>{{ product.description.slice(0, 40) }} ...</p>
                    </div>
                </div>
            </div>
        </section>
    </div> -->
</template>

<script>
export default {
  components: {},
  data() {
    return {
      value: 100,
      category: {},
      loadingCategory: true,
    };
  },
  computed: {
    minimumPrice() {
      if (this.category && this.category.products) {
        return Math.min(
          ...this.category.products.map((product) =>
            product.price_saled === null
              ? product.price
              : Math.min(product.price, product.price_saled)
          )
        );
      }

      return 0;
    },
  },
  created() {
    this.getCategory();
  },
  mounted() {
    window.scrollTo(0, 0);
  },
  methods: {
    increaseValue() {
      this.value += 10;
    },
    decreaseValue() {
      this.value -= 10;
    },
    getCategory() {
      this.loadingCategory = true;
      axios
        .get(`/shop/categories/${this.$route.params.id}`)
        .then((response) => {
          this.category = response.data.results;
          console.log(this.category);
          setTimeout(() => {
            this.loadingCategory = false;
          }, 1000);
        })
        .catch((error) => {
          console.warn(error.message);
        });
    },

  },
};
</script>

<style lang="scss" scoped>
.logo {
  height: 120px;
  right: 10px;
  top: 10px;

  // border: 5px solid white;
  // border-radius: 50%;
}

span {
  font-size: 0.8rem;
}

input[type="checkbox"] {
  border: 0;
  width: 20px;
  height: 20px;
}

// NAV BAR
nav {
  display: flex;
  justify-content: space-evenly;
  align-items: center;
  padding: 1rem;
  margin: 1rem;
  border-bottom: 1px solid lightgray;

  a {
    text-decoration: none;
    color: #333;
    font-weight: bold;
    font-size: 0.8rem;
    transition: all 0.2s;

    &:hover {
      color: #0076ff;
    }

    &.active {
      border-bottom: 5px solid #000;
    }
  }
}

// TABLE
table {
  width: -webkit-fill-available;
  width: -moz-available;
  width: stretch;
}

.alternating-rows tr:nth-child(odd) {
  background-color: rgba(211, 211, 211, 0.5);
}

.alternating-rows tr:nth-child(even) {
  background-color: white;
}

td {
  padding: 8px;
}

.td1 {
  font-weight: bold;
  width: 30%;
}

.td2 {
  color: orange;
  font-weight: bold;
}

.box {
  width: 250px;
  border: 1px solid white;
  overflow: hidden;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  transition: all 0.2s ease-in-out;

  margin: 1.2rem;

  &:hover {
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
    transform: scale(1.05);
  }

  img {
    object-fit: contain;
  }

  .card-header {
    background-color: white;

    border-bottom: 0;
  }

  .card-body {
    background-color: white;
    padding: 0 1rem;
    display: flex;
    flex-direction: column;
    align-items: center;

    .card-title {
      margin: 0;
      font-size: 1rem;
      font-weight: bold;
      line-height: 1.5;
    }

    .current-price {
      font-size: 1.2rem;
      font-weight: bold;
    }

    .old-price {
      font-size: 0.8rem;
      font-weight: bold;
      color: lightgray;
      margin-right: 5px;
    }

    .price {
      font-size: 1.2rem;
      font-weight: bold;
    }

    p {
      margin: 4px;
    }

    .add-to-cart {
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;

      .col-12 {
        padding: 0;
      }
    }

    #add-to-cart-button {
      background-color: black;
      color: white;
      border: none;
      cursor: pointer;
    }

    #add-to-cart-button:hover {
      background-color: #3e8e41;
    }
  }

  .card-footer {
    background-color: white;
    padding: 0;
    margin: 0;

    border-top: 0;

    .left {
      width: fit-content;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .right {
      margin: 0 5px;

      display: flex;
      align-items: center;
      justify-content: center;

      input {
        text-align: center;
        max-width: 45px;
        height: fit-content;
      }

      input,
      button {
        border: 1px solid lightgrey;
        font-size: 0.7rem;
      }

      #minus-button,
      #plus-button {
        height: fit-content;
        background-color: white;

        text-align: center;
        font-weight: bold;
        cursor: pointer;
      }

      #minus-button:hover,
      #plus-button:hover {
        background-color: #fdbc48;
      }
    }
  }
}

.category {
  background-color: #333;
  border-radius: 40px;
  color: white;
  padding: 4px;
  padding-inline: 12px;
  margin-left: 10px;
}


@media (max-width: 576px) {
  h2{
    font-size: 1.5rem;
  }
  h3{
    font-size: .8rem;
    margin: 0;
  }
  h6{
    font-size: .8rem;
  }

  span {
    font-size: 0.6rem;
  }
}
</style>
