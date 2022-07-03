<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ClienteDireccionesRequest;
use App\Models\Clientes;
use App\Models\Estado;
use App\Models\Municipio;
use App\Models\Paises;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class ClienteDireccionesCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ClienteDireccionesCrudController extends CrudController
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
        CRUD::setModel(\App\Models\ClienteDirecciones::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/cliente-direcciones');
        CRUD::setEntityNameStrings('cliente direcciones', 'cliente direcciones');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {



    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(ClienteDireccionesRequest::class);

        $this->crud->addFields([
            [   // Nombre
                'name'  => 'nombre',
                'label' => "Nombre",
                'type'  => 'text',
            ],
            [   // Calle
                'name'  => 'calle',
                'label' => "Calle",
                'type'  => 'text',
            ],
            [   // Numero Exterior
                'name'  => 'numero_exterior',
                'label' => "Numero Ext",
                'type'  => 'text',
            ],
            [   // Numero Int
                'name'  => 'numero_interior',
                'label' => "Numero Int",
                'type'  => 'text',
            ],
            [   // Colonia
                'name'  => 'colonia',
                'label' => "Colonia",
                'type'  => 'text',
            ],
            [   // Codigo Postal
                'name'  => 'codigo_postal',
                'label' => "Codigo Postal",
                'type'  => 'text',
            ],
            [  // Cliente
                'label'     => "Cliente",
                'type'      => 'select2',
                'name'      => 'cliente_id', // the db column for the foreign key

                // optional
                'entity'    => 'cliente', // the method that defines the relationship in your Model
                'model'     => Clientes::class, // foreign key model
                'attribute' => 'razon_social', // foreign key attribute that is shown to user

                // also optional
                'options'   => (function ($query) {
                    return $query->orderBy('razon_social', 'ASC')->get();
                }), // force the related options to be a custom query, instead of all(); you can use this to filter the results show in the select
            ],
            [   // País Ajax
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
            [   // Estado Ajax
                'label'       => "Estados", // Table column heading
                'placeholder' => 'SELECCIONE ESTADO',
                'minimum_input_length' => 1,
                'type'        => "select2_from_ajax",
                'name'        => 'estado_id', // the column that contains the ID of that connected entity
                'entity'      => 'estados', // the method that defines the relationship in your Model
                'attribute'   => "nombre", // foreign key attribute that is shown to user
                'data_source' => url("webapi/obtenerEstadosDirecciones"), // url to controller search function (with /{id} should return model)
                'model'                   => Estado::class, // foreign key model
                'include_all_form_fields' => true, // optional - only send the current field through AJAX (for a smaller payload if you're not using multiple chained select2s)

            ],
//            [   // Municipio Ajax
//                'label'       => "Municipio", // Table column heading
//                'placeholder' => 'SELECCIONE MUNICIPIO',
//                'minimum_input_length' => 1,
//                'type'        => "select2_from_ajax",
//                'name'        => 'municipio_id', // the column that contains the ID of that connected entity
//                'entity'      => 'municipios', // the method that defines the relationship in your Model
//                'attribute'   => "nombre", // foreign key attribute that is shown to user
//                'data_source' => url("webapi/obtenerMunicipiosDirecciones"), // url to controller search function (with /{id} should return model)
//                'model'                   => Municipio::class, // foreign key model
//                'include_all_form_fields' => true, // optional - only send the current field through AJAX (for a smaller payload if you're not using multiple chained select2s)
//            ],
            [  // Municipio Select
                'label'     => "Municipio",
                'type'      => 'select',
                'name'      => 'municipio_id', // the db column for the foreign key

                // optional
                // 'entity' should point to the method that defines the relationship in your Model
                // defining entity will make Backpack guess 'model' and 'attribute'
                'entity'    => 'municipios',

                // optional - manually specify the related model and attribute
                'model'     => Municipio::class, // related model
                'attribute' => 'nombre', // foreign key attribute that is shown to user

                // optional - force the related options to be a custom query, instead of all();
                'options'   => (function ($query) {
                    return $query->orderBy('nombre', 'ASC')->get();
                }), //  you can use this to filter the results show in the select
            ],
            [   // Estatus
                'name'  => 'estatus',
                'label' => 'Estatus',
                'type'  => 'enum'
            ],
            [   // Tipo
                'name'  => 'tipo',
                'label' => 'Tipo',
                'type'  => 'enum'
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
}
