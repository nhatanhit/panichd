<?php
namespace PanicHD\PanicHD\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PanicHD\PanicHD\Models\Setting;
use Illuminate\Support\Facades\Session;

use PanicHD\PanicHD\Models\Game;
class GameController extends Controller {
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $setting = new Setting();
        $games = Game::orderBy('created_date')->get();
        return view('game.index', [
            'games' => $games,
            'setting' => $setting
        ]);
    }
    public function new() {
        $setting = new Setting();
        return view('game.new',[
            'setting' => $setting
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function store(Request $request) {
        $game = new Game();
        $game->name = $request->name;
        $game->description = $request->description;
        $game->save();
        Session::flash('status', trans('panichd::lang.category-name-has-been-created', ['name' => $request->name]));
        return redirect()->action('\PanicHD\PanicHD\GameController@index');
    }
}
