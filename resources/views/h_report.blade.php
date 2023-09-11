@extends('main')
@section('title')
   Patients Report - Covni
@endsection
@section('main')
    <div class="row">
        <div class="col-8 mx-auto">
            <form action="/tests/report/" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label" for="inputName">User id</label>
                    <input type="text" class="form-control " readonly name="user_id" id="inputName" value="{{$user_id}}" placeholder="">
                </div>
                <div class="mb-3">
                    <label class="form-label" for="inputName">Hospital id</label>
                    <input type="text" class="form-control" readonly name="hosp_id" id="inputName" value="{{$hosp_id}}" placeholder="">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Status</label>
                    <select class="form-select form-select-md" name="status" id="">
                        <option selected>Select Status</option>
                        <option value="Positive">Positive</option>
                        <option value="Negative">Negative</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Vaccination</label>
                    <select class="form-select form-select-md" name="vaccination" id="">
                        <option selected value="No Vaccination Needed">No Vaccination Needed</option>
                        <option value="Sinopharm">Sinopharm (BBIBP-CorV)</option>
                        <option value="Sinovac">Sinovac (CoronaVac)</option>
                        <option value="AstraZeneca">AstraZeneca (distributed under the name "Vaxzevria")</option>
                        <option value="CanSino Biologics">CanSino Biologics (Convidecia)</option>
                        <option value="Sputnik V">Sputnik V</option>
                        <option value="Johnson & Johnson's Janssen">Johnson & Johnson's Janssen</option>
                        <option value="Covax">Covax</option>
                        <option value="Pfizer-BioNTech">Pfizer-BioNTech</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-warning ">submit</button>
            </form>
        </div>
    </div>
@endsection
