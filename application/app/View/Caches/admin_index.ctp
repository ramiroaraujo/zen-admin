<?php /* @var $this View */ ?>
<div class="row-fluid">
    <div class="row-fluid">
        <div class="span12">
            <h2>Borrar Cache</h2>

            <p>Borrar cache manualmente cuando los tiempos de refresco de caché no son suficientes.</p>

            <?php foreach ($caches as $key => $cache): ?>
                <?php echo $this->Form->postButton($cache, array('action' => 'invalidate', $key), array('class' => 'btn btn-large btn-inverse')) ?>
            <?php endforeach; ?>
        </div>
    </div>
</div>