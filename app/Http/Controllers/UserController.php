<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Connectors\Connector;
use Illuminate\Database\Connection;
use App\Http\Controllers\Controller;
use App\User;
use App\Role;
use DB;
use Hash;

class UserController extends Controller
{
    /**
     * DB connection to firebird database
     * 
     * @var Illuminate\Database\Connection
     */
    protected $db;

    /**
     * A list of existing branches
     * 
     * @var Illuminate\Database\Connection
     */
    public $branches;

    /**
     * Create a new database connection instance.
     * 
     * @return void
     */
    public function __construct() {
        $connector = new Connector();
        $pdo = $connector->createConnection('firebird:host=127.0.0.1;dbname=/var/lib/firebird/2.5/data/GLOBAL_promo.fdb', ['username' => 'sysdba', 'password' => 'root'], []);
        $this->db = new Connection($pdo, '/var/lib/firebird/2.5/data/GLOBAL_promo.fdb', '', ['charset' => 'W1251']);

        $this->branches = $this->db->table('FILIALS')
                                   ->select('ID', 'SNAME')
                                   ->get()
                                   ->all();
    }

    /**
     * Display a listing of the resource.
     * 
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = User::orderBy('id', 'DESC')->paginate(5);
        return view('users.index', ['data' => $data, 'branches' => $this->branches])
                ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     * 
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('display_name', 'id');
        $branches = [];
        foreach ($this->branches as $branch) {
            $branches[$branch->ID] = $branch->SNAME;
        }
        return view('users.create', compact('roles', 'branches'));
    }

    /**
     * Store a newly created resource in storage.
     * 
     * @param ]Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'  => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required'
        ]);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);

        $user = User::create($input);
        foreach ($request->input('roles') as $key => $value) {
            $user->attachRole($value);
        }

        return redirect()->route('users.index')
                         ->with('success', 'User created successfully');
    }

    /**
     * Display the specified resource.
     * 
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('users.show', ['user' => $user, 'branches' => $this->branches]);
    }

    /**
     * Show the form for editing the specified resource.
     * 
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('display_name', 'id');
        $userRole = $user->roles->pluck('id', 'id')->toArray();

        return view('users.edit', ['user' => $user, 'roles' => $roles, 'userRole' => $userRole, 'branches' => $this->branches]);
    }

    /**
     * Update the specified resource in storage.
     * 
     * @param \Illuminate\http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name'     => 'required',
            'email'    => 'required|email|unique:users,email,' . $id,
            'password' => 'same:confirm-password',
            'roles'    => 'required'
        ]);

        $input = $request->all();
        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = array_except($input, array('password'));
        }

        $user = User::find($id);
        $user->update($input);
        DB::table('role_user')->where('user_id',$id)->delete();

        foreach ($request->input('roles') as $key => $value) {
            $user->attachRole($value);
        }

        return redirect()->route('users.index')
                        ->with('success', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     * 
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('users.index')
                        ->with('success', 'User deleted successfully');
    }
}
