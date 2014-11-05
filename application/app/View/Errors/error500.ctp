<?php /* @var $this View */ ?>
<?php $this->layout = 'error'; ?>
<?php
$msgs = array(
  500 => 'Internal Server Error',
  501 => 'Not Implemented',
);
?>
<?php $home = Hash::get( $this->request->params, 'prefix' ) == 'admin' ? '/admin/administration/dashboard' : '/'; ?>
<div class="row-fluid">
  <div class="hero-unit offset2 span8 hero-error">
    <h1><?php echo $error->getCode() . ' ' . Hash::get( $msgs, $error->getCode() ) ?></h1>
    <br/>
    <?php if ( Configure::read( 'debug' ) > 0 ): ?>
      <p><?php echo $error->getMessage(); ?></p>
    <?php endif; ?>
    <br/>
    <p>Se produjo un error en la aplicación. Te recomendamos intentar la operación nuevamente. Podés volver a donde
      estabas haciendo click en el botón de <strong>Volver</strong> de tu navegador.</p>

    <p><b>O podes volver al incio haciendo click en el siguiente botón:</b></p>

    <a href="<?php echo Router::url( $home ) ?>" class="btn btn-large btn-info"><i class="icon-home icon-white"></i> Ir al Inicio</a>
  </div>
</div>