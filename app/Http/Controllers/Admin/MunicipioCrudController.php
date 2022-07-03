<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\MunicipioRequest;
use App\Models\Estado;
use App\Models\Municipio;
use App\Models\Paises;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use http\Client\Request;

/**
 * Class MunicipioCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class MunicipioCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Municipio::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/municipio');
        CRUD::setEntityNameStrings('municipio', 'municipios');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        $this->crud->addColumns([

            [
                // any type of relationship
                'name'         => 'paises', // name of relationship method in the model
                'type'         => 'relationship',
                'label'        => 'Pais', // Table column heading
                // OPTIONAL
                 'entity'    => 'paises', // the method that defines the relationship in your Model
                 'attribute' => 'nombre', // foreign key attribute that is shown to user
                 'model'     => Paises::class, // foreign key model
            ],
            [
                // any type of relationship
                'name'         => 'estados', // name of relationship method in the model
                'type'         => 'relationship',
                'label'        => 'Estado', // Table column heading
                // OPTIONAL
                 'entity'    => 'estados', // the method that defines the relationship in your Model
                 'attribute' => 'nombre', // foreign key attribute that is shown to user
                 'model'     => Estado::class, // foreign key model
            ],
            [
                'name'      => 'id', // The db column name
                'label'     => 'ID', // Table column heading

            ],
            [
                'name'      => 'nombre', // The db column name
                'label'     => 'Municipio', // Table column heading
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
//        CRUD::setValidation(MunicipioRequest::class);
        $this->crud->addFields([

            [   // 1-n relationship
                'label'       => "Paises", // Table column heading
                'placeholder' => 'SELECCIONE PAIS',
                'minimum_input_length' => 1,
                'type'        => "select2_from_ajax",
                'name'        => 'pais_id', // the column that contains the ID of that connected entity
                'entity'      => 'paises', // the method that defines the relationship in your Model
                'attribute'   => "nombre", // foreign key attribute that is shown to user
                'data_source' => url("webapi/obtenerPaises"), // url to controller search function (with /{id} should return model)
                'model'                   => Paises::class, // foreign key model
                'include_all_form_fields' => false, // optional - only send the current field through AJAX (for a smaller payload if you're not using multiple chained select2s)

            ],

            [   // 1-n relationship
                'label'       => "Estados", // Table column heading
                'placeholder' => 'SELECCIONE ESTADO',
                'minimum_input_length' => 1,
                'type'        => "select2_from_ajax",
                'name'        => 'estado_id', // the column that contains the ID of that connected entity
                'entity'      => 'estados', // the method that defines the relationship in your Model
                'attribute'   => "nombre", // foreign key attribute that is shown to user
                'data_source' => url("webapi/obtenerEstados"), // url to controller search function (with /{id} should return model)
                'model'                   => Estado::class, // foreign key model
                'include_all_form_fields' => true, // optional - only send the current field through AJAX (for a smaller payload if you're not using multiple chained select2s)

            ],

            [   // Text
                'name'  => 'nombre',
                'label' => "Municipio",
                'type'  => 'text',
            ]
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

    public function obtenerMunicipios(Request $request){
        $search_term = $request->input('q');
        $pais_id = $request->form[5]['value'];
        $estado_id = $request->form[6]['value'];

        if ($search_term)
        {
            $results = Municipio::query()
            ->where('pais_id',$pais_id)
            ->where('estado_id',$estado_id)
            ->where('nombre', 'LIKE', '%'.$search_term.'%')
            ->paginate(10);
        }
        else
        {
            $results = Municipio::query()
            ->where('nombre', 'LIKE', '%'.$search_term.'%')
            ->paginate(10);
        }

        return $results;
    }

    public function obtenerMunicipiosDirecciones(Request $request)
    {
        $search_term = $request->input('q');
        $estado_id = $request->form[10]['value'];

        if ($search_term) {
            $results = Municipio::query()
                ->where('estado_id' , $estado_id)
                ->where('nombre', 'LIKE', '%'.$search_term.'%')
                ->paginate(10);

        } else {
            $results = Municipio::query()
                ->where('estado_id',$estado_id)
                ->paginate(10);
        }

        return $results;
    }

}
