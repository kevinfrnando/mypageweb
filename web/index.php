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
          <img src="assets/img/Profile/me.jpg" class="img-fluid" alt="">
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
          <div class="resume-item">
            <h4>Desarrollador Jr.</h4>
            <h5>Mayo 2019 - Present</h5>
            <p><em>VAOS GROUP  </em></p>
            <p>
            <ul>
              <li>Mantenimiento de DDBB Postgresql.</li>
              <li>Mantenimiento y desarrollo de mejoras y validaciones.</li>
              <li>Desarrollo de Módulos, funciones y validaciones.</li>
              <li>Apoyo en migración de Data de Base de Datos.</li>
            </ul>
            </p>
          </div>
          <div class="resume-item">
            <h4>Programador Front-End </h4>
            <h5>Noviembre 2018 – Mayo 2019</h5>
            <p><em>Platino Marketing </em></p>
            <p>
            <ul>
              <li>Desarrollo de DashBoard y componentes Front-End en AngularJs.</li>
              <li>Implementación de Charts con Chart-Js.</li>
              <li>Implementación de Angular Material.</li>
              <li>Migración de Aplicacion en AngularJs a Angular (v. 7).</li>
              <li>Consumo de API REST FULL (php-Laravel) con AngularJs y Angular (v. 7).</li>
              <li>Implementación de Charts con NgX-Charts con Angular (v. 7)</li>
              <li>Mantenimiento de API REST FULL (PHP-Laravel).</li>
              <li>Manejo de WordPress.</li>
              <li>Administración y creación de correos en Cpanel.</li>
            </ul>
            </p>
          </div>
          <div class="resume-item">
            <h4>Programador Jr SQL (Eventual). </h4>
            <h5>Junio 2018 – Agosto  2018</h5>
            <p><em>Relative Engine  </em></p>
            <p>
            <ul>
              <li>Creación de tablas y relaciones en MsSql.</li>
              <li>Ejecución de scripts de validación y completitud.</li>
              <li>Migración de información de base de Datos Oracle a Sql server</li>
            </ul>
            </p>
          </div>
          <div class="resume-item">
            <h4>Pasante Programador Jr. </h4>
            <h5>Febrero 2018 - Junio 2018</h5>
            <p><em>Lubrilaca – Golden Bear  </em></p>
            <p>
            <ul>
              <li>Soporte a usuarios. </li>
              <li>Programador Jr. .Net, Sql Server & PHP.</li>
              <li>Supervisión y monitoreo de servidor.</li>
            </ul>
            </p>
          </div>
          <div class="resume-item">
            <h4>Practicante, Asistente Sistemas </h4>
            <h5>Agosto 2017 – Diciembre 2017</h5>
            <p><em>Ecuasanitas  </em></p>
            <p>
            <ul>
              <li>Help Desk y Soporte remoto.</li>
              <li>Mantenimiento Preventivo y Correctivo de Equipos.</li>
              <li>Inventario de equipos de cómputo.</li>
            </ul>
            </p>
          </div>
        </div>

        <div class="col-lg-6">
          <h3 class="resume-title">Educación</h3>
          <div class="resume-item">
            <h4>Ingeniero en Sistemas Adm. Computarizados</h4>
            <h5>2012 - 2018</h5>
            <p><em>UNIVERSIDAD DE GUAYAQUIL</em></p>
          </div>
          <div class="resume-item">
            <h4>Bachiler en Administración en Sistemas</h4>
            <h5>2006 - 2012</h5>
            <p><em>Francisco Huerta Rendon</em></p>
<!--            <p>Quia nobis sequi est occaecati aut. Repudiandae et iusto quae reiciendis et quis Eius vel ratione eius unde vitae rerum voluptates asperiores voluptatem Earum molestiae consequatur neque etlon sader mart dila</p>-->
          </div>

