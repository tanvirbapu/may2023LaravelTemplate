<x-layout bodyClass="g-sidenav-show  bg-gray-200">
    <x-navbars.sidebar activePage="user-management"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="User Management"></x-navbars.navs.auth>
        <!-- End Navbar -->

        <main id="main" class="main">
            <div class="pagetitle">
                <h1>Data</h1>
            </div><!-- End Page Title -->

            <section class="section">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title"></h5>
                                @foreach ($data as $values)
                                @endforeach
                                <form class="row g-3 needs-validation" novalidate>
                                    <div class="col-md-6 position-relative">
                                        <label for="validationTooltip01" class="form-label">Text Box Value</label>
                                        <input type="text" name="textbox" class="form-control"
                                            value="{{ $values->textbox }}" id="validationTooltip01" disabled>
                                        <div class="invalid-tooltip">
                                            Please Enter Value.
                                        </div>

                                    </div>

                                    <div class="col-md-6 position-relative">
                                        <label for="validationTooltip02" class="form-label">Dropdown Value</label>
                                        @foreach($options as $op)
                                        @if($values->dropdown == $op->id)
                                        <input type="text" name="textbox" class="form-control" value="{{ $op->title }}"
                                            id="validationTooltip01" disabled>
                                        @endif
                                        @endforeach
                                    </div>

                                    <div class="col-md-6 position-relative">
                                        <label for="validationTooltip03" class="form-label">Image</label>
                                        </br>
                                        <img src="{{ URL::to('/')}}{{ $values->image }}" alt="Profile" width="350"
                                            height="200">


                                    </div>

                                    <div class="col-md-6 position-relative">
                                        <label for="inputNumber" class="col-sm-4 col-form-label">Video</label>
                                        <br>
                                        <video width="350" controls>
                                            <source src="{{ URL::to('/')}}{{ $values->video }}" type="video/mp4">
                                        </video>
                                    </div>

                                    <div class="col-md-6 position-relative">
                                        <label for="validationTooltipUsername" class="form-label">Radios</label>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="radiobutton"
                                                id="gridRadios1" value="radio1" checked disabled>
                                            <label class="form-check-label" for="gridRadios1">
                                                {{ $values->radiobutton }}
                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-md-6 position-relative">
                                        <label for="validationTooltipUsername" class="form-label">Checkbox</label>
                                        @foreach($options as $option_val)
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="gridCheck1"
                                                name="checkbox[]" value="{{ $option_val->id }}"
                                                {{ in_array($option_val->id, $selectedOptions) ? 'checked' : '' }}
                                                disabled>
                                            <label class="form-check-label" for="gridCheck1">
                                                {{ $option_val->title }}
                                            </label>
                                        </div>
                                        @endforeach

                                    </div>

                                    <div class="col-md-6 position-relative">
                                        <label for="inputDate" class="col-sm-2 col-form-label">Date</label>
                                        <input type="date" class="form-control" name="date" value="{{ $values->date }}"
                                            disabled>

                                    </div>

                                    <div class="col-md-6 position-relative">
                                        <label for="validationTooltipUsername" class="form-label">Switch</label>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked"
                                                name="toggle" value="on" {{ $values->toggle == 'on' ? 'checked' : '' }}
                                                disabled>
                                        </div>
                                    </div>

                                    <div class="col-md-12 position-relative">
                                        <h5 class="card-title">Editor</h5>
                                        <!-- TinyMCE Editor -->
                                        <textarea class="tinymce-editor" name="editor" disabled>
                                        <p>{{ $values->editor }}</p>
                                        </textarea><!-- End TinyMCE Editor -->

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