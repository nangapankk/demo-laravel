@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        {{ __('Manajemen User') }}
                    </div>

                    <div class="card-body">

                        {{--Untuk menampilkan pesan--}}
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success">
                                {{ $message }}
                            </div>
                        @endif

                        @if ($message = Session::get('unsuccess'))
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                        @endif
                        {{--End Untuk menampilkan pesan--}}

                        {{--Untuk menampilkan data--}}
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr class="text-center">
                                <th>No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $no => $user)
                                <tr>
                                    <td class="text-center">
                                        {{ $no+=1 }}
                                    </td>
                                    <td>
                                        {{ $user->name }}
                                    </td>
                                    <td>
                                        {{ $user->email }}
                                    </td>
                                    <td class="text-center">
                                        <form action="{{ route('users.destroy',$user->id) }}" method="POST">
                                            <a class="btn btn-dark" href="{{ route('users.show',$user->id) }}">Detail</a>
                                            <a class="btn btn-primary" href="{{ route('users.edit',$user->id) }}">Edit</a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{--End Untuk menampilkan data--}}

                        {{--Untuk Paginate data--}}
                        {!! $users->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
