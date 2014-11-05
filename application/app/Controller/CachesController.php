<?php
App::uses('AdminAppController', 'Controller');

/**
 * Class CachesController
 */
class CachesController extends AdminAppController
{
    /**
     * @var array
     */
    public $caches = array(
        'default' => array(
            'label' => 'Cache default',
            'model' => null,
        ),
        'core' => array(
            'label' => 'Cache de Sistema',
        ),
    );

    /**
     * @var array
     */
    public $components = array('Admin');


    /**
     *
     */
    public function beforeFilter()
    {
        $this->breadcrumbControllerNames['caches'] = 'Caches';

        parent::beforeFilter();
    }


    /**
     *
     */
    public function admin_index()
    {
        $caches = array_combine(array_keys($this->caches), Hash::extract($this->caches, '{s}.label'));
        $this->set('caches', $caches);
    }


    /**
     * @param $key
     */
    public function admin_invalidate($key = null)
    {
        if (!$this->request->is('post')) {
            throw new ForbiddenException();
        }

        switch ($key) {
            case 'core':
                Cache::clear(false, '_cake_core_');
                Cache::clear(false, '_cake_model_');
                break;
            case 'default':
                Cache::clear(false, 'default');
                break;
            default:
                ClassRegistry::init($this->caches[$key]['model'])->invalidateCache();
        }

        $this->Admin->setFlashInfo('Cache borrado');
        $this->redirect(array('action' => 'index'));
    }
}
