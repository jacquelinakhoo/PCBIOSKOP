<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataQuery;

class CinemaController extends Controller
{
    // ================= AUTH =================

    public function index()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'EmailUser' => 'required',
            'Password' => 'required'
        ]);

        $conditions = array(
            'email' => $request->input('EmailUser'), 
            'password' => $request->input('Password')
        );

        $query = new DataQuery;
        $user = $query->getWhere('users', $conditions);

        if ($user) {
            session(['Username' => $user->name]); 
            session(['Role' => $user->Role]);
            session(['UserID' => $user->id]);

            if ($user->Role == 'admin') {
                return redirect()->intended('/dashboard/admin');
            } else if ($user->Role == 'staff') {
                return redirect()->intended('/dashboard/staff');
            } else {
                return redirect()->intended('/dashboard/customer');
            }
        } else {
            return redirect()->intended('/')->with('error', 'Invalid email or password!');
        }
    }

    public function register()
    {
        return view('register');
    }

    public function processRegister(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'EmailUser' => 'required|unique:users,email',
            'Password' => 'required'
        ]);

        $dataUser = array(
            'name' => $request->input('name'),
            'email' => $request->input('EmailUser'),
            'password' => $request->input('Password'), 
            'Role' => 'customer' 
        );

        $query = new DataQuery;
        $query->insert('users', $dataUser);

        return redirect()->intended('/')->with('success', 'Account created successfully, please login!');
    }

    public function logout()
    {
        session()->flush();
        return redirect()->intended('/');
    }

    // ================= DASHBOARDS =================

    public function dashboardAdmin() 
    { 
        if (!session('Username')) { return redirect('/'); }
        return view('dashboardadmin'); 
    }

    public function dashboardStaff() 
    { 
        if (!session('Username')) { return redirect('/'); }
        return view('dashboardstaff'); 
    }

    public function dashboardCustomer() 
    { 
        if (!session('Username')) { return redirect('/'); }
        return view('dashboardcustomer'); 
    }

    // ================= ADMIN MOVIES =================

    public function adminMovies()
    {
        if (session('Role') != 'admin') { return redirect('/'); }
        
        $query = new DataQuery;
        $data['movies'] = $query->getAll('movies'); // English function
        return view('adminmovies', $data);
    }

    public function addMovie()
    {
        if (session('Role') != 'admin') { return redirect('/'); }
        return view('tambahmovie'); // Keeping filename as requested earlier
    }

    public function processAddMovie(Request $request)
    {
        $request->validate([
            'Title' => 'required',
            'Duration' => 'required|integer',
            'Synopsis' => 'required',
            'MovieStatus' => 'required',
            'Poster' => 'image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $poster_name = "";
        $file = $request->file('Poster');

        if ($file) {
            $poster_name = time() . "_" . $file->getClientOriginalName(); 
            $upload_path = 'assets/img';
            $file->move($upload_path, $poster_name);
        }

        $movieData = array(
            'Title' => $request->input('Title'),
            'Duration' => $request->input('Duration'),
            'Synopsis' => $request->input('Synopsis'),
            'MovieStatus' => $request->input('MovieStatus'),
            'Poster' => $poster_name
        );

        $query = new DataQuery;
        $query->insert('movies', $movieData); // English function

        return redirect()->intended('/admin/movies')->with('success', 'Movie added successfully!');
    }

    public function editMovie($id)
    {
        if (session('Role') != 'admin') { return redirect('/'); }
        
        $query = new DataQuery;
        $data['movie'] = $query->getWhere('movies', ['MovieID' => $id]); // English function
        return view('editmovie', $data);
    }

    public function processEditMovie(Request $request, $id)
    {
        $request->validate([
            'Title' => 'required',
            'Duration' => 'required|integer',
            'Synopsis' => 'required',
            'MovieStatus' => 'required'
        ]);

        $query = new DataQuery;

        $movieData = array(
            'Title' => $request->input('Title'),
            'Duration' => $request->input('Duration'),
            'Synopsis' => $request->input('Synopsis'),
            'MovieStatus' => $request->input('MovieStatus')
        );

        $file = $request->file('Poster');
        if ($file) {
            $poster_name = time() . "_" . $file->getClientOriginalName(); 
            $upload_path = 'assets/img';
            $file->move($upload_path, $poster_name);
            $movieData['Poster'] = $poster_name;
        }

        $query->updateRecord('movies', ['MovieID' => $id], $movieData); // English function

        return redirect()->intended('/admin/movies')->with('success', 'Movie updated successfully!');
    }

    public function deleteMovie($id)
    {
        if (session('Role') != 'admin') { return redirect('/'); }
        
        $query = new DataQuery;
        $query->deleteRecord('movies', 'MovieID', $id); // English function
        
        return redirect()->intended('/admin/movies')->with('success', 'Movie deleted successfully!');
    }
}