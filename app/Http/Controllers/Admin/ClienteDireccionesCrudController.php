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
        $this->crud->addColumns([
            [
                // Id
                'name'         => 'id', // name of relationship method in the model
                'type'         => 'number',
                'label'        => 'ID', // Table column heading
            ],
            [
                // Nombre
                'name'         => 'nombre', // name of relationship method in the model
                'type'         => 'text',
                'label'        => 'Nombre', // Table column heading
            ],
            [
                // Calle
                'name'         => 'calle', // name of relationship method in the model
                'type'         => 'text',
                'label'        => 'Calle', // Table column heading
            ],
            [
                // Numero Exterior
                'name'         => 'numero_exterior', // name of relationship method in the model
                'type'         => 'text',
                'label'        => 'Numero Exterior', // Table column heading
            ],
            [
                // Numero interior
                'name'         => 'numero_interior', // name of relationship method in the model
                'type'         => 'text',
                'label'        => 'Numero Interior', // Table column heading
            ],
            [
                // Colonia
                'name'         => 'colonia', // name of relationship method in the model
                'type'         => 'text',
                'label'        => 'Colonia', // Table column heading
            ],
            [
                // Colonia
                'name'         => 'colonia', // name of relationship method in the model
                'type'         => 'text',
                'label'        => 'Colonia', // Table column heading
            ],
            [
                // Codigo postal
                'name'         => 'codigo_postal', // name of relationship method in the model
                'type'         => 'text',
                'label'        => 'Código Postal', // Table column heading
            ],
            [
                // Pais
                'name'         => 'paises', // name of relationship method in the model
                'type'         => 'relationship',
                'label'        => 'País', // Table column heading
                'entity'    => 'paises', // the method that defines the relationship in your Model
                'attribute' => 'nombre', // foreign key attribute that is shown to user
                'model'     => Paises::class, // foreign key model
            ],
            [
                // Estado
                'name'         => 'estados', // name of relationship method in the model
                'type'         => 'relationship',
                'label'        => 'Estado', // Table column heading
                'entity'    => 'estados', // the method that defines the relationship in your Model
                'attribute' => 'nombre', // foreign key attribute that is shown to user
                'model'     => Estado::class, // foreign key model
            ],
            [
                // Municipio
                'name'         => 'municipios', // name of relationship method in the model
                'type'         => 'relationship',
                'label'        => 'Municipio', // Table column heading
                'entity'    => 'estados', // the method that defines the relationship in your Model
                'attribute' => 'nombre', // foreign key attribute that is shown to user
                'model'     => Municipio::class, // foreign key model
            ],
            [
                // Estatus
                'name'         => 'estatus', // name of relationship method in the model
                'type'         => 'text',
                'label'        => 'Estatus', // Table column heading
            ],
            [
                // Tipo de Dirección
                'name'         => 'tipo', // name of relationship method in the model
                'type'         => 'text',
                'label'        => 'Tipo de Dirección', // Table column heading
            ],

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
                'minimum_input_length' => 0,
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
                'minimum_input_length' => 0,
                'type'        => "select2_from_ajax",
                'name'        => 'estado_id', // the column that contains the ID of that connected entity
                'entity'      => 'estados', // the method that defines the relationship in your Model
                'attribute'   => "nombre", // foreign key attribute that is shown to user
                'data_source' => url("webapi/obtenerEstadosDirecciones"), // url to controller search function (with /{id} should return model)
                'model'                   => Estado::class, // foreign key model
                'include_all_form_fields' => true, // optional - only send the current field through AJAX (for a smaller payload if you're not using multiple chained select2s)
                'dependencies'            => ['pais_id'], // when a dependency changes, this select2 is reset to null
            ],
            [   // Municipio Ajax
                'label'       => "Municipio", // Table column heading
                'placeholder' => 'SELECCIONE MUNICIPIO',
                'minimum_input_length' => 0,
                'type'        => "select2_from_ajax",
                'name'        => 'municipio_id', // the column that contains the ID of that connected entity
                'entity'      => 'municipios', // the method that defines the relationship in your Model
                'attribute'   => "nombre", // foreign key attribute that is shown to user
                'data_source' => url("webapi/obtenerMunicipiosDirecciones"), // url to controller search function (with /{id} should return model)
                'model'                   => Municipio::class, // foreign key model
                'include_all_form_fields' => true, // optional - only send the current field through AJAX (for a smaller payload if you're not using multiple chained select2s)
                'dependencies'            => ['estado_id'], // when a dependency changes, this select2 is reset to null
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
