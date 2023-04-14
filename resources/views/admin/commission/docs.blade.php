@extends('layouts.admin')
@section('content')

<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="row">
                <div class="col">
                    <h4 class="page-title">Liste des documents des commissions</h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Tables</a></li>
                        <li class="breadcrumb-item active">Documents</li>
                    </ol>
                </div>
               
            </div>
            <!--end row-->
        </div>
        <!--end page-title-box-->
    </div>
    <!--end col-->
</div>

<div class="row">
    <div class="col-12 mb-2">
        <div class="form-group ">
            <!--AFFICHER LE MESSAGE DE SUCCESS-->
            @if($message = Session::get('success'))
                <div class="alert alert-success">
                    <p class="text-center text-uppercase">{{ $message }}</p>
                </div>
            @endif

            @if($message = Session::get('error'))
                <div class="alert alert-danger">
                    <p class="text-center">{{ $message }}</p>
                </div>
            @endif<br><br>

            <!--AFFICHER LE MESSAGE D'ERROR-->
            @if($errors->any())
                <div class="alert alert-danger">
                    <p>Humm!</p> Il y a eu des problèmes avec votre entrée.<br><br>
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>

        <div class="card">
            {{-- <div class="card-header">
                <div class="card-body"><button type="button" class="btn btn-outline-primary" data-toggle="modal"
                        data-target="#exampleModalLogin">Ajouter un type document</button>
                    <!--modal-->
                    <div class="modal fade" id="exampleModalLogin" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalDefaultLogin" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <!--end modal-header-->
                                <div class="modal-body">
                                    <div class="card-body p-0 auth-header-box">
                                        <div class="text-center p-3">
                                            <h4 style="color: red; font-size: 12px" class="mt-3 mb-1 font-weight-semibold font-18">
                                                Ajouter un type document !</h4>
                                        </div>
                                    </div>

                                    <div class="tab-content">
                                        <div class="tab-pane active p-3 pt-3" id="LogIn_Tab" role="tabpanel">
                                            <form class="form-horizontal auth-form my-4" method="POST"
                                                action="#" enctype="multipart/form-data">
                                                @csrf

                                                <!--end form-group-->
                                                <div class="form-group mb-2">
                                                    <label for="nom_commission">Type document : </label>
                                                    <div class="input-group mb-3"><input type="text"
                                                            class="form-control" name="libelle"
                                                            id="libelle" required=""
                                                            value="{{ old('libelle') }}"
                                                            placeholder="Entrez le nom un type document svp !">
                                                    </div>
                                                    @error('libelle')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <!--end form-group-->
                                        </div>
                                        <!--end form-group-->
                                        <div class="form-group mb-0 row">
                                            <div class="col-12 mt-2"><button
                                                    class="btn btn-primary btn-block waves-effect waves-light"
                                                    type="submit">Enregistrer<i class="fas fa-sign-in-alt ml-1"></i></button>
                                            </div>
                                            <!--end col-->
                                        </div>
                                        <!--end form-group-->
                                        </form>
                                    </div>
                                </div>
                                <!--end card-body-->
                                <div class="card-body bg-light-alt text-center">
                                    <span class="text-muted d-none d-sm-inline-block">Planning N'zrama Festival © 2023
                                    </span>
                                </div>
                            </div>
                            <!--end modal-body-->
                        </div>
                        <!--end modal-content-->
                    </div>
                    <!--end modal-->

                </div>
            </div> --}}
            <!--end card-header-->
            <div class="card-body">
                <table id="datatable" class="table table-bordered dt-responsive"
                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th scope="col">Nº</th>
                            <th>Noms fichiers</th>
                            <th>Type de fichiers</th>
                            <th>Libelles</th>
                            <th>Fichiers</th>
                            <th>Dates de création</th>
                            <th style="max-width: 120px !important">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(!is_null($commissions))
                        @foreach($commissions as $commission)
                        <tr>
                            <td scope="col">{{ $commission->id}}</td>
                            <td>
                                @if($commission->document->count())
                                    @foreach($commission->document as $document)
                                    {{ $document->nom_fichier ?? '' }} <br><br>
                                    @endforeach
                                 @endif
                             </td>

                             <td>
                                @if($commission->document->count())
                                 @foreach($commission->document as $document)
                                 {{ $document->typedocument->libelle ?? '' }} <br><br>
                                 @endforeach
                                 @endif
                             </td>

                            <td>
                               @if($commission->document)
                                @foreach($commission->document as $document)
                                {{ $document->libelle ?? '' }} <br><br>
                                @endforeach
                                @endif
                            </td>
                            <td>
                                @if($commission->document)
                                @foreach($commission->document as $doc)
                                 @if(!is_null($doc->libelle))
                                    <a href="{{ asset('FichierCommission/'.$doc->libelle) }}"
                                        target="_blank" rel="noopener noreferrer">
                                        <img src="{{ asset('assets/pdf.png') }}" target-="" 
                                        alt="{{$doc->libelle}}" 
                                        title="{{$doc->libelle}},  Télécharger" width="25">
                                    </a><br><br>
                                @endif
                                @endforeach
                                @endif

                           </td>
                            <td>{{ $commission->created_at}}</td>
                            <td>
                                @if($commission->document->count())
                                @foreach($commission->document as $document)
                                    <form  id="form-{{$document->id}}" 
                                    action="{{ route('supprime_document', $document->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('DELETE')

                                    <a class="btn btn-sm btn-soft-success btn-circle mr-2" href="#!"
                                        data-target="#modalupdatedocs_{{ $document->id }}" data-toggle="modal"><i class="dripicons-pencil"
                                            title="Modifier le document"></i>
                                    </a>
                                    <button class="btn btn-sm btn-soft-danger btn-circle mr-2" href=""><i
                                            class="dripicons-trash" title="Supprimer" aria-hidden="true"></i>
                                    </button> <br><br>
                                @endforeach
                               @endif
                                
                                </form>
                            </td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div><!-- end col -->
