<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CSS Iconos de Redes Sociales</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../Styles/style.css">
</head>

<div class="container">
    
    <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
        <div class="col-md-4 d-flex align-items-center">

            <span class="mb-3 mb-md-0 text-body-secondary ">&copy; 2024 Copyright © Shano Luxury | Todos los derechos
                reservados</span>
        </div>



        <style>
            ul {
                position: relative;
                display: flex;
                transform-style: preserve-3d;

                transition: 0.2s;

            }

            ul .buttonFooter {
                position: relative;
                list-style: none;
                width: 60px;
                height: 60px;
                margin: 0 10px;
            }

            ul .buttonFooter:before {
                content: "";
                position: absolute;
                bottom: -10px;
                left: 0;
                width: 100%;
                height: 10px;
                background-color: #FBAED2;
                transform-origin: top;
                transform: skewX(-41deg);

            }

            ul .buttonFooter:after {
                content: "";
                position: absolute;
                top: 0;
                left: -9px;
                width: 9px;
                height: 100%;
                background-color: #FBAED2;
                transform-origin: right;
                transform: skewY(-49deg);

            }


            ul .buttonFooter span {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                display: flex !important;
                justify-content: center;
                align-items: center;
                background-color: #FBAED2;
                color: rgba(255, 255, 255, 0.5);
                font-size: 30px !important;
                transition: 0.3s;

            }

            ul .buttonFooter:hover span {
                z-index: 1000;
                transition: 0.5s;
                color: #FFFFFF;
                box-shadow: -1px 1px 1px rgba(0, 0, 0, 0.05);

            }

            ul .buttonFooter:hover span:nth-child(5) {
                transform: translate(40px, -40px);
                opacity: 1;

            }

            ul .buttonFooter:hover span:nth-child(4) {
                transform: translate(30px, -30px);
                opacity: 0.8;

            }

            ul .buttonFooter:hover span:nth-child(3) {
                transform: translate(20px, -20px);
                opacity: 0.6;

            }

            ul .buttonFooter:hover span:nth-child(2) {

                transform: translate(10px, -10px);
                opacity: 0.4;

            }

            ul .buttonFooter:hover span:nth-child(1) {
                transform: translate(0px, 0px);
                opacity: 0.2;

            }

            ul .buttonFooter:nth-child(1):hover span {
                background: #3b5998;
            }

            ul .buttonFooter:nth-child(2):hover span {
                background: linear-gradient(125deg, #ff0050, #00f2ea, #000000);
            }

            ul .buttonFooter:nth-child(3):hover span {
                background: linear-gradient(125deg, #515bd4, #8134af, #dd2a7b, #f58529);
            }

            ul .buttonFooter:nth-child(4):hover span {
                background: #4dc247;
            }

            ul li:nth-child(5):hover span {
                background: #007bb5;
            }
        </style>

        <body>

            <ul>
                <li class="buttonFooter">
                    <a href="#">
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                        <span class="bi bi-facebook"></span>
                    </a>
                </li>

                <li class="buttonFooter">
                    <a href="https://www.tiktok.com/@shanoah.luxxury">
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                        <span class="bi bi-tiktok"></span>
                    </a>
                </li>

                <li class="buttonFooter">
                    <a href="https://www.instagram.com/shanoah_luxury_/">
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                        <span class="bi bi-instagram"></span>
                    </a>
                </li>

                <li class="buttonFooter">
                    <a href="#">
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                        <span class="bi bi-whatsapp"></span>
                    </a>
                </li>
            </ul>
        </body>

    </footer>
</div>