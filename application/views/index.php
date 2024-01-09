<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Ai~Project Home</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta name="description" content="C'est une site d'information concernant les intelligences artificielles">


    <!-- Favicon -->
    <link href="<?php echo base_url('assets/img/favicon.ico') ?>" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Nunito:wght@600;700;800&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="<?php echo base_url('assets/lib/animate/animate.min.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/lib/owlcarousel/assets/owl.carousel.min.css') ?>" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="<?php echo base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="<?php echo base_url('assets/css/style.css') ?>" rel="stylesheet">
</head>

<body>
    <!-- Spinner Start -->
    <div id="spinner"
        class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->


    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-white navbar-light shadow sticky-top p-0">
        <a href="<?php echo base_url('Home') ?>" class="navbar-brand d-flex align-items-center px-4 px-lg-5">
            <h2 class="m-0 text-primary"><i class="fa fa-book me-3"></i>Ai~project</h2>
        </a>
        <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto p-4 p-lg-0">
                <a href="#" class="nav-item nav-link active">Home</a>
                <a href="#" onclick="scrollToPartie('afficher-about')" class="nav-item nav-link">About</a>
                <a href="#" onclick="scrollToPartie('afficher-news')" class="nav-item nav-link">News</a>
                <a href="#" onclick="scrollToPartie('afficher-event')" class="nav-item nav-link">Event</a>
                <a href="#" onclick="scrollToPartie('afficher-contact')" class="nav-item nav-link">Contact</a>
            </div>
        </div>
    </nav>
    <!-- Navbar End -->


    <!-- Carousel Start -->
    <div class="container-fluid p-0 mb-5">
        <div class="owl-carousel header-carousel position-relative">
            <div class="owl-carousel-item position-relative">
                <img class="img-fluid" src="<?php echo base_url('assets/img/aiimage.jpg') ?>" alt="">
                <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center"
                    style="background: rgba(24, 29, 56, .7);">
                    <div class="container">
                        <div class="row justify-content-start">
                            <div class="col-sm-10 col-lg-8">
                                <h1 class="display-3 text-white animated slideInDown">AI~News Platform
                                </h1>
                                <p class="fs-5 text-white mb-4 pb-2">Découvrez comment l'intelligence artificielle
                                    révolutionne notre monde et change la façon dont nous vivons, travaillons et
                                    interagissons.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Carousel End -->



    <!-- About Start -->
    <div class="container-xxl py-5" name="afficher-about">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s" style="min-height: 400px;">
                    <div class="position-relative h-100">
                        <img class="img-fluid position-absolute w-100 h-100"
                            src="<?php echo base_url('assets/img/aiimage.jpg') ?>" alt="Ai~Project-About"
                            style="object-fit: cover;">
                    </div>
                </div>
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.3s">
                    <h6 class="section-title bg-white text-start text-primary pe-3">About Us</h6>
                    <h1 class="mb-4">Welcome to Ai~Project</h1>
                    <p class="mb-4">Notre site est dédié à l'exploration et à la diffusion des dernières avancées en
                        matière d'intelligence artificielle. Nous sommes passionnés par le potentiel de cette
                        technologie à résoudre des problèmes complexes et à améliorer la vie des gens. Notre équipe de
                        journalistes et de chercheurs travaille dur pour fournir des articles et des analyses précises
                        et approfondies sur les dernières tendances en matière d'IA, ainsi que pour rendre les
                        informations sur l'IA accessibles à tous. </p>
                    <p class="mb-4">Rejoignez-nous dans cette passionnante aventure de découverte de l'avenir de
                        l'intelligence artificielle.
                    </p>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->


    <!-- Categories Start -->
    <div class="container-xxl py-5 category">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title bg-white text-center text-primary px-3">Categories</h6>
                <h1 class="mb-5">AI Categories</h1>
            </div>
            <div class="row g-3">
                <?php foreach ($categorie as $categorie) { ?>

                    <div class="col-lg-6 col-md-12 wow zoomIn" data-wow-delay="0.3s">
                        <a class="position-relative d-block overflow-hidden" href="">
                            <img class="img-fluid" src="<?php echo $categorie['imagecategorie']; ?>" alt="">
                            <div class="bg-white text-center position-absolute bottom-0 end-0 py-2 px-3"
                                style="margin: 1px;">
                                <h5 class="m-0">
                                    <?php echo $categorie['categorie']; ?>
                                </h5>
                            </div>
                        </a>
                    </div>
                <?php } ?>

            </div>
        </div>
    </div>
    <!-- Categories Start -->


    <!-- Actualite Start -->
    <div class="container-xxl py-5" name="afficher-news">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title bg-white text-center text-primary px-3">Actualites</h6>
                <h1 class="mb-5">Découvrez nos actualités</h1>
            </div>
            <div class="row g-4">
                <?php foreach ($actualite as $actualite) { ?>
                    <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                        <a
                            href="<?php echo base_url('AI-Actualites/' . $actualite['grandtitre'] . '/' . $actualite['idactualite'] . ''); ?>">
                            <div class="team-item bg-light">
                                <div class="overflow-hidden">
                                    <img class="img-fluid"
                                        src="<?php echo 'https://intelligenceartificielle.alwaysdata.net/AI_BO_Project/assets/img/upload/' . $actualite['photoillustration'] ?>"
                                        alt="<?php echo $actualite['grandtitre']; ?>">
                                </div>
                                <div class="text-center p-4">
                                    <h5 class="mb-0">
                                        <?php echo $actualite['grandtitre']; ?>
                                    </h5>
                                    <small>
                                        <?php echo $actualite['datepublication']; ?>
                                    </small>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <!-- Team End -->


    <!-- Evenement Start -->
    <div class="container-xxl py-5" name="afficher-event">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title bg-white text-center text-primary px-3">Evenement</h6>
                <h1 class="mb-5">Découvrez nos évènements</h1>
            </div>
            <div class="row g-4">
                <?php foreach ($event as $event) { ?>
                    <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                        <a
                            href="<?php echo base_url('AI-Actualites/' . $event['grandtitre'] . '/' . $event['idactualite'] . ''); ?>">
                            <div class="team-item bg-light">
                                <div class="overflow-hidden">
                                    <img class="img-fluid"
                                        src="<?php echo 'https://intelligenceartificielle.alwaysdata.net/AI_BO_Project/assets/img/upload/' . $event['photoillustration'] ?>"
                                        alt="<?php echo $event['grandtitre']; ?>">
                                </div>
                                <div class="text-center p-4">
                                    <h5 class="mb-0">
                                        <?php echo $event['grandtitre']; ?>
                                    </h5>
                                    <small>
                                        <?php echo $event['datepublication']; ?>
                                    </small>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <!-- Evenement End -->


    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-light footer pt-5 mt-5 wow fadeIn" name="afficher-contact"
        data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-white mb-3">Quick Link</h4>
                    <a class="btn btn-link" href="">About Us</a>
                    <a class="btn btn-link" href="">Contact Us</a>
                    <a class="btn btn-link" href="">Privacy Policy</a>
                    <a class="btn btn-link" href="">Terms & Condition</a>
                    <a class="btn btn-link" href="">FAQs & Help</a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-white mb-3">Contact</h4>
                    <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>123 Street, New York, USA</p>
                    <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>+012 345 67890</p>
                    <p class="mb-2"><i class="fa fa-envelope me-3"></i>info@example.com</p>
                    <div class="d-flex pt-2">
                        <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-youtube"></i></a>
                        <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-white mb-3">Gallery</h4>
                    <div class="row g-2 pt-2">
                        <div class="col-4">
                            <img class="img-fluid bg-light p-1" src="img/course-1.jpg" alt="">
                        </div>
                        <div class="col-4">
                            <img class="img-fluid bg-light p-1" src="img/course-2.jpg" alt="">
                        </div>
                        <div class="col-4">
                            <img class="img-fluid bg-light p-1" src="img/course-3.jpg" alt="">
                        </div>
                        <div class="col-4">
                            <img class="img-fluid bg-light p-1" src="img/course-2.jpg" alt="">
                        </div>
                        <div class="col-4">
                            <img class="img-fluid bg-light p-1" src="img/course-3.jpg" alt="">
                        </div>
                        <div class="col-4">
                            <img class="img-fluid bg-light p-1" src="img/course-1.jpg" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-white mb-3">Newsletter</h4>
                    <p>Dolor amet sit justo amet elitr clita ipsum elitr est.</p>
                    <div class="position-relative mx-auto" style="max-width: 400px;">
                        <input class="form-control border-0 w-100 py-3 ps-4 pe-5" type="text" placeholder="Your email">
                        <button type="button"
                            class="btn btn-primary py-2 position-absolute top-0 end-0 mt-2 me-2">SignUp</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="copyright">
                <div class="row">
                    <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                        &copy; <a class="border-bottom" href="#">Your Site Name</a>, All Right Reserved.

                        <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                        Designed By <a class="border-bottom" href="https://htmlcodex.com">HTML Codex</a>
                    </div>
                    <div class="col-md-6 text-center text-md-end">
                        <div class="footer-menu">
                            <a href="">Home</a>
                            <a href="">Cookies</a>
                            <a href="">Help</a>
                            <a href="">FQAs</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script>
        function scrollToPartie(name) {
            var partie = document.getElementsByName(name)[0];
            window.scrollTo({
                top: partie.offsetTop,
                behavior: "smooth"
            });
        }
    </script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo base_url('assets/lib/wow/wow.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/lib/easing/easing.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/lib/waypoints/waypoints.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/lib/owlcarousel/owl.carousel.min.js') ?>"></script>

    <script async src="https://www.googletagmanager.com/gtag/js?id=G-99XN9JLVM1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag() { dataLayer.push(arguments); }
        gtag('js', new Date());

        gtag('config', 'G-99XN9JLVM1');
    </script>
    <!-- Template Javascript -->
    <script src="<?php echo base_url('assets/js/main.js') ?>"></script>
</body>

</html>