@extends('layouts.admin')
@section('content')

<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="row">
                <div class="col">
                    <h4 class="page-title">Liste des attributions</h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Tables</a></li>
                        <li class="breadcrumb-item active">Attributions</li>
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
            <div class="card-header">
                <div class="card-body"><button type="button" class="btn btn-outline-primary" data-toggle="modal"
                        data-target="#exampleModalLarge">AJOUTER UNE ATTRIBUTION </button>
                    <!--modal-->
                    <div class="modal fade bd-example-modal-lg" id="exampleModalLarge" tabindex="-1" role="dialog"
                        aria-labelledby="myLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <!--end modal-header-->
                                <div class="modal-body">
                                    <div class="card-body p-0 auth-header-box">
                                        <div class="text-center p-3">
                                            <h4 style="color: #1761fd; font-size: 12px"
                                                class="mt-3 mb-1 font-weight-semibold font-18">
                                                AJOUTER UNE ATTRIBUTION !</h4>
                                        </div>
                                    </div>
                                    <div class="tab-content">
                                    <div class="tab-pane active p-3 pt-3" id="LogIn_Tab" role="tabpanel">
                                        <form class="form-horizontal auth-form my-4" method="POST"
                                        action="{{ route('save.attribution') }}" enctype="multipart/form-data">
                                        @csrf

                                        <!--end form-group-->
                                        <div class="form-group mb-2">
                                            <label for="nom_attribution">Nom de l'attribution : </label>
                                            <div class="input-group mb-3"><input type="text"
                                                    class="form-control" name="nom_attribution"
                                                    id="nom_attribution" required=""
                                                    value="{{ old('nom_attribution') }}"
                                                    placeholder="Saisissez le nom de l'attribution svp !">
                                            </div>
                                            @error('nom_attribution')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <!--end form-group-->

                                        <div class="form-group mb-2">
                                            <label for="commission_id">Commission:</label>
                                            {{ (old('commission')) }}
                                            <select class="form-select form-control" name="commission_id"
                                                id="commission_id">
                                                <option value="">Veuillez Choisir la commission de l'attribution
                                                </option>
                                                @if(!is_null($commissions))
                                                    @foreach($commissions as $commission)
                                                        <option value="{{ $commission->id }}"
                                                            {{ !is_null(old("categorie")) ? 'selected' : '' }}>
                                                            {{ Str::ucfirst($commission->nom_commission) }}
                                                        </option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            @error('commission_id')
                                             <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div> <br>

                                        <div class="form-group mb-2">
                                            <label for="description_attribution">
                                                Description de l'attribution : </label>
                                            <div class="input-group mb-3">
                                                <textarea class="form-control" id="exampleFormControlTextarea1" name="description_attribution" rows="4" 
                                                placeholder="Saisissez la description ici svp !"></textarea>
                                            </div>

                                            @error('description_attribution')
                                             <span class="text-danger">{{ $message }}</span>
                                            @enderror
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
                            <th>Attributions</th>
                            <th>Commissions</th>
                            <th>Statuts</th>
                            <th>Documents</th>
                            <th>Dates de création</th>
                            {{-- <th>Dates de création</th> --}}
                            <th style="max-width: 200px !important">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                         @if(!is_null($attributions))
                        @foreach($attributions as $attribution)
                        <tr>
                            <td>{{$attribution->id}}</td>
                            <td>{{ str_replace("att","ATT",$attribution->code_attribution ) }}</td>
                            <td>{{$attribution->nom_attribution}}</td>
                   
                            <td style="color: #1761fd; font-weight:bold">{{$attribution->commissionAttributtion->nom_commission ?? ''}}</td>
                            <td>
                                <span class="badge {{$attribution->etatStatus($attribution->etat)->etat_color}} fs-8 fw-bolder">{{$attribution->etatStatus($attribution->etat)->status}}</span>
                            </td>

                            <td>
                                @if($attribution->document)
                                @foreach ($attribution->document as $key => $item)
                                    <a href="{{ asset('FichiersAttribution/'.$item->libelle )}}" target="_blank" rel="noopener noreferrer">
                                        <img src="{{ asset('assets/pdf.png') }}" target-="" title="{{ $item->libelle }}" alt="{{ $item->libelle }}" width="30">
                                    </a>
                                    @if($key == 2)
                                    <a class="mr-2 mt-4" href="#!" style="color:#03d87f"
                                        data-target="#modaldetailattribu_{{ $attribution->id }}" data-toggle="modal">
                                        Voir plus...
                                    </a>
                                    @break
                                    @endif
                                @endforeach
                            @endif
                            </td>

                            <td>{{ $attribution->created_at }} <br>
                                Ajouté par <span style="color: #1761fd ">{{$attribution->attributionuser->name ?? ''}}</span>
                            </td>
                        
                            <td>
                                <form id="form-{{$attribution->id}}" 
                                    action="{{ url('supprime/attribution', $attribution->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('DELETE')

                                    <a class="btn btn-sm btn-soft-success btn-circle mr-2" href="#!"
                                        data-target="#modaledit_{{ $attribution->id }}" data-toggle="modal"><i class="dripicons-pencil" title="Modifier l'attribution"></i>
                                    </a>
                                    <a class="btn btn-sm btn-soft-secondary btn-circle mr-2" href="#!"
                                        data-target="#modaldstatuts_{{ $attribution->id }}" data-toggle="modal">
                                        <i class="fas fa-redo" aria-hidden="true" title="Mettre à jour le statut"></i>
                                    </a>
                                    <a class="btn btn-sm btn-soft-primary btn-circle mr-2" href="#!"
                                        data-target="#modaldetailattribu_{{ $attribution->id }}" data-toggle="modal">
                                        <i class="fas fa-eye" aria-hidden="true" title="Détails"></i>
                                    </a>

                                    <a class="btn btn-sm btn-soft-success btn-circle mr-2" href="#!"
                                        data-target="#modalshowmembreattribu_{{ $attribution->id }}" data-toggle="modal">
                                        <i class="fas fa-eye" aria-hidden="true" title="Membres de l'attribution"></i>
                                    </a>
                                    <a  class="btn btn-sm btn-soft-primary btn-circle mr-2" href="#!"
                                        data-target="#modaldocs_{{ $attribution->id }}" data-toggle="modal">
                                        <i class="fas fa-upload" title="Ajouter un document"></i>
                                    </a> <br><br>
                                    <button class="btn btn-sm btn-soft-danger btn-circle mr-2" href=""><i
                                            class="dripicons-trash" title="Supprimer l'attribution" aria-hidden="true"></i>
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
    <!--modal ajout de document pour chaque commission-->
    @if(!is_null($attributions))
        @foreach($attributions as $attribution)
            <div class="modal fade" id="modaldstatuts_{{ $attribution->id }}" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalDefaultLogin" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <!--end modal-header-->
                        <div class="modal-body">
                            <div class="card-body p-0 auth-header-box">
                                <div class="text-center p-3">
                                    <h4 style="color: #1761fd;" class="mt-3 mb-1 font-weight-semibold font-18">
                                        Choisir le statut de la commission !</h4>
                                </div>
                            </div>
                            <div class="tab-content">
                                <div class="tab-pane active p-3 pt-3" id="LogIn_Tab" role="tabpanel">
                                    <form class="form-horizontal auth-form my-4" method="POST" 
                                        action="{{ url('update/etat', $attribution->id) }}"
                                        enctype="multipart/form-data">
                                        @csrf

                                        @method('PUT')
                                        <input type="hidden" name="_method" value="put">
                                        <!--end form-group-->
                                        
                                        <div class="form-group mb-2"><label for="etat">
                                            Sélectionnez le statut:</label>
                                            {{ (old('etat')) }}
                                            <select class="form-select form-control" name="etat"
                                                id="etat">
                                                <option value="">Veuillez Choisir le statut
                                                </option>
                                                @if(!is_null($etats))
                                                    @foreach($etats as $etat)
                                                        <option value="{{  $etat->id }}" 
                                                            @if((int) $attribution->etat == (int)$etat->id) selected
                                                            @endif>{{ $etat->status }}
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

 <!--modal de mise à jour-->
