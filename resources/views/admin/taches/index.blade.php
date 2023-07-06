@extends('layouts.admin')
@section('content')

    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="row">
                    <div class="col">
                        <h4 class="page-title">Liste des tâches</h4>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Tables</a></li>
                            <li class="breadcrumb-item active">Tâches</li>
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
                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p class="text-center text-uppercase">{{ $message }}</p>
                    </div>
                @endif

                @if ($message = Session::get('error'))
                    <div class="alert alert-danger">
                        <p class="text-center">{{ $message }}</p>
                    </div>
                @endif
                <br><br>

                <!--AFFICHER LE MESSAGE D'ERROR-->
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <p>Humm!</p> Il y a eu des problèmes avec votre entrée.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>

            <div class="card">
                <div class="card-header">
                    <div class="card-body"><button type="button" class="btn btn-outline-primary" data-toggle="modal"
                            data-target="#exampleModalLogin">AJOUTER UNE TACHE</button>
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
                                                    Ajouter une tâche !</h4>
                                            </div>
                                        </div>

                                        <div class="tab-content">
                                            <div class="tab-pane active p-3 pt-3" id="LogIn_Tab" role="tabpanel">
                                                <form class="form-horizontal auth-form my-4" method="POST"
                                                    action="{{ route('save_tache') }}" enctype="multipart/form-data">
                                                    @csrf
                                                    <!--end form-group-->
                                                    <div class="form-group mb-2">
                                                        <label for="nom_tache">Nom de la tâche: </label>
                                                        <div class="input-group mb-3">
                                                            <input type="text"
                                                                class="form-control @error('nom_tache') is-invalid @enderror"
                                                                id="nom_tache" name="nom_tache"
                                                                placeholder="Saisissez le nom de la tâche">

                                                            <!-- Le message d'erreur -->
                                                            @error('nom_tache')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <!--end form-group-->

                                                    <div class="form-group mb-2">
                                                        <label for="attribution_id">Choisir l'attribution :</label>
                                                        <select class="form-select form-control" name="attribution_id"
                                                            id="attribution_id" required>
                                                            <option value="">Veuillez Choisir l'attribution</option>

                                                            @if (!is_null($attributions))
                                                                @foreach ($attributions as $attribution)
                                                                    <option value="{{ $attribution->id }}"
                                                                        {{ !is_null(old('attribution')) ? 'selected' : '' }}>
                                                                        {{ Str::ucfirst($attribution->nom_attribution) }}
                                                                    </option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                    </div><br>

                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="description">Description de la tâche: </label>
                                                                <textarea class="form-control summernote" rows="5" id="summernote" name="description">
                                                            </textarea>
                                                            </div>
                                                            @error('description')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                            </div>
                                            <!--end form-group-->
                                            <div class="form-group mb-0 row">
                                                <div class="col-12 mt-2"><button
                                                        class="btn btn-primary btn-block waves-effect waves-light"
                                                        type="submit">Ajouter<i class="fas fa-plus alt ml-1"></i></button>
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
                                <th scope="col">Nº</th>
                                <th>Codes</th>
                                <th>Tâches</th>
                                <th>Attributions</th>
                                <th>Statuts</th>
                                <th>Documents</th>
                                <th>Dates de création</th>
                                <th style="max-width: 200px !important">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (!is_null($taches))
                                @foreach ($taches as $tache)
                                    <tr>
                                        <td scope="col">{{ $tache->id }}</td>
                                        <td>{{ str_replace('tach', 'TACH', $tache->code_tache) }}</td>
                                        <td>{{ $tache->nom_tache }}</td>
                                        <td>{{ $tache->attribution->nom_attribution ?? '' }}</td>
                                        <td>
                                            <span class="badge {{ $tache->etatStatus($tache->etat)->etat_color }} fs-8 fw-bolder">{{ $tache->etatStatus($tache->etat)->status }}
                                            </span>
                                        </td>
                                        <td>
                                            @if($tache->document)
                                            @foreach ($tache->document as $key => $item)
                                                <a href="{{ asset('FichiersTaches/'.$item->libelle )}}" target="_blank" rel="noopener noreferrer">
                                                    <img src="{{ asset('assets/pdf.png') }}" target-="" title="{{ $item->libelle }}" alt="{{ $item->libelle }}" width="30">
                                                </a>
                                                @if($key == 2)
                                                <a class="mr-2 mt-4" href="#!" style="color:#03d87f"
                                                    data-target="#modalview_{{ $tache->id }}" data-toggle="modal">
                                                    Voir plus...
                                                </a>
                                                @break
                                                @endif
                                            @endforeach
                                        @endif
                                        </td>

                                        <td>{{ $tache->created_at }} <br>
                                            Ajouté par <span style="color: #1761fd ">{{ $tache->user->name ?? '' }}</span>
                                        </td>
                                        <td>
                                            <form id="form-{{ $tache->id }}"
                                                action="{{ route('delete_tache', $tache->id) }}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf
                                                @method('DELETE')
                                                <input type="hidden" name="_method" value="delete">

                                                <a class="btn btn-sm btn-soft-primary btn-circle mr-2" href="#!"
                                                    data-target="#modaltask_{{ $tache->id }}" data-toggle="modal"><i
                                                        class="dripicons-pencil" title="Modifier la tâche"></i>
                                                </a>
                                                <a class="btn btn-sm btn-soft-secondary btn-circle mr-2" href="#!"
                                                    data-target="#modaldstatuts_{{ $tache->id }}" data-toggle="modal">
                                                    <i class="fas fa-redo" aria-hidden="true"
                                                        title="Mettre à jour le statut"></i>
                                                </a>
                                                <a class="btn btn-sm btn-soft-primary btn-circle mr-2" href="#!"
                                                    data-target="#modalddocstache_{{ $tache->id }}"
                                                    data-toggle="modal">
                                                    <i class="fas fa-upload" title="Ajouter un document"></i>
                                                </a>
                                                <a class="btn btn-sm btn-soft-success btn-circle mr-2" href="#!"
                                                    data-target="#modaldetailtask_{{ $tache->id }}"
                                                    data-toggle="modal">
                                                    <i class="fa fa-info-circle" aria-hidden="true" title="Description de la tâche"></i>
                                                </a>

                                                <a class="btn btn-sm btn-soft-primary btn-circle mr-2" href="#!"
                                                    data-target="#modalshowmembretache_{{ $tache->id }}"
                                                    data-toggle="modal">
                                                    <i class="fa fa-info-circle" aria-hidden="true" 
                                                    title="Membres de la tâche"></i>
                                                </a><br><br>
                                                <button class="btn btn-sm btn-soft-danger btn-circle mr-2"
                                                    href=""><i class="dripicons-trash" title="Supprimer la tâche"
                                                        aria-hidden="true"></i>
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
        @if (!is_null($taches))
            @foreach ($taches as $tache)
                <div class="modal fade" id="modaltask_{{ $tache->id }}" tabindex="-1" role="dialog"
                    aria-labelledby="myLargeModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <!--end modal-header-->
                            <div class="modal-body">
                                <div class="card-body p-0 auth-header-box">
                                    <div class="text-center p-3">
                                        <h4 style="color: #1761fd; font-weight: blod"
                                            class="mt-3 mb-1 font-weight-semibold font-18">
                                            Mettre à jour la tâche !</h4>
                                    </div>
                                </div>
                                <div class="tab-content">
                                    <div class="tab-pane active p-3 pt-3" id="LogIn_Tab" role="tabpanel">
                                        <form class="form-horizontal auth-form my-4" method="POST"
                                            action="{{ route('tache_update', $tache->id) }}"
                                            enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="_method" value="put">

                                            <!--end form-group-->
                                            <div class="form-group mb-2">
                                                <label for="nom_tache">Nom de la tâche: </label>
                                                <div class="input-group mb-3">
                                                    <input type="text"
                                                        class="form-control @error('nom_tache') is-invalid @enderror"
                                                        value="{{ $tache->nom_tache }}" id="nom_tache" name="nom_tache"
                                                        placeholder="Saisissez le nom de la tâche">

                                                    <!-- Le message d'erreur -->
                                                    @error('nom_tache')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <!--end form-group-->

                                            <div class="form-group mb-2">
                                                <label for="attribution_id">Choisir l'attribution :</label>
                                                <select class="form-select form-control" name="attribution_id"
                                                    id="attribution_id">
                                                    @if (!is_null($attributions))
                                                        @foreach ($attributions as $attribution)
                                                            <option value="{{ $attribution->id }}"
                                                                @if ($tache->attribution == $attribution) selected @endif>
                                                                {{ $attribution->nom_attribution }}
                                                            </option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div><br>

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="description">Description de la tâche: </label>
                                                        <textarea class="form-control summernote" rows="5" id="summernote" name="description"> 
                                                        {{ $tache->description }} 
                                                    </textarea>
                                                    </div>
                                                    @error('description')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                    </div>
                                    <!--end form-group-->
                                    <div class="form-group mb-0 row">
                                        <div class="col-12 mt-2"><button
                                                class="btn btn-primary btn-block waves-effect waves-light"
                                                type="submit">Ajouter<i class="fas fa-plus alt ml-1"></i></button>
                                        </div>
                                        <!--end col-->
                                    </div>
                                    <!--end form-group-->
                                    </form>
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
        <!--modal statuts-->
        @if (!is_null($taches))
            @foreach ($taches as $tache)
                <div class="modal fade" id="modaldstatuts_{{ $tache->id }}" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalDefaultLogin" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <!--end modal-header-->
                            <div class="modal-body">
                                <div class="card-body p-0 auth-header-box">
                                    <div class="text-center p-3">
                                        <h4 style="color: #1761fd;" class="mt-3 mb-1 font-weight-semibold font-18">
                                            Choisir le statut de la tâche !</h4>
                                    </div>
                                </div>
                                <div class="tab-content">
                                    <div class="tab-pane active p-3 pt-3" id="LogIn_Tab" role="tabpanel">
                                        <form class="form-horizontal auth-form my-4" method="POST"
                                            action="{{ route('update.etat', $tache->id) }}"
                                            enctype="multipart/form-data">
                                            @csrf

                                            @method('PUT')
                                            <input type="hidden" name="_method" value="put">
                                            <!--end form-group-->

                                            <div class="form-group mb-2"><label for="etat">
                                                    Sélectionnez le statut:</label>
                                                {{ old('etat') }}
                                                <select class="form-select form-control" name="etat" id="etat">
                                                    <option value="">Veuillez Choisir le statut
                                                    </option>
                                                    @if (!is_null($etats))
                                                        @foreach ($etats as $etat)
                                                            <option value="{{ $etat->id }}"
                                                                @if ((int) $attribution->etat == (int) $etat->id) selected @endif>
                                                                {{ $etat->status }}
                                                            </option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div> <br>
                                            <div class="form-group mb-0 row">
                                                <div class="col-12 mt-2">
                                                    <button class="btn btn-primary btn-block waves-effect waves-light"
                                                        type="submit" style="color: #ffff">Mettre à jour <i
                                                            class="fas fa-plus ml-1" aria-hidden="true"></i>
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
        @if (!is_null($taches))
            @foreach ($taches as $tache)
                <div class="modal fade" id="modalddocstache_{{ $tache->id }}" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalDefaultLogin" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <!--end modal-header-->
                            <div class="modal-body">
                                <div class="card-body p-0 auth-header-box">
                                    <div class="text-center p-3">
                                        <h4 style="color: #1761fd;" class="mt-3 mb-1 font-weight-semibold font-18">
                                            Ajout de documents pour la tache !</h4>
                                    </div>
                                </div>
                                <div class="tab-content">
                                    <div class="tab-pane active p-3 pt-3" id="LogIn_Tab" role="tabpanel">
                                        <form class="form-horizontal auth-form my-4" method="POST" 
                                            action="{{ route('save.documents')}}"
                                            enctype="multipart/form-data">
                                            @csrf

                                            <div class="form-group mb-2">
                                                <label for="libelle">Charger un ou plusieurs :
                                                    <span style="color:red">(docx, pdf, image, etc)</span></label>
                                                <div class="input-group mb-3">
                                                    <input type="file" name="libelle[]" class="form-control" multiple id="inputGroupFile02"  required>
                                                    <label class="input-group-text" for="inputGroupFile02">Charger</label>
                                                  </div>
                                            </div>

                                            <div class="form-group mb-2">
                                                <label for="nom_fichier">Nom du fichiers :</label>
                                                <div class="input-group mb-3"><input type="text" class="form-control"
                                                        name="nom_fichier" required="" id="nom_fichier"
                                                        placeholder="Veuillez donner un nom au fichier">
                                                </div>
                                                @error('nom_fichier')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group mb-2"><label for="type_document_id">Type document :
                                                    <span style="color:red">(Veuillez Sélectionnez le type de
                                                        document)</span>
                                                </label>
                                                {{ old('marque') }}
                                                <select class="form-select form-control custom-select" name="type_document_id"
                                                    id="type_document_id" required="">
                                                    <option value="">Veuillez Choisir le type de document
                                                    </option>
                                                    @if (!is_null($typedocuments))
                                                        @foreach ($typedocuments as $typedocument)
                                                            <option value="{{ $typedocument->id }}"
                                                                {{ !is_null(old('marque')) ? 'selected' : '' }}>
                                                                {{ Str::ucfirst($typedocument->libelle) }}
                                                            </option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                                @error('type_document_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <!--end form-group-->
                                            <div class="form-group mb-2">
                                                <label for="tache_id"></label>
                                                <div class="input-group mb-3"><input type="hidden"
                                                        value="{{ $tache->id }}" class="form-control" name="tache_id"
                                                        id="tache_id">
                                                </div>
                                                @error('tache_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <!--end form-group-->
                                            <div class="form-group mb-0 row">
                                                <div class="col-12 mt-2">
                                                    <button class="btn btn-primary btn-block waves-effect waves-light"
                                                        type="submit" style="color: #ffff">Ajouter<i
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
    </section>

     <!--modal details-->
  <section>
    @if(!is_null($taches))
        @foreach($taches as $tache)
            <div class="modal fade" id="modaldetailtask_{{ $tache->id }}" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalDefaultLogin" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title m-0" id="myLargeModalLabel" style="color: #03d87f; font-size: 15px">{{$tache->nom_tache}}</h6>
                    <button type="button" class="close" data-dismiss="modal"
                        aria-label="Close"><span aria-hidden="true"><i class="la la-times"></i></span></button>
                </div>
                <!--end modal-header-->
                <div class="modal-body">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6 align-self">
                                    <p  class="text-muted mb-0"><span style="color: #1761fd; font-size: 15px">Description:</span><br><br>{!!$tache->description!!}<br>
                                    </p>
                                </div>
                                <!--end col-->
                                {{-- <div class="col-lg-6 align-self-center">
                                    <div class="single-pro-detail">
                                        <p style="color:#1761fd" class="mb-1">Informations</p>
                                        <div class="custom-border mb-3"></div>
                                        <h3 class="pro-title">Nom:  {{$membre->nom_membre}}</h3>
                                        <p class="text-muted mb-0">Prenoms: {{$membre->prenoms}}</p>
                                        <p class="text-muted mb-0">Email:  {{$membre->email}}</p>
                                        <p class="text-muted mb-0">Spécificité: {{$membre->specicite_fonction_membre}}</p>
                                        <p class="text-muted mb-0">Numéro whatsapp: {{$membre->num_whatsapp}}</p>
                                        <p class="text-muted mb-0">Utilisateurs:  {{$membre->user->name ?? ''}}</p>
                                    </div>
                                </div> --}}
                                <!--end col-->
                            </div>
                            <!--end row-->
                        </div>
                        <!--end card-body-->
                    </div>
                    <!--end row-->
                
                <!--end modal-body-->
                <div class="modal-footer">
                    <button type="button"
                        class="btn btn-danger btn-sm" data-dismiss="modal">Fermer
                    </button>
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
  <!--fin modal details-->

  
<section>
    @if(!is_null($taches))
        @foreach($taches as $tache)
            <div class="modal fade" id="modalshowmembretache_{{ $tache->id }}" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalDefaultLogin" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title m-0" id="myLargeModalLabel"></h6>
                    <button type="button" class="close" data-dismiss="modal"
                        aria-label="Close"><span aria-hidden="true"><i class="la la-times"></i></span></button>
                </div>
                <!--end modal-header-->
                <div class="modal-body">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="align-self-center">
                                        <div class="single-pro-detail">
                                            <p style="color:#1761fd; font-size: 17px" class="mb-1">
                                                Les membres de la commission assignés à cette tâche
                                            </p><br>
                                            <table class="table table-bordered dt-responsive mx-50"
                                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th scope="col">N°</th>
                                                    <th>Codes</th>
                                                    <th>Noms</th>
                                                    <th>Prénoms</th>
                                                    <th>Specicités</th>
                                                    <th>Commissions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if($tache->attribution)
                                                @if($tache->attribution->commissionAttributtion->membre ?? '' )
                                                @foreach($tache->attribution->commissionAttributtion->membre as $membre)
                                
                                                <tr>
                                                    <td style="width: 10px !important">{{$membre->id}}</td>
                                                    <td>{{ str_replace("mem","MEM",$membre->code_membre ) }}</td>
                                                    <td>{{$membre->nom_membre}}</td>
                                                    <td>{{$membre->prenoms}}</td>
                                                    <td>{{$membre->specicite_fonction_membre}}</td>
                                                    <td>{{$membre->commission->nom_commission}}</td>
                                                </tr>
                                                @endforeach
                                                @endif
                                                @endif
                                            </tbody> 
                                        </table>
                                        </div>
                                    </div>
                                </div>
                                
                                <!--end col-->
                            </div>
                            <!--end row-->
                        </div>
                        <!--end card-body-->
                    </div>
                    
                <div class="modal-footer"><button type="button"
                        class="btn btn-danger btn-sm" data-dismiss="modal">Fermer</button>
                </div>
                <!--end modal-footer-->
            </div>
            <!--end modal-content-->
        </div>
        <!--end modal-dialog-->
    </div>
    @endforeach
    @endif
</section> 

@endsection
