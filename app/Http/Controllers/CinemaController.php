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
        $data['movies'] = $query->getAll('movies'); 
        return view('adminmovies', $data);
    }

    public function addMovie()
    {
        if (session('Role') != 'admin') { return redirect('/'); }
        return view('addmovie'); 
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
        $query->insert('movies', $movieData); 

        return redirect()->intended('/admin/movies')->with('success', 'Movie added successfully!');
    }

    public function editMovie($id)
    {
        if (session('Role') != 'admin') { return redirect('/'); }
        
        $query = new DataQuery;
        $data['movie'] = $query->getWhere('movies', ['MovieID' => $id]); 
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

        $query->updateRecord('movies', ['MovieID' => $id], $movieData); 

        return redirect()->intended('/admin/movies')->with('success', 'Movie updated successfully!');
    }

    public function deleteMovie($id)
    {
        if (session('Role') != 'admin') { return redirect('/'); }
        
        $query = new DataQuery;
        $query->deleteRecord('movies', 'MovieID', $id); // English function
        
        return redirect()->intended('/admin/movies')->with('success', 'Movie deleted successfully!');
    }


        // ================= ADMIN STUDIOS =================

    public function adminStudios()
    {
        if (session('Role') != 'admin') { return redirect('/'); }
        
        $query = new DataQuery;
        $data['studios'] = $query->getAll('studios'); // Uses generic model function
        return view('adminstudios', $data);
    }

    public function addStudio()
    {
        if (session('Role') != 'admin') { return redirect('/'); }
        return view('addstudio');
    }

    public function processAddStudio(Request $request)
    {
        $request->validate([
            'StudioName' => 'required',
            'TotalSeats' => 'required|integer'
        ]);

        $studioData = array(
            'StudioName' => $request->input('StudioName'),
            'TotalSeats' => $request->input('TotalSeats')
        );

        $query = new DataQuery;
        $query->insert('studios', $studioData); 

        return redirect()->intended('/admin/studios')->with('success', 'Studio added successfully!');
    }

    public function editStudio($id)
    {
        if (session('Role') != 'admin') { return redirect('/'); }
        
        $query = new DataQuery;
        $data['studio'] = $query->getWhere('studios', ['StudioID' => $id]); 
        return view('editstudio', $data);
    }

    public function processEditStudio(Request $request, $id)
    {
        $request->validate([
            'StudioName' => 'required',
            'TotalSeats' => 'required|integer'
        ]);

        $studioData = array(
            'StudioName' => $request->input('StudioName'),
            'TotalSeats' => $request->input('TotalSeats')
        );

        $query = new DataQuery;
        $query->updateRecord('studios', ['StudioID' => $id], $studioData); 

        return redirect()->intended('/admin/studios')->with('success', 'Studio updated successfully!');
    }

    public function deleteStudio($id)
    {
        if (session('Role') != 'admin') { return redirect('/'); }
        
        $query = new DataQuery;
        $query->deleteRecord('studios', 'StudioID', $id); 
        
        return redirect()->intended('/admin/studios')->with('success', 'Studio deleted successfully!');
    }

        // ================= ADMIN SCHEDULES =================

    public function adminSchedules()
    {
        if (session('Role') != 'admin') { return redirect('/'); }
        
        $query = new DataQuery;
        $data['schedules'] = $query->getSchedules(); // Uses the join query
        return view('adminschedules', $data);
    }

    public function addSchedule()
    {
        if (session('Role') != 'admin') { return redirect('/'); }
        
        $query = new DataQuery;
        $data['movies'] = $query->getAll('movies');
        $data['studios'] = $query->getAll('studios');
        return view('addschedule', $data);
    }

    public function processAddSchedule(Request $request)
    {
        $request->validate([
            'MovieID' => 'required',
            'StudioID' => 'required',
            'ShowDate' => 'required|date',
            'ShowTime' => 'required',
            'Price' => 'required|integer'
        ]);

        $scheduleData = array(
            'MovieID' => $request->input('MovieID'),
            'StudioID' => $request->input('StudioID'),
            'ShowDate' => $request->input('ShowDate'),
            'ShowTime' => $request->input('ShowTime'),
            'Price' => $request->input('Price')
        );

        $query = new DataQuery;
        
        // 1. Insert schedule and get the new ScheduleID
        $scheduleID = $query->insertGetID('schedules', $scheduleData);

        // 2. Get the studio's total seats
        $studio = $query->getWhere('studios', ['StudioID' => $request->input('StudioID')]);
        $totalSeats = $studio->TotalSeats;

        // 3. AUTO-GENERATE THE SEATS!
        for ($i = 1; $i <= $totalSeats; $i++) {
            $seatData = array(
                'ScheduleID' => $scheduleID,
                'SeatNumber' => $i, // Generates seats 1, 2, 3...
                'SeatStatus' => 'Available'
            );
            $query->insert('seats', $seatData);
        }

        return redirect()->intended('/admin/schedules')->with('success', 'Schedule added and seats generated successfully!');
    }

    public function editSchedule($id)
    {
        if (session('Role') != 'admin') { return redirect('/'); }
        
        $query = new DataQuery;
        $data['schedule'] = $query->getWhere('schedules', ['ScheduleID' => $id]);
        $data['movies'] = $query->getAll('movies');
        $data['studios'] = $query->getAll('studios');
        return view('editschedule', $data);
    }

    public function processEditSchedule(Request $request, $id)
    {
        $request->validate([
            'MovieID' => 'required',
            'ShowDate' => 'required|date',
            'ShowTime' => 'required',
            'Price' => 'required|integer'
        ]);

        $scheduleData = array(
            'MovieID' => $request->input('MovieID'),
            'ShowDate' => $request->input('ShowDate'),
            'ShowTime' => $request->input('ShowTime'),
            'Price' => $request->input('Price')
        );

        $query = new DataQuery;
        $query->updateRecord('schedules', ['ScheduleID' => $id], $scheduleData); 

        return redirect()->intended('/admin/schedules')->with('success', 'Schedule updated successfully!');
    }

    public function deleteSchedule($id)
    {
        if (session('Role') != 'admin') { return redirect('/'); }
        
        $query = new DataQuery;
        $query->deleteRecord('schedules', 'ScheduleID', $id); 
        
        return redirect()->intended('/admin/schedules')->with('success', 'Schedule deleted successfully!');
    }
}