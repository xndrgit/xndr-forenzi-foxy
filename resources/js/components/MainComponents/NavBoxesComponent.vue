<template>
    <div>
        <div class="HeaderBoxes">
            <!-- <LoadingComponent v-if="LoadingCategories" /> -->

            <nav class="d-flex">
                <div class="container d-flex flex-wrap">
                    <div
                        class="card d-flex align-items-center position-relative"
                        :class="category.color"
                    >
                        <div class="up">
                            <router-link
                                :to="{
                                    name: 'category',
                                    params: { id: category.id },
                                }"
                            >
                                <img
                                    class="card-img-top"
                                    :src="category.img"
                                    alt="category-img"
                                />
                            </router-link>
                            <div class="litlogo position-absolute">
                                <img
                                    class="img-fluid"
                                    :src="category.img2"
                                    alt=""
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
        return {};
    },
};
</script>

<style lang="scss" scoped>
.HeaderBoxes {
    .card {
        width: 8rem;
        border-radius: 0px;
        border: 0px;
        transition: transform 0.2s;
        padding: 0px;
        margin: 8px 2px;
        min-height: 150px;
        max-height: 150px;

        &:hover {
            transform: scale(0.95);
            cursor: pointer;
        }

        .up {
            height: 75%;

            img {
                padding: 10px;
                height: -webkit-fill-available;
                padding: 1rem 0px;
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

            .card-text{
                font-weight: 700;
            }

            p {
                font-size: 0.8rem;
                margin: 0px;
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
}
</style>
