@extends('layouts.admin')
@section('content')

<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="row">
                <div class="col">
                    <h4 class="page-title">Liste des membres</h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Tables</a></li>
                        <li class="breadcrumb-item active">Membres</li>
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
                        data-target="#exampleModalLarge">AJOUTER UN MEMBRE</button>
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
                                                Ajouter un membre !</h4>
                                        </div>
                                    </div>
                                    <div class="tab-content">
                                        <div class="tab-pane active p-3 pt-3" id="LogIn_Tab" role="tabpanel">
                                            <form class="form-horizontal auth-form my-4" method="POST" 
                                                action="{{ route('save_membres') }}"
                                                enctype="multipart/form-data">
                                                @csrf

                                                <!--end form-group-->
                                                <div class="form-group mb-2">
                                                    <label for="civilite">Civilité :</label>
                                                    {{ (old('civilite')) }}
                                                    <select class="form-select form-control" name="civilite"
                                                        id="civilite">
                                                        <option>----Sélectionnez votre civilité---</option>
                                                        <option value="Monsieur">M</option>
                                                        <option value="Madame">Mme</option>
                                                        <option value="Mademoiselle">Mlle</option>
                                                    </select>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="form-group mb-2">
                                                            <label for="nom_membre">Nom : </label>
                                                            <div class="input-group mb-3"><input type="text"
                                                                    class="form-control {{ $errors->has('nom_membre') ? 'error' : '' }} border rounded-2xl" name="nom_membre"
                                                                    id="nom_membre"
                                                                    placeholder="Saisissez votre nom svp !" required="">
                                                            </div>
                                                            @if ($errors->has('nom_membre'))
                                                            <div class="error">
                                                                <span class="text-danger"> {{ $errors->first('nom_membre') }}</span>
                                                            </div>
                                                            @endif
                                
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6">
                                                        <div class="form-group mb-2">
                                                            <label for="prenoms">Prénoms : </label>
                                                            <div class="input-group mb-3"><input type="text"
                                                                    class="form-control {{ $errors->has('prenoms') ? 'error' : ''}}" name="prenoms" id="prenoms"
                                                                    value="{{ old('prenoms') }}"
                                                                    placeholder="Saisissez votre prénoms svp !" required="">
                                                                   
                                                            </div>
                                                            @if($errors->has('prenoms'))
                                                            <div class="error">
                                                                <span class="text-danger">{{ $errors->first('prenoms') }}</span>
                                                            </div>
                                                            @endif
                                                            {{-- @error('prenoms')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror --}}
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--end form-group-->
                                            
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="form-group mb-2">
                                                            <label for="telephone">Numéro de téléphone : </label>
                                                            <div class="input-group mb-3"><input type="number"
                                                                    class="form-control {{ $errors->has('telephone') ? 'error' : '' }}" name="telephone" id="telephone"
                                                                    placeholder="EX:0102054870" required="">
                                                            </div>
                                                            @if ($errors->has('telephone'))
                                                            <div class="error">
                                                                <span class="text-danger">{{ $errors->first('telephone') }}</span>
                                                            </div>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6">
                                                        <div class="form-group mb-2">
                                                            <label for="num_whatsapp">Numéro whatsapp : 
                                                            </label>
                                                            <div class="input-group mb-3"><input type="number"
                                                                    class="form-control" name="num_whatsapp" id="num_whatsapp"
                                                                    value="{{ old('num_whatsapp') }}"
                                                                    placeholder="Saisissez votre whatsapp ">
                                                            </div>
                                                            {{-- @error('num_whatsapp')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror --}}
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group mb-2">
                                                    <label for="email">Email : </label>
                                                    <div class="input-group mb-3"><input type="email"
                                                            class="form-control {{ $errors->has('email') ? 'error' : ''}}" name="email" id="email	"
                                                            placeholder="Saisissez votre email svp !" required="">
                                                    </div>
                                                    @if ($errors->has('email'))
                                                        <div class="error">
                                                            <span class="text-danger">{{ $errors->first('email') }}</span>
                                                        </div>
                                                    @endif
                                                </div>
                                             
                                                 <!--end form-group-->
                                                 <div class="form-group mb-2">
                                                    <label for="specicite_fonction_membre">
                                                        Spécificité de la fonction : 

                                                    </label>
                                                    <div class="input-group mb-3"><input type="text"
                                                            class="form-control" name="specicite_fonction_membre"
                                                            id="specicite_fonction_membre"
                                                            value="{{ old('specicite_fonction_membre') }}"
                                                            required=""
                                                            placeholder="Veuillez saisir votre spécificité">
                                                    </div>
                                                    @error('specicite_fonction_membre')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <!--end form-group-->

                                                <div class="form-group mb-2">
                                                    <label for="categorie_id">Catégorie du membre:</label>
                                                    {{ (old('categorie')) }}
                                                    <select class="form-select form-control" name="categorie_id"
                                                        id="categorie_id">
                                                        <option value="">Veuillez Choisir la catégorie
                                                        </option>
                                                        @if(!is_null($categoriemembres))
                                                            @foreach($categoriemembres as $categoriemembre)
                                                                <option value="{{ $categoriemembre->id }}"
                                                                    {{ !is_null(old("categorie")) ? 'selected' : '' }}>
                                                                    {{ Str::ucfirst($categoriemembre->libelle_categorie) }}
                                                                </option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                    @error('categorie_id')
                                                     <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="form-group mb-2">
                                                    <label for="commission_id">Commission:</label>
                                                    {{ (old('commission')) }}
                                                    <select class="form-select form-control" name="commission_id"
                                                        id="commission_id">
                                                        <option value="Choisir la commission">Veuillez Choisir la commission du membre
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
                                                </div>
                                        </div>
                                        <!--end form-group-->
                                        <div class="form-group mb-0 row">
                                            <div class="col-12 mt-2"><button class="btn btn-primary btn-block waves-effect waves-light" type="submit">Ajouter<i class="fas fa-plus  ml-1"></i></button>
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
                            <th scope="col">N°</th>
                            <th>Codes</th>
                            <th>Noms</th>
                            <th>Prénoms</th>
                            <th>Téléphones</th>
                            <th>Commissions</th>
                            <th>Catégories</th>
                            <th>Dates de création</th>
                            <th style="max-width: 200px !important">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(!is_null($membres))
                        @foreach($membres as $membre)
                        <tr>
                            <td style="width: 12px !important">{{$membre->id}}</td>
                            {{-- <td scope="row">{{ $loop->iteration }}</th> --}}
                            <td>{{ str_replace("mem","MEM",$membre->code_membre ) }}</td>
                            <td>{{$membre->nom_membre}}</td>
                            <td>{{$membre->prenoms}}</td>
                            <td>{{$membre->telephone}}</td>
                            <td style="color:#f5325c">{{$membre->commission->nom_commission ?? ''}}</td>
                            <td style="color:#03d87f">{{$membre->categorie->libelle_categorie}}</td>
                            <td>{{ $membre->created_at }} <br>
                                Ajouté par <span style="color: #1761fd ">{{ $membre->user->name ?? '' }}</span>
                            </td>
                            <td>
                                <form id="form-{{$membre->id}}"
                                    action="{{ route('supprime_membre', $membre->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('DELETE')

                                    <a class="btn btn-sm btn-soft-success btn-circle mr-2" href="#!"
                                        data-target="#modaledit_{{$membre->id}}" data-toggle="modal"><i class="dripicons-pencil"
                                            title="Modifier le membre"></i>
                                    </a>
                                    <a class="btn btn-sm btn-soft-secondary btn-circle mr-2" href="#!"
                                        data-target="#modaldetailmembre_{{ $membre->id }}" data-toggle="modal">
                                        <i class="fa fa-eye" title="Détails membre"></i>
                                    </a>

                                    <a class="btn btn-sm btn-soft-primary btn-circle mr-2" href="#!"
                                    data-target="#modalshowattribucommission_{{ $membre->id }}" data-toggle="modal">
                                    <i class="fa fa-eye" title="Voir les attributions assignées"></i>
                                    </a>

                                    <a class="btn btn-sm btn-soft-success btn-circle mr-2" href="#!"
                                    data-target="#modalshowtaskmembre_{{ $membre->id }}" data-toggle="modal">
                                    <i class="fas fa-tasks" title="Liste des taches assignées"></i>
                                    </a>
                                    
                                    <button class="btn btn-sm btn-soft-danger btn-circle mr-2" href=""><i
                                            class="dripicons-trash" title="Supprimer le membre" aria-hidden="true"></i>
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


 <!--modal de mise à jour-->
