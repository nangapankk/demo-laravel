<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Throwable;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $users = User::simplePaginate(5);
        return view('users.index', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
        ]);

        try {
            User::create([
                'name' => $request['name'],
                'email' => $request['email'],
                'password' => $request['password'],
            ]);

            return redirect()->route('users.index')->with('success', 'User has been created successfully.');
        }
        catch (Throwable $th) {
            return redirect()->route('users.index')->with('unsuccess', 'User has been created unsuccessfully.');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     *
     * @return Application|Factory|View
     */
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     *
     * @return Application|Factory|View
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     *
     * @return RedirectResponse
     */
    public function destroy(User $user)
    {
        try {
            $user->delete();

            return redirect()->route('users.index')->with('success', 'User has been deleted successfully.');
        }
        catch (Throwable $th) {
            return redirect()->route('users.index')->with('unsuccess', 'User has been deleted unsuccessfully.');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param User $user
     *
     * @return RedirectResponse
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
        ]);

        try {
            $user->update([
                'name' => $request['name'],
                'email' => $request['email'],
            ]);

            return redirect()->route('users.index')->with('success', 'User has been updated successfully.');
        }
        catch (Throwable $th) {
            return redirect()->route('users.index')->with('unsuccess', 'User has been updated unsuccessfully.');
        }
    }
}
