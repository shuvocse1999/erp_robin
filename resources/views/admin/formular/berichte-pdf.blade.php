<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            width: 100%;
            margin-bottom: 50px;
        }

        .left {
            float: left;
        }

        .right {
            float: right;
        }

        .centered-content {
            text-align: center;
        }

        .centered-content > div {
            display: inline-block;
        }

        .centered-content {
            margin: 0 auto;
        }
    </style>
</head>
<body style="font-family: Arial, sans-serif;">

<div class="container-fluid" style="margin: 20px;">
    <header>
        <div class="container">
            <div class="header-content">
                <div class="left">
                    <p>{{@$submission->userId->firmenname}} | {{@$submission->userId->standort }} | {{@$submission->userId->abteilung }} </p>
                </div>
                <div class="right">
                    <p>{{ $submission->created_at->setTimezone('Europe/Berlin')->format('d.m.Y | H:i') }}</p>
                </div>
            </div>
        </div>
    </header>
    <div style="display: flex; justify-content: left">
        <div>
            <div style="text-align: center; background-color: #15731F; color: white; font-weight: bold; font-size: 19px; padding: 5px;">
                {{ @$submission->formulars->title }}
            </div>
            @if ($submission->userAnswers->count() > 0)
                @php
                    $row = 1;
                    $childRow = 1;
                @endphp
                @foreach ($submission->userAnswers->groupBy('aufgaben_id') as $aufgabenId => $userAnswer)
                    <div class="" style="padding: 5px;">
                        <div>
                            <p><strong>{{ $row }}. {{ @$userAnswer->first()->aufgabens->name }} {{ $row }}</strong></p>
                        </div>
                        @foreach ($userAnswer as $valueAnswer)
                            <div style="border-bottom: 1px dashed #000; text-align: left;">
                                <p>{{ $row }}.{{ $childRow }} {{ @$valueAnswer->bereiches->name }} {{ $childRow }}</p>
                                <div>
                                    <div class="centered-content">
                                        <div style="background-color: {{ @$valueAnswer->answers->background_color == '#fff' ? '' : (@$valueAnswer->answers->background_color ? @$valueAnswer->answers->background_color : '') }}; display: inline-block; width: fit-content;padding: 0 20px;">
                                            @if (@$valueAnswer->answers->id != 31 && @$valueAnswer->answers->id != 32 && @$valueAnswer->answers->id != 33 && @$valueAnswer->answers->id != 34)
                                                <p style="color: #000;">{{ @$valueAnswer->answers->answer }}</p>
                                            @elseif (@$valueAnswer->answers->id == 31)
                                                <p style="color: #000; margin: 0;">{{ $valueAnswer->textField }}</p>
                                            @elseif (@$valueAnswer->answers->id == 32)
                                                <p style="color: #000; margin: 0;">{{ $valueAnswer->dateTime }}</p>
                                            @elseif (@$valueAnswer->answers->id == 33)
                                                <p style="color: #000; margin: 0;">{{ $valueAnswer->Zahlen }}</p>
                                            @elseif (@$valueAnswer->answers->id == 34)
                                                {{--                                                <p style="color: #000; text-align: center; margin: 0;">{{ $valueAnswer->Unterschrift }}</p>--}}
                                                <img
                                                    src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/formular/'.$valueAnswer->Unterschrift))) }}"
                                                    class="image img-thumbnail" height="35px" width="70px"/>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div style="margin: 20px">
                                    {{ @$valueAnswer->comment }}
                                </div>
                            </div>
                            @php $childRow++; @endphp
                        @endforeach
                    </div>
                    @php $row++; @endphp
                @endforeach
            @endif
            @if(@$submission->userAnswers->first()->photo != '[]')
                <div style="display: flex">
                    <div>
                        <div style="text-align: center; background-color: #fff; color: #000; font-weight: bold; font-size: 19px; padding: 5px;">
                            Photos
                        </div>
                        @if ($submission->userAnswers->count() > 0)
                            @php
                                $row1 = 1;
                                $childRow1 = 1;
                            @endphp

                            @foreach ($submission->userAnswers->groupBy('aufgaben_id') as $aufgabenId => $userAnswer)
                                @if($userAnswer->first()->photo != '[]')
                                    <div class="" style="padding: 5px;">
                                        <div>
                                            <p><strong>{{ $row1 }}. {{ @$userAnswer->first()->aufgabens->name }} {{ $row1 }}</strong></p>
                                        </div>
                                        @foreach ($userAnswer as $valueAnswer)
                                            @if($valueAnswer->photo != '[]')
                                                <div style="border-bottom: 1px dashed #000">
                                                    <p>{{ $row1 }}.{{ $childRow1 }} {{ @$valueAnswer->bereiches->name }} {{ $childRow1 }}</p>
                                                    <div>
                                                        <div class="centered-content">
                                                            @php
                                                                $photos = json_decode($valueAnswer->photo);
                                                            @endphp
                                                            @if(count($photos) > 0)
                                                                @foreach($photos as $photo)
                                                                    <div class="mb-2">
                                                                        <a href="{{ asset('public/images/formular/'.$photo) }}">
                                                                            <img
                                                                                src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/formular/'.$photo))) }}"
                                                                                class="image img-thumbnail" height="60px"
                                                                                width="120px"/>
                                                                        </a>
                                                                    </div>
                                                                @endforeach
                                                            @else
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                @php $childRow1++; @endphp
                                            @endif
                                        @endforeach
                                    </div>
                                @endif
                                @php
                                    $row1++;
                                @endphp
                            @endforeach

                        @endif
                    </div>
                </div>
            @endif
            <footer style="background-color: #15731F; color: white; height: auto; padding: 0px 20px">
                <div style="width: 25%; display: inline-block; margin-top: 20px; vertical-align: middle; text-align: left"><img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('assets/media/logos/Faibt-logo-1.png'))) }}" class="image img-thumbnail" height="35px" width="70px"/></div>
                <div style="width: 45%;display: inline-block;margin-top: 20px; vertical-align: middle; text-align: center"><h4 style="">Ihr Schutz ist unsere Priorität!</h4></div>
                @php
                    @endphp
                <div style="width: 25%;display: inline-block; float: right;text-align: right; margin-top: 5px; vertical-align: middle"><img src='data:image/svg+xml;base64,{{ @$base64Svg }}' height="70px" width="70px" alt='QR Code'></div>
            </footer>
        </div>
    </div>
</div>

<script>
    function updateGermanTime() {
        const now = new Date();
        const options = {timeZone: 'Europe/Berlin'};
        const formattedDate = now.toLocaleString('de-DE', {
            ...options,
            day: '2-digit',
            month: '2-digit',
            year: '2-digit',
        });
        const formattedTime = now.toLocaleString('de-DE', {
            ...options,
            hour: '2-digit',
            minute: '2-digit',
        });
        const formattedDateTime = formattedDate + ' | ' + formattedTime;
        document.getElementById('german-time').textContent = formattedDateTime;
    }
    updateGermanTime();
    setInterval(updateGermanTime, 1000);
</script>
</body>
</html>