<!--          <h3 class="resume-title">Sumary</h3>-->
<!--          <div class="resume-item pb-0">-->
<!--            <h4>Alice Barkley</h4>-->
<!--            <p><em>Innovative and deadline-driven Graphic Designer with 3+ years of experience designing and developing user-centered digital/print marketing material from initial concept to final, polished deliverable.</em></p>-->
<!--            <p>-->
<!--            <ul>-->
<!--              <li>Portland par 127,Orlando, FL</li>-->
<!--              <li>(123) 456-7891</li>-->
<!--              <li>alice.barkley@example.com</li>-->
<!--            </ul>-->
<!--            </p>-->
<!--          </div>-->


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

      <div class="row">
        <div class="col-lg-8 pt-4 pt-lg-0 content" data-aos="fade-left">
          <p>Baterista desde los 16 años, empece viendo y admirando mucho desde entonces hasta a la actualidad a
              <a href="http://www.daveweckl.com/" target="_blank">Dave Weckl</a>, sin duda es la motivación que siempre
              tuve para desarrollar este instrumento de una manera mas técnica, cada vez que veía algun video de el o
              escuchaba su música me motivaba y me inspiraba a practicar más y más, inclusive en la actualidad escucho
              constantemente su música y estoy al tanto de sus proyectos.
          </p>
          <p>Di mis primeros pasos en la bateria tocando en la iglesia a la que asisto desde muy temprana edad hasta
              ahora, aprendiendo poco a poco por mi propia cuenta, con los recursos y materiales que podia conseguir en
              aquel entonces en la red mediante videos de YouTube o Blogs, esto siempre hacia que me empujara a mi mismo
              a ser autodidacta, virtud que puedo gozar no solo en la música, sino en varias areas de mi vida
          </p>
          <p>A pesar de ser una persona autodidacta y que he aprendido de este intrumento por mis propios meritos, llegue
              a un punto que necesitaba de una orientacion musical adecuada, entonces opté por tomar clases particulares
              junto a <a href="https://www.instagram.com/juan_ordonezg/?hl=es-la" target="_blank">Juan Ordoñez</a> un conocido
              baterista de Guayaquil, lo cual ha sido una decision muy valiosa e importante ya que he podido corregir muchos
              errores propios de una persona autodidacta que aprende por su cuenta.
          </p>
        </div>
        <div class="col-lg-4" data-aos="fade-right">
          <img src="assets/img/aboutMe/me_drums2.jpg" class="img-fluid" alt="">
        </div>
      </div>
        <div class="row">
        <div class="col-lg-4" data-aos="fade-right">
            <img src="assets/img/aboutMe/me_drums.jpg" class="img-fluid" alt="">
        </div>
        <div class="col-lg-8 pt-4 pt-lg-0 content" data-aos="fade-left">
            <p>Baterista desde los 16 años, empece viendo y admirando mucho desde entonces hasta a la actualidad a
                <a href="http://www.daveweckl.com/" target="_blank">Dave Weckl</a>, sin duda es la motivación que siempre
                tuve para desarrollar este instrumento de una manera mas técnica, cada vez que veía algun video de el o
                escuchaba su música me motivaba y me inspiraba a practicar más y más, inclusive en la actualidad escucho
                constantemente su música y estoy al tanto de sus proyectos.
            </p>
            <p>Di mis primeros pasos en la bateria tocando en la iglesia a la que asisto desde muy temprana edad hasta
                ahora, aprendiendo poco a poco por mi propia cuenta, con los recursos y materiales que podia conseguir en
                aquel entonces en la red mediante videos de YouTube o Blogs, esto siempre hacia que me empujara a mi mismo
                a ser autodidacta, virtud que puedo gozar no solo en la música, sino en varias areas de mi vida
            </p>
            <p>A pesar de ser una persona autodidacta y que he aprendido de este intrumento por mis propios meritos, llegue
                a un punto que necesitaba de una orientacion musical adecuada, entonces opté por tomar clases particulares
                junto a <a href="https://www.instagram.com/juan_ordonezg/?hl=es-la" target="_blank">Juan Ordoñez</a> un conocido
                baterista de Guayaquil, lo cual ha sido una decision muy valiosa e importante ya que he podido corregir muchos
                errores propios de una persona autodidacta que aprende por su cuenta.
            </p>
        </div>
        </div>

        <div class="section-title">
            <p>Jarrin</p>
        </div>
        <div class="row">
            <div class="col-lg-6 pt-4 pt-lg-0 content" data-aos="fade-left">
                <p>Baterista desde los 16 años, empece viendo y admirando mucho desde entonces hasta a la actualidad a
                    <a href="http://www.daveweckl.com/" target="_blank">Dave Weckl</a>, sin duda es la motivación que siempre
                    tuve para desarrollar este instrumento de una manera mas técnica, cada vez que veía algun video de el o
                    escuchaba su música me motivaba y me inspiraba a practicar más y más, inclusive en la actualidad escucho
                    constantemente su música y estoy al tanto de sus proyectos.
                </p>
                <p>Di mis primeros pasos en la bateria tocando en la iglesia a la que asisto desde muy temprana edad hasta
                    ahora, aprendiendo poco a poco por mi propia cuenta, con los recursos y materiales que podia conseguir en
                    aquel entonces en la red mediante videos de YouTube o Blogs, esto siempre hacia que me empujara a mi mismo
                    a ser autodidacta, virtud que puedo gozar no solo en la música, sino en varias areas de mi vida
                </p>
            </div>
            <div class="col-lg-6" data-aos="fade-right">
                <div class="embed-container">
                    <iframe width="auto" height="315" src="https://www.youtube.com/embed/G087Dx0qxLs" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
            </div>
        </div>


        <div class="section-title">
            <p>Kike Ceron</p>
        </div>
        <div class="row">
            <div class="col-lg-6" data-aos="fade-left">
                <div class="embed-container">
                    <iframe width="560" height="315" src="https://www.youtube.com/embed/Ey2v9I3G5Bk" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
            </div>
            <div class="col-lg-6 pt-4 pt-lg-0 content" data-aos="fade-right">
                <p>Baterista desde los 16 años, empece viendo y admirando mucho desde entonces hasta a la actualidad a
                    <a href="http://www.daveweckl.com/" target="_blank">Dave Weckl</a>, sin duda es la motivación que siempre
                    tuve para desarrollar este instrumento de una manera mas técnica, cada vez que veía algun video de el o
                    escuchaba su música me motivaba y me inspiraba a practicar más y más, inclusive en la actualidad escucho
                    constantemente su música y estoy al tanto de sus proyectos.
                </p>
                <p>Di mis primeros pasos en la bateria tocando en la iglesia a la que asisto desde muy temprana edad hasta
                    ahora, aprendiendo poco a poco por mi propia cuenta, con los recursos y materiales que podia conseguir en
                    aquel entonces en la red mediante videos de YouTube o Blogs, esto siempre hacia que me empujara a mi mismo
                    a ser autodidacta, virtud que puedo gozar no solo en la música, sino en varias areas de mi vida
                </p>
            </div>
        </div>
      <!-- ======= Testimonials ======= -->
      <div class="testimonials container">

        <div class="section-title">
          <h2>Testimonials</h2>
        </div>

        <div class="owl-carousel testimonials-carousel">

          <div class="testimonial-item">
            <p>
              <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                Persona dedicada a su trabajo, decidido a cumplir su meta. Se esfuerza mucho hasta cumplir el éxito. La honestidad en el es algo natural. Siempre es transparente en todas su desicones.
              <i class="bx bxs-quote-alt-right quote-icon-right"></i>
            </p>
            <img src="assets/img/testimonials/juan.jpg" class="testimonial-img" alt="">
            <h3>Juan Ordoñez</h3>
            <h4>Baterista</h4>
          </div>

          <div class="testimonial-item">
            <p>
              <i class="bx bxs-quote-alt-left quote-icon-left"></i>
              Export tempor illum tamen malis malis eram quae irure esse labore quem cillum quid cillum eram malis quorum velit fore eram velit sunt aliqua noster fugiat irure amet legam anim culpa.
              <i class="bx bxs-quote-alt-right quote-icon-right"></i>
            </p>
            <img src="assets/img/testimonials/testimonials-2.jpg" class="testimonial-img" alt="">
            <h3>Sara Wilsson</h3>
            <h4>Designer</h4>
          </div>

          <div class="testimonial-item">
            <p>
              <i class="bx bxs-quote-alt-left quote-icon-left"></i>
              Enim nisi quem export duis labore cillum quae magna enim sint quorum nulla quem veniam duis minim tempor labore quem eram duis noster aute amet eram fore quis sint minim.
              <i class="bx bxs-quote-alt-right quote-icon-right"></i>
            </p>
            <img src="assets/img/testimonials/testimonials-3.jpg" class="testimonial-img" alt="">
            <h3>Jena Karlis</h3>
            <h4>Store Owner</h4>
          </div>

          <div class="testimonial-item">
            <p>
              <i class="bx bxs-quote-alt-left quote-icon-left"></i>
              Fugiat enim eram quae cillum dolore dolor amet nulla culpa multos export minim fugiat minim velit minim dolor enim duis veniam ipsum anim magna sunt elit fore quem dolore labore illum veniam.
              <i class="bx bxs-quote-alt-right quote-icon-right"></i>
            </p>
            <img src="assets/img/testimonials/testimonials-4.jpg" class="testimonial-img" alt="">
            <h3>Matt Brandon</h3>
            <h4>Freelancer</h4>
          </div>

          <div class="testimonial-item">
            <p>
              <i class="bx bxs-quote-alt-left quote-icon-left"></i>
              Quis quorum aliqua sint quem legam fore sunt eram irure aliqua veniam tempor noster veniam enim culpa labore duis sunt culpa nulla illum cillum fugiat legam esse veniam culpa fore nisi cillum quid.
              <i class="bx bxs-quote-alt-right quote-icon-right"></i>
            </p>
            <img src="assets/img/testimonials/testimonials-5.jpg" class="testimonial-img" alt="">
            <h3>John Larson</h3>
            <h4>Entrepreneur</h4>
          </div>

        </div>

      </div><!-- End Testimonials  -->
