<x-layout bodyClass="g-sidenav-show  bg-gray-200">
    <x-navbars.sidebar activePage="CRUD-management"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="CRUD Management"></x-navbars.navs.auth>
        <!-- End Navbar -->

        <main id="main" class="main">
            <div class="pagetitle">
                <h1>Data List</h1>
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
                                        <h5 class="card-title left-button">CRUD</h5>
                                        <a href="{{ route('crud.create') }}" class="right-button"><button type="button"
                                                class="btn btn-primary">Add
                                                Data</button></a>
                                    </div>
                                </div>
                                <p></p>

                                <!-- Table with stripped rows -->
                                <table class="table datatable">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Textbox</th>
                                            <th scope="col">Radiobutton</th>
                                            <th scope="col">Image</th>
                                            <th scope="col">Video</th>
                                            <th scope="col">Toggle</th>
                                            <th scope="col">Date</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $i= 1 @endphp
                                        @foreach($data as $values)
                                        <tr>
                                            <th scope="row">{{ $i }}</th>
                                            <td>{{ $values->textbox }}</td>
                                            <td>{{ $values->radiobutton }}</td>
                                            <td>
                                                <a href="{{ URL::to('/')}}{{ $values->image }}" target="_blank">Click
                                                    Here</a>
                                            </td>
                                            <td>
                                                <a href="{{ URL::to('/')}}{{ $values->video }}" target="_blank">Click
                                                    Here</a>
                                            </td>
                                            <td>{{ $values->toggle }}</td>
                                            <td>{{ $values->date }}</td>
                                            <td>
                                                <div class="action-container">
                                                    <!-- {{ route('user.edit', $values->id) }} -->
                                                    <a href="{{ route('crud.edit', $values->id) }}"><button
                                                            type="button"
                                                            class="btn btn-secondary btn-sm">Edit</button></a>
                                                    <!-- <a href="{{ route('crud.show', $values->id) }}"><button
                                                            type="button"
                                                            class="btn btn-warning btn-sm">Show</button></a> -->
                                                    <form action="{{ route('crud.destroy', $values->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            onclick="return confirm('Are you sure you want to delete this data?')"
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