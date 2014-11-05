<?php /* @var $this View */ ?>

<?php echo $this->AssetCompress->css(
    'home.css',
    array(
        'block' => 'css',
        'raw'   => Configure::read('AssetCompress.raw')
    )
); ?>
<?php echo $this->AssetCompress->script(
    'home.js',
    array(
        'block' => 'scriptBottom',
        'raw'   => Configure::read('AssetCompress.raw')
    )
); ?>


<div class="main-content">
    <div class="content-cta">
        <div class="content-cta-in">
            <div id="slider" class="mkSlider">

                <?php foreach ($slides as $index => $slide): ?>

                    <?php if ($slide['link']): ?><a href="<?php echo $slide['link'] ?>"
                                                    title="<?php echo $slide['name'] ?>"><?php endif; ?>
                    <div class="slide-<?php echo $index ?>" data-color="<?php echo $slide['background_color'] ?>">
                        <img src="<?php echo Router::url($slide['picture']) ?>" alt="<?php echo $slide['name'] ?>"/>
                    </div>

                    <?php if ($slide['link']): ?></a><?php endif; ?>

                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>

<div class="content-body">
    <div class="content-body-in">
        <div class="content-dest-2">
            <div class="content-dest-2-img"><img src="<?php echo Router::url($featuredPromotion['picture']) ?>"/>
            </div>
            <div class="content-dest-2-title"><?php echo $featuredPromotion['name'] ?>
            </div>
            <div class="content-dest-2-txt"><?php echo $featuredPromotion['description'] ?>
            </div>
            <div class="content-dest-2-btn"><a
                    href="<?php echo $featuredPromotion['link'] ?>"><?php echo $featuredPromotion['button_copy'] ?></a>
            </div>
        </div>
        <div class="content-dest">
            <div class="content-dest-img"><img
                    src="<?php echo Router::url('/img/site/positivo-bgh-home-siguenos.png'); ?> "/>
            </div>
            <div class="content-dest-title"><?php echo __d('site', 'SEGUINOS'); ?>
            </div>
            <div class="content-dest-txt"><?php echo __d('site', 'Encontrá las actualizaciones en <strong>Facebook y Twitter</strong> y mirá nuestros videos en <strong>YouTube </strong>'); ?></div>
            <div class="content-dest-btn"><a
                    href="<?php echo Router::url(array('controller' => 'Contacts', 'action' => 'add')) ?>"><?php echo __d('site', 'CONOCÉ MÁS'); ?></a>
            </div>
        </div>
        <div class="content-dest">
            <div class="content-dest-img"><img
                    src="<?php echo Router::url('/img/site/positivo-bgh-home-donde-comprar.png'); ?>"/>
            </div>
            <div class="content-dest-title"><?php echo __d('site', 'DÓNDE COMPRAR'); ?></div>
            <div class="content-dest-txt"><?php echo __d('site', 'Enterate dónde conseguir tu equipo Positivo BGH con nuestro mapa interactivo.'); ?></div>
            <div class="content-dest-btn"><a
                    href="<?php echo Router::url(array('controller' => 'MapShops', 'action' => 'index')) ?>"><?php echo __d('site', 'CONOCÉ MÁS'); ?></a>
            </div>
        </div>
        <div class="content-dest">
            <div class="content-dest-img"><img
                    src="<?php echo Router::url('/img/site/positivo-bgh-home-actualiza-windows.png'); ?>"/>
            </div>
            <div class="content-dest-title"><?php echo __d('site', 'ACTUALIZÁ TU EQUIPO'); ?></div>
            <div class="content-dest-txt"><?php echo __d('site', '<strong>Actualizá tu equipo Positivo BGH a Windows 8.1</strong> y aprovechalo al máximo. Acá te enseñamos cómo hacerlo.'); ?></div>
            <div class="content-dest-btn"><a href="http://www.positivobgh.com.ar/windows8-new/" target="_self"><?php echo __d('site', 'ACTUALIZAR AHORA'); ?></a>
            </div>
        </div>
        <div class="content-twitter">
            <div class="content-twitter-txt">
                <div id="tweets3">654654654</div>
            </div>
        </div>
    </div>
</div>
