       <div class="row">
           <div class="col-auto">
               MEDICATION &nbsp;&nbsp;&nbsp;&nbsp;
           </div>
           <div class="col-auto">
               <button type="button" class="btn btn-checkbox btn-label waves-effect waves-light btn-sm"
                   id="btn_medication">
                   <i class="ri-checkbox-blank-line label-icon align-middle fs-16 me-2 text-light"></i>
                   None Medication
               </button>
           </div>
           <div class="row ">

               @foreach (isset($procedure->anesthesis) ? $procedure->anesthesis : [] as $index => $medi)
                   @php
                       $medi = (object) $medi;
                    //    dd($medi)
                   @endphp
                   <div class="col-lg-6 ">
                       <div class="row mt-2">
                           <div class="form-group col-md-7 set-0">
                               <input type="checkbox" name="medi_ck" class="form-check-input ck-medi me-2 savejson-medi"
                                   id="ck_{{ $index }}" index="{{ $index }}" value="{{ $medi->name }}"
                                   @isset($case->select) @if (in_array($medi->name, $case->select))  {{ 'checked' }}  @endif  @endisset>
                               <input id="boxmedi{{ $medi->name }}" name="boxmedigroup" value="{{ $medi->name }}"
                                   type="hidden" class="boxmedi"
                                   @if (in_array($medi->name, isset($tb_casemedication->medication) ? $tb_casemedication->medication : [])) checked="checked" @endif>
                               <label for="ck_{{ $index }}">
                                   {{ $medi->name }}
                               </label>

                           </div>
                           <div class="form-group col-md-3 set-0">
                               <input id="medi{{ $medi->name }}" type="number" name="medigroup"
                                   class="form-control form-control-sm autotext medigroup inp_mi savejson-medi"
                                   medigroup_id="{{ $medi->name }}" index="{{ $index }}"
                                   value="{{ @$case->medication_unit[$medi->name]['dose'] }}"
                                   placeholder="Dose">

                               <input type="hidden" class="medi_unit" value="{{ @$medi->unit }}">
                           </div>
                           <div class="form-group col-md-2 set-0"
                               @if (@$mos == 2) style="border-right: 1px solid darkgrey;" @endif>
                               {{ @$medi->unit }}
                           </div>
                       </div>
                   </div>
               @endforeach
           </div>

           <div class="row px-2" style="width:100%;margin-top: 0.70em;">
               <div class="col-lg-8">
                   <input id="medi_other" name="medi_other" table="tb_casemedication"
                       class="form-control medi_other autotext" type="Text" autocomplete="off"
                       value="{{ @$case->medi_other }}" placeholder="Other Medication">
               </div>
               <div class="col-lg-2">
                   <input id="medi_otherdose" name="medi_otherdose" table="tb_casemedication"
                       class="form-control medi_other autotext" type="Text" autocomplete="off"
                       value="{{ @$case->medi_otherdose }}" placeholder="Dose">
               </div>
               <div class="col-lg-2">
                   <select id="medi_otherunit" name="medi_otherunit" class="form-control medi_other"
                       table="tb_casemedication">
                       <option value="">Select unit</option>
                       @foreach (isset($doseunit) ? $doseunit : [] as $data)
                           @if (@$case->medi_otherunit == $data)
                               <option value="{{ $data }}" selected>{{ $data }}</option>
                           @else
                               <option value="{{ $data }}">{{ $data }}</option>
                           @endif
                       @endforeach
                   </select>
               </div>
           </div>
           <div class="col-12">&nbsp;</div>
       </div>

       <script>
           $(".medi_other").change(function() {
               let id = $(this).attr("id");
               let val = $(this).val();

               let retString = localStorage.getItem("{{ $cid }}")
               let obj = {}
               if (retString != null) {
                   obj = JSON.parse(retString)
               }
               obj[id] = val
               obj['medication'] = obj['medication'] != undefined ? obj['medication'] : []
               let text = JSON.stringify(obj);
               localStorage.setItem("{{ $cid }}", text);

               $.post('{{ url("api/procedure") }}', {
                   event: 'medi_other',
                   name: id,
                   value: val,
                   cid: '{{ $cid }}'
               }, function(data, status) {});
           });

           $(".boxmedi").click(function() {
               var arr = [];
               $(".boxmedi:checked").each(function() {
                   arr.push($(this).val());
               });
               $.post("{{ url('api/photo') }}", {
                   event: "medication_update",
                   name: "medication",
                   value: arr,
                   cid: "{{ $cid }}"
               }, function(data, status) {});
           });

           $(".medigroup").change(function() {
               var arr = [];
               var arr2 = [];
               var arr3 = [];
               $(".medigroup").each(function() {
                   arr.push($(this).val());
               });
               $(".boxmedi").each(function() {
                   arr2.push($(this).val());
               });
               $(".medi_unit").each(function() {
                   arr3.push($(this).val());
               });

               $.post("{{ url('api/photo') }}", {
                   event: "medication_update2",
                   name: "medication_unit",
                   dose: arr,
                   key: arr2,
                   unit: arr3,
                   cid: "{{ $cid }}"
               }, function(data, status) {});
           });


           $("#btn_medication").click(function() {

               var arr = [];
               var arr2 = [];
               var arr3 = [];
               var arr4 = [];
               $(".medigroup").val("");
               $(".medigroup").each(function() {
                   arr.push($(this).val());
               });
               $(".boxmedi").each(function() {
                   arr2.push($(this).val());
               });
               $(".medi_unit").each(function() {
                   arr3.push($(this).val());
               });

               $.post("{{ url('api/photo') }}", {
                   event: "medication_update2",
                   name: "medication_unit",
                   dose: arr,
                   key: arr2,
                   unit: arr3,
                   select: 'none',
                   cid: "{{ $cid }}"
               }, function(data, status) {});
               $("#medi_other").val("None Medication");
               $("#medi_otherunit").val("");
               $("#medi_otherdose").val("");

               $(".ck-medi").each(function() {
                   if ($(this).is(':checked')) {
                       $(this).prop('checked', false)
                   }
               })

               $("#medi_other").trigger("change");
               $("#medi_otherunit").trigger("change");
               $("#medi_otherdose").trigger("change");

               $('.savejson-medi').focusout()
               $('input[name="medi_other"]').focusout()
           });

           $('.ck-medi').on('click', function() {

               let value = $(this).val()
               let action = $(this).is(':checked') ? 'add' : 'remove'
               let lg = $('.ck-medi').length

               let total = 0
               $('.ck-medi:checked').each(function() {
                   total += 1
               })

               if (!$(this).is(':checked')) {
                   for (let i = 0; i < lg; i++) {
                       let inp_mi = $($('.inp_mi')[i]).attr('medigroup_id')
                       if (value == inp_mi) {
                           $($('.inp_mi')[i]).val('')
                           $($('.inp_mi')[i]).trigger('change')
                       }
                   }

                   var arr = [];
                   var arr2 = [];
                   var arr3 = [];
                   $(".medigroup").each(function() {
                       arr.push($(this).val());
                   });
                   $(".boxmedi").each(function() {
                       arr2.push($(this).val());
                   });
                   $(".medi_unit").each(function() {
                       arr3.push($(this).val());
                   });

                   $.post("{{ url('api/photo') }}", {
                       event: "medication_update2",
                       name: "medication_unit",
                       dose: arr,
                       key: arr2,
                       unit: arr3,
                       cid: "{{ $cid }}"
                   }, function(data, status) {});
               }

               if (total > 0) {
                   let medi_other = $('#medi_other').val()
                   if (medi_other == 'None Medication') {
                       $('#medi_other').val('')
                       $('#medi_otherdose').val('')
                       $('#medi_otherunit').val('')
                   }
               }

               $.post("{{ url('api/photo') }}", {
                   event: "medication_update3",
                   name: "select",
                   value: value,
                   type: action,
                   cid: "{{ $cid }}"
               }, function(data, status) {});
           })

           $('.inp_mi').on('input', function() {
               let medigroup_index = $(this).attr('index')
               let medigroup_val = $(this).val()
               let action = ''

               if (medigroup_val != '') {
                   $(`#ck_${medigroup_index}`).prop('checked', true)
                   action = 'add'
               } else {
                   $(`#ck_${medigroup_index}`).prop('checked', false)
                   action = 'remove'
               }

               let value = $(`#ck_${medigroup_index}`).val()

               $.post("{{ url('api/photo') }}", {
                   event: "medication_update3",
                   name: "select",
                   value: value,
                   type: action,
                   cid: "{{ $cid }}"
               }, function(data, status) {});

               var arr = [];
               var arr2 = [];
               var arr3 = [];
               $(".medigroup").each(function() {
                   arr.push($(this).val());
               });
               $(".boxmedi").each(function() {
                   arr2.push($(this).val());
               });
               $(".medi_unit").each(function() {
                   arr3.push($(this).val());
               });

               $.post("{{ url('api/photo') }}", {
                   event: "medication_update2",
                   name: "medication_unit",
                   dose: arr,
                   key: arr2,
                   unit: arr3,
                   cid: "{{ $cid }}"
               }, function(data, status) {});

               var ck_num = $('.inp_mi').length
               var have_val = 0
               for (let y = 0; y < ck_num; y++) {
                   var have_text = $($('.inp-mi')[y]).val()
                   if (have_text != '') {
                       have_val += 1
                   }
               }

               if (have_val > 0) {
                   var medi_txt = $('#medi_other').val()
                   if (medi_txt.trim() == 'None Medication') {
                       $('#medi_other').val('')
                       $('#medi_otherdose').val('')
                       $('#medi_otherunit').val('')

                       edit_medicationother()
                   }
               }

           })
       </script>
