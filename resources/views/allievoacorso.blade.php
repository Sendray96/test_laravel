@extends('templates.base', ['menu' => "on"])
@section('corpo')
    <div class="row mt-4">

        <div class="col-12 col-lg-12">
            <div class="mx-4 text-center">
                <h1 style="padding: 1rem; border: 3px solid black; border-right: none; border-left: none; color: black"
                    id="fornitore">ISCRIZIONE ALLIEVO A CORSO</h1>
            </div>
        </div>
        <div class="col-12 col-lg-12 mt-4"></div>

        <div class="col-12 col-lg-12 mt-5"></div>
        <div class="col-12 col-lg-8"></div>
        <div id="divSconto" class="col-12 col-lg-2 px-2" style="margin-top: -2.75rem;">
            <?php //TODO @if 2 o più corsi selezionati ?>
            <h4 class="pl-2" style="border: 2px dashed black; border-radius: 5px;"> Sconto del
                XX%<?php //TODO inserire sconto pacchetti ?>!</h4>
        </div>
        <div class="col-12 col-lg-2"></div>
        <div class="col-12 col-lg-2"></div>
        <div class="col-12 col-lg-8 mt-3">
            @foreach($sale as $sala)
                @foreach($sala->disciplina as $disciplina)
                    <div class="col-12 ml-n2"
                         style="font-weight: bold; background-color: #fff; width: 18%; border-radius: 10px; text-align: center; text-transform: uppercase">
                        <h4 style="padding-bottom: 0.1rem">
                            {{$disciplina->nome}}
                        </h4>
                    </div>
                    <div class="jumbotron" style="margin-top: -2.2rem;background-color: #cdf5de">

                        <div class="row">
                            @foreach($disciplina->corsi as $corso)
                                <div class="col-12 col-md-6 col-xl-4">

                                    <div class="jumbotron mr-1 text-center mb-n1"
                                         style="background-color: #13ce66; text-transform: uppercase" onclick="">
                                        <h5 class="py-3">
                                            {{$corso->nome}}
                                        </h5>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        @endforeach
                    </div>
                @endforeach
        </div>
        <div class="col-0 col-lg-2"></div>
    </div>
@endsection
