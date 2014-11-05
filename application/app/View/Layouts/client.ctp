<?php /* @var $this View */ ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php echo $this->Html->charset(); ?>
    <title>
      <?php echo $title_for_layout; ?>
    </title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="description" content="">
    <meta name="author" content="">

    <?php
    echo $this->Html->meta( 'icon' );

    echo $this->AssetCompress->css( 'admin.css', array( 'block' => 'css', 'raw' => Configure::read( 'AssetCompress.raw' ) ) );
    echo $this->AssetCompress->includeCss();
    echo $this->AssetCompress->script( 'admin.js', array( 'block' => 'scriptMiddle', 'raw' => Configure::read( 'AssetCompress.raw' ) ) );

    echo $this->fetch( 'meta' );
    echo $this->fetch( 'css' );
    echo $this->fetch( 'script' );
    echo $this->fetch( 'cssBottom' );
    ?>

      <script type="text/javascript">
          var _gaq = _gaq || [];
          _gaq.push(['_setAccount', 'UA-16218633-9']);
          /*_gaq.push(['_trackPageview', 'index']);*/
          _gaq.push(['_trackPageview']);
          (function () {
              var ga = document.createElement('script');
              ga.type = 'text/javascript';
              ga.async = true;
              ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
              var s = document.getElementsByTagName('script')[0];
              s.parentNode.insertBefore(ga, s);
          })();
      </script>

  </head>
  <body>

  <script>
      dataLayer = [];
  </script>
  <!-- Google Tag Manager -->
  <noscript>
      <iframe src="//www.googletagmanager.com/ns.html?id=GTM-5RTQQD" height="0" width="0"
              style="display:none;visibility:hidden"></iframe>
  </noscript>
  <script>(function (w, d, s, l, i) {
          w[l] = w[l] || [];
          w[l].push({'gtm.start': new Date().getTime(), event: 'gtm.js'});
          var f = d.getElementsByTagName(s)[0], j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : '';
          j.async = true;
          j.src = '//www.googletagmanager.com/gtm.js?id=' + i + dl;
          f.parentNode.insertBefore(j, f);
      })(window, document, 'script', 'dataLayer', 'GTM-5RTQQD');</script>
  <!-- End Google Tag Manager -->

    <!-- loading -->
    <div id="loading" style="display: none; position: absolute; z-index: 10000; top: 0px; left: 0px; width: 100%; height: 100%; background-color: rgba(0,0,0,0)">
      <span class="label label-warning" style="position: absolute; bottom: 10px; right: 10px;">Cargando...</span>
    </div>

    <!-- navbar -->
    <?php echo $this->fetch( 'navbar' ) ?>
    <div class="container-fluid admin">
      <?php
      echo $this->Session->flash();
      echo $this->Session->flash( 'auth' );
      echo $this->fetch( 'content' );
      ?>
    </div>
    <?php
    echo $this->fetch( 'scriptMiddle' );
    echo $this->fetch( 'scriptBottom' );
    echo $this->AssetCompress->includeJs();
    ?>
  </body>
</html>