<!--
      <div class="row">
        <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
          <div class="icon-box">
            <div class="icon"><i class="bx bxl-dribbble"></i></div>
            <h4><a href="">Lorem Ipsum</a></h4>
            <p>Voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi</p>
          </div>
        </div>

        <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-md-0">
          <div class="icon-box">
            <div class="icon"><i class="bx bx-file"></i></div>
            <h4><a href="">Sed ut perspiciatis</a></h4>
            <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore</p>
          </div>
        </div>

        <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-lg-0">
          <div class="icon-box">
            <div class="icon"><i class="bx bx-tachometer"></i></div>
            <h4><a href="">Magni Dolores</a></h4>
            <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia</p>
          </div>
        </div>

        <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4">
          <div class="icon-box">
            <div class="icon"><i class="bx bx-world"></i></div>
            <h4><a href="">Nemo Enim</a></h4>
            <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis</p>
          </div>
        </div>

        <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4">
          <div class="icon-box">
            <div class="icon"><i class="bx bx-slideshow"></i></div>
            <h4><a href="">Dele cardo</a></h4>
            <p>Quis consequatur saepe eligendi voluptatem consequatur dolor consequuntur</p>
          </div>
        </div>

        <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4">
          <div class="icon-box">
            <div class="icon"><i class="bx bx-arch"></i></div>
            <h4><a href="">Divera don</a></h4>
            <p>Modi nostrum vel laborum. Porro fugit error sit minus sapiente sit aspernatur</p>
          </div>
        </div>

      </div>
