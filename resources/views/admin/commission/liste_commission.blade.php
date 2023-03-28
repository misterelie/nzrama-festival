@extends('layouts.admin')
@section('content')

<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="row">
                <div class="col">
                    <h4 class="page-title">Liste des commissions</h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Tables</a></li>
                        <li class="breadcrumb-item active">Commissions</li>
                    </ol>
                </div>
                <!--end col-->
                <div class="col-auto align-self-center"><a href="#" class="btn btn-sm btn-outline-primary"
                        id="Dash_Date"><span class="day-name" id="Day_Name">Today:</span>&nbsp; <span class=""
                            id="Select_date">Jan
                            11</span> <i data-feather="calendar" class="align-self-center icon-xs ml-1"></i> </a><a
                        href="#" class="btn btn-sm btn-outline-primary"><i data-feather="download"
                            class="align-self-center icon-xs"></i></a></div>
                <!--end col-->
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
            <div class="card-header">
                <div class="card-body"><button type="button" class="btn btn-outline-primary" data-toggle="modal"
                        data-target="#exampleModalLogin">Créer une commission</button>
                    <!--modal-->
                    <div class="modal fade" id="exampleModalLogin" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalDefaultLogin" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <!--end modal-header-->
                                <div class="modal-body">
                                    <div class="card-body p-0 auth-header-box">
                                        <div class="text-center p-3">
                                            <h4 style="color: #1761fd" class="mt-3 mb-1 font-weight-semibold font-18">
                                                Créer une commission !</h4>
                                        </div>
                                    </div>

                                    <div class="tab-content">
                                        <div class="tab-pane active p-3 pt-3" id="LogIn_Tab" role="tabpanel">
                                            <form class="form-horizontal auth-form my-4" method="POST"
                                                action="{{ url('store/commission') }}" enctype="multipart/form-data">
                                                @csrf

                                                <!--end form-group-->
                                                <div class="form-group mb-2">
                                                    <label for="nom_commission">Nom commission : </label>
                                                    <div class="input-group mb-3"><input type="text"
                                                            class="form-control" name="nom_commission"
                                                            id="nom_commission"
                                                            value="{{ old('nom_commission') }}"
                                                            placeholder="Veuillez saisir le nom de la commission">
                                                    </div>
                                                    @error('nom_commission')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <!--end form-group-->

                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group"><label for="description_commission">Description commission: </label>
                                                            <textarea class="form-control summernote" rows="5" id="summernote"
                                                                name="description_commission" placeholder="">
                                                            </textarea>
                                                        </div>
                                                        @error('description_commission')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                        </div>
                                        <!--end form-group-->
                                        <div class="form-group mb-0 row">
                                            <div class="col-12 mt-2"><button
                                                    class="btn btn-primary btn-block waves-effect waves-light"
                                                    type="submit">Créer<i class="fas fa-sign-in-alt ml-1"></i></button>
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
            </div>
            <!--end card-header-->

            <div class="card-body">
                <table id="datatable" class="table table-bordered dt-responsive"
                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th>Commissions</th>
                            <th>Code commission</th>
                            <th>Auteurs commission</th>
                            <th>Documents commission</th>
                            <th>Status</th>
                            <th>Date de création</th>
                            <th style="max-width: 170px !important">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(!is_null($commissions))
                        @foreach($commissions as $commission) 
                        <tr>
                            <td scope="col">{{ $commission->id }}</td>
                            <td>{{ $commission->nom_commission}}</td>
                            <td>{{ $commission->code_commission }}</td>
                            <td>{{ $commission->user->name ?? '' }}</td>
                            <td>
                                @if($commission->document->count() > 0)
                                    @foreach ($commission->document as $item)
                                        <a href="{{ asset('FichierCommission/'.$item->libelle )}}" target="_blank" rel="noopener noreferrer">
                                            <img src="{{ asset('assets/pdf.png') }}" target-="" title="{{ $item->libelle }}" alt="{{ $item->libelle }}" width="30">
                                        </a>
                                    @endforeach
                                @endif
                            </td>
                            <td>
                                <span class="badge {{$commission->etatStatus($commission->etat)->etat_color}} fs-8 fw-bolder">{{$commission->etatStatus($commission->etat)->status}}</span>

                                {{-- @if (!is_null($commission->etat))
                                 <span class="badge badge-danger fs-8 fw-bolder">{{$commission->etat = 'En cours'}}</span>
                                @endif

                                @if (!is_null($commission->etat))
                                <span class="badge badge-success fs-8 fw-bolder">{{$commission->etat = 'Terminé'}}</span> --}}

                            </td>

                            <td>{{ $commission->created_at }}</td>
                            <td>
                                <form  id="form-{{$commission->id}}" 
                                    action="{{ url('supprime/commission', $commission->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('DELETE')

                                    <a class="btn btn-sm btn-soft-success btn-circle mr-2" href="#!"
                                        data-target="#modal_{{ $commission->id }}" data-toggle="modal"><i class="dripicons-pencil" title="Modifier la commission"></i>
                                    </a>

                                    <a  class="btn btn-sm btn-soft-primary btn-circle mr-2" href="#!"
                                        data-target="#modald_{{ $commission->id }}" data-toggle="modal">
                                        <i class="fas fa-plus" title="Ajouter un document"></i>
                                    </a>

                                    <a class="btn btn-sm btn-soft-secondary btn-circle mr-2" href="#!"
                                        data-target="#modalview_{{ $commission->id }}" data-toggle="modal">
                                        <i class="fa fa-eye" title="Consulter les détails"></i>
                                    </a>

                                    {{-- <a class="btn btn-sm btn-soft-success btn-circle mr-2" href="#!"
                                    data-target="#modaldstatuts_{{ $commission->id }}" data-toggle="modal">
                                    <i class="fa fa-check" aria-hidden="true" 
                                      title="Choisir le status de la commission"></i>
                                    </a> --}}

                                    <button class="btn btn-sm btn-soft-danger btn-circle mr-2" href=""><i
                                            class="dripicons-trash" title="Supprimer la commission" aria-hidden="true"></i>
                                    </button>
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
    <!--modal mettre a jour la commissions-->
    @if(!is_null($commissions))
        @foreach($commissions as $commission)
            <div class="modal fade" id="modal_{{ $commission->id }}" tabindex="-1" role="dialog"
                aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <!--end modal-header-->
                        <div class="modal-body">
                            <div class="card-body p-0 auth-header-box">
                                <div class="text-center p-3">
                                    <h4 style="color: #1761fd; font-weight: blod" class="mt-3 mb-1 font-weight-semibold font-18">
                                        Mettre à jour la commission !</h4>
                                </div>
                            </div>
                            <div class="tab-content">
                                <div class="tab-pane active p-3 pt-3" id="LogIn_Tab" role="tabpanel">
                                    <form class="form-horizontal auth-form my-4" method="POST"
                                        action="{{ url('update/commission', $commission->id) }}"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="_method" value="put">
                                        
                                                <!--end form-group-->
                                                <div class="form-group mb-2">
                                                    <label for="nom_commission">Nom commission : </label>
                                                    <div class="input-group mb-3"><input type="text"
                                                            class="form-control" name="nom_commission"
                                                            id="nom_commission" value="{{ $commission->nom_commission }}">
                                                    </div>
                                                    @error('nom_commission')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <!--end form-group-->

                                                

                                                <div class="form-group mb-2"><label for="etat">Status:</label>
                                                    {{ (old('marque')) }}
                                                    <select class="form-select form-control" name="etat"
                                                        id="etat" required>
                                                        <option value="Choisir le status">Veuillez Choisir le status
                                                        </option>
                                                        @if(!is_null($etats))
                                                            @foreach($etats as $etat)
                                                                <option value="{{ $etat->id }}"
                                                                    {{ !is_null(old("marque")) ? 'selected' : '' }}>
                                                                    {{ Str::ucfirst($etat->status) }}
                                                                </option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div> <br>

                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="description_commission">Description commission: </label>
                                                            <textarea class="form-control summernote" rows="5" id="summernote"
                                                                name="description_commission" placeholder="">{{ $commission->description_commission }} 
                                                            </textarea>
                                                        </div>
                                                        @error('description_commission')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                        
                                            <div class="form-group mb-0 row">
                                            <div class="col-12 mt-2">
                                                <button class="btn btn-primary btn-block waves-effect waves-light"
                                                    type="submit">Mettre à jour<i class="fas fa-sign-in-alt ml-1"></i></button>
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


