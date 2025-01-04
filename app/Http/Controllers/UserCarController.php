<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use \Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UserCarController extends Controller
{
    public function show($id): View {
        $user = User::findOrFail($id);
        $cars = $user->cars;

        return view('profile.cars', compact('cars'));
    }

    public function showRegisterCarView(): View {
        return view('profile.register_car');
    }

    public function showUpdateCarView($id): View {
        // Trova la macchina da aggiornare
        $car = Car::findOrFail($id);

        // Passa l'oggetto car alla vista
        return view('profile.update_car', compact('car'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'model_name' => ['required', 'max:25'],
            'license_plate' => ['required', 'max:7'],
        ]);

        try {
            // Creazione della macchina
            $car = Car::create($validatedData);

            Log::info('Attaching car to user', [
                'user_id' => auth()->id(),
                'car_id' => $car->id,
            ]);

            $user = auth()->user();
            $user->cars()->attach($car->id);

            return redirect()->route("cars.show", auth()->id())->with([
                'success' => 'Car registered successfully!',
            ]);
        } catch (QueryException $e) {
            Log::error($e->getMessage());
            return back()->withErrors([
                'error' => 'Error registering the car. Please try again.',
            ]);
        }
    }

    public function update(Request $request, $id): RedirectResponse
    {
        // Validazione dei dati in ingresso
        $validatedData = $request->validate([
            'model_name' => ['required', 'max:25'],
            'license_plate' => ['required', 'max:7'],
        ]);

        try {
            // Trova la macchina da aggiornare
            $car = Car::findOrFail($id);

            // Aggiorna le informazioni della macchina
            $car->update($validatedData);

            return redirect()->route("cars.show", auth()->id())->with([
                'success' => 'Car updated successfully!',
            ]);
        } catch (QueryException $e) {
            Log::error($e->getMessage());
            return back()->withErrors([
                'error' => 'Error updating the car. Please try again.',
            ]);
        }
    }

    public function destroy($id): RedirectResponse
    {
        try {
            // Trova la macchina da eliminare
            $car = Car::findOrFail($id);

            // Elimina la macchina
            $car->delete();

            return back()->with([
                'success' => 'Car deleted successfully!',
            ]);
        } catch (QueryException $e) {
            Log::error($e->getMessage());
            return back()->withErrors([
                'error' => 'Error deleting the car. Please try again.',
            ]);
        }
    }


}
