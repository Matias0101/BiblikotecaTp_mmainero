<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\UserRequest;
use Auth;
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
        CRUD::setEntityNameStrings('Usuario', 'Usuarios');

         // Verificar el rol del usuario autenticado
         if (backpack_user()->hasRole('read_only')) {
            // Si el usuario tiene el rol de solo lectura, denegar acceso a crear, editar y eliminar
            $this->crud->denyAccess(['create', 'update', 'delete']);
        }
        
        // Si es admin, permitir todas las acciones
        if (backpack_user()->hasRole('admin')) {
            $this->crud->allowAccess(['create', 'update', 'delete']);
        }

        // Aquí verificamos si el usuario es 'admin' o 'read_only'
        // if (backpack_user()->role == 'read_only') {
        //     $this->crud->denyAccess(['create', 'delete']);
        //     // Permite que solo pueda editar su propio perfil
        //     $this->crud->addClause('where', 'id', '=', backpack_user()->id);
        // } else if (backpack_user()->role == 'admin') {
        //     $this->crud->allowAccess(['list', 'create', 'update', 'delete']);
        // }
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        //CRUD::setFromDb(); // set columns from db columns.
        CRUD::addColumn([
            'name' => 'name',
            'label' => 'Nombre Completo', // Cambiado a español
            'type' => 'text',
        ]);
        CRUD::addColumn([
            'name' => 'email',
            'label' => 'Correo Electrónico', // Cambiado a español
            'type' => 'email',
        ]);
        // CRUD::addColumn([
        //     'name' => 'password',
        //     'label' => 'Contraseña', // Cambiado a español
        //     'type' => 'password',
        // ]);
        // CRUD::addColumn([
        //     'name' => 'password_confirmation',
        //     'label' => 'Confirmar Contraseña', // Cambiado a español
        //     'type' => 'password',
        // ]);

        // CRUD::addColumn([
        //     'name' => 'role',
        //     'label' => 'Rol', // Cambiado a español
        //     'type' => 'select_from_array',
        //     'options' => ['admin' => 'Admin', 'read_only' => 'Solo Lectura'],
        //     'allows_null' => false,
        //     'default' => 'read_only', // Valor por defecto
        // ]);

        CRUD::addColumn([
            'name' => 'departament',
            'label' => 'Departamento', // Cambiado a español
            'type' => 'text',
        ]);
        CRUD::addColumn([
            'name' => 'internal',
            'label' => 'Interno', // Cambiado a español
            'type' => 'text',
        ]);
        CRUD::addColumn([
            'name' => 'cellphone',
            'label' => 'Teléfono Celular', // Cambiado a español
            'type' => 'text',
        ]);
        CRUD::addColumn([
            'name' => 'note',
            'label' => 'Nota', // Cambiado a español
            'type' => 'textarea',
        ]);
        CRUD::addColumn([
            'name' => 'alternate_email',
            'label' => 'Correo Electrónico Alternativo', // Cambiado a español
            'type' => 'email',
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
        session()->forget('_old_input'); // Limpia cualquier valor antiguo de formularios.

        // Seteamos los valores por defecto para los campos vacíos en la creación
        $this->crud->setOperationSetting('defaults', [
            'name' => '',
            'email' => '',
            'password' => '',
            'password_confirmation' => '',
            'departament' => '',
            'internal' => '',
            'cellphone' => '',
            'note' => '',
            'alternate_email' => '',
        ]);




        // Asegurarnos de que la validación se aplique
        CRUD::setValidation(UserRequest::class);

        // Mismos campos para la creación
        CRUD::addField([
            'name' => 'name',
            'label' => 'Nombre Completo',
            'type' => 'text',
            'attributes' => [
                'placeholder' => 'Ingresa el nombre completo aquí', // Placeholder para dar contexto
            ],

        ]);

        // Permitir editar el correo y el rol
        $this->crud->addField([
            'name' => 'email',
            'label' => 'Correo Electrónico',
            'type' => 'email',
            'value' => '', // Asegúrate de que el valor inicial sea vacío
            'attributes' => [
                'placeholder' => 'Ingrese el correo electrónico',
                'autocomplete' => 'off', // Desactiva el autocompletado del navegador
            ],
        ]);

        // CRUD::addField([
        //     'name' => 'role',
        //     'label' => 'Rol',
        //     'type' => 'select_from_array',
        //     'options' => ['admin' => 'Admin', 'read_only' => 'Solo Lectura'],
        //     'allows_null' => false,
        //     'default' => 'read_only', // Valor por defecto
        // ]);

        // Para la contraseña, aseguramos que siempre esté vacía en la creación
        $this->crud->addField([
            'name' => 'password',
            'label' => 'Contraseña',
            'type' => 'password',
            'value' => '', // El valor predeterminado es vacío
            'attributes' => [
                'placeholder' => 'Ingrese la contraseña',
                'autocomplete' => 'new-password', // Sugiere al navegador que no use autofill
            ],
        ]);

        CRUD::addField([
            'name' => 'password_confirmation',
            'label' => 'Confirmar Contraseña',
            'type' => 'password',
            'attributes' => [
                'placeholder' => 'Aquí confirma tu contraseña', // Indicativo en el placeholder
            ],
            // Siempre vacío
        ]);

        // Otros campos (departamento, interno, etc.)
        CRUD::addField([
            'name' => 'departament',
            'label' => 'Departamento',
            'type' => 'text',
            // Aseguramos que esté vacío en la creación
        ]);

        CRUD::addField([
            'name' => 'internal',
            'label' => 'Interno',
            'type' => 'text',
            // Aseguramos que esté vacío en la creación
        ]);

        CRUD::addField([
            'name' => 'cellphone',
            'label' => 'Teléfono Celular',
            'type' => 'text',
            // Aseguramos que esté vacío en la creación
        ]);

        CRUD::addField([
            'name' => 'note',
            'label' => 'Nota',
            'type' => 'textarea',
            // Aseguramos que esté vacío en la creación
        ]);

        CRUD::addField([
            'name' => 'alternate_email',
            'label' => 'Correo Electrónico Alternativo',
            'type' => 'email',
            // Aseguramos que esté vacío en la creación
        ]);
        // Seteamos los valores por defecto para los campos vacíos en la creación
        $this->crud->setOperationSetting('defaults', [
            'name' => '',
            'email' => '',
            'password' => '',
            'password_confirmation' => '',
            'departament' => '',
            'internal' => '',
            'cellphone' => '',
            'note' => '',
            'alternate_email' => '',
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
     * 
     */
    protected function setupUpdateOperation()
    {

        CRUD::setValidation(UserRequest::class); // Usamos la validación del formulario de request.


        $user = backpack_user(); // Obtenemos el usuario logueado actual.

        // Si el usuario logueado es read_only y está editando su propio perfil, mostramos los campos como solo lectura.
        // if ($user->role == 'read_only' && $user->id == CRUD::getCurrentEntry()->id) {

        //     CRUD::addField([
        //         'name' => 'email',
        //         'label' => 'Correo Electrónico',
        //         'type' => 'view',  // Solo visualización
        //         'value' => CRUD::getCurrentEntry()->email, // Valor actual del correo electrónico
        //     ]);
        //     CRUD::addField([
        //         'name' => 'role',
        //         'label' => 'Rol',
        //         'type' => 'view',  // Solo visualización
        //         'value' => ucfirst(CRUD::getCurrentEntry()->role),  // Mostramos el rol actual
        //     ]);
        // } else {
        //     // Si es admin, permitimos editar el correo y el rol.
        //     CRUD::addField([
        //         'name' => 'email',
        //         'label' => 'Correo Electrónico',
        //         'type' => 'email',
        //         'attributes' => [
        //             'placeholder' => 'usuario@jus.gob.ar', // Placeholder
        //         ],
        //     ]);
        //     CRUD::addField([
        //         'name' => 'role',
        //         'label' => 'Rol',
        //         'type' => 'select_from_array',
        //         'options' => ['admin' => 'Admin', 'read_only' => 'Solo Lectura'],
        //         'allows_null' => false,
        //         'default' => CRUD::getCurrentEntry()->role, // Valor actual del rol
        //     ]);
        //}

        // Otros campos comunes para todos.
        CRUD::addField([
            'name' => 'name',
            'label' => 'Nombre Completo',
            'type' => 'text',
        ]);
        CRUD::addField([
            'name' => 'password',
            'label' => 'Contraseña',
            'type' => 'password',
            'attributes' => [
                'placeholder' => 'Deja este campo vacío si no deseas cambiar la contraseña.',
            ],
            //'value' => '',  // Siempre vacío
        ]);
        CRUD::addField([
            'name' => 'password_confirmation',
            'label' => 'Confirmar Contraseña',
            'type' => 'password',
            'attributes' => [
                'placeholder' => 'Confirma tu nueva contraseña',
            ],
        ]);
        CRUD::addField([
            'name' => 'departament',
            'label' => 'Departamento',
            'type' => 'text',
        ]);
        CRUD::addField([
            'name' => 'internal',
            'label' => 'Interno',
            'type' => 'text',
        ]);
        CRUD::addField([
            'name' => 'cellphone',
            'label' => 'Teléfono Celular',
            'type' => 'text',
        ]);
        CRUD::addField([
            'name' => 'note',
            'label' => 'Nota',
            'type' => 'textarea',
        ]);
        CRUD::addField([
            'name' => 'alternate_email',
            'label' => 'Correo Electrónico Alternativo',
            'type' => 'email',
        ]);




        // Llamar a la validación correspondiente
        //CRUD::setValidation(UserRequest::class);
    }
    public function update($id)
    {

        $data = $this->crud->getRequest()->only([
            'name',
            'email',
            'password',
            'password_confirmation',
            'departament',
            'internal',
            'cellphone',
            'note',
            'alternate_email',
            //'role'
        ]);

        // Solo encripta y actualiza la contraseña si fue cambiada y no está vacía
        if (!empty($data['password'])) {
            // Validamos que las contraseñas coincidan antes de encriptarlas
            if ($data['password'] !== $data['password_confirmation']) {
                return back()->withErrors(['password' => 'Las contraseñas no coinciden.']);
            }

            // Encriptar la nueva contraseña
            $data['password'] = bcrypt($data['password']);
        } else {
            // Si los campos de contraseña están vacíos, los removemos para no cambiar la contraseña
            unset($data['password']);
            unset($data['password_confirmation']);
        }

        // Actualizar el usuario en la base de datos
        $this->crud->update($id, $data);

       
        // Determina la acción de guardado seleccionada
        $saveAction = $this->crud->getRequest()->input('_save_action', 'save_and_back');

        // Realiza la redirección según la acción seleccionada
        switch ($saveAction) {
            case 'save_and_back':
                return redirect()->to($this->crud->route);
            case 'save_and_edit':
                return redirect()->to($this->crud->route . '/' . $id . '/edit');
            case 'save_and_preview':
                return redirect()->to($this->crud->route . '/' . $id);
            default:
                return redirect()->to($this->crud->route);
        }

        // Redirigimos de vuelta a la página de edición de su perfil
        // return redirect()->to(config('backpack.base.route_prefix') . '/user/' . $id . '/edit')->with('success', 'Perfil actualizado con éxito.');




        //     //return $this->crud->update($id, $data); muestra Json
        //     return redirect()->to(config('backpack.base.route_prefix') . '/user');

    }

    public function messages()
    {
        return [
            'name.required' => 'El nombre es obligatorio.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
            //'role.required' => 'El rol es obligatorio.',
        ];
    }
    protected function setupShowOperation()
    {
        CRUD::addColumn([
            'name' => 'name',
            'label' => 'Nombre Completo', // Cambiado a español
            'type' => 'text',
        ]);
        CRUD::addColumn([
            'name' => 'email',
            'label' => 'Correo Electrónico', // Cambiado a español
            'type' => 'email',
        ]);


        // CRUD::addColumn([
        //     'name' => 'role',
        //     'label' => 'Rol', // Cambiado a español
        //     'type' => 'select_from_array',
        //     'options' => ['admin' => 'Admin', 'read_only' => 'Solo Lectura'],
        //     'allows_null' => false,
        //     'default' => 'read_only', // Valor por defecto
        // ]);

        CRUD::addColumn([
            'name' => 'departament',
            'label' => 'Departamento', // Cambiado a español
            'type' => 'text',
        ]);
        CRUD::addColumn([
            'name' => 'internal',
            'label' => 'Interno', // Cambiado a español
            'type' => 'text',
        ]);
        CRUD::addColumn([
            'name' => 'cellphone',
            'label' => 'Teléfono Celular', // Cambiado a español
            'type' => 'text',
        ]);
        CRUD::addColumn([
            'name' => 'note',
            'label' => 'Nota', // Cambiado a español
            'type' => 'textarea',
        ]);
        CRUD::addColumn([
            'name' => 'alternate_email',
            'label' => 'Correo Electrónico Alternativo', // Cambiado a español
            'type' => 'email',
        ]);

    }



}