-->
    </div>
  </section><!-- Sobre mi -->

  <!-- ======= Portfolio Section ======= -->
  <section id="covers" class="portfolio">
    <div class="container">

      <div class="section-title">
        <h2>Media</h2>
        <p>Galeria </p>
      </div>

      <div class="row">
        <div class="col-lg-12 d-flex justify-content-center">
          <ul id="portfolio-flters">
            <li data-filter="*" class="filter-active">All</li>
            <li data-filter=".filter-app">Covers</li>
            <li data-filter=".filter-app">Transcripciones</li>
            <li data-filter=".filter-card">Drumline</li>
            <li data-filter=".filter-card">Imágenes</li>
          </ul>
        </div>
      </div>

      <div class="row portfolio-container">

        <div class="col-lg-4 col-md-6 portfolio-item filter-app">
          <div class="portfolio-wrap">
            <img src="assets/img/portfolio/portfolio-1.jpg" class="img-fluid" alt="">
            <div class="portfolio-info">
              <h4>A Danzar - Barak</h4>
              <p>Cover</p>
              <div class="portfolio-links">
                <a href="https://www.youtube.com/watch?v=SYp6Mbt5yO8" data-gall="portfolioGallery" class="venobox" title="App 1"><i class="bx bx-plus"></i></a>
                <a href="https://www.youtube.com/watch?v=SYp6Mbt5yO8" title="More Details"><i class="bx bx-link"></i></a>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-md-6 portfolio-item filter-web">
          <div class="portfolio-wrap">
            <img src="assets/img/portfolio/portfolio-2.jpg" class="img-fluid" alt="">
            <div class="portfolio-info">
              <h4>Web 3</h4>
              <p>Web</p>
              <div class="portfolio-links">
                <a href="assets/img/portfolio/portfolio-2.jpg" data-gall="portfolioGallery" class="venobox" title="Web 3"><i class="bx bx-plus"></i></a>
                <a href="#" title="More Details"><i class="bx bx-link"></i></a>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-md-6 portfolio-item filter-app">
          <div class="portfolio-wrap">
            <img src="assets/img/portfolio/portfolio-3.jpg" class="img-fluid" alt="">
            <div class="portfolio-info">
              <h4>App 2</h4>
              <p>App</p>
              <div class="portfolio-links">
                <a href="assets/img/portfolio/portfolio-3.jpg" data-gall="portfolioGallery" class="venobox" title="App 2"><i class="bx bx-plus"></i></a>
                <a href="#" title="More Details"><i class="bx bx-link"></i></a>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-md-6 portfolio-item filter-card">
          <div class="portfolio-wrap">
            <img src="assets/img/portfolio/portfolio-4.jpg" class="img-fluid" alt="">
            <div class="portfolio-info">
              <h4>Card 2</h4>
              <p>Card</p>
              <div class="portfolio-links">
                <a href="assets/img/portfolio/portfolio-4.jpg" data-gall="portfolioGallery" class="venobox" title="Card 2"><i class="bx bx-plus"></i></a>
                <a href="#" title="More Details"><i class="bx bx-link"></i></a>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-md-6 portfolio-item filter-web">
          <div class="portfolio-wrap">
            <img src="assets/img/portfolio/portfolio-5.jpg" class="img-fluid" alt="">
            <div class="portfolio-info">
              <h4>Web 2</h4>
              <p>Web</p>
              <div class="portfolio-links">
                <a href="assets/img/portfolio/portfolio-5.jpg" data-gall="portfolioGallery" class="venobox" title="Web 2"><i class="bx bx-plus"></i></a>
                <a href="#" title="More Details"><i class="bx bx-link"></i></a>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-md-6 portfolio-item filter-app">
          <div class="portfolio-wrap">
            <img src="assets/img/portfolio/portfolio-6.jpg" class="img-fluid" alt="">
            <div class="portfolio-info">
              <h4>App 3</h4>
              <p>App</p>
              <div class="portfolio-links">
                <a href="assets/img/portfolio/portfolio-6.jpg" data-gall="portfolioGallery" class="venobox" title="App 3"><i class="bx bx-plus"></i></a>
                <a href="#" title="More Details"><i class="bx bx-link"></i></a>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-md-6 portfolio-item filter-card">
          <div class="portfolio-wrap">
            <img src="assets/img/portfolio/portfolio-7.jpg" class="img-fluid" alt="">
            <div class="portfolio-info">
              <h4>Card 1</h4>
              <p>Card</p>
              <div class="portfolio-links">
                <a href="assets/img/portfolio/portfolio-7.jpg" data-gall="portfolioGallery" class="venobox" title="Card 1"><i class="bx bx-plus"></i></a>
                <a href="#" title="More Details"><i class="bx bx-link"></i></a>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-md-6 portfolio-item filter-card">
          <div class="portfolio-wrap">
            <img src="assets/img/portfolio/portfolio-8.jpg" class="img-fluid" alt="">
            <div class="portfolio-info">
              <h4>Card 3</h4>
              <p>Card</p>
              <div class="portfolio-links">
                <a href="assets/img/portfolio/portfolio-8.jpg" data-gall="portfolioGallery" class="venobox" title="Card 3"><i class="bx bx-plus"></i></a>
                <a href="#" title="More Details"><i class="bx bx-link"></i></a>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-md-6 portfolio-item filter-web">
          <div class="portfolio-wrap">
            <img src="assets/img/portfolio/portfolio-9.jpg" class="img-fluid" alt="">
            <div class="portfolio-info">
              <h4>Web 3</h4>
              <p>Web</p>
              <div class="portfolio-links">
                <a href="assets/img/portfolio/portfolio-9.jpg" data-gall="portfolioGallery" class="venobox" title="Web 3"><i class="bx bx-plus"></i></a>
                <a href="#" title="More Details"><i class="bx bx-link"></i></a>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>
  </section><!-- End Portfolio Section -->

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
            <p>Guayaquil, Ecuador</p>
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
            <p>info@kevinvergara.com</p>
          </div>
        </div>
        <div class="col-md-6 mt-4 d-flex align-items-stretch">
          <div class="info-box">
            <i class="bx bx-phone-call"></i>
            <h3>Llamame</h3>
            <p>+593 985219251</p>
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