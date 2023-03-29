@extends('layouts.admin')
@section('content')

<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="row">
                <div class="col">
                    <h4 class="page-title">Liste des Catégories</h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Tables</a></li>
                        <li class="breadcrumb-item active">Catégorie</li>
                    </ol>
                </div>
                <!--end col-->
                {{-- <div class="col-auto align-self-center"><a href="#" class="btn btn-sm btn-outline-primary"
                        id="Dash_Date"><span class="day-name" id="Day_Name">Today:</span>&nbsp; <span class=""
                            id="Select_date">Jan
                            11</span> <i data-feather="calendar" class="align-self-center icon-xs ml-1"></i> </a><a
                        href="#" class="btn btn-sm btn-outline-primary"><i data-feather="download"
                            class="align-self-center icon-xs"></i></a></div> --}}
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
                        data-target="#exampleModalLogin">Ajouter une Catégorie</button>
                    <!--modal-->
                    <div class="modal fade" id="exampleModalLogin" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalDefaultLogin" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <!--end modal-header-->
                                <div class="modal-body">
                                    <div class="card-body p-0 auth-header-box">
                                        <div class="text-center p-3">
                                            <h4 style="color: #1761fd; font-size: 12px" class="mt-3 mb-1 font-weight-semibold font-18">
                                                Ajouter une Catégorie !</h4>
                                        </div>
                                    </div>

                                    <div class="tab-content">
                                        <div class="tab-pane active p-3 pt-3" id="LogIn_Tab" role="tabpanel">
                                            <form class="form-horizontal auth-form my-4" method="POST"
                                                action="{{ route('store.categorie_membre')}}" enctype="multipart/form-data">
                                                @csrf

                                                <!--end form-group-->
                                                <div class="form-group mb-2">
                                                    <label for="nom_commission">Catégorie : </label>
                                                    <div class="input-group mb-3"><input type="text"
                                                            class="form-control" name="libelle_categorie"
                                                            id="libelle_categorie" required=""
                                                            value="{{ old('libelle_categorie') }}"
                                                            placeholder="Saisissez la catégorie svp !">
                                                    </div>
                                                    @error('libelle_categorie')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <!--end form-group-->
                                        </div>
                                        <!--end form-group-->
                                        <div class="form-group mb-0 row">
                                            <div class="col-12 mt-2"><button
                                                    class="btn btn-primary btn-block waves-effect waves-light"
                                                    type="submit">Ajouter<i class="fas fa-sign-in-alt ml-1"></i></button>
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
                            <th>Catégories</th>
                            <th>Date de création</th>
                            <th style="max-width: 120px !important">Action</th>
                        </tr>
                    </thead>
                  <tbody>
                        @if(!is_null($categoriemembres))
                        @foreach($categoriemembres as $categoriemembre)
                        <tr>
                            <td scope="col">{{ $categoriemembre->id}}</td>
                            <td>{{ $categoriemembre->libelle_categorie }}</td>
                            <td>{{ $categoriemembre->created_at }}</td>
                            <td>
                                <form id="form-{{ $categoriemembre->id }}"
                                    action="{{ route('delete.categorie', $categoriemembre->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('DELETE')

                                    <a class="btn btn-sm btn-soft-success btn-circle mr-2" href="#!"
                                        data-target="#modalcategorie_{{ $categoriemembre->id }}" data-toggle="modal"><i class="dripicons-pencil"
                                            title="Modifier la catégorie"></i>
                                    </a>
                                    <button class="btn btn-sm btn-soft-danger btn-circle mr-2" href=""><i
                                            class="dripicons-trash" title="Supprimer" aria-hidden="true"></i>
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
    <!--modal-->
    @if(!is_null($categoriemembres))
        @foreach($categoriemembres as $categoriemembre)
            <div class="modal fade" id="modalcategorie_{{ $categoriemembre->id }}" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalDefaultLogin" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <!--end modal-header-->
                        <div class="modal-body">
                            <div class="card-body p-0 auth-header-box">
                                <div class="text-center p-3">
                                    <h4 style="color: #1761fd; font-weight: blod" class="mt-3 mb-1 font-weight-semibold font-18">
                                        Mettre à jour la catégorie !</h4>
                                </div>
                            </div>
                            <div class="tab-content">
                                <div class="tab-pane active p-3 pt-3" id="LogIn_Tab" role="tabpanel">
                                    <form class="form-horizontal auth-form my-4" method="POST"
                                        action="{{ route('update.categorie_membre', $categoriemembre->id)}}" enctype="multipart/form-data">
                                        @csrf

                                        @method('PUT')
                                        <input type="hidden" name="_method" value="put">
                                        <!--end form-group-->
                                        <div class="form-group mb-2">
                                            <label for="nom_commission">Catégorie : </label>
                                            <div class="input-group mb-3"><input type="text"
                                                    class="form-control" name="libelle_categorie"
                                                    id="libelle_categorie" 
                                                    value="{{ $categoriemembre->libelle_categorie }}"
                                                    value="{{ old('libelle_categorie') }}"
                                                    placeholder="Mettre à jour la catégorie !">
                                            </div>
                                            @error('libelle_categorie')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <!--end form-group-->
                                               
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

@endsection