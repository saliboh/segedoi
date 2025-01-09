<?php

namespace App\Http\Controllers\Admin;

use App\Enums\UserRoleTypeEnum;
use App\Http\Requests\UserRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class UserCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class UserCrudController extends CrudController
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
        CRUD::setModel(\App\Models\User::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/user');
        CRUD::setEntityNameStrings('user', 'users');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::column('first_name');
        CRUD::column('last_name');
        CRUD::column('email');
        CRUD::column('role');
        CRUD::column('address');
        CRUD::column('city');
        CRUD::column('barangay');
        CRUD::column('mobile');
        CRUD::column('id_url');
        CRUD::column('contract_url');
        CRUD::column('banned_at');

        /**
         * Columns can be defined using the fluent syntax:
         * - CRUD::column('price')->type('number');
         */
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(UserRequest::class);

        CRUD::addField([
            'name' => 'email',
            'type' => 'text',
            'label' => 'Email',
        ]);

        CRUD::addField([
            'name' => 'password',
            'type' => 'password',
            'label' => 'Password',
        ]);

        CRUD::addField([
            'name' => 'first_name',
            'type' => 'text',
            'label' => 'First Name',
        ]);
        CRUD::addField([
            'name' => 'last_name',
            'type' => 'text',
            'label' => 'Last Name',
        ]);

        CRUD::addField([
            'name' => 'role',
            'type' => 'select_from_array',
            'label' => 'Role',
            'options' => UserRoleTypeEnum::toArray(),
        ]);

        CRUD::addField([
            'name' => 'address',
            'type' => 'text',
            'label' => 'Address',
        ]);

        CRUD::addField([
            'name' => 'city',
            'type' => 'text',
            'label' => 'City',
        ]);

        CRUD::addField([
            'name' => 'barangay',
            'type' => 'text',
            'label' => 'Barangay',
        ]);

        CRUD::addField([
            'name' => 'mobile',
            'type' => 'text',
            'label' => 'Mobile',
        ]);

        CRUD::addField([
            'name' => 'id_url',
            'type' => 'text',
            'label' => 'ID URL',
        ]);

        CRUD::addField([
            'name' => 'contract_url',
            'type' => 'text',
            'label' => 'Contract URL',
        ]);

        CRUD::addField([
            'name' => 'banned_at',
            'type' => 'date',
            'label' => 'Banned At',
        ]);

        /**
         * Fields can be defined using the fluent syntax:
         * - CRUD::field('price')->type('number');
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

        CRUD::modifyField('password', [
            'type' => 'password',
            'label' => 'Password',
            'hint' => 'Leave empty to keep the same password',
        ]);

        CRUD::modifyField('email', [
            'attributes' => [
                'readonly' => 'readonly',
            ],
        ]);
    }
}
