@inject('request', 'Illuminate\Http\Request')

<div class="card grade_book_conf Container ">

    <div class="card-body  ">
        @if(isset($GradebookGradeConfig))
            <div class="row" style="background-color: #c1c1c1;border-radius: 5px;padding: 5px;">
                <div class="col-4 col-md-4" style="display: flex;">
                    <h5>Grade : </h5>
                    <span style="margin-left: 10px;margin-top: 5px;">{{$GradebookGradeConfig->grade->grade}}</span>
                </div>
                <div class="col-4 col-md-4" style="display: flex;">
                    <h5>Term : </h5>
                    <span style="margin-left: 10px;margin-top: 5px;">{{$GradebookGradeConfig->term->name}}</span>
                </div>
                <div class="col-4 col-md-4" style="display: flex;">
                    <h5>Acadmic Year : </h5>
                    <span
                        style="margin-left: 10px;margin-top: 5px;">{{$GradebookGradeConfig->Acadmic_year->year}}</span>
                </div>
            </div>
        @endif
        <div style="display: flex;">
            <h1>Categories & Calculation
                <spane>( Total Weight
                    : @if(isset($GradebookGradeConfig)){{$GradebookGradeConfig->total_weight}}@endif )</span>
            </h1>
        </div>


        <div class="row">

            <div class="col-12 col-md-7">
                <form action="{{ url('admin/gradebook/config/save') }}" id="form1" method="POST">

                    <input type="hidden" class="form-control" name="acadmic_year"
                           value="@if(isset($GradebookGradeConfig)){{$GradebookGradeConfig->acadmic_year}}@endif"
                           id="acadmic_year" placeholder="Work Type">
                    <input type="hidden" class="form-control" name="total_weight"
                           value="@if(isset($GradebookGradeConfig)){{$GradebookGradeConfig->total_weight}}@endif"
                           id="total_weight" placeholder="Work Type">
                    <input type="hidden" class="form-control" name="grade_config"
                           value="@if(isset($GradebookGradeConfig)){{$GradebookGradeConfig->id}}@endif"
                           id="grade_config" placeholder="Work Type">

                    @csrf
                    @if(isset($grade_configs) && count($grade_configs) > 0)
                        @foreach($grade_configs as $grade_config)
                            @if($grade_config->work_type === 'Class Work')
                                <div class="row">
                                    <input type="hidden" class="form-control" name="grade_config_ids[]"
                                           value="{{$grade_config->id}}" id="Type1" placeholder="Work Type">

                                    <div class="form-group col-4">

                                        <label for="Type1"></label>
                                        <h5 style="padding: 5px;border: 1px solid #ced4da;border-radius: 3px;background-color: #e9ecef;font-size: 20px;">
                                            Class Work</h5>

                                    <!-- <input type="txt" @if(isset($GradebookGradeConfig) && isset($current_year) && $GradebookGradeConfig->acadmic_year !== $current_year->id) disabled @endif class="form-control types" name="types[]" value="{{$grade_config->work_type}}" id="Type1" required placeholder="Work Type"> -->
                                        <input type="hidden" class="form-control" value="Class Work" readonly
                                               name="types[]" id="Type1" required placeholder="Work Type">

                                    </div>

                                    <div class="form-group col-4">

                                        <label for="Evaluate_As">Evaluate As:</label>

                                        <h5 style="padding: 5px;border: 1px solid #ced4da;border-radius: 3px;background-color: #e9ecef;font-size: 20px;">
                                            Formative</h5>

                                    <!-- <select class="form-control evaluates" @if(isset($GradebookGradeConfig) && isset($current_year) && $GradebookGradeConfig->acadmic_year !== $current_year->id) disabled @endif name="evaluates[]" id="Evaluate_As" required>

                                                <option value="Summative" @if($grade_config->evaluate === 'Summative') selected @endif>Summative</option>

                                                <option value="Formative" @if($grade_config->evaluate === 'Formative') selected @endif>Formative</option>

                                            </select> -->

                                        <input type="hidden" class="form-control" value="Formative" readonly
                                               name="evaluates[]" id="Evaluate_As" required placeholder="Work Type">

                                    </div>

                                    <div class="form-group col-3 weight">

                                        <label for="HomeWork_percentage">Weight</label>

                                        <input type="number"
                                               @if(isset($GradebookGradeConfig) && isset($current_year) && $GradebookGradeConfig->acadmic_year !== $current_year->id) disabled
                                               @endif class="form-control HomeWork_percentage" min="0" name="weights[]"
                                               data-config="{{$grade_config}}" data-id="{{$grade_config->id}}"
                                               value="{{$grade_config->weight}}" id="HomeWork_percentage"
                                               placeholder="Weight" required>

                                    </div>

                                </div>
                            @elseif($grade_config->work_type === 'Work Habits')
                                <div class="row">
                                    <input type="hidden" class="form-control" name="grade_config_ids[]"
                                           value="{{$grade_config->id}}" id="Type1" placeholder="Work Type">

                                    <div class="form-group col-4">

                                        <label for="Type1"></label>
                                        <h5 style="padding: 5px;border: 1px solid #ced4da;border-radius: 3px;background-color: #e9ecef;font-size: 20px;">
                                            Work Habits</h5>

                                    <!-- <input type="txt" @if(isset($GradebookGradeConfig) && isset($current_year) && $GradebookGradeConfig->acadmic_year !== $current_year->id) disabled @endif class="form-control types" name="types[]" value="{{$grade_config->work_type}}" id="Type1" required placeholder="Work Type"> -->
                                        <input type="hidden" class="form-control" value="Work Habits" readonly
                                               name="types[]" id="Type1" required placeholder="Work Type">

                                    </div>

                                    <div class="form-group col-4">

                                        <label for="Evaluate_As">Evaluate As:</label>
                                        <h5 style="padding: 5px;border: 1px solid #ced4da;border-radius: 3px;background-color: #e9ecef;font-size: 20px;">
                                            Formative</h5>

                                    <!-- <select class="form-control evaluates" @if(isset($GradebookGradeConfig) && isset($current_year) && $GradebookGradeConfig->acadmic_year !== $current_year->id) disabled @endif name="evaluates[]" id="Evaluate_As" required>

                                                <option value="Summative" @if($grade_config->evaluate === 'Summative') selected @endif>Summative</option>

                                                <option value="Formative" @if($grade_config->evaluate === 'Formative') selected @endif>Formative</option>

                                            </select> -->

                                        <input type="hidden" class="form-control" value="Formative" readonly
                                               name="evaluates[]" id="Evaluate_As" required placeholder="Work Type">


                                    </div>

                                    <div class="form-group col-3 weight">

                                        <label for="HomeWork_percentage">Weight</label>

                                        <input type="number"
                                               @if(isset($GradebookGradeConfig) && isset($current_year) && $GradebookGradeConfig->acadmic_year !== $current_year->id) disabled
                                               @endif class="form-control HomeWork_percentage" min="0" name="weights[]"
                                               data-config="{{$grade_config}}" data-id="{{$grade_config->id}}"
                                               value="{{$grade_config->weight}}" id="HomeWork_percentage"
                                               placeholder="Weight" required>

                                    </div>

                                </div>
                            @elseif($grade_config->work_type === 'Exam')
                                <div class="row">
                                    <input type="hidden" class="form-control" name="grade_config_ids[]"
                                           value="{{$grade_config->id}}" id="Type1" placeholder="Work Type">

                                    <div class="form-group col-4">

                                        <label for="Type1"></label>
                                        <h5 style="padding: 5px;border: 1px solid #ced4da;border-radius: 3px;background-color: #e9ecef;font-size: 20px;">
                                            Exam</h5>

                                    <!-- <input type="txt" @if(isset($GradebookGradeConfig) && isset($current_year) && $GradebookGradeConfig->acadmic_year !== $current_year->id) disabled @endif class="form-control types" name="types[]" value="{{$grade_config->work_type}}" id="Type1" required placeholder="Work Type"> -->
                                        <input type="hidden" class="form-control" value="Exam" readonly name="types[]"
                                               id="Type1" required placeholder="Work Type">

                                    </div>

                                    <div class="form-group col-4">

                                        <label for="Evaluate_As">Evaluate As:</label>
                                        <h5 style="padding: 5px;border: 1px solid #ced4da;border-radius: 3px;background-color: #e9ecef;font-size: 20px;">
                                            Summative</h5>


                                    <!-- <select class="form-control evaluates" @if(isset($GradebookGradeConfig) && isset($current_year) && $GradebookGradeConfig->acadmic_year !== $current_year->id) disabled @endif name="evaluates[]" id="Evaluate_As" required>

                                                <option value="Summative" @if($grade_config->evaluate === 'Summative') selected @endif>Summative</option>

                                                <option value="Formative" @if($grade_config->evaluate === 'Formative') selected @endif>Formative</option>

                                            </select> -->
                                        <input type="hidden" class="form-control" value="Summative" readonly
                                               name="evaluates[]" id="Evaluate_As" required placeholder="Work Type">

                                    </div>

                                    <div class="form-group col-3 weight">

                                        <label for="HomeWork_percentage">Weight</label>

                                        <input type="number"
                                               @if(isset($GradebookGradeConfig) && isset($current_year) && $GradebookGradeConfig->acadmic_year !== $current_year->id) disabled
                                               @endif class="form-control HomeWork_percentage" min="0" name="weights[]"
                                               data-config="{{$grade_config}}" data-id="{{$grade_config->id}}"
                                               value="{{$grade_config->weight}}" id="HomeWork_percentage"
                                               placeholder="Weight" required>

                                    </div>

                                </div>
                            <!-- @endif -->
                            @else
                                <div class="row">
                                    <input type="hidden" class="form-control" name="grade_config_ids[]"
                                           value="{{$grade_config->id}}" id="Type1" placeholder="Work Type">

                                    <div class="form-group col-4">

                                        <label for="Type1"></label>

                                        <input type="txt"
                                               @if(isset($GradebookGradeConfig) && isset($current_year) && $GradebookGradeConfig->acadmic_year !== $current_year->id) disabled
                                               @endif  class="form-control types" name="types[]"
                                               value="{{$grade_config->work_type}}" id="Type1" required
                                               placeholder="Work Type">

                                    </div>

                                    <div class="form-group col-4">

                                        <label for="Evaluate_As">Evaluate As:</label>

                                        <select class="form-control evaluates"
                                                @if(isset($GradebookGradeConfig) && isset($current_year) && $GradebookGradeConfig->acadmic_year !== $current_year->id) disabled
                                                @endif name="evaluates[]" id="Evaluate_As" required>

                                            <option value="Summative"
                                                    @if($grade_config->evaluate === 'Summative') selected @endif>
                                                Summative
                                            </option>

                                            <option value="Formative"
                                                    @if($grade_config->evaluate === 'Formative') selected @endif>
                                                Formative
                                            </option>

                                        </select>

                                    </div>

                                    <div class="form-group col-3 weight">

                                        <label for="HomeWork_percentage">Weight</label>

                                        <input type="number"
                                               @if(isset($GradebookGradeConfig) && isset($current_year) && $GradebookGradeConfig->acadmic_year !== $current_year->id) disabled
                                               @endif class="form-control HomeWork_percentage" min="0" name="weights[]"
                                               data-config="{{$grade_config}}" data-id="{{$grade_config->id}}"
                                               value="{{$grade_config->weight}}" id="HomeWork_percentage"
                                               placeholder="Weight" required>

                                    </div>
                                    @if(isset($GradebookGradeConfig) && isset($current_year) && $GradebookGradeConfig->acadmic_year === $current_year->id)
                                        <div class="remove_button">
                                            <button id="removeRow" data-id="{{$grade_config->id}}"
                                                    data-config="{{$grade_config}}" type="button"
                                                    class="btn btn-danger">-
                                            </button>
                                        </div>
                                    @endif

                                </div>
                            @endif
                        @endforeach
                    @else
                        <div class="row">
                            <!-- <input type="hidden" class="form-control" name="grade_config_ids[]" value="new" required id="Type1" placeholder="Work Type"> -->
                            <div class="form-group col-4">

                                <label for="Type1"></label>
                                <h5 style="padding: 5px;border: 1px solid #ced4da;border-radius: 3px;background-color: #e9ecef;font-size: 20px;">
                                    Class Work</h5>
                                <!-- <input type="txt" class="form-control" value="Class Work" readonly name="types[]" id="Type1" required placeholder="Work Type"> -->
                                <input type="hidden" class="form-control" value="Class Work" readonly name="types[]"
                                       id="Type1" required placeholder="Work Type">

                            </div>

                            <div class="form-group col-4">

                                <label for="Evaluate_As">Evaluate As:</label>

                                <h5 style="padding: 5px;border: 1px solid #ced4da;border-radius: 3px;background-color: #e9ecef;font-size: 20px;">
                                    Formative</h5>
                                <!-- <select class="form-control" name="evaluates[]" disabled id="Evaluate_As" required>

                                    <option value="Summative">Summative</option>

                                    <option value="Formative" selected>Formative</option>

                                </select> -->
                                <input type="hidden" class="form-control" value="Formative" readonly name="evaluates[]"
                                       id="Evaluate_As" required placeholder="Work Type">

                            </div>

                            <div class="form-group col-3 weight">

                                <label for="HomeWork_percentage">Weight</label>

                                <input type="number" class="form-control" min="0" name="weights[]" required
                                       id="HomeWork_percentage" placeholder="Weight">

                            </div>

                        </div>
                        <div class="row">
                            <!-- <input type="hidden" class="form-control" name="grade_config_ids[]" value="new" required id="Type1" placeholder="Work Type"> -->
                            <div class="form-group col-4">

                                <label for="Type1"></label>
                                <h5 style="padding: 5px;border: 1px solid #ced4da;border-radius: 3px;background-color: #e9ecef;font-size: 20px;">
                                    Work Habits</h5>

                                <!-- <input type="txt" class="form-control" value="Work Habits" readonly name="types[]" id="Type1" required placeholder="Work Type"> -->
                                <input type="hidden" class="form-control" value="Work Habits" readonly name="types[]"
                                       id="Type1" required placeholder="Work Type">

                            </div>

                            <div class="form-group col-4">

                                <label for="Evaluate_As">Evaluate As:</label>
                                <h5 style="padding: 5px;border: 1px solid #ced4da;border-radius: 3px;background-color: #e9ecef;font-size: 20px;">
                                    Formative</h5>

                                <!-- <select class="form-control" name="evaluates[]" disabled id="Evaluate_As" required>

                                    <option value="Summative">Summative</option>

                                    <option value="Formative" selected>Formative</option>

                                </select> -->

                                <input type="hidden" class="form-control" value="Formative" readonly name="evaluates[]"
                                       id="Evaluate_As" required placeholder="Work Type">

                            </div>

                            <div class="form-group col-3 weight">

                                <label for="HomeWork_percentage">Weight</label>

                                <input type="number" class="form-control" min="0" name="weights[]" required
                                       id="HomeWork_percentage" placeholder="Weight">

                            </div>

                        </div>
                        <div class="row">
                            <!-- <input type="hidden" class="form-control" name="grade_config_ids[]" value="new" required id="Type1" placeholder="Work Type"> -->
                            <div class="form-group col-4">

                                <label for="Type1"></label>

                                <h5 style="padding: 5px;border: 1px solid #ced4da;border-radius: 3px;background-color: #e9ecef;font-size: 20px;">
                                    Exam</h5>


                                <!-- <input type="txt" class="form-control" value="Exam" readonly name="types[]" id="Type1" required placeholder="Work Type"> -->

                                <input type="hidden" class="form-control" value="Exam" readonly name="types[]"
                                       id="Type1" required placeholder="Work Type">

                            </div>

                            <div class="form-group col-4">

                                <label for="Evaluate_As">Evaluate As:</label>
                                <h5 style="padding: 5px;border: 1px solid #ced4da;border-radius: 3px;background-color: #e9ecef;font-size: 20px;">
                                    Summative</h5>

                                <!-- <select class="form-control" name="evaluates[]" disabled id="Evaluate_As" required>

                                    <option value="Summative" selected>Summative</option>

                                    <option value="Formative">Formative</option>

                                </select> -->
                                <input type="hidden" class="form-control" value="Summative" readonly name="evaluates[]"
                                       id="Evaluate_As" required placeholder="Work Type">
                            </div>

                            <div class="form-group col-3 weight">

                                <label for="HomeWork_percentage">Weight</label>

                                <input type="number" class="form-control" min="0" name="weights[]" required
                                       id="HomeWork_percentage" placeholder="Weight">

                            </div>

                        </div>

                    @endif


                    <div class="col-12 p-0" id="title_container">

                    </div>
                    @if(isset($GradebookGradeConfig) && isset($current_year) && $GradebookGradeConfig->acadmic_year === $current_year->id)
                        <hr>
                        <h3>Pending Delete</h3>
                        <div class="pending_delete" id="pending_delete">

                        </div>

                        <div class="row">

                            <div class="form-group  pt-4 float-left col">
                                <input type="button" id="Button1" value="Add Type" class="btn btn-info"/>
                            </div>

                            <div class="form-group  pt-4 text-right col">
                                <input type="submit" id="save1"
                                       data-total_weight="@if(isset($GradebookGradeConfig)){{$GradebookGradeConfig->total_weight}}@endif"
                                       value="Save" class="btn btn-info"/>
                            </div>

                        </div>
                    @endif


                </form>

            </div>
            <div class="row another_title d-none" id="another_title">
                <div class="form-group col-4">

                    <label for="New_title">Test</label>

                    <input type="txt" class="form-control types" name="types[]" required id="New_title"
                           placeholder="Add Work Type">

                </div>

                <div class="form-group col-4">

                    <label for="Evaluate_As">Evaluate As:</label>

                    <select class="form-control evaluates" name="evaluates[]" id="Evaluate_As" required>

                        <option value="Summative">Summative</option>

                        <option value="Formative">Formative</option>

                    </select>

                </div>

                <div class="form-group col-3 weight">
                    <label for="Quiz_percentage">Weight</label>

                    <input type="number" class="form-control HomeWork_percentage" min="0" name="weights[]" required
                           id="HomeWork_percentage" placeholder="Weight">
                </div>

                <div class="remove_button">
                    <button id="removeRow" data-id="new" type="button" class="btn btn-danger">-</button>
                </div>

            </div>

            <div class="col-12 col-md-5">

                <div id="piechart"></div>

            </div>

        </div>

    </div>

</div>


<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript">

    var arr = [['Task', 'Hours per Day']]
    $.each( <?php  echo json_encode($config_char); ?>, function (key, value) {
        var t = [key, value]
        arr.push(t)
        // console.log(key, value)
    })

    google.charts.load('current', {'packages': ['corechart']});

    google.charts.setOnLoadCallback(drawChart);


    function drawChart() {

        var data = google.visualization.arrayToDataTable(arr);


        // Optional; add a title and set the width and height of the chart

        var options = {'title': '', 'width': 310, 'height': 300};


        // Display the chart inside the <div> element with id="piechart"

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);

    }


</script>