</div><!-- end row -->

<section>
    <!--modal-->
    @if(!is_null($documents))
        @foreach($documents as $document)
            <div class="modal fade" id="modalupdatedocs_{{ $document->id }}" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalDefaultLogin" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <!--end modal-header-->
                        <div class="modal-body">
                            <div class="card-body p-0 auth-header-box">
                                <div class="text-center p-3">
                                    <h4 style="color: #1761fd; font-weight: blod" class="mt-3 mb-1 font-weight-semibold font-18">
                                        Mettre à jour le document!</h4>
                                </div>
                            </div>
                            <div class="tab-content">
                                <div class="tab-pane active p-3 pt-3" id="LogIn_Tab" role="tabpanel">
                                    <form class="form-horizontal auth-form my-4" method="POST"
                                    action="{{route('update.docs', $document->id)}}" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                        <input type="hidden" name="_method" value="put">
                                            <!--end form-group-->
                                            <div class="form-group">
                                                <label for="image_service">Charger le fichier :
                                                    <span style="color:red">(docx, pdf, image, etc)</span></label>
                                                <div class="custom-file"><input type="file"
                                                       value="{{ old('libelle') }}"
                                                        class="custom-file-input" name="libelle[]" multiple id="validatedCustomFile">
                                                        <label class="custom-file-label"
                                                        for="validatedCustomFile">Cliquez pour choisir le fichier
                                                        svp !</label><br><br>

                                                        @if($commission->document)
                                                        {{-- @foreach($commission->document as $doc) --}}
                                                         @if(!is_null($doc->libelle))
                                                            <a href="{{ asset('FichierCommission/'.$doc->libelle) }}"
                                                                target="_blank" rel="noopener noreferrer">
                                                                <img src="{{ asset('assets/pdf.png') }}" target-="" 
                                                                alt="{{$doc->libelle}}" 
                                                                title="{{$doc->libelle}},  Télécharger" width="25">
                                                            </a>
                                                        @endif
                                                        {{-- @endforeach --}}
                                                        @endif
                                                        
                                                    <div class="invalid-feedback">Example invalid custom file
                                                        feedback
                                                    </div>
                                                </div>

                                                @error('libelle')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <!--end form-group-->

                                            <div class="form-group mb-2">
                                                <label for="nom_fichier">Nom fichier : </label>
                                                <div class="input-group mb-3"><input type="text"
                                                        class="form-control" name="nom_fichier"
                                                        value="{{$document->nom_fichier }}"
                                                        id="nom_fichier" placeholder="Veuillez donner un nom au fichier">
                                                </div>
                                                @error('nom_fichier')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group mb-2"><label for="type_document_id">
                                                Type document :</label>
                                                {{ (old('marque')) }}
                                                <select class="form-select form-control" name="type_document_id"
                                                    id="type_document_id" required>
                                                    <option value="Choisir le type de document">Veuillez Choisir le type de document
                                                    </option>
                                                    @if(!is_null($typedocuments))
                                                        @foreach($typedocuments as $typedocument)
                                                            <option value="{{ $typedocument->id }}"
                                                                @if((int) $document->type_document_id == (int)$typedocument->id ) selected
                                                                @endif>{{ $typedocument->libelle }}
                                                            </option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>

                                            <!--end form-group-->
                                            <div class="form-group mb-2">
                                                <label for="commission_id"></label>
                                                <div class="input-group mb-3"><input type="hidden" 
                                                    value="{{ $commission->id }}"
                                                        class="form-control" name="commission_id" id="commission_id">
                                                </div>
                                                @error('commission_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <!--end form-group-->
                                        <div class="form-group mb-0 row">
                                            <div class="col-12 mt-2">
                                                <button class="btn btn-primary btn-block waves-effect waves-light"
                                                    type="submit" style="color: #ffff">Ajouter<i class="fas fa-plus  ml-1"></i>
                                                </button>
                                            </div>
                                        </div>
                                </form>
                                </div>
                            </div>
                            <!--end card-body-->
                            <div class="card-body bg-light-alt text-center">
                                <span class="text-muted d-none d-sm-inline-block">Planning N'zrama Festival © 2023
                                </span>
                            </div>
                        </div>
                        <!--end modal-body-->
                    </div>
                    <!--end modal-content-->
                </div>
                <!--end modal-dialog-->
            </div>
            <!--end modal-->
            </div>
        @endforeach
    @endif
</section> 
@endsection