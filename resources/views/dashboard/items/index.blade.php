@extends('dashboard.layout.app')
@section('content')

    <div class="card text-white bg-primary" style="border:none;">

        <br>
        <div class="card-header mt-3">
            <h5 style="position: relative; display: inline-block;top: 6px;">
                {{__('site.commercial ads')}} 
            </h5>
           <a href="{{route('items-create')}}" class="btn btn-light"  style="float: left;margin-right:10px;" >
                <i class="fas fa-plus-circle"></i>
            </a>
        </div>
        <div class="card-body" style="background-color: white;color:#31353D">
            <div class="col-md-12">
                <div class="filter row">
                    <div class="form-group col-md-4">
                     <div  class="form-group">
                       <label class="text-right d-block" for="search">{{__('site.search')}}</label>
                       <input type="text" class="search form-control text-right" name="search" placeholder="بحث">
                     </div>
                    </div>
                    <div class="row col-md-8">
                        <div class="form-group col-md-3">
                            <label class="text-right d-block" for="order">{{__('site.ranking')}}</label>
                            <select dir="rtl" class="form-control" name="order">
                                <option value="">{{__('site.select')}}</option> 
                                <option value="created_at-desc">{{__('site.new ads')}}</option> 
                                <option value="created_at-asc">{{__('site.old ads')}}</option> 
                                <option value="visitors-desc">{{__('site.most watched')}}</option> 
                                <option value="visitors-asc">{{__('site.least watched')}}</option> 
                            </select>
                          </div>
                           <div  class="form-group col-md-3">
                             <label class="text-right d-block" for="status">{{__('site.status')}}</label>
                             <select dir="rtl" class="form-control" name="status">
                               <option value="">{{__('site.select')}}</option> 
                               <option value="1">{{__('site.active')}}</option>
                               <option value="0">{{__('site.inactive')}}</option>
                             </select>
                           </div>
                           <div  class="form-group col-md-3">
                            <label class="text-right d-block" for="country_id">{{__('site.country')}}</label>
                            <select dir="rtl" class="form-control" name="country_id">
                            <option value="">{{__('site.select')}}</option> 
                            @foreach($countries as $country)
                                <option value="{{$country->id}}">
                                    {{$country->ar_name}}
                                </option>
                            @endforeach
                        </select>
                          </div>
                           <div class="form-group col-md-3">
                            <label class="text-right d-block" for="membership">{{__('site.ad type')}}</label>
                            <select dir="rtl" class="form-control" name="membership">
                                <option value="">{{__('site.select')}}</option> 
                                <option value="0">{{__('site.normal')}}</option> 
                                <option value="1">{{__('site.silver')}}</option> 
                                <option value="2">{{__('site.featured')}}</option> 
                                <option value="3">{{__('site.golden')}}</option> 
                            </select>
                          </div>
                    </div>
               </div>
            </div>
            <div class="data-table">
                @include('dashboard.items.table',['items'=>$items])
            </div>
        </div>
    </div>



  



@endsection

@section('js')

    <script>
        $(':button').on('click', function () {
            var brand_id = $(this).attr('id');
            var row = 'statusVal_' + brand_id;
            var data = $('.' + row).val();
            var status = data == 0 ? 1 : 0;
            console.log(status);


            $.ajax({
                type: "GET",
                dataType: "json",
                url: '/dashboard/items/itemChangeStatus',
                data: {'status': status, 'brand_id': brand_id},
                success: function (data) {
                    console.log(data.success)
                    console.log(status);
                    var clas = 'cl_' + brand_id;
                    if (status == 1) {
                        $('.' + row).attr('value', '1');
                        $('.' + clas).html('نشط');
                        $('.' + clas).removeClass('btn-danger');
                        $('.' + clas).addClass('btn-success');
                    } else {
                        $('.' + row).attr('value', '0');
                        $('.' + clas).html('غير نشط');
                        $('.' + clas).removeClass('btn-success');
                        $('.' + clas).addClass('btn-danger');
                    }

                }
            });
        });
        // filters handler
        var updateDataFilter = function(filters){
            $.ajax({
                type: "POST",
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '/dashboard/items',
                data: filters,
                success: function (data) {
                    $('.data-table').html(data)
                },
                error:function(e){
                    console.log(e);
                }
            })
        }
          $(document).ready(function(){
              var filters = {}
             $('.filter select').on('change',function(){
                 if($(this).val() != '')
                 filters[$(this).attr('name')] = $(this).val()
                 updateDataFilter(filters)
             })
             $('.search').on('input',function(){
                if($(this).val() != '')
                updateDataFilter({'search':$(this).val()})
             })


            })
    </script>
@endsection
