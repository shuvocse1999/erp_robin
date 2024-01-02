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
            <form id="kt_docs_formvalidation_text" class="form" method="POST" action="{{ route('user.update',$user->id) }}"
                  autocomplete="off" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="fv-row col-6 mb-10">
                        <label class="required fw-semibold fs-6 mb-2">Firmenname</label>
                        <input type="text" name="firmenname" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Firmenname"
                               value="{{ $user->firmenname }}"/>
                    </div>

                    <div class="fv-row col-6 mb-10">
                        <label class="required fw-semibold fs-6 mb-2">Abteilung</label>
                        <input type="text" name="abteilung" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Abteilung"
                               value="{{ $user->abteilung }}"/>
                    </div>
                </div>
                <div class="row">
                    <div class="fv-row col-6 mb-10">
                        <label class="required fw-semibold fs-6 mb-2">Standort</label>
                        <input type="text" name="standort" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Standort"
                               value="{{$user->standort}}"/>
                    </div>

                    <div class="fv-row col-6 mb-10">
                        <label class="required fw-semibold fs-6 mb-2">Berichte</label>
                        <select class="form-control form-control-solid mb-3 mb-lg-0" name="berichte" data-control="select2" data-placeholder="Wähle eine Option">
                            <option></option>
                            <option value="Land- und Forstwirtschaft, Fischerei" {{ ($user->berichte == 'Land- und Forstwirtschaft, Fischerei') ? 'selected' : '' }}>Land- und Forstwirtschaft, Fischerei</option>
                            <option value="Bergbau und Gewinnung von Steinen und Erden" {{ ($user->berichte == 'Bergbau und Gewinnung von Steinen und Erden') ? 'selected' : '' }}>Bergbau und Gewinnung von Steinen und Erden</option>
                            <option value="Verarbeitendes Gewerbe" {{ ($user->berichte == 'Verarbeitendes Gewerbe') ? 'selected' : '' }}>Verarbeitendes Gewerbe</option>
                            <option value="Energieversorgung" {{ ($user->berichte == 'Energieversorgung') ? 'selected' : '' }}>Energieversorgung</option>
                            <option value="Wasserversorgung; Abwasser- und Abfallentsorgung und Beseitigung von Umweltverschmutzungen" {{ ($user->berichte == 'Wasserversorgung; Abwasser- und Abfallentsorgung und Beseitigung von Umweltverschmutzungen') ? 'selected' : '' }}>Wasserversorgung; Abwasser- und Abfallentsorgung und Beseitigung von Umweltverschmutzungen</option>
                            <option value="Baugewerbe" {{ ($user->berichte == 'Baugewerbe') ? 'selected' : '' }}>Baugewerbe</option>
                            <option value="Handel; Instandhaltung und Reparatur von Kraftfahrzeugen" {{ ($user->berichte == 'Handel; Instandhaltung und Reparatur von Kraftfahrzeugen') ? 'selected' : '' }}>Handel; Instandhaltung und Reparatur von Kraftfahrzeugen</option>
                            <option value="Verkehr und Lagerei" {{ ($user->berichte == 'Verkehr und Lagerei') ? 'selected' : '' }}>Verkehr und Lagerei</option>
                            <option value="Gastgewerbe" {{ ($user->berichte == 'Gastgewerbe') ? 'selected' : '' }}>Gastgewerbe</option>
                            <option value="Information und Kommunikation" {{ ($user->berichte == 'Information und Kommunikation') ? 'selected' : '' }}>Information und Kommunikation</option>
                            <option value="Erbringung von Finanz- und Versicherungsdienstleistungen" {{ ($user->berichte == 'Erbringung von Finanz- und Versicherungsdienstleistungen') ? 'selected' : '' }}>Erbringung von Finanz- und Versicherungsdienstleistungen</option>
                            <option value="Grundstücks- und Wohnungswesen" {{ ($user->berichte == 'Grundstücks- und Wohnungswesen') ? 'selected' : '' }}>Grundstücks- und Wohnungswesen</option>
                            <option value="Erbringung von freiberuflichen, wissenschaftlichen und technischen Dienstleistungen" {{ ($user->berichte == 'Erbringung von freiberuflichen, wissenschaftlichen und technischen Dienstleistungen') ? 'selected' : '' }}>Erbringung von freiberuflichen, wissenschaftlichen und technischen Dienstleistungen</option>
                            <option value="Erbringung von sonstigen wirtschaftlichen Dienstleistungen" {{ ($user->berichte == 'Erbringung von sonstigen wirtschaftlichen Dienstleistungen') ? 'selected' : '' }}>Erbringung von sonstigen wirtschaftlichen Dienstleistungen</option>
                            <option value="Öffentliche Verwaltung, Verteidigung; Sozialversicherung" {{ ($user->berichte == 'Öffentliche Verwaltung, Verteidigung; Sozialversicherung') ? 'selected' : '' }}>Öffentliche Verwaltung, Verteidigung; Sozialversicherung</option>
                            <option value="Erziehung und Unterricht" {{ ($user->berichte == 'Erziehung und Unterricht') ? 'selected' : '' }}>Erziehung und Unterricht</option>
                            <option value="Gesundheits- und Sozialwesen" {{ ($user->berichte == 'Gesundheits- und Sozialwesen') ? 'selected' : '' }}>Gesundheits- und Sozialwesen</option>
                            <option value="Kunst, Unterhaltung und Erholung" {{ ($user->berichte == 'Kunst, Unterhaltung und Erholung') ? 'selected' : '' }}>Kunst, Unterhaltung und Erholung</option>
                            <option value="Erbringung von sonstigen Dienstleistungen" {{ ($user->berichte == 'Erbringung von sonstigen Dienstleistungen') ? 'selected' : '' }}>Erbringung von sonstigen Dienstleistungen</option>
                            <option value="Exterritoriale Organisationen und Körperschaften" {{ ($user->berichte == 'Exterritoriale Organisationen und Körperschaften') ? 'selected' : '' }}>Exterritoriale Organisationen und Körperschaften</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="fv-row col-6 mb-10">
                        <label class="required fw-semibold fs-6 mb-2">zuständige BG</label>
                        <select class="form-control form-control-solid mb-3 mb-lg-0" name="responsible_BG" data-control="select2" data-placeholder="Wähle eine Option">
                            <option></option>
                            <option value="Berufsgenossenschaft Rohstoffe und chemische Industrie (BG RCI)" {{ ($user->responsible_BG == 'Berufsgenossenschaft Rohstoffe und chemische Industrie (BG RCI)') ? 'selected' : '' }}>Berufsgenossenschaft Rohstoffe und chemische Industrie (BG RCI)</option>
                            <option value="Berufsgenossenschaft Energie Textil Elektro Medienerzeugnisse (BG ETEM)" {{ ($user->responsible_BG == 'Berufsgenossenschaft Energie Textil Elektro Medienerzeugnisse (BG ETEM)') ? 'selected' : '' }}>Berufsgenossenschaft Energie Textil Elektro Medienerzeugnisse (BG ETEM)</option>
                            <option value="Berufsgenossenschaft Nahrungsmittel und Gaststätten (BGN)" {{ ($user->responsible_BG == 'Berufsgenossenschaft Nahrungsmittel und Gaststätten (BGN)') ? 'selected' : '' }}>Berufsgenossenschaft Nahrungsmittel und Gaststätten (BGN)</option>
                            <option value="Berufsgenossenschaft der Bauwirtschaft (BG Bau)" {{ ($user->responsible_BG == 'Berufsgenossenschaft der Bauwirtschaft (BG Bau)') ? 'selected' : '' }}>Berufsgenossenschaft der Bauwirtschaft (BG Bau)</option>
                            <option value="Berufsgenossenschaft Handel und Warendistribution (BGHW)" {{ ($user->responsible_BG == 'Berufsgenossenschaft Handel und Warendistribution (BGHW)') ? 'selected' : '' }}>Berufsgenossenschaft Handel und Warendistribution (BGHW)</option>
                            <option value="Verwaltungs-Berufsgenossenschaft (VBG)" {{ ($user->responsible_BG == 'Verwaltungs-Berufsgenossenschaft (VBG)') ? 'selected' : '' }}>Verwaltungs-Berufsgenossenschaft (VBG)</option>
                            <option value="Berufsgenossenschaft für Transport und Verkehrswirtschaft (BG Verkehr)" {{ ($user->responsible_BG == 'Berufsgenossenschaft für Transport und Verkehrswirtschaft (BG Verkehr)') ? 'selected' : '' }}>Berufsgenossenschaft für Transport und Verkehrswirtschaft (BG Verkehr)</option>
                            <option value="Berufsgenossenschaft für Gesundheitsdienst und Wohlfahrtspflege (BGW)" {{ ($user->responsible_BG == 'Berufsgenossenschaft für Gesundheitsdienst und Wohlfahrtspflege (BGW)') ? 'selected' : '' }}>Berufsgenossenschaft für Gesundheitsdienst und Wohlfahrtspflege (BGW)</option>
                            <option value="Berufsgenossenschaft Holz und Metall (BGHM)" {{ ($user->responsible_BG == 'Berufsgenossenschaft Holz und Metall (BGHM)') ? 'selected' : '' }}>Berufsgenossenschaft Holz und Metall (BGHM)</option>
                        </select>
                    </div>

                    <div class="fv-row col-6 mb-10">
                        <label class="required fw-semibold fs-6 mb-2">Unternehmensgröße</label>
                        <select class="form-control form-control-solid mb-3 mb-lg-0" name="company_size" data-control="select2" data-placeholder="Wähle eine Option">
                            <option></option>
                            <option value="1-20" {{ ($user->company_size == '1-20') ? 'selected' : '' }}>1-20</option>
                            <option value="21-100" {{ ($user->company_size == '21-100') ? 'selected' : '' }}>21-100</option>
                            <option value="101-250" {{ ($user->company_size == '101-250') ? 'selected' : '' }}>101-250</option>
                            <option value="251-500" {{ ($user->company_size == '251-500') ? 'selected' : '' }}>251-500</option>
                            <option value="501-1000" {{ ($user->company_size == '501-1000') ? 'selected' : '' }}>501-1000</option>
                            <option value="1001-2000" {{ ($user->company_size == '1001-2000') ? 'selected' : '' }}>1001-2000</option>
                            <option value=">2000" {{ ($user->company_size == '>2000') ? 'selected' : '' }}>>2000</option>
                            <option value=">3000" {{ ($user->company_size == '>3000') ? 'selected' : '' }}>>3000</option>
                            <option value=">4000" {{ ($user->company_size == '>4000') ? 'selected' : '' }}>>4000</option>
                            <option value=">5000" {{ ($user->company_size == '>5000') ? 'selected' : '' }}>>5000</option>
                            <option value=">10000" {{ ($user->company_size == '>10000') ? 'selected' : '' }}>>10000</option>
                        </select>
                    </div>
                </div>


                <div class="row">
                    <div class="fv-row col-6 mb-10">
                        <label class="required fw-semibold fs-6 mb-2">Vorname</label>
                        <input type="text" name="vorname" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Vorname"
                               value="{{ $user->vorname }}"/>
                    </div>

                    <div class="fv-row col-6 mb-10">
                        <label class="required fw-semibold fs-6 mb-2">Nachname</label>
                        <input type="text" name="nachname" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Nachname"
                               value="{{ $user->nachname }}"/>
                    </div>
                </div>

                <div class="row">
                    <div class="fv-row col-6 mb-10">
                        <label class="required fw-semibold fs-6 mb-2">Email</label>
                        <input type="email" name="email" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Email"
                               value="{{ $user->email }}"/>
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
                </div>

                <div class="row">
                    <div class="fv-row col-6 mb-10">
                        <label class="required fw-semibold fs-6 mb-2">Strasse</label>
                        <input type="text" name="strasse" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Strasse"
                               value="{{ $user->strasse }}"/>
                    </div>

                    <div class="fv-row col-6 mb-10">
                        <label class="required fw-semibold fs-6 mb-2">Hausnr</label>
                        <input type="text" name="hasunr" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Hausnr"
                               value="{{ $user->hasunr }}"/>
                    </div>
                </div>

                <div class="row">
                    <div class="fv-row col-6 mb-10">
                        <label class="required fw-semibold fs-6 mb-2">PLZ</label>
                        <input type="text" name="plz" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="PLZ"
                               value="{{ $user->plz }}"/>
                    </div>
                    <div class="fv-row col-6 mb-10">
                        <label class="required fw-semibold fs-6 mb-2">Wohnort</label>
                        <input type="text" name="wohnort" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Wohnort"
                               value="{{ $user->wohnort }}"/>
                    </div>
                </div>

                <div class="fv-row col-6 mb-10">
                    <label class="required fw-semibold fs-6 mb-2">Telefonnummer</label>
                    <input type="text" name="phone" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Telefonnummer"
                           value="{{ $user->phone }}"/>
                </div>

                <!--begin::Actions-->
                <button id="kt_docs_formvalidation_text_submit" type="submit" class="btn btn-light-primary">
        <span class="indicator-label">
            Update
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

