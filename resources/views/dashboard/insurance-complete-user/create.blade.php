@extends('dashboard.layout.app')
@section('content')


    <?php

    if ($lang == 'ar' || $lang == 'en') {
        App::setlocale($lang);
    } else {
        App::setlocale('ar');
    }

    ?>


    @if(app()->getLocale() == 'ar')

        <style>
            .form-group {
                direction: rtl;
                text-align: right !important;
            }
        </style>

    @else

        <style>
            .form-group {
                direction: ltr;
                text-align: left !important;
            }
        </style>

    @endif

    <div class="card-body"
         style="background-color: white;color:#31353D;border:1px solid #d3d3d3;border-radius: 5px;margin-top: 30px;">
        <h4>
            @if(app()->getLocale() == 'ar')
                اضافه تأمين شامل
            @else
                add Comprehensive Inurance
            @endif
        </h4>
        <hr>
        <div class="form-body">
            <form method="POST" action="{{route('Document-save-data')}}" enctype="multipart/form-data">
                @csrf

                <input type="hidden" value="{{$insurance->id}}" name="insurance_id">

                <div class="row">
                    <?php
                    $lang = app()->getLocale();
                    $name = $lang == 'ar' ? 'name_ar' : 'name_en';
                    $uses = \App\Style::all();
                    ?>
                    <div class="form-group col-md-4">
                        <label>
                            @if(app()->getLocale() == 'ar')
                                نوع الاستخدام
                            @else
                                type of use
                            @endif
                        </label> 

                        <select class="SpecificInput" name="type_of_use">
                            @foreach($uses as $use)
                                <option
                                    value="{{ $use->id }}"  @if(old('type_of_use') == $use->id) {{ 'selected' }} @endif>{{ $use->$name }}</option>
                            @endforeach

                        </select>
                        <small class="text-danger">
                            عند إختيار نوع الاستخدام سيتم الاخيار علي جميع الموديلات
                        </small>
                    </div> 
                    <div class="form-group col-md-4">
                        <label>
                            @if(app()->getLocale() == 'ar')
                                نوع المركبة
                            @else
                                vehicles type
                            @endif
                        </label> 
                        <select class="SpecificInput " name="vehicle_id">
                            @foreach($vehicles as $vehicle)
                                <option
                                    value="{{ $vehicle->id }}"  @if(old('vehicle_id') == $vehicle->id) {{ 'selected' }} @endif>{{ $vehicle->getName() }}</option>
                            @endforeach

                        </select>
                    </div>

                </div>
                <hr>
                <div class="row">
                    <div class="form-group col-md-4">
                        <label>
                            @if(app()->getLocale() == 'ar')
                                الشعار
                            @else
                                LOGO
                            @endif
                        </label>
                        <input type="file" name="logo" class="SpecificInput">

                    </div>
                    <div class="form-group col-md-4">
                        <label>
                            @if(app()->getLocale() == 'ar')
                                اسم شركه التامين بالعربيه
                            @else
                                Insurance Company Name In Arabic
                            @endif
                        </label>
                        <input type="text" name="Insurance_Company_ar" class="SpecificInput" max="191"
                               value="">
                    </div>
                    <div class="form-group col-md-4">
                        <label>
                            @if(app()->getLocale() == 'ar')
                                اسم شركه التامين بالانجليزيه
                            @else
                                Insurance Company Name in English
                            @endif
                        </label>
                        <input type="text" name="Insurance_Company_en" class="SpecificInput" max="191"
                               value="">
                    </div>
                </div>
                <hr>
                <div class="row">
{{--                    <div class="form-group col-md-2">--}}
{{--                        <label>--}}
{{--                            @if(app()->getLocale() == 'ar')--}}
{{--                                رسوم توصيل الوثيفة--}}
{{--                            @else--}}
{{--                                Delivery Fee--}}
{{--                            @endif--}}
{{--                        </label>--}}
{{--                        <input type="number" step=".0001" name="deliveryFee" class="SpecificInput" max="191"--}}
{{--                               value="">--}}
{{--                    </div>--}}
                </div>
                <div class="row">
                    <div class="form-group col-md-2">
                        <label>
                            @if(app()->getLocale() == 'ar')
                                رسوم توصيل الوثيفة
                            @else
                                Delivery Fee
                            @endif
                        </label>
                        <input type="text"  name="deliveryFee" class="SpecificInput" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                               value="@if(old('deliveryFee') != null){{ old('deliveryFee') }}@elseif(isset($document)){{$document->deliveryFee}}@endif">
                    </div>

                    <div class="col-md-2">
                        <label>{{__('site.max_year')}}</label>
                        <input type="text"  name="max_year" class="SpecificInput" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                               value="@if(old('max_year') != null){{ old('max_year') }}@elseif(isset($document)){{$document->max_year}}@endif">
                    </div>
                    <div class="form-group col-md-2">
                        <label>{{__('site.maximum')}}</label>
                        <input type="text"  name="max_value" class="SpecificInput" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                               value="@if(old('max_value') != null){{ old('max_value') }}@elseif(isset($document)){{$document->max_value}}@endif">
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label>
                            @if(app()->getLocale() == 'ar')
                                شروط الوثيقه بالعربية<small class="text-danger">*</small>

                            @else
                                Terms in Arabic  <small class="text-danger">*</small>
                            @endif
                        </label>

                        <input type="text" required="required" name="ar_term" maxlength="191" class="SpecificInput"
                               value="">
                    </div>
                    <div class="form-group col-md-6">
                        <label>
                            @if(app()->getLocale() == 'ar')
                                شروط الوثيقة بالانجليزية  <small class="text-danger">*</small>
                            @else
                                Terms in English  <small class="text-danger">*</small>
                            @endif
                        </label>

                        <input type="text" required="required" name="en_term" maxlength="191" class="SpecificInput"
                               value="">
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="form-group col-md-3">
                        <label>
                            @if(app()->getLocale() == 'ar')
                                نسبة الخصم % <small class="text-danger">*</small>
                            @else
                                Discount's percentage  <small class="text-danger">*</small>
                            @endif
                        </label>
                        <input type="number" step=".0001" name="precent" maxlength="191" class="SpecificInput"
                               value="0">
                    </div>
                    <div class="form-group col-md-3">
                        <label>
                            @if(app()->getLocale() == 'ar')
                                قيمة الخصم<small class="text-danger">*</small>
                            @else
                                Discount's Value  <small class="text-danger">*</small>
                            @endif
                        </label>

                        <input type="number" step=".0001" name="discount_q" maxlength="191" class="SpecificInput"
                               value="0">
                    </div>
                    <div class="form-group col-md-3">

                        <label>
                            @if(app()->getLocale() == 'ar')

                                تاريخ بداية الخصم<small class="text-danger">*</small>
                            @else
                                Discount's Start Date<small class="text-danger">*</small>
                            @endif
                        </label>
                        <input type="date" name="start_disc" maxlength="191" class="SpecificInput"
                               value="">
                    </div>
                    <div class="form-group col-md-3">
                        <label>
                            @if(app()->getLocale() == 'ar')

                                تاريخ نهاية الخصم <small class="text-danger">*</small>
                            @else
                                Discount's Start Date<small class="text-danger">*</small>
                            @endif
                        </label>

                        <input type="date" name="end_disc"  class="SpecificInput"
                               value="">
                    </div>
                </div>
                <hr>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <h4>
                                        @if(app()->getLocale() == 'ar')
                                            الشروط
                                        @else
                                            Terms
                                        @endif
                                    </h4>
                                    <button type="button" class="btn btn-light d-block"
                                            onclick="addmoreAddons()">@if(app()->getLocale() == "ar") إضافة
                                        المزيد  @else  Add More  @endif </button>
                                    <br>
                                </div>

                                <div class="col-md-12 form-group">
                                    <div class="row form-group">
                                        <div class="col-md-3" style="padding-top:35px">
                                            <input type="checkbox" checked value="1" name="ToleranceratioCheck"/>
                                            <label>
                                                @if(app()->getLocale() == 'ar')

                                                    نسبة التحمل

                                                @else
                                                    Tolerance ratio
                                                @endif
                                            </label>
                                        </div>
                                        <div class="col-md-3">
                                            <label>
                                                @if(app()->getLocale() == 'ar')

                                                    نسبة التحمل
                                                @else
                                                    Tolerance ratio

                                                @endif
                                            </label>
                                            <input class="SpecificInput" required type="text" name="Tolerance_ratio"
                                                   value="@if(old('Tolerance_ratio') != null){{ old('Tolerance_ratio') }}@endif">

                                        </div>

                                        <div class="col-md-3">
                                            <label>
                                                @if(app()->getLocale() == 'ar')
                                                    الحد الاقصي
                                                @else
                                                    Maxmum ratio
                                                @endif
                                            </label>
                                            <input class="SpecificInput" required type="text"
                                                   name="ToleranceYearPerecenteage"
                                                   value="@if(old('ToleranceYearPerecenteage') != null){{ old('ToleranceYearPerecenteage') }}@endif">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 form-group">
                                    <div class="row form-group">
                                        <div class="col-md-4" style="padding-top:35px">
                                            <input type="checkbox" value="1" checked name="ConsumptionRatio"/>
                                            <label>
                                                @if( app()->getLocale() == 'ar')
                                                    نسبة الاستهلاك ( في حالة التصليح خارج الوكالة )
                                                @else
                                                    Consumption rate (in case of repair outside the agency)
                                                @endif
                                            </label>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label>
                                                        @if(app()->getLocale() == 'ar')
        
                                                            نسبة الاستهلاك
                                                        @else
                                                            Consumption Ratio
        
                                                        @endif
                                                    </label>
                                                    <input class="SpecificInput" required type="text" name="ConsumptionFirstRatio"
                                                           value="@if(old('ConsumptionFirstRatio') != null){{ old('ConsumptionFirstRatio') }}@elseif(isset($conds)){{$conds->ConsumptionFirstRatio}}@endif">
        
                                                </div>
                                                <div class="col-md-4">
                                                    <label>
                                                        @if(app()->getLocale() == 'ar')
                                                            الزيادة السنوية
                                                        @else
                                                            Yearly Ratio
                                                        @endif
                                                    </label>
                                                    <input class="SpecificInput" required type="text" name="YearPerecenteage"
                                                           value="@if(old('YearPerecenteage') != null){{ old('YearPerecenteage') }}@elseif(isset($conds)){{$conds->YearPerecenteage}}@endif">
        
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label>
                                                        @if(app()->getLocale() == 'ar')
                                                            الحد الاقصي
                                                        @else
                                                            Maxmum ratio
                                                        @endif
                                                    </label>
                                                    <input class="SpecificInput" required type="text"
                                                           name="ConsumptionYearPerecenteage"
                                                           value="@if(old('ConsumptionYearPerecenteage') != null){{ old('ConsumptionYearPerecenteage') }}@elseif(isset($conds)){{$conds->ConsumptionYearPerecenteage}}@endif">
    
                                                </div>
                                                <div class="col-md-4">
                                                    <label>
                                                        @if(app()->getLocale() == 'ar')
                                                            النسبة للحد الاقصي بالعربيه
                                                        @else
                                                            last Maxmum ratio
                                                        @endif
                                                    </label>
                                                    <input class="SpecificInput" required type="text" name="last_percent"
                                                           value="@if(old('last_percent') != null){{ old('last_percent') }}@elseif(isset($conds)){{$conds->last_percent}}@endif">
    
                                                </div>
                                                <div class="col-md-4">
                                                    <label>
                                                        @if(app()->getLocale() == 'ar')
                                                            النسبة للحد الاقصي بالانجليزيه
                                                        @else
                                                            last Maxmum ratio english
                                                        @endif
                                                    </label>
                                                    <input class="SpecificInput" required type="text" name="last_percent_en"
                                                           value="@if(old('last_percent_en') != null){{ old('last_percent_en') }}@elseif(isset($conds)){{$conds->last_percent_en}}@endif">
    
                                                </div>
                                            </div>
                                        </div>
                                     
                                       
                                    </div>
                                   
                                </div>

                                    <div class="col-md-3 form-group">
                                        <label class="d-block">{{ __('site.conAr') }}
                                        </label>
                                        <input type="text" class="SpecificInput" name="AddonNameAR[]">
                                    </div>
                                    <div class="col-md-3 form-group">
                                        <label class="d-block">{{ __('site.conEn') }}
                                        </label>
                                        <input type="text" class="SpecificInput" name="AddonNameEn[]">
                                    </div>
                                    <div class="col-md-3 form-group">
                                        <label class="d-block">{{ __('site.minYear') }}
                                        </label>
                                        <input type="text" class="SpecificInput" name="AddonMaxYear[]">
                                    </div>
                                    <div class="col-md-3 form-group">
                                        <label class="d-block">
                                            {{ __('site.minYear') }}
                                        </label>
                                        <input type="text" class="SpecificInput" name="AddonUnkownMaxmum[]">
                                    </div>

                            </div>
                            <div class="addons">

                            </div>
                            <hr>
                        </div>
                        <div class="col-md-12">
                            <div class="row ">
                                <div class="col-md-12">
                                    <h4>
                                        @if(app()->getLocale() == 'ar')
                                            الاضافات
                                        @else
                                            Addons
                                        @endif
                                    </h4>
                                    <button type="button" class="btn btn-light d-block"
                                            onclick="addmoreFeatures()">@if(app()->getLocale() == "ar") إضافة
                                        المزيد  @else  Add More  @endif </button>
                                    <br>
                                </div>

                                    <div class="col-md-3 form-group">
                                        <label class="d-block">
                                            {{ __('site.addAr') }}
                                        </label>
                                        <input type="text" class="SpecificInput" name="FeatureNameAr[]">
                                    </div>
                                    <div class="col-md-3 form-group">
                                        <label class="d-block">
                                            {{ __('site.addEn') }}
                                        </label>
                                        <input type="text" class="SpecificInput" type="text" name="FeatureNameEn[]">
                                    </div>
                                    <div class="col-md-3 form-group">
                                        <label class="d-block">
                                            {{ __('site.addPrice') }}
                                        </label>
                                        <input type="number" step=".0001" class="SpecificInput" type="number"
                                               name="FeatureCost[]">
                                    </div>
                                    <div class="col-md-3 form-group">
                                        <label class="d-block">
                                            {{ __('site.addNote') }}
                                        </label>
                                        <input class="SpecificInput" type="text" name="FeatureNotices[]">
                                    </div>

                            </div>
                            <div class="features">

                            </div>
                        </div>
                    </div>
                </div>
                <hr>

                <div class="form-group">

                    <div class="text-center">


                    </div>


                </div>


                <div class="modal-footer">

                    <button type="submit" name="create"
                            class="btn btn-warning">{{ __('site.save') }}</button>
                </div>
            </form>
            <input type="hidden" id="#link" value="{{route('com.create',app()->getLocale())}}">

        </div>


    </div>


    <script>
        $(document).ready(function () {
            $('.brandChange').change(function () {
                id = $(this).val();
                $.ajax({
                    url: "{{url('/')}}/view/childerns/" + $(this).val(),
                    context: document.body
                }).done(function (data) {
                    //<input type="hidden" name="brand_id[]" value="'+id+'">
                    $.each(data, function (i, item) {
                        $(".models").append(
                            '<div class="card" style="padding:15px;">' +
                            '<div class="card-heading">' +
                            '<input type="checkbox" name="model_id[]" value="' + item.id + '" > ' + item.name +
                            '<hr>' +
                            '<div class="row">' +
                            '<div class="col-md-3">' +
                            '<label class="d-block">' +
                            '@if(app()->getLocale() == "ar")' +
                            'سعر الشريحة الاولي' +
                            '@else' +
                            'Start Price First Slide' +
                            '@endif' +
                            '</label>' +
                            '<input type="number" step=".0001" name="firstSlidePrice[]" class="SpecificInput" style="margin-bottom:15px;">' +
                            '<div class="row">' +
                            '<div class="col-md-4">' +
                            '<label> @if(app()->getLocale() == "ar") فتح ملف  @else Open File  @endif </lable>' +
                            '<input class="SpecificInput" type="number" step=".0001" name="OpenFileFirstSlide[]">' +
                            '</div>' +
                            '<div class="col-md-4">' +
                            '<label> @if(app()->getLocale() == "ar") النسبة @else  Perecent  @endif </lable>' +
                            '<input type="number" step=".0001" name="OpenFilePerecentFirstSlide[]" class="SpecificInput">' +
                            '</div>' +
                            '<div class="col-md-4">' +
                            '<label> @if(app()->getLocale() == "ar") الحد الادني @else  Minimum Price  @endif </lable>' +
                            '<input type="number" step=".0001" name="OpenFileFirstSlideMin[]" class="SpecificInput" placeholder="@if(app()->getLocale() == "ar" ) الحد الادني @else Minimum Price @endif">' +
                            '</div>' +
                            '</div>' +
                            '</div>' +
                            '<div class="col-md-3">' +
                            '<label class="d-block">' +
                            '@if(app()->getLocale() == "ar")' +
                            'سعر الشريحة الثانية' +
                            '@else' +
                            'Start Price Second Slide' +
                            '@endif' +
                            '</label>' +
                            '<input type="number" step=".0001" name="SecondSlidePrice[]" class="SpecificInput" style="margin-bottom:15px;">' +
                            '<div class="row">' +
                            '<div class="col-md-6">' +
                            '<label> @if(app()->getLocale() == "ar") فتح ملف  @else Open File  @endif </lable>' +
                            '<input class="SpecificInput" step=".0001" type="number" name="OpenFileSecondSlide[]">' +
                            '</div>' +
                            '<div class="col-md-6">' +
                            '<label> @if(app()->getLocale() == "ar") النسبة @else  Perecent  @endif </lable>' +
                            '<input type="number" step=".0001"  name="OpenFilePerecentSecondSlide[]" class="SpecificInput">' +
                            '</div>' +

                            '</div>' +
                            '</div>' +
                            '<div class="col-md-3">' +
                            '<label class="d-block">' +
                            '@if(app()->getLocale() == "ar")' +
                            'سعر الشريحة  الثالثة' +
                            '@else' +
                            'Start Price third Slide' +
                            '@endif' +
                            '</label>' +
                            '<input type="number" step=".0001" name="thirdSlidePrice[]" class="SpecificInput" style="margin-bottom:15px;">' +
                            '<div class="row">' +
                            '<div class="col-md-6">' +
                            '<label> @if(app()->getLocale() == "ar") فتح ملف  @else Open File  @endif </lable>' +
                            '<input class="SpecificInput" step=".0001" type="number" name="OpenFileThirdSlide[]">' +
                            '</div>' +
                            '<div class="col-md-6">' +
                            '<label> @if(app()->getLocale() == "ar") النسبة @else  Perecent  @endif </lable>' +
                            '<input type="number" step=".0001" name="OpenFilePerecentThirdSlide[]" class="SpecificInput">' +
                            '</div>' +

                            '</div>' +
                            '</div>' +
                            '<div class="col-md-3">' +
                            '<label class="d-block">' +
                            '@if(app()->getLocale() == "ar")' +
                            'سعر الشريحة  الرابعة' +
                            '@else' +
                            'Start Price fourth Slide' +
                            '@endif' +
                            '</label>' +
                            '<input type="number" name="fourthSlidePrice[]" class="SpecificInput" style="margin-bottom:15px;">' +
                            '<div class="row">' +
                            '<div class="col-md-6">' +
                            '<label> @if(app()->getLocale() == "ar") فتح ملف  @else Open File  @endif </lable>' +
                            '<input class="SpecificInput" step=".0001" type="number" name="OpenFileFourthSlide[]">' +
                            '</div>' +
                            '<div class="col-md-6">' +
                            '<label> @if(app()->getLocale() == "ar") النسبة @else  Perecent  @endif </lable>' +
                            '<input type="number" step=".0001" name="OpenFilePerecentFourthSlide[]" class="SpecificInput">' +
                            '</div>' +

                            '</div>' +
                            '</div>' +
                            '</div>' +
                            '<br>' +
                            '<hr>' +

                            '</div>'
                        );

                    });

                });
            });
        });

        function addmoreAddons() {


            $('.addons').append(
                '<div class="row deleting">' +
                '<div class="col-md-3 form-group">' +
                '<label class="d-block">' +
                '@if(app()->getLocale() == "ar")' +
                'إسم الشرط' +
                '@else' +
                'Term name' +
                '@endif' +
                '</label>' +
                '<input type="text" class="SpecificInput" name="AddonNameAR[]">' +
                '</div>' +
                '<div class="col-md-3 form-group">' +
                '<label class="d-block">' +
                '@if(app()->getLocale() == "ar")' +
                'إسم الشرط باللغة الانجليزية' +
                '@else' +
                'Term name In English' +
                '@endif' +


                '</label>' +
                '<input type="text" class="SpecificInput" name="AddonNameEn[]">' +
                '</div>' +
                '<div class="col-md-3 form-group">' +
                '<label class="d-block">' +
                '@if(app()->getLocale() == "ar")' +
                'حد أدني للسنين' +
                '@else' +
                'Minimum Years' +
                '@endif' +
                '</label>' +
                '<input type="text" class="SpecificInput" name="AddonMaxYear[]">' +
                '</div>' +
                '<div class="col-md-3 form-group">' +
                '<label class="d-block">' +
                '@if(app()->getLocale() == "ar")' +
                'حد أقصي للمجهول' +
                '@else' +
                'An unknown maximum' +
                '@endif' +
                '<button type="button" class="btn btn-danger deleteTerm" onclick="DeleteAddosn(this)" style="float:{{app()->getLocale() == "ar" ? "left" : "right"}}" > <i class="fa fa-trash text-white"></i></button>' +
                '</label>' +
                '<input type="text" class="SpecificInput" name="AddonUnkownMaxmum[]">' +
                '</div>' +
                '</div>'
            );
        }


        function addmoreFeatures() {
            $('.features').append(
                '<div class="row deletingFeature">' +
                '<div class="col-md-3 form-group">' +
                '<label class="d-block">' +
                '@if(app()->getLocale() == "ar")' +
                'إسم الاضافة بالعربية' +
                '@else' +
                'Arabic Feature Name' +
                '@endif' +
                '</label>' +
                '<input class="SpecificInput" type="text" name="FeatureNameAr[]">' +
                '</div>' +
                '<div class="col-md-3 form-group">' +
                '<label class="d-block">' +
                '@if(app()->getLocale() == "ar")' +
                ' إسم الاضافة بالانجليزية' +
                '@else' +
                'English Feature Name' +
                '@endif' +
                '</label>' +
                '<input class="SpecificInput" type="text" name="FeatureNameEn[]">' +
                '</div>' +
                '<div class="col-md-3 form-group">' +
                '<label class="d-block">' +
                '@if(app()->getLocale() == "ar")' +
                ' سعر الاضافة  ' +
                '@else' +
                'Feature Cost' +
                '@endif' +
                '<button type="button" class="btn btn-danger deleteTerm" onclick="DeleteFeature(this)" style="float:{{app()->getLocale() == "ar" ? "left" : "right"}}" > <i class="fa fa-trash text-white"></i></button>' +
                '</label>' +
                '<input class="SpecificInput" type="number" step=".0001" name="FeatureCost[]">' +
                '</div>' +
                '<div class="col-md-3 form-group">' +
                '<label class="d-block">' +
                '@if(app()->getLocale() == "ar")' +
                'ملاحظات' +
                '@else' +
                'Notices' +
                '@endif' +
                '</label>' +
                '<input  class="SpecificInput" type="text" name="FeatureNotices[]">' +
                '</div>' +
                '</div>'
            );
        }

        function DeleteAddosn(button) {
            $(button).closest('.deleting').remove();
        }

        function DeleteFeature(button) {
            $(button).closest('.deletingFeature').remove();
        }
    </script>
    <script>
        $(document).ready(function () {
            $('.brandChange').change(function () {
                id = $(this).val();
                $.ajax({
                    url: "{{url('/')}}/view/childerns/" + $(this).val(),
                    context: document.body
                }).done(function (data) {
                    //<input type="hidden" name="brand_id[]" value="'+id+'">
                    $.each(data, function (i, item) {
                        $(".models").append(
                            '<div class="card" style="padding:15px;">' +
                            '<div class="card-heading">' +
                            '<input type="checkbox" name="model_id[]" value="' + item.id + '" > ' + item.name +
                            '<hr>' +
                            '<div class="row">' +
                            '<div class="col-md-3">' +
                            '<label class="d-block">' +
                            '@if(app()->getLocale() == "ar")' +
                            'سعر الشريحة الاولي' +
                            '@else' +
                            'Start Price First Slide' +
                            '@endif' +
                            '</label>' +
                            '<input type="number" step=".0001" name="firstSlidePrice[]" class="SpecificInput" style="margin-bottom:15px;">' +
                            '<div class="row">' +
                            '<div class="col-md-4">' +
                            '<label> @if(app()->getLocale() == "ar") فتح ملف  @else Open File  @endif </lable>' +
                            '<input class="SpecificInput" type="number" step=".0001" name="OpenFileFirstSlide[]">' +
                            '</div>' +
                            '<div class="col-md-4">' +
                            '<label> @if(app()->getLocale() == "ar") النسبة @else  Perecent  @endif </lable>' +
                            '<input type="number" step=".0001" name="OpenFilePerecentFirstSlide[]" class="SpecificInput">' +
                            '</div>' +
                            '<div class="col-md-4">' +
                            '<label> @if(app()->getLocale() == "ar") الحد الادني @else  Minimum Price  @endif </lable>' +
                            '<input type="number" step=".0001" name="OpenFileFirstSlideMin[]" class="SpecificInput" placeholder="@if(app()->getLocale() == "ar" ) الحد الادني @else Minimum Price @endif">' +
                            '</div>' +
                            '</div>' +
                            '</div>' +
                            '<div class="col-md-3">' +
                            '<label class="d-block">' +
                            '@if(app()->getLocale() == "ar")' +
                            'سعر الشريحة الثانية' +
                            '@else' +
                            'Start Price Second Slide' +
                            '@endif' +
                            '</label>' +
                            '<input type="number" step=".0001" name="SecondSlidePrice[]" class="SpecificInput" style="margin-bottom:15px;">' +
                            '<div class="row">' +
                            '<div class="col-md-6">' +
                            '<label> @if(app()->getLocale() == "ar") فتح ملف  @else Open File  @endif </lable>' +
                            '<input class="SpecificInput" step=".0001" type="number" name="OpenFileSecondSlide[]">' +
                            '</div>' +
                            '<div class="col-md-6">' +
                            '<label> @if(app()->getLocale() == "ar") النسبة @else  Perecent  @endif </lable>' +
                            '<input type="number" step=".0001"  name="OpenFilePerecentSecondSlide[]" class="SpecificInput">' +
                            '</div>' +

                            '</div>' +
                            '</div>' +
                            '<div class="col-md-3">' +
                            '<label class="d-block">' +
                            '@if(app()->getLocale() == "ar")' +
                            'سعر الشريحة  الثالثة' +
                            '@else' +
                            'Start Price third Slide' +
                            '@endif' +
                            '</label>' +
                            '<input type="number" step=".0001" name="thirdSlidePrice[]" class="SpecificInput" style="margin-bottom:15px;">' +
                            '<div class="row">' +
                            '<div class="col-md-6">' +
                            '<label> @if(app()->getLocale() == "ar") فتح ملف  @else Open File  @endif </lable>' +
                            '<input class="SpecificInput" step=".0001" type="number" name="OpenFileThirdSlide[]">' +
                            '</div>' +
                            '<div class="col-md-6">' +
                            '<label> @if(app()->getLocale() == "ar") النسبة @else  Perecent  @endif </lable>' +
                            '<input type="number" step=".0001" name="OpenFilePerecentThirdSlide[]" class="SpecificInput">' +
                            '</div>' +

                            '</div>' +
                            '</div>' +
                            '<div class="col-md-3">' +
                            '<label class="d-block">' +
                            '@if(app()->getLocale() == "ar")' +
                            'سعر الشريحة  الرابعة' +
                            '@else' +
                            'Start Price fourth Slide' +
                            '@endif' +
                            '</label>' +
                            '<input type="number" name="fourthSlidePrice[]" class="SpecificInput" style="margin-bottom:15px;">' +
                            '<div class="row">' +
                            '<div class="col-md-6">' +
                            '<label> @if(app()->getLocale() == "ar") فتح ملف  @else Open File  @endif </lable>' +
                            '<input class="SpecificInput" step=".0001" type="number" name="OpenFileFourthSlide[]">' +
                            '</div>' +
                            '<div class="col-md-6">' +
                            '<label> @if(app()->getLocale() == "ar") النسبة @else  Perecent  @endif </lable>' +
                            '<input type="number" step=".0001" name="OpenFilePerecentFourthSlide[]" class="SpecificInput">' +
                            '</div>' +

                            '</div>' +
                            '</div>' +
                            '</div>' +
                            '<br>' +
                            '<hr>' +

                            '</div>'
                        );

                    });

                });
            });
        });

        function addmoreAddons() {


            $('.addons').append(
                '<div class="row deleting">' +
                '<div class="col-md-3 form-group">' +
                '<label class="d-block">' +
                '@if(app()->getLocale() == "ar")' +
                'إسم الشرط' +
                '@else' +
                'Term name' +
                '@endif' +
                '</label>' +
                '<input type="text" class="SpecificInput" name="AddonNameAR[]">' +
                '</div>' +
                '<div class="col-md-3 form-group">' +
                '<label class="d-block">' +
                '@if(app()->getLocale() == "ar")' +
                'إسم الشرط باللغة الانجليزية' +
                '@else' +
                'Term name In English' +
                '@endif' +


                '</label>' +
                '<input type="text" class="SpecificInput" name="AddonNameEn[]">' +
                '</div>' +
                '<div class="col-md-3 form-group">' +
                '<label class="d-block">' +
                '@if(app()->getLocale() == "ar")' +
                'حد أدني للسنين' +
                '@else' +
                'Minimum Years' +
                '@endif' +
                '</label>' +
                '<input type="text" class="SpecificInput" name="AddonMaxYear[]">' +
                '</div>' +
                '<div class="col-md-3 form-group">' +
                '<label class="d-block">' +
                '@if(app()->getLocale() == "ar")' +
                'حد أقصي للمجهول' +
                '@else' +
                'An unknown maximum' +
                '@endif' +
                '<button type="button" class="btn btn-danger deleteTerm" onclick="DeleteAddosn(this)" style="float:{{app()->getLocale() == "ar" ? "left" : "right"}}" > <i class="fa fa-trash text-white"></i></button>' +
                '</label>' +
                '<input type="text" class="SpecificInput" name="AddonUnkownMaxmum[]">' +
                '</div>' +
                '</div>'
            );
        }


        function addmoreFeatures() {
            $('.features').append(
                '<div class="row deletingFeature">' +
                '<div class="col-md-3 form-group">' +
                '<label class="d-block">' +
                '@if(app()->getLocale() == "ar")' +
                'إسم الاضافة بالعربية' +
                '@else' +
                'Arabic Feature Name' +
                '@endif' +
                '</label>' +
                '<input class="SpecificInput" type="text" name="FeatureNameAr[]">' +
                '</div>' +
                '<div class="col-md-3 form-group">' +
                '<label class="d-block">' +
                '@if(app()->getLocale() == "ar")' +
                ' إسم الاضافة بالانجليزية' +
                '@else' +
                'English Feature Name' +
                '@endif' +
                '</label>' +
                '<input class="SpecificInput" type="text" name="FeatureNameEn[]">' +
                '</div>' +
                '<div class="col-md-3 form-group">' +
                '<label class="d-block">' +
                '@if(app()->getLocale() == "ar")' +
                ' سعر الاضافة  ' +
                '@else' +
                'Feature Cost' +
                '@endif' +
                '<button type="button" class="btn btn-danger deleteTerm" onclick="DeleteFeature(this)" style="float:{{app()->getLocale() == "ar" ? "left" : "right"}}" > <i class="fa fa-trash text-white"></i></button>' +
                '</label>' +
                '<input class="SpecificInput" type="number" step=".0001" name="FeatureCost[]">' +
                '</div>' +
                '<div class="col-md-3 form-group">' +
                '<label class="d-block">' +
                '@if(app()->getLocale() == "ar")' +
                'ملاحظات' +
                '@else' +
                'Notices' +
                '@endif' +
                '</label>' +
                '<input  class="SpecificInput" type="text" name="FeatureNotices[]">' +
                '</div>' +
                '</div>'
            );
        }

        function DeleteAddosn(button) {
            $(button).closest('.deleting').remove();
        }

        function DeleteFeature(button) {
            $(button).closest('.deletingFeature').remove();
        }
    </script>
    <script src="https://cdn.tiny.cloud/1/rcipqrnmq01td2d87j42wmmfq1sxtfssmwi7pxv7oe4zncyk/tinymce/5/tinymce.min.js"
            referrerpolicy="origin"></script>
    <script> tinymce.init({selector: 'textarea'});</script>
    <script>
        $('#buttonStatus').on('click', function () {

            //var data = $(this).attr('data-url');

            var company_id = $(this).attr('value');
            //alert(company_id);

            var row = 'statusVal_' + company_id;
            var data = $('.' + row).val();
            var status = data == 0 ? 1 : 0;
            //alert(status);
            console.log(status);


            $.ajax({
                type: "GET",
                dataType: "json",
                url: '/insurace/docChangeStatus',
                data: {'status': status, 'company_id': company_id},
                success: function (data) {
                    console.log(data.success)
                    console.log(status);
                    var clas = 'cl_' + company_id;
                    if (status == 1) {

                        $('.' + clas).html('مفعلة');
                        $('.' + clas).removeClass('btn-danger');
                        $('.' + clas).addClass('btn-success');
                        $('.' + row).attr('value', '0');
                    } else {

                        $('.' + clas).html('معطله');
                        $('.' + clas).removeClass('btn-success');
                        $('.' + clas).addClass('btn-danger');
                        $('.' + row).attr('value', '1');
                    }

                }
            });
        });
        //    cl_delete
        $('#buttonDelete').on('click', function () {
            var row_id = $(this).attr('value');
            var link = $('#link').val();
            console.log(status);
            if (confirm('Are you sure you want to delete this?')) {
                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: '/insurace/deleteDoc',
                    data: {'row_id': row_id},
                    success: function (data) {
                        console.log(data.success)
                        window.location = link;
                    }
                });
            }

        });

        $('#buttonDeleteAddon').on('click', function () {
            var id = $(this).attr('value');
            var link = $('#link').val();
            if (confirm('Are you sure you want to delete this?')) {
                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: '/insurace/deleteDocAddon',
                    data: {'id': id},
                    success: function (data) {
                        console.log(data.success)
                        window.location = link;
                    }
                });
            }
        });

        $('#buttonDeleteCon').on('click', function () {
            var id = $(this).attr('value');
            var link = $('#link').val();
            if (confirm('Are you sure you want to delete this?')) {
                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: '/insurace/deletecondition',
                    data: {'id': id},
                    success: function (data) {
                        console.log(data.success)
                        window.location = link;
                    }
                });
            }
        });

    </script>


@endsection
