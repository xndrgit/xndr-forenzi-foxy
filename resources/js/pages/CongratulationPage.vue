<template>
    <main class="page">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="congratulation contain">
                            <div class="congrats">
                                <h1>Congratulazioni!</h1>
                                <h3>E' stata mandata una mail con successo!</h3>
                                <div class="done">
                                    <img
                                        src="/images/congratulations-envelope.gif"
                                        alt=""
                                    />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</template>

<script>
export default {
    name: "CongratulationPage",
};
</script>

<style lang="scss" scoped>
.contain {
    width: 100%;
    height: 100%;
    background-image: linear-gradient(to bottom right, #02b3e4, #02ccba);
    display: flex;
    justify-content: center;
    align-items: center;
    border-radius: 6px;

    h1 {
        font-family: "Julius Sans One", sans-serif;
        font-size: 1.4em;
        color: #02b3e4;
    }
}

.done {
    display: flex;
    justify-content: center;
    align-items: center;
    width: 100%;

    img {
        width: 50%;
        height: auto;
    }
}

.congrats {
    width: 100%;
    min-height: 300px;
    max-height: 625px;
    border-radius: 5px;
    box-shadow: 12px 15px 20px 0 rgba(46, 61, 73, 0.3);
    text-align: center;
    font-size: 2em;
    color: #189086;
    background: white;
}

@media (max-width: 600px) {
    .congrats h1 {
        font-size: 1.2em;
    }

    .done {
        width: 80px;
        height: 80px;
    }
}

@media (max-width: 500px) {
    .congrats h1 {
        font-size: 1em;
    }

    .done {
        width: 70px;
        height: 70px;
    }
}

@media (max-width: 410px) {
    .congrats h1 {
        font-size: 1em;
    }

    .congrats .hide {
        display: none;
    }

    .congrats {
        width: 100%;
    }

    .done {
        width: 50px;
        height: 50px;
    }
}
</style>
