<!DOCTYPE html>
<html>
<head>
</head>
<body style="font-family: Arial, sans-serif;">

<div class="container-fluid" style="margin: 20px;">
    <div class="row" style="margin: 20px;">
        <div class="card-body table-responsive">
            <table style="width: 100%; border-collapse: collapse; border: 1px solid #000;">
                <thead style="background-color: #15731F;">
                <tr style="text-align: center; background-color: #15731F; color: white; font-weight: bold; text-transform: uppercase; font-size: 14px;">
                    <th style="min-width: 100px; border: 1px solid #000; padding: 8px;">Aufgaben</th>
                    <th style="min-width: 80px; border: 1px solid #000; padding: 8px;">Auswahl</th>
                    <th style="min-width: 80px; border: 1px solid #000; padding: 8px;">Text</th>
                </tr>
                </thead>

                <tbody style="color: #888888;">
                @if ($submission->userAnswers->count() > 0)
                    @php $row = 1; @endphp
                    @foreach ($submission->userAnswers->groupBy('aufgaben_id') as $aufgabenId => $userAnswers)
                        @php $childRow = 1; @endphp
                        <tr class="row_data" style="color: #888888;">
                            <td>
                                <span style="color: #000;">
                                    <div style="display: flex; align-items: center; padding: 8px; margin-bottom: 10px">
                                        <span class="row-number" style="font-size: 20px; margin-right: 5px;">{{ $row }}.</span>
{{--                                        <input style="width: 100%; border: 1px solid #2B6123; background-color: #ffffff; color: #000000; height: 30px;" value="{{ @$userAnswers->first()->aufgabens->name }}" class="form-control" id="aufgaben" name="aufgaben[{{ $row }}][title]" readonly>--}}
                                    <span class="form-control btn" style="width: 100%; border: 1px solid #2B6123;padding: 10px 5px 10px 5px; background-color: #ffffff; color: #000000; height: 30px;">{{ @$userAnswers->first()->aufgabens->name }}</span>
                                    </div>
                                </span>
                                @foreach ($userAnswers as $userAnswer)
                                    <span class="child_col" id="child_col{{ $row }}.{{ $childRow }}" style="color: #000; box-sizing: border-box;">
                                        <input type="hidden" class="old_checkbox" name="old_checkbox" value="{{ @$userAnswer->answer_sheet_id }}">
                                        <div style="display: flex; align-items: center; justify-content: flex-end; padding: 8px; margin-bottom: 10px; width: 100%">
                                            <span style="margin: 10px 5px 10px 0;">{{ $row }}.{{ $childRow }}</span>
                                            <span class="form-control" style="width: 100%; border: 1px solid #2B6123; padding: 10px 5px 10px 5px; background-color: #ffffff; color: #000000; height: 30px;">{{ @$userAnswer->bereiches->name }}</span>

{{--                                            <input class="form-control" style="width: 80%; border: 1px solid #2B6123; background-color: #ffffff; color: #000000; height: 30px;" value="{{ @$userAnswer->bereiches->name }}" name="bereich[{{ $childRow }}][title]" readonly>--}}
                                        </div>
                                    </span>
                                    @php $childRow++; @endphp
                                @endforeach
                            </td>
                            <td>
                                <div style="margin-top: 50px;">
                                    @foreach ($userAnswers as $answer)
                                        <span style="color: #000;">
                                            <div class="btn" style="margin-bottom: 10px; padding: 8px; background-color: {{@$answer->answers->background_color}};">{{ @$answer->answers->answer }}</div>
                                        </span>
                                    @endforeach
                                </div>
                            </td>
                            <td>
                                <span style="margin-top: 50px; color: #000;">
                                    <div style="margin-bottom: 10px; display: grid; margin-top: inherit;">
                                        @foreach ($userAnswers as $comments)
                                            <p>{{@$comments->comment}}</p>
                                        @endforeach
                                    </div>
                                </span>
                            </td>
                        </tr>
                        @php $row++; @endphp
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>


