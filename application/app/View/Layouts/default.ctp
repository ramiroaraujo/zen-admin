<?php /* @var $this View */ ?>
<!DOCTYPE html>
<html>
<head>
    <?php echo $this->Html->charset(); ?>

    <title>PositivoBGH</title>
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="icon" type="image/png" href="<?php echo Router::url('/img/site/favicon.png'); ?>"/>

    <?php
    echo $this->Html->meta('icon');
    echo $this->AssetCompress->css('site.css', array('block' => 'css', 'raw' => Configure::read('AssetCompress.raw')));
    echo $this->AssetCompress->includeCss();
    echo $this->AssetCompress->script(
        'site.js',
        array('block' => 'scriptMiddle', 'raw' => Configure::read('AssetCompress.raw'))
    );

    echo $this->fetch('meta');
    echo $this->fetch('css');
    echo $this->fetch('script');
    echo $this->fetch('cssBottom');
    ?>
</head>
<body>
<div class="main-content">
<div class="content-header">
    <div class="header-menu">

        <div class="header-logo">
            <a href="<?php echo Router::url(array('controller' => 'Pages', 'action' => 'home')); ?>"><img
                    src="<?php echo Router::url('/css/images/positivo-bgh-logo.png'); ?>" alt="Positivo BGH"
                    title="Positivo BGH"/></a>
        </div>
        <div class="content-header-mini">
            <div class="header-mini-btn">
                <p<?php echo $this->Nav->isCurrent('Contacts') ?>>
                    <a href="<?php echo Router::url(array('controller' => 'Contacts', 'action' => 'add')) ?>">
                        <?php echo __d('site', 'Contacto'); ?></a>
                </p>
            </div>
            <div class="header-mini-btn">
                <p<?php echo $this->Nav->isCurrent('Faqs') ?>>
                    <a href="<?php echo Router::url(array('controller' => 'Faqs', 'action' => 'index')) ?>">
                        <?php echo __d('site', 'Preguntas Frecuentes'); ?>
                    </a></p>
            </div>
            <div class="header-mini-btn">
                <p<?php echo $this->Nav->isCurrent('PressReleases') ?>>
                    <a href="<?php echo Router::url(
                        array('controller' => 'PressReleases', 'action' => 'index')
                    ) ?>"><?php echo __d('site', 'Comunicación'); ?></a></p>
            </div>
            <div class="header-mini-btn">
                <p<?php echo $this->Nav->isCurrent('MapSupors') ?>>
                    <a href="<?php echo Router::url(array('controller' => 'MapSuports', 'action' => 'index')) ?>">
                        <?php echo __d('site', 'Soporte de Post Venta'); ?>
                    </a></p>
            </div>
            <div class="header-mini-btn">
                <p<?php echo $this->Nav->isCurrent('Pages', 'about') ?>>
                    <a href="<?php echo Router::url(array('controller' => 'Pages', 'action' => 'about')) ?>">
                        <?php echo __d('site', 'Acerca de Positivo BGH'); ?></a></p>
            </div>
            <div class="header-mini-btn">
                <p<?php echo $this->Nav->isCurrent('Pages', 'home') ?>>
                    <a href="<?php echo Router::url(array('controller' => 'Pages', 'action' => 'home')) ?>">
                        <?php echo __d('site', 'Home'); ?></a>
                </p>
            </div>
        </div>
        <div class="header-btn-prod">
            <p<?php echo $this->Nav->isCurrent(array('Products', 'Families', 'Categories')) ?>>
                <a href="<?php echo Router::url(array('controller' => 'Categories', 'action' => 'index')) ?>">
                    <?php echo __d('site', 'PRODUCTOS'); ?></a>
            </p>
        </div>
        <div class="header-btn">
            <p<?php echo $this->Nav->isCurrent('MapShops') ?>>
                <a href="<?php echo Router::url(
                    array('controller' => 'MapShops', 'action' => 'index', 'retail')
                ) ?>">
                    <?php echo __d('site', 'DÓNDE COMPRAR'); ?></a></p>
        </div>
        <div class="header-btn">
            <p<?php echo $this->Nav->isCurrent('Downloads') ?>>
                <a href="<?php echo Router::url(array('controller' => 'Downloads', 'action' => 'index')) ?>">
                    <?php echo __d('site', 'DESCARGAS'); ?></a>
            </p>
        </div>

        <div class="header-search">
            <?php echo $this->Form->create('Search', array('controller' => 'Searches', 'action' => 'search')) ?>
            <?php echo $this->Form->text(
                'keyword',
                array('class' => 'header-search-input', 'placeholder' => __d('site', 'Buscar'))
            ) ?>
            <?php echo $this->Form->end(); ?>
        </div>

        <div class="header-language">
            <?php
            echo $this->I18n->flagSwitcher(
                array(
                    'class' => 'languages',
                )
            );
            ?>
        </div>

    </div>

    <div class="content-drop" style="display:none;" id="drop">
        <div class="content-drop-menu">

            <?php foreach ($categories as $category): ?>
                <div class="drop-btn-<?php echo $category["slug"] ?>">

                    <?php
                    $result = count($category['families']);
                    if ($result > 1) {
                    $categoryUrl = Router::url(
                        array('controller' => 'Families', 'action' => 'index', $category['slug'])
                    ); ?>
                    <a href="<?php echo $categoryUrl ?>" title="<?php echo $category['name'] ?>">
                        <span><?php echo $category['name'] ?>  </span>
                        <?php } else { ?>
                        <?php $categoryUrl = Router::url(
                            array('controller' => 'Products', 'action' => 'index', $category['slug'])
                        ); ?>
                        <a href="<?php echo $categoryUrl ?>" title="<?php echo $category['name'] ?>">
                            <span><?php echo $category['name'] ?>  </span>
                            <?php } ?>
                        </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<?php echo $this->fetch('content'); ?>
