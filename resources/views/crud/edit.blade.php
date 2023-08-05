<x-layout bodyClass="g-sidenav-show  bg-gray-200">
    <x-navbars.sidebar activePage="user-management"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="User Management"></x-navbars.navs.auth>
        <!-- End Navbar -->

        <main id="main" class="main">
            <div class="pagetitle">
                <h1>Add Data</h1>
            </div><!-- End Page Title -->

            <section class="section">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title"></h5>
                                @foreach ($data as $values)
                                @endforeach
                                <form class="row g-3 needs-validation" method="post"
                                    action="{{ route('crud.update',$values->id) }}" enctype="multipart/form-data"
                                    novalidate>
                                    @csrf
                                    @method('patch')

                                    <div class="col-md-6 position-relative">
                                        <label for="validationTooltip01" class="form-label">Text Box</label>
                                        <input type="text" name="textbox" class="form-control"
                                            value="{{ $values->textbox }}" id="validationTooltip01" required>
                                        <div class="invalid-tooltip">
                                            Please Enter Value.
                                        </div>
                                        @if ($errors->has('textbox'))
                                        <span class="error text-danger"
                                            for="input-name">{{ $errors->first('textbox') }}</span>
                                        @endif
                                    </div>

                                    <div class="col-md-6 position-relative">
                                        <label for="validationTooltip02" class="form-label">Dropdown</label>
                                        <select class="form-select" id="validationTooltip02" name="dropdown" required>

                                            @foreach($options as $op)
                                            <option value="{{ $op->id }}"
                                                {{ $values->dropdown == $op->id ? 'selected' : '' }}>
                                                {{ $op->title }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-tooltip">
                                            Please Select a Dropdown.
                                        </div>

                                        @if ($errors->has('dropdown'))
                                        <span class="error text-danger"
                                            for="input-name">{{ $errors->first('dropdown') }}</span>
                                        @endif
                                    </div><br>

                                    <div class="col-md-6 position-relative">
                                        <label for="validationTooltip03" class="form-label">Image Upload</label>
                                        <input class="form-control" type="file" id="validationTooltip03"
                                            accept="image/*" name="image">
                                        <a href="{{ URL::to('/')}}{{ $values->image }}" target="_blank">click
                                            here to see old image</a>

                                        @if ($errors->has('image'))
                                        <span class="error text-danger"
                                            for="input-name">{{ $errors->first('image') }}</span>
                                        @endif
                                    </div>

                                    <div class="col-md-6 position-relative">
                                        <label for="inputNumber" class="col-sm-4 col-form-label">Video Upload</label>
                                        <input class="form-control" type="file" id="formFile" accept="video/*"
                                            name="video">
                                        <a href="{{ URL::to('/')}}{{ $values->video }}" target="_blank">click
                                            here to see old video</a>

                                        @if ($errors->has('video'))
                                        <span class="error text-danger"
                                            for="input-name">{{ $errors->first('video') }}</span>
                                        @endif
                                    </div><br>

                                    <div class="col-md-6 position-relative">
                                        <label for="validationTooltipUsername" class="form-label">Radios</label>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="radiobutton"
                                                id="gridRadios1" value="First Radio"
                                                {{ $values->radiobutton == 'First Radio' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="gridRadios1">
                                                First Radio
                                            </label>
                                        </div>

                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="radiobutton"
                                                id="gridRadios2" value="Second Radio"
                                                {{ $values->radiobutton == 'Second Radio' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="gridRadios2">
                                                Second Radio
                                            </label>
                                        </div>

                                        @if ($errors->has('radiobutton'))
                                        <span class="error text-danger"
                                            for="input-name">{{ $errors->first('radiobutton') }}</span>
                                        @endif
                                    </div>

                                    <div class="col-md-6 position-relative">
                                        <label for="validationTooltipUsername" class="form-label">Checkbox</label>
                                        @foreach($options as $option_val)
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="gridCheck1"
                                                name="checkbox[]" value="{{ $option_val->id }}"
                                                {{ in_array($option_val->id, $selectedOptions) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="gridCheck1">
                                                {{ $option_val->title }}
                                            </label>
                                        </div>
                                        @endforeach
                                        @if ($errors->has('checkbox'))
                                        <span class="error text-danger"
                                            for="input-name">{{ $errors->first('checkbox') }}</span>
                                        @endif
                                    </div>

                                    <div class="col-md-6 position-relative">
                                        <label for="inputDate" class="col-sm-2 col-form-label">Date</label>
                                        <input type="date" class="form-control" name="date" value="{{ $values->date }}"
                                            required>
                                        <div class="invalid-tooltip">
                                            Please select date.
                                        </div>
                                        @if ($errors->has('date'))
                                        <span class="error text-danger"
                                            for="input-name">{{ $errors->first('date') }}</span>
                                        @endif
                                    </div>

                                    <div class="col-md-6 position-relative">
                                        <label for="validationTooltipUsername" class="form-label">Switch</label>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked"
                                                name="toggle" value="on" {{ $values->toggle == 'on' ? 'checked' : '' }}>
                                        </div>
                                        @if ($errors->has('toggle'))
                                        <span class="error text-danger"
                                            for="input-name">{{ $errors->first('toggle') }}</span>
                                        @endif
                                    </div>

                                    <div class="col-md-12 position-relative">
                                        <h5 class="card-title">Editor</h5>
                                        <!-- TinyMCE Editor -->
                                        <textarea class="tinymce-editor" name="editor" required>
                                        <p>{{ $values->editor }}</p>
                                        </textarea><!-- End TinyMCE Editor -->
                                        <div class="invalid-tooltip">
                                            Please enter text.
                                        </div>
                                        @if ($errors->has('editor'))
                                        <span class="error text-danger"
                                            for="input-name">{{ $errors->first('editor') }}</span>
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