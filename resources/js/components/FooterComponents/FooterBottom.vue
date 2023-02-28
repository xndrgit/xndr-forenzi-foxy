<template>
    <div class="FooterBottom">
        <div
            class="container d-flex align-items-center justify-content-between p-0"
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
                    class="img-fluid"
                    src="../../../../public/Links/carte-di-pagamento.png"
                    alt=""
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
        height: 25px;
        margin: 10px;
    }
    .policy {
        display: contents;
        font-size: 0.8rem;
    }

    @media (max-width: 1000px) {
        img {
            height: 20px; /* Height for screens less than 1000px */
        }
        .policy {
            font-size: 0.5rem;
            height: 20px;
        }
    }
}
</style>
