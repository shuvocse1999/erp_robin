@extends('layouts.master')
@section('content')
    <div id="kt_app_content_container" class="app-container container-fluid">
        <div class="card-toolbar flex-row-fluid justify-content-end gap-5 text-end">
            <a href="{{ route('user.index') }}" data-repeater-delete
               class="btn mt-3 mt-md-8 text-white" style="background-color: #2B6123">
                Back
            </a>
        </div>
        <div class="row g-5 g-xl-10">

            <!--begin::Form-->
            <form id="kt_docs_formvalidation_text" class="form" method="POST" action="{{ route('user.store') }}"
                  autocomplete="off" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="fv-row col-6 mb-10">
                        <label class="required fw-semibold fs-6 mb-2">Firmenname</label>
                        <input type="text" name="firmenname" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Firmenname"
                               value=""/>
                    </div>

                    <div class="fv-row col-6 mb-10">
                        <label class="required fw-semibold fs-6 mb-2">Abteilung</label>
                        <input type="text" name="abteilung" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Abteilung"
                               value=""/>
                    </div>
                </div>
                <div class="row">
                    <div class="fv-row col-6 mb-10">
                        <label class="required fw-semibold fs-6 mb-2">Standort</label>
                        <input type="text" name="standort" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Standort"
                               value=""/>
                    </div>

                    <div class="fv-row col-6 mb-10">
                        <label class="required fw-semibold fs-6 mb-2">Berichte</label>
                        <select class="form-control form-control-solid mb-3 mb-lg-0" name="berichte" data-control="select2" data-placeholder="Wähle eine Option">
                            <option></option>
                            <option value="Land- und Forstwirtschaft, Fischerei">Land- und Forstwirtschaft, Fischerei</option>
                            <option value="Bergbau und Gewinnung von Steinen und Erden">Bergbau und Gewinnung von Steinen und Erden</option>
                            <option value="Verarbeitendes Gewerbe">Verarbeitendes Gewerbe</option>
                            <option value="Energieversorgung">Energieversorgung</option>
                            <option value="Wasserversorgung; Abwasser- und Abfallentsorgung und Beseitigung von Umweltverschmutzungen">Wasserversorgung; Abwasser- und Abfallentsorgung und Beseitigung von Umweltverschmutzungen</option>
                            <option value="Baugewerbe">Baugewerbe</option>
                            <option value="Handel; Instandhaltung und Reparatur von Kraftfahrzeugen">Handel; Instandhaltung und Reparatur von Kraftfahrzeugen</option>
                            <option value="Verkehr und Lagerei">Verkehr und Lagerei</option>
                            <option value="Gastgewerbe">Gastgewerbe</option>
                            <option value="Information und Kommunikation">Information und Kommunikation</option>
                            <option value="Erbringung von Finanz- und Versicherungsdienstleistungen">Erbringung von Finanz- und Versicherungsdienstleistungen</option>
                            <option value="Grundstücks- und Wohnungswesen">Grundstücks- und Wohnungswesen</option>
                            <option value="Erbringung von freiberuflichen, wissenschaftlichen und technischen Dienstleistungen">Erbringung von freiberuflichen, wissenschaftlichen und technischen Dienstleistungen</option>
                            <option value="Erbringung von sonstigen wirtschaftlichen Dienstleistungen">Erbringung von sonstigen wirtschaftlichen Dienstleistungen</option>
                            <option value="Öffentliche Verwaltung, Verteidigung; Sozialversicherung">Öffentliche Verwaltung, Verteidigung; Sozialversicherung</option>
                            <option value="Erziehung und Unterricht">Erziehung und Unterricht</option>
                            <option value="Gesundheits- und Sozialwesen">Gesundheits- und Sozialwesen</option>
                            <option value="Kunst, Unterhaltung und Erholung">Kunst, Unterhaltung und Erholung</option>
                            <option value="Erbringung von sonstigen Dienstleistungen">Erbringung von sonstigen Dienstleistungen</option>
                            <option value="Exterritoriale Organisationen und Körperschaften">Exterritoriale Organisationen und Körperschaften</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="fv-row col-6 mb-10">
                        <label class="required fw-semibold fs-6 mb-2">zuständige BG</label>
                        <select class="form-control form-control-solid mb-3 mb-lg-0" name="responsible_BG" data-control="select2" data-placeholder="Wähle eine Option">
                            <option></option>
                            <option value="Berufsgenossenschaft Rohstoffe und chemische Industrie (BG RCI)">Berufsgenossenschaft Rohstoffe und chemische Industrie (BG RCI)</option>
                            <option value="Berufsgenossenschaft Energie Textil Elektro Medienerzeugnisse (BG ETEM)">Berufsgenossenschaft Energie Textil Elektro Medienerzeugnisse (BG ETEM)</option>
                            <option value="Berufsgenossenschaft Nahrungsmittel und Gaststätten (BGN)">Berufsgenossenschaft Nahrungsmittel und Gaststätten (BGN)</option>
                            <option value="Berufsgenossenschaft der Bauwirtschaft (BG Bau)">Berufsgenossenschaft der Bauwirtschaft (BG Bau)</option>
                            <option value="Berufsgenossenschaft Handel und Warendistribution (BGHW)">Berufsgenossenschaft Handel und Warendistribution (BGHW)</option>
                            <option value="Verwaltungs-Berufsgenossenschaft (VBG)">Verwaltungs-Berufsgenossenschaft (VBG)</option>
                            <option value="Berufsgenossenschaft für Transport und Verkehrswirtschaft (BG Verkehr)">Berufsgenossenschaft für Transport und Verkehrswirtschaft (BG Verkehr)</option>
                            <option value="Berufsgenossenschaft für Gesundheitsdienst und Wohlfahrtspflege (BGW)">Berufsgenossenschaft für Gesundheitsdienst und Wohlfahrtspflege (BGW)</option>
                            <option value="Berufsgenossenschaft Holz und Metall (BGHM)">Berufsgenossenschaft Holz und Metall (BGHM)</option>
                        </select>
                    </div>

                    <div class="fv-row col-6 mb-10">
                        <label class="required fw-semibold fs-6 mb-2">Unternehmensgröße</label>
                        <select class="form-control form-control-solid mb-3 mb-lg-0" name="company_size" data-control="select2" data-placeholder="Wähle eine Option">
                            <option></option>
                            <option value="1-20">1-20</option>
                            <option value="21-100">21-100</option>
                            <option value="101-250">101-250</option>
                            <option value="251-500">251-500</option>
                            <option value="501-1000">501-1000</option>
                            <option value="1001-2000">1001-2000</option>
                            <option value=">2000">>2000</option>
                            <option value=">3000">>3000</option>
                            <option value=">4000">>4000</option>
                            <option value=">5000">>5000</option>
                            <option value=">10000">>10000</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="fv-row col-6 mb-10">
                        <label class="required fw-semibold fs-6 mb-2">Vorname</label>
                        <input type="text" name="vorname" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Vorname"
                               value=""/>
                    </div>

                    <div class="fv-row col-6 mb-10">
                        <label class="required fw-semibold fs-6 mb-2">Nachname</label>
                        <input type="text" name="nachname" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Nachname"
                               value=""/>
                    </div>
                </div>

                <div class="row">
                    <div class="fv-row col-6 mb-10">
                        <label class="required fw-semibold fs-6 mb-2">Email</label>
                        <input type="email" name="email" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Email"
                               value=""/>
                    </div>
{{--                    <div class="fv-row col-6 mb-10">--}}
{{--                        <label class="required fw-semibold fs-6 mb-2">Password</label>--}}
{{--                        <input type="password" name="password" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Password"--}}
{{--                               value=""/>--}}
{{--                        <span>Das Passwort enthält einen Großbuchstaben, einen Kleinbuchstaben, ein Sonderzeichen, eine Zahl und mindestens 8 Zeichen.</span>--}}
{{--                        @error('password')--}}
{{--                        <div class="text-danger">{{ $message }}</div>--}}
{{--                        @enderror--}}
{{--                    </div>--}}
                    <div class="fv-row col-6 mb-10">
                        <label class="required fw-semibold fs-6 mb-2">Strasse</label>
                        <input type="text" name="strasse" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Strasse"
                               value=""/>
                    </div>
                </div>

               <div class="row">


                   <div class="fv-row col-6 mb-10">
                       <label class="required fw-semibold fs-6 mb-2">Hausnr</label>
                       <input type="text" name="hasunr" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Hausnr"
                              value=""/>
                   </div>

                   <div class="fv-row col-6 mb-10">
                       <label class="required fw-semibold fs-6 mb-2">PLZ</label>
                       <input type="text" name="plz" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="PLZ"
                              value=""/>
                   </div>
               </div>

                <div class="row">

                    <div class="fv-row col-6 mb-10">
                        <label class="required fw-semibold fs-6 mb-2">Wohnort</label>
                        <input type="text" name="wohnort" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Wohnort"
                               value=""/>
                    </div>
                    <div class="fv-row col-6 mb-10">
                        <label class="required fw-semibold fs-6 mb-2">Telefonnummer</label>
                        <input type="text" name="phone" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Telefonnummer"
                               value=""/>
                    </div>
                </div>



                <!--begin::Actions-->
                <button id="kt_docs_formvalidation_text_submit" type="submit" class="btn" style="background-color: #F49738;">
        <span class="indicator-label text-white">
            Speichern
        </span>
                    <span class="indicator-progress">
            Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
        </span>
                </button>
                <!--end::Actions-->
            </form>
            <!--end::Form-->
        </div>
    </div>
@endsection

