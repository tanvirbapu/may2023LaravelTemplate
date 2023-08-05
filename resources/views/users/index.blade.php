<x-layout bodyClass="g-sidenav-show  bg-gray-200">
    <x-navbars.sidebar activePage="user-management"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="User Management"></x-navbars.navs.auth>
        <!-- End Navbar -->

        <main id="main" class="main">
            <div class="pagetitle">
                <h1>List</h1>
                <nav>
                    <ol class="breadcrumb">
                        <!-- <li class="breadcrumb-item"></li> -->
                        <!-- <li class="breadcrumb-item">Tables</li>
                        <li class="breadcrumb-item active">Data</li> -->
                    </ol>
                </nav>
            </div><!-- End Page Title -->

            <section class="section">
                <div class="row">
                    @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif

                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="button-container">
                                        <h5 class="card-title left-button">Users</h5>
                                        <a href="{{ route('user.create') }}" class="right-button"><button type="button"
                                                class="btn btn-primary">Add
                                                User</button></a>
                                    </div>
                                </div>
                                <p></p>

                                <!-- Table with stripped rows -->
                                <table class="table datatable">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Phone</th>
                                            <th scope="col">Registered Date</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $i= 1 @endphp
                                        @foreach($data as $values)
                                        <tr>
                                            <th scope="row">{{ $i }}</th>
                                            <td>{{ $values->name }}</td>
                                            <td>{{ $values->email }}</td>
                                            <td>{{ $values->phone }}</td>
                                            <td>{{ $values->created_at }}</td>

                                            <td>
                                                <div class="action-container">
                                                    <a href="{{ route('user.edit', $values->id) }}"><button
                                                            type="button"
                                                            class="btn btn-secondary btn-sm">Edit</button></a>
                                                    <form action="{{ route('user.destroy', $values->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            onclick="return confirm('Are you sure you want to delete this user?')"
                                                            class="btn btn-danger btn-sm">Delete</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                        @php $i++ @endphp
                                        @endforeach

                                    </tbody>
                                </table>
                                <!-- End Table with stripped rows -->

                            </div>
                        </div>

                    </div>
                </div>
            </section>
        </main><!-- End #main -->

    </main>
    <x-footers.auth></x-footers.auth>
</x-layout>