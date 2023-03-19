<template>
    <div class="HeaderBottom py-4">
        <div class="HeaderSearch">
            <div class="container-lg">
                <div class="row d-flex justify-content-center">
                    <div class="col-md-3 col-sm-10 col-10 logo">
                        <a href="/">
                            <img
                                alt="Logo"
                                class="img-fluid mb-4"
                                src="../../../../public/img/logo.png"
                            />
                        </a>
                    </div>

                    <div class="d-none d-lg-block col-md-1"></div>

                    <div
                        class="col-md-8 col-sm-10 d-flex align-items-center justify-content-center"
                    >
                        <div
                            class="inputs d-flex flex-wrap flex-md-nowrap flex-sm-row"
                        >
                            <div class="input-group mb-3 mx-2">
                                <input
                                    v-model="length"
                                    class="form-control"
                                    max="99"
                                    placeholder="Lato Lungo"
                                    type="number"
                                />
                                <input
                                    v-model="height"
                                    class="form-control"
                                    max="99"
                                    placeholder="Lato Corto"
                                    type="number"
                                />
                                <input
                                    v-model="width"
                                    class="form-control"
                                    max="99"
                                    placeholder="Altezza"
                                    type="number"
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
                                    class="form-control"
                                    placeholder="Cerca per prodotto e riferimento"
                                    type="text"
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
            searchStr: "",
        };
    },
    methods: {
        search() {
            if (this.$route.name !== "home") {
                this.$router.push({
                    path: "/",
                    name: "home",
                });
            }

            window.VBus.fire("search-products", {
                length: this.length,
                width: this.width,
                height: this.height,
                searchStr: this.searchStr,
            });
        },
    },
};
</script>

<style lang="scss" scoped>
.divCm {
    background-color: transparent;
    box-shadow: 0 0 6px -2px rgba(0, 0, 0, 0.2);
    border-radius: 0;

    display: flex;
    align-items: center;
    justify-content: center;
}

span {
    color: black;
    font-weight: 600;
    height: 38px;

    border: none;
    background-color: transparent;
    transition: all 0.3s ease-in-out;

    width: fit-content;
    font-size: 0.6rem;
    padding: 0.8rem 14px;
}

.inputs .input-group {
}

input {
    text-overflow: ellipsis;
    overflow: hidden;
    white-space: nowrap;

    width: 100%;
    border-radius: 0;
    padding: 0;
    box-shadow: 0 0 2px -1px rgba(0, 0, 0, 0.4);

  transition: 0.1s;

  &:hover{
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
    transform: scale(0.90);
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
