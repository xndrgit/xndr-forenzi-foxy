<template>
    <div class="FooterTop d-flex justify-content-between">
        <div class="container">
            <div class="row">
                <div class="footer-section col-3">
                    <h3>I nostri recapiti</h3>
                    <ul>
                        <li>Papyra s.r.l.</li>
                        <li>Via R.Buschi, 1</li>
                        <li>Zona Industriale Squartabue</li>
                        <li>62019 Recanati (MC)</li>
                        <li>Tel: 071 7501161</li>
                        <li>Fax: 071 7501757</li>
                        <li>info@foxbox.it</li>
                    </ul>
                </div>
                <div class="footer-section col-3">
                    <h3>Menu utente</h3>
                    <ul>
                        <li><a href="#">Account</a></li>
                        <li><a href="#">Carrello</a></li>
                        <li><a href="#">Abbonamento FoxTop</a></li>
                        <li><a href="#">Condizioni di vendita</a></li>
                        <li><a href="#">Privacy & Cookies Policy</a></li>
                        <li><a href="#">Contributo Conai</a></li>
                        <li><a href="#">Contatti</a></li>
                    </ul>
                </div>
                <div class="footer-section col-3">
                    <h3>Seguici sui social</h3>
                    <ul class="wrapper icons">
                        <li class="icon facebook">
                            <span class="tooltip">Facebook</span>
                            <span><i class="fa-sm fab fa-facebook-f"></i></span>
                        </li>
                        <li class="icon twitter">
                            <span class="tooltip">Twitter</span>
                            <span><i class="fa-sm fab fa-twitter"></i></span>
                        </li>
                        <li class="icon instagram">
                            <span class="tooltip">Instagram</span>
                            <span><i class="fa-sm fab fa-instagram"></i></span>
                        </li>
                        <!-- <li class="icon github">
                            <span class="tooltip">Github</span>
                            <span><i class="fa-sm fab fa-github"></i></span>
                        </li> -->
                        <li class="icon youtube">
                            <span class="tooltip">Youtube</span>
                            <span><i class="fa-sm fab fa-youtube"></i></span>
                        </li>
                    </ul>
                </div>
                <div class="footer-section col-3">
                    <h3>Newsletter</h3>
                    <p>
                        Iscriviti per ricevere email su novità, sconti e molto
                        altro.
                    </p>
                    <form>
                        <input type="email" placeholder="" />
                        <br />
                        <button class="dark-button text-white" type="submit">
                            ISCRIVITI
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script></script>

<style lang="scss" scoped>
.FooterTop {
    padding: 3rem 0;
    background-color: white;
    input {
        background-color: #f1f1f1;
        border: none;
    }
    button {
        padding: 8px 2rem;
    }
    .footer-section {
        h3 {
            font-weight: bold;
            font-size: 1rem;
            margin-bottom: 20px;
        }
        p {
            font-size: 0.7rem;
            font-weight: 500;
        }
        img {
            height: 30px;
            margin-right: 2px;
        }

        ul {
            list-style: none;
            padding: 0;
            li {
                font-size: 0.7rem;
            
                font-weight: 500;
                a {
                    color: black;
                    margin: 0px 0px;
                }
            }
        }
        @media (max-width: 991px) {
            margin: 0px 20px;
        }
    }
}
</style>
