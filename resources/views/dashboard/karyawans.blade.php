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

                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addkaryawan">Add
                    Karywan</button>

                <x-modaldinamis id="addkaryawan" tittle="Add karyawan" size="modal-lg">
                    <form action="/data/karyawans/tambah" method="post">
                        @csrf
                        <x-formdinamis tittle="email" tipe="email" send="email"> </x-formdinamis>
                        <x-formdinamis tittle="Nama" tipe="text" send="name"> </x-formdinamis>
                        <x-formdinamis tittle="username" tipe="text" send="username"> </x-formdinamis>
                        <x-formdinamis tittle="password" tipe="password" send="password"> </x-formdinamis>
                        <x-formdinamis tittle="Nomor Hp" tipe="text" send="nohp"> </x-formdinamis>
                        <x-formdinamis tittle="Alamat" tipe="text" send="alamat"> </x-formdinamis>
                        <div class="mb-3 row">
                            <label class="col-sm-2 col-form-label">Department</label>
                            <div class="col-sm-10 control select">
                                <select name="jabatans">
                                    <option value=""></option>
                                    @foreach ($jabatans as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        @props(['type' => 'hidden']);
                        <input type="hidden" name="role" value="karyawans">


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
                            <th class="checkbox-cell">
                                <label class="checkbox">
                                    <input type="checkbox">
                                    <span class="check"></span>
                                </label>
                            </th>
                            <th class="image-cell"></th>
                            <th>Nama Lengkap</th>
                            <th>Email</th>
                            <th>Username</th>
                            <th>Nomor</th>
                            <th>Alamat</th>
                            <th>Jabatan</th>
                            <th>Created</th>
                            <th>Aksi</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($karyawans as $item)
                            @if ($item['role'] == 'karyawans')
                                <tr>
                                    <td class="checkbox-cell">
                                        <label class="checkbox">
                                            <input type="checkbox">
                                            <span class="check"></span>
                                        </label>
                                    </td>
                                    <td class="image-cell">
                                        <div class="image">
                                            <img src="https://avatars.dicebear.com/v2/initials/rebecca-bauch.svg"
                                                class="rounded-full">
                                        </div>
                                    </td>
                                    <td data-label="namalengkap">{{ $item['name'] }}</td>
                                    <td data-label="email">{{ $item['email'] }}</td>
                                    <td data-label="username">{{ $item['username'] }}</td>
                                    <td data-label="Nohp">{{ $item['nomorhp'] }}</td>
                                    <td data-label="alamat">{{ $item['alamat'] }}</td>
                                    @if ($item->jabatan_id > -1)
                                        <td data-label="jabatans">--</td>
                                    @else
                                        <td data-label="jabatans">{{ $item->jabatans->name }}</td>
                                    @endif

                                    <td data-label="Created">
                                        <small class="text-gray-500"
                                            title="Oct 25, 2021">{{ $item['created_at'] }}</small>
                                    </td>
                                    <td class="actions-cell">
                                        <div class="buttons right nowrap">
                                            <a href="/karyawan/{{ $item->id }}" class="button small green">
                                                <span class="icon"><i class="mdi mdi-eye"></i></span>
                                            </a>
                                            <button type="button" class="button small green" data-bs-toggle="modal"
                                                data-bs-target="#editkaryawan{{ $item['id'] }}">
                                                <span class="icon"><i class="mdi mdi-pen"></i></span>
                                            </button>

                                            <button class="button small red " id="delete-record"
                                                data-id="{{ $item['id'] }}" data-urlsaya="data/karyawans/delete">
                                                <span class="icon"><i class="mdi mdi-trash-can"></i></span>
                                            </button>

                                        </div>
                                    </td>
                                </tr>
                            @endif
                        @endforeach

                    </tbody>
                </table>
                <div class="table-pagination">
                    <div class="flex items-center justify-between">
                        <div class="buttons">
                            <button type="button" class="button active">1</button>
                            <button type="button" class="button">2</button>
                            <button type="button" class="button">3</button>
                        </div>
                        <small>Page 1 of 3</small>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- area untuk pop up modal --}}
    @foreach ($karyawans as $item)
        <x-modaldinamis id="editkaryawan{{ $item['id'] }}" tittle="edit karyawan" size="modal-lg">
            <form action="/data/karyawans/edit/{{ $item['id'] }}" method="post">
                @csrf
                <x-formdinamis tittle="email" tipe="email" send="email" value="{{ $item['email'] }}">
                </x-formdinamis>
                <x-formdinamis tittle="Nama" tipe="text" send="name" value="{{ $item['name'] }}">
                </x-formdinamis>
                <x-formdinamis tittle="username" tipe="text" send="username" value="{{ $item['username'] }}">
                </x-formdinamis>
                <x-formdinamis tittle="Nomor Hp" tipe="text" send="nohp" value="{{ $item['nomorhp'] }}">
                </x-formdinamis>
                <x-formdinamis tittle="Alamat" tipe="text" send="alamat" value="{{ $item['alamat'] }}">
                </x-formdinamis>
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Department</label>
                    <div class="col-sm-10 control select">
                        <select name="jabatans">
                            @foreach ($jabatans as $items)
                                <option value="{{ $items->id }}"
                                    {{ $items->id == $item->jabatans_id ? 'selected' : '' }}>
                                    {{ $items->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <input type="hidden" name="role" value="karyawans">


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
