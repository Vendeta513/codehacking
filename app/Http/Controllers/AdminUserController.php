<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UsersRequest;
use App\Http\Requests\UserEditRequest;
use Illuminate\Support\Facades\Session;
use App\User;
use App\Role;
use App\Photo;
use App\Category;

use Illuminate\Http\Request;

use App\Http\Requests;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $users = User::paginate(10);

      return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $roles = Role::pluck('name', 'id')->all();
      return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsersRequest $request)
    {
      $input = $request->all();

      if($file = $request->file('photo_id')){
        $name = time() . $file->getClientOriginalName();

        $file->move('images', $name);

        $photo = Photo::create(['file'=>$name]);

        $input['photo_id'] = $photo->id;
      }

      $input['password'] = bcrypt($request->password);

      User::create($input);


      // User::create($request->all());
      //
      return redirect('/admin/users');

      // return $request->all();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);

        $roles = Role::pluck('name', 'id')->all();


        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserEditRequest $request, $id)
    {
      $user = User::findOrFail($id);

      $input = $request->all();

      if($file = $request->file('photo_id')){
        $name = time() . $file->getClientOriginalName();

        $file->move('images', $name);

        $photo = Photo::create(['file'=>$name]);

        $input['photo_id'] = $photo->id;

      }

      $input['password'] = bcrypt($input['password']);

      $user->update($input);

      Session::flash('updated_user', 'User has been updated');

      return redirect('/admin/users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $user = User::findOrFail($id);


      if ($user->photo_id != 0) {

        $photo_id = $user->photo_id;

        $photo = Photo::find($photo_id);


        unlink(public_path() . $user->photo->file);


        $photo->delete();
      }


      $user->delete();

      Session::flash('deleted_user', "User has been deleted");

      return redirect('/admin/users');

    }

    public function createUser(UsersRequest $request){
      $input = $request->all();

      if($file = $request->file('photo_id')){
        $name = time() . $file->getClientOriginalName();
        $file->move('images', $name);

        $photo = Photo::create(['file'=>$name]);
        $input['photo_id'] = $photo->id;
      }

      $input['password'] = bcrypt($request->password);

      User::create($input);

      Session::flash('user_created', 'Successfully created user');
      return redirect()->back();
    }

    public function userProfile($id){
      $user = Auth::user();
      $categories = Category::all();
      return view('user_profile', compact('user', 'categories'));
    }
}