<section>
    <!--modal-->
    @if(!is_null($membres))
        @foreach($membres as $membre)
            <div class="modal fade" id="modaledit_{{ $membre->id }}" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalDefaultLogin" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <!--end modal-header-->
                        <div class="modal-body">
                            <div class="card-body p-0 auth-header-box">
                                <div class="text-center p-3">
                                    <h4 style="color: #1761fd; font-weight: blod" class="mt-3 mb-1 font-weight-semibold font-18">
                                        Mettre à jour les informations !</h4>
                                </div>
                            </div>
                            <div class="tab-content">
                                <div class="tab-pane active p-3 pt-3" id="LogIn_Tab" role="tabpanel">
                                    <form class="form-horizontal auth-form my-4" method="POST" 
                                        action="{{ route('update.membre', $membre->id) }}"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="_method" value="put">
                
                                        <!--end form-group-->
                                        <div class="form-group mb-2">
                                            <label for="civilite">Civilité :</label>
                                            {{ (old('civilite')) }}
                                            <select class="form-select form-control" name="civilite"
                                                id="civilite">
                                                <option>----Sélectionnez votre civilité---</option>
                                                <option value="Monsieur" {{ $membre->civilite == 'Monsieur' ? 'selected' : '' }}>M</option>
                                                <option value="Madame" {{ $membre->civilite == 'Madame' ? 'selected' : '' }}>Mme</option>
                                                <option value="Mademoiselle" {{ $membre->civilite == 'Mademoiselle' ? 'selected' : '' }}>Mlle</option>
                                            </select>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group mb-2">
                                                    <label for="nom_membre">Nom : </label>
                                                    <div class="input-group mb-3"><input type="text"
                                                            class="form-control" name="nom_membre"
                                                            id="nom_membre" 
                                                            value="{{ $membre->nom_membre }}"
                                                            value="{{ old('nom_membre') }}"
                                                            placeholder="Saisissez votre nom svp !">
                                                    </div>
                                                    @error('nom_membre')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group mb-2">
                                                    <label for="prenoms">Prénoms : </label>
                                                    <div class="input-group mb-3"><input type="text"
                                                            class="form-control" name="prenoms" id="prenoms"
                                                            value="{{ $membre->prenoms }}"
                                                            value="{{ old('prenoms') }}"
                                                            placeholder="Saisissez votre prénoms svp !">
                                                    </div>
                                                    @error('prenoms')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <!--end form-group-->
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group mb-2">
                                                    <label for="email">Email : </label>
                                                    <div class="input-group mb-3"><input type="email"
                                                            class="form-control" name="email" id="email"
                                                            value="{{ $membre->email }}"
                                                            placeholder="Saisissez votre email svp !">
                                                    </div>
                                                    @error('email	')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group mb-2">
                                                    <label for="num_whatsapp">
                                                        Numéro whatsapp : </label>
                                                    <div class="input-group mb-3"><input type="number"
                                                            class="form-control" name="num_whatsapp"
                                                            id="num_whatsapp"
                                                            value="{{$membre->num_whatsapp }}"
                                                            placeholder="Saisissez votre whatsapp ">
                                                    </div>
                                                    @error('num_whatsapp')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group mb-2">
                                            <label for="telephone">Numéro de téléphone : </label>
                                            <div class="input-group mb-3"><input type="number" class="form-control"
                                                    name="telephone" id="telephone" value="{{ $membre->telephone }}"
                                                    placeholder="Saisissez numéro svp !">
                                            </div>
                                            @error('telephone')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>


                                         <!--end form-group-->
                                         <div class="form-group mb-2">
                                            <label for="specicite_fonction_membre">
                                                Spécificité de la fonction : 
                                            </label>
                                            <div class="input-group mb-3"><input type="text"
                                                    class="form-control" name="specicite_fonction_membre"
                                                    id="specicite_fonction_membre"
                                                    value="{{ $membre->specicite_fonction_membre }}"
                                                  
                                                    placeholder="Veuillez saisir votre spécificité">
                                            </div>
                                            @error('specicite_fonction_membre')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <!--end form-group-->

                                        <div class="form-group mb-2">
                                            <label for="categorie_id">Catégorie du membre:</label>
                                            {{ (old('categorie')) }}
                                            <select class="form-select form-control" name="categorie_id"
                                                id="categorie_id">
                                                <option>Veuillez Choisir la catégorie
                                                </option>
                                                @if(!is_null($categoriemembres))
                                                @foreach($categoriemembres as $categoriemembre)
                                                    <option value="{{  $categoriemembre->id }}" 
                                                        @if((int) $membre->categorie_id == (int)$categoriemembre->id ) selected
                                                        @endif>{{ $categoriemembre->libelle_categorie }}
                                                    </option>
                                                @endforeach
                                                @endif
                                            </select>
                                            @error('categorie_id')
                                             <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group mb-2">
                                            <label for="commission_id">Commission:</label>
                                            {{ (old('commission')) }}
                                            <select class="form-select form-control" name="commission_id"
                                                id="commission_id">
                                                <option value="Choisir la commission">Veuillez Choisir la commission du membre
                                                </option>
                                                @if(!is_null($commissions))
                                                    @foreach($commissions as $commission)
                                                        <option value="{{ $commission->id }}"
                                                            @if((int) $membre->commission_id == (int)$commission->id) selected @endif> {{ $commission->nom_commission}}
                                                        </option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            @error('commission_id')
                                             <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                </div>
                                <!--end form-group-->
                                <div class="form-group mb-0 row">
                                    <div class="col-12 mt-2"><button class="btn btn-primary btn-block waves-effect waves-light" type="submit">Mettre à jour
                                        <i class="fas fa-refresh  ml-1" aria-hidden="true"></i></button>
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
    @if(!is_null($membres))
        @foreach($membres as $membre)
            <div class="modal fade" id="modaldetailmembre_{{ $membre->id }}" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalDefaultLogin" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title m-0" id="myLargeModalLabel">Quelques Détails</h6>
                    <button type="button" class="close" data-dismiss="modal"
                        aria-label="Close"><span aria-hidden="true"><i class="la la-times"></i></span></button>
                </div>
                <!--end modal-header-->
                <div class="modal-body">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6 align-self">
                                    <h3>Avatar:<br>{{$membre->civilite}}<br><br></h3>
                                </div>
                                <!--end col-->
                                <div class="col-lg-6 align-self-center">
                                    <div class="single-pro-detail">
                                        <p style="color:#1761fd" class="mb-1">Informations</p>
                                        <div class="custom-border mb-3"></div>
                                        <h3 class="pro-title">Nom & Prénoms:  {{$membre->nom_membre}} {{$membre->prenoms}}</h3>
                                        <p class="text-muted mb-0">Cagtégorie: {{$membre->categorie->libelle_categorie}}</p>
                                        <p class="text-muted mb-0">Email:  {{$membre->email}}</p>
                                        <p class="text-muted mb-0">Spécificité: {{$membre->specicite_fonction_membre}}</p>
                                        <p class="text-muted mb-0">Numéro whatsapp: {{$membre->num_whatsapp}}</p>
                                      
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
  <!--fin modal details-->

  <!--Visualiser la liste des attributions de la commission assignées au membre-->
