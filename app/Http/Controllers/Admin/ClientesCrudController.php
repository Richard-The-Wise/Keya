<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ClientesRequest;
use App\Models\Estado;
use App\Models\GruposCliente;
use App\Models\Municipio;
use App\Models\Paises;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class ClientesCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ClientesCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Clientes::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/clientes');
        CRUD::setEntityNameStrings('clientes', 'clientes');
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
                // Id
                'name'         => 'id', // name of relationship method in the model
                'type'         => 'number',
                'label'        => 'ID', // Table column heading
            ],
            [
                // Grupo de cliente
                'name'         => 'grupo_cliente', // name of relationship method in the model
                'type'         => 'relationship',
                'label'        => 'Grupo', // Table column heading
                // OPTIONAL
                 'entity'    => 'grupo_cliente', // the method that defines the relationship in your Model
                 'attribute' => 'nombre', // foreign key attribute that is shown to user
                 'model'     => GruposCliente::class, // foreign key model
            ],

//            [
//                // Pais
//                'name'         => 'paises', // name of relationship method in the model
//                'type'         => 'relationship',
//                'label'        => 'País', // Table column heading
//                // OPTIONAL
//                'entity'    => 'paises', // the method that defines the relationship in your Model
//                'attribute' => 'nombre', // foreign key attribute that is shown to user
//                'model'     => Paises::class, // foreign key model
//            ],
//            [
//                // Estado
//                'name'         => 'estados', // name of relationship method in the model
//                'type'         => 'relationship',
//                'label'        => 'Estado', // Table column heading
//                // OPTIONAL
//                'entity'    => 'estados', // the method that defines the relationship in your Model
//                'attribute' => 'nombre', // foreign key attribute that is shown to user
//                'model'     => Estado::class, // foreign key model
//            ],
//            [
//                // Municipio
//                'name'         => 'municipios', // name of relationship method in the model
//                'type'         => 'relationship',
//                'label'        => 'Municipio', // Table column heading
//                // OPTIONAL
//                'entity'    => 'estados', // the method that defines the relationship in your Model
//                'attribute' => 'nombre', // foreign key attribute that is shown to user
//                'model'     => Municipio::class, // foreign key model
//            ],
        ]);
        CRUD::column('nombre_comercial');
        CRUD::column('razon_social');
        CRUD::column('email');

        CRUD::column('estatus');
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(ClientesRequest::class);
        $this->crud->addFields([
        [   // Nombre Comercial
            'name'  => 'nombre_comercial',
            'label' => "Nombre Comercial",
            'type'  => 'text',
        ],
        [   // Razon Social
            'name'  => 'razon_social',
            'label' => "Razón Social",
            'type'  => 'text',
        ],
        [   // Email
            'name'  => 'email',
            'label' => 'Email Address',
            'type'  => 'email'
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
            'data_source' => url("webapi/obtenerEstados"), // url to controller search function (with /{id} should return model)
            'model'                   => Estado::class, // foreign key model
            'include_all_form_fields' => true, // optional - only send the current field through AJAX (for a smaller payload if you're not using multiple chained select2s)

        ],

//        [   // Municipio Ajax
//            'label'       => "Municipio", // Table column heading
//            'placeholder' => 'SELECCIONE MUNICIPIO',
//            'minimum_input_length' => 1,
//            'type'        => "select2_from_ajax",
//            'name'        => 'municipio_id', // the column that contains the ID of that connected entity
//            'entity'      => 'municipios', // the method that defines the relationship in your Model
//            'attribute'   => "nombre", // foreign key attribute that is shown to user
//            'data_source' => url("webapi/obtenerMunicipios"), // url to controller search function (with /{id} should return model)
//            'model'                   => Municipio::class, // foreign key model
//            'include_all_form_fields' => true, // optional - only send the current field through AJAX (for a smaller payload if you're not using multiple chained select2s)
//        ],
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

        [
            // Grupo de cliente
            'name'         => 'grupo_cliente', // name of relationship method in the model
            'type'         => 'relationship',
            'label'        => 'Grupo de cliente', // Table column heading
            // OPTIONAL
            'entity'    => 'grupo_cliente', // the method that defines the relationship in your Model
            'attribute' => 'nombre', // foreign key attribute that is shown to user
            'model'     => GruposCliente::class, // foreign key model
        ],
        [   // Calle
            'name'  => 'calle',
            'label' => "Calle",
            'type'  => 'text',
        ],
        [   // Numero exterior
            'name'  => 'numero_exterior',
            'label' => "Número Exterior",
            'type'  => 'number',
        ],
        [   // Numero interior
            'name'  => 'numero_interior',
            'label' => "Número Interior",
            'type'  => 'number',
        ],
        [   // Colonia
            'name'  => 'colonia',
            'label' => "Colonia",
            'type'  => 'text',
        ],
        [   // Código postal
            'name'  => 'codigo_postal',
            'label' => "Código postal",
            'type'  => 'number',
        ],
        [   // Enum
            'name'  => 'estatus',
            'label' => 'Estatus',
            'type'  => 'enum'
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
}
