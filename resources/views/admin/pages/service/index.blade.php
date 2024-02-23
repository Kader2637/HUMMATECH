@extends('admin.layouts.app')

@section('subcontent')
    <div class=" p-1">
        <div class="card border-0 shadow p-3 mt-3">
            <div class="row">
                <div class="col-12 col-lg-6">
                    <h4 class="m-2">Layanan</h4>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="d-flex justify-content-lg-end justify-content-start">
                        <div class="d-flex align-items-center gap-2">
                            <p class="m-0 me-2">Cari:</p>
                            <input class="form-control me-2" type="text" placeholder="Cari sesuatu&hellip;"
                                aria-label="Cari sesuatu&hellip;" />
                        </div>
                        @include('admin.pages.service.create')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        @forelse ($services as $service)
        <div class="col-xxl-3 col-md-4 col-sm-6">
            <div class="card border-0 shadow rounded">
                <img src="{{ asset('storage/' . $service->image) }}" alt="Milink" class="rounded-top card-img-thumbnail" />
                <div class="card-header text-center h4 border-bottom"
                    style="margin-top: -1rem; border-radius: var(--bs-border-radius) var(--bs-border-radius) 0 0 !important;">
                    {{ $service->name }}</div>
                <div class="card-body">
                    <p>{{ Str::limit($service->description, 80) }}</p>

                    <div class="gap-2 d-flex">
                        <div class="d-grid flex-grow-1">
                            <a href="detail/service/{{ $service->id }}" class="btn btn-primary">Lihat Detail</a>
                        </div>
                        <div class="d-flex flex-shrink-0 gap-2">
                            <button class="btn btn-warning px-3 m-0 btn-edit"  type="button" data-id="{{ $service->id }}" data-name="{{ $service->name }}" data-description="{{ $service->description }}" data-link="{{ $service->link }}" data-image="{{ $service->image }}"><i class="fas fa-pencil"></i></button>
                            <button class="btn px-3 btn-danger" type="button"><i class="fas fa-trash"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @empty
            <div class="d-flex justify-content-center">
                <img src="{{ asset('assets/images/no-data.png') }}" alt="" width="400px">
            </div>
            <h5 class="text-center">
                Data Masih Kosong
            </h5>
        @endforelse
    </div>

    <nav class="mt-5" aria-label="Page navigation example">
        <ul class="pagination justify-content-center pagin-border-primary pagination-primary">
            <li class="page-item"><a class="page-link" href="javascript:void(0)">Previous</a></li>
            <li class="page-item"><a class="page-link" href="javascript:void(0)">1</a></li>
            <li class="page-item"><a class="page-link" href="javascript:void(0)">2</a></li>
            <li class="page-item"><a class="page-link" href="javascript:void(0)">3</a></li>
            <li class="page-item"><a class="page-link" href="javascript:void(0)">Next</a></li>
        </ul>
    </nav>


    <div class="modal fade modal-bookmark edit" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-semibold" id="exampleModalLabel">Edit Produk</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="form-bookmark needs-validation" method="POST" id="form-update" novalidate=""
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="row g-2">
                        <div class="form-group mb-3 mt-0 col-md-12">
                            <label for="image">Foto Layanan</label><br>
                            <img class="image-show mb-3" height="200px" class="mb-2">
                            <input class="form-control image-edit" id="image" type="file" name="image" required  />
                        </div>
                        <div class="form-group mb-3 mt-0 col-md-12">
                            <label for="name">Nama Layanan</label>
                            <input class="form-control name-edit" id="name" name="name" type="text" required placeholder="Masukkan nama layanan" />
                        </div>
                        <div class="form-group mb-3 mt-0 col-md-12">
                            <label for="description">Deskripsi Layanan</label>
                            <textarea rows="5" class="form-control description-edit" id="description" name="description" placeholder="Masukkan deskripsi layanan"></textarea>
                        </div>
                        <div class="form-group mb-3 mt-0 col-md-12">
                            <label for="link">Tautan Layanan <small class="text-danger">*Isi jika ada</small></label>
                            <input class="form-control link-edit" id="link" name="link" type="text" required placeholder="Masukkan tautan layanan" />
                        </div>
                        <div class="form-group mb-3 mt-0 col-md-12">
                            <label for="proposal">File Proposal <small>(opsional)</small></label>
                            <input class="form-control" id="proposal" name="proposal" type="file" required placeholder="Contoh: https://hummatech.com/linknya" />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="d-flex justify-content-end">
                        <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Batalkan</button>
                        <button class="btn btn-primary" type="submit">Perbaharui</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@include('admin.components.delete-modal-component')
@endsection
@section('script')
<script>
    $('.btn-edit').on('click', function() {
        var id = $(this).data('id');
        var image = $(this).data('image');
        var name = $(this).data('name');
        var description = $(this).data('description');
        var link = $(this).data('link');
        $('#form-update').attr('action', '/update/service/' + id);
        $('.name-edit').val(name);
        $('.description-edit').val(description);
        $('.link-edit').val(link);
        $('.image-show').attr('src', 'storage/' + image);
        $('.edit').modal('show');
    });

    $('.btn-delete').on('click', function() {
        var id = $(this).data('id');
        $('#form-delete').attr('action', '/service/' + id);
        $('#modal-delete').modal('show');
    });
</script>
@endsection