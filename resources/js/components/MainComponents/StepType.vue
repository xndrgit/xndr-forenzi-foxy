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
                            active: selectedType.value === titleOne,
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
                            active: selectedType.value === titleTwo,
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
            selectedType: {
                id: "",
                value: "",
            },
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
            this.selectedType.value = this.titleOne;
            console.log(this.selectedType.value);
            this.isActiveFirst = true;
            this.isActiveSecond = false;
            this.$emit("selectedType", this.selectedType);
        },
        selectRight() {
            this.selectedType.value = this.titleTwo;
            console.log(this.selectedType.value);
            this.isActiveSecond = true;
            this.isActiveFirst = false;
            this.$emit("selectedType", this.selectedType);
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
    transition: 0.5s;
    &:hover {
        transform: scale(0.89);
    }
}
i {
    position: absolute;
    font-size: 10rem;
    top: 20px;
    right: 50px;
    color: #fdbc48;
    font-weight: bold;
}
</style>
