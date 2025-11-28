<?php

/** @var yii\web\View $this */

$this->title = 'Prime Movies';
?>
<div class="site-index" style="background-color:#0f171e; color:white; min-height:100vh; padding-bottom:40px;">

    <!-- HERO como Amazon Prime -->
    <div style="
        background-image: url('https://m.media-amazon.com/images/G/01/digital/video/merch/TV/Brand/PrimeLogoBanner.jpg');
        background-size: cover;
        background-position: center;
        padding: 120px 20px;
        text-align: left;
    ">
        <h1 style="font-size:48px; font-weight:bold;">Bienvenido a Prime Movies</h1>
        <p style="font-size:22px; max-width:600px;">
            Disfruta miles de películas y series al instante, donde quieras y cuando quieras.
        </p>

        <?php if (Yii::$app->user->isGuest): ?>
            <a href="index.php?r=site/login"
               style="background:#00a8e1; padding:12px 25px; color:white; font-size:20px; border-radius:4px; text-decoration:none;">
                Iniciar Sesión
            </a>
        <?php else: ?>
           <span style="font-size:20px;">Hola, <?= Yii::$app->user->identity->nombre ?> 👋</span>

        <?php endif; ?>
    </div>
    <!-- CARRUSEL ESTILO PRIME -->
<div id="primeCarousel" class="carousel slide mt-5" data-bs-ride="carousel">

    <div class="carousel-indicators">
        <button type="button" data-bs-target="#primeCarousel" data-bs-slide-to="0" class="active"></button>
        <button type="button" data-bs-target="#primeCarousel" data-bs-slide-to="1"></button>
        <button type="button" data-bs-target="#primeCarousel" data-bs-slide-to="2"></button>
    </div>

    <div class="carousel-inner" style="border-radius:10px; overflow:hidden;">

        <div class="carousel-item active">
            <img src="https://disney.images.edge.bamgrid.com/ripcut-delivery/v2/variant/disney/c4fea417-2ca1-4c1c-888f-0ec8a2f7d67d/compose?aspectRatio=1.78&format=webp&width=1200"
                 class="d-block w-100"
                 style="height:300px; object-fit:cover;"
                 alt="Slide 1">
            <div class="carousel-caption">
                <h3>Disfruta las mejores películas</h3>
            </div>
        </div>

        <div class="carousel-item">
            <img src="https://m.media-amazon.com/images/S/pv-target-images/0bd71f672166437dbb1b619548cd817afa0db992b57ebc1245162f4f18bb82e0.jpg"
                 class="d-block w-100"
                 style="height:300px; object-fit:cover;"
                 alt="Slide 2">
            <div class="carousel-caption">
                <h3>Series exclusivas para ti</h3>
            </div>
        </div>

        <div class="carousel-item">
            <img src="https://blog.jefsescritor.com/wp-content/uploads/2019/03/se%C3%B1or-de-los-anillos.jpg"
                 class="d-block w-100"
                 style="height:300px; object-fit:cover;"
                 alt="Slide 3">
            <div class="carousel-caption">
                <h3>Contenido para toda la familia</h3>
            </div>
        </div>

    </div>

    <button class="carousel-control-prev" type="button" data-bs-target="#primeCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
    </button>

    <button class="carousel-control-next" type="button" data-bs-target="#primeCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
    </button>
</div>



    <!-- CONTENIDO ESTILO AMAZON -->
    <div class="body-content" style="padding:40px 20px;">

        <h2 style="margin-bottom:20px;">Explora</h2>

        <div class="row">

            <div class="col-lg-4 mb-3">
                <div style="background:#19232f; padding:20px; border-radius:6px;">
                    <h3>Películas</h3>
                    <p>Explora nuestro catálogo de películas, organizadas por género, año y más.</p>
                    <a class="btn btn-primary" href="index.php?r=pelicula/index">Ver Películas »</a>
                </div>
            </div>

            <div class="col-lg-4 mb-3">
                <div style="background:#19232f; padding:20px; border-radius:6px;">
                    <h3>Directores</h3>
                    <p>Conoce más sobre tus directores favoritos y sus obras, de manera mas cercana.</p>
                    <a class="btn btn-primary" href="index.php?r=director/index">Ver Directores »</a>
                </div>
            </div>

            <div class="col-lg-4 mb-3">
                <div style="background:#19232f; padding:20px; border-radius:6px;">
                    <h3>Géneros</h3>
                    <p>Encuentra contenido por categorías como acción, drama, comedia y más.</p>
                    <a class="btn btn-primary" href="index.php?r=genero/index">Ver Géneros »</a>
                </div>
            </div>

        </div>
    </div>
</div>
