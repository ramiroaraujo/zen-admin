<?php /* @var $this View */ ?>
<?php $this->layout = 'error'; ?>
<?php
$msgs = array(
  400 => 'Bad Request',
  401 => 'Unauthorized',
  404 => 'Not Found',
  403 => 'Forbidden',
  405 => 'Method Not Allowed'
);
?>
<?php $home = Hash::get( $this->request->params, 'prefix' ) == 'admin' ? '/admin/administration/dashboard' : '/'; ?>
<div class="row-fluid">
  <div class="hero-unit offset2 span8 hero-error">
    <h1><?php echo $error->getCode() . ' ' . $msgs[ $error->getCode() ] ?></h1>
    <br/>
    <p>No pudimos encontrar la URL en nuestra aplicación, o bien no tenés permisos para verla. Podes hacer click en el
      botón de <strong>Volver</strong> de tu navegador para volver a la página anterior.</p>

    <p><b>O podes volver al incio haciendo click en el siguiente botón:</b></p>

    <a href="<?php echo Router::url( $home ) ?>" class="btn btn-large btn-info"><i class="icon-home icon-white"></i> Ir al Inicio</a>
  </div>
</div>