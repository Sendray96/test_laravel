<?php

namespace App\Http\Controllers;

use App\Associazione;
use App\Corso;
use App\DatiFiscali;
use App\Iscritto;
use App\Partecipazione;
use App\Sala;
use App\Socio;
use App\Transazione;
use Carbon\Carbon;
use App\Tessera;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IscrizioneSocioController extends Controller
{

    public function registrazione(Request $request){

        if ($request->has("nome")) {
            $iscritto = new Iscritto;
            $socio = new Socio;
            $socio->nome = $request->input("nome");
            $socio->cognome = $request->input("cognome");
            $socio->genere = $request->input("sesso");
            $socio->luogo_nasc = $request->input("nascita");
            $socio->data_nasc = $request->input("data");

            if($request->tipoSocio == 'option1'){
                $socio->tipo = 'allievo';
            } elseif ($request->tipoSocio == 'option2'){
                $socio->tipo = 'insegnante';
            }

            $socio->verbalizzato=0;
            $socio->fondatore=0;

            $iscritto->indirizzo = $request->input("indirizzo");
            $iscritto->cap = $request->input("cap");
            $iscritto->citta = $request->input("citta");
            $iscritto->provincia = $request->input("prov");
            $iscritto->cf = $request->input("cf");
            $iscritto->cellulare = $request->input("tel");
            $iscritto->email = $request->input("email");

            $iscritto->gestore = Auth::id();
            $iscritto->save();

            $socio->iscrizione = $iscritto->id;
            $socio->save();

            return redirect()->route("socio2", ["id" => $socio->id]);


        } else {
            return view("iscrizionesocio", [
                "errore" => ""
            ]);

        }
    /*} else {
            echo "ciao ".Auth::id()." ciao";
        }*/
    }


    public function registrazione2($id, Request $request){

        if($request->has("data1")){
            $socio = Socio::find($id);
            $iscritto  = Iscritto::find($socio->iscrizione);
            //data1 numero scadenza
            $iscritto->ass_rilascio = $request->get("data1");
            $iscritto->ass_scad = $request->get("scadenza1");
            $iscritto->ass_num = $request->get("numero");
            //data2 scadenza2
            $iscritto->cert_med_scadenza =  $request->get("scadenza2");
            $iscritto->cert_med_rilascio =  $request->get("data2");

            $iscritto->save();

            return redirect()->route('socio3', ["id" => $id]);

        } else {
            return view("iscrizionesocio2", [
                "errore" => "",
                "socio" => $id
            ]);
        }
    }

    public function registrazione3($id, Request $request){

        if($request->has("numero")){
            $socio = Socio::find($id);
            $tessera = new Tessera;
            $tessera->data_tess =  $request->get("emissione");
            $tessera->scad_tess =  $request->get("scadenza");
            $tessera->save();
            $socio->tessera  = $tessera->id;
            $socio->save();

            //dati fiscali
            //return redirect()->route();
            //echo $request->get("importo");
            $datifiscali = new DatiFiscali;
            $datifiscali->pagamento = $request->get("pagamento");
            $datifiscali->descrizione = $request->get("descrizione");
                //$datidiscali->importo = $request->get("importo");
                $datifiscali->tipo_doc = $request->get("tipoDocumento");
                $datifiscali->data_iscriz = date("Y-m-d");
            $datifiscali->socio = $socio->id;
            $datifiscali->save();
            $socio->dati_fiscali = $datifiscali->id;
            $socio->fondatore = 0;
            $socio->save();
            $trans = new Transazione();
            $trans->importo = $request->get("importo");
            $trans->tipo = "Entrata";
            $trans->socio = $id;
            $trans->save();



            if($id > 0){
                return redirect()->route('socio4', ["id" => $id]);
            } else {

                if (Auth::user()->ruolo=='admin' or 'Admin') {
                    return redirect()->route('HomeAdmin');
                } else  return redirect()->route('HomeUser');
            }




        } else {
            $dati = DatiFiscali::where("tipo_doc","F")->count();
            $ass = Associazione::all()->first();
            //$imp = $ass->importo;
            //for test
            $n_tess = Tessera::max("id");
            $n_tess += 1;
            $imp = 20;
            $fattura = DatiFiscali::where("tipo_doc","F")->count()+1;
            $ricevutaN = DatiFiscali::where("tipo_doc","RN")->count()+1;
            $ricevuta = DatiFiscali::where("tipo_doc","R")->count()+1;
            $ricevutaF= DatiFiscali::where("tipo_doc","RF")->count()+1;

            return view("iscrizionesocio3", [
                "errore" => "",
                "socio" => $id,
                "n_tess" => $n_tess,
                "F"=> $fattura,
                "RN"=> $ricevutaN,
                "R"=> $ricevuta,
                "RF"=> $ricevutaF,
                "importo" => $imp
            ]);
        }
    }


    public function registrazione4($id, Request $request)
    {

        $socio = Socio::find($id);
        $sale = Sala::all();
        $asd = Associazione::all();
        //dd($asd);

        $years = Carbon::parse($socio->data_nasc)->age; //calcola l'età dell'iscritto

        if ($request->isMethod("POST")) {

            if ($request->has('group')){
                $selezione = $request->post("group");
                foreach ($selezione as $sel){
                    $part = new Partecipazione();
                    $part->allievo = $id;
                    $part->corso = $sel;
                    $part->save();
                }
}
            return redirect()->route('HomeAdmin');
        } else {

            return view("iscrizionesocio4", [
                "errore" => "",
                "sale" => $sale,
                "socio" => $socio,
                "years" => $years,
                "asd" => $asd
            ]);
        }

    }





    //public function tiposocio($id, Request $request){
//
    //    if($request->isMethod("POST")){
    //        $socio = Socio::find($id);
    //        $socio->verbalizzato=0;
    //        $socio->save();
    //        $scelta = $request->get("direzione");
    //        switch ($scelta){
    //            case "termina":
    //                return redirect()->route("utenti",["id"=>$id]);
    //                break;
    //            case "corsi":
    //                return redirect()->route("corsi",["id"=>$id]);
    //        }
//
//
    //    } else {
//
    //        return view("tiposocio", [
    //            "errore" => "",
    //            "socio" => $id
    //        ]);
    //    }
    //}



//ciao


        public function stampaModuloIscr()

        {

            $path = '..\resources\modulistica\Modulo iscrizione min-magg.pdf';
            return response()->download($path);
        }


}
