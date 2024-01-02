<?php

namespace App\Http\Controllers;

use App\Models\Messunger;
use App\Models\MessungerList;
use App\Models\User;
use Illuminate\Http\Request;

class MessungenController extends Controller
{
    public function index(Request $request)
    {
        $query = Messunger::latest();
        if ($request->has('search')) {
            $key = $request->input('search');
            $query->where(function ($q) use ($key) {
                $q->where('A', 'like', "%{$key}%")
                    ->orWhere('B', 'like', "%{$key}%")
                    ->orWhere('C', 'like', "%{$key}%")
                    ->orWhere('D', 'like', "%{$key}%")
                    ->orWhere('E', 'like', "%{$key}%")
                    ->orWhere('H', 'like', "%{$key}%")
                    ->orWhere('I', 'like', "%{$key}%")
                    ->orWhere('J', 'like', "%{$key}%")
                    ->orWhere('N', 'like', "%{$key}%")
                    ->orWhere('AC', 'like', "%{$key}%")
                    ->orWhere('AD', 'like', "%{$key}%")
                    ->orWhere('AE', 'like', "%{$key}%")
                    ->orWhere('AF', 'like', "%{$key}%")
                    ->orWhere('AG', 'like', "%{$key}%")
                    ->orWhere('AH', 'like', "%{$key}%")
                    ->orWhere('AI', 'like', "%{$key}%")
                    ->orWhere('AJ', 'like', "%{$key}%")
                    ->orWhere('AK', 'like', "%{$key}%")
                    ->orWhere('AL', 'like', "%{$key}%")
                    ->orWhere('AM', 'like', "%{$key}%")
                    ->orWhere('AN', 'like', "%{$key}%")
                    ->orWhere('AO', 'like', "%{$key}%")
                    ->orWhere('AP', 'like', "%{$key}%")
                    ->orWhere('AQ', 'like', "%{$key}%")
                    ->orWhere('AR', 'like', "%{$key}%")
                    ->orWhere('AS', 'like', "%{$key}%")
                    ->orWhere('AT', 'like', "%{$key}%");
            });
        }
        $data['url'] = 'Messunger';
        $data['search'] = $request->search;
        $data['messungens'] = $query->paginate(10);
        return view('admin.messungen.index', $data);
    }

    public function delete($id)
    {
        $user = Messunger::findOrFail($id);
        $user->delete();
        return redirect()->back()->with('success', 'Messunger deleted successfully.');
    }

    public function assign(Request $request)
    {
        $id = $request->input('messunger_id');
        $userId = $request->input('user_id');
        Messunger::where('id', $id)->update(['user_id' => $userId]);
        return response()->json(['message' => 'Kunde assigned successfully']);
    }

    public function messungerData(Request $request)
    {
        $bearer = $request->bearerToken();
        $user = User::where('access_token', $bearer)->first();

        if ($user->role_id == 1) {
            $query = Messunger::with('user:id,firmenname,standort,abteilung')->latest();
        } else {
            $query = Messunger::with('user:id,firmenname,standort,abteilung')
                ->where(function ($query) use ($user) {
                    $query->where('user_id', $user->id)
                        ->orWhere('user_id', null);
                })
                ->latest();
        }

        $messungens = $query->paginate(10);
        return response()->json($messungens);
    }


    public function messungerlistData(Request $request)
    {
        $messungerId = $request->input('messunger_id');

        if (empty($messungerId)) {
            return response()->json(['message' => 'Messunger ID is required'], 400);
        }

        $messungenLists = MessungerList::where('messunger_id', $messungerId)->get();

        return response()->json($messungenLists);
    }


    public function messungenIndex(Request $request)
    {
        $query = Messunger::where(function ($query) {
            $query->where('user_id', auth()->id())
                ->orWhere('user_id', null);
        })
            ->latest();
        if ($request->has('search')) {
            $key = $request->input('search');
            $query->where(function ($q) use ($key) {
                $q->where('A', 'like', "%{$key}%")
                    ->orWhere('B', 'like', "%{$key}%")
                    ->orWhere('C', 'like', "%{$key}%")
                    ->orWhere('D', 'like', "%{$key}%")
                    ->orWhere('E', 'like', "%{$key}%")
                    ->orWhere('H', 'like', "%{$key}%")
                    ->orWhere('I', 'like', "%{$key}%")
                    ->orWhere('J', 'like', "%{$key}%")
                    ->orWhere('N', 'like', "%{$key}%")
                    ->orWhere('AC', 'like', "%{$key}%")
                    ->orWhere('AD', 'like', "%{$key}%")
                    ->orWhere('AE', 'like', "%{$key}%")
                    ->orWhere('AF', 'like', "%{$key}%")
                    ->orWhere('AG', 'like', "%{$key}%")
                    ->orWhere('AH', 'like', "%{$key}%")
                    ->orWhere('AI', 'like', "%{$key}%")
                    ->orWhere('AJ', 'like', "%{$key}%")
                    ->orWhere('AK', 'like', "%{$key}%")
                    ->orWhere('AL', 'like', "%{$key}%")
                    ->orWhere('AM', 'like', "%{$key}%")
                    ->orWhere('AN', 'like', "%{$key}%")
                    ->orWhere('AO', 'like', "%{$key}%")
                    ->orWhere('AP', 'like', "%{$key}%")
                    ->orWhere('AQ', 'like', "%{$key}%")
                    ->orWhere('AR', 'like', "%{$key}%")
                    ->orWhere('AS', 'like', "%{$key}%")
                    ->orWhere('AT', 'like', "%{$key}%");
            });
        }
        $data['url'] = 'Messunger';
        $data['search'] = $request->search;
        $data['messungens'] = $query->paginate(10);
        return view('user.messungen.index', $data);
    }

}
