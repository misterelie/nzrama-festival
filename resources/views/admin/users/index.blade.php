@extends('layouts.admin')
@section('content')

<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="row">
                <div class="col">
                    <h4 class="page-title">Utilisateurs</h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Tables</a></li>
                        <li class="breadcrumb-item active">Utilisateurs</li>
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
                    <p>Oups</p> Il y a eu des problèmes avec votre entrée.<br><br>
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <!--EN ERROR-->
        </div>
        <div class="card">
            <div class="card-header">
                <div class="card-body"><button type="button" class="btn btn-outline-primary" data-toggle="modal"
                        data-target="#exampleModalLogin">Ajouter un Utilisateur</button>
                    <!--modal-->
                    <div class="modal fade" id="exampleModalLogin" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalDefaultLogin" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <!--end modal-header-->
                                <div class="modal-body">
                                    <div class="card-body p-0 auth-header-box">
                                        <div class="text-center p-3">
                                            <h4 style="color: red" class="mt-3 mb-1 font-weight-semibold font-18">
                                                Veuillez remplir ces champs svp !</h4>
                                        </div>
                                    </div>
                                    <div class="tab-content">
                                        <div class="tab-pane active p-3 pt-3" id="LogIn_Tab" role="tabpanel">
                                            <form class="form-horizontal auth-form my-4" method="POST"
                                                action="{{ url('store/users') }}"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <!--end form-group-->
                                                <div class="form-group"><label for="name">Nom</label>
                                                    <div class="input-group mb-3"><input type="text"
                                                            class="form-control" name="name" id="name"
                                                            value="{{ old('name') }}"
                                                            placeholder="Saisir votre nom et prénoms svp !" required>
                                                    </div>
                                                    @error('name')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                 <!--end form-group-->
                                                 <div class="form-group"><label for="prenoms">Prénoms</label>
                                                    <div class="input-group mb-3"><input type="text"
                                                            class="form-control" name="prenoms" id="prenoms"
                                                            value="{{ old('prenoms') }}"
                                                            placeholder="Saisir votre prénoms svp !" required>
                                                    </div>
                                                    @error('prenoms')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="form-group"><label for="email">Email</label>
                                                    <div class="input-group mb-3"><input type="email"
                                                            class="form-control" name="email" id="email"
                                                            value="{{ old('email') }}"
                                                            placeholder="Saisir adresse email svp !" required>
                                                    </div>
                                                    @error('email')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="form-group"><label for="password">Mot de passe</label>
                                                    <div class="input-group mb-3"><input type="password"
                                                            class="form-control" name="password" id="password"
                                                            value="{{ old('password') }}"
                                                            placeholder="Saisir le mot de passe svp !" required>
                                                    </div>
                                                    @error('password')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="form-group"><label for="password_confirmation">Mot de
                                                        passe</label>
                                                    <div class="input-group mb-3"><input type="password"
                                                            class="form-control" name="password_confirmation"
                                                            id="password"
                                                            value="{{ old('password_confirmation') }}"
                                                            placeholder="Confirmez le mot de passe !" required>
                                                    </div>
                                                    @error('password_confirmation')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <!--end form-group-->
                                                <div class="form-group"><label for="profile_photo">Photo
                                                        <span style="color: red">(Ce champ n'est pas
                                                            obligatoire)</span></label>
                                                    <div class="custom-file"><input type="file"
                                                            value="{{ old('profile_photo') }}"
                                                            class="custom-file-input" id="validatedCustomFile"
                                                            name="profile_photo"><label class="custom-file-label"
                                                            for="validatedCustomFile">Ajouter une photo
                                                        </label>
                                                    </div>
                                                    @error('profile_photo')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <!--end form-group-->
                                                <div class="form-group mb-0 row">
                                                    <div class="col-12 mt-2"><button
                                                            class="btn btn-primary btn-block waves-effect waves-light"
                                                            type="submit">Enregistrer<i
                                                                class="fas fa-sign-in-alt ml-1"></i></button>
                                                    </div>
                                                    <!--end col-->
                                                </div>
                                                <!--end form-group-->
                                            </form>
                                        </div>
                                    </div>
                                    <!--end card-body-->
                                    <div class="card-body bg-light-alt text-center">
                                        <span class="text-muted d-none d-sm-inline-block">N'zrama Festival © 2023
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
            </div>
            <!--end card-header-->

            <div class="card-body">
                <table id="datatable" class="table table-bordered dt-responsive"
                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th>Photos</th>
                            <th>Noms</th>
                            <th>Prénoms</th>
                            <th>Email</th>
                            <th style="max-width: 120px !important">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(!is_null($utilisateurs))
                            @foreach($utilisateurs as $utilisateur)
                                <tr>
                                    <td scope="col">{{ $utilisateur->id }}</td>
                                    <td><img src="UsersPhoto/{{ $utilisateur->profile_photo }}"
                                        class="img-fluid rounded-circle" width="50px" height="50px">
                                    </td>
                                    <td>{{ $utilisateur->name }}</td>
                                    <th>{{ $utilisateur->prenoms }}</th>
                                    <td>{{ $utilisateur->email }}</td>
                                    <td>
                                        <form id="form-{{ $utilisateur->id }}"
                                            action="{{ route('delete.user', $utilisateur->id) }}"
                                            method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @method('DELETE')
                                            <a class="btn btn-sm btn-soft-primary btn-circle mr-2" href="#!"
                                                data-target="#modal_{{ $utilisateur->id }}" data-toggle="modal"><i
                                                    class="dripicons-pencil" title="modifier"
                                                    style="color: orange"></i></a>
                                            <button class="btn btn-sm btn-soft-danger btn-circle mr-2" href=""><i
                                                    class="dripicons-trash" title="supprimer" aria-hidden="true"></i>
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
    @if(!is_null($utilisateurs))
        @foreach($utilisateurs as $utilisateur)
            <div class="modal fade" id="modal_{{ $utilisateur->id }}" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalDefaultLogin" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <!--end modal-header-->
                        <div class="modal-body">
                            <div class="card-body p-0 auth-header-box">
                                <div class="text-center p-3">
                                    <h4 style="color: red" class="mt-3 mb-1 font-weight-semibold font-18">
                                        Mettre à jour quelques Informations !</h4>
                                </div>
                            </div>
                            <div class="tab-content">
                                <div class="tab-pane active p-3 pt-3" id="LogIn_Tab" role="tabpanel">
                                    <form class="form-horizontal auth-form my-4" method="POST" 
                                        action="{{ route('utilisateur.update', $utilisateur->id) }}"
                                        enctype="multipart/form-data">
                                        @csrf

                                        @method('PUT')
                                        <input type="hidden" name="_method" value="put">

                                        <div class="form-group"><label for="name">Nom</label>
                                            <div class="input-group mb-3"><input type="text"
                                                    class="form-control" name="name" id="name"
                                                    value="{{ $utilisateur->name }}"
                                                    placeholder="Veuillez mettre à jour votre nom !">
                                            </div>
                                            @error('name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group"><label for="prenoms">Prénoms</label>
                                            <div class="input-group mb-3"><input type="text"
                                                    class="form-control" name="prenoms" id="prenoms"
                                                    value="{{ $utilisateur->prenoms }}"
                                                    placeholder="Veuillez mettre à jour votre prénoms!">
                                            </div>
                                            @error('prenoms')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group"><label for="email">Email</label>
                                            <div class="input-group mb-3"><input type="email"
                                                    class="form-control" name="email" id="email"
                                                    value="{{ $utilisateur->email }}"
                                                    placeholder="Saisir adresse email svp !">
                                            </div>
                                            @error('email')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                         
                                         <div class="form-group"><label for="photo">Photos
                                                 <span style="color: red">
                                                    (Vous pouvez mettre à jour votre photo de profil
                                                     )</span>
                                                    </label>
                                             <div class="custom-file"><input type="file"
                                                     class="custom-file-input" id="validatedCustomFile"
                                                     name="profile_photo"><label class="custom-file-label"
                                                     for="validatedCustomFile">Changer la photo
                                                 </label> <br><br>
                                                 <img class="img-fluid rounded-circle" src="/UsersPhoto/{{ $utilisateur->profile_photo }}" width="100px" height="100px" 
                                                 style="100px"><br><br>
                                             </div> <br><br>
                                             @error('profile_photo')
                                                 <span class="text-danger">{{ $message }}</span>
                                             @enderror
                                         </div>
                                   
                                        <!--end form-group-->
                                        <div class="form-group mb-0 row">
                                            <div class="col-12 mt-2"><button
                                                    class="btn btn-primary btn-block waves-effect waves-light"
                                                    type="submit">Mettre à jour<i
                                                        class="fas fa-sign-in-alt ml-1"></i></button>
                                            </div>
                                            <!--end col-->
                                        </div>
                                        <!--end form-group-->
                                    </form>
                                </div>
                            </div>
                            <!--end card-body-->
                            <div class="card-body bg-light-alt text-center">
                                <span class="text-muted d-none d-sm-inline-block">N'Zrama Festival © 2023
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