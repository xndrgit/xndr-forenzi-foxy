<template>
    <main class="page">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="congratulation contain">
                            <div class="congrats">
                                <h1>Congratulazioni!</h1>
                                <span>Mail spedita con successo.</span>
                                <br/>
                                <span
                                >Data e ora di invio:
                                    <strong>{{ sentTime }}</strong></span
                                >
                                <div class="done position-relative">
                                    <img
                                        alt=""
                                        src="/images/congratulations-envelope.gif"
                                    />
                                    <div
                                        v-if="showCountdown"
                                        class="countdown position-absolute"
                                    >
                                        {{ countdown }}
                                    </div>
                                </div>
                                <span>By FoxyBox ♥</span>
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
    data() {
        return {
            sentTime: "",
            showCountdown: true,
            countdown: 10,
        };
    },
    created() {
        const now = new Date();
        this.sentTime = now.toLocaleString();

        const intervalId = setInterval(() => {
            this.countdown--;
            if (this.countdown <= 0) {
                clearInterval(intervalId);
                this.showCountdown = false;
                this.$router.push("/");
            }
        }, 1000);
    },
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
        font-weight: 800;
        margin-top: 10px;
        color: #f68630;
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

    .countdown {
        font-weight: 900;
        color: #f68630;
        font-size: 2rem;
        bottom: 50px;
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
    color: black;
    background: white;

    span {
        font-size: 1rem;
    }

    strong {
        color: #f68630;
    }
}

@media (max-width: 600px) {
    .congrats h1 {
        font-size: 1.2em;
    }

    .done {
        width: 100%;
    }
}

@media (max-width: 500px) {
    .congrats h1 {
        font-size: 1em;
    }

    .done {
        width: 100%;
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
        width: 100%;
    }
}
</style>