<div class="content-footer">
    <div class="content-footer-in">
        <div class="footer-logo"><a href="http://www.positivobgh.com.ar/"><img
                    src="<?php echo Router::url('/css/images/positivo-bgh-footer-logo.png'); ?>" alt="Positivo BGH"
                    title="Positivo BGH"/></a>
        </div>
        <div class="footer-legal">
            <strong>© 2012 POSITIVO BGH</strong> | Informática Fueguina S.A.
            <br/>
            <?php echo __d('site', 'Todos los derechos reservados'); ?>
            |
            <?php echo __d('site', 'Fotos de carácter ilustrativo'); ?>.
        </div>
        <div class="footer-btns">
            <ul>
                <div class="footer-btn">
                    <li<?php echo $this->Nav->isCurrent('Products') ?>>
                        <a href="<?php echo Router::url(
                            array('controller' => 'Categories', 'action' => 'index')
                        ) ?>"><?php echo __d('site', 'Productos'); ?></a></li>
                </div>
                <div class="footer-btn">
                    <li<?php echo $this->Nav->isCurrent('MapShops') ?>>
                        <a href="<?php echo Router::url(
                            array('controller' => 'MapShops', 'action' => 'index', 'retail')
                        ) ?>"><?php echo __d('site', 'Dónde Comprar'); ?></a></li>
                </div>
                <div class="footer-btn">
                    <li<?php echo $this->Nav->isCurrent('Downloads') ?>>
                        <a href="<?php echo Router::url(
                            array('controller' => 'Downloads', 'action' => 'index')
                        ) ?>"><?php echo __d('site', 'Descargas'); ?></a></li>
                </div>

                <div class="footer-btn">
                    <li<?php echo $this->Nav->isCurrent('Pages', 'about') ?>>
                        <a href="<?php echo Router::url(array('controller' => 'Pages', 'action' => 'about')) ?>">
                            <?php echo __d('site', 'Acerca de Positivo BGH'); ?></a></li>
                </div>
                <div class="footer-btn">
                    <li<?php echo $this->Nav->isCurrent('MapSupors') ?>>
                        <a href="<?php echo Router::url(
                            array('controller' => 'MapSuports', 'action' => 'index')
                        ) ?>"><?php echo __d('site', 'Soporte de Post Venta'); ?></a></li>
                </div>
                <div class="footer-btn">
                    <li<?php echo $this->Nav->isCurrent('PressReleases') ?>>
                        <a href="<?php echo Router::url(
                            array('controller' => 'PressReleases', 'action' => 'index')
                        ) ?>"><?php echo __d('site', 'Comunicación'); ?></a></li>
                </div>
                <div class="footer-btn">
                    <li<?php echo $this->Nav->isCurrent('Faqs') ?>>
                        <a href="<?php echo Router::url(array('controller' => 'Faqs', 'action' => 'index')) ?>">
                            <?php echo __d('site', 'Preguntas Frecuentes'); ?></a></li>
                </div>
                <div class="footer-btn">
                    <li<?php echo $this->Nav->isCurrent('Contacts') ?>>
                        <a href="<?php echo Router::url(array('controller' => 'Contacts', 'action' => 'add')) ?>">
                            <?php echo __d('site', 'Contacto'); ?></a>
                    </li>
                </div>
                <div class="footer-btn">
                    <li<?php echo $this->Nav->isCurrent('Pages', 'home') ?>>
                        <a href="<?php echo Router::url(
                            array('controller' => 'Pages', 'action' => 'home')
                        ) ?>"><?php echo __d('site', 'Home'); ?></a></li>
                </div>
                <div class="footer-btn">
                    <li>
                        <a href="<?php echo Router::url(array('controller' => 'Clients', 'action' => 'login')) ?>">
                            <?php echo __d('site', 'Acceso Clientes'); ?></a></li>
                </div>
            </ul>
        </div>

        <div class="footer-redes">
            <div class="footer-title"><?php echo __d('site', 'SÍGUENOS'); ?></div>
            <div class="footer-redes-01"><a href="http://www.facebook.com/PositivoBGH" target="_blank"
                                            onclick="dataLayer.push({'event':'Facebook'});"><span>
                        <?php echo __d('site', 'Facebook'); ?></span></a>
            </div>
            <div class="footer-redes-02"><a href="http://twitter.com/PositivoBGH" target="_blank"
                                            onclick="dataLayer.push({'event':'Twitter'});"><span>
                        <?php echo __d('site', 'Twitter'); ?></span></a>
            </div>
            <div class="footer-redes-03"><a
                    href="http://plus.google.com/u/1/b/112018264004316121343/103671111122428985520/about"
                    target="_blank" onclick="dataLayer.push({'event':'G+'});"><span>
                        <?php echo __d('site', 'Google Plus'); ?></span></a>
            </div>
            <div class="footer-redes-04"><a href="http://www.youtube.com/PositivoBGH" target="_blank"
                                            onclick="dataLayer.push({'event':'Youtube'});"><span>
                        <?php echo __d('site', 'You Tube'); ?></span></a>
            </div>
            <div class="footer-redes-05"><a
                    href="http://www.linkedin.com/company/2627147?trk=tyah&trkInfo=tas%3APositivo"
                    target="_blank" onclick="dataLayer.push({'event':'Linkedin'});"><span>
                        <?php echo __d('site', 'Linkedin'); ?></span></a>
            </div>
        </div>
    </div>
</div>
</div>
<?php
echo $this->fetch('scriptMiddle');
echo $this->fetch('scriptBottom');
echo $this->AssetCompress->includeJs();


$result = count($categories[2]['families']);
?>
</body>
</html>
