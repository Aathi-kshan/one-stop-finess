<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Classes;
use App\Models\Coach;
use Illuminate\Support\Facades\Log;

class CoachController extends Controller
{
    public function index()
    {
        try {
            $classes = Classes::all();
            return view('booking', compact('classes'));
        } catch (\Exception $e) {
            Log::error('Error fetching classes: ' . $e->getMessage());
            return back()->with('error', 'An error occurred while fetching classes.');
        }
    }

    public function view()
    {
        return view('coach.dashboard');
    }

    public function createSessions(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'date' => 'required|date',
            'time' => 'required',
            'max_participants' => 'required|integer',
            'location' => 'required|string',
            'price' => 'required|numeric',
        ]);

        try {
            $coach = Coach::where('user_id', auth()->id())->first();

            if (!$coach) {
                return back()->with('error', 'You need to create a coach profile first.');
            }

            Classes::create([
                'coach_id' => $coach->id,
                'name' => $request->name,
                'date' => $request->date,
                'time' => $request->time,
                'max_participants' => $request->max_participants,
                'location' => $request->location,
                'price' => $request->price,
            ]);

            return back()->with('success', 'Session created successfully!');
        } catch (\Exception $e) {
            Log::error('Error creating session: ' . $e->getMessage());
            return back()->with('error', 'An error occurred while creating the session.');
        }
    }

    public function create()
    {
        return view('coach.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'specialization' => 'required|string|max:255',
            'bio' => 'required|string',
            'experience' => 'required|integer|min:0',
        ]);

        try {
            if (Coach::where('user_id', auth()->id())->exists()) {
                return redirect()->route('coach.dashboard')->with('error', 'You already have a coach profile.');
            }

            Coach::create([
                'user_id' => auth()->id(),
                'specialization' => $request->specialization,
                'bio' => $request->bio,
                'experience' => $request->experience,
            ]);

            return redirect()->route('coach.dash')->with('success', 'Coach profile created successfully!');
        } catch (\Exception $e) {
            Log::error('Error creating coach profile: ' . $e->getMessage());
            return back()->with('error', 'An error occurred while creating the coach profile.');
        }
    }

    public function viewClasses()
    {
        try {
            $coach = Coach::where('user_id', auth()->id())->first();

            if (!$coach) {
                return back()->with('error', 'You need to create a coach profile first.');
            }

            $classes = Classes::where('coach_id', $coach->id)->get();
            return view('coach.view', compact('classes'));
        } catch (\Exception $e) {
            Log::error('Error fetching classes: ' . $e->getMessage());
            return back()->with('error', 'An error occurred while fetching your classes.');
        }
    }
    public function search(Request $request)
    {
        $location = $request->input('location');
        $price = $request->input('price');

        try {
            $query = Classes::query();

            if ($location) {
                $query->where('location', 'LIKE', "%{$location}%");
            }

            if ($price) {
                $query->where('price', '<=', $price);
            }

            $classes = $query->get();
            return view('booking', compact('classes'));
        } catch (\Exception $e) {
            Log::error('Error searching for classes: ' . $e->getMessage());
            return back()->with('error', 'An error occurred while searching for classes.');
        }
    }

    public function destroy($id)
    {
        try {
            $class = Classes::findOrFail($id);
            $class->delete();

            return redirect()->route('coach.dash')->with('success', 'Class deleted successfully.');
        } catch (\Exception $e) {
            Log::error('Error deleting class: ' . $e->getMessage());
            return back()->with('error', 'An error occurred while deleting the class.');
        }
    }
}

