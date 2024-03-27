<!DOCTYPE html>
<html lang="en">

<head>
    <script src="../assets/js/color-modes.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shanoa</title>
    <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <link rel="stylesheet" href="http://localhost/Shanoa%20Store/Styles/index.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/carousel/">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">
    <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="carousel.css" rel="stylesheet">

</head>

<body>
<?php include("Templates/header.php");?>

    <!-- Carrusel -->
    <main>
        <div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                    aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                    aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                    aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active banneraudi">
                    <svg class="bd-placeholder-img" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg"
                        aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false">
                        <rect width="100%" height="100%" fill="var(--bs-secondary-color)" />
                    </svg>
                    <div class="container">
                        <div class="carousel-caption text-start">
                            <h1>Audifonos.</h1>
                            <p class="opacity-75">¡Bienvenidos A Shanoa Luxury!</p>
                        </div>
                    </div>
                </div>
                <div class="carousel-item bannerreloj">
                    <svg class="bd-placeholder-img" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg"
                        aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false">
                        <rect width="100%" height="100%" fill="var(--bs-secondary-color)" />
                    </svg>
                    <div class="container">
                        <div class="carousel-caption">
                            <h1>Relojes.</h1>
                            <p>¡Bienvenidos A Shanoa Luxury!</p>
                        </div>
                    </div>
                </div>
                <div class="carousel-item banneracce">
                    <svg class="bd-placeholder-img" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg"
                        aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false">
                        <rect width="100%" height="100%" fill="var(--bs-secondary-color)" />
                    </svg>
                    <div class="container">
                        <div class="carousel-caption text-end">
                            <h1>Accesorios.</h1>
                            <p>¡Bienvenidos A Shanoa Luxury!</p>
                        </div>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
        <!-- Contenido -->
        <div class="container marketing">
            <div class="row">
                <div class="col-lg-4">
                    <img class="bd-placeholder-img rounded-circle" width="140" height="140"
                        src="imagenes/AcceAudifo.jpg" alt="Imagen de ejemplo">
                    <h2 class="fw-normal">Audifonos</h2>
                    <p style="text-align: justify">Nuestros audífonos ofrecen una experiencia auditiva excepcional,
                        incluso a bajo costo. En nuestra tienda súper profesional, te garantizamos calidad, comodidad y
                        un sonido nítido que transformará tu experiencia auditiva.</p>
                    <p><a class="btn btn-secondary" style="border: none; background-color: rgb(243, 150, 166);"
                            href="#">Ver Mas &raquo;</a></p>
                </div><!-- /.col-lg-4 -->
                <div class="col-lg-4">
                    <img class="bd-placeholder-img rounded-circle" width="140" height="140" src="imagenes/AcceRelo.jpg"
                        alt="Imagen de ejemplo">
                    <h2 class="fw-normal">Relojes</h2>
                    <p style="text-align: justify">En nuestra tienda, ofrecemos relojes inteligentes de alta calidad a
                        precios accesibles. Con una atención profesional y un enfoque en la experiencia del cliente,
                        garantizamos productos confiables que se adaptan a tus necesidades tecnológicas.</p>
                    <p><a class="btn btn-secondary" href="#"
                            style="border: none; background-color: rgb(243, 150, 166);">Ver Mas &raquo;</a></p>
                </div><!-- /.col-lg-4 -->
                <div class="col-lg-4">
                    <img class="bd-placeholder-img rounded-circle" width="140" height="140"
                        src="imagenes/Accesorios.jpg" alt="Imagen de ejemplo">
                    <h2 class="fw-normal">Accesorios</h2>
                    <p style="text-align: justify">En mi tienda, ofrecemos accesorios para celulares, relojes y
                        audífonos de alta calidad a precios asequibles. Nuestra amplia gama de productos está
                        cuidadosamente seleccionada para garantizar la satisfacción del cliente.</p>
                    <p><a class="btn btn-secondary" href="#"
                            style="border: none; background-color: rgb(243, 150, 166);">Ver Mas &raquo;</a></p>
                </div><!-- /.col-lg-4 -->
            </div><!-- /.row -->
            <!-- QUIENES SOMOS -->
            <hr class="featurette-divider">
            <div class="row featurette">
                <div class="col-md-7">
                    <h2 class="featurette-heading fw-normal lh-1" style=" text-align: center;">QUIÉNES
                        SOMOS<span><br><br>
                            <p class="lead" style="text-align: justify;">¡Bienvenidos a nuestra tienda de tecnología
                                rosada en Colombia! Somos Sofía
                                y Steven, una
                                pareja
                                apasionada por la innovación y el estilo. Junto con nuestros fieles compañeros, dos
                                adorables
                                perros llamados Noah y Shadow, hemos creado un espacio único donde la tecnología y el
                                buen
                                gusto
                                se encuentran. <br>

                                En nuestra tienda, ofrecemos una cuidadosa selección de productos que reflejan nuestra
                                pasión
                                por la elegancia y la funcionalidad. Desde relojes inteligentes hasta audífonos y
                                accesorios
                                para celulares, cada artículo en nuestra colección ha sido cuidadosamente elegido para
                                combinar
                                la última tecnología con un toque de distinción rosada. <br>

                                Nuestro compromiso va más allá de simplemente vender productos. Nos esforzamos por
                                brindar
                                una
                                experiencia de compra excepcional, donde la atención personalizada y el servicio al
                                cliente
                                de
                                primera clase son nuestra prioridad. En nuestra tienda, encontrarás más que solo
                                gadgets;
                                encontrarás una comunidad que comparte tu pasión por la tecnología y el estilo de vida
                                moderno.
                                <br>

                                Únete a nosotros en este emocionante viaje hacia el futuro de la tecnología con estilo.
                                Sofía,
                                Steven, Noah y Shadow te esperan en nuestra tienda para descubrir juntos el encanto de
                                la
                                innovación rosada.<br>
                            </p>
                </div>
                <div class="col-md-5">
                    <svg class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500"
                        height="500" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 500x500"
                        preserveAspectRatio="xMidYMid slice" focusable="false">
                        <title>Placeholder</title>
                        <rect width="100%" height="100%" fill="var(--bs-secondary-bg)" /><text x="50%" y="50%"
                            fill="var(--bs-secondary-color)" dy=".3em">500x500</text>
                    </svg>
                </div>
            </div>
            <!--  -->
            <hr class="featurette-divider">
            <div class="row featurette">
                <div class="col-md-7 order-md-2">
                    <h2 class="featurette-heading fw-normal lh-1">titulo. <span>
                            <p class="lead">que pongo que pongoooooooooooo.</p>
                </div>
                <div class="col-md-5 order-md-1">
                    <svg class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500"
                        height="500" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 500x500"
                        preserveAspectRatio="xMidYMid slice" focusable="false">
                        <title>Placeholder</title>
                        <rect width="100%" height="100%" fill="var(--bs-secondary-bg)" /><text x="50%" y="50%"
                            fill="var(--bs-secondary-color)" dy=".3em">500x500</text>
                    </svg>
                </div>
            </div>
            <hr class="featurette-divider">
            <div class="row featurette">
                <div class="col-md-7 ">
                    <h2 class="featurette-heading fw-normal lh-1">titulo. <span>
                            <p class="lead">que pongo que pongoooooooooooo.</p>
                </div>
                <div class="col-md-5 order-md-1">
                    <svg class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500"
                        height="500" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 500x500"
                        preserveAspectRatio="xMidYMid slice" focusable="false">
                        <title>Placeholder</title>
                        <rect width="100%" height="100%" fill="var(--bs-secondary-bg)" /><text x="50%" y="50%"
                            fill="var(--bs-secondary-color)" dy=".3em">500x500</text>
                    </svg>
                </div>
            </div>


            <!-- REDES SOCIALES -->
            <h1 style="text-align: center; font-size: 25px;">REDES SOCIALES</h1>
            <hr>
            
            <div style="display: flex; flex-direction: column;">
                <div style="display: flex; justify-content: space-between;">
                    <!-- Tiktoks -->
                    <div style="width: 50%; ">
                        <blockquote class="tiktok-embed" cite="https://www.tiktok.com/@shanoah_luxury.2"
                            data-unique-id="shanoah_luxury.2" data-embed-type="creator" style="">
                            <section> <a target="_blank"
                                    href="https://www.tiktok.com/@shanoah_luxury.2?refer=creator_embed">@shanoah_luxury.2</a>
                            </section>
                        </blockquote>
                        <script async src="https://www.tiktok.com/embed.js"></script>
                    </div>
                    <div class=" swiper swiper-hero" style="background: tr;">
                        <div>
                            <h2 style="text-align: center;"><svg xmlns="http://www.w3.org/2000/svg" width="40"
                                    height="40" fill="currentColor" class="bi bi-instagram" viewBox="0 0 16 16">
                                    <path
                                        d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.9 3.9 0 0 0-1.417.923A3.9 3.9 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.9 3.9 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.9 3.9 0 0 0-.923-1.417A3.9 3.9 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599s.453.546.598.92c.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.5 2.5 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.5 2.5 0 0 1-.92-.598 2.5 2.5 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233s.008-2.388.046-3.231c.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92s.546-.453.92-.598c.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92m-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217m0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334" />
                                </svg> INSTAGRAM</h2>
                        </div>
                        <!-- Additional required wrapper -->
                        <div class="swiper-wrapper">
                            <!-- Slides -->
                            <div class="swiper-slide">
                                <a href="https://www.instagram.com/shanoah_luxury_/">
                                    <img src="imagenes/imgig5.jpg" alt="">
                                </a>
                            </div>
                            <div class="swiper-slide">
                                <a href="https://www.instagram.com/shanoah_luxury_/">
                                    <img src="imagenes/imgig1.jpg" alt="" />
                                </a>
                            </div>
                            <div class="swiper-slide">
                                <a href="https://www.instagram.com/shanoah_luxury_/">
                                    <img src="imagenes/imgig2.jpg" alt="" />
                                </a>
                            </div>
                            <div class="swiper-slide">
                                <a href="https://www.instagram.com/shanoah_luxury_/">
                                    <img src="imagenes/imgig3.jpg" alt="" />
                                </a>
                            </div>
                            <div class="swiper-slide">
                                <a href="https://www.instagram.com/shanoah_luxury_/">
                                    <img src="imagenes/imgig4.jpg" alt="" />
                                </a>
                            </div>
                        </div>
                        <!-- If we need pagination -->
                        <div class="swiper-pagination"></div>
                        <!-- If we need navigation buttons -->
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-button-next"></div>
                        <!-- If we need scrollbar -->
                        <!-- <div class="swiper-scrollbar"></div> -->
                    </div>
                </div>
            </div>


        </div>
        <!--  -->
    </main>
    <!--  -->
    <?php include("Templates/footer.php");?>

    <!-- scripts -->
    <!-- Carrusel IG -->
    <script>


        const swiper = new Swiper(".swiper-hero", {
            // Optional parameters
            slidesPerView: 2,
            spaceBetween: 15,
            //slidesPerGroupAuto: true,

            direction: "horizontal",
            loop: true,
            speed: 2000,
            //allowTouchMove: true,
            effect: 'slide',


            autoplay: {

                delay: 2000,
                pauseOnMouseEnter: true,
                disableOnInteraction: false,
            },

            // If we need pagination
            pagination: {
                el: ".swiper-pagination",
                // type: "progressbar"
                clickable: true,
                // dynamicBullets: true
            },

            // Navigation arrows
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },

            // And if we need scrollbar
            // scrollbar: {
            //   el: ".swiper-scrollbar",
            //   draggable: true,
            // },
        });
    </script>
    <!--  -->
    <!-- boostrap -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
    <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <!--  -->
</body>

</html>