<section>
    <!--modal ajout de document pour chaque commission-->
    @if(!is_null($commissions))
        @foreach($commissions as $commission)
            <div class="modal fade" id="modald_{{ $commission->id }}" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalDefaultLogin" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <!--end modal-header-->
                        <div class="modal-body">
                            <div class="card-body p-0 auth-header-box">
                                <div class="text-center p-3">
                                    <h4 style="color: red;" class="mt-3 mb-1 font-weight-semibold font-18">
                                        Ajouter un document à la commission !</h4>
                                </div>
                            </div>
                            <div class="tab-content">
                                <div class="tab-pane active p-3 pt-3" id="LogIn_Tab" role="tabpanel">
                                    <form class="form-horizontal auth-form my-4" method="POST"
                                        action="{{ url('save/documents')}}" enctype="multipart/form-data">
                                        @csrf
                                                <!--end form-group-->
                                                <div class="form-group"><label for="image_service">Charger le fichier :
                                                        <span style="color:red">(docx, pdf, image, etc)</span></label>

                                                    <div class="custom-file"><input type="file"
                                                           value="{{ old('libelle') }}"
                                                            class="custom-file-input" name="libelle[]" multiple id="validatedCustomFile"
                                                            required=""><label class="custom-file-label"
                                                            for="validatedCustomFile">Cliquez pour choisir le fichier
                                                            svp !</label>
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
                                                            id="nom_fichier" placeholder="Veuillez donner un nom au fichier">
                                                    </div>
                                                    @error('nom_fichier')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="form-group mb-2"><label for="type_document_id">Type document :</label>
                                                    {{ (old('marque')) }}
                                                    <select class="form-select form-control" name="type_document_id"
                                                        id="type_document_id" required>
                                                        <option value="Choisir le type de document">Veuillez Choisir le type de document
                                                        </option>
                                                        @if(!is_null($typedocuments))
                                                            @foreach($typedocuments as $typedocument)
                                                                <option value="{{ $typedocument->id }}"
                                                                    {{ !is_null(old("marque")) ? 'selected' : '' }}>
                                                                    {{ Str::ucfirst($typedocument->libelle) }}
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

<section>
    <!--modal ajout de document pour chaque commission-->
    @if(!is_null($commissions))
        @foreach($commissions as $commission)
            <div class="modal fade" id="modalview_{{ $commission->id }}" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalDefaultLogin" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title m-0" id="myLargeModalLabel">{{ $commission->nom_commission}}</h6>
                    <button type="button" class="close" data-dismiss="modal"
                        aria-label="Close"><span aria-hidden="true"><i class="la la-times"></i></span></button>
                </div>
                <!--end modal-header-->
                <div class="modal-body">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6 align-self">
                                    <h3>Vous pouvez télécharger: <br><br>
                                        @if($commission->document->count() > 0)
                                        @foreach ($commission->document as $item)
                                            <a href="{{ asset('FichierCommission/'.$item->libelle )}}" target="_blank" rel="noopener noreferrer">
                                                <img src="{{ asset('assets/pdf.png') }}" target-="" title="{{ $item->libelle }}" alt="{{ $item->libelle }}" width="100">
                                            </a>
                                        @endforeach
                                    @endif
                                    </h3>
                                </div>
                                <!--end col-->
                                <div class="col-lg-6 align-self-center">
                                    <div class="single-pro-detail">
                                        <p style="color:#1761fd" class="mb-1">Description commission</p>
                                        <div class="custom-border mb-3"></div>
                                        <h3 class="pro-title">Auteur: {{ $commission->user->name ?? '' }}</h3>
                                        <p class="text-muted mb-0">{!!$commission->description_commission!!}</p>
                                        
                                        
                                    </div>
                                </div>
                                <!--end col-->
                            </div>
                            <!--end row-->
                        </div>
                        <!--end card-body-->
                    </div>
                    <!--end row-->
                
                <!--end modal-body-->
                <div class="modal-footer"><button type="button"
                        class="btn btn-danger btn-sm" data-dismiss="modal">Fermer</button>
                </div>
                <!--end modal-footer-->
            </div>
            <!--end modal-content-->
        </div>
        <!--end modal-dialog-->
    </div>
        <!--end modal-->
                <!--end modal-dialog-->
            </div>
            <!--end modal-->
            </div>
        @endforeach
    @endif
</section>
{{-- <section>
    <!--modal ajout de document pour chaque commission-->
    @if(!is_null($commissions))
        @foreach($commissions as $commission)
            <div class="modal fade" id="modaldstatuts_{{ $commission->id }}" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalDefaultLogin" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <!--end modal-header-->
                        <div class="modal-body">
                            <div class="card-body p-0 auth-header-box">
                                <div class="text-center p-3">
                                    <h4 style="color: red;" class="mt-3 mb-1 font-weight-semibold font-18">
                                        Choisir le status de la commission !</h4>
                                </div>
                            </div>
                            <div class="tab-content">
                                <div class="tab-pane active p-3 pt-3" id="LogIn_Tab" role="tabpanel">
                                    <form class="form-horizontal auth-form my-4" method="POST" 
                                        action="{{ route('etat.commission')}}"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <!--end form-group-->
                                       <div class="form-group mb-2"><label for="etat_id">Status:</label>
                                                    {{ (old('etat_id')) }}
                                                    <select class="form-select form-control" name="etat_id"
                                                        id="etat_id" required>
                                                        <option value="Choisir le status">Veuillez Choisir le status
                                                        </option>
                                                        @if(!is_null($etats))
                                                            @foreach($etats as $etat)
                                                                <option value="{{ $etat->id }}"
                                                                    {{ !is_null(old("etat_id")) ? 'selected' : '' }}>
                                                                    {{ Str::ucfirst($etat->status) }}
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
                                                    type="submit" style="color: #ffff">Enregistrer<i
                                                        class="fas fa-plus  ml-1"></i>
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
</section> --}}


@endsection