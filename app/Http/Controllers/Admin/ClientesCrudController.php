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
        [  // Pais
            'label'     => "Pais",
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
        [  // Estado
            'label'     => "Estado",
            'type'      => 'select2',
            'name'      => 'estado_id', // the db column for the foreign key

            // optional
            'entity'    => 'estados', // the method that defines the relationship in your Model
            'model'     => Estado::class, // foreign key model
            'attribute' => 'nombre', // foreign key attribute that is shown to user

            // also optional
            'options'   => (function ($query) {
                return $query->orderBy('nombre', 'ASC')->get();
            }), // force the related options to be a custom query, instead of all(); you can use this to filter the results show in the select
        ],
        [  // Municipio
            'label'     => "Municipio",
            'type'      => 'select2',
            'name'      => 'municipio_id', // the db column for the foreign key

            // optional
            'entity'    => 'municipios', // the method that defines the relationship in your Model
            'model'     => Municipio::class, // foreign key model
            'attribute' => 'nombre', // foreign key attribute that is shown to user

            // also optional
            'options'   => (function ($query) {
                return $query->orderBy('nombre', 'ASC')->get();
            }), // force the related options to be a custom query, instead of all(); you can use this to filter the results show in the select
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


        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number']));
         */
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
