<template>
    <div class="step">
        <div class="d-flex align-items-start">
            <div class="bg-yellow px-2 py-2 mx-2">STEP {{ step }}</div>
            <div class="">
                <span class="title-create">{{ title }}</span>
                <div class="d-flex align-items-center justify-content-between">
                    <div
                        class="col-6"
                        @click="selectLeft"
                        :class="{
                            active: selectedColor.value === titleOne,
                        }"
                    >
                        <div
                            class="box d-flex flex-column align-items-center col-12"
                        >
                            <img class="img-fluid" alt="Image" :src="imgOne" />
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
                        class="col-6"
                        @click="selectRight"
                        :class="{
                            active: selectedColor.value === titleTwo,
                        }"
                    >
                        <div
                            class="box d-flex flex-column align-items-center col-12"
                        >
                            <img class="img-fluid" alt="Image" :src="imgTwo" />

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
    computed: {
        isActiveFirst() {},
        isActiveSecond() {},
    },
};
</script>

<style lang="scss" scoped>
.box {
    position: relative;
    border: none;
}
i {
    position: absolute;
    font-size: 6rem;
    top: 80px;
    color: white;
    font-weight: bold;
}
</style>
