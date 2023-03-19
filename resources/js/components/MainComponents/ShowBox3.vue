<template>
  <div class="container-lg">
    <!-- <div class="d-flex justify-content-center" v-if="loadingCategory">
        <LoadingRollComponent />
    </div> -->

    <div class="d-flex">
      <div class="right">
        <div
          class="d-flex flex-wrap justify-content-between align-items-center"
        >
          <div class="col-12 col-md-8">
            <h2 class="font-weight-bold sub-title">
              {{ subcategory.name }}
            </h2>
            <h6 v-for="category in subcategory.categories" class="font-weight-bold">
              <a :href="'/category/' + category.id">
                → {{ category.name }}
              </a>
            </h6>
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
                            {{ subcategory.description }}
                        </span>
          </div>

          <div class="d-none d-lg-block col-12 col-md-4 position-relative">
            <img src="https://t4.ftcdn.net/jpg/01/08/28/37/360_F_108283790_YYMKdb7m1qdEiPvaJ9we0Bunbf5wvBtK.jpg" alt=""
                 class="img-fluid"/>
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
      </div>
    </div>

    <div class="d-flex justify-content-around justify-content-sm-center flex-wrap my-4">
      <BoxesComponent
        v-for="product in subcategory.products"
        :key="product.name"
        :product="product"
      />
    </div>
  </div>
</template>

<script>
import BoxesComponent from "./BoxesComponent.vue";

export default {
  components: {BoxesComponent},
  data() {
    return {
      value: 100,
      category: {},
      subcategory: {},
      loadingCategory: true,
    };
  },
  computed: {
    minimumPrice() {
      if (this.subcategory && this.subcategory.products) {
        return Math.min(
          ...this.subcategory.products.map((product) =>
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
    this.getSubcategory();
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
          setTimeout(() => {
            this.loadingCategory = false;
          }, 1000);
        })
        .catch((error) => {
          console.warn(error.message);
        });
    },
    getSubcategory() {
      axios
        .get(`/shop/subcategories/${this.$route.params.id}`)
        .then((response) => {
          this.subcategory = response.data.result;
        })
        .catch((error) => {
          console.warn(error.message);
        });
    },

  },
};
</script>

<style lang="scss" scoped>
.sub-title {
  position: relative;
  text-transform: uppercase;
}

h6:hover {
  opacity: 1;
  transform: translateX(10px);


}

h6 {
  width: fit-content;

  opacity: .5;
  transform: translateX(0px);
  transition: opacity 0.3s ease-in-out, transform 0.3s ease-in-out;
  cursor: pointer;
}

a{
  text-decoration: none;
  color: inherit;
}

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
</style>
