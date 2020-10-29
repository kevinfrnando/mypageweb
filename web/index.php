<?php
require_once "../admin/app/controllers/PageController.php";
try {

    $page = new PageController();
    $page = $page->getData();
}catch ( Exception $e){

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title><?php echo $page["profile"]->main_name?></title>
  <meta content="" name="descriptison">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/icon.ico" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/icofont/icofont.min.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/venobox/venobox.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header-tops">
    <div class="container">

      <h1><a href="#"><?php echo $page["profile"]->main_name?></a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
      <h2><?php echo $page["profile"]->main_legend?></h2>

      <nav class="nav-menu d-none d-lg-block">
        <ul>
            <ul>

                <?php $i = 0;
                foreach ($page["tabs"] as $tab ) { ?>
                    <li <?php echo $i== 0? "class='active'" : '' ?>><a href="#<?php echo $tab->href?>"><?php echo $tab->description ?></a></li>
                    <?php $i = $i + 1; } ?>
            </ul>

        </ul>
      </nav><!-- .nav-menu -->

      <div class="social-links">
          <?php foreach ( $page["socialMedia"] as $media ) { ?>
            <a href="<?php echo $media->url; ?>" target="_blank"><i class="<?php echo $media->ico?>"></i></a>
          <?php } ?>
      </div>

    </div>
  </header><!-- End Header -->

  <!-- ======= About Section ======= -->
  <section id="about" class="about">

    <!-- ======= About Me ======= -->
    <div class="about-me container">

      <div class="section-title">
        <h2>Perfil</h2>
        <p>Conoce más acerca de mí</p>
      </div>

      <div class="row">
        <div class="col-lg-4" data-aos="fade-right">
          <img src="../../media/images/web/profile/espontaneo.jpg" class="img-fluid" alt="">
        </div>
        <div class="col-lg-8 pt-4 pt-lg-0 content" data-aos="fade-left">
          <h3><?php echo $page["profile"]->bio_title;?></h3>
          <p class="font-italic">
            "<?php echo $page["profile"]->bio_legend?>".
          </p>
          <hr>
          <div class="row">
            <div class="col-lg-6">
              <ul>
                <li><i class="icofont-rounded-right"></i> <strong>Nacimiento:</strong> <?php echo $page["profile"]->birthday;?></li>
                <li><i class="icofont-rounded-right"></i> <strong>Nacionalidad:</strong> <?php echo $page["profile"]->nationality;?></li>
                <li><i class="icofont-rounded-right"></i> <strong>Residencia:</strong> <?php echo $page["profile"]->residency;?></li>
              </ul>
            </div>
            <div class="col-lg-6">
              <ul>
                <li><i class="icofont-rounded-right"></i> <strong>Profesión:</strong> <?php echo $page["profile"]->profession;?></li>
                <li><i class="icofont-rounded-right"></i> <strong>Freelance:</strong> <?php echo $page["profile"]->freelance;?></li>
                <li><i class="icofont-rounded-right"></i> <strong>Sangre:</strong> <?php echo $page["profile"]->blood;?></li>
              </ul>
            </div>
          </div>
          <hr>
          <p>
              <?php echo $page["profile"]->bio_profile;?>
          </p>
        </div>
      </div>

    </div><!-- End About Me -->


    <!-- ======= Skills  ======= -->
    <div class="skills container">
        <?php foreach ($page["skillsType"] as $type) { ?>
            <div class="section-title">
                <h2> <?php echo $type->description ?></h2>
            </div>

        <div class="row skills-content">
            <?php foreach ( $page["skills"] as $skill ) {
                if( $skill->type_skills_id == $type->id ) { ?>
            <div class="col-lg-6">
                <div class="progress">
                    <span class="skill"><?php echo $skill->description; ?> <i class="val"><?php echo $skill->percentage;?>%</i></span>
                    <div class="progress-bar-wrap">
                        <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo $skill->percentage;?>" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
            <?php } } ?>
        </div>
        <br>
        <?php } ?>


    </div>
    <!-- End Skills -->


  </section><!-- End About Section -->

  <!-- ======= Resume Section ======= -->
  <section id="resume" class="resume">
    <div class="container">

      <div class="section-title">
        <h2>Formación</h2>
        <p>Chequea mi Formación y Carrera</p>
      </div>

      <div class="row">
        <div class="col-lg-6">
          <h3 class="resume-title">Experiencia Profesional</h3>
            <?php foreach ( $page["experience"] as $experience ) { ?>
                <div class="resume-item">
                    <h4> <?php echo $experience->title?></></h4>
                    <h5><?php echo $experience->date_start;?> - <?php echo $experience->current_experience ? 'Present' : $experience->date_end ;  ?></h5>
                    <p><em><?php echo $experience->company_name?> </em></p>
                    <p>
                    <ul>
                        <?php foreach ($experience->details as $detail ) { ?>
                        <li><?php echo  $detail->description ?></li>
                        <?php } ?>
                    </ul>
                    </p>
                </div>
            <?php } ?>
        </div>

        <div class="col-lg-6">
            <h3 class="resume-title">Educación</h3>
            <?php foreach ( $page["formation"] as $formation ) {
                if ( !$formation->course ) { ?>

                    <div class="resume-item">
                    <h4><?php echo $formation->title ?></h4>
                    <h5><?php echo $formation->start_formation." - ".$formation->end_formation; ?></h5>
                    <p><em> <?php echo $formation->institute; ?></em></p>
                  </div>
                <?php } }?>
            <br>
            <h3 class="resume-title">Cursos Realizados</h3>
            <?php foreach ( $page["formation"] as $formation ) {
                if ( $formation->course ) { ?>
                        <div class="resume-item">
                        <h4><?php echo $formation->title ?></h4>
                        <h5><?php echo $formation->start_formation." - ".$formation->end_formation; ?></h5>
                        <p><em> <?php echo $formation->institute; ?></em></p>
                    </div>
            <?php } } ?>
        </div>

      </div>

    </div>
  </section><!-- End Resume Section -->

  <!-- ======= Sobre Mi ======= -->
  <section id="aboutme" class="services">
    <div class="container">

      <div class="section-title">
        <h2>Más de mi</h2>
        <p>Yo como Baterista</p>
      </div>
      <?php foreach ( $page["about"] as $about ) { ?>
          <div class="row">
              <div class="col-lg-8 pt-4 pt-lg-0 content" data-aos="fade-left">
                  <?php echo $about->description ?>
              </div>
              <div class="col-lg-4" data-aos="fade-right">
                  <img src="../../media/images/web/profile/aboutme.jpg" class="img-fluid" alt="">
              </div>
          </div>
      <?php } ?>



        <?php
        $i = 1 ;
        foreach ( $page["projects"] as $project ){
            if( $i % 2 == 0) { ?>
                <div class="section-title">
                    <p><?php echo $project->title?></p>
                </div>
                <div class="row">
                    <div class="col-lg-6" data-aos="fade-left">
                        <div class="embed-container">
                            <iframe width="560" height="315" src="<?php echo $project->youtube_link?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        </div>
                    </div>
                    <div class="col-lg-6 pt-4 pt-lg-0 content" data-aos="fade-right">
                        <p><?php echo $project->description;?>
                        </p>
                    </div>
                </div>
            <?php } else{ ?>
                <div class="section-title">
                    <p><?php echo $project->title?></p>
                </div>
                <div class="row">
                    <div class="col-lg-6 pt-4 pt-lg-0 content" data-aos="fade-left">
                        <p><?php echo $project->description;?>
                        </p>
                    </div>
                    <div class="col-lg-6" data-aos="fade-right">
                        <div class="embed-container">
                            <iframe width="auto" height="315" src="<?php echo $project->youtube_link?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
        <?php } $i++; } ?>


      <!-- ======= Testimonials ======= -->
      <div class="testimonials container">

        <div class="section-title">
          <h2>Testimonials</h2>
        </div>

        <div class="owl-carousel testimonials-carousel">
            <?php foreach ($page["testimonials"] as $testimonial ) {?>
                <div class="testimonial-item">
                    <p>
                        <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                        <?php echo $testimonial->description; ?>
                        <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                    </p>
                    <img src="../../media/images/web/testimonials/<?php echo $testimonial->image_name?>.jpg" class="testimonial-img" alt="">
                    <h3><?php echo $testimonial->author?></h3>
                    <h4><?php echo $testimonial->title?></h4>
                </div>
            <?php } ?>



        </div>

      </div>
    <!-- End Testimonials  -->

    </div>
  </section><!-- Sobre mi -->


  <section id="covers" class="portfolio">
    <div class="container">

      <div class="section-title">
        <h2>Videos</h2>
        <p>En YouTube </p>
      </div>

      <div class="row">
        <div class="col-lg-12 d-flex justify-content-center">
          <ul id="portfolio-flters">
            <li data-filter="*" class="filter-active">All</li>
            <?php foreach ( $page["coversNav"] as $nav ) { ?>
              <li data-filter=".filter-<?php echo $nav->id?>"><?php echo $nav->description?></li>
            <?php } ?>
          </ul>
        </div>
      </div>



      <div class="row portfolio-container">

          <?php foreach ( $page["covers"] as $cover) { ?>

              <div class="col-lg-4 col-md-6 portfolio-item filter-<?php echo $cover->nav_cover_id?>">
                  <div class="portfolio-wrap">
                      <img class="img-fluid" height="315" alt="" src="http://i.ytimg.com/vi/<?php echo $cover->id_url?>/hqdefault.jpg">
                      <div class="portfolio-info">
                          <div class="icon-box">
                              <h4><a href="<?php echo $cover->url?>" target="_blank"><?php echo $cover->title?></a></h4>

                          </div>
                      </div>
                  </div>
              </div>

          <?php } ?>

      </div>

    </div>
  </section>

  <!-- ======= Contact Section ======= -->
  <section id="contact" class="contact">
    <div class="container">

      <div class="section-title">
        <h2>Contacto</h2>
        <p>Contáctame</p>
      </div>

      <div class="row mt-2">

        <div class="col-md-6 d-flex align-items-stretch">
          <div class="info-box">
            <i class="bx bx-map"></i>
            <h3>Mi dirección</h3>
            <p><?php echo $page["profile"]->residency?></p>
          </div>
        </div>

        <div class="col-md-6 mt-4 mt-md-0 d-flex align-items-stretch">
          <div class="info-box">
            <i class="bx bx-share-alt"></i>
            <h3>Redes Sociales</h3>
            <div class="social-links">
                <?php foreach ( $page["socialMedia"] as $media ) { ?>
                    <a href="<?php echo $media->url; ?>" target="_blank" class="<?php echo $media->description?>"><i class="<?php echo $media->ico?>"></i></a>
                <?php } ?>
            </div>
          </div>
        </div>

        <div class="col-md-6 mt-4 d-flex align-items-stretch">
          <div class="info-box">
            <i class="bx bx-envelope"></i>
            <h3>Escribeme</h3>
            <p><?php echo $page["profile"]->email?></p>
          </div>
        </div>
        <div class="col-md-6 mt-4 d-flex align-items-stretch">
          <div class="info-box">
            <i class="bx bx-phone-call"></i>
            <h3>Llamame</h3>
            <p><?php echo $page["profile"]->movil?></p>
          </div>
        </div>
      </div>

      <form action="forms/contact.php" method="post" role="form" class="php-email-form mt-4">
        <div class="form-row">
          <div class="col-md-6 form-group">
            <input type="text" name="name" class="form-control" id="name" placeholder="Tu Nombre" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
            <div class="validate"></div>
          </div>
          <div class="col-md-6 form-group">
            <input type="email" class="form-control" name="email" id="email" placeholder="Tu Email" data-rule="email" data-msg="Please enter a valid email" />
            <div class="validate"></div>
          </div>
        </div>
        <div class="form-group">
          <input type="text" class="form-control" name="subject" id="subject" placeholder="Asunto" data-rule="minlen:4" data-msg="Please enter at least 8 chars of subject" />
          <div class="validate"></div>
        </div>
        <div class="form-group">
          <textarea class="form-control" name="message" rows="5" data-rule="required" data-msg="Escribe algo..." placeholder="Mensaje"></textarea>
          <div class="validate"></div>
        </div>
        <div class="mb-3">
          <div class="loading">Cargando..</div>
          <div class="error-message"></div>
          <div class="sent-message">Tu mensaje ha sido enviada, gracias!</div>
        </div>
        <div class="text-center"><button type="submit">Enviar mensaje</button></div>
      </form>

    </div>

  </section><!-- End Contact Section -->

  <!-- Footer -->
  <footer id="footer" class="page-footer font-small blue">

    <!-- Copyright -->
    <div class="footer-copyright text-center py-3">© 2020 Copyright:
      <a href="https://mdbootstrap.com/"> MDBootstrap.com</a>
    </div>
    <!-- Copyright -->

  </footer>
  <!-- Footer -->

  <!-- Vendor JS Files -->
  <script src="assets/vendor/jquery/jquery.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/jquery.easing/jquery.easing.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/waypoints/jquery.waypoints.min.js"></script>
  <script src="assets/vendor/counterup/counterup.min.js"></script>
  <script src="assets/vendor/owl.carousel/owl.carousel.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/venobox/venobox.min.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>