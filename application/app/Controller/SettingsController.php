<?php
App::uses('AdminAppController', 'Controller');

/**
 * Settings Controller
 *
 * @property Setting $Setting
 * @property Search.PrgComponent $Search.Prg
 * @property AdminComponent $Admin
 */
class SettingsController extends AdminAppController
{
    /* inject */
    /**
     * Paginate
     *
     * @var array
     */
    public $paginate = array(
        'limit' => 20,
    );

    /**
     * Helpers
     *
     * @var array
     */
    public $helpers = array('Admin');

    /**
     * Components
     *
     * @var array
     */
    public $components = array(
        'Paginator',
        'Search.Prg' => array(
            'commonProcess' => array('paramType' => 'named'),
            'presetForm'    => array('paramType' => 'named')
        ),
        'Admin'
    );

    private $typeMap = array(
        'integer'  => array(
            'type' => 'number'
        ),
        'string'   => array(
            'type' => 'text',
        ),
        'boolean'  => array(
            'type' => 'checkbox',
        ),
        'select'   => array(
            'type' => 'select',
        ),
        'date'     => array(
            'type'   => 'text',
            'class'  => 'date',
            'append' => '<i class="icon-calendar"></i>'
        ),
        'datetime' => array(
            'type'   => 'text',
            'class'  => 'datetime',
            'append' => '<i class="icon-calendar"></i>'
        ),
    );


    /**
     * beforeFilter method
     *
     * @return void
     */
    public function beforeFilter()
    {

        if (isset($this->request->params['prefix'])) {
            $this->set('model', $this->Setting);
        }
        parent::beforeFilter();
    }


    /**
     * admin_index method
     *
     * @return void
     */
    public function admin_index()
    {
        $this->Setting->recursive = 0;
        try {
            $records = $this->Paginator->paginate();
        } catch (NotFoundException $e) {
            $this->Admin->setFlashInfo(
                '<strong>Sin Resultados para esa página!</strong> Ahora estamos en la primera página.'
            );
            $this->redirect(Set::merge(Set::get($this->request->params, 'named'), array('page' => 1)));
        }
        $this->set('settings', $records);
    }


    /**
     * admin_view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function admin_view($id = null)
    {
        if (!$this->Setting->exists($id)) {
            throw new NotFoundException('El registro no existe');
        }
        $this->set('setting', $this->Setting->find('first', array('conditions' => array('Setting.id' => $id))));
    }


    /**
     * admin_edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function admin_edit($id = null)
    {
        if (!$this->Setting->exists($id)) {
            throw new NotFoundException('Registro inválido');
        }
        $setting = $this->Setting->find('first', array('conditions' => array('id' => $id)));
        if (!$setting['Setting']['overridable']) {
            throw new ForbiddenException();
        }

        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Setting->save($this->request->data)) {
                $this->Admin->setFlashSuccess('El registro ha sido guardado');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Admin->setFlashError('El registro no se pudo guardar. Por favor intenta más tarde.');
            }
        } else {
            $this->request->data = $setting;
        }
        $type = $this->typeMap[$setting['Setting']['type']];
        if ($setting['Setting']['type'] == 'select' && isset($setting['Setting']['options'])) {
            $type['options'] = $setting['Setting']['options'];
        }
        $this->set('type', $type);
    }


    public function admin_delete($id = null)
    {
        $this->Setting->id = $id;
        if (!$this->Setting->exists()) {
            throw new NotFoundException(__('Registro inválido'));
        }
        $this->request->onlyAllow('post', 'delete');

        $this->Setting->delete();

        $this->Admin->setFlashSuccess('Configuración custom borrada');
        $this->redirect(array('action' => 'index'));
    }


    public function admin_bulk_delete()
    {
        if (!$this->request->data['Delete']['conditions']) {
            $this->Admin->setFlashError('No hay configuraciones para limpiar');
            $this->redirect(array('action' => 'index'));
        }

        $ids = explode(',', $this->request->data['Delete']['conditions']);

        foreach ($ids as $id) {
            $this->Setting->id = $id;
            $this->Setting->delete();
        }

        $this->Admin->setFlashSuccess('Configuraciones custom borradas');
        $this->redirect(array('action' => 'index'));
    }


    /**
     * Disabled methods
     */


    public function admin_delete_file($id, $field)
    {
        throw new MethodNotAllowedException();
    }


    public function admin_export()
    {
        throw new MethodNotAllowedException();
    }


    public function admin_sort($id, $field, $value)
    {
        throw new MethodNotAllowedException();
    }


    public function admin_toggle($id, $field)
    {
        throw new MethodNotAllowedException();
    }


    public function admin_bulk_export()
    {
        throw new MethodNotAllowedException();
    }


}
