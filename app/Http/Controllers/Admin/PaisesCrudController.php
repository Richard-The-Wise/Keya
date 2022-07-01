<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\PaisesRequest;
use App\Models\Paises;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Http\Request;

/**
 * Class PaisesCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class PaisesCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(Paises::class);
//        $this->crud->setModel(Paises::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/paises');
        CRUD::setEntityNameStrings('País', 'Países');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        $this -> crud -> addColumns([[
            'name'  => 'id', // The db column name
            'label' => 'ID', // Table column heading
            'type'  => 'number'
        ],[
            'name'  => 'nombre',
            'label' => 'PAIS',
            'type'  => 'text'
        ],]);
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(PaisesRequest::class);
       $this -> crud -> addFields([[   // Text
           'name'  => 'nombre',
           'label' => "Pais",
           'type'  => 'text',
       ],]);
    }

    /**
     * Define what happens when the Update operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }

    public function obtenerPaises(Request $request){
        $buscar = $request->input('q');
        if ($buscar) {
            $resultados = Paises::query()
                ->where('nombre', 'LIKE', '%'.$buscar.'%')
                ->paginate(10);
        } else {
            $resultados = Paises::query()->paginate(10);
        }
        return $resultados;
    }
}
