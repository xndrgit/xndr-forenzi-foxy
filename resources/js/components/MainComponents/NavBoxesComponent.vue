<template>
  <div>
    <div class="HeaderBoxes">
      <nav class="position-relative" @mouseout="toggleSubcategory(false)">
        <div
          class="container d-flex flex-wrap"
          @mouseover="toggleSubcategory(true)"
        >
          <div
            :class="category.color"
            class="card d-flex align-items-center position-relative"
          >
            <div class="up">
              <a :href="`/category/${category.id}`">
                <img
                  :src="category.img"
                  alt=""
                  class="card-img-top"
                  @click="
                                        $router.go(`/category/${category.id}`)
                                    "
                />
              </a>
              <div class="litlogo position-absolute">
                <img
                  :src="category.img2"
                  alt=""
                  class="img-fluid"
                />
              </div>
            </div>

            <div class="down">
              <div class="card-body text-center p-1">
                <p class="card-title">SCATOLE</p>
                <p class="card-text mb-4">
                  {{ category.name }}
                </p>
              </div>
            </div>
          </div>
        </div>
        <div
          v-show="showSubcategory && category.subcategories && category.subcategories.length"
          class="subcategories-group"
          :class="category.color"
          @mouseover="toggleSubcategory(true)"
        >
          <div
            v-for="(subcategory, sIndex) in category.subcategories"
            :key="`sub-${sIndex}`"
            class="sub-item m-2"
          >
            <a :href="`/subcategory/${subcategory.id}`">{{ subcategory.name }}</a>
          </div>
        </div>
      </nav>
    </div>
  </div>
</template>

<script>
export default {
  components: {},
  props: {
    category: Object,
  },
  data() {
    return {
      showSubcategory: false
    };
  },
  beforeDestroy() {
    this.showSubcategory = false;
  },
  methods: {
    toggleSubcategory(flag) {
      this.showSubcategory = flag;
    }
  }
};
</script>

<style lang="scss" scoped>
.HeaderBoxes {
  .card {
    width: 7.5rem;
    border-radius: 0;
    border: 0;
    transition: transform 0.2s;
    padding: 0;
    margin: 8px 0;
    min-height: 150px;
    max-height: 150px;

    &:hover {
      transform: scale(0.95);
      cursor: pointer;
    }

    .up {
      height: 75%;

      img {
        height: -webkit-fill-available;
        height: -moz-available;
        height: stretch;
        padding: 1rem 0;
      }

      .litlogo {
        bottom: 30px;
        right: -25px;
        height: 80px;
        width: 80px;
      }
    }

    .down {
      height: 25%;

      display: flex;
      align-items: center;

      .card-text {
        font-weight: 700;
      }

      p {
        font-size: 0.8rem;
        margin: 0;
      }
    }
  }

  .orange-box {
    background-color: rgb(245, 134, 47);
  }

  .yellow-box {
    background-color: rgb(253, 188, 72);
  }

  .gray-box {
    background-color: rgb(244, 244, 244);
  }

  .subcategories-group {
    position: absolute;
    top: 150px;
    left: 30px;
    z-index: 2;
    padding: 0.5rem;
    transition: 0.5s;


    &:hover{
      left: 5px;
    }

    &.orange-box {
      &:before {
        border-left: 15px solid rgb(245, 134, 47);
      }
    }

    &.yellow-box {
      &:before {
        border-left: 15px solid rgb(253, 188, 72);
      }
    }

    &.gray-box {
      &:before {
        border-left: 15px solid rgb(244, 244, 244);
      }
    }

    .sub-item {
      a {
        color: white;
        font-weight: bold;
        font-size: 1rem;
        text-transform: uppercase;
      }

    }
  }
}
</style>