<section>
    <!--modal-->
    @if(!is_null($attributions))
        @foreach($attributions as $attribution)
            <div class="modal fade" id="modaledit_{{ $attribution->id }}" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalDefaultLogin" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <!--end modal-header-->
                        <div class="modal-body">
                            <div class="card-body p-0 auth-header-box">
                                <div class="text-center p-3">
                                    <h4 style="color: #1761fd; font-weight: blod" class="mt-3 mb-1 font-weight-semibold font-18">
                                        Mettre à jour l'attribution !</h4>
                                </div>
                            </div>
                        <div class="tab-content">
                            <div class="tab-pane active p-3 pt-3" id="LogIn_Tab" role="tabpanel">
                                <form class="form-horizontal auth-form my-4" method="POST"
                                action="{{ url('update/attribution', $attribution->id) }}" 
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="_method" value="put">

                                <!--end form-group-->
                                <div class="form-group mb-2">
                                    <label for="nom_attribution">Nom : </label>
                                    <div class="input-group mb-3"><input type="text"
                                            class="form-control" name="nom_attribution"
                                            id="nom_attribution"
                                            value="{{ $attribution->nom_attribution }}"
                                            placeholder="Saisissez le nom de l'attribution svp !">
                                    </div>
                                    @error('nom_attribution')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <!--end form-group-->

                                <div class="form-group mb-2">
                                    <label for="commission_id">Commission:</label>
                                    {{ (old('commission')) }}
                                    <select class="form-select form-control" name="commission_id"
                                        id="commission_id">
                                        <option value="Choisir la commission">Veuillez Choisir la commission de l'attribution
                                        </option>
                                        @if(!is_null($commissions))
                                            @foreach($commissions as $commission)
                                                <option value="{{ $commission->id }}"
                                                    @if((int) $attribution->commission_id == (int)$commission->id) selected @endif> {{ $commission->nom_commission}}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @error('commission_id')
                                     <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div> <br>

                                <div class="form-group mb-2">
                                    <label for="description_attribution">
                                        Description de l'attribution : </label>
                                    <div class="input-group mb-3">
                                        <textarea class="form-control" id="exampleFormControlTextarea1" name="description_attribution" rows="4" 
                                        placeholder="Saisissez la description ici svp !">{{ $attribution->description_attribution }} </textarea>
                                    </div>
                                    @error('description_attribution')
                                     <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div> <br>

                                <div class="form-group mb-0 row">
                                    <div class="col-12 mt-2"><button
                                            class="btn btn-primary btn-block waves-effect waves-light"
                                            type="submit">Mettre à jour<i class="fas fa-plus alt ml-1"></i></button>
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
 <!--fin modal de mise à jour-->

  <!--modal details-->
