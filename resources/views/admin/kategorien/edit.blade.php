@extends('layouts.master')
@section('content')
    <style>
        :root {
            --colorPrimaryNormal: #2B6123;
            --colorPrimaryDark: #00979f;
            --colorPrimaryGlare: #2B6123;
            --colorPrimaryHalf: #2B6123;
            --colorPrimaryQuarter: #bfecee;
            --colorPrimaryEighth: #dff5f7;
            --colorPrimaryPale: #f3f5f7;
            --colorPrimarySeparator: #f3f5f7;
            --colorPrimaryOutline: #dff5f7;
            --colorButtonNormal: #00b3bb;
            --colorButtonHover: #2B6123;
            --colorLinkNormal: #00979f;
            --colorLinkHover: #2B6123;
        }

        .upload_img{
            width: -webkit-fill-available;
            max-height: 400px;
        }

        .upload_dropZone {
            color: #0f3c4b;
            background-color: var(--colorPrimaryPale, #c8dadf);
            outline: 2px dashed var(--colorPrimaryHalf, #c1ddef);
            outline-offset: -12px;
            transition:
                outline-offset 0.2s ease-out,
                outline-color 0.3s ease-in-out,
                background-color 0.2s ease-out;
        }
        .upload_svg {
            fill: var(--colorPrimaryNormal, #0576bd);
        }
        .btn-upload {
            color: #fff;
            background-color: var(--colorPrimaryNormal);
        }
        .btn-upload:hover,
        .btn-upload:focus {
            color: #fff;
            background-color: var(--colorPrimaryGlare);
        }
    </style>
    <div id="kt_app_content_container" class="app-container container-fluid">
        <div style="float: left">
            <h3>Kategorien create</h3>
        </div>
        <div class="card-toolbar flex-row-fluid justify-content-end gap-5 text-end" style="align-self: center">
            <a href="{{ route('kategorien.index') }}" data-repeater-delete
               class="btn btn-primary mt-3 mt-md-8">
                Back
            </a>
        </div>
        <div class="row g-5 g-xl-10">
            <form id="kt_docs_formvalidation_text" class="form" method="POST" action="{{ route('kategorien.update',$kategorien->id) }}"
                  autocomplete="off" enctype="multipart/form-data">
                @csrf
                <fieldset class="upload_dropZone text-center mb-3 p-4 mt-2">
                    <legend class="visually-hidden">Image uploader</legend>
                    <svg class="upload_svg" width="60" height="60" aria-hidden="true">
                        <use href="#icon-imageUpload"></use>
                    </svg>
                    <p class="small my-2">Drag &amp; Drop background image(s) inside dashed region<br><i>or</i></p>
                    @if ($kategorien->photo)
                        <div class="upload_gallery d-flex flex-wrap justify-content-center gap-3 mb-0">
                            <img src="{{ asset('public'.$kategorien->photo) }}" alt="Existing Image" class="upload_img mt-2">
                        </div>
                    @endif
                    <input id="upload_image_background" name="photo" data-post-name="image_background" data-post-url="https://someplace.com/image/uploads/backgrounds/" class="position-absolute invisible" type="file" multiple accept="image/jpeg, image/png, image/svg+xml" />
                    <label class="btn btn-upload mb-3" for="upload_image_background">Choose file(s)</label>
                    <div class="upload_gallery d-flex flex-wrap justify-content-center gap-3 mb-0"></div>
                </fieldset>

                <div class="fv-row mb-10 row">
                    <div class="col-12 col-xs-12 col-sm-12 col-lg-12 col-xl-12 row">
                        <label class="required col-4 fw-semibold fs-6 mb-2">Gefährdung</label>
                        <div class="col-8">
                            <input type="text" name="danger" class="form-control form-control-solid mb-3 mb-lg-0"
                                   placeholder="Danger"
                                   value="{{ $kategorien->danger }}"/>
                        </div>
                    </div>
                </div>
                <div class="fv-row mb-10 row">
                    <div class="col-12 col-xs-12 col-sm-12 col-lg-12 col-xl-12 row">
                        <label class="required col-4 fw-semibold fs-6 mb-2">Kat1</label>
                        <div class="col-8">
                            <input type="text" name="kat1" class="form-control form-control-solid mb-3 mb-lg-0"
                                   placeholder="Kat1"
                                   value="{{ @$kategorien->categoryoption->first()->kat1 }}"/>
                        </div>
                    </div>
                </div>
                <div class="fv-row mb-10 row">
                    <div class="col-12 col-xs-12 col-sm-12 col-lg-12 col-xl-12 row">
                        <label class="required col-4 fw-semibold fs-6 mb-2">Kat2</label>
                        <div class="col-8">
                            <input type="text" name="kat2" class="form-control form-control-solid mb-3 mb-lg-0"
                                   placeholder="Kat2"
                                   value="{{ @$kategorien->categoryoption->first()->kat2 }}"/>
                        </div>
                    </div>

                </div>
                <div class="fv-row mb-10 row">
                    <div class="col-12 col-xs-12 col-sm-12 col-lg-12 col-xl-12 row">
                        <label class="required col-4 fw-semibold fs-6 mb-2">Kat3</label>
                        <div class="col-8">
                            <input type="text" name="kat3" class="form-control form-control-solid mb-3 mb-lg-0"
                                   placeholder="Kat3"
                                   value="{{ @$kategorien->categoryoption->first()->kat3 }}"/>
                        </div>
                    </div>
                </div>
                <div class="fv-row mb-10 row">
                    <div class="col-12 col-xs-12 col-sm-12 col-lg-12 col-xl-12 row">
                        <label class="required col-4 fw-semibold fs-6 mb-2">Kat4</label>
                        <div class="col-8">
                            <input type="text" name="kat4" class="form-control form-control-solid mb-3 mb-lg-0"
                                   placeholder="Kat4"
                                   value="{{ @$kategorien->categoryoption->first()->kat4 }}"/>
                        </div>
                    </div>
                </div>
                <div class="fv-row mb-10 row">
                    <div class="col-12 col-xs-12 col-sm-12 col-lg-12 col-xl-12 row">
                        <label class="required col-4 fw-semibold fs-6 mb-2">Kat5</label>
                        <div class="col-8">
                            <input type="text" name="kat5" class="form-control form-control-solid mb-3 mb-lg-0"
                                   placeholder="Kat5"
                                   value="{{ @$kategorien->categoryoption->first()->kat5 }}"/>
                        </div>
                    </div>
                </div>
                <div class="fv-row mb-10 row">
                    <div class="col-12 col-xs-12 col-sm-12 col-lg-12 col-xl-12 row">
                        <label class="required col-4 fw-semibold fs-6 mb-2">Kat6</label>
                        <div class="col-8">
                            <input type="text" name="kat6" class="form-control form-control-solid mb-3 mb-lg-0"
                                   placeholder="Kat6"
                                   value="{{ @$kategorien->categoryoption->first()->kat6 }}"/>
                        </div>
                    </div>
                </div>
                <div class="fv-row mb-10 row">
                    <div class="col-12 col-xs-12 col-sm-12 col-lg-12 col-xl-12 row">
                        <label class="required col-4 fw-semibold fs-6 mb-2">Kat7</label>
                        <div class="col-8">
                            <input type="text" name="kat7" class="form-control form-control-solid mb-3 mb-lg-0"
                                   placeholder="Kat7"
                                   value="{{ @$kategorien->categoryoption->first()->kat7 }}"/>
                        </div>
                    </div>
                </div>
                <div class="fv-row mb-10 row">
                    <div class="col-12 col-xs-12 col-sm-12 col-lg-12 col-xl-12 row">
                        <label class="required col-4 fw-semibold fs-6 mb-2">Kat8</label>
                        <div class="col-8">
                            <input type="text" name="kat8" class="form-control form-control-solid mb-3 mb-lg-0"
                                   placeholder="Kat8"
                                   value="{{ @$kategorien->categoryoption->first()->kat8 }}"/>
                        </div>
                    </div>
                </div>
                <div class="fv-row mb-10 row">
                    <div class="col-12 col-xs-12 col-sm-12 col-lg-12 col-xl-12 row">
                        <label class="required col-4 fw-semibold fs-6 mb-2">Kat9</label>
                        <div class="col-8">
                            <input type="text" name="kat9" class="form-control form-control-solid mb-3 mb-lg-0"
                                   placeholder="Kat9"
                                   value="{{ @$kategorien->categoryoption->first()->kat9 }}"/>
                        </div>
                    </div>
                </div>
                <div class="fv-row mb-10 row">
                    <div class="col-12 col-xs-12 col-sm-12 col-lg-12 col-xl-12 row">
                        <label class="required col-4 fw-semibold fs-6 mb-2">Kat10</label>
                        <div class="col-8">
                            <input type="text" name="kat10" class="form-control form-control-solid mb-3 mb-lg-0"
                                   placeholder="Kat10"
                                   value="{{ @$kategorien->categoryoption->first()->kat10 }}"/>
                        </div>
                    </div>
                </div>
                <button id="kt_docs_formvalidation_text_submit" type="submit" class="btn btn-light-primary">
        <span class="indicator-label">
            Update
        </span>
                    <span class="indicator-progress">
            Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
        </span>
                </button>
            </form>
        </div>
    </div>
    <script>
        console.clear();
        ('use strict');
        (function () {
            'use strict';
            const preventDefaults = event => {
                event.preventDefault();
                event.stopPropagation();
            };
            const highlight = event =>
                event.target.classList.add('highlight');
            const unhighlight = event =>
                event.target.classList.remove('highlight');
            const getInputAndGalleryRefs = element => {
                const zone = element.closest('.upload_dropZone') || false;
                const gallery = zone.querySelector('.upload_gallery') || false;
                const input = zone.querySelector('input[type="file"]') || false;
                return {input: input, gallery: gallery};
            }

            const handleDrop = event => {
                const dataRefs = getInputAndGalleryRefs(event.target);
                dataRefs.files = event.dataTransfer.files;
                handleFiles(dataRefs);
            }

            function clearGallery(dataRefs) {
                if (dataRefs.gallery) {
                    dataRefs.gallery.innerHTML = ''; // Clear the gallery
                }
            }

            function updatePreview(dataRefs) {
                clearGallery(dataRefs);
                previewFiles(dataRefs);
            }

            const eventHandlers = zone => {

                const dataRefs = getInputAndGalleryRefs(zone);
                if (!dataRefs.input) return;

                // Prevent default drag behaviors
                ;['dragenter', 'dragover', 'dragleave', 'drop'].forEach(event => {
                    zone.addEventListener(event, preventDefaults, false);
                    document.body.addEventListener(event, preventDefaults, false);
                });

                // Highlighting drop area when item is dragged over it
                ;['dragenter', 'dragover'].forEach(event => {
                    zone.addEventListener(event, highlight, false);
                });
                ;['dragleave', 'drop'].forEach(event => {
                    zone.addEventListener(event, unhighlight, false);
                });

                // Handle dropped files
                zone.addEventListener('drop', handleDrop, false);

                // Handle browse selected files
                // dataRefs.input.addEventListener('change', event => {
                //     dataRefs.files = event.target.files;
                //     handleFiles(dataRefs);
                // }, false);
                dataRefs.input.addEventListener('change', event => {
                    dataRefs.files = event.target.files;
                    updatePreview(dataRefs); // Update the preview when a new file is selected
                    // handleFiles(dataRefs);
                }, false);
            }


            // Initialise ALL dropzones
            const dropZones = document.querySelectorAll('.upload_dropZone');
            for (const zone of dropZones) {
                eventHandlers(zone);
            }


            // No 'image/gif' or PDF or webp allowed here, but it's up to your use case.
            // Double checks the input "accept" attribute
            const isImageFile = file =>
                ['image/jpeg', 'image/png', 'image/svg+xml'].includes(file.type);


            function previewFiles(dataRefs) {
                if (!dataRefs.gallery) return;
                for (const file of dataRefs.files) {
                    let reader = new FileReader();
                    reader.readAsDataURL(file);
                    reader.onloadend = function() {
                        let img = document.createElement('img');
                        img.className = 'upload_img mt-2';
                        img.setAttribute('alt', file.name);
                        img.src = reader.result;
                        dataRefs.gallery.appendChild(img);
                    }
                }
            }

            // Based on: https://flaviocopes.com/how-to-upload-files-fetch/
            const imageUpload = dataRefs => {

                // Multiple source routes, so double check validity
                if (!dataRefs.files || !dataRefs.input) return;

                const url = dataRefs.input.getAttribute('data-post-url');
                if (!url) return;

                const name = dataRefs.input.getAttribute('data-post-name');
                if (!name) return;

                const formData = new FormData();
                formData.append(name, dataRefs.files);

                fetch(url, {
                    method: 'POST',
                    body: formData
                })
                    .then(response => response.json())
                    .then(data => {
                        console.log('posted: ', data);
                        if (data.success === true) {
                            previewFiles(dataRefs);
                        } else {
                            console.log('URL: ', url, '  name: ', name)
                        }
                    })
                    .catch(error => {
                        console.error('errored: ', error);
                    });
            }


            // Handle both selected and dropped files
            const handleFiles = dataRefs => {

                let files = [...dataRefs.files];

                // Remove unaccepted file types
                files = files.filter(item => {
                    if (!isImageFile(item)) {
                        console.log('Not an image, ', item.type);
                    }
                    return isImageFile(item) ? item : null;
                });

                if (!files.length) return;
                dataRefs.files = files;

                previewFiles(dataRefs);
                imageUpload(dataRefs);
            }

        })();
    </script>
@endsection

