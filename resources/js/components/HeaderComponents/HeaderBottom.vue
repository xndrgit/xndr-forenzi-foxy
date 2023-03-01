<template>
    <div class="HeaderBottom py-4">
        <div class="HeaderSearch">
            <div class="container-lg">
                <div class="row d-flex">
                    <div class="col-md-3 logo">
                        <a href="/">
                            <img
                                class="img-fluid mb-4"
                                src="../../../../public/img/logo.png"
                                alt="Logo"
                            />
                        </a>
                    </div>

                    <div class="d-none d-md-block col-md-1"></div>

                    <div
                        class="col-md-8 d-flex align-items-center justify-content-end"
                    >
                        <div
                            class="inputs d-flex flex-wrap flex-md-nowrap flex-sm-row"
                        >
                            <div class="input-group mb-3 mx-2">
                                <input
                                    type="number"
                                    class="form-control"
                                    v-model="length"
                                    placeholder="Lato Lungo"
                                    max="99"
                                />
                                <input
                                    type="number"
                                    v-model="height"
                                    class="form-control"
                                    placeholder="Lato Corto"
                                    max="99"
                                />
                                <input
                                    type="number"
                                    class="form-control"
                                    v-model="width"
                                    placeholder="Altezza"
                                    max="99"
                                />
                                <div class="divCm">
                                    <span class="form-control"> CM </span>
                                </div>

                                <div class="input-group-append">
                                    <button
                                        class="btn btn-outline-secondary"
                                        type="submit"
                                        @click="search()"
                                    >
                                        <i class="fa fa-lg fa-search"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="input-group mb-3 mx-2">
                                <input
                                    v-model="searchStr"
                                    type="text"
                                    class="form-control"
                                    placeholder="Cerca per prodotto e riferimento"
                                />

                                <div class="input-group-append">
                                    <button
                                        class="btn btn-outline-secondary"
                                        type="button"
                                        @click="search()"
                                    >
                                        <i class="fa fa-lg fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            length: "",
            width: "",
            height: "",
            searchStr: ""
        };
    },
    methods: {
        search() {
            if (this.$route.name !== 'home') {
                this.$router.push({
                    path: '/',
                    name: 'home'
                });
            }

            window.VBus.fire('search-products', {
                length: this.length,
                width: this.width,
                height: this.height,
                searchStr: this.searchStr
            });
        }
    }
};
</script>

<style lang="scss" scoped>
.divCm {
    background-color: #f1f1f1;
    box-shadow: 0 0 15px -2px rgba(0, 0, 0, 0.3);
    border-radius: 0;

    display: flex;
    align-items: center;
    justify-content: center;
}

span {
    color: black;
    font-weight: 900;
    height: 38px;

    border: none;
    background-color: transparent;
    transition: all 0.3s ease-in-out;

    width: fit-content;
    font-size: 0.6rem;
    padding: 0.8rem 14px;
}

.inputs .input-group {
    background-color: #f1f1f1;
}

input {
    text-overflow: ellipsis;
    overflow: hidden;
    white-space: nowrap;

    width: 100%;
    border-radius: 0;
    padding: 0;
    box-shadow: 0 0 15px -2px rgba(0, 0, 0, 0.3);
    transition: all 1s;

    &:hover {
        // transform: translateY(-2px);
        // box-shadow: 0 15px 25px -5px rgba(0, 0, 0, 0.5);
    }
}

input::placeholder {
    width: min-content;
    color: black;
    font-size: 60%;
    font-weight: 600;

}

button.btn.btn-outline-secondary {
    background-color: rgb(253, 188, 72);
    color: black;
    font-weight: bold;
    border: 0;

    &:hover {
        // border-radius: 0;
        // transform: scale(0.9);
        // box-shadow: 0 4px 8px rgba(0, 0, 0, 0.4);
    }
}

.HeaderBottom {
    background-color: #ffffff;

    .HeaderSearch {
        .container-lg {
            .row {
                .logo {
                    img {
                        width: 100%;
                    }
                }

                .inputs {
                    .input-group {
                        input {
                            font-weight: bold;
                            border: none;
                            background-color: transparent;
                            padding: 0.5rem;
                            font-size: 1.1rem;
                            transition: all 0.3s ease-in-out;

                            &:hover {
                                box-shadow: 0 0 15px -2px rgba(0, 0, 0, 0.3);
                            }
                        }

                        .input-group-append {
                            button {
                                background-color: #fdbc47;
                                color: white;
                                font-weight: bold;
                                border: none;
                                transition: all 0.3s ease-in-out;

                                &:hover {
                                    // transform: scale(0.9);
                                }
                            }
                        }
                    }
                }
            }
        }
    }
}
</style>
