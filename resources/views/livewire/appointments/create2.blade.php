<div>
    @if($message === true)
    <script>
        alert('تم ارسال تفاصيل الحجز الي المستشفي وسيتم ارسال معلومات الموعد عبر الهاتف والبريد الالكتروني')
        location.reload()
    </script>
    @endif
    @if($message2 === true)
    <script>
        alert('لا يوجد مواعيد في هذا اليو برجاء اختيار يوم اخر')
        location.reload()
    </script>
    @endif

    <form wire:submit.prevent="store">

        <div class="pd-30 pd-sm-40 bg-gray-200">

            <div class="row row-xs align-items-center mg-b-20">
                <div class="col-md-1">
                    <label for="exampleInputEmail1">
                        اسمك</label>
                </div>
                <div class="col-md-11 mg-t-5 mg-md-t-0">
                    <input class="form-control" type="text" name="username" wire:model="name" required="">
                </div>
            </div>

            <div class="row row-xs align-items-center mg-b-20">
                <div class="col-md-1">
                    <label for="exampleInputEmail1">
                        البريد الالكتروني</label>
                </div>
                <div class="col-md-11 mg-t-5 mg-md-t-0">
                    <input class="form-control" type="email" name="email" wire:model="email" required="">
                </div>
            </div>

            <div class="row row-xs align-items-center mg-b-20">
                <div class="col-md-1">
                    <label for="exampleInputEmail1">
                        رقم الهاتف</label>
                </div>
                <div class="col-md-11 mg-t-5 mg-md-t-0">
                <input class="form-control" type="tel" name="phone" wire:model="phone" required="">
                </div>
            </div>

            <div class="row row-xs align-items-center mg-b-20">
                <div class="col-md-1">
                    <label for="exampleInputEmail1">
                        القسم</label>
                </div>
                <div class="col-md-11 mg-t-5 mg-md-t-0">
                <select class="form-control select" name="section" wire:model="section" id="exampleFormControlSelect1">
                    <option>-- اختار من القائمة --</option>
                    @foreach($sections as $section)
                    <option value="{{$section->id}}">{{$section->name}}</option>
                    @endforeach
                </select>
                </div>
            </div>

            <div class="row row-xs align-items-center mg-b-20">
                <div class="col-md-1">
                    <label for="exampleInputEmail1">
                        الدكتور</label>
                </div>

                <div class="col-md-11 mg-t-5 mg-md-t-0">
                <select class="form-control select"  name="doctor" wire:model="doctor" id="exampleFormControlSelect2">
                    @foreach($doctors as $doctor)
                    <option value="{{$doctor->id}}">{{$doctor->name}}</option>
                    @endforeach
                </select>
                </div>
            </div>

            <div class="row row-xs align-items-center mg-b-20">
                <div class="col-md-1">
                    <label for="exampleInputEmail1">
                        ايام العمل</label>
                </div>
                <div class="col-md-11 mg-t-5 mg-md-t-0">
                <input class="form-control" type="text" name="work_days" wire:model="work_days" id="exampleFormControlSelect1" readonly>
                </div>
            </div>
            <div class="row row-xs align-items-center mg-b-20">
                <div class="col-md-1">
                    <label for="exampleInputEmail1">
                         تاريخ الموعد</label>
                </div>
                <div class="col-md-11 mg-t-5 mg-md-t-0">
                <input type="date" name="appointment_patient" wire:model="appointment_patient" class="form-control">
                </div>
            </div>
            <button type="submit" class="btn btn-main-primary pd-x-30 mg-r-5 mg-t-5">{{ trans('Doctors.submit') }}</button>
        </div>
    </form>
</div>
