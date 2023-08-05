<x-layout bodyClass="g-sidenav-show  bg-gray-200">
    <x-navbars.sidebar activePage="user-management"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="User Management"></x-navbars.navs.auth>
        <!-- End Navbar -->

        <main id="main" class="main">
            <div class="pagetitle">
                <h1>Add User</h1>
                <nav>
                    <ol class="breadcrumb">
                        <!-- <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item">Forms</li>
                        <li class="breadcrumb-item active">Validation</li> -->
                    </ol>
                </nav>
            </div><!-- End Page Title -->

            <section class="section">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title"></h5>
                                <!--  <code>.{valid|invalid}-feedback</code> classes for .
                                      <code>{valid|invalid}-tooltip</code> classes to display validation feedback in a styled tooltip. -->
                                <form class="row g-3 needs-validation" method="post" action="{{ route('user.store') }}"
                                    novalidate>
                                    @csrf
                                    <div class="col-md-6 position-relative">
                                        <label for="validationTooltip01" class="form-label">Name</label>
                                        <input type="text" name="name" class="form-control" id="validationTooltip01"
                                            value="John" required>
                                        <!-- <div class="valid-tooltip">
                                            Looks good!
                                        </div> -->
                                        <div class="invalid-tooltip">
                                            Please Enter Name.
                                        </div>
                                        @if ($errors->has('name'))
                                        <span class="error text-danger"
                                            for="input-name">{{ $errors->first('name') }}</span>
                                        @endif
                                    </div>

                                    <div class="col-md-6 position-relative">
                                        <label for="validationTooltipUsername" class="form-label">Email</label>
                                        <div class="input-group has-validation">
                                            <span class="input-group-text"
                                                id="validationTooltipUsernamePrepend">@</span>
                                            <input type="email" name="email" class="form-control"
                                                id="validationTooltipUsername"
                                                aria-describedby="validationTooltipUsernamePrepend" required>
                                            <div class="invalid-tooltip">
                                                Please Choose a Unique and Valid Email.
                                            </div>
                                        </div>
                                        @if ($errors->has('email'))
                                        <span class="error text-danger"
                                            for="input-name">{{ $errors->first('email') }}</span>
                                        @endif
                                    </div>

                                    <div class="col-md-6 position-relative">
                                        <label for="validationTooltip03" class="form-label">Mobile</label>
                                        <input type="number" class="form-control" name="phone" id="validationTooltip03"
                                            required>
                                        <div class="invalid-tooltip">
                                            Please Mobile Number.
                                        </div>
                                        @if ($errors->has('phone'))
                                        <span class="error text-danger"
                                            for="input-name">{{ $errors->first('phone') }}</span>
                                        @endif
                                    </div>

                                    <div class="col-md-6 position-relative">
                                        <label for="validationTooltip04" class="form-label">Role</label>
                                        <select class="form-select" id="validationTooltip04" name="role_id" required>
                                            <option selected disabled value="">Choose...</option>
                                            @foreach($roles as $role)
                                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-tooltip">
                                            Please Select a Role.
                                        </div>
                                        @if ($errors->has('role_id'))
                                        <span class="error text-danger"
                                            for="input-name">{{ $errors->first('role_id') }}</span>
                                        @endif
                                    </div>

                                    <div class="col-12">
                                        <button class="btn btn-primary" type="submit">Submit</button>
                                    </div>
                                </form><!-- End form -->

                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </main><!-- End #main -->

    </main>
    <x-footers.auth></x-footers.auth>
</x-layout>