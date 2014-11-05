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
    echo $this->Html->meta('icon');

    echo $this->AssetCompress->css('admin.css', array('block' => 'css', 'raw' => Configure::read('AssetCompress.raw')));
    echo $this->AssetCompress->includeCss();
    echo $this->AssetCompress->script(
        'admin.js',
        array('block' => 'scriptMiddle', 'raw' => Configure::read('AssetCompress.raw'))
    );

    echo $this->fetch('meta');
    echo $this->fetch('css');
    echo $this->fetch('script');
    echo $this->fetch('cssBottom');
    ?>
</head>
<body>

<!-- loading -->
<div id="loading"
     style="display: none; position: absolute; z-index: 10000; top: 0px; left: 0px; width: 100%; height: 100%; background-color: rgba(0,0,0,0)">
    <span class="label label-warning" style="position: absolute; bottom: 10px; right: 10px;">Cargando...</span>
</div>

<!-- navbar -->
<?php if ($this->Session->read('Auth.User')): ?>
    <div class="navbar navbar-fixed-top">
        <div class="navbar-inner">
            <div class="container-fluid">
                <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <a class="brand" title="Inicio" href="<?php echo Router::url('/admin/administration/dashboard'); ?>">ZenAdmin</a>

                <div class="nav-collapse collapse">
                    <ul class="nav">
                        <!-- nav injects >> -->
                        <!-- << nav injects -->
                    </ul>
                    <ul class="nav pull-right">
                        <li class="divider-vertical"></li>
                        <li><p class="navbar-text">Usuario: <?php echo $this->Session->read('Auth.User.name') ?></li>
                        <li class="divider-vertical"></li>
                        <li class="dropdown">
                            <a href="#" title="Opciones" class="dropdown-toggle" data-toggle="dropdown"><i
                                    class="icon-cog"></i></a>
                            <ul class="dropdown-menu">
                                <?php if ($this->Session->read('Auth.User.username') != 'positivo'): ?>
                                    <?php echo $this->Admin->navListLink(
                                        'Configuración',
                                        array('controller' => 'settings', 'action' => 'index')
                                    ); ?>
                                    <?php echo $this->Admin->navListLink(
                                        'Limpiar Cache',
                                        array('controller' => 'caches', 'action' => 'index')
                                    ); ?>
                                    <!-- settings injects >> -->
                                    <!-- << settings injects -->
                                    <li class="divider"></li>
                                <?php endif; ?>
                                <li><a href="<?php echo Router::url('/admin/logout'); ?>">Cerrar Sesión</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <?php echo $this->element('admin/warns') ?>
        <?php if (count($navTree)): ?>
            <ul class="breadcrumb">
                <?php $crumbs = count($navTree) ?>
                <?php foreach ($navTree as $index => $crumb): ?>
                    <?php if ($index < ($crumbs - 1)): ?>
                        <li>
                            <a href="<?php echo Router::url($crumb['route']) ?>"><?php echo $crumb['name'] ?></a>
                            <span class="divider">/</span>
                        </li>
                    <?php else: ?>
                        <li class="active"><?php echo $crumb['name'] ?></li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>

<?php endif; ?>
<div class="container-fluid admin">
    <?php
    echo $this->Session->flash();
    echo $this->Session->flash('auth');
    echo $this->fetch('content');
    ?>
</div>
<?php
echo $this->fetch('scriptMiddle');
echo $this->fetch('scriptBottom');
echo $this->AssetCompress->includeJs();
?>
</body>
</html>