<section>
    @if(!is_null($membres))
        @foreach($membres as $membre)
            <div class="modal fade" id="modalshowattribucommission_{{ $membre->id }}" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalDefaultLogin" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title m-0" id="myLargeModalLabel">{{ $membre->nom_membre}} {{ $membre->prenoms}}</h6>
                    <button type="button" class="close" data-dismiss="modal"
                        aria-label="Close"><span aria-hidden="true"><i class="la la-times"></i></span></button>
                </div>
                <!--end modal-header-->
                <div class="modal-body">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6 align-self-center">
                                    <div class="single-pro-detail">
                                        <p style="color:#1761fd" class="mb-1">
                                            La liste des attributions de la commission assignées au membre</p>
                                        <div class="custom-border mb-3"></div>
                                        {{-- <h3 class="pro-title">Auteur: {{ $commission->user->name ?? '' }}</h3> --}}
                                        </p>
                                        @if($membre->commission)
                                        @if($membre->commission->attribution)
                                        <p class="text-muted mb-0">Code: 
                                            <b>
                                                {{$membre->commission->attribution[0]->code_attribution ?? ''}}
                                            </b>
                                        </p><br>
                                        <p class="text-muted mb-0">Nom attribution: 
                                            <b>
                                                {{ $membre->commission->attribution[0]->nom_attribution ?? ''}}
                                            </b>
                                        </p><br>

                                        <p class="text-muted mb-0">Commission: 
                                            <b>
                                                {{ $membre->commission->nom_commission}}
                                            </b>
                                        </p><br>

                                        <p class="text-muted mb-0">Description attribution: <b><br>
                                            {!!$membre->commission->attribution[0]->description_attribution ?? ''!!}
                                        </b><br><br>
                                        @endif
                                        @endif
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

 <!--Visualiser la liste des tâches assignées au membre-->
 <section>
    @if(!is_null($membres))
        @foreach($membres as $membre)
            <div class="modal fade" id="modalshowtaskmembre_{{ $membre->id }}" tabindex="-1" role="dialog"
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
                                                La liste des tâches assignées au membre
                                            </p><br>
    
                                            <table class="table table-bordered dt-responsive mx-50"
                                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th scope="col">N° tâches</th>
                                                    <th>Codes</th>
                                                    <th>Tâches</th>
                                                    <th>Attributions</th>
                                                    <th>Commissions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if($membre->commission)
                                                @if($membre->commission->attribution)
                                                @foreach($membre->commission->attribution as $attribution)
                                                @if($attribution->tache)
                                                @foreach($attribution->tache as $tache)
                                                <tr>
                                                    <td style="width: 12px !important">{{$tache->id}}</td>
                                                    <td>{{ str_replace('tach', 'TACH', $tache->code_tache) }}</td>
                                                    <td>{{$tache->nom_tache}}</td>
                                                    <td>{{$tache->attribution->nom_attribution}}</td>
                                                    <td>{{$membre->commission->nom_commission}}</td>
                                                </tr>
                                                @endforeach
                                                @endif
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
@yield('js')
