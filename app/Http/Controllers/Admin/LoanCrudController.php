<?php

namespace App\Http\Controllers\Admin;

use App\Enums\PaymentFrequencyType;
use App\Enums\UserRoleTypeEnum;
use App\Http\Requests\LoanRequest;
use App\Models\Financer;
use App\Models\User;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class LoanCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class LoanCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Loan::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/loan');
        CRUD::setEntityNameStrings('loan', 'loans');
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
            'label' => 'Client',
            'entity' => 'user',
            'attribute' => 'display_name',
            'model' => User::class,
        ]);


        CRUD::addColumn([
            'name' => 'financer.financer_name',
            'type' => 'relationship',
            'label' => 'Financer',
            'entity' => 'financer',
            'attribute' => 'financer_name',
            'model' => Financer::class,
        ]);

        CRUD::addColumn(['name' => 'total', 'type' => 'number']);
        CRUD::addColumn(['name' => 'interest', 'type' => 'number']);
        CRUD::addColumn(['name' => 'term_in_months', 'type' => 'number']);
        CRUD::addColumn([
            'name' => 'payment_frequency',
            'type' => 'select_from_array',
            'options' => PaymentFrequencyType::toArray(),
            'label' => 'Payment Frequency',
            'wrapper' => [
                'element' => 'span',
                'class' => function ($crud, $column, $entry, $related_key) {
                    return PaymentFrequencyType::from($entry->payment_frequency)->description();
                },
            ],
        ]);


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
        CRUD::setValidation(LoanRequest::class);

        CRUD::addField([
            'name' => 'user_id',
            'type' => 'select',
            'entity' => 'user',
            'attribute' => 'display_name',
            'model' => User::class,
            'options'   => (function ($query) {
                return $query->where('role', UserRoleTypeEnum::CLIENT->value)->get();
            }),
            'placeholder' => 'Select a Client',
        ]);

        CRUD::addField([
            'name' => 'financer_id',
            'type' => 'select',
            'entity' => 'financer',
            'attribute' => 'financer_name',
            'model' => Financer::class,
            'options' => (function ($query) {
                return $query->get();
            }),
            'placeholder' => 'Select a Finance',
        ]);

        CRUD::addField(['name' => 'total', 'type' => 'number']);
        CRUD::addField(['name' => 'interest', 'type' => 'number']);
        CRUD::addField(['name' => 'term_in_months', 'type' => 'number']);
        CRUD::addField([
            'name' => 'payment_frequency',
            'type' => 'select_from_array',
            'options' => PaymentFrequencyType::toArray(),
            'allows_null' => false,
            'default' => PaymentFrequencyType::monthly->value, // Optional: set a default value
            'label' => 'Payment Frequency',
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
