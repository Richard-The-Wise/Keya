<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\EstadoRequest;
use App\Models\Estado;
use App\Models\Paises;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Http\Request;

/**
 * Class EstadoCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class EstadoCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Estado::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/estado');
        CRUD::setEntityNameStrings('estado', 'estados');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        $this->crud-> addColumns([
            [
                // any type of relationship
                'name'         => 'estados', // name of relationship method in the model
                'type'         => 'relationship',
                'label'        => 'Paises', // Table column heading
                // OPTIONAL
                 'entity'    => 'paises', // the method that defines the relationship in your Model
                 'attribute' => 'nombre', // foreign key attribute that is shown to user
                 'model'     => Paises::class, // foreign key model
            ],

            [
                // any type of relationship
                'name'         => 'id', // name of relationship method in the model
                'type'         => 'number',
                'label'        => 'ID', // Table column heading

            ],

            [
                'name'         => 'nombre', // name of relationship method in the model
                'type'         => 'text',
                'label'        => 'Nombre', // Table column heading
            ]
        ]);

    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        $this-> crud -> setValidation(EstadoRequest::class);
        $this -> crud -> addFields([

            [  // Select2
                'label'     => "Paises",
                'type'      => 'select2',
                'name'      => 'pais_id', // the db column for the foreign key

                // optional
                'entity'    => 'paises', // the method that defines the relationship in your Model
                'model'     => Paises::class, // foreign key model
                'attribute' => 'nombre', // foreign key attribute that is shown to user

                // also optional
                'options'   => (function ($query) {
                    return $query->orderBy('nombre', 'ASC')->get();
                }), // force the related options to be a custom query, instead of all(); you can use this to filter the results show in the select
            ],

            [   // Text
                'name'  => 'nombre',
                'label' => "Estado",
                'type'  => 'text',
            ],

        ]);

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

    public function obtenerEstados(Request $request)
    {
        $search_term = $request->input('q');
        $pais_id = $request->form[2]['value'];

        if (isset($request->form[5]['value'])){
            $pais_id = $request->form[5]['value'];
        }

        if ($search_term) {

            if (isset($request->form[5]['value'])){
                $results = Estado::query()
                ->where('pais_id' , $pais_id)
                ->where('nombre', 'LIKE', '%'.$search_term.'%')
                ->paginate(10);
            }else{
                $results = Estado::query()
                ->where('pais_id' , $pais_id)
                ->where('nombre', 'LIKE', '%'.$search_term.'%')
                ->paginate(10);
            }

        } else {
            $results = Estado::query()
                ->where('pais_id',$pais_id)
                ->paginate(10);
        }

        return $results;
    }

    public function obtenerEstadosDirecciones(Request $request)
    {
        $search_term = $request->input('q');
        $pais_id = $request->form[9]['value'];

        if ($search_term) {
            $results = Estado::query()
                ->where('pais_id' , $pais_id)
                ->where('nombre', 'LIKE', '%'.$search_term.'%')
                ->paginate(10);

        } else {
            $results = Estado::query()
                ->where('pais_id',$pais_id)
                ->paginate(10);
        }

        return $results;
    }
}
