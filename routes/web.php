<?php
Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::group(['middleware' => ['auth']], function() {

    Route::get('/home', 'HomeController@index');

    Route::get('users', ['as'         => 'users.index',
                         'uses'       => 'UserController@index',
                         'middleware' => ['permission:user-list|user-create|user-edit|user-delete']
                        ]);
    Route::get('users/create', ['as'         => 'users.create',
                                'uses'       => 'UserController@create',
                                'middleware' => ['permission:user-create']
                               ]);
    Route::post('users/create', ['as'         => 'users.store',
                                 'uses'       => 'UserController@store',
                                 'middleware' => ['permission:user-create']
                                ]);
    Route::get('users/{id}', ['as'   => 'users.show',
                              'uses' => 'UserController@show'
                             ]);
    Route::get('users/{id}/edit', ['as'         => 'users.edit',
                                   'uses'       => 'UserController@edit',
                                   'middleware' => ['permission:user-edit']
                                  ]);
    Route::patch('users/{id}', ['as'         => 'users.update',
                                'uses'       => 'UserController@update',
                                'middleware' => ['permission:user-edit']
                               ]);
    Route::delete('users/{id}', ['as'         => 'users.destroy',
                                 'uses'       => 'UserController@destroy',
                                 'middleware' => ['permission: user-delete']
                                ]);
    Route::get('roles', ['as'         => 'roles.index',
                         'uses'       => 'RoleController@index',
                         'middleware' => ['permission:role-list|role-create|role-edit|role-delete']
                        ]);
    Route::get('roles/create', ['as'         => 'roles.create',
                                'uses'       => 'RoleController@create',
                                'middleware' => ['permission:role-create']
                               ]);
    Route::post('roles/create', ['as'         => 'roles.store',
                                 'uses'       => 'RoleController@store',
                                 'middleware' => ['permission:role-create']
                                ]);
    Route::get('roles/{id}', ['as'   => 'roles.show',
                              'uses' => 'RoleController@show'
                             ]);
    Route::get('roles/{id}/edit', ['as'         => 'roles.edit',
                                   'uses'       => 'RoleController@edit',
                                   'middleware' => ['permission:role-edit']
                                  ]);
    Route::patch('roles/{id}', ['as'         => 'roles.update',
                                'uses'       => 'RoleController@update',
                                'middleware' => ['permission:role-edit']
                               ]);
    Route::delete('roles/{id}', ['as'        => 'roles.destroy',
                                'uses'       => 'RoleController@destroy',
                                'middleware' => ['permission:role-delete']
                               ]);

    Route::get('itemCRUD2', ['as'         => 'itemCRUD2.index',
                             'uses'       => 'ItemCRUD2Controller@index',
                             'middleware' => ['permission:item-list|item-create|item-edit|item-delete']
                            ]);
    Route::get('itemCRUD2/create', ['as'         => 'itemCRUD2.create',
                                    'uses'       => 'ItemCRUD2Controller@create',
                                    'middleware' => ['permission:item-create']
                                   ]);
    Route::post('itemCRUD2/store', ['as'         => 'itemCRUD2.store',
                                    'uses'       => 'ItemCRUD2Controller@store',
                                    'middleware' => ['permission:item-create']
                                    ]);
    Route::get('itemCRUD2/{id}', ['as'   => 'itemCRUD2.show',
                                  'uses' => 'ItemCRUD2Controller@show'
                                 ]);
    Route::get('itemCRUD2/{id}/edit', ['as'         => 'itemCRUD2.edit',
                                       'uses'       => 'ItemCRUD2Controller@edit',
                                       'middleware' => ['permission:item-edit']
                                      ]);
    Route::patch('itemCRUD2/{id}', ['as'         => 'itemCRUD2.update',
                                    'uses'       => 'ItemCRUD2Controller@update',
                                    'middleware' => ['permission:item-edit']
                                 ]);
    Route::delete('itemCRUD2/{id}', ['as'         => 'itemCRUD2.destroy',
                                     'uses'       => 'ItemCRUD2Controller@destroy',
                                     'middleware' => ['permission:item-delete']
                                 ]);
});
Auth::routes();

Route::get('/home', 'HomeController@index');
