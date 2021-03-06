<head>
    <link rel="stylesheet" type="text/css" href="{{ url('css/toggleButton.css') }}">
    <script type="text/javascript" src="{{ url('js/toggleTesseramento.js') }}"></script>
    <script type="text/javascript" src="{{ url('js/toggleDocumento.js') }}"></script>
    <style>
        .inactive-link {
            pointer-events: none;
            cursor: default;
            background-color: #777;
        }
    </style>
</head>
<body>
<div class="row mt-4">

    <div class="col-12 col-lg-12">
        <div class="mx-4 text-center">
            <h1 style="padding: 1rem; border: 3px solid black; border-right: none; border-left: none; color: black"
                id="{{ $idTitle }}">{{ $title }}</h1>
        </div>
    </div>

    @if ($idTitle === "collaboratore")
        <div class="col-12 col-lg-12 mt-3"></div>
        <div class="col-2 col-lg-1 ml-n5"></div>
        <h4 class="mt-n1 ml-n2 mr-1">TESSERAMENTO</h4>&nbsp;
        <div class="row mb-2">
            <div class="clearfix"></div>
            <div class="col-sm-12">
                <label class="label-switch switch-primary">
                    <input type="checkbox" class="switch switch-bootstrap flagTesseramento"
                           onchange="toggleTesseramento()"
                           name="flagTesseramento" id="flagTesseramento" value="" checked>
                    <span class="lable"></span></label>
            </div>
        </div>

        <div class="col-12 col-lg-12" style="margin-top:33%"></div>
        <div class="col-12 col-lg-12 mt-3 ml-n4">
            <form id="FormNoTess" action="{{route('login')}}" method="get">
                @csrf
                <div class="form-group">
                    <input type="button" class="btn btn-dark ml-5 mt-5"
                           style="font-size: 22px; cursor: pointer; position: relative; z-index: 2;"
                           name="indietro"
                           id="indietro" value="Indietro" onclick="window.location.href='{{route("$nomeroute", ["$idBack"])}}';" formnovalidate>
                    <input type="submit" class="btn btn-dark mt-5 float-right"
                           style="font-size: 22px; cursor: pointer; position: relative; z-index: 2;"
                           name="termina" onclick="window.location.href='{{route('HomeAdmin')}}';"
                           id="termina" value="Termina" formnovalidate>
                </div>
            </form>
        </div>
    @else
        <div style="margin-top: 43%"></div>
    @endif

    <div class="col-12 col-lg-12" style="margin-top:-36%!important">
        <form id="FormTesseramento" action="" method="post">
            @csrf
                @if ($idTitle === "collaboratore")
                <div class="row mt-5">
                    <div class="col-12 col-lg-6 ml-5 mb-4" id="socioCollab">
                        <label for="tipoSocio"><h5>Tipologia Socio*</h5></label>
                        <div class="row mb-3">
                            <div class="col-2 col-lg-2">
                                <div class="form-check form-check-inline">
                                    <input type="radio" class="form-check-input" name="tipoSocio"
                                           id="allievo" value="option1">
                                    <label for="allievo" class="form-check-label" style="font-size: 1.1rem">Allievo</label>
                                </div>
                            </div>

                            <div class="col-2 col-lg-2">
                                <div class="form-check form-check-inline ml-2">
                                    <input type="radio" class="form-check-input" name="tipoSocio"
                                           id="insegnante" value="option2">
                                    <label for="insegnante" class="form-check-label"
                                           style="font-size: 1.1rem">Insegnante</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                    <div class="mt-n5"></div>
                @endif
            <div class="row mt-5">
                <h5 class="px-2"
                    style="margin-top: -0.75rem; margin-left: 3rem; color: gray; position:absolute; z-index: 2; background-color: #f4f7fa; font-weight: normal; ">
                    DATI TESSERA
                </h5></div>
            <div class="row ml-4 mr-4 mb-5">
                <div class="col-12 col-lg-12"
                     style="padding: 2rem; border: 0.1rem solid lightgray; border-radius: 5px;">
                    <div class="row">
                        <div class="col-12 col-lg-6 mt-2">
                            <div class="form-group">
                                <label for="numero" class="mb-0"><h5>Numero Tessera</h5></label>
                                <input type="text" class="form-control" name="numero" id="numero" value="{{$n_tess}}" readonly>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 mt-2"></div>
                        <div class="col-12 col-lg-6 mt-3">
                            <div class="form-group">
                                <label for="emissione" class="mb-0"><h5>Data di Emissione*</h5></label>
                                <input type="date" pattern="\d{4}/\d{1,2}/\d{1,2}" class="form-control" name="emissione"
                                       id="emissione" value="" required>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 mt-3 mb-n2">
                            <div class="form-group">
                                <label for="scadenza" class="mb-0"><h5>Data di Scadenza*</h5></label>
                                <input type="date" pattern="\d{4}/\d{1,2}/\d{1,2}" class="form-control" name="scadenza"
                                       id="scadenza" value="" required>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <h5 class="px-2"
                    style="margin-top: -0.75rem; margin-left: 3rem; color: gray; position:absolute; z-index: 2; background-color: #f4f7fa; font-weight: normal; ">
                    DATI FISCALI
                </h5></div>
            <div class="row ml-4 mr-4 mb-5 mt-n5">
                <div class="col-12 col-lg-12 mt-5"
                     style="padding: 2rem; border: 0.1rem solid lightgray; border-radius: 5px;">
                    <div class="row">
                        <div class="col-12 col-lg-3 mt-2">
                            <div class="form-group">
                                <label for="importo" class="mb-0"><h5>Importo iscrizione (€)</h5></label>
                                <input type="text" pattern="^\$?(([1-9](\d*|\d{0,2}(,\d{3})*))|0)(\.\d{1,2})?$"
                                       class="form-control" name="importo" id="importo" value="{{$importo}}"
                                       readonly>
                            </div>
                        </div>
                        <div class="col-12 col-lg-9 mt-2">
                            <div class="form-group">
                                <label for="descrizione" class="mb-0"><h5>Descrizione</h5></label>
                                <input type="text" class="form-control" name="descrizione" id="descrizione"
                                       value="" placeholder="es. quota annuale">
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 mt-3 mb-n2">
                            <div class="form-group">
                                <label for="pagamento" class="mb-0"><h5>Modalità di Pagamento*</h5></label>
                                <select class="custom-select" id="pagamento" name="pagamento" required>
                                    <option value="" disabled selected hidden>Scegli un'opzione</option>
                                    <option value="C">Contanti</option>
                                    <option value="A">Assegno</option>
                                    <option value="BB">Bonifico Bancario</option>
                                    <option value="B">Bancomat</option>
                                    <option value="CC">Carta di Credito</option>
                                    <option value="P">PayPal</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-lg-12 mt-5 mb-4"></div>

                        <h4 class="ml-3 mt-n1">RILASCIO DOCUMENTO FISCALE</h4>&nbsp;
                        <div class="row mb-n2">
                            <div class="clearfix"></div>
                            <div class="col-sm-12">
                                <label class="label-switch switch-primary">
                                    <input type="checkbox" class="switch switch-bootstrap flagDocumento"
                                           onchange="toggleDocumento()"
                                           name="flagDocumento" id="flagDocumento" value="">
                                    <span class="lable"></span></label>
                            </div>
                        </div>
                        <div class="col-12 col-lg-12 mt-3 mb-n2"></div>
                        <div class="col-12 col-lg-6 mt-3 mb-n2">
                            <div class="form-group">
                                <label for="tipoDocumento" class="mb-0"><h5>Tipo di Documento*</h5></label>
                                <select class="custom-select" id="tipoDocumento" name="tipoDocumento" onchange="toggleStampaButton()"
                                        required>
                                    <option value="" disabled selected hidden>Scegli un'opzione</option>
                                    <option value="RN">Ricevuta numerata</option>
                                    <option value="R">Ricevuta</option>
                                    <option value="RF">Ricevuta fiscale</option>
                                    <option value="F">Fattura</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 mt-3">
                            <div class="form-group">
                                <label for="numeroDocumento" class="mb-0"><h5>Numero Documento</h5></label>
                                <input type="text" class="form-control" name="numeroDocumento" id="numeroDocumento"
                                       value="" readonly>
                            </div>
                        </div>
                        <div class="col-12 col-lg-12 mt-3">
                            <div class="form-group">
                                <a class="btn btn-dark" style="font-size: 22px; color: #ffffff;" name="stampa"
                                   onclick="toggleStampa()"
                                   id="stampa">Stampa documento fiscale</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-12 mt-n5 ml-n4">
                <div class="form-group">
                    <input type="button" class="btn btn-dark mt-4"
                           style="font-size: 22px; cursor: pointer; margin-left:2rem" name="indietroTesseramento"
                           onclick="window.location.href='{{route("$nomeroute", ["$idBack"])}}';"
                           id="indietroTesseramento" value="Indietro" formnovalidate>

                    <input type="submit" class="btn btn-dark mt-4 mr-n3 float-right"
                           style="font-size: 22px; cursor: pointer;" name="continuaTesseramento"
                           id="continuaTesseramento" value="Continua">
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    function toggleStampa() {
        scelta = $("#tipoDocumento").val();
        switch (scelta) {
            case "RN":
                $("#numeroDocumento").val({{$RN}});
                window.open('{{route('stampapdf', ['tipoPdf'=> 'RN'])}}', "_blank");
                break;

            case "R":
                $("#numeroDocumento").val({{$R}});
                window.open('{{route('stampapdf', ['tipoPdf'=> 'R'])}}', '_blank');
                break;

            case "RF":
                $("#numeroDocumento").val({{$RF}});
                window.open('{{route('stampapdf', ['tipoPdf'=> 'RF'])}}', '_blank');
                break;

            case "F":
                $("#numeroDocumento").val({{$F}});
                window.open('{{route('stampapdf', ['tipoPdf'=> 'F'])}}', '_blank');
                break;
        }
    }
</script>
</body>

<?php
//TODO inserire controllo esistenza corsi. Nel caso di corsi esistenti, rimandare a iscrizioni-quartaparte.blade.php, altrimenti terminare iscrizione.
?>
