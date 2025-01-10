<?php

namespace App\Http\Controllers\Admin;

use App\Enums\UserRoleTypeEnum;
use App\Http\Requests\PaymentRequest;
use App\Models\Financer;
use App\Models\Loan;
use App\Models\User;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class PaymentCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class PaymentCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Payment::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/payment');
        CRUD::setEntityNameStrings('payment', 'payments');
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
            'name' => 'id',
            'type' => 'number',
        ]);

        CRUD::addColumn([
            'name' => 'loan.user_loan',
            'type' => 'relationship',
            'label' => 'Loan',
            'entity' => 'loan',
            'attribute' => 'user_loan',
            'model' => Loan::class,
        ]);

        CRUD::addColumn(['name' => 'total', 'type' => 'number']);

        CRUD::addColumn([
            'name' => 'payment_image_url',
            'label' => 'Proof of Payment',
            'type' => 'custom_html',
            'value' => function ($entry) {
                return $entry->payment_image_url;
            },
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
        CRUD::setValidation(PaymentRequest::class);

        CRUD::addField([
            'name' => 'loan_id',
            'type' => 'select',
            'label' => 'Loan',
            'entity' => 'loan',
            'attribute' => 'user_loan',
            'model' => Loan::class,
            'options' => (function ($query) {
                return $query->get();
            }),
            'placeholder' => 'Select a User\'s Loan',
        ]);

        CRUD::addField(['name' => 'total', 'type' => 'number']);
        CRUD::addField([
            'name' => 'proof_of_payment_image',
            'type' => 'upload',
            'upload' => true,
            'disk' => 'public',
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
