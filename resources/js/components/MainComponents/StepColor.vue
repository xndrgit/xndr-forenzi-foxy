<template>
    <div class="step justify-content-center">
        <div class="d-flex align-items-start">
            <div class="d-none d-sm-block bg-yellow px-2 py-2 mx-2">STEP {{ step }}</div>
            <div class="">
                <span class="title-create">{{ title }}</span>
                <div
                    class="d-flex flex-column flex-sm-row flex-wrap align-items-center justify-content-between"
                >
                    <div
                        :class="{
                            active: selectedColor.value === titleOne,
                        }"
                        class="col-12 col-sm-6"
                        @click="selectLeft"
                    >
                        <div
                            class="box d-flex flex-column align-items-center col-12 p-0"
                        >
                            <img :src="imgOne" alt="" class="img-fluid image"/>
                            <i
                                v-if="isActiveFirst"
                                class="fa-sharp fa-solid fa-check"
                            >
                            </i>

                            <h4 class="titlebox">{{ titleOne }}</h4>
                            <span class="textbox">{{ txtOne }}</span>
                        </div>
                    </div>

                    <div
                        :class="{
                            active: selectedColor.value === titleTwo,
                        }"
                        class="col-12 col-sm-6"
                        @click="selectRight"
                    >
                        <div
                            class="box d-flex flex-column align-items-center col-12 p-0"
                        >
                            <img :src="imgTwo" alt="" class="img-fluid image"/>

                            <i
                                v-if="isActiveSecond"
                                class="fa-sharp fa-solid fa-check"
                            >
                            </i>

                            <h4 class="titlebox">{{ titleTwo }}</h4>
                            <span class="textbox">{{ txtTwo }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        step: String,
        title: String,
        titleOne: String,
        titleTwo: String,
        txtOne: String,
        txtTwo: String,
        imgOne: String,
        imgTwo: String,
    },
    data() {
        return {
            selectedColor: {
                id: "",
                value: "",
            },
            isActiveFirst: false,
            isActiveSecond: false,
        };
    },

    methods: {
        selectLeft() {
            this.selectedColor.value = this.titleOne;
            this.isActiveFirst = true;
            this.isActiveSecond = false;
            this.$emit("selectedColor", this.selectedColor);
        },
        selectRight() {
            this.selectedColor.value = this.titleTwo;
            this.isActiveSecond = true;
            this.isActiveFirst = false;
            this.$emit("selectedColor", this.selectedColor);
        },
    },

    created() {
        // this.selectedCategory.id = this.componentId;
        // this.selectedColor.id = this.componentId;
    },
};
</script>

<style lang="scss" scoped>
img {
    height: 160px;
    max-width: 100%;
}

.title-create {
    font-weight: bold;
    font-size: 0.8rem;
}

.box {
    position: relative;
    border: none;
    transition: 0.5s;

    &:hover {
        transform: scale(0.89);
    }
}

i {
    position: absolute;
    font-size: 6rem;
    top: 50px;
    right: 60px;
    color: #fdbc48;
    font-weight: bold;
}

@media screen and (max-width: 500px) {
    .titlebox {
        font-size: 0.6rem;
    }
    i {
        right: 50px;
    }
}
</style>
