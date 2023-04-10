<template>
    <div class="FooterTop d-flex justify-content-between">
        <div class="container-lg">
            <div class="row">
                <div class="col-12 d-flex flex-wrap justify-content-between">
                    <div class="footer-section col-6 col-sm-3">
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
                    <div class="footer-section col-6 col-sm-3">
                        <h3>Menu utente</h3>
                        <ul>
                          <li><span href="#">Account</span></li>
                          <li><span href="#">Carrello</span></li>
                          <li><span href="#">Abbonamento FoxTop</span></li>
                          <li><span href="#">Condizioni di vendita</span></li>
                          <li><span href="#">Privacy & Cookies Policy</span></li>
                          <li><span href="#">Contributo Conai</span></li>
                          <li><span href="#">Contatti</span></li>
                        </ul>
                    </div>
                    <div class="footer-section col-6 col-sm-3">
                        <h3>Seguici sui social</h3>
                      <div class="wrapper icons">

                        <a href="https://www.facebook.com/FoxyBox.scatole">
                                <span class="icon facebook">

                                    <span class="tooltip">Facebook</span>
                                    <span>
                                        <i class="fa-2x fab fa-facebook-f"></i
                                        ></span>

                                </span>
                        </a>

                        <!-- <li class="icon twitter">
                            <span class="tooltip">Twitter</span>
                            <span
                                ><i class="fa-sm fab fa-twitter"></i
                            ></span>
                        </li> -->
                        <span class="icon instagram">
                                <span class="tooltip">Instagram</span>
                                <span
                                ><i class="fa-2x fab fa-instagram"></i
                                ></span>
                            </span>
                        <!-- <li class="icon github">
                        <span class="tooltip">Github</span>
                        <span><i class="fa-sm fab fa-github"></i></span>
                    </li> -->
                        <!-- <li class="icon youtube">
                            <span class="tooltip">Youtube</span>
                            <span
                                ><i class="fa-sm fab fa-youtube"></i
                            ></span>
                        </li> -->
                      </div>
                    </div>
                  <div class="footer-section col-6 col-sm-3">
                    <h3>Newsletter</h3>
                    <p>
                      Iscriviti per ricevere email su novità, sconti e
                      molto altro.
                    </p>
                    <form>
                      <input placeholder="" type="email"/>
                      <br/>
                      <button
                        class="dark-button"
                        type="submit"
                      >
                        ISCRIVITI
                      </button>
                    </form>
                  </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {};
</script>

<style lang="scss" scoped>

.FooterTop {
    padding: 3rem 0;
    background-color: white;

    input {
      font-size: .6rem;

      padding: .4rem;
      background-color: #f1f1f1;
      border: none;
    }


    button {
      padding: 8px 2rem;
      color: white;
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
                    margin: 0 0;
                }
            }
        }


    }
}

@media (max-width: 576px) {
  .FooterTop {
    padding: 3rem 0;
    background-color: white;

    input {
      background-color: transparent;
      border: 1px solid lightgray;
      width: 140px;
    }

    button {
      padding: 8px 2rem;
    }

    .footer-section {
      h3 {
        font-weight: bold;
        font-size: 1rem;
        margin-bottom: 20px;
        white-space: nowrap;
      }

      p {
        font-size: 0.6rem;
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
          font-size: .6rem;
          max-width: 150px;
          white-space: nowrap;
          overflow: hidden;
          text-overflow: ellipsis;

          margin: 10px 0;
          margin-right: 10px;


          a {
            color: black;
            margin: 0 0;
          }
        }
      }


    }
  }
}

</style>