<section>
    @if(!is_null($attributions))
        @foreach($attributions as $attribution)
            <div class="modal fade" id="modaldetailattribu_{{ $attribution->id }}" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalDefaultLogin" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title m-0" id="myLargeModalLabel">Description de l'attribution</h6>
                    <button type="button" class="close" data-dismiss="modal"
                        aria-label="Close"><span aria-hidden="true"><i class="la la-times"></i></span></button>
                </div>
                <!--end modal-header-->
                <div class="modal-body">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6 align-self">
                                    <h3>Vous pouvez télécharger: <br><br>
                                        @if($attribution->document->count() > 0)
                                        @foreach ($attribution->document as $item)
                                            <a href="{{ asset('FichiersAttribution/'.$item->libelle )}}" target="_blank" rel="noopener noreferrer">
                                                <img src="{{ asset('assets/pdf.png') }}" target-="" title="{{ $item->libelle }}" alt="{{ $item->libelle }}" width="100">
                                            </a>
                                        @endforeach
                                    @endif
                                    </h3>
                                </div>
                                <div class="col-lg-6 align-self">
                                    <p  class="text-muted mb-0">Description:<br><br>{!!$attribution->description_attribution!!}<br></p>
                                </div>
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
    @endforeach
    @endif
</section>
  <!--fin modal details-->

<section>
    <!--modal ajout de document pour chaque commission-->
    @if(!is_null($attributions))
        @foreach($attributions as $attribution)
            <div class="modal fade" id="modaldocs_{{ $attribution->id }}" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalDefaultLogin" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <!--end modal-header-->
                        <div class="modal-body">
                            <div class="card-body p-0 auth-header-box">
                                <div class="text-center p-3">
                                    <h4 style="color: #1761fd;" class="mt-3 mb-1 font-weight-semibold font-18">
                                        Ajouter un document !</h4>
                                </div>
                            </div>
                            <div class="tab-content">
                                <div class="tab-pane active p-3 pt-3" id="LogIn_Tab" role="tabpanel">
                                    <form class="form-horizontal auth-form my-4" method="POST"
                                        action="{{ route('store.documents')}}" enctype="multipart/form-data">
                                        @csrf
                                                <!--end form-group-->
                                                <div class="form-group"><label for="libelle">
                                                    Charger le fichier :
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
                                                        <option value="">Veuillez sélectionner le type de document
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

                                                <div class="form-group mb-2">
                                                    <label for="attribution_id"></label>
                                                    <div class="input-group mb-3"><input type="hidden" 
                                                        value="{{ $attribution->id }}"
                                                            class="form-control" name="attribution_id" id="attribution_id">
                                                    </div>
                                                    @error('attribution_id')
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
                                <span class="text-muted d-none d-sm-inline-block">
                                    Planning N'zrama Festival © 2023
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
    @if(!is_null($attributions))
        @foreach($attributions as $attribution)
            <div class="modal fade" id="modalshowmembreattribu_{{ $attribution->id }}" tabindex="-1" role="dialog"
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
                                                Les membres de la commission assignés à l'attribution
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
                                                @if($attribution->commissionAttributtion)
                                                @if($attribution->commissionAttributtion->membre)
                                                @foreach($attribution->commissionAttributtion->membre as $membre)
                                                <tr>
                                                    <td style="width: 12px !important">{{$membre->id}}</td>
                                                    <td>{{$membre->code_membre}}</td>
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