<?php

namespace App\Http\Controllers;

use App\Associazione;
use Illuminate\Http\Request;
use Session;
//use Illuminate\Support\Facades\DB;

class ModificaAsdController extends Controller
{
    public function mostraAsd() {

        $asd = Associazione::first();
        return view('modificaAsd', ["asd" => $asd]);

    }

    public function modificaAsd(Request $request) {

        $asd = Associazione::first();
        $asd -> nome = $request->post('nome');
        $asd -> iban = $request->post('iban');
        $asd -> indirizzo = $request->post('indirizzo');
        $asd -> cap = $request->post('cap');
        $asd -> citta = $request->post('citta');
        $asd -> provincia = $request->post('prov');
        $asd -> p_iva = $request->post('piva');
        $asd -> telefono = $request->post('tel');
        $asd -> giorno_ap = $request->post('giorno_ap'); //nuovo ma non usate ancora
        $asd -> giorno_chius = $request->post('giorno_chius');
        $asd -> orario_ap = $request->post('orario_ap');
        $asd -> orario_chius = $request->post('orario_chius');
        $asd -> sconto_dal = $request->post('sconto_dal');
        $asd -> sconto = $request->post('sconto'); //nuovo fin qui
        $asd->save();


        Session::flash('message', 'Modifica avvenuta con successo!');
        Session::flash('alert-class', 'alert-success');
        return view('modificaAsd', ["asd" => $asd])->with('alertAsd');

    }
}
