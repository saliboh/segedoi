<?php

namespace App\Http\Controllers\Admin;

use App\Enums\UserRoleTypeEnum;
use App\Http\Requests\FinancerRequest;
use App\Models\User;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class FinancerCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class FinancerCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Financer::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/financer');
        CRUD::setEntityNameStrings('Finances', 'Finances');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::addColumn([
            'id' => 'id',
            'name' => 'id',
            'type' => 'number',
            'label' => 'ID',
        ]);

        CRUD::addColumn([
            'name' => 'user.email',
            'type' => 'relationship',
            'label' => 'User',
            'entity' => 'user',
            'attribute' => 'display_name',
            'model' => User::class,
        ]);
        CRUD::addColumn(['name' => 'total', 'type' => 'number']);
        CRUD::addColumn(['name' => 'date_released', 'type' => 'date']);
        CRUD::addColumn(['name' => 'term_in_months', 'type' => 'number']);
        CRUD::addColumn(['name' => 'interest', 'type' => 'number']);
        CRUD::addColumn(['name' => 'total_after_interest', 'type' => 'number']);
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(FinancerRequest::class);


        CRUD::addField([
            'name' => 'user_id', // The database column name
            'type' => 'select', // Simple dropdown
            'entity' => 'user', // Relationship name in the Financer model
            'attribute' => 'display_name', // The user attribute to display
            'model' => User::class, // The related model
            'options'   => (function ($query) {
                return $query->where('role', UserRoleTypeEnum::FINANCER->value)->get();
            }),
            'placeholder' => 'Select a user', // Placeholder text
        ]);

        CRUD::addField(['name' => 'total', 'type' => 'number']);
        CRUD::addField(['name' => 'date_released', 'type' => 'date']);
        CRUD::addField(['name' => 'term_in_months', 'type' => 'number']);
        CRUD::addField(['name' => 'interest', 'type' => 'number']);
        CRUD::addField(['name' => 'total_after_interest', 'type' => 'number']);
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
