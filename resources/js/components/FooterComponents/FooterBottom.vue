<template>
    <div class="FooterBottom">
        <div
            class="container-lg d-flex align-items-center justify-content-around justify-content-xl-between p-0"
        >
            <div class="d-flex align-items-center">
                <p class="policy">
                    ©2022 PAPYRA SRL - P.IVA 01502350430 - PRIVACY & COOKIES
                    POLICY - MADE WITH <span class="text-danger"> ♥ </span> BY
                    TERENZICONCEPT
                </p>
            </div>
            <div>
                <img
                    alt=""
                    class="img-fluid"
                    src="../../../../public/Links/carte-di-pagamento.png"
                />
            </div>
        </div>
    </div>
</template>

<script>
export default {};
</script>

<style lang="scss" scoped>
.FooterBottom {
    width: 100%;
    background-color: black;
    color: white;

    img {
        height: 20px;
        margin: 10px;
    }

    .policy {
        display: contents;
        font-size: 0.8rem;
    }

    @media (max-width: 1000px) {
        img {
            height: 18px; /* Height for screens less than 1000px */
        }
        .policy {
            font-size: 0.6rem;
            height: 20px;
        }
    }

    @media (max-width: 576px) {
        img {
            display: none;
        }
        .policy {
            font-size: 0.4rem;
           font-weight: bold;
        }
    }
}
</style>
