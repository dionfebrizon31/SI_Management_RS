<x-layout>
    <x-slot:tittle>{{ $tittle }}</x-slot>
    <section class="section main-section">
        @if (session('gagal'))
            <div class="notification red">
                <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0">
                    <div>
                        <span class="icon"><i class="mdi mdi-buffer"></i></span>
                        {{ session('gagal') }}
                    </div>
                    <button type="button" class="button small textual --jb-notification-dismiss">Dismiss</button>
                </div>
            </div>
        @endif

        @if (session('sukses'))
            <div class="notification green">
                <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0">
                    <div>
                        <span class="icon"><i class="mdi mdi-buffer"></i></span>
                        {{ session('sukses') }}
                    </div>
                    <button type="button" class="button small textual --jb-notification-dismiss">Dismiss</button>
                </div>
            </div>
        @endif
        <div class="card has-table">

            <section class="card-header">
                <p class="card-header-title">
                    <span class="icon"><i class="mdi mdi-account-multiple"></i></span>

                    {{ $tittle }}
                </p>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addpostingan">Add
                    Karywan</button>

                <x-modaldinamis id="addpostingan" tittle="Add Job Deskripsi" size="modal-lg">
                    <form action="/data/posts/tambah" method="post">
                        @csrf
                        <div class="field">
                            <label class="label">Public / Private</label>
                            <div class="field-body">
                                <div class="field">
                                    <label class="switch">
                                        <input type="checkbox" onclick="gantiTeks()" name="status" id="status"
                                            value="false">
                                        <span class="check"></span>
                                        <span class="control-label" id="mytext">Private</span>
                                    </label>
                                </div>
                            </div>
                        </div>



                        <x-formdinamis tittle="tittle" tipe="text" send="title"> </x-formdinamis>
                        <div class="mb-3 row">
                            <label for="deskripsi" class="col-sm-2 col-form-label">deskripsi</label>
                            <div class="col-sm-10">
                                <textarea name="deskripsi" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end gap-2">
                            <button type="submit" class="btn btn-success">
                                Submit
                            </button>
                            <button type="reset" class="btn btn-danger">
                                Reset
                            </button>
                        </div>
                    </form>
                </x-modaldinamis>

            </section>

            <div class="card-content">
                <table>
                    <thead>
                        <tr>
                            <th>judul</th>
                            <th>deskripsi</th>
                            <th>Status</th>
                            <th>Aksi</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($posts as $post)
                            <tr>

                                <td data-label="tittle">{{ Str::limit($post['title'], 20) }}</td>
                                <td data-label="text">{{ Str::limit($post['deskripsi'], 10) }}</td>
                                <td data-label="text">{{ $post['status'] }}</td>

                                <td class="actions-cell">
                                    <div class="buttons center nowrap">

                                        <button type="button" class="button small green" data-bs-toggle="modal"
                                            data-bs-target="#editpostingan{{ $post['id'] }}">
                                            <span class="icon"><i class="mdi mdi-pen"></i></span>
                                        </button>

                                        <button class="button small red " id="delete-record"
                                            data-id="{{ $post['id'] }}" data-urlsaya="/data/posts/delete">
                                            <span class="icon"><i class="mdi mdi-trash-can"></i></span>
                                        </button>

                                    </div>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </section>
    @foreach ($posts as $post)
        <x-modaldinamis id="editpostingan{{ $post['id'] }}" tittle="edit postingan" size="modal-lg">
            <form action="/data/posts/edit/{{ $post['id'] }}" method="post">
                @csrf
                <div class="field">
                    <label class="label">Public / Private</label>
                    <div class="field-body">
                        <div class="field">
                            <label class="switch">
                                <input type="checkbox" onclick="gantikanTeks({{ $post['id'] }})" name="status"
                                    id="status{{ $post['id'] }}" value="true"
                                    {{ $post['status'] == 'public' ? 'checked' : '' }}>
                                <span class="check"></span>
                                <span class="control-label"
                                    id="mytext{{ $post['id'] }}">{{ $post['status'] == 'public' ? 'Public' : 'Private' }}</span>
                            </label>
                        </div>
                    </div>
                </div>
                <x-formdinamis tittle="title" tipe="text" send="title" value="{{ $post['title'] }}">
                </x-formdinamis>
                <div class="mb-3 row">
                    <label for="deskripsi" class="col-sm-2 col-form-label">deskripsi</label>
                    <div class="col-sm-10">
                        <textarea name="deskripsi" class="form-control">{{ $post['deskripsi'] }}</textarea>
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <button type="submit" class="btn btn-success">
                        Submit
                    </button>
                    <button type="reset" class="btn btn-danger">
                        Reset
                    </button>
                </div>
            </form>
        </x-modaldinamis>
    @endforeach



</x-layout